<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\User\UserPatreon;

use App\Services\Patreon\PatreonManager;

class RefreshPatrons extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refresh-patrons';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refreshes the user patron info.';

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
        $service = new PatreonManager;
        $patrons = UserPatreon::where('access_token', '!=', null)->get();
        
        foreach($patrons as $patron)
        {
            $service->refresh($patron->user);
        }
    }
}
