<?php

/*
|--------------------------------------------------------------------------
| Asset Helpers
|--------------------------------------------------------------------------
|
| These are used to manage asset arrays, which are used in keeping
| track of/distributing rewards.
|
*/

/**
 * Calculates amount of group currency a submission should be awarded
 * based on form input. Corresponds to the GroupCurrencyForm configured in
 * app/Forms.
 *
 * @param  array  $data
 * @return int
 */
function calculateGroupCurrency($data) {
    // Sets a starting point for the total so that numbers can be added to it.
    // Don't change this!
    $total = 0;

    // You'll need the names of the form fields you specified both in the form config and above.
    // You can get a particular field's value with $data['form_name'], for instance, $data['art_finish']

    // This differentiates how values are calculated depending on the type of content being submitted.
    $pieceType = collect($data['piece_type'])->flip();

    // For instance, if the user selected that the submission has a visual art component,
    // these actions will be performed:
    if($pieceType->has('art')) {
        // This adds values to the total!
        $total += (($data['chara_vis_hd'] * 4) + ($data['chara_vis_bst'] * 10) + ($data['chara_vis_fbc'] * 15) + ($data['chara_vis_fb'] * 25) + ($data['iso_count'] * 10) + (($data['scomp_count'] * 5) + ($data['lcomp_count'] * 10)) + $data['art_finish']);
        // This multiplies each option selected in the "bonus" form field by
        // the result from the "art type" field, and adds it to the total.
        if(isset($data['art_bonus'])) foreach((array)$data['art_bonus'] as $bonus) $total += (round($bonus) + $data["activity_bonus"] + $data['anim_type']);
    }

    // Likewise for if the user selected that the submission has a written component:
    if($pieceType->has('lit')) {
        // This divides the word count by 100, rounds the result, and then multiplies it by one--
        // so, effectively, for every 100 words, 1 of the currency is awarded.
        // You can adjust these numbers as you see fit.
        $total += (((((round($data['word_count']-250) / 155) + 1) ^ 2 * 2) + 17) + $data["activity_bonus"]);
    }

    // And if it has a crafted or other physical object component:
    if($pieceType->has('craft')) {
        // This just adds 15! You can adjust this as you desire.
        $total += (($data['chara_vis_hd'] * 4) + ($data['chara_vis_bst'] * 10) + ($data['chara_vis_fbc'] * 15) + ($data['chara_vis_fb'] * 25) + ($data['iso_count'] * 10) + ($data['scomp_count'] * 5) + ($data['lcomp_count'] * 10));
        if(isset($data['art_bonus'])) foreach((array)$data['art_bonus'] as $bonus) $total += (round($bonus) + $data["activity_bonus"] + $data['anim_type'] + $data['crafts_3d']);
    }

    // Hands the resulting total off. Don't change this!
    return $total;
}

/**
 * Gets the asset keys for an array depending on whether the
 * assets being managed are owned by a user or character.
 *
 * @param  bool  $isCharacter
 * @return array
 */

function getAssetKeys($isCharacter = false) {
    if(!$isCharacter) {
        return ['items', 'awards', 'currencies', 'pets', 'weapons', 'gears', 'raffle_tickets', 'loot_tables', 'user_items', 'user_awards', 'characters', 'recipes', 'themes'];
    } else {
        return ['currencies', 'items', 'character_items', 'loot_tables', 'awards', 'features', 'statuses'];
    }
}

/**
 * Gets the model name for an asset type.
 * The asset type has to correspond to one of the asset keys above.
 *
 * @param  string  $type
 * @param  bool    $namespaced
 * @return string
 */
function getAssetModelString($type, $namespaced = true) {
    switch($type) {
        case 'items': case 'item':
            if($namespaced) {
                return '\App\Models\Item\Item';
            } else {
                return 'Item';
            }
            break;

        case 'awards':
            if($namespaced) return '\App\Models\Award\Award';
            else return 'Award';
            break;

        case 'currencies':
            if($namespaced) return '\App\Models\Currency\Currency';
            else return 'Currency';
            break;

        case 'pets': case 'pet':
            if($namespaced) return '\App\Models\Pet\Pet';
            else return 'Pet';
            break;

        case 'weapons': case 'weapon':
            if($namespaced) return '\App\Models\Claymore\Weapon';
            else return 'Weapon';
            break;

        case 'gears': case 'gear':
            if($namespaced) return '\App\Models\Claymore\Gear';
            else return 'Gear';
            break;

        case 'raffle_tickets':
            if($namespaced) return '\App\Models\Raffle\Raffle';
            else return 'Raffle';
            break;

        case 'loot_tables':
            if($namespaced) return '\App\Models\Loot\LootTable';
            else return 'LootTable';
            break;

        case 'user_items':
            if($namespaced) return '\App\Models\User\UserItem';
            else return 'UserItem';
            break;

        case 'user_awards':
            if($namespaced) return '\App\Models\User\UserAward';
            else return 'UserAward';
            break;

        case 'characters':
            if($namespaced) return '\App\Models\Character\Character';
            else return 'Character';
            break;

        case 'recipes':
            if($namespaced) return '\App\Models\Recipe\Recipe';
            else return 'Recipe';
            break;

        case 'character_items':
            if($namespaced) return '\App\Models\Character\CharacterItem';
            else return 'CharacterItem';
            break;

        case 'statuses':
            if($namespaced) return '\App\Models\Status\StatusEffect';
            else return 'StatusEffect';
            break;

        case 'features':
            if($namespaced) return '\App\Models\Feature\Feature';
            else return 'Feature';
            break;

        case 'themes':
            if ($namespaced) return '\App\Models\Theme';
            else return 'Theme';
            break;
    }
    return null;
}

/**
 * Initialises a new blank assets array, keyed by the asset type.
 *
 * @param  bool  $isCharacter
 * @return array
 */
function createAssetsArray($isCharacter = false) {
    $keys = getAssetKeys($isCharacter);
    $assets = [];
    foreach($keys as $key) $assets[$key] = [];
    return $assets;
}

/**
 * Merges 2 asset arrays.
 *
 * @param  array  $first
 * @param  array  $second
 * @return array
 */
function mergeAssetsArrays($first, $second, $isCharacter = false)
{
    $keys = getAssetKeys($isCharacter);
    foreach($keys as $key)
        foreach($second[$key] as $item)
            addAsset($first, $item['asset'], $item['quantity']);
        foreach($second[$key] as $award)
            addAsset($first, $award['asset'], $award['quantity']);
    return $first;
}

/**
 * Adds an asset to the given array.
 * If the asset already exists, it adds to the quantity.
 *
 * @param  array  $array
 * @param  mixed  $asset
 * @param  int    $quantity
 */

function addAsset(&$array, $asset, $quantity = 1) {
    if (!$asset) {
        return;
    }
    if (isset($array[$asset->assetType][$asset->id])) {
        $array[$asset->assetType][$asset->id]['quantity'] += $quantity;
    } else {
        $array[$asset->assetType][$asset->id] = ['asset' => $asset, 'quantity' => $quantity];
    }
}

/**
 * Get a clean version of the asset array to store in the database,
 * where each asset is listed in [id => quantity] format.
 * json_encode this and store in the data attribute.
 *
 * @param  array  $array
 * @param  bool   $isCharacter
 * @return array
 */
function getDataReadyAssets($array, $isCharacter = false) {
    $result = [];
    foreach($array as $key => $type)
    {
        if($type && !isset($result[$key])) $result[$key] = [];
        foreach($type as $assetId => $assetData)
        {
            $result[$key][$assetId] = $assetData['quantity'];
        }
    }
    return $result;
}

/**
 * Retrieves the data associated with an asset array,
 * basically reversing the above function.
 * Use the data attribute after json_decode()ing it.
 *
 * @param  array  $array
 * @return array
 */
function parseAssetData($array) {
    $assets = createAssetsArray();
    foreach($array as $key => $contents)
    {
        $model = getAssetModelString($key);
        if($model)
        {
            foreach($contents as $id => $quantity)
            {
                $assets[$key][$id] = [
                    'asset' => $model::find($id),
                    'quantity' => $quantity
                ];
            }

        }
    }
    return $assets;
}

/**
 * Distributes the assets in an assets array to the given recipient (user).
 * Loot tables will be rolled before distribution.
 *
 * @param  array                  $assets
 * @param  \App\Models\User\User  $sender
 * @param  \App\Models\User\User  $recipient
 * @param  string                 $logType
 * @param  string                 $data
 * @return array
 */
function fillUserAssets($assets, $sender, $recipient, $logType, $data) {
    // Roll on any loot tables

    if (isset($assets['loot_tables'])) {
        foreach ($assets['loot_tables'] as $table) {
            $assets = mergeAssetsArrays($assets, $table['asset']->roll($table['quantity'], $recipient ?? null));
        }
        unset($assets['loot_tables']);
    }

    foreach($assets as $key => $contents)
    {
        if($key == 'items' && count($contents))
        {
            $service = new \App\Services\InventoryManager;
            foreach($contents as $asset)
                if(!$service->creditItem($sender, $recipient, $logType, $data, $asset['asset'], $asset['quantity'])) return false;
        }
        elseif($key == 'awards' && count($contents))
        {
            $service = new \App\Services\AwardCaseManager;
            foreach($contents as $asset)
                if(!$service->creditAward($sender, $recipient, $logType, $data, $asset['asset'], $asset['quantity'])) return false;
        }
        elseif($key == 'currencies' && count($contents))
        {
            $service = new \App\Services\CurrencyManager;
            foreach($contents as $asset)
                if(!$service->creditCurrency($sender, $recipient, $logType, $data['data'], $asset['asset'], $asset['quantity'])) return false;
        }
        elseif($key == 'pets' && count($contents))
        {
            $service = new \App\Services\PetManager;
            foreach($contents as $asset)
                if(!$service->creditPet($sender, $recipient, $logType, $data, $asset['asset'], $asset['quantity'])) return false;
        }
        elseif($key == 'gears' && count($contents))
        {
            $service = new \App\Services\Claymore\GearManager;
            foreach($contents as $asset)
                if(!$service->creditGear($sender, $recipient, $logType, $data, $asset['asset'], $asset['quantity'])) return false;
        }
        elseif($key == 'weapons' && count($contents))
        {
            $service = new \App\Services\Claymore\WeaponManager;
            foreach($contents as $asset)
                if(!$service->creditWeapon($sender, $recipient, $logType, $data, $asset['asset'], $asset['quantity'])) return false;
        }
        elseif($key == 'raffle_tickets' && count($contents))
        {
            $service = new \App\Services\RaffleManager;
            foreach($contents as $asset)
                if(!$service->addTicket($recipient, $asset['asset'], $asset['quantity'])) return false;
        }
        elseif($key == 'user_items' && count($contents))
        {
            $service = new \App\Services\InventoryManager;
            foreach($contents as $asset)
                if(!$service->moveStack($sender, $recipient, $logType, $data, $asset['asset'], $asset['quantity'])) return false;
        }
        elseif($key == 'user_awards' && count($contents))
        {
            $service = new \App\Services\AwardCaseManager;
            foreach($contents as $asset)
                if(!$service->moveStack($sender, $recipient, $logType, $data, $asset['asset'])) return false;
        }
        elseif($key == 'characters' && count($contents))
        {
            $service = new \App\Services\CharacterManager;
            foreach($contents as $asset)
                if(!$service->moveCharacter($asset['asset'], $recipient, $data, $asset['quantity'], $logType)) return false;
        }
        else if ($key == 'themes' && count($contents))
        {
            $service = new \App\Services\ThemeManager;
            foreach ($contents as $asset)
                if (!$service->creditTheme($recipient, $asset['asset'])) return false;
        }
        if($key == 'recipes' && count($contents))
        {
            $service = new \App\Services\RecipeService;
            foreach($contents as $asset)
                if(!$service->creditRecipe($sender, $recipient, null, $logType, $data, $asset['asset'])) return false;
        }
    }
    return $assets;
}

/**
 * Distributes the assets in an assets array to the given recipient (character).
 * Loot tables will be rolled before distribution.
 *
 * @param  array                            $assets
 * @param  \App\Models\User\User            $sender
 * @param  \App\Models\Character\Character  $recipient
 * @param  string                           $logType
 * @param  string                           $data
 * @return array
 */

function fillCharacterAssets($assets, $sender, $recipient, $logType, $data, $submitter = null) {
    if (!Config::get('lorekeeper.extensions.character_reward_expansion.default_recipient') && $recipient->user) {
        $item_recipient = $recipient->user;
    } else {
        $item_recipient = $submitter;
    }

    // Roll on any loot tables
    if(isset($assets['loot_tables']))
    {
        foreach($assets['loot_tables'] as $table)
        {
            $assets = mergeAssetsArrays($assets, $table['asset']->roll($table['quantity'], true, $recipient), true);
        }
        unset($assets['loot_tables']);
    }

    foreach($assets as $key => $contents)
    {
        if($key == 'currencies' && count($contents))
        {
            $service = new \App\Services\CurrencyManager;
            foreach($contents as $asset)
                if(!$service->creditCurrency($sender, ( $asset['asset']->is_character_owned ? $recipient : $item_recipient), $logType, $data['data'], $asset['asset'], $asset['quantity'])) return false;
        }
        elseif($key == 'items' && count($contents))
        {
            $service = new \App\Services\InventoryManager;
            foreach($contents as $asset)
                if(!$service->creditItem($sender, ( ($asset['asset']->category && $asset['asset']->category->is_character_owned) ? $recipient : $item_recipient), $logType, $data, $asset['asset'], $asset['quantity'])) return false;
        }
        elseif($key == 'awards' && count($contents))
        {
            $service = new \App\Services\AwardCaseManager;
            foreach($contents as $asset)
                if(!$service->creditAward($sender, ( $asset['asset']->is_character_owned ? $recipient : $item_recipient), $logType, $data, $asset['asset'], $asset['quantity'])) return false;
        }
        elseif($key == 'statuses' && count($contents))
        {
            $service = new \App\Services\StatusEffectManager;
            foreach($contents as $asset)
                if(!$service->creditStatusEffect($sender, $recipient, $logType, $data['data'], $asset['asset'], $asset['quantity'])) return false;
        }
        elseif($key == 'features' && count($contents))
        {
            //just directly create the traits on the characterfeature model
            //myos cant be submitted for prompts so character_type is always Character
            foreach($contents as $asset)
                if(!\App\Models\Character\CharacterFeature::create(['character_image_id' => $recipient->image->id, 'feature_id' => $asset['asset']->id, 'feature_data' => null, 'character_type' => 'Character'])) return false;
        }
    }
    return $assets;
}

/**
 * Rolls on a loot-table esque rewards setup.
 */
function rollRewards($loot, $quantity = 1)
{
    $rewards = createAssetsArray();

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

        if($result) {
            // If this is chained to another loot table, roll on that table
            if($result->rewardable_type == 'LootTable') $rewards = mergeAssetsArrays($rewards, $result->reward->roll($result->quantity));
            elseif($result->rewardable_type == 'ItemCategory' || $result->rewardable_type == 'ItemCategoryRarity') $rewards = mergeAssetsArrays($rewards, rollCategory($result->rewardable_id, $result->quantity, (isset($result->data['criteria']) ? $result->data['criteria'] : null), (isset($result->data['rarity']) ? $result->data['rarity'] : null)));
            elseif($result->rewardable_type == 'ItemRarity') $rewards = mergeAssetsArrays($rewards, rollRarityItem($result->quantity, $result->data['criteria'], $result->data['rarity']));
            else addAsset($rewards, $result->reward, $result->quantity);
        }
    }
    return $rewards;
}

/**
 * Rolls on an item category.
 *
 * @param  int    $id
 * @param  int    $quantity
 * @param  string $condition
 * @param  string $rarity
 * @return \Illuminate\Support\Collection
 */
function rollCategory($id, $quantity = 1, $criteria = null, $rarity = null)
{
    $rewards = createAssetsArray();

    if(isset($criteria) && $criteria && isset($rarity) && $rarity) {
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

        if($result) {
            // If this is chained to another loot table, roll on that table
            addAsset($rewards, $result, 1);
        }
    }
    return $rewards;
}

/**
 * Rolls on an item rarity.
 *
 * @param  int    $quantity
 * @param  string $condition
 * @param  string $rarity
 * @return \Illuminate\Support\Collection
 */
function rollRarityItem($quantity = 1, $criteria, $rarity)
{
    $rewards = createAssetsArray();

    if(Config::get('lorekeeper.extensions.item_entry_expansion.loot_tables.alternate_filtering')) $loot = Item::released()->whereNotNull('data')->where('data->rarity', $criteria, $rarity)->get();
    else $loot = Item::released()->whereNotNull('data')->whereRaw('JSON_EXTRACT(`data`, \'$.rarity\')'. $criteria . $rarity)->get();
    if(!$loot->count()) throw new \Exception('There are no items to select from!');

    $totalWeight = $loot->count();

    for($i = 0; $i < $quantity; $i++)
    {
        $roll = mt_rand(0, $totalWeight - 1);
        $result = $loot[$roll];

        if($result) {
            // If this is chained to another loot table, roll on that table
            addAsset($rewards, $result, 1);
        }
    }
    return $rewards;
}

/*
 * Creates a rewards string from an asset array.
 *
 * @param array $array
 *
 * @return string
 */
function createRewardsString($array) {
    $string = [];
    foreach ($array as $key => $contents) {
        foreach ($contents as $asset) {
            $string[] = $asset['quantity'].$asset['asset']->displayName;
        }
    }
    if (!count($string)) {
        return 'Nothing. :('; // :(
    }

    if (count($string) == 1) {
        return implode(', ', $string);
    }

    return implode(', ', array_slice($string, 0, count($string) - 1)).(count($string) > 2 ? ', and ' : ' and ').end($string);
}

function encodeForDataColumn($data) {
    // The data will be stored as an asset table, json_encode()d.
    // First build the asset table, then prepare it for storage.
    $assets = createAssetsArray();
    foreach ($data['rewardable_type'] as $key => $r) {
        switch ($r) {
            case 'Item':
                $type = 'App\Models\Item\Item';
                break;
            case 'Currency':
                $type = 'App\Models\Currency\Currency';
                break;
            case 'LootTable':
                $type = 'App\Models\Loot\LootTable';
                break;
            case 'Raffle':
                $type = 'App\Models\Raffle\Raffle';
                break;
        }
        $asset = $type::find($data['rewardable_id'][$key]);
        addAsset($assets, $asset, $data['quantity'][$key]);
    }
    $assets = getDataReadyAssets($assets);

    return json_encode($assets);
}

function getRewardsString($rewards) {
    $result_elements = [];
    foreach ($rewards as $assetType) {
        if (isset($assetType)) {
            foreach ($assetType as $asset) {
                array_push($result_elements, $asset['quantity'])." ".$asset['asset']->name . (class_basename($asset['asset']) == 'Raffle' ? ' (Raffle Ticket)' : '');
            }
        }
    }
    return implode(', ', $result_elements);
}
