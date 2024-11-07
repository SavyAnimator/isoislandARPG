<?php

namespace App\Models\User;

use Carbon\Carbon;
use App\Models\Model;

class UserPatreon extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'pledge_start', 'membership', 'last_charge_date', 'last_charge_status', 'patron_status', 'avatar_url', 'access_token', 'refresh_token',
        'last_refresh', 'has_claimed'
    ];

    /**
     * Whether the model contains timestamps to be saved and updated.
     *
     * @var string
     */
    public $dates = ['pledge_start', 'last_charge_date', 'last_refresh'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_patreons';

    /**
     * The primary key of the model.
     *
     * @var string
     */
    public $primaryKey = 'user_id';

    /**********************************************************************************************
    
        RELATIONS

    **********************************************************************************************/

    /**
     * Get the user who owns this info
     */
    public function user() 
    {
        return $this->belongsTo('App\Models\User\User');
    }

    /**********************************************************************************************
    
        ACCESSORS

    **********************************************************************************************/

    public function getAvatarAttribute()
    {
        if($this->avatar_url != null)
        return '<img src="' . $this->avatar_url . '" style="width:125px; height:125px; float:left; border-radius:50%; margin-right:25px;">';
        else return null;
    }

    public function checkIfDatePaidAttribute()
    {
        return Carbon::parse($this->last_charge_date)->isCurrentMonth();
    }
}
