<?php

namespace App\Models\Loot;

use App\Models\Item\Item;

use App\Models\Model;
use Config;

class LootTable extends Model {
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'display_name', 'data', 'rolls',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'loot_tables';

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'data' => 'array',
    ];

    /**
     * Validation rules for creation.
     *
     * @var array
     */
    public static $createRules = [
        'name'         => 'required',
        'display_name' => 'required',
        'subtable_criteria.*' => 'required_with:subtable_status_id.*',
        'subtable_quantity.*' => 'required_with:subtable_quantity.*',
    ];

    /**
     * Validation rules for updating.
     *
     * @var array
     */
    public static $updateRules = [
        'name'         => 'required',
        'display_name' => 'required',
        'subtable_criteria.*' => 'required_with:subtable_status_id.*',
        'subtable_quantity.*' => 'required_with:subtable_quantity.*',
    ];

    /**********************************************************************************************

        RELATIONS

    **********************************************************************************************/

    /**
     * Get the loot data for this loot table.
     */
    public function loot() {
        return $this->hasMany('App\Models\Loot\Loot', 'loot_table_id');
    }

    /**
     * Get the guaranteed loot data for this loot table.
     */
    public function guaranteedLoot() {
        return $this->hasMany('App\Models\Loot\LootTableGuaranteedDrop', 'loot_table_id');
    }

    /**********************************************************************************************

        ACCESSORS

    **********************************************************************************************/

    /**
     * Displays the model's name, linked to its encyclopedia page.
     *
     * @return string
     */
    public function getDisplayNameAttribute() {
        return '<span class="display-loot">'.$this->attributes['display_name'].'</span> '.add_help('This reward is random.');
    }

    /**
     * Gets the loot table's asset type for asset management.
     *
     * @return string
     */
    public function getAssetTypeAttribute() {
        return 'loot_tables';
    }

    /**
     * Gets the admin edit URL.
     *
     * @return string
     */
    public function getAdminUrlAttribute() {
        return url('admin/data/loot-tables/edit/'.$this->id);
    }

    /**
     * Gets the power required to edit this model.
     *
     * @return string
     */
    public function getAdminPowerAttribute() {
        return 'edit_data';
    }

    /**********************************************************************************************

        OTHER FUNCTIONS

    **********************************************************************************************/

    /**
     * Rolls on the loot table and consolidates the rewards.
     *
     * @param int        $quantity
     * @param mixed|null $user
     *
     * @return \Illuminate\Support\Collection
     */

    public function roll($quantity = 1, $user = null) {
        $rewards = createAssetsArray();

        // check if there is a user (for pity drops)
        if ($user && $this->rolls > 0) {
            // check if user has a progress entry for this loot table
            $progress = $user->lootDropProgresses()->where('loot_table_id', $this->id)->first();
            if (!$progress) {
                // create a new progress entry
                $progress = $user->lootDropProgresses()->create([
                    'loot_table_id' => $this->id,
                    'rolls'         => 0,
                ]);
            }
            // check if user has rolled enough times to get a guaranteed drop
            if ($progress->rolls >= $this->rolls - 1) { // -1 so that the amount of times rolled exactly matches the amount of rolls needed for a guaranteed drop
                // roll on guaranteed drops
                $guaranteed = $this->loot->where('is_guaranteed', true);
                foreach ($guaranteed as $g) {
                    // If this is chained to another loot table, roll on that table
                    if ($g->rewardable_type == 'LootTable') {
                        $rewards = mergeAssetsArrays($rewards, $g->reward->roll($g->quantity));
                    } elseif ($g->rewardable_type == 'ItemCategory' || $g->rewardable_type == 'ItemCategoryRarity') {
                        $rewards = mergeAssetsArrays($rewards, $this->rollCategory($g->rewardable_id, $g->quantity, ($g->data['criteria'] ?? null), ($g->data['rarity'] ?? null)));
                    } elseif ($g->rewardable_type == 'ItemRarity') {
                        $rewards = mergeAssetsArrays($rewards, $this->rollRarityItem($g->quantity, $g->data['criteria'], $g->data['rarity']));
                    } else {
                        addAsset($rewards, $g->reward, $g->quantity);
                    }
                }
                // reset user's progress
                $user->lootDropProgresses()->where('loot_table_id', $this->id)->update(['rolls' => 0]);

                // return rewards
                return $rewards;
            } else {
                // increment rolls
                $user->lootDropProgresses()->where('loot_table_id', $this->id)->increment('rolls');
            }
        }

        $loot = $this->loot;

        $totalWeight = 0;
        foreach($loot as $l) $totalWeight += $l->weight;

        for($i = 0; $i < $quantity; $i++)
        {
            $roll = mt_rand(0, $totalWeight - 1);
            $result = null;
            $prev = null;
            $count = 0;
            foreach($loot as $l)
            {
                $count += $l->weight;

                if($roll < $count)
                {
                    $result = $l;
                    break;
                }
                $prev = $l;
            }
            if(!$result) $result = $prev;

            if ($result) {
                // If this is chained to another loot table, roll on that table
                if($result->rewardable_type == 'LootTable') $rewards = mergeAssetsArrays($rewards, $result->reward->roll($result->quantity));
                elseif($result->rewardable_type == 'ItemCategory' || $result->rewardable_type == 'ItemCategoryRarity') $rewards = mergeAssetsArrays($rewards, $this->rollCategory($result->rewardable_id, $result->quantity, (isset($result->data['criteria']) ? $result->data['criteria'] : null), (isset($result->data['rarity']) ? $result->data['rarity'] : null)));
                elseif($result->rewardable_type == 'ItemRarity') $rewards = mergeAssetsArrays($rewards, $this->rollRarityItem($result->quantity, $result->data['criteria'], $result->data['rarity']));
                else addAsset($rewards, $result->reward, $result->quantity);
            }
        }
        return $rewards;
    }

    /**
     * Rolls on an item category.
     *
     * @param int        $id
     * @param int        $quantity
     * @param  string $condition
     * @param string     $rarity
     * @return \Illuminate\Support\Collection
     */
    public function rollCategory($id, $quantity = 1, $criteria = null, $rarity = null) {
        $rewards = createAssetsArray();

        if (isset($criteria) && $criteria && isset($rarity) && $rarity) {
            if(Config::get('lorekeeper.extensions.item_entry_expansion.loot_tables.alternate_filtering')) $loot = Item::where('item_category_id', $id)->released()->whereNotNull('data')->where('data->rarity', $criteria, $rarity)->get();
            else $loot = Item::where('item_category_id', $id)->released()->whereNotNull('data')->whereRaw('JSON_EXTRACT(`data`, \'$.rarity\')'. $criteria . $rarity)->get();
            }
        else $loot = Item::where('item_category_id', $id)->released()->get();
        if(!$loot->count()) throw new \Exception('There are no items to select from!');

        $totalWeight = $loot->count();

        for($i = 0; $i < $quantity; $i++)
        {
            $roll = mt_rand(0, $totalWeight - 1);
            $result = $loot[$roll];

            if ($result) {
                // If this is chained to another loot table, roll on that table
                addAsset($rewards, $result, 1);
            }
        }
        return $rewards;
    }

    /**
     * Rolls on an item rarity.
     *
     * @param int    $quantity
     * @param  string $condition
     * @param string $rarity
     * @return \Illuminate\Support\Collection
     */

    public function rollRarityItem($quantity, $criteria, $rarity) {
        $rewards = createAssetsArray();

        if(Config::get('lorekeeper.extensions.item_entry_expansion.loot_tables.alternate_filtering')) $loot = Item::released()->whereNotNull('data')->where('data->rarity', $criteria, $rarity)->get();
        else $loot = Item::released()->whereNotNull('data')->whereRaw('JSON_EXTRACT(`data`, \'$.rarity\')'. $criteria . $rarity)->get();
        if(!$loot->count()) throw new \Exception('There are no items to select from!');

        $totalWeight = $loot->count();

        for($i = 0; $i < $quantity; $i++)
        {
            $roll = mt_rand(0, $totalWeight - 1);
            $result = $loot[$roll];

            if ($result) {
                // If this is chained to another loot table, roll on that table
                addAsset($rewards, $result, 1);
            }
        }

        return $rewards;
    }

    /**
     * Returns loot as a paired rewardable name and id.
     */
    public function getLoot() {
        $loots = [];
        foreach ($this->loot as $loot) {
            $loots[$loot->rewardable_id] = $loot->reward->name;
        }

        return $loots;
    }
}
