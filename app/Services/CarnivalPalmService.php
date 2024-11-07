<?php namespace App\Services;

use App\Services\Service;

use DB;
use Config;

use App\Models\CarnivalPalm;
use App\Models\Character\Character;
use App\Models\User\User;
use App\Models\Currency\Currency;
use App\Models\Loot\LootTable;
use App\Models\Item\Item;

use App\Services\InventoryManager;

class CarnivalPalmService extends Service
{
    /*
    |--------------------------------------------------------------------------
    | Carnival Games Service
    |--------------------------------------------------------------------------
    |
    | Handles the creation and editing of One Palm games.
    |
    */

    /**********************************************************************************************

        GAME - One Palm

    **********************************************************************************************/

    /**
     * Creates a new game.
     *
     * @param  array                  $data
     * @return bool|\App\Models\CarnivalPalm
     */
    public function createPalm($data)
    {
        DB::beginTransaction();

        try {


            // Checks if the user has the necessary currency and debits them from their account.
            $user = User::where('id', $data['user_id'])->first();
            if(!(new CurrencyManager)->debitCurrency($user, null, 'Palm Reading', 'Try your Hand.', $user->getCurrencies()->first(), $data['amount'])) throw new \Exception("You check your seashells balance on hand. Seems you don't have as much as you remembered... You'll have to try again when you have more.");

            $data = $this->populateData($data);
            $palm = CarnivalPalm::create($data);
            $palm->last_game = now();
            $palm->save();

            if(!$loot = LootTable::find(182)) throw new \Exception('Unable to find reward for Palm Reading game. Please copy this message and submit a bug report for further assistance.');

            $assets = createAssetsArray(false);
            addAsset($assets, $loot, 1);

            $logType = 'Carnival Game - Palm Reading Reward';
            $data = [ 'data' => 'Received from game in the carnival.' ];

            if(!$rewards = fillUserAssets($assets, $user, $user, $logType, $data)) throw new \Exception("The Palm Reading game failed to produce a reward; please copy this message and submit a bug report further assistance.");

            $palm->reward = $this->getRewardsString($rewards);
            $palm->save();

            return $this->commitReturn($palm);
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
                        <i>Hestitantly you reach your paw over the pile of loot, hoping this queen memora does not swat your palm.</i>
                        <div class='card mt-3 align-items-center' style='width: 30%;'>
                            <div class='card-body align-items-center'><br>";
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
     * @param  \App\Models\CarnivalPalm  $palm
     * @param  array                  $data
     * @return bool|\App\Models\CarnivalPalm
     */
    public function updatePalm($palm, $data)
    {
        DB::beginTransaction();

        try {
            // Extra date validation to ensure no one pushes a request directly to the server.
            if(now()->diffInMinutes($palm->last_game, false) > 0) throw new \Exception("Woah, hold on speedy. Let others play this game too. Come back in a minute and you can play again.");

            // Checks if the user has the necessary coins and debits them from their account.
            $user = User::where('id', $data['user_id'])->first();
            if(!(new CurrencyManager)->debitCurrency($user, null, 'Palm Reading', 'Played Game.', $user->getCurrencies()->first(), $data['amount'])) throw new \Exception("You check your seashell satchel, but it seems emptier than you remember... You'll have to try again when you have more.");

            $data = $this->populateData($data);
            $palm->update($data);
            $palm->last_game = now();
            $palm->save();

            if(!$loot = LootTable::find(182)) throw new \Exception('Unable to find loot table. Please take a screenshot of this message and contact an admin for further assistance.');

            $assets = createAssetsArray(false);

            addAsset($assets, $loot, 1);

            $logType = 'Palm Reading Game Reward';
            $data = [ 'data' => 'Received from playing Palm Reading at the carnival.' ];

            if(!$rewards = fillUserAssets($assets, $user, $user, $logType, $data)) throw new \Exception("The game failed to produce a reward; please take a screenshot of this message and contact an admin for further assistance.");

            $palm->reward = $this->getRewardsString($rewards);
            $palm->save();

            return $this->commitReturn($palm);
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
