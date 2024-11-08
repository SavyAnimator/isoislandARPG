<?php namespace App\Models\Raffle;

use App\Models\Model;
use DB;

class RaffleGroup extends Model {
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'is_active'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'raffle_groups';

    /**
     * Whether the model contains timestamps to be saved and updated.
     *
     * @var string
     */
    public $timestamps = false; 


    /**********************************************************************************************
    
        RELATIONS

    **********************************************************************************************/

    /**
     * Get the raffles in this group.
     */
    public function raffles() {
        return $this->hasMany('App\Models\Raffle\Raffle', 'group_id')->orderBy('order');
    }
}
