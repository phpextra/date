<?php


namespace fixtures\PHPExtra\Date;

use PHPExtra\Date\DateInterval;

/**
 * DateIntervalTests
 * 
 * @author Paweł Łuczkiewicz <pawel.luczkiewicz@audioteka.com>
 */
class DateIntervalTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider minutesProvider
     */
    public function testCanCreateFromMinutes($minutes, $expected)
    {
        $interval = DateInterval::fromMinutes($minutes);

        $this->assertEquals($expected['Y'], $interval->y);
        $this->assertEquals($expected['m'], $interval->m);
        $this->assertEquals($expected['d'], $interval->d);
        $this->assertEquals($expected['h'], $interval->h);
        $this->assertEquals($expected['i'], $interval->i);
        $this->assertEquals($expected['s'], $interval->s);
    }

    public function minutesProvider()
    {
        return array(
            array(1000, array('Y' => 0, 'm' => 0, 'd' => 0, 'h' => 16, 'i' => 40, 's' => 0)),
            array(1015, array('Y' => 0, 'm' => 0, 'd' => 0, 'h' => 16, 'i' => 55, 's' => 0)),
            array(10000, array('Y' => 0, 'm' => 0, 'd' => 6, 'h' => 22, 'i' => 40, 's' => 0)),
            array(600000 , array('Y' => 1, 'm' => 1, 'd' => 21, 'h' => 6, 'i' => 0, 's' => 0)),
        );
    }
    /**
     * @dataProvider secondsProvider
     */
    public function testCanCreateFromSeconds($seconds, $expected)
    {
        $interval = DateInterval::fromSeconds($seconds);

        $this->assertEquals($expected['Y'], $interval->y);
        $this->assertEquals($expected['m'], $interval->m);
        $this->assertEquals($expected['d'], $interval->d);
        $this->assertEquals($expected['h'], $interval->h);
        $this->assertEquals($expected['i'], $interval->i);
        $this->assertEquals($expected['s'], $interval->s);
    }

    public function secondsProvider()
    {
        return array(
            array(1000, array('Y' => 0, 'm' => 0, 'd' => 0, 'h' => 0, 'i' => 16, 's' => 40)),
            array(1015, array('Y' => 0, 'm' => 0, 'd' => 0, 'h' => 0, 'i' => 16, 's' => 55)),
            array(10000, array('Y' => 0, 'm' => 0, 'd' => 0, 'h' => 2, 'i' => 46, 's' => 40)),
            array(600000 , array('Y' => 0, 'm' => 0, 'd' => 6, 'h' => 22, 'i' => 40, 's' => 0)),
        );
    }

    /**
     * @dataProvider formatProvider
     */
    public function testCanFormatAsHours($minutes, $expected)
    {
        $interval = DateInterval::fromMinutes($minutes);

        $formatted = $interval->formatHours();

        $this->assertEquals($expected, $formatted);
    }

    public function formatProvider()
    {
        return array(
            array(75, '1h15min'),
            array(15, '15min'),
            array(25, '25min'),
            array(90, '1h30min'),
            array(125, '2h5min')
        );
    }
} 