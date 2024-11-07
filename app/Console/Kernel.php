<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Stringable;
use Log;
class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('check-news')
            ->everyMinute();
        $schedule->command('check-sales')
            ->everyMinute();
        $schedule->command('check-character-drops')
            ->everyMinute();
        $schedule->command('check-pet-drops')
            ->everyMinute();
        $schedule->command('change-feature')
            ->monthly();
        $schedule->command('reset-foraging')
            ->daily();

        /// PATREON STUFF
        $schedule->command('reset-patron-claim')
                ->monthly()
                ->onSuccess(function (Stringable $output) {
                    $this->line('The reset-patron-claim task succeeded...');
                });
        $schedule->command('refresh-patrons')
                ->twiceMonthly(1, 28)
                ->onSuccess(function (Stringable $output) {
                    Log::debug('The task refresh-patrons succeeded...');
                });
        $schedule->command('refresh-patreon-creator-token')
                ->twiceMonthly(1, 28)
                ->onSuccess(function (Stringable $output) {
                    Log::debug('The task refresh-patreon-creator-token succeeded...');
                });

        $schedule->exec('rm public/images/avatars/*.tmp')
            ->daily();
        $schedule->command('update-extension-tracker')
            ->daily();
        $schedule->command('restock-shops')
            ->daily();
        $schedule->command('clean-donations')
            ->everyMinute();
        $schedule->command('update-timed-stock')
            ->everyMinute();
        $schedule->command('change-fetch-item')
            ->daily();
        $schedule->command('update-staff-reward-actions')
            ->daily();
        $schedule->command('reset-hol')
            ->daily();
        $schedule->command('update-timed-daily')
            ->everyMinute();
        $schedule->command('check-invoices')
            ->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
