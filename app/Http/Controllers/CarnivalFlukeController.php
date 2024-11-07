<?php

namespace App\Http\Controllers;

use Auth;
use db;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SitePage;
use App\Models\CarnivalFluke;
use App\Services\CarnivalFlukeService;

class CarnivalFlukeController extends Controller
{

    /**
     * Shows the Carnival Games page.
     *
     * @return \Illuminate\Contracts\Support\R
     */
    public function getCarnivalFluke()
    {
        return view('home.carnivalfluke', [
            'carnivalfluke' => CarnivalFluke::orderBy('last_game', 'asc')->get()
        ]);
    }

    /**
     * Creates or updates a new game for a user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Services\CarnivalFluke  $service
     * @param  int|null                  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreateEditFluke(Request $request, CarnivalFlukeService $service,  $id = null)
    {
        $id ? $request->validate(CarnivalFluke::$updateRules) : $request->validate(CarnivalFluke::$createRules);

        $data = $request->only([
            'amount','user_id'
        ]);


        if($id && $fluke=$service->updateFluke(CarnivalFluke::find($id), $data)) {
            flash($fluke->reward)->success();
            return redirect()->back();
        }
        else if (!$id && $fluke=$service->createFluke($data)) {
            flash($fluke->reward)->success();
            return redirect()->back();
        }
        else {
            foreach($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }
        return redirect()->back();
    }
}
