<?php

namespace App\Http\Controllers;

use App\Service\BusinessDayCalculator\BusinessDateWithDelay;
use App\Service\BusinessDayCalculator\BusinessDatesPubSubInterface;
use App\Service\BusinessDayCalculator\BusinessDayCalculatorInterface;

class BusinessDateController extends Controller
{
    public function withDelay(BusinessDateWithDelay $businessDateWithDelay, BusinessDatesPubSubInterface $pubSub)
    {
        $initialDate = request()->input('initialDate');
        $delay = request()->input('delay');
        $businessDateWithDelay->setInitialDate($initialDate)->setDelay($delay);

        $pubSub->publish($businessDateWithDelay);

        return $businessDateWithDelay;
    }

    public function isBusinessDay(BusinessDayCalculatorInterface $calculator, $initialDate = null)
    {
        $initialDate = request()->input('initialDate', $initialDate);
        return response()->json($calculator->isBusinessDate($initialDate));
    }
}
