<?php
 
namespace App\Http\Controllers;
 
use Auth;
use db;
 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SitePage;
use App\Models\WishingWell;
use App\Services\WishingWellService;
 
class WishingWellController extends Controller
{

    /** 
     * Shows the wishing well page.
     *
     * @return \Illuminate\Contracts\Support\R
     */
    public function getWishingWell()   
    {
        return view('home.wishingwell', [
            'wishingwell' => WishingWell::orderBy('last_wish', 'asc')->get()
        ]);     
    }
 
    /**
     * Creates or updates a new wish for a user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Services\WishingWellService  $service
     * @param  int|null                  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreateEditWish(Request $request, WishingWellService $service,  $id = null)
    {
        $id ? $request->validate(WishingWell::$updateRules) : $request->validate(WishingWell::$createRules);

        $data = $request->only([
            'amount','user_id' 
        ]);


        if($id && $wish=$service->updateWish(WishingWell::find($id), $data)) {
            flash($wish->reward)->success();
            return redirect()->back();
        }
        else if (!$id && $wish=$service->createWish($data)) {
            flash($wish->reward)->success();
            return redirect()->back();
        }
        else {
            foreach($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }
        return redirect()->back();
    }
}
