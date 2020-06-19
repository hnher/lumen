<?php

namespace App\Console;

use App\Console\Commands\TestCommand;
use App\Modules\Scheduler\Commands\ConsumerCommand;
use App\Modules\Scheduler\Commands\SchedulerTestCommand;
use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        TestCommand::class,
        // Scheduler 消费者
        ConsumerCommand::class,
        SchedulerTestCommand::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

    }
}
