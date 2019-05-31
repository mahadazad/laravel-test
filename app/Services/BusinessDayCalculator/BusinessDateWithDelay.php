<?php

namespace App\Service\BusinessDayCalculator;

use JsonSerializable;

class BusinessDateWithDelay implements JsonSerializable
{
    /**
     * @var BusinessDayCalculatorInterface
     */
    private $calculator;

    /**
     * @var string
     */
    private $initialDate;

    /**
     * @var int
     */
    private $delay;

    /**
     * @param BusinessDayCalculatorInterface $calculator
     */
    public function __construct(BusinessDayCalculatorInterface $calculator)
    {
        $this->calculator = $calculator;
    }

    /**
     * @param $date
     * @return $this
     */
    public function setInitialDate($date)
    {
        $this->initialDate = $date;
        return $this;
    }

    /**
     * @param $delay
     * @return $this
     */
    public function setDelay($delay)
    {
        $this->delay = $delay;
        return $this;
    }

    public function calculate()
    {
        return [
            'ok' => true,
            'initialQuery' => [
                'initialDate' => $this->initialDate,
                'delay' => $this->delay
            ],
            'results' => $this->calculator->getBusinessDate($this->initialDate, $this->delay)
        ];
    }

    public function jsonSerialize()
    {
        return $this->calculate();
    }
}
