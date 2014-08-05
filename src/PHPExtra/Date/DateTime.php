<?php

namespace PHPExtra\Date;

use Closure;
use DateTime as StandardDateTime;
use DateTimeZone;

/**
 * The DateTime class
 *
 * @author Jacek Kobus <kobus.jacek@gmail.com>
 */
class DateTime extends StandardDateTime
{
    /**
     * @var Closure
     */
    public static $now = null;

    /**
     * Default format
     *
     * @var string
     */
    protected $defaultFormat = self::ISO8601;

    /**
     * @param string       $time
     * @param DateTimeZone $timezone
     */
    public function __construct($time = 'now', DateTimeZone $timezone = null)
    {
        parent::__construct($time, $timezone);
    }

    /**
     * @return $this
     */
    public static function now()
    {
        return new self();
    }

    /**
     * @return $this
     */
    public static function tomorrow()
    {
        return new self('tomorrow');
    }

    /**
     * @return $this
     */
    public static function yesterday()
    {
        return new self('yesterday');
    }

    /**
     * Returns 1 if given date is earlier, 0 is equal, -1 is later
     *
     * @param DateTime $date
     *
     * @return int
     */
    public function compare(DateTime $date)
    {
        if ($this > $date) {
            return 1;
        } elseif ($date > $this) {
            return -1;
        } else {
            return 0;
        }
    }

    /**
     * @param DateTime $date
     *
     * @return bool
     */
    public function equals(DateTime $date)
    {
        return $this->compare($date) === 0;
    }

    /**
     * @param DateTime $date
     *
     * @return bool
     */
    public function isEarlier(DateTime $date)
    {
        return $this->compare($date) === 1;
    }

    /**
     * @param DateTime $date
     *
     * @return bool
     */
    public function isLater(DateTime $date)
    {
        return $this->compare($date) === -1;
    }

    /**
     * Tell if current date is equal to the real date
     *
     * @return bool
     */
    public function isToday()
    {
        return $this->format('zY') == DateTime::now()->format('zY');
    }

    /**
     * Tells if current week day is Saturday or Sunday (Friday after 4PM is not a weekend)
     *
     * @return bool
     */
    public function isWeekend()
    {
        return $this->getDayOfWeek() > 5;
    }

    /**
     * @return bool
     */
    public function isLeapYear()
    {
        return $this->format('L') == '1';
    }

    /**
     * @return bool
     */
    public function isAM()
    {
        return $this->format('A') == 'AM';
    }

    /**
     * @return bool
     */
    public function isPM()
    {
        return $this->format('A') == 'PM';
    }

    /**
     * Get number of days in current month
     *
     * @return string
     */
    public function getDaysInMonth()
    {
        return $this->format('t');
    }

    /**
     * Day of the month without leading zeros
     *
     * @return string
     */
    public function getDayOfMonth()
    {
        return $this->format('j');
    }

    /**
     * ISO-8601 numeric representation of the day of the week (1 for Monday, 7 for Sunday)
     *
     * @return string
     */
    public function getDayOfWeek()
    {
        return $this->format('N');
    }

    /**
     * The day of the year (0 through 365)
     *
     * @return string
     */
    public function getDayOfYear()
    {
        return $this->format('z');
    }

    /**
     * ISO-8601 week number of year, weeks starting on Monday
     *
     * @return string
     */
    public function getWeekOfYear()
    {
        return $this->format('W');
    }

//    public function addDays($amount)
//    {
//    }
//
//    public function addMinutes($amount){}
//
//    public function addSeconds($amount){}

}