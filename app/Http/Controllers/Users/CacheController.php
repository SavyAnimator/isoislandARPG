<?php

namespace App\Http\Controllers\Users;

use Auth;
use File;
use Image;
use DB;

use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Notification;

use App\Models\User\User;
use App\Models\User\UserForaging;
use App\Models\Foraging\Forage;

use App\Services\ForageService;
use App\Services\UserService;

use App\Http\Controllers\Controller;

class CacheController extends Controller
{

    public function getCache()
    {
        $userForage = DB::table('user_foraging')->where('user_id', Auth::user()->id )->first();

            if(!$userForage) {
                $userForage = UserForaging::create([
                    'user_id' => Auth::user()->id,
                ]);
            }

        return view('foraging.cache', [
            'user' => Auth::user(),
            'tables' => Forage::where('is_active', 1)->orderBy('name')->get(),
        ]);
    }

    public function postForage($id, ForageService $service)
    {
        if($service->initForage($id, Auth::user()))
        {
            flash('You attempt to grab from the pile.')->info();
        }
        else {
            foreach($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }

        return redirect()->back();

    }

    public function postClaim(ForageService $service)
    {
        if($service->claimReward(Auth::user()))
        {
            flash('Pilfer successful!')->success();
        }
        else {
            foreach($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }

        return redirect()->back();

    }
}
