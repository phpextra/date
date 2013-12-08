<?php

namespace PHPExtra\Date;
use Closure;
use DateTime as StandardDateTime;
use DateTimeZone;

/**
 * Class DateTime
 *
 * @author Jacek Kobus <kobus.jacek@gmail.com>
 */
class DateTime extends StandardDateTime
{
    /**
     * @var Closure
     */
    public static $now = null;

    const HOUR = 'h';

    /**
     * Dafeault format
     *
     * @var string
     */
    protected $defaultFormat = self::ISO8601;

    /**
     * @param string $time
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
     * Returns 1 if given date is earlier, 0 is equal, -1 is later
     *
     * @param DateTime $date
     * @return int
     */
    public function compare(DateTime $date)
    {
        if($this > $date){
            return 1;
        }elseif($date > $this){
            return -1;
        }else{
            return 0;
        }
    }

    /**
     * @param DateTime $date
     * @return bool
     */
    public function equals(DateTime $date)
    {
        return $this->compare($date) === 0;
    }

    /**
     * @param DateTime $date
     * @return bool
     */
    public function isEarlier(DateTime $date)
    {
        return $this->compare($date) === 1;
    }

    /**
     * @param DateTime $date
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
     * @return string
     */
    public function getDaysInMonth()
    {
        return $this->format('t');
    }

    public function getDayOfMonth()
    {
        return $this->format('j');
    }

    public function getDayOfWeek(){}

    public function getDayOfYear(){}

    public function getWeekOfYear(){}

}