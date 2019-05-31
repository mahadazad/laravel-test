<?php

namespace App\Service\BusinessDayCalculator;

use Illuminate\Support\Facades\Redis;

class RedisPubSub implements BusinessDatesPubSubInterface
{
    const CHANNEL = 'businessDates.BankWire';

    public function subscribe()
    {
        Redis::subscribe([static::CHANNEL], function ($message) {
            echo json_encode($message);
        });
    }

    public function publish(BusinessDateWithDelay $message)
    {
        Redis::publish(static::CHANNEL, json_encode($message));
    }
}
