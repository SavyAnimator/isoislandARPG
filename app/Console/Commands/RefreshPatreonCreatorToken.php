<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User\UserPatreon;

use Carbon\Carbon;
use Patreon\API;
use Patreon\OAuth;
use App\Services\Patreon\PatreonManager;

class RefreshPatreonCreatorToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refresh-patreon-creator-token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refreshed creator access and refresh token.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        if(!UserPatreon::where('user_id', 0)->first()) {
            $this->info( "No saved access or refresh tokens, generating from env...");
            $patreon = UserPatreon::create([
                'user_id' => 0,
                'access_token' => env('PATREON_ACCESS_TOKEN', null),
                'refresh_token' => env('PATREON_REFRESH_TOKEN', null),
                'last_refresh' => Carbon::now()
            ]);
        }
        (new PatreonManager)->creatorRefresh(true, null);
        $this->info( "Successfully Refreshed.");
    }
}
