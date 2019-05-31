<?php

namespace App\Service\BusinessDayCalculator;

interface BusinessDatesPubSubInterface
{
    public function subscribe();
    public function publish(BusinessDateWithDelay $message);
}
