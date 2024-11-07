<?php

namespace App\Http\Controllers;

use Auth;
use db;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SitePage;
use App\Models\CarnivalRock;
use App\Services\CarnivalRockService;

class CarnivalRockController extends Controller
{

    /**
     * Shows the Carnival Games page.
     *
     * @return \Illuminate\Contracts\Support\R
     */
    public function getCarnivalRock()
    {
        return view('home.carnivalrock', [
            'carnivalrock' => CarnivalRock::orderBy('last_game', 'asc')->get()
        ]);
    }

    /**
     * Creates or updates a new game for a user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Services\CarnivalRock  $service
     * @param  int|null                  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreateEditRock(Request $request, CarnivalRockService $service,  $id = null)
    {
        $id ? $request->validate(CarnivalRock::$updateRules) : $request->validate(CarnivalRock::$createRules);

        $data = $request->only([
            'amount','user_id'
        ]);


        if($id && $rock=$service->updateRock(CarnivalRock::find($id), $data)) {
            flash($rock->reward)->success();
            return redirect()->back();
        }
        else if (!$id && $rock=$service->createRock($data)) {
            flash($rock->reward)->success();
            return redirect()->back();
        }
        else {
            foreach($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }
        return redirect()->back();
    }
}
