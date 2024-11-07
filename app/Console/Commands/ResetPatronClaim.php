<?php

namespace App\Console\Commands;

use DB;
use Illuminate\Console\Command;

class ResetPatronClaim extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset-patron-claim';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Resets the \'has_claimed\' column in user patron info.';

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
        DB::table('user_patreons')->where('has_claimed', '=', 1)->update(['has_claimed' => 0 ]);
    }
}
