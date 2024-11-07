<?php

namespace App\Http\Controllers;

use Auth;
use db;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SitePage;
use App\Models\CarnivalGames;
use App\Services\CarnivalGamesService;

class CarnivalGamesController extends Controller
{

    /**
     * Shows the Carnival Games page.
     *
     * @return \Illuminate\Contracts\Support\R
     */
    public function getCarnivalGames()
    {
        return view('home.carnivalgames', [
            'carnivalgames' => CarnivalGames::orderBy('last_game', 'asc')->get()
        ]);
    }

    /**
     * Creates or updates a new game for a user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Services\CarnivalGames  $service
     * @param  int|null                  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreateEditGame(Request $request, CarnivalGamesService $service,  $id = null)
    {
        $id ? $request->validate(CarnivalGames::$updateRules) : $request->validate(CarnivalGames::$createRules);

        $data = $request->only([
            'amount','user_id'
        ]);


        if($id && $game=$service->updateGame(CarnivalGames::find($id), $data)) {
            flash($game->reward)->success();
            return redirect()->back();
        }
        else if (!$id && $game=$service->createGame($data)) {
            flash($game->reward)->success();
            return redirect()->back();
        }
        else {
            foreach($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }
        return redirect()->back();
    }
}
