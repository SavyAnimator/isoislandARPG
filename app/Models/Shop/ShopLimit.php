<?php

namespace App\Models\Shop;

use Config;
use App\Models\Model;

class ShopLimit extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'shop_id', 'item_id'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'shop_limits';

    /**********************************************************************************************

        RELATIONS

    **********************************************************************************************/

    public function item()
    {
        return $this->belongsTo('App\Models\Item\Item', 'item_id');
    }


    /*Failed attempt to gatekeep garden behind stuff*/

    /*if($shop->is_restricted) {
        foreach($shop->limits as $limit)
        {
            $item = $limit->item_id;
            $check = UserItem::where('item_id', $item)->where('user_id', auth::user()->id)->where('count', '>', 0)->first();

            if(!$check) {
                flash('You require a ' . $limit->item->name . ' to enter this store.') ->error();
                return redirect()->to('/shops');
            }
        }
    }*/
}
