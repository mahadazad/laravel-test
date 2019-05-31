<?php

namespace App\Service\BusinessDayCalculator;

use JsonSerializable;

class BusinessDay implements JsonSerializable
{
    private $businessDate;
    private $totalDays;
    private $holidayDays;
    private $weekendDays;

    /**
     * BusinessDay constructor.
     * @param string $businessDate
     * @param int $totalDays
     * @param int $holidayDays
     * @param int $weekendDays
     */
    public function __construct(string $businessDate, int $totalDays, int $holidayDays, int $weekendDays)
    {
        $this->businessDate = $businessDate;
        $this->totalDays = $totalDays;
        $this->holidayDays = $holidayDays;
        $this->weekendDays = $weekendDays;
    }

    public function __get($name)
    {
        if (property_exists($this, '$name')) {
            return $this->{$name};
        }

        throw new \Exception('invalid property');
    }

    public function toArray()
    {
        return [
            'businessDate' => $this->businessDate,
            'totalDays' => $this->totalDays,
            'holidayDays' => $this->holidayDays,
            'weekendDays' => $this->weekendDays,
        ];
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
