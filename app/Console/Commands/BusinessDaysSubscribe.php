<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Service\BusinessDayCalculator\BusinessDatesPubSubInterface;

class BusinessDaysSubscribe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'business-days:subscribe';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Subscribes to Business Days channel';

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
     * @param BusinessDatesPubSubInterface $pubsub
     */
    public function handle(BusinessDatesPubSubInterface $pubsub)
    {
        $pubsub->subscribe();
    }
}
