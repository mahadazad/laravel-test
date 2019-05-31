<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Service\BusinessDayCalculator\BusinessDayCalculator;
use App\Service\BusinessDayCalculator\BusinessDay;

class BusinessDayCalculatorTest extends TestCase
{
    private function getCalculator()
    {
        return new BusinessDayCalculator([
            '05-31',
            '05-23',
            '05-24',
        ]);
    }

    /**
     * should test isHoliday method.
     *
     * @return void
     * @throws \Exception
     */
    public function testIsHoliday()
    {
        $this->assertTrue($this->getCalculator()->isHoliday('2019-05-31'));
        $this->assertTrue($this->getCalculator()->isHoliday('2019-05-23'));
        $this->assertTrue($this->getCalculator()->isHoliday('2019-05-24'));
    }

    /**
     * should test isWeekend method.
     *
     * @return void
     * @throws \Exception
     */
    public function testIsWeekend()
    {
        $this->assertTrue($this->getCalculator()->isWeekend('2019-05-04'));
        $this->assertTrue($this->getCalculator()->isWeekend('2019-05-05'));
    }


    /**
     * should test isBusinessDate method.
     *
     * @return void
     * @throws \Exception
     */
    public function testIsBusinessDate()
    {
        // holidays
        $this->assertFalse($this->getCalculator()->isBusinessDate('2019-05-31'));
        $this->assertFalse($this->getCalculator()->isBusinessDate('2019-05-23'));
        $this->assertFalse($this->getCalculator()->isBusinessDate('2019-05-24'));

        // weekends
        $this->assertFalse($this->getCalculator()->isBusinessDate('2019-05-04'));
        $this->assertFalse($this->getCalculator()->isBusinessDate('2019-05-05'));

        // weekdays
        $this->assertTrue($this->getCalculator()->isBusinessDate('2019-05-01'));
        $this->assertTrue($this->getCalculator()->isBusinessDate('2019-05-09'));
    }

    /**
     * should test testGetBusinessDate method.
     *
     * @return void
     * @throws \Exception
     */
    public function testGetBusinessDate()
    {
        $date = '2019-05-01';
        $delay = 3;

        $this->assertEquals(
            (new BusinessDay('2019-05-06T00:00:00Z', 5, 0, 2))->toArray(),
            $this->getCalculator()->getBusinessDate($date, $delay)->toArray()
        );

        $date = '2019-05-22';
        $delay = 3;

        $this->assertEquals(
            (new BusinessDay('2019-05-29T00:00:00Z', 7, 2, 2))->toArray(),
            $this->getCalculator()->getBusinessDate($date, $delay)->toArray()
        );

        $date = '2019-05-1';
        $delay = 16;

        $this->assertEquals(
            (new BusinessDay('2019-05-27T00:00:00Z', 26, 2, 8))->toArray(),
            $this->getCalculator()->getBusinessDate($date, $delay)->toArray()
        );
    }
}
