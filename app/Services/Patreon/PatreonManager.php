<?php namespace App\Services\Patreon;

use App\Services\Service;

use DB;
use Carbon\Carbon;

use Patreon\API;
use Patreon\OAuth;

use App\Models\User\User;
use App\Models\User\UserItem;
use App\Models\Item\Item;
use App\Models\Currency\Currency;
use App\Models\Loot\LootTable;
use App\Models\Raffle\Raffle;
use App\Models\Character\Character;
use App\Models\Character\CharacterItem;
use App\Services\InventoryManager;
use App\Services\CurrencyManager;

use App\Models\User\UserPatreon;
use App\Models\User\PatreonReward;

class PatreonManager extends Service
{
    /**
     * first time link
     */
    public function link($user, $patron, $accessToken, $refreshToken)
    {
        DB::beginTransaction();

        try {

            if(!is_array($patron)) throw new \Exception('No data found.');
            if(!array_key_exists('included', $patron)) throw new \Exception('You are not a patron.');
            // getting info
            $data = $this->getInfo($patron);

            $user->patreon()->update([
                'pledge_start' => carbon::parse($data['pledge_start']),
                'last_charge_date' => $data['last_paid'] == null ? null : carbon::parse($data['last_paid']),
                'patron_status' => $data['status'],
                'last_charge_status' => $data['last_status'],
                'membership' => $data['membership_type'],
                'avatar_url' => $data['avatar'],
                'access_token' =>  $accessToken,
                'refresh_token' => $refreshToken,
                'allow_login' => 0
            ]);

            return $this->commitReturn(true);
        } catch(\Exception $e) {
            $this->setError('error', $e->getMessage());
        }
        return $this->rollbackReturn(false);
    }

    /**
     * 
     * Refreshes
     * 
     */
    public function refresh($user)
    {
        DB::beginTransaction();

        try {
            
            $patron = $user->patreon;
            $refreshToken = $patron->refresh_token;
            $accessToken = $patron->access_token;

            
            if($accessToken)
            {
                $client = new API($accessToken);

                $patron = $client->fetch_user();
                // if $patron is a string and includes 'errors'
                if(is_string($patron) && strpos($patron, 'errors') !== false) {
                    $user->patreon()->update([
                        'allow_login' => 1
                    ]);
                    flash('Desync occured, we have set it so you can login to patreon again.')->error();
                    return $this->commitReturn(true);
                }
                if(is_string($patron) || !array_key_exists('included', $patron)) throw new \Exception('You are not a patron.');

                if(is_array($patron)) {
                    $data = $this->getInfo($patron);

                    $user->patreon()->update([
                        'pledge_start' => carbon::parse($data['pledge_start']),
                        'last_charge_date' => $data['last_paid'] == null ? null : carbon::parse($data['last_paid']),
                        'patron_status' => $data['status'],
                        'last_charge_status' => $data['last_status'],
                        'membership' => $data['membership_type'],
                        'avatar_url' => $data['avatar'],
                        'last_refresh' => Carbon::now()
                    ]);
                }
                // if patron could not be found
                else {
                    if(!$refreshToken) throw new \Exception('No valid tokens for refresh.');
                    $oAuth = new OAuth();

                    $refresh = $oAuth->refresh_token($refreshToken, 'http://127.0.0.1:8000/patreon/link');
                    //  getting new tokens
                    if(!is_array($refresh)) {
                        // set it so they can login again
                        $user->patreon()->update([
                            'allow_login' => 1
                        ]);
                        flash('Desync occured, we have set it so you can login to patreon again.')->error();
                    }
                    
                    $accessNewToken = $refresh['access_token'];
                    $refreshNewToken = $refresh['refresh_token'];

                    if(!$accessNewToken || !$refreshNewToken) throw new \Exception('Could not refresh tokens.');

                    // connecting again
                    $refreshClient = new API($accessNewToken);
                    $refreshPatron = $refreshClient->fetch_user();

                    if(!in_array('included', $refreshPatron)) throw new \Exception('You are not a patron.');

                    if(is_array($patron)) {
                        $data = $this->getInfo($refreshPatron);
    
                        $user->patreon()->update([
                            'pledge_start' => carbon::parse($data['pledge_start']),
                            'last_charge_date' => $data['last_paid'] == null ? null : carbon::parse($data['last_paid']),
                            'patron_status' => $data['status'],
                            'last_charge_status' => $data['last_status'],
                            'membership' => $data['membership_type'],
                            'avatar_url' => $data['avatar'],
                            'access_token' => $accessNewToken,
                            'refresh_token' => $refreshNewToken,
                            'last_refresh' => Carbon::now()
                        ]);
                    }
                    else {
                        $user->patreon()->update([
                            'allow_login' => 1
                        ]);
                        flash('Desync occured, we have set it so you can login to patreon again.')->error();
                        return $this->commitReturn(true);
                    }
                }
            }
            // if no access token, there should ALWAYS be an access token, but we'll add a safeguard anyways
            else {
                throw new \Exception('No access token.');
            }

            return $this->commitReturn($user);
        } catch(\Exception $e) { 
            $this->setError('error', $e->getMessage());
        }
        return $this->rollbackReturn(false);
    }

    /**
     * Refresh creator tokens
     */
    public function creatorRefresh($isCommand = false, $data) 
    {
        DB::beginTransaction();

        try {
            // CREATE in case command hasnt been ran
            if(!UserPatreon::where('user_id', 0)->first()) {
                $patreon = UserPatreon::create([
                    'user_id' => 0,
                    'access_token' => env('PATREON_ACCESS_TOKEN', null),
                    'refresh_token' => env('PATREON_REFRESH_TOKEN', null),
                    'last_refresh' => Carbon::now()
                ]);
            }

            $patreon = UserPatreon::where('user_id', 0)->first();
            // If no access tokens or refresh get from env and set.
            if(!isset($patreon->access_token, $patreon->refresh_token)) {
                $patreon->access_token = env('PATREON_ACCESS_TOKEN', null);
                $patreon->refresh_token = env('PATREON_REFRESH_TOKEN', null);
                $patreon->last_refresh = Carbon::now();
                $patreon->save();
            }

            if($isCommand || !isset($data['access']) && !isset($data['refresh_token'])) {
                // IF NO TOKENS SAVED
                if(!isset($patreon->access_token, $patreon->refresh_token))  throw new \Exception('No valid credentials saved.');

                $oauth = new OAuth(ENV('PATREON_CLIENT_ID'), ENV('PATREON_CLIENT_SECRET'));
                $refresh = $oauth->refresh_token($patreon->refresh_token, null);
                
                if(!isset($refresh['access_token']) || !isset($refresh['refresh_token'])) throw new \Exception('Could not refresh tokens. This means you will have to manually regenerate.');

                $patreon->access_token = $refresh['access_token'];
                $patreon->refresh_token = $refresh['refresh_token'];
                $patreon->last_refresh = Carbon::now();
                $patreon->save();
            }
            elseif($data) {
                //////////////////////

                $patreon->access_token = $data['access'];
                $patreon->refresh_token = $data['refresh'];
                $patreon->last_refresh = Carbon::now();
                $patreon->save();

                //////////////////////
            }
            else throw new \Exception('Error occurred.');
            return $this->commitReturn($patreon);
        } catch(\Exception $e) { 
            $this->setError('error', $e->getMessage());
        }
        return $this->rollbackReturn(false);
    }

    /**
     * Gets info - extra code reduction
     */
    private function getInfo($patron)
    {
        $data = [];
        // getting info
        $data['pledge_start'] = $patron['included'][0]['attributes']['pledge_relationship_start'];
        $data['status'] = $patron['included'][0]['attributes']['patron_status'];
        $data['last_paid'] = $patron['included'][0]['attributes']['last_charge_date'];
        $data['last_status'] = $patron['included'][0]['attributes']['last_charge_status'];
        $data['avatar'] = $patron['data']['attributes']['image_url'];
        $data['membership_type'] = $patron['included'][0]['attributes']['currently_entitled_amount_cents'];

        return $data;
    }

    /**
     * Claims
     */
    public function claim($user)
    {
        DB::beginTransaction();

        try {

            $month = Carbon::now()->month;
            $rawRewards = PatreonReward::where('month', $month)->where(function ($query) use($user) {
                $query->where('lock_tier', 0)->where('tier', '<=', $user->patreon->membership)
                      ->orWhere('lock_tier', 1)->where('tier', $user->patreon->membership);
            })->get(['rewardable_id', 'rewardable_type', 'quantity']);

            if(!$rawRewards) throw new \Exception('No rewards for this month!');
            // get rewards in a format we can use
            $processedRewards = [];
            foreach($rawRewards as $raw)
            {
                $processedRewards['rewardable_type'][] = $raw->rewardable_type;
                $processedRewards['rewardable_id'][] = $raw->rewardable_id;
                $processedRewards['quantity'][] = $raw->quantity;
            }

            $rewards = $this->processRewards($processedRewards, true);

            $logType = 'Patreon Rewards';
            $data = [
                'data' => 'Received rewards for pledging'
            ];

            if(!$rewards = fillUserAssets($rewards, null, $user, $logType, $data)) throw new \Exception("Failed to distribute rewards to user.");

            $user->patreon->has_claimed = 1;
            $user->patreon->save();

            return $this->commitReturn(true);
        } catch(\Exception $e) {
            $this->setError('error', $e->getMessage());
        }
        return $this->rollbackReturn(false);
    }

    /**
     * Processes reward data into a format that can be used for distribution.
     *
     * @param  array $data
     * @param  bool  $isCharacter
     * @param  bool  $isStaff
     * @return array
     */
    private function processRewards($data, $isStaff = false)
    {
        $assets = createAssetsArray(false);
        // Process the additional rewards

        if(isset($data['rewardable_type']) && $data['rewardable_type'])
        {
            foreach($data['rewardable_type'] as $key => $type)
            {
                $reward = null;
                switch($type)
                {
                    case 'Item':
                        $reward = Item::find($data['rewardable_id'][$key]);
                        break;
                    case 'Currency':
                        $reward = Currency::find($data['rewardable_id'][$key]);
                        if(!$reward->is_user_owned) throw new \Exception("Invalid currency selected.");
                        break;
                    case 'LootTable':
                        if (!$isStaff) break;
                        $reward = LootTable::find($data['rewardable_id'][$key]);
                        break;
                    case 'Raffle':
                        if (!$isStaff) break;
                        $reward = Raffle::find($data['rewardable_id'][$key]);
                        break;
                }
                if(!$reward) continue;
                addAsset($assets, $reward, $data['quantity'][$key]);
            }
        }
        return $assets;
    }
}