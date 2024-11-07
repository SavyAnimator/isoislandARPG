<?php

namespace App\Models\Character;

use Auth;

use App\Models\Model;

use App\Models\Character\Character;

class CharacterLineage extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'character_id',         'character_name',
        'sire_id',              'sire_name',
        'sire_sire_id',         'sire_sire_name',
        'sire_sire_sire_id',    'sire_sire_sire_name',
        'sire_sire_dam_id',     'sire_sire_dam_name',
        'sire_dam_id',          'sire_dam_name',
        'sire_dam_sire_id',     'sire_dam_sire_name',
        'sire_dam_dam_id',      'sire_dam_dam_name',
        'dam_id',               'dam_name',
        'dam_sire_id',          'dam_sire_name',
        'dam_sire_sire_id',     'dam_sire_sire_name',
        'dam_sire_dam_id',      'dam_sire_dam_name',
        'dam_dam_id',           'dam_dam_name',
        'dam_dam_sire_id',      'dam_dam_sire_name',
        'dam_dam_dam_id',       'dam_dam_dam_name',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'character_lineages';

    // test
    private $unknown = "Unknown";

    /*
     * ASSOCIATING THE FAMILY CHARACTER MODELS
     */

    public function sire()
    {
        return $this->belongsTo('App\Models\Character\Character');
    }

    public function sire_sire()
    {
        return $this->belongsTo('App\Models\Character\Character');
    }

    public function sire_sire_sire()
    {
        return $this->belongsTo('App\Models\Character\Character');
    }

    public function sire_sire_dam()
    {
        return $this->belongsTo('App\Models\Character\Character');
    }

    public function sire_dam()
    {
        return $this->belongsTo('App\Models\Character\Character');
    }

    public function sire_dam_sire()
    {
        return $this->belongsTo('App\Models\Character\Character');
    }

    public function sire_dam_dam()
    {
        return $this->belongsTo('App\Models\Character\Character');
    }

    public function dam()
    {
        return $this->belongsTo('App\Models\Character\Character');
    }

    public function dam_sire()
    {
        return $this->belongsTo('App\Models\Character\Character');
    }

    public function dam_sire_sire()
    {
        return $this->belongsTo('App\Models\Character\Character');
    }

    public function dam_sire_dam()
    {
        return $this->belongsTo('App\Models\Character\Character');
    }

    public function dam_dam()
    {
        return $this->belongsTo('App\Models\Character\Character');
    }

    public function dam_dam_sire()
    {
        return $this->belongsTo('App\Models\Character\Character');
    }

    public function dam_dam_dam()
    {
        return $this->belongsTo('App\Models\Character\Character');
    }

    /**
     * Gets the display URL and/or name of an ancestor, or "Unknown" if there is none
     * @param   string  $ancestor
     * @return  string
     */
    public function getDisplayName($ancestor)
    {
        if(isset($this[$ancestor.'_id']) && $this[$ancestor])
            return $this[$ancestor]->getDisplayNameAttribute();

        if(isset($this[$ancestor.'_name']) && $this[$ancestor.'_name'])
            return $this[$ancestor.'_name'];

        return "Unknown";
    }


    /**
     * Gets characters with this character as their sire or dam
     *
     * @return array
     */
    public static function getChildrenStatic($id, $limit = false)
    {
        // Get the id numbers of the children.
        $ids = CharacterLineage::where('sire_id', $id)->orWhere('dam_id', $id)
                ->pluck('character_id')->toArray();
        return CharacterLineage::filterDescendants($ids, $limit);
    }

    /**
     * Gets characters with this character as their grand-sire or -dam
     *
     * @return array
     */
    public static function getGrandchildrenStatic($id, $limit = false)
    {
        // Get the id numbers of the children.
        $ids = CharacterLineage::where('sire_sire_id', $id)
                ->orWhere('sire_dam_id', $id)
                ->orWhere('dam_sire_id', $id)
                ->orWhere('dam_dam_id', $id)
                ->pluck('character_id')->toArray();
        return CharacterLineage::filterDescendants($ids, $limit);
    }

    /**
     * Gets characters with this character as their grand-sire or -dam
     *
     * @return array
     */
    public static function getGreatGrandchildrenStatic($id, $limit = false)
    {
        // Get the id numbers of the children.
        $ids = CharacterLineage::where('sire_sire_sire_id', $id)
                ->orWhere('sire_sire_dam_id', $id)
                ->orWhere('sire_dam_sire_id', $id)
                ->orWhere('sire_dam_dam_id', $id)
                ->orWhere('dam_sire_sire_id', $id)
                ->orWhere('dam_sire_dam_id', $id)
                ->orWhere('dam_dam_sire_id', $id)
                ->orWhere('dam_dam_dam_id', $id)
                ->pluck('character_id')->toArray();
        return CharacterLineage::filterDescendants($ids, $limit);
    }

    /**
     * Gets filtered descendants from id array
     *
     * @return array
     */
    public static function getFilteredDescendants($children_ids)
    {
        return Character::whereIn('characters.id', $children_ids)
            ->where('characters.is_visible', true)
            ->where(function($query) {
                $query->whereNull('character_category_id')
                      ->orWhereNotIn('character_category_id', CharacterLineageBlacklist::getBlacklistCategories(true));
            })
            ->whereNotIn('rarity_id', CharacterLineageBlacklist::getBlacklistRarities(true))
            ->join('character_images', 'characters.character_image_id', '=', 'character_images.id')
            ->where(function($query) {
                $query->whereNull('species_id')
                      ->orWhereNotIn('species_id', CharacterLineageBlacklist::getBlacklistSpecies(true));
            })
            ->where(function($query) {
                $query->whereNull('subtype_id')
                      ->orWhereNotIn('subtype_id', CharacterLineageBlacklist::getBlacklistSubtypes(true));
            })
            ->orderBy('is_myo_slot', 'asc');
    }

    /**
     * Gets filtered descendants from id array
     *
     * @return array
     */
    public static function filterDescendants($ids, $limit)
    {
        // If null or 0, return null.
        if ($ids == null || count($ids) < 1) return null;

        // Find characters matching those ids.
        $children = Character::whereIn('id', $ids);
        if(!Auth::check() || !(Auth::check() && Auth::user()->hasPower('manage_characters'))) $children->where('is_visible', true);

        // Sort, limit and return.
        $children->orderBy('is_myo_slot', 'asc')->orderBy('id', 'desc');
        if($limit) $children->limit(4);
        return $children->get();
    }

    # -------------------------------------------------------------------------------------
    #   MODEL LINKS
    # -------------------------------------------------------------------------------------

    /**
     * Gets the character this lineage is linked to.
     * @return App\Models\Character\Character
     */
    public function character()
    {
        return $this->belongsTo('App\Models\Character\Character', "character_id", "id");
    }

    /**
     * Gets the lineage links where this character is the child.
     * @return App\Models\Character\CharacterLineageLink
     */
    public function parents()
    {
        return $this->hasMany('App\Models\Character\CharacterLineageLink', "lineage_id", "id");
    }

    /**
     * Gets the lineage links where this character is the parent.
     * WARNING: Will show hidden characters, use getChildren() instead.
     *
     * @return App\Models\Character\CharacterLineageLink
     */
    public function children()
    {
        return $this->hasMany('App\Models\Character\CharacterLineageLink', "parent_lineage_id", "id");
    }

    # -------------------------------------------------------------------------------------
    #   RELATIVES
    # -------------------------------------------------------------------------------------

    /**
     * Gets the lineage links where the child character (if there is one) is visible to the user.
     *
     * @return App\Models\Character\CharacterLineageLink
     */
    public function getChildren()
    {
        return $this->getFiltered($this->children);
    }

    /**
     * Finds visible grandchildren of this character lineage.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getGrandchildren()
    {
        // Get the CHILDREN
        $children = $this->getChildren();
        if ($children != null) $children = $children->pluck('lineage_id')->toArray();
        if (count($children) == 0) return null;

        // Get the CHILDREN of the CHILDREN
        $gchl = CharacterLineageLink::whereIn('parent_lineage_id', $children);
        return $this->getGroupFiltered($gchl);
    }

    /**
     * Finds visible great-grandchildren of this character lineage.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getGreatGrandchildren()
    {
        // Get the GRANDCHILDREN
        $gchl = $this->getGrandchildren()->pluck('lineage_id')->toArray();
        if (count($gchl) == 0) return null;

        // Get the CHILDREN of the GRANDCHILDREN
        $ggc = CharacterLineageLink::whereIn('parent_lineage_id', $gchl);
        return $this->getGroupFiltered($ggc);
    }

    /**
     * Gets the lineage links where the parent character (if there is one) is visible to the user.
     *
     * @return App\Models\Character\CharacterLineageLink
     */
    public function getParents()
    {
        return $this->getFiltered($this->parents, true);
    }

    /**
     * Finds visible grandparents of this character lineage.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getGrandparents()
    {
        // Get the PARENTS
        $parents = $this->getParents()->pluck('parent_lineage_id')->toArray();
        if (count($parents) == 0) return null;

        // Get the PARENTS of the PARENTS
        $gps = CharacterLineageLink::whereIn('lineage_id', $parents);
        return $this->getGroupFiltered($gps, true);
    }

    /**
     * Finds visible great-grandparents of this character lineage.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getGreatGrandparents()
    {
        // Get the GRANDPARENTS
        $gps = $this->getGrandparents();
        if ($gps != null) $gps = $gps->pluck('parent_lineage_id')->toArray();
        if ($gps == null || count($gps) == 0) return null;

        // Get the PARENTS of the GRANDPARENTS
        $greats = CharacterLineageLink::whereIn('lineage_id', $gps);
        return $this->getGroupFiltered($greats, true);
    }

    /**
     * Finds visible siblings of this character lineage.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getSiblings()
    {
        // Get the PARENTS
        $parents = $this->getParents()->pluck('parent_lineage_id')->toArray();
        if (!$this->getParents()->count()) return null;

        // Get the CHILDREN of the PARENTS
        $sibs = CharacterLineageLink::where('lineage_id', "!=", $this->id)->whereIn('parent_lineage_id', $parents);
        return $this->getGroupFiltered($sibs);
    }

    /**
     * Finds visible niblings of this character lineage.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getNiblings()
    {
        // Get the SIBLINGS
        $sibs = $this->getSiblings();
        if ($sibs != null) $sibs = $sibs->pluck('lineage_id')->toArray();
        if ($sibs == null || count($sibs) == 0) return null;

        // Get the CHILDREN of the SIBLINGS
        $nibs = CharacterLineageLink::whereIn('parent_lineage_id', $sibs);
        return $this->getGroupFiltered($nibs);
    }

    /**
     * Finds visible auncles of this character lineage.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getAuntsUncles()
    {
        // Get the PARENTS
        $parents = $this->getParents()->pluck('parent_lineage_id')->toArray();
        if (count($parents) == 0) return null;

        // Get the PARENTS of the PARENTS
        $gps = $this->getGrandparents()->pluck('parent_lineage_id')->toArray();
        if (count($gps) == 0) return null;

        // Get the SIBLINGS of the PARENTS
        $auns = CharacterLineageLink::whereNotIn('lineage_id', $parents)->whereIn('parent_lineage_id', $gps);
        return $this->getGroupFiltered($auns);
    }

    /**
     * Finds visible cousins of this character lineage.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getCousins()
    {
        // Get the AUNCLES
        $auns = $this->getAuntsUncles();
        if ($auns != null) $auns = $auns->pluck('lineage_id')->toArray();
        if ($auns == null || count($auns) == 0) return null;

        // Get the CHILDREN of the AUNCLES
        $cous = CharacterLineageLink::whereIn('parent_lineage_id', $auns);
        return $this->getGroupFiltered($cous);
    }

    # -------------------------------------------------------------------------------------
    #   HELPERS
    # -------------------------------------------------------------------------------------

    /**
     * Filters LineageLinks to get only visible ones.
     *
     * @param   Illuminate\Database\Eloquent\Collection
     * @param   bool
     * @return  Illuminate\Database\Eloquent\Collection
     */
    public static function getFiltered($collection, $parent = false)
    {
        $col = ($parent ? 'parent_' : '').'lineage_id';
        $ids = CharacterLineage::getInvisiblesFromIds($collection->pluck($col)->toArray());
        return $collection->whereNotIn($col, $ids);
    }

    /**
     * Filters LineageLinks to get only visible ones, grouped to hide duplicates.
     *
     * @param   Illuminate\Database\Eloquent\Collection
     * @param   bool
     * @return  Illuminate\Database\Eloquent\Collection
     */
    public static function getGroupFiltered($collection, $parent = false)
    {
        $col = ($parent ? 'parent_' : '').'lineage_id';
        return CharacterLineage::getFiltered($collection, $parent)->select($col)->groupBy($col);
    }

    /**
     * Filters a list of CharacterLineage ids to find ones the user isn't supposed to see.
     *
     * @param   array
     * @return  array
     */
    public static function getInvisiblesFromIds($ids)
    {
        if (!is_array($ids)) return [];

        // Hide invisible children, if the User shouldn't be able to see them.
        if(!Auth::check() || !(Auth::check() && Auth::user()->hasPower('manage_characters'))) {
            return CharacterLineage::where('character_id', "!=", null)
                ->whereIn('character_lineages.id', $ids)
                ->join('characters', 'character_lineages.character_id', '=', 'characters.id')
                ->where('characters.is_visible', false)->pluck('character_lineages.id')->toArray();
        }

        // User has auth to see everything.
        return [];
    }

    # -------------------------------------------------------------------------------------
    #   ATTRIBUTES
    # -------------------------------------------------------------------------------------

    /**
     * Gets the name of this lineage character.
     * @return string
     */
    public function getNameAttribute()
    {
        if($this->character) return $this->character->full_name;
        return (!$this->character_name) ? "Unknown" : $this->character_name;
    }

    /**
     * Gets the character's page's URL, or the URL of a rogue entry.
     * @return string
     */
    public function getUrlAttribute()
    {
        if($this->character) return $this->character->url;
        return url('rogue/'.$this->id);
    }

    /**
     * Gets the URL of this lineage character.
     * @return string
     */
    public function getDisplayNameAttribute()
    {
        if($this->character) return $this->character->display_name;
        return "<a href='".$this->url."'>".$this->name."</a>";
    }

    /**
     * Gets the thumbnail image of this lineage character.
     * @return string
     */
    public function getThumbnailAttribute()
    {
        if($this->character) return $this->character->image->thumbnailUrl;
        return url('images/rogue.png');
    }
}
