<?php namespace App\Services;

use App\Services\Service;

use DB;
use Config;

use App\Models\WishingWell;
use App\Models\Character\Character;
use App\Models\User\User;
use App\Models\Currency\Currency;
use App\Models\Loot\LootTable;
use App\Models\Item\Item;

use App\Services\InventoryManager;

class WishingWellService extends Service
{
    /*
    |--------------------------------------------------------------------------
    | Wishing Well Service
    |--------------------------------------------------------------------------
    |
    | Handles the creation and editing of wishes.
    |
    */

    /**********************************************************************************************

        WISHES

    **********************************************************************************************/

    /**
     * Creates a new wish.
     *
     * @param  array                  $data
     * @return bool|\App\Models\WishingWell
     */
    public function createWish($data)
    {
        DB::beginTransaction();

        try {


            // Checks if the user has the necessary currency and debits them from their account.
            $user = User::where('id', $data['user_id'])->first();
            if(!(new CurrencyManager)->debitCurrency($user, null, 'Wishful Well', 'Made a wish in the wishful well.', $user->getCurrencies()->first(), $data['amount'])) throw new \Exception("You check your seashells balance on hand. Seems you don't have as much as you remembered... You'll have to try again when you have more.");

            $data = $this->populateData($data);
            $wish = WishingWell::create($data);
            $wish->last_wish = now();
            $wish->save();

            if(!$loot = LootTable::find(22)) throw new \Exception('Unable to find reward. Please take a screenshot of this message and submit a bug report for further assistance.');

            $assets = createAssetsArray(false);
            addAsset($assets, $loot, 1);

            $logType = 'Wishful Well Reward';
            $data = [ 'data' => 'Received from making a wish in the wishful well.' ];

            if(!$rewards = fillUserAssets($assets, $user, $user, $logType, $data)) throw new \Exception("The well failed to produce a reward; please take a screenshot of this message and submit a bug report further assistance.");

            $wish->reward = $this->getRewardsString($rewards);
            $wish->save();

            return $this->commitReturn($wish);
        } catch(\Exception $e) {
            $this->setError('error', $e->getMessage());
        }
        return $this->rollbackReturn(false);
    }

     /**
     * Acts upon the item when used from the inventory.
     *
     * @param  array                  $rewards
     * @return string
     */
    private function getRewardsString($rewards)
    {
        $results = "<center>
                        <i>Your seashells slowly sink to the bottom of the well, leaving a trail of tiny bubbles beneath them... As you look back up from it's depths, you notice that something has appeared at the base of the well.</i>
                        <div class='card mt-3 align-items-center' style='width: 30%;'>
                            <div class='card-body align-items-center'>
                                <i class='text-muted'>You have received...</i><br>";
        $result_elements = [];
        foreach($rewards as $assetType)
        {
            if(isset($assetType))
            {
                foreach($assetType as $asset)
                {
                    //array_push($result_elements, "x".$asset['quantity']." ".$asset['asset']->name.(class_basename($asset['asset']) == 'Raffle' ? ' (Raffle Ticket)' : '')); currencyImageUrl
                    array_push($result_elements, "<img src='".($asset['asset']->image_url ? $asset['asset']->image_url : $asset['asset']->currencyImageUrl)."' style='max-height: 100px;'>"."<br>".$asset['quantity']." ".$asset['asset']->name.(class_basename($asset['asset']) == 'Raffle' ? ' (Raffle Ticket)' : '')."<br>");
                }
            }
        }
        return $results.implode('<br>', $result_elements)."</div></div></center>";
    }

    /**
     * Updates a wish.
     *
     * @param  \App\Models\WishingWell  $wish
     * @param  array                  $data
     * @return bool|\App\Models\WishingWell
     */
    public function updateWish($wish, $data)
    {
        DB::beginTransaction();

        try {
            // Extra date validation to ensure no one pushes a request directly to the server.
            if(now()->diffInDays($wish->last_wish, false) > -7) throw new \Exception("You try to throw more seashells into the well, but somehow they bounce off of the water's surface and onto the ground in front of you...");

            // Checks if the user has the necessary coins and debits them from their account.
            $user = User::where('id', $data['user_id'])->first();
            if(!(new CurrencyManager)->debitCurrency($user, null, 'Wishing Well', 'Made a wish in the wishing well.', $user->getCurrencies()->first(), $data['amount'])) throw new \Exception("You check your seashell satchel, but it seems emptier than you remember... You'll have to try again when you have more.");

            $data = $this->populateData($data);
            $wish->update($data);
            $wish->last_wish = now();
            $wish->save();

            if(!$loot = LootTable::find(22)) throw new \Exception('Unable to find loot table. Please take a screenshot of this message and contact an admin for further assistance.');

            $assets = createAssetsArray(false);

            addAsset($assets, $loot, 1);

            $logType = 'Wishful Well Reward';
            $data = [ 'data' => 'Received from making a wish in the wishful well.' ];

            if(!$rewards = fillUserAssets($assets, $user, $user, $logType, $data)) throw new \Exception("The well failed to produce a reward; please take a screenshot of this message and contact an admin for further assistance.");

            $wish->reward = $this->getRewardsString($rewards);
            $wish->save();

            return $this->commitReturn($wish);
        } catch(\Exception $e) {
            $this->setError('error', $e->getMessage());
        }
        return $this->rollbackReturn(false);
    }

    /**
     * Processes user input for creating/updating a pet.
     *
     * @param  array                  $data
     * @param  \App\Models\Pet\Pet  $pet
     * @return array
     */
    private function populateData($data)
    {
        if(isset($data['description']) && $data['description']) $data['parsed_description'] = parse($data['description']);
        return $data;
    }
}
