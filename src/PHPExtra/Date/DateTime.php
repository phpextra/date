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

    /**
     * Add years to the instance. Positive $value travel forward while
     * negative $value travel into the past.
     *
     * @param integer $value
     *
     * @return static
     */
    public function addYears($value)
    {
        return $this->modify(intval($value) . ' year');
    }

    /**
     * Add a year to the instance
     *
     * @return static
     */
    public function addYear()
    {
        return $this->addYears(1);
    }

    /**
     * Remove a year from the instance
     *
     * @return static
     */
    public function subYear()
    {
        return $this->addYears(-1);
    }

    /**
     * Remove years from the instance.
     *
     * @param integer $value
     *
     * @return static
     */
    public function subYears($value)
    {
        return $this->addYears(-1 * $value);
    }

    /**
     * Add months to the instance. Positive $value travels forward while
     * negative $value travels into the past.
     *
     * @param integer $value
     *
     * @return static
     */
    public function addMonths($value)
    {
        return $this->modify(intval($value) . ' month');
    }

    /**
     * Add a month to the instance
     *
     * @return static
     */
    public function addMonth()
    {
        return $this->addMonths(1);
    }

    /**
     * Remove a month from the instance
     *
     * @return static
     */
    public function subMonth()
    {
        return $this->addMonths(-1);
    }

    /**
     * Remove months from the instance
     *
     * @param integer $value
     *
     * @return static
     */
    public function subMonths($value)
    {
        return $this->addMonths(-1 * $value);
    }

    /**
     * Add days to the instance. Positive $value travels forward while
     * negative $value travels into the past.
     *
     * @param integer $value
     *
     * @return static
     */
    public function addDays($value)
    {
        return $this->modify(intval($value) . ' day');
    }

    /**
     * Add a day to the instance
     *
     * @return static
     */
    public function addDay()
    {
        return $this->addDays(1);
    }

    /**
     * Remove a day from the instance
     *
     * @return static
     */
    public function subDay()
    {
        return $this->addDays(-1);
    }

    /**
     * Remove days from the instance
     *
     * @param integer $value
     *
     * @return static
     */
    public function subDays($value)
    {
        return $this->addDays(-1 * $value);
    }

    /**
     * Add weekdays to the instance. Positive $value travels forward while
     * negative $value travels into the past.
     *
     * @param integer $value
     *
     * @return static
     */
    public function addWeekdays($value)
    {
        return $this->modify(intval($value) . ' weekday');
    }

    /**
     * Add a weekday to the instance
     *
     * @return static
     */
    public function addWeekday()
    {
        return $this->addWeekdays(1);
    }

    /**
     * Remove a weekday from the instance
     *
     * @return static
     */
    public function subWeekday()
    {
        return $this->addWeekdays(-1);
    }

    /**
     * Remove weekdays from the instance
     *
     * @param integer $value
     *
     * @return static
     */
    public function subWeekdays($value)
    {
        return $this->addWeekdays(-1 * $value);
    }

    /**
     * Add weeks to the instance. Positive $value travels forward while
     * negative $value travels into the past.
     *
     * @param integer $value
     *
     * @return static
     */
    public function addWeeks($value)
    {
        return $this->modify(intval($value) . ' week');
    }

    /**
     * Add a week to the instance
     *
     * @return static
     */
    public function addWeek()
    {
        return $this->addWeeks(1);
    }

    /**
     * Remove a week from the instance
     *
     * @return static
     */
    public function subWeek()
    {
        return $this->addWeeks(-1);
    }

    /**
     * Remove weeks to the instance
     *
     * @param integer $value
     *
     * @return static
     */
    public function subWeeks($value)
    {
        return $this->addWeeks(-1 * $value);
    }

    /**
     * Add hours to the instance. Positive $value travels forward while
     * negative $value travels into the past.
     *
     * @param integer $value
     *
     * @return static
     */
    public function addHours($value)
    {
        return $this->modify(intval($value) . ' hour');
    }

    /**
     * Add an hour to the instance
     *
     * @return static
     */
    public function addHour()
    {
        return $this->addHours(1);
    }

    /**
     * Remove an hour from the instance
     *
     * @return static
     */
    public function subHour()
    {
        return $this->addHours(-1);
    }

    /**
     * Remove hours from the instance
     *
     * @param integer $value
     *
     * @return static
     */
    public function subHours($value)
    {
        return $this->addHours(-1 * $value);
    }

    /**
     * Add minutes to the instance. Positive $value travels forward while
     * negative $value travels into the past.
     *
     * @param integer $value
     *
     * @return static
     */
    public function addMinutes($value)
    {
        return $this->modify(intval($value) . ' minute');
    }

    /**
     * Add a minute to the instance
     *
     * @return static
     */
    public function addMinute()
    {
        return $this->addMinutes(1);
    }

    /**
     * Remove a minute from the instance
     *
     * @return static
     */
    public function subMinute()
    {
        return $this->addMinutes(-1);
    }

    /**
     * Remove minutes from the instance
     *
     * @param integer $value
     *
     * @return static
     */
    public function subMinutes($value)
    {
        return $this->addMinutes(-1 * $value);
    }

    /**
     * Add seconds to the instance. Positive $value travels forward while
     * negative $value travels into the past.
     *
     * @param integer $value
     *
     * @return static
     */
    public function addSeconds($value)
    {
        return $this->modify(intval($value) . ' second');
    }

    /**
     * Add a second to the instance
     *
     * @return static
     */
    public function addSecond()
    {
        return $this->addSeconds(1);
    }

    /**
     * Remove a second from the instance
     *
     * @return static
     */
    public function subSecond()
    {
        return $this->addSeconds(-1);
    }

    /**
     * Remove seconds from the instance
     *
     * @param integer $value
     *
     * @return static
     */
    public function subSeconds($value)
    {
        return $this->addSeconds(-1 * $value);
    }

    /**
     * @param \DateTime $dateTime
     *
     * @return $this
     */
    public static function createFromDateTime(\DateTime $dateTime)
    {
        return new static($dateTime->format('Y-m-d H:i:s'), $dateTime->getTimezone());
    }

    /**
     * {@inheritdoc}
     */
    public static function createFromFormat($format, $time, $timezone = null)
    {
        return self::createFromDateTime(parent::createFromFormat($format, $time, $timezone));
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->format($this->defaultFormat);
    }
}