<?php

namespace App\Http\Controllers;

use Auth;
use db;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SitePage;
use App\Models\CarnivalWhap;
use App\Services\CarnivalWhapService;

class CarnivalWhapController extends Controller
{

    /**
     * Shows the Carnival Games page.
     *
     * @return \Illuminate\Contracts\Support\R
     */
    public function getCarnivalWhap()
    {
        return view('home.carnivalwhap', [
            'carnivalwhap' => CarnivalWhap::orderBy('last_game', 'asc')->get()
        ]);
    }

    /**
     * Creates or updates a new game for a user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Services\CarnivalWhap  $service
     * @param  int|null                  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreateEditWhap(Request $request, CarnivalWhapService $service,  $id = null)
    {
        $id ? $request->validate(CarnivalWhap::$updateRules) : $request->validate(CarnivalWhap::$createRules);

        $data = $request->only([
            'amount','user_id'
        ]);


        if($id && $whap=$service->updateWhap(CarnivalWhap::find($id), $data)) {
            flash($whap->reward)->success();
            return redirect()->back();
        }
        else if (!$id && $whap=$service->createWhap($data)) {
            flash($whap->reward)->success();
            return redirect()->back();
        }
        else {
            foreach($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }
        return redirect()->back();
    }
}
