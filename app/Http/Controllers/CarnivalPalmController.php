<?php

namespace App\Http\Controllers;

use Auth;
use db;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SitePage;
use App\Models\CarnivalPalm;
use App\Services\CarnivalPalmService;

class CarnivalPalmController extends Controller
{

    /**
     * Shows the Carnival Games page.
     *
     * @return \Illuminate\Contracts\Support\R
     */
    public function getCarnivalPalm()
    {
        return view('home.carnivalpalm', [
            'carnivalpalm' => CarnivalPalm::orderBy('last_game', 'asc')->get()
        ]);
    }

    /**
     * Creates or updates a new game for a user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Services\CarnivalPalm  $service
     * @param  int|null                  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreateEditPalm(Request $request, CarnivalPalmService $service,  $id = null)
    {
        $id ? $request->validate(CarnivalPalm::$updateRules) : $request->validate(CarnivalPalm::$createRules);

        $data = $request->only([
            'amount','user_id'
        ]);


        if($id && $palm=$service->updatePalm(CarnivalPalm::find($id), $data)) {
            flash($palm->reward)->success();
            return redirect()->back();
        }
        else if (!$id && $palm=$service->createPalm($data)) {
            flash($palm->reward)->success();
            return redirect()->back();
        }
        else {
            foreach($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }
        return redirect()->back();
    }
}
