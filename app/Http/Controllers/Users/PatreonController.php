<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;

use DB;
use Auth;
use Carbon\Carbon;

use Patreon\API;
use Patreon\OAuth;

use App\Models\User\User;
use App\Models\User\UserItem;
use App\Models\Item\Item;
use App\Models\Character\Character;
use App\Models\Character\CharacterItem;
use App\Services\InventoryManager;

use App\Models\User\UserPatreon;
use App\Services\Patreon\PatreonManager;
use App\Models\User\PatreonReward;

use App\Http\Controllers\Controller;

class PatreonController extends Controller
{
    protected $api;

    public function __construct() {
        $this->clientId = ENV('PATREON_CLIENT_ID');
        $this->clientSecret = ENV('PATREON_CLIENT_SECRET');
        $this->accessToken = UserPatreon::where('user_id', 0)->first()->access_token;
        $this->redirect = 'http://127.0.0.1:8000/patreon/link';

        $this->api = new Api($this->accessToken);
    }

    /**
     * Index page, shows stats and an area to connect patreon
     */
    public function getIndex()
    {
        // define oAuth redirect
        $href = 'https://www.patreon.com/oauth2/authorize?response_type=code&client_id=' . $this->clientId . '&redirect_uri=' . urlencode($this->redirect);

        // any vars we want to send to patreon
        $state = [];
        $state['final_page'] = 'http://127.0.0.1:8000/patreon';
        
        // making link friendly - do not edit this line
        $stateParam = '&state=' . urlencode( base64_encode( json_encode( $state ) ) );

        // append parameters to url
        $href .= $stateParam;

        return view('patreon.index', [
            'user' => Auth::user(),
            'href' => $href,
            'patreon' => Auth::user()->patreon,
            'rewards' => PatreonReward::where('month', Carbon::now()->month)->get(),
            'month' => Carbon::now()->format('F')
        ]);
    }

    /**
     * Links for first time
     */
    public function link(Request $request, PatreonManager $service)
    {   
        if(!isset($_GET['code'])) {
            flash('Something went wrong :(')->error();
            return redirect()->to('patreon');
        }
        else {
            $code = $_GET['code'];
            if(isset($code) && $code != '') {
                $oauth = new OAuth($this->clientId, $this->clientSecret);	
            
                $tokens = $oauth->get_tokens($code, $this->redirect);
                
                // store these
                $accessToken = $tokens['access_token'];
                $refreshToken = $tokens['refresh_token'];

                if($accessToken)
                {
                    $client = new API($accessToken);

                    $patron = $client->fetch_user();

                    if(is_array($patron)) {

                        if(!Auth::user()->patreon)
                        {
                            Auth::user()->patreon()->create([
                                'user_id' => Auth::user()->id
                            ]);
                        }

                        // here we go into the manager just in case
                        if($service->link(Auth::user(), $patron, $accessToken, $refreshToken)) {
                            flash('Successfully linked!')->success();
                        }
                        else {
                            foreach($service->errors()->getMessages()['error'] as $error) flash($error)->error();
                        }
                        return redirect()->to('patreon');
                    }
                }
            }
            else {
                flash('Something went wrong :(')->error();
                return redirect()->to('patreon');
            }
        }
    }

    /**
     * Shows refresh modal
     */
    public function getRefresh()
    {
        return view('patreon._refresh');
    }

    /**
     * Post refresh
     */
    public function postRefresh(PatreonManager $service)
    {
        if($service->refresh(Auth::user())) {
            flash('Successfully refreshed!')->success();
        }
        else {
            foreach($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }
        return redirect()->to('patreon');
    }

    /**************************************************************************************************
        CLAIMS
    **************************************************************************************************/
    
    public function claim(PatreonManager $service)
    {
        if($service->claim(Auth::user())) {
            flash('Successfully claimed!')->success();
        }
        else {
            foreach($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }
        return redirect()->to('patreon');
    }
}