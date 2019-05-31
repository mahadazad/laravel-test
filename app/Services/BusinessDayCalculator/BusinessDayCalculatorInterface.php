<?php

namespace App\Service\BusinessDayCalculator;

use DateTime;

interface BusinessDayCalculatorInterface {
    /**
     * @param string | DateTime $date
     * @param integer $delay
     * @return mixed
     */
    public function getBusinessDate($date, int $delay): BusinessDay;

    /**
     * @param string | DateTime $date
     * @return bool
     */
    public function isHoliday($date): bool;

    /**
     * @param string | DateTime $date
     * @return bool
     */
    public function isWeekend($date): bool;

    /**
     * @param string | DateTime $date
     * @return bool
     */
    public function isBusinessDate($date): bool;
}
