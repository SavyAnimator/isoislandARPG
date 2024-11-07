<?php

namespace App\Http\Controllers;

use Auth;
use db;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SitePage;
use App\Models\CarnivalPin;
use App\Services\CarnivalPinService;

class CarnivalPinController extends Controller
{

    /**
     * Shows the Carnival Games page.
     *
     * @return \Illuminate\Contracts\Support\R
     */
    public function getCarnivalPin()
    {
        return view('home.carnivalpin', [
            'carnivalpin' => CarnivalPin::orderBy('last_game', 'asc')->get()
        ]);
    }

    /**
     * Creates or updates a new game for a user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Services\CarnivalPin  $service
     * @param  int|null                  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreateEditPin(Request $request, CarnivalPinService $service,  $id = null)
    {
        $id ? $request->validate(CarnivalPin::$updateRules) : $request->validate(CarnivalPin::$createRules);

        $data = $request->only([
            'amount','user_id'
        ]);


        if($id && $pin=$service->updatePin(CarnivalPin::find($id), $data)) {
            flash($pin->reward)->success();
            return redirect()->back();
        }
        else if (!$id && $pin=$service->createPin($data)) {
            flash($pin->reward)->success();
            return redirect()->back();
        }
        else {
            foreach($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }
        return redirect()->back();
    }
}
