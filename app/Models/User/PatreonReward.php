<?php

namespace App\Models\User;

use Config;
use App\Models\Model;

class PatreonReward extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'month', 'rewardable_type', 'rewardable_id', 'quantity', 'tier', 'lock_tier'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'patreon_rewards';
    
    /**
     * Validation rules for creation.
     *
     * @var array
     */
    public static $createRules = [
        'rewardable_type' => 'required',
        'rewardable_id' => 'required',
        'quantity' => 'required',
    ];
    
    /**
     * Validation rules for updating.
     *
     * @var array
     */
    public static $updateRules = [
        'rewardable_type' => 'required',
        'rewardable_id' => 'required',
        'quantity' => 'required',
    ];

    /**********************************************************************************************
    
        RELATIONS

    **********************************************************************************************/
    
    /**
     * Get the reward attached to the prompt reward.
     */
    public function reward() 
    {
        switch ($this->rewardable_type)
        {
            case 'Item':
                return $this->belongsTo('App\Models\Item\Item', 'rewardable_id');
                break;
            case 'Currency':
                return $this->belongsTo('App\Models\Currency\Currency', 'rewardable_id');
                break;
            case 'LootTable':
                return $this->belongsTo('App\Models\Loot\LootTable', 'rewardable_id');
                break;
            case 'Raffle':
                return $this->belongsTo('App\Models\Raffle\Raffle', 'rewardable_id');
                break;
        }
        return null;
    }
}
