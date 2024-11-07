<?php

namespace App\Models;

use Config;
use DB;
use App\Models\Model;

use App\Models\User\User;
use App\Models\Character\Character;

class WishingWell extends Model
{
    /**
     * The attributes that are mass assignable. 
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'amount', 'last_wish', 'item_id'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wishingwell';

    /**
     * Validation rules for creation.
     *
     * @var array
     */
    public static $createRules = [
        'user_id' => 'required|between:1,10',
        'amount' => 'nullable',
    ];

    /**
     * Validation rules for updating.
     *
     * @var array
     */
    public static $updateRules = [
        'user_id' => 'required|between:1,10',
        'amount' => 'nullable',
    ];

    /**********************************************************************************************

        RELATIONS

    **********************************************************************************************/

    /**
     * Get the user the wish belongs to.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User\User', 'user_id');
    }


    /**
     * Get the item the wish granted.
     */
    public function item()
    {
        return $this->has('App\Models\Item\Item', 'item_id');
    }

    /**********************************************************************************************

        SCOPES

    **********************************************************************************************/

    /**
     * Scope a query to sort wishes by newest first.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortNewest($query)
    {
        return $query->orderBy('id', 'DESC');
    }

    /**
     * Scope a query to sort wishes by oldest first.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortOldest($query)
    {
        return $query->orderBy('id');
    }

    /**********************************************************************************************

        ACCESSORS

    **********************************************************************************************/

    /**
     * Displays the date of the wish as DD MMM, YYYY. Does not include time. 
     * Ex. 25 Aug, 2021
     *
     * @return string
     */
    public function getWishDateAttribute()
    {
        return $this->last_wish->format('d M, Y');
    }


    /**
     * Displays the user's name as a link to their page. 
     * @return string
     */
    public function getUserNameAttribute()
    { 
        return $this->user->displayName;
    }


    /**********************************************************************************************

        OTHER FUNCTIONS

    **********************************************************************************************/
    /**
     * None right now, let us pray it stays that way.
     */
}
