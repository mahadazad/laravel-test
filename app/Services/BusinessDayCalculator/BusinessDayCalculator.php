<?php

namespace App\Service\BusinessDayCalculator;

use DateTime;
use DateInterval;

class BusinessDayCalculator implements BusinessDayCalculatorInterface
{
    private $holidays;

    public function __construct(Array $holidays)
    {
        $this->holidays = $holidays;
    }

    /**
     * @param $date
     * @return DateTime
     * @throws \Exception
     */
    private function prepareDate($date)
    {
        if (is_string($date)) {
            return new DateTime($date);
        } else if ($date instanceof DateTime) {
            return $date;
        }

        throw new \Exception('invalid date type');
    }

    /**
     * @param DateTime|string $startDate
     * @param int $delay
     * @return BusinessDay
     * @throws \Exception
     */
    public function getBusinessDate($startDate, int $delay): BusinessDay
    {
        if ($delay < 0) {
            throw new \Exception('invalid delay amount');
        }

        $remaining = $delay;
        $count = 0;
        $holidayDays = 0;
        $weekendDays = 0;

        while ($remaining > 0) {
            $count++;

            $date = $this->prepareDate($startDate)->add(new DateInterval("P{$count}D"));

            $isHoliday = $this->isHoliday($date);
            $isWeekend = $this->isWeekend($date);

            $holidayDays += $isHoliday ? 1 : 0;
            $weekendDays += $isWeekend ? 1 : 0;

            if ($isHoliday || $isWeekend) {
                continue;
            }

            $remaining--;
        }

        $totalDays = $count;
        $businessDate = $this->prepareDate($startDate)->add(new DateInterval("P{$totalDays}D"))->format('Y-m-d\TH:i:s\Z');

        return new BusinessDay($businessDate, $totalDays, $holidayDays, $weekendDays);
    }

    /**
     * @param DateTime|string $date
     * @return bool
     * @throws \Exception
     */
    public function isHoliday($date): bool
    {
        $date = $this->prepareDate($date)->format('m-d');
        return in_array($date, $this->holidays);
    }

    /**
     * @param DateTime|string $date
     * @return bool
     * @throws \Exception
     */
    public function isWeekend($date): bool
    {
        $day = $this->prepareDate($date)->format('D');
        return $day === 'Sun' || $day === 'Sat';
    }

    /**
     * @param DateTime|string $date
     * @return bool
     * @throws \Exception
     */
    public function isBusinessDate($date): bool
    {
        return !$this->isHoliday($date) && !$this->isWeekend($date);
    }
}
