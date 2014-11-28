<?php


namespace PHPExtra\Date;

/**
 * DateInterval
 * 
 * @author Paweł Łuczkiewicz <pawel.luczkiewicz@audioteka.com>
 */
class DateInterval extends \DateInterval
{
    const DURATION_YEAR = 'year';
    const DURATION_MONTH = 'month';
    const DURATION_DAY = 'day';
    const DURATION_HOUR = 'hour';
    const DURATION_MINUTE = 'minute';
    const DURATION_SECOND = 'second';

    /**
     * @return array Lengths of given time intervals, in seconds
     */
    private static function getLengths()
    {
        return array(
            array(static::DURATION_YEAR, 31536000),
            array(static::DURATION_MONTH, 2628000),
            array(static::DURATION_DAY, 86400),
            array(static::DURATION_HOUR, 3600),
            array(static::DURATION_MINUTE, 60),
            array(static::DURATION_SECOND, 1)
        );
    }

    /**
     * Create ISO format specifier from data array, with keys as defined in DURATION_* CONSTANTS
     *
     * @param array $data
     * @return string
     */
    private static function formatSpecifier(array $data)
    {
        return sprintf(
            'P%dY%dM%dDT%dH%dM%dS',
            $data[static::DURATION_YEAR],
            $data[static::DURATION_MONTH],
            $data[static::DURATION_DAY],
            $data[static::DURATION_HOUR],
            $data[static::DURATION_MINUTE],
            $data[static::DURATION_SECOND]
        );
    }

    /**
     * Create a DateInterval object from given amount of seconds.
     *
     * @param int $value
     * @return static
     */
    public static function fromSeconds($value)
    {
        $lengths = static::getLengths();
        $data = array();

        foreach($lengths as $length)
        {
            $data[$length[0]] = (int)$value/$length[1];
            $value %= $length[1];
        }

        return new static(static::formatSpecifier($data));
    }

    /**
     * Create a DateInterval object from given amount of minutes.
     *
     * @param int $value
     * @return static
     */
    public static function fromMinutes($value)
    {
        return static::fromSeconds($value*60);
    }

    /**
     * Format @see DateInterval to string, like: 6h25min or 15min. Works for intervals less than 24h.
     *
     * @return string
     */
    public function formatHours()
    {
        $ret = '';
        if($this->h > 0) {
            $ret .= $this->h . 'h';
        }
        $ret .= $this->i . 'min';

        return $ret;
    }
}