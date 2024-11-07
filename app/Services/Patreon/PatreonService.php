<?php namespace App\Services\Patreon;

use App\Services\Service;

use DB;
use Config;

use Illuminate\Support\Arr;


use App\Models\User\User;
use App\Models\User\UserPatreon;
use App\Models\User\PatreonReward;

class PatreonService extends Service
{

    public function createMonth($data)
    {
        DB::beginTransaction();

        try {

            $this->populateRewards($data);

            return $this->commitReturn(true);
        } catch(\Exception $e) {
            $this->setError('error', $e->getMessage());
        }
        return $this->rollbackReturn(false);
    }

    public function editMonth($id, $data)
    {
        DB::beginTransaction();

        try {

            $data['month'] = $id;

            $this->populateRewards($data);

            return $this->commitReturn(true);
        } catch(\Exception $e) {
            $this->setError('error', $e->getMessage());
        }
        return $this->rollbackReturn(false);
    }


    /**
     * Processes user input for creating/updating rewards.
     *
     * @param  array                      $data
     * @param  \App\Models\Prompt\Prompt  $prompt
     */
    private function populateRewards($data)
    {
        // Clear the old rewards...
        $rewards = PatreonReward::where('month', $data['month']);
        $rewards->delete();

        if(isset($data['rewardable_type'])) {
            foreach($data['rewardable_type'] as $key => $type)
            {
                if(!isset($data['lock_tier'][$key])) $data['lock_tier'][$key] = 0;
                PatreonReward::create([
                    'month'           => $data['month'],
                    'rewardable_type' => $type,
                    'rewardable_id'   => $data['rewardable_id'][$key],
                    'quantity'        => $data['quantity'][$key],
                    'tier'            => $data['tier'][$key],
                    'lock_tier'       => $data['lock_tier'][$key]
                ]);
            }
        }
    }
}
