<?php

namespace App\Models\User;

use App\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GardenPlot extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'currency_id', 'free', 'plot_cost', 'plot_type'
    ];

    /**
     * Whether the model contains timestamps to be saved and updated.
     *
     * @var string
     */
    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'garden_plots';

    /**********************************************************************************************
    
        RELATIONS

    **********************************************************************************************/

    /**
     * Get the user who owns the stack.
     */
    public function currency() 
    {
        return $this->belongsTo('App\Models\Currency\Currency');
    }

    /**********************************************************************************************
    
        ATTRIBUTES

    **********************************************************************************************/

    /**
     * Returns the panel title for the plot type
     */
    public function getPanelTitleAttribute()
    {
        switch($this->plot_type) {
            case 'Apiary':
                return 'Hive Boxes';
            case 'Pond':
                return 'Pond Pools';
            case 'Garden':
                return 'Plots';
            default:
                return 'Plots';
        }
    }

    /**
     * Gets the background image for the plot type
     */
    public function getBackgroundImageAttribute()
    {
        switch($this->plot_type) {
            case 'Apiary':
                return 'images/garden/croop_bg.png';
            case 'Pond':
                return 'images/garden/barn_bg.png';
            case 'Seed':
                return 'images/garden/crops_bg.png';
            default:
                return 'images/garden/crops_bg.png';
        }
    }

    /**
     * Returns the item titles for those that can be placed in the plot
     */
    public function getItemTitleAttribute()
    {
        switch($this->plot_type) {
            case 'Apiary':
                return 'Coop Store';
            case 'Pond':
                return 'Barn Pastures';
            case 'Seed':
                return 'Seeds';
            default:
                return 'Seeds';
        }
    }

    public function getIsFreeAttribute()
    {
        if($this->free) return True;
        if(!$this->currency_id) return True;
        return False;
    }
}
