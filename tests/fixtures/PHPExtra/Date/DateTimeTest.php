<?php

namespace fixtures\PHPExtra\Date;

use PHPExtra\Date\DateTime;

/**
 * The DateTimeTest class
 *
 * @author Jacek Kobus <kobus.jacek@gmail.com>
 */
class DateTimeTest extends \PHPUnit_Framework_TestCase 
{
    public function testCreateNewDateTimeInstance()
    {
        new DateTime();
    }

    public function testAddDayToDateTimeAddsADay()
    {
        $date = new DateTime('2014-01-01');
        $date->addDay();

        $this->assertEquals(new DateTime('2014-01-02'), $date);

        $date = new DateTime('2014-01-01');
        $date->addDays(7);

        $this->assertEquals(new DateTime('2014-01-08'), $date);
    }

    public function testAddDaysToDateTimeChangesCurrentMonth()
    {
        $date = new DateTime('2014-01-31');
        $date->addDay();

        $this->assertEquals(new DateTime('2014-02-01'), $date);
    }
}
 