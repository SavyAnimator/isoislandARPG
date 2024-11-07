<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Auth;
use Carbon\Carbon;

use App\Models\User\User;
use App\Models\User\UserPatreon;
use App\Models\User\PatreonReward;

use App\Models\Item\Item;
use App\Models\Currency\Currency;
use App\Models\Loot\LootTable;
use App\Models\Raffle\Raffle;

use App\Services\Patreon\PatreonService;
use App\Services\Patreon\PatreonManager;

use App\Http\Controllers\Controller;

class PatreonController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Admin / Patreon Controller
    |--------------------------------------------------------------------------
    |
    | Handles creation/editing of rewards.
    |
    */

    public function __construct()
    {
        // get current month
        $this->monthId = Carbon::now()->month;
        // get current month from string aka month name
        $this->months = [
           1 => 'January',
           2 => 'February',
           3 => 'March',
           4 =>'April',
           5 => 'May',
           6 =>'June',
           7 => 'July',
           8 => 'August',
           9 => 'September',
           10 => 'October',
           11 => 'November',
           12 => 'December',
        ];
    }

    /**
     * Shows the reward index.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getRewardIndex(Request $request)
    {
        return view('admin.patreon.reward_index', [
            'creator' => UserPatreon::where('user_id', 0)->first(),
            'rewards' => PatreonReward::all()->groupBy('month'),
            'rewardsNow' => PatreonReward::where('month', $this->monthId)->get(),
            'items' => Item::orderBy('name')->pluck('name', 'id'),
            'currencies' => Currency::where('is_user_owned', 1)->orderBy('name')->pluck('name', 'id'),
            'tables' => LootTable::orderBy('name')->pluck('name', 'id'),
            'raffles' => Raffle::where('rolled_at', null)->where('is_active', 1)->orderBy('name')->pluck('name', 'id'),
        ]);
    }

    /**
     * Shows the create reward page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCreateReward()
    {
        return view('admin.patreon.create_reward', [
            'months' => $this->months,
            'items' => Item::orderBy('name')->pluck('name', 'id'),
            'currencies' => Currency::where('is_user_owned', 1)->orderBy('name')->pluck('name', 'id'),
            'tables' => LootTable::orderBy('name')->pluck('name', 'id'),
            'raffles' => Raffle::where('rolled_at', null)->where('is_active', 1)->orderBy('name')->pluck('name', 'id'),
        ]);
    }

    /**
     * Shows the edit reward page.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getEditReward($id)
    {
        return view('admin.patreon.edit_reward', [
            'rewards' => $rewards = PatreonReward::where('month', $id)->get(),
            'id' => $id,
            'items' => Item::orderBy('name')->pluck('name', 'id'),
            'currencies' => Currency::where('is_user_owned', 1)->orderBy('name')->pluck('name', 'id'),
            'tables' => LootTable::orderBy('name')->pluck('name', 'id'),
            'raffles' => Raffle::where('rolled_at', null)->where('is_active', 1)->orderBy('name')->pluck('name', 'id'),
        ]);
    }

    /**
     * Creates a reward.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Services\RewardService  $service
     * @param  int|null                  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreateReward(Request $request, PatreonService $service)
    {
        $data = $request->only([
            'month', 'rewardable_type', 'rewardable_id', 'quantity', 'tier', 'lock_tier'
        ]);
        if($service->createMonth($data)) {
            flash('Rewards updated successfully.')->success();
        }
        else {
            foreach($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }
        return redirect()->to('admin/patreon/rewards');
    }

    /**
     * edits a reward.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Services\RewardService  $service
     * @param  int|null                  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEditReward($id, Request $request, PatreonService $service)
    {
        $data = $request->only([
            'rewardable_type', 'rewardable_id', 'quantity', 'tier', 'lock_tier'
        ]);
        if($service->editMonth($id, $data)) {
            flash('Rewards updated successfully.')->success();
        }
        else {
            foreach($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }
        return redirect()->back();
    }

        /**
     * edits a reward.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Services\RewardService  $service
     * @param  int|null                  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreator(Request $request, PatreonManager $service)
    {
        $data = $request->only([
            'refresh', 'access'
        ]);
        if($service->creatorRefresh(false, $data)) {
            flash('Credentials updated successfully.')->success();
        }
        else {
            foreach($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }
        return redirect()->back();
    }
}
