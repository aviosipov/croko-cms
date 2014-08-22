<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category  Zend
 * @package   Zend_Date
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd     New BSD License
 * @version   $Id: Date.php 24108 2011-06-04 00:09:27Z freak $
 */

/**
 * Include needed Date classes
 */
require_once 'Zend/Date/DateObject.php';
require_once 'Zend/Locale.php';
require_once 'Zend/Locale/Format.php';
require_once 'Zend/Locale/Math.php';

/**
 * @category  Zend
 * @package   Zend_Date
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Date extends Zend_Date_DateObject
{
    private $_locale  = null;

    // Fractional second variables
    private $_fractional = 0;
    private $_precision  = 3;

    private static $_options = array(
        'format_type'  => 'iso',      // format for date strings 'iso' or 'php'
        'fix_dst'      => true,       // fix dst on summer/winter time change
        'extend_month' => false,      // false - addMonth like SQL, true like excel
        'cache'        => null,       // cache to set
        'timesync'     => null        // timesync server to set
    );

    // Class wide Date Constants
    const DAY               = 'dd';
    const DAY_SHORT         = 'd';
    const DAY_SUFFIX        = 'SS';
    const DAY_OF_YEAR       = 'D';
    const WEEKDAY           = 'EEEE';
    const WEEKDAY_SHORT     = 'EEE';
    const WEEKDAY_NARROW    = 'E';
    const WEEKDAY_NAME      = 'EE';
    const WEEKDAY_8601      = 'eee';
    const WEEKDAY_DIGIT     = 'e';
    const WEEK              = 'ww';
    const MONTH             = 'MM';
    const MONTH_SHORT       = 'M';
    const MONTH_DAYS        = 'ddd';
    const MONTH_NAME        = 'MMMM';
    const MONTH_NAME_SHORT  = 'MMM';
    const MONTH_NAME_NARROW = 'MMMMM';
    const YEAR              = 'y';
    const YEAR_SHORT        = 'yy';
    const YEAR_8601         = 'Y';
    const YEAR_SHORT_8601   = 'YY';
    const LEAPYEAR          = 'l';
    const MERIDIEM          = 'a';
    const SWATCH            = 'B';
    const HOUR              = 'HH';
    const HOUR_SHORT        = 'H';
    const HOUR_AM           = 'hh';
    const HOUR_SHORT_AM     = 'h';
    const MINUTE            = 'mm';
    const MINUTE_SHORT      = 'm';
    const SECOND            = 'ss';
    const SECOND_SHORT      = 's';
    const MILLISECOND       = 'S';
    const TIMEZONE_NAME     = 'zzzz';
    const DAYLIGHT          = 'I';
    const GMT_DIFF          = 'Z';
    const GMT_DIFF_SEP      = 'ZZZZ';
    const TIMEZONE          = 'z';
    const TIMEZONE_SECS     = 'X';
    const ISO_8601          = 'c';
    const RFC_2822          = 'r';
    const TIMESTAMP         = 'U';
    const ERA               = 'G';
    const ERA_NAME          = 'GGGG';
    const ERA_NARROW        = 'GGGGG';
    const DATES             = 'F';
    const DATE_FULL         = 'FFFFF';
    const DATE_LONG         = 'FFFF';
    const DATE_MEDIUM       = 'FFF';
    const DATE_SHORT        = 'FF';
    const TIMES             = 'WW';
    const TIME_FULL         = 'TTTTT';
    const TIME_LONG         = 'TTTT';
    const TIME_MEDIUM       = 'TTT';
    const TIME_SHORT        = 'TT';
    const DATETIME          = 'K';
    const DATETIME_FULL     = 'KKKKK';
    const DATETIME_LONG     = 'KKKK';
    const DATETIME_MEDIUM   = 'KKK';
    const DATETIME_SHORT    = 'KK';
    const ATOM              = 'OOO';
    const COOKIE            = 'CCC';
    const RFC_822           = 'R';
    const RFC_850           = 'RR';
    const RFC_1036          = 'RRR';
    const RFC_1123          = 'RRRR';
    const RFC_3339          = 'RRRRR';
    const RSS               = 'SSS';
    const W3C               = 'WWW';

    /**
     * Generates the standard date object, could be a unix timestamp, localized date,
     * string, integer, array and so on. Also parts of dates or time are supported
     * Always set the default timezone: http://php.net/date_default_timezone_set
     * For example, in your bootstrap: date_default_timezone_set('America/Los_Angeles');
     * For detailed instructions please look in the docu.
     *
     * @param  string|integer|Zend_Date|array  $date    OPTIONAL Date value or value of date part to set
     *                                                 ,depending on $part. If null the actual time is set
     * @param  string                          $part    OPTIONAL Defines the input format of $date
     * @param  string|Zend_Locale              $locale  OPTIONAL Locale for parsing input
     * @return Zend_Date
     * @throws Zend_Date_Exception
     */
    public function __construct($date = null, $part = null, $locale = null)
    {
        if (is_object($date) and !($date instanceof Zend_TimeSync_Protocol) and
            !($date instanceof Zend_Date)) {
            if ($locale instanceof Zend_Locale) {
                $locale = $date;
                $date   = null;
                $part   = null;
            } else {
                $date = (string) $date;
            }
        }

        if (($date !== null) and !is_array($date) and !($date instanceof Zend_TimeSync_Protocol) and
            !($date instanceof Zend_Date) and !defined($date) and Zend_Locale::isLocale($date, true, false)) {
            $locale = $date;
            $date   = null;
            $part   = null;
        } else if (($part !== null) and !defined($part) and Zend_Locale::isLocale($part, true, false)) {
            $locale = $part;
            $part   = null;
        }

        $this->setLocale($locale);
        if (is_string($date) && ($part === null) && (strlen($date) <= 5)) {
            $part = $date;
            $date = null;
        }

        if ($date === null) {
            if ($part === null) {
                $date = time();
            } else if ($part !== self::TIMESTAMP) {
                $date = self::now($locale);
                $date = $date->get($part);
            }
        }

        if ($date instanceof Zend_TimeSync_Protocol) {
            $date = $date->getInfo();
            $date = $this->_getTime($date['offset']);
            $part = null;
        } else if (parent::$_defaultOffset != 0) {
            $date = $this->_getTime(parent::$_defaultOffset);
        }

        // set the timezone and offset for $this
        $zone = @date_default_timezone_get();
        $this->setTimezone($zone);

        // try to get timezone from date-string
        if (!is_int($date)) {
            $zone = $this->getTimezoneFromString($date);
            $this->setTimezone($zone);
        }

        // set datepart
        if (($part !== null && $part !== self::TIMESTAMP) or (!is_numeric($date))) {
            // switch off dst handling for value setting
            $this->setUnixTimestamp($this->getGmtOffset());
            $this->set($date, $part, $this->_locale);

            // DST fix
            if (is_array($date) === true) {
                if (!isset($date['hour'])) {
                    $date['hour'] = 0;
                }

                $hour = $this->toString('H', 'iso', true);
                $hour = $date['hour'] - $hour;
                switch ($hour) {
                    case 1 :
                    case -23 :
                        $this->addTimestamp(3600);
                        break;
                    case -1 :
                    case 23 :
                        $this->subTimestamp(3600);
                        break;
                    case 2 :
                    case -22 :
                        $this->addTimestamp(7200);
                        break;
                    case -2 :
                    case 22 :
                        $this->subTimestamp(7200);
                        break;
                }
            }
        } else {
            $this->setUnixTimestamp($date);
        }
    }

    /**
     * Sets class wide options, if no option was given, the actual set options will be returned
     *
     * @param  array  $options  Options to set
     * @throws Zend_Date_Exception
     * @return Options array if no option was given
     */
    public static function setOptions(array $options = array())
    {
        if (empty($options)) {
            return self::$_options;
        }

        foreach ($options as $name => $value) {
            $name  = strtolower($name);

            if (array_key_exists($name, self::$_options)) {
                switch($name) {
                    case 'format_type' :
                        if ((strtolower($value) != 'php') && (strtolower($value) != 'iso')) {
                            require_once 'Zend/Date/Exception.php';
                            throw new Zend_Date_Exception("Unknown format type ($value) for dates, only 'iso' and 'php' supported", 0, null, $value);
                        }
                        break;
                    case 'fix_dst' :
                        if (!is_bool($value)) {
                            require_once 'Zend/Date/Exception.php';
                            throw new Zend_Date_Exception("'fix_dst' has to be boolean", 0, null, $value);
                        }
                        break;
                    case 'extend_month' :
                        if (!is_bool($value)) {
                            require_once 'Zend/Date/Exception.php';
                            throw new Zend_Date_Exception("'extend_month' has to be boolean", 0, null, $value);
                        }
                        break;
                    case 'cache' :
                        if ($value === null) {
                            parent::$_cache = null;
                        } else {
                            if (!$value instanceof Zend_Cache_Core) {
                                require_once 'Zend/Date/Exception.php';
                                throw new Zend_Date_Exception("Instance of Zend_Cache expected");
                            }

                            parent::$_cache = $value;
                            parent::$_cacheTags = Zend_Date_DateObject::_getTagSupportForCache();
                            Zend_Locale_Data::setCache($value);
                        }
                        break;
                    case 'timesync' :
                        if ($value === null) {
                            parent::$_defaultOffset = 0;
                        } else {
                            if (!$value instanceof Zend_TimeSync_Protocol) {
                                require_once 'Zend/Date/Exception.php';
                                throw new Zend_Date_Exception("Instance of Zend_TimeSync expected");
                            }

                            $date = $value->getInfo();
                            parent::$_defaultOffset = $date['offset'];
                        }
                        break;
                }
                self::$_options[$name] = $value;
            }
            else {
                require_once 'Zend/Date/Exception.php';
                throw new Zend_Date_Exception("Unknown option: $name = $value");
            }
        }
    }

    /**
     * Returns this object's internal UNIX timestamp (equivalent to Zend_Date::TIMESTAMP).
     * If the timestamp is too large for integers, then the return value will be a string.
     * This function does not return the timestamp as an object.
     * Use clone() or copyPart() instead.
     *
     * @return integer|string  UNIX timestamp
     */
    public function getTimestamp()
    {
        return $this->getUnixTimestamp();
    }

    /**
     * Returns the calculated timestamp
     * HINT: timestamps are always GMT
     *
     * @param  string                          $calc    Type of calculation to make
     * @param  string|integer|array|Zend_Date  $stamp   Timestamp to calculate, when null the actual timestamp is calculated
     * @return Zend_Date|integer
     * @throws Zend_Date_Exception
     */
    private function _timestamp($calc, $stamp)
    {
        if ($stamp instanceof Zend_Date) {
            // extract timestamp from object
            $stamp = $stamp->getTimestamp();
        }

        if (is_array($stamp)) {
            if (isset($stamp['timestamp']) === true) {
                $stamp = $stamp['timestamp'];
            } else {
                require_once 'Zend/Date/Exception.php';
                throw new Zend_Date_Exception('no timestamp given in array');
            }
        }

        if ($calc === 'set') {
            $return = $this->setUnixTimestamp($stamp);
        } else {
            $return = $this->_calcdetail($calc, $stamp, self::TIMESTAMP, null);
        }
        if ($calc != 'cmp') {
            return $this;
        }
        return $return;
    }

    /**
     * Sets a new timestamp
     *
     * @param  integer|string|array|Zend_Date  $timestamp  Timestamp to set
     * @return Zend_Date Provides fluid interface
     * @throws Zend_Date_Exception
     */
    public function setTimestamp($timestamp)
    {
        return $this->_timestamp('set', $timestamp);
    }

    /**
     * Adds a timestamp
     *
     * @param  integer|string|array|Zend_Date  $timestamp  Timestamp to add
     * @return Zend_Date Provides fluid interface
     * @throws Zend_Date_Exception
     */
    public function addTimestamp($timestamp)
    {
        return $this->_timestamp('add', $timestamp);
    }

    /**
     * Subtracts a timestamp
     *
     * @param  integer|string|array|Zend_Date  $timestamp  Timestamp to sub
     * @return Zend_Date Provides fluid interface
     * @throws Zend_Date_Exception
     */
    public function subTimestamp($timestamp)
    {
        return $this->_timestamp('sub', $timestamp);
    }

    /**
     * Compares two timestamps, returning the difference as integer
     *
     * @param  integer|string|array|Zend_Date  $timestamp  Timestamp to compare
     * @return integer  0 = equal, 1 = later, -1 = earlier
     * @throws Zend_Date_Exception
     */
    public function compareTimestamp($timestamp)
    {
        return $this->_timestamp('cmp', $timestamp);
    }

    /**
     * Returns a string representation of the object
     * Supported format tokens are:
     * G - era, y - year, Y - ISO year, M - month, w - week of year, D - day of year, d - day of month
     * E - day of week, e - number of weekday (1-7), h - hour 1-12, H - hour 0-23, m - minute, s - second
     * A - milliseconds of day, z - timezone, Z - timezone offset, S - fractional second, a - period of day
     *
     * Additionally format tokens but non ISO conform are:
     * SS - day suffix, eee - php number of weekday(0-6), ddd - number of days per month
     * l - Leap year, B - swatch internet time, I - daylight saving time, X - timezone offset in seconds
     * r - RFC2822 format, U - unix timestamp
     *
     * Not supported ISO tokens are
     * u - extended year, Q - quarter, q - quarter, L - stand alone month, W - week of month
     * F - day of week of month, g - modified julian, c - stand alone weekday, k - hour 0-11, K - hour 1-24
     * v - wall zone
     *
     * @param  string              $format  OPTIONAL Rule for formatting output. If null the default date format is used
     * @param  string              $type    OPTIONAL Type for the format string which overrides the standard setting
     * @param  string|Zend_Locale  $locale  OPTIONAL Locale for parsing input
     * @return string
     */
    public function toString($format = null, $type = null, $locale = null)
    {
        if (is_object($format)) {
            if ($format instanceof Zend_Locale) {
                $locale = $format;
                $format = null;
            } else {
                $format = (string) $format;
            }
        }

        if (is_object($type)) {
            if ($type instanceof Zend_Locale) {
                $locale = $type;
                $type   = null;
            } else {
                $type = (string) $type;
            }
        }

        if (($format !== null) && !defined($format)
            && ($format != 'ee') && ($format != 'ss') && ($format != 'GG') && ($format != 'MM') && ($format != 'EE') && ($format != 'TT')
            && Zend_Locale::isLocale($format, null, false)) {
            $locale = $format;
            $format = null;
        }

        if (($type !== null) and ($type != 'php') and ($type != 'iso') and
            Zend_Locale::isLocale($type, null, false)) {
            $locale = $type;
            $type = null;
        }

        if ($locale === null) {
            $locale = $this->getLocale();
        }

        if ($format === null) {
            $format = Zend_Locale_Format::getDateFormat($locale) . ' ' . Zend_Locale_Format::getTimeFormat($locale);
        } else if (((self::$_options['format_type'] == 'php') && ($type === null)) or ($type == 'php')) {
            $format = Zend_Locale_Format::convertPhpToIsoFormat($format);
        }

        return $this->date($this->_toToken($format, $locale), $this->getUnixTimestamp(), false);
    }

    /**
     * Returns a string representation of the date which is equal with the timestamp
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toString(null, $this->_locale);
    }

    /**
     * Returns a integer representation of the object
     * But returns false when the given part is no value f.e. Month-Name
     *
     * @param  string|integer|Zend_Date  $part  OPTIONAL Defines the date or datepart to return as integer
     * @return integer|false
     */
    public function toValue($part = null)
    {
        $result = $this->get($part);
        if (is_numeric($result)) {
          return intval("$result");
        } else {
          return false;
        }
    }

    /**
     * Returns an array representation of the object
     *
     * @return array
     */
    public function toArray()
    {
        return array('day'       => $this->toString(self::DAY_SHORT, 'iso'),
                     'month'     => $this->toString(self::MONTH_SHORT, 'iso'),
                     'year'      => $this->toString(self::YEAR, 'iso'),
                     'hour'      => $this->toString(self::HOUR_SHORT, 'iso'),
                     'minute'    => $this->toString(self::MINUTE_SHORT, 'iso'),
                     'second'    => $this->toString(self::SECOND_SHORT, 'iso'),
                     'timezone'  => $this->toString(self::TIMEZONE, 'iso'),
                     'timestamp' => $this->toString(self::TIMESTAMP, 'iso'),
                     'weekday'   => $this->toString(self::WEEKDAY_8601, 'iso'),
                     'dayofyear' => $this->toString(self::DAY_OF_YEAR, 'iso'),
                     'week'      => $this->toString(self::WEEK, 'iso'),
                     'gmtsecs'   => $this->toString(self::TIMEZONE_SECS, 'iso'));
    }

    /**
     * Returns a representation of a date or datepart
     * This could be for example a localized monthname, the time without date,
     * the era or only the fractional seconds. There are about 50 different supported date parts.
     * For a complete list of supported datepart values look into the docu
     *
     * @param  string              $part    OPTIONAL Part of the date to return, if null the timestamp is returned
     * @param  string|Zend_Locale  $locale  OPTIONAL Locale for parsing input
     * @return string  date or datepart
     */
    public function get($part = null, $locale = null)
    {
        if ($locale === null) {
            $locale = $this->getLocale();
        }

        if (($part !== null) && !defined($part)
            && ($part != 'ee') && ($part != 'ss') && ($part != 'GG') && ($part != 'MM') && ($part != 'EE') && ($part != 'TT')
            && Zend_Locale::isLocale($part, null, false)) {
            $locale = $part;
            $part = null;
        }

        if ($part === null) {
            $part = self::TIMESTAMP;
        } else if (self::$_options['format_type'] == 'php') {
            $part = Zend_Locale_Format::convertPhpToIsoFormat($part);
        }

        return $this->date($this->_toToken($part, $locale), $this->getUnixTimestamp(), false);
    }

    /**
     * Internal method to apply tokens
     *
     * @param string $part
     * @param string $locale
     * @return string
     */
    private function _toToken($part, $locale) {
        // get format tokens
        $comment = false;
        $format  = '';
        $orig    = '';
        for ($i = 0; isset($part[$i]); ++$i) {
            if ($part[$i] == "'") {
                $comment = $comment ? false : true;
                if (isset($part[$i+1]) && ($part[$i+1] == "'")) {
                    $comment = $comment ? false : true;
                    $format .= "\\'";
                    ++$i;
                }

                $orig = '';
                continue;
            }

            if ($comment) {
                $format .= '\\' . $part[$i];
                $orig = '';
            } else {
                $orig .= $part[$i];
                if (!isset($part[$i+1]) || (isset($orig[0]) && ($orig[0] != $part[$i+1]))) {
                    $format .= $this->_parseIsoToDate($orig, $locale);
                    $orig  = '';
                }
            }
        }

        return $format;
    }

    /**
     * Internal parsing method
     *
     * @param string $token
     * @param string $locale
     * @return string
     */
    private function _parseIsoToDate($token, $locale) {
        switch($token) {
            case self::DAY :
                return 'd';
                break;

            case self::WEEKDAY_SHORT :
                $weekday = strtolower($this->date('D', $this->getUnixTimestamp(), false));
                $day     = Zend_Locale_Data::getContent($locale, 'day', array('gregorian', 'format', 'wide', $weekday));
                return $this->_toComment(iconv_substr($day, 0, 3, 'UTF-8'));
                break;

            case self::DAY_SHORT :
                return 'j';
                break;

            case self::WEEKDAY :
                $weekday = strtolower($this->date('D', $this->getUnixTimestamp(), false));
                return $this->_toComment(Zend_Locale_Data::getContent($locale, 'day', array('gregorian', 'format', 'wide', $weekday)));
                break;

            case self::WEEKDAY_8601 :
                return 'N';
                break;

            case 'ee' :
                return $this->_toComment(str_pad($this->date('N', $this->getUnixTimestamp(), false), 2, '0', STR_PAD_LEFT));
                break;

            case self::DAY_SUFFIX :
                return 'S';
                break;

            case self::WEEKDAY_DIGIT :
                return 'w';
                break;

            case self::DAY_OF_YEAR :
                return 'z';
                break;

            case 'DDD' :
                return $this->_toComment(str_pad($this->date('z', $this->getUnixTimestamp(), false), 3, '0', STR_PAD_LEFT));
                break;

            case 'DD' :
                return $this->_toComment(str_pad($this->date('z', $this->getUnixTimestamp(), false), 2, '0', STR_PAD_LEFT));
                break;

            case self::WEEKDAY_NARROW :
            case 'EEEEE' :
                $weekday = strtolower($this->date('D', $this->getUnixTimestamp(), false));
                $day = Zend_Locale_Data::getContent($locale, 'day', array('gregorian', 'format', 'abbreviated', $weekday));
                return $this->_toComment(iconv_substr($day, 0, 1, 'UTF-8'));
                break;

            case self::WEEKDAY_NAME :
                $weekday = strtolower($this->date('D', $this->getUnixTimestamp(), false));
                return $this->_toComment(Zend_Locale_Data::getContent($locale, 'day', array('gregorian', 'format', 'abbreviated', $weekday)));
                break;

            case 'w' :
                $week = $this->date('W', $this->getUnixTimestamp(), false);
                return $this->_toComment(($week[0] == '0') ? $week[1] : $week);
                break;

            case self::WEEK :
                return 'W';
                break;

            case self::MONTH_NAME :
                $month = $this->date('n', $this->getUnixTimestamp(), false);
                return $this->_toComment(Zend_Locale_Data::getContent($locale, 'month', array('gregorian', 'format', 'wide', $month)));
                break;

            case self::MONTH :
                return 'm';
                break;

            case self::MONTH_NAME_SHORT :
                $month = $this->date('n', $this->getUnixTimestamp(), false);
                return $this->_toComment(Zend_Locale_Data::getContent($locale, 'month', array('gregorian', 'format', 'abbreviated', $month)));
                break;

            case self::MONTH_SHORT :
                return 'n';
                break;

            case self::MONTH_DAYS :
                return 't';
                break;

            case self::MONTH_NAME_NARROW :
                $month = $this->date('n', $this->getUnixTimestamp(), false);
                $mon = Zend_Locale_Data::getContent($locale, 'month', array('gregorian', 'format', 'abbreviated', $month));
                return $this->_toComment(iconv_substr($mon, 0, 1, 'UTF-8'));
                break;

            case self::LEAPYEAR :
                return 'L';
                break;

            case self::YEAR_8601 :
                return 'o';
                break;

            case self::YEAR :
                return 'Y';
                break;

            case self::YEAR_SHORT :
                return 'y';
                break;

            case self::YEAR_SHORT_8601 :
                return $this->_toComment(substr($this->date('o', $this->getUnixTimestamp(), false), -2, 2));
                break;

            case self::MERIDIEM :
                $am = $this->date('a', $this->getUnixTimestamp(), false);
                if ($am == 'am') {
                    return $this->_toComment(Zend_Locale_Data::getContent($locale, 'am'));
                }

                return $this->_toComment(Zend_Locale_Data::getContent($locale, 'pm'));
                break;

            case self::SWATCH :
                return 'B';
                break;

            case self::HOUR_SHORT_AM :
                return 'g';
                break;

            case self::HOUR_SHORT :
                return 'G';
                break;

            case self::HOUR_AM :
                return 'h';
                break;

            case self::HOUR :
                return 'H';
                break;

            case self::MINUTE :
                return $this->_toComment(str_pad($this->date('i', $this->getUnixTimestamp(), false), 2, '0', STR_PAD_LEFT));
                break;

            case self::SECOND :
                return $this->_toComment(str_pad($this->date('s', $this->getUnixTimestamp(), false), 2, '0', STR_PAD_LEFT));
                break;

            case self::MINUTE_SHORT :
                return 'i';
                break;

            case self::SECOND_SHORT :
                return 's';
                break;

            case self::MILLISECOND :
                return $this->_toComment($this->getMilliSecond());
                break;

            case self::TIMEZONE_NAME :
            case 'vvvv' :
                return 'e';
                break;

            case self::DAYLIGHT :
                return 'I';
                break;

            case self::GMT_DIFF :
            case 'ZZ' :
            case 'ZZZ' :
                return 'O';
                break;

            case self::GMT_DIFF_SEP :
                return 'P';
                break;

            case self::TIMEZONE :
            case 'v' :
            case 'zz' :
            case 'zzz' :
                return 'T';
                break;

            case self::TIMEZONE_SECS :
                return 'Z';
                break;

            case self::ISO_8601 :
                return 'c';
                break;

            case self::RFC_2822 :
                return 'r';
                break;

            case self::TIMESTAMP :
                return 'U';
                break;

            case self::ERA :
            case 'GG' :
            case 'GGG' :
                $year = $this->date('Y', $this->getUnixTimestamp(), false);
                if ($year < 0) {
                    return $this->_toComment(Zend_Locale_Data::getContent($locale, 'era', array('gregorian', 'Abbr', '0')));
                }

                return $this->_toComment(Zend_Locale_Data::getContent($locale, 'era', array('gregorian', 'Abbr', '1')));
                break;

            case self::ERA_NARROW :
                $year = $this->date('Y', $this->getUnixTimestamp(), false);
                if ($year < 0) {
                    return $this->_toComment(iconv_substr(Zend_Locale_Data::getContent($locale, 'era', array('gregorian', 'Abbr', '0')), 0, 1, 'UTF-8')) . '.';
                }

                return $this->_toComment(iconv_substr(Zend_Locale_Data::getContent($locale, 'era', array('gregorian', 'Abbr', '1')), 0, 1, 'UTF-8')) . '.';
                break;

            case self::ERA_NAME :
                $year = $this->date('Y', $this->getUnixTimestamp(), false);
                if ($year < 0) {
                    return $this->_toComment(Zend_Locale_Data::getContent($locale, 'era', array('gregorian', 'Names', '0')));
                }

                return $this->_toComment(Zend_Locale_Data::getContent($locale, 'era', array('gregorian', 'Names', '1')));
                break;

            case self::DATES :
                return $this->_toToken(Zend_Locale_Format::getDateFormat($locale), $locale);
                break;

            case self::DATE_FULL :
                return $this->_toToken(Zend_Locale_Data::getContent($locale, 'date', array('gregorian', 'full')), $locale);
                break;

            case self::DATE_LONG :
                return $this->_toToken(Zend_Locale_Data::getContent($locale, 'date', array('gregorian', 'long')), $locale);
                break;

            case self::DATE_MEDIUM :
                return $this->_toToken(Zend_Locale_Data::getContent($locale, 'date', array('gregorian', 'medium')), $locale);
                break;

            case self::DATE_SHORT :
                return $this->_toToken(Zend_Locale_Data::getContent($locale, 'date', array('gregorian', 'short')), $locale);
                break;

            case self::TIMES :
                return $this->_toToken(Zend_Locale_Format::getTimeFormat($locale), $locale);
                break;

            case self::TIME_FULL :
                return $this->_toToken(Zend_Locale_Data::getContent($locale, 'time', 'full'), $locale);
                break;

            case self::TIME_LONG :
                return $this->_toToken(Zend_Locale_Data::getContent($locale, 'time', 'long'), $locale);
                break;

            case self::TIME_MEDIUM :
                return $this->_toToken(Zend_Locale_Data::getContent($locale, 'time', 'medium'), $locale);
                break;

            case self::TIME_SHORT :
                return $this->_toToken(Zend_Locale_Data::getContent($locale, 'time', 'short'), $locale);
                break;

            case self::DATETIME :
                return $this->_toToken(Zend_Locale_Format::getDateTimeFormat($locale), $locale);
                break;

            case self::DATETIME_FULL :
                return $this->_toToken(Zend_Locale_Data::getContent($locale, 'datetime', array('gregorian', 'full')), $locale);
                break;

            case self::DATETIME_LONG :
                return $this->_toToken(Zend_Locale_Data::getContent($locale, 'datetime', array('gregorian', 'long')), $locale);
                break;

            case self::DATETIME_MEDIUM :
                return $this->_toToken(Zend_Locale_Data::getContent($locale, 'datetime', array('gregorian', 'medium')), $locale);
                break;

            case self::DATETIME_SHORT :
                return $this->_toToken(Zend_Locale_Data::getContent($locale, 'datetime', array('gregorian', 'short')), $locale);
                break;

            case self::ATOM :
                return 'Y\-m\-d\TH\:i\:sP';
                break;

            case self::COOKIE :
                return 'l\, d\-M\-y H\:i\:s e';
                break;

            case self::RFC_822 :
                return 'D\, d M y H\:i\:s O';
                break;

            case self::RFC_850 :
                return 'l\, d\-M\-y H\:i\:s e';
                break;

            case self::RFC_1036 :
                return 'D\, d M y H\:i\:s O';
                break;

            case self::RFC_1123 :
                return 'D\, d M Y H\:i\:s O';
                break;

            case self::RFC_3339 :
                return 'Y\-m\-d\TH\:i\:sP';
                break;

            case self::RSS :
                return 'D\, d M Y H\:i\:s O';
                break;

            case self::W3C :
                return 'Y\-m\-d\TH\:i\:sP';
                break;
        }

        if ($token == '') {
            return '';
        }

        switch ($token[0]) {
            case 'y' :
                if ((strlen($token) == 4) && (abs($this->getUnixTimestamp()) <= 0x7FFFFFFF)) {
                    return 'Y';
                }

                $length = iconv_strlen($token, 'UTF-8');
                return $this->_toComment(str_pad($this->date('Y', $this->getUnixTimestamp(), false), $length, '0', STR_PAD_LEFT));
                break;

            case 'Y' :
                if ((strlen($token) == 4) && (abs($this->getUnixTimestamp()) <= 0x7FFFFFFF)) {
                    return 'o';
                }

                $length = iconv_strlen($token, 'UTF-8');
                return $this->_toComment(str_pad($this->date('o', $this->getUnixTimestamp(), false), $length, '0', STR_PAD_LEFT));
                break;

            case 'A' :
                $length  = iconv_strlen($token, 'UTF-8');
                $result  = substr($this->getMilliSecond(), 0, 3);
                $result += $this->date('s', $this->getUnixTimestamp(), false) * 1000;
                $result += $this->date('i', $this->getUnixTimestamp(), false) * 60000;
                $result += $this->date('H', $this->getUnixTimestamp(), false) * 3600000;

                return $this->_toComment(str_pad($result, $length, '0', STR_PAD_LEFT));
                break;
        }

        return $this->_toComment($token);
    }

    /**
     * Private function to make a comment of a token
     *
     * @param string $token
     * @return string
     */
    private function _toComment($token)
    {
        $token = str_split($token);
        $result = '';
        foreach ($token as $tok) {
            $result .= '\\' . $tok;
        }

        return $result;
    }

    /**
     * Return digit from standard names (english)
     * Faster implementation than locale aware searching
     *
     * @param  string  $name
     * @return integer  Number of this month
     * @throws Zend_Date_Exception
     */
    private function _getDigitFromName($name)
    {
        switch($name) {
            case "Jan":
                return 1;

            case "Feb":
                return 2;

            case "Mar":
                return 3;

            case "Apr":
                return 4;

            case "May":
                return 5;

            case "Jun":
                return 6;

            case "Jul":
                return 7;

            case "Aug":
                return 8;

            case "Sep":
                return 9;

            case "Oct":
                return 10;

            case "Nov":
                return 11;

            case "Dec":
                return 12;

            default:
                require_once 'Zend/Date/Exception.php';
                throw new Zend_Date_Exception('Month ($name) is not a known month');
        }
    }

    /**
     * Counts the exact year number
     * < 70 - 2000 added, >70 < 100 - 1900, others just returned
     *
     * @param  integer  $value year number
     * @return integer  Number of year
     */
    public static function getFullYear($value)
    {
        if ($value >= 0) {
            if ($value < 70) {
                $value += 2000;
            } else if ($value < 100) {
                $value += 1900;
            }
        }
        return $value;
    }

    /**
     * Sets the given date as new date or a given datepart as new datepart returning the new datepart
     * This could be for example a localized dayname, the date without time,
     * the month or only the seconds. There are about 50 different supported date parts.
     * For a complete list of supported datepart values look into the docu
     *
     * @param  string|integer|array|Zend_Date  $date    Date or datepart to set
     * @param  string                          $part    OPTIONAL Part of the date to set, if null the timestamp is set
     * @param  string|Zend_Locale              $locale  OPTIONAL Locale for parsing input
     * @return Zend_Date Provides fluid interface
     * @throws Zend_Date_Exception
     */
    public function set($date, $part = null, $locale = null)
    {
        if (self::$_options['format_type'] == 'php') {
            $part = Zend_Locale_Format::convertPhpToIsoFormat($part);
        }

        $zone = $this->getTimezoneFromString($date);
        $this->setTimezone($zone);

        $this->_calculate('set', $date, $part, $locale);
        return $this;
    }

    /**
     * Adds a date or datepart to the existing date, by extracting $part from $date,
     * and modifying this object by adding that part.  The $part is then extracted from
     * this object and returned as an integer or numeric string (for large values, or $part's
     * corresponding to pre-defined formatted date strings).
     * This could be for example a ISO 8601 date, the hour the monthname or only the minute.
     * There are about 50 different supported date parts.
     * For a complete list of supported datepart values look into the docu.
     *
     * @param  string|integer|array|Zend_Date  $date    Date or datepart to add
     * @param  string                          $part    OPTIONAL Part of the date to add, if null the timestamp is added
     * @param  string|Zend_Locale              $locale  OPTIONAL Locale for parsing input
     * @return Zend_Date Provides fluid interface
     * @throws Zend_Date_Exception
     */
    public function add($date, $part = self::TIMESTAMP, $locale = null)
    {
        if (self::$_options['format_type'] == 'php') {
            $part = Zend_Locale_Format::convertPhpToIsoFormat($part);
        }

        $this->_calculate('add', $date, $part, $locale);
        return $this;
    }

    /**
     * Subtracts a date from another date.
     * This could be for example a RFC2822 date, the time,
     * the year or only the timestamp. There are about 50 different supported date parts.
     * For a complete list of supported datepart values look into the docu
     * Be aware: Adding -2 Months is not equal to Subtracting 2 Months !!!
     *
     * @param  string|integer|array|Zend_Date  $date    Date or datepart to subtract
     * @param  string                          $part    OPTIONAL Part of the date to sub, if null the timestamp is subtracted
     * @param  string|Zend_Locale              $locale  OPTIONAL Locale for parsing input
     * @return Zend_Date Provides fluid interface
     * @throws Zend_Date_Exception
     */
    public function sub($date, $part = self::TIMESTAMP, $locale = null)
    {
        if (self::$_options['format_type'] == 'php') {
            $part = Zend_Locale_Format::convertPhpToIsoFormat($part);
        }

        $this->_calculate('sub', $date, $part, $locale);
        return $this;
    }

    /**
     * Compares a date or datepart with the existing one.
     * Returns -1 if earlier, 0 if equal and 1 if later.
     *
     * @param  string|integer|array|Zend_Date  $date    Date or datepart to compare with the date object
     * @param  string                          $part    OPTIONAL Part of the date to compare, if null the timestamp is subtracted
     * @param  string|Zend_Locale              $locale  OPTIONAL Locale for parsing input
     * @return integer  0 = equal, 1 = later, -1 = earlier
     * @throws Zend_Date_Exception
     */
    public function compare($date, $part = self::TIMESTAMP, $locale = null)
    {
        if (self::$_options['format_type'] == 'php') {
            $part = Zend_Locale_Format::convertPhpToIsoFormat($part);
        }

        $compare = $this->_calculate('cmp', $date, $part, $locale);

        if ($compare > 0) {
            return 1;
        } else if ($compare < 0) {
            return -1;
        }
        return 0;
    }

    /**
     * Returns a new instance of Zend_Date with the selected part copied.
     * To make an exact copy, use PHP's clone keyword.
     * For a complete list of supported date part values look into the docu.
     * If a date part is copied, all other date parts are set to standard values.
     * For example: If only YEAR is copied, the returned date object is equal to
     * 01-01-YEAR 00:00:00 (01-01-1970 00:00:00 is equal to timestamp 0)
     * If only HOUR is copied, the returned date object is equal to
     * 01-01-1970 HOUR:00:00 (so $this contains a timestamp equal to a timestamp of 0 plus HOUR).
     *
     * @param  string              $part    Part of the date to compare, if null the timestamp is subtracted
     * @param  string|Zend_Locale  $locale  OPTIONAL New object's locale.  No adjustments to timezone are made.
     * @return Zend_Date New clone with requested part
     */
    public function copyPart($part, $locale = null)
    {
        $clone = clone $this;           // copy all instance variables
        $clone->setUnixTimestamp(0);    // except the timestamp
        if ($locale != null) {
            $clone->setLocale($locale); // set an other locale if selected
        }
        $clone->set($this, $part);
        return $clone;
    }

    /**
     * Internal function, returns the offset of a given timezone
     *
     * @param string $zone
     * @return integer
     */
    public function getTimezoneFromString($zone)
    {
        if (is_array($zone)) {
            return $this->getTimezone();
        }

        if ($zone instanceof Zend_Date) {
            return $zone->getTimezone();
        }

        $match = array();
        preg_match('/\dZ$/', $zone, $match);
        if (!empty($match)) {
            return "Etc/UTC";
        }

        preg_match('/([+-]\d{2}):{0,1}\d{2}/', $zone, $match);
        if (!empty($match) and ($match[count($match) - 1] <= 12) and ($match[count($match) - 1] >= -12)) {
            $zone = "Etc/GMT";
            $zone .= ($match[count($match) - 1] < 0) ? "+" : "-";
            $zone .= (int) abs($match[count($match) - 1]);
            return $zone;
        }

        preg_match('/([[:alpha:]\/]{3,30})(?!.*([[:alpha:]\/]{3,30}))/', $zone, $match);
        try {
            if (!empty($match) and (!is_int($match[count($match) - 1]))) {
                $oldzone = $this->getTimezone();
                $this->setTimezone($match[count($match) - 1]);
                $result = $this->getTimezone();
                $this->setTimezone($oldzone);
                if ($result !== $oldzone) {
                    return $match[count($match) - 1];
                }
            }
        } catch (Exception $e) {
            // fall through
        }

        return $this->getTimezone();
    }

    /**
     * Calculates the date or object
     *
     * @param  string                    $calc  Calculation to make
     * @param  string|integer            $date  Date for calculation
     * @param  string|integer            $comp  Second date for calculation
     * @param  boolean|integer           $dst   Use dst correction if option is set
     * @return integer|string|Zend_Date  new timestamp or Zend_Date depending on calculation
     */
    private function _assign($calc, $date, $comp = 0, $dst = false)
    {
        switch ($calc) {
            case 'set' :
                if (!empty($comp)) {
                    $this->setUnixTimestamp(call_user_func(Zend_Locale_Math::$sub, $this->getUnixTimestamp(), $comp));
                }
                $this->setUnixTimestamp(call_user_func(Zend_Locale_Math::$add, $this->getUnixTimestamp(), $date));
                $value = $this->getUnixTimestamp();
                break;
            case 'add' :
                $this->setUnixTimestamp(call_user_func(Zend_Locale_Math::$add, $this->getUnixTimestamp(), $date));
                $value = $this->getUnixTimestamp();
                break;
            case 'sub' :
                $this->setUnixTimestamp(call_user_func(Zend_Locale_Math::$sub, $this->getUnixTimestamp(), $date));
                $value = $this->getUnixTimestamp();
                break;
            default :
                // cmp - compare
                return call_user_func(Zend_Locale_Math::$comp, $comp, $date);
                break;
        }

        // dst-correction if 'fix_dst' = true and dst !== false but only for non UTC and non GMT
        if ((self::$_options['fix_dst'] === true) and ($dst !== false) and ($this->_dst === true)) {
            $hour = $this->toString(self::HOUR, 'iso');
            if ($hour != $dst) {
                if (($dst == ($hour + 1)) or ($dst == ($hour - 23))) {
                    $value += 3600;
                } else if (($dst == ($hour - 1)) or ($dst == ($hour + 23))) {
                    $value -= 3600;
                }
                $this->setUnixTimestamp($value);
            }
        }
        return $this->getUnixTimestamp();
    }


    /**
     * Calculates the date or object
     *
     * @param  string                          $calc    Calculation to make, one of: 'add'|'sub'|'cmp'|'copy'|'set'
     * @param  string|integer|array|Zend_Date  $date    Date or datepart to calculate with
     * @param  string                          $part    Part of the date to calculate, if null the timestamp is used
     * @param  string|Zend_Locale              $locale  Locale for parsing input
     * @return integer|string|Zend_Date        new timestamp
     * @throws Zend_Date_Exception
     */
    private function _calculate($calc, $date, $part, $locale)
    {
        if ($date === null) {
            require_once 'Zend/Date/Exception.php';
            throw new Zend_Date_Exception('parameter $date must be set, null is not allowed');
        }

        if (($part !== null) && (strlen($part) !== 2) && (Zend_Locale::isLocale($part, null, false))) {
            $locale = $part;
            $part   = null;
        }

        if ($locale === null) {
            $locale = $this->getLocale();
        }

        $locale = (string) $locale;

        // Create date parts
        $year   = $this->toString(self::YEAR, 'iso');
        $month  = $this->toString(self::MONTH_SHORT, 'iso');
        $day    = $this->toString(self::DAY_SHORT, 'iso');
        $hour   = $this->toString(self::HOUR_SHORT, 'iso');
        $minute = $this->toString(self::MINUTE_SHORT, 'iso');
        $second = $this->toString(self::SECOND_SHORT, 'iso');
        // If object extract value
        if ($date instanceof Zend_Date) {
            $date = $date->toString($part, 'iso', $locale);
        }

        if (is_array($date) === true) {
            if (empty($part) === false) {
                switch($part) {
                    // Fall through
                    case self::DAY:
                    case self::DAY_SHORT:
                        if (isset($date['day']) === true) {
                            $date = $date['day'];
                        }
                        break;
                    // Fall through
                    case self::WEEKDAY_SHORT:
                    case self::WEEKDAY:
                    case self::WEEKDAY_8601:
                    case self::WEEKDAY_DIGIT:
                    case self::WEEKDAY_NARROW:
                    case self::WEEKDAY_NAME:
                        if (isset($date['weekday']) === true) {
                            $date = $date['weekday'];
                            $part = self::WEEKDAY_DIGIT;
                        }
                        break;
                    case self::DAY_OF_YEAR:
                        if (isset($date['day_of_year']) === true) {
                            $date = $date['day_of_year'];
                        }
                        break;
                    // Fall through
                    case self::MONTH:
                    case self::MONTH_SHORT:
                    case self::MONTH_NAME:
                    case self::MONTH_NAME_SHORT:
                    case self::MONTH_NAME_NARROW:
                        if (isset($date['month']) === true) {
                            $date = $date['month'];
                        }
                        break;
                    // Fall through
                    case self::YEAR:
                    case self::YEAR_SHORT:
                    case self::YEAR_8601:
                    case self::YEAR_SHORT_8601:
                        if (isset($date['year']) === true) {
                            $date = $date['year'];
                        }
                        break;
                    // Fall through
                    case self::HOUR:
                    case self::HOUR_AM:
                    case self::HOUR_SHORT:
                    case self::HOUR_SHORT_AM:
                        if (isset($date['hour']) === true) {
                            $date = $date['hour'];
                        }
                        break;
                    // Fall through
                    case self::MINUTE:
                    case self::MINUTE_SHORT:
                        if (isset($date['minute']) === true) {
                            $date = $date['minute'];
                        }
                        break;
                    // Fall through
                    case self::SECOND:
                    case self::SECOND_SHORT:
                        if (isset($date['second']) === true) {
                            $date = $date['second'];
                        }
                        break;
                    // Fall through
                    case self::TIMEZONE:
                    case self::TIMEZONE_NAME:
                        if (isset($date['timezone']) === true) {
                            $date = $date['timezone'];
                        }
                        break;
                    case self::TIMESTAMP:
                        if (isset($date['timestamp']) === true) {
                            $date = $date['timestamp'];
                        }
                        break;
                    case self::WEEK:
                        if (isset($date['week']) === true) {
                            $date = $date['week'];
                        }
                        break;
                    case self::TIMEZONE_SECS:
                        if (isset($date['gmtsecs']) === true) {
                            $date = $date['gmtsecs'];
                        }
                        break;
                    default:
                        require_once 'Zend/Date/Exception.php';
                        throw new Zend_Date_Exception("datepart for part ($part) not found in array");
                        break;
                }
            } else {
                $hours = 0;
                if (isset($date['hour']) === true) {
                    $hours = $date['hour'];
                }
                $minutes = 0;
                if (isset($date['minute']) === true) {
                    $minutes = $date['minute'];
                }
                $seconds = 0;
                if (isset($date['second']) === true) {
                    $seconds = $date['second'];
                }
                $months = 0;
                if (isset($date['month']) === true) {
                    $months = $date['month'];
                }
                $days = 0;
                if (isset($date['day']) === true) {
                    $days = $date['day'];
                }
                $years = 0;
                if (isset($date['year']) === true) {
                    $years = $date['year'];
                }
                return $this->_assign($calc, $this->mktime($hours, $minutes, $seconds, $months, $days, $years, true),
                                             $this->mktime($hour, $minute, $second, $month, $day, $year, true), $hour);
            }
        }

        // $date as object, part of foreign date as own date
        switch($part) {

            // day formats
            case self::DAY:
                if (is_numeric($date)) {
                    return $this->_assign($calc, $this->mktime(0, 0, 0, 1, 1 + intval($date), 1970, true),
                                                 $this->mktime(0, 0, 0, 1, 1 + intval($day), 1970, true), $hour);
                }

                require_once 'Zend/Date/Exception.php';
                throw new Zend_Date_Exception("invalid date ($date) operand, day expected", 0, null, $date);
                break;

            case self::WEEKDAY_SHORT:
                $daylist = Zend_Locale_Data::getList($locale, 'day');
                $weekday = (int) $this->toString(self::WEEKDAY_DIGIT, 'iso', $locale);
                $cnt = 0;

                foreach ($daylist as $key => $value) {
                    if (strtoupper(iconv_substr($value, 0, 3, 'UTF-8')) == strtoupper($date)) {
                         $found = $cnt;
                        break;
                    }
                    ++$cnt;
                }

                // Weekday found
                if ($cnt < 7) {
                    return $this->_assign($calc, $this->mktime(0, 0, 0, 1, 1 + $found, 1970, true),
                                                 $this->mktime(0, 0, 0, 1, 1 + $weekday, 1970, true), $hour);
                }

                // Weekday not found
                require_once 'Zend/Date/Exception.php';
                throw new Zend_Date_Exception("invalid date ($date) operand, weekday expected", 0, null, $date);
                break;

            case self::DAY_SHORT:
                if (is_numeric($date)) {
                    return $this->_assign($calc, $this->mktime(0, 0, 0, 1, 1 + intval($date), 1970, true),
                                                 $this->mktime(0, 0, 0, 1, 1 + intval($day), 1970, true), $hour);
                }

                require_once 'Zend/Date/Exception.php';
                throw new Zend_Date_Exception("invalid date ($date) operand, day expected", 0, null, $date);
                break;

            case self::WEEKDAY:
                $daylist = Zend_Locale_Data::getList($locale, 'day');
                $weekday = (int) $this->toString(self::WEEKDAY_DIGIT, 'iso', $locale);
                $cnt = 0;

                foreach ($daylist as $key => $value) {
                    if (strtoupper($value) == strtoupper($date)) {
                        $found = $cnt;
                        break;
                    }
                    ++$cnt;
                }

                // Weekday found
                if ($cnt < 7) {
                    return $this->_assign($calc, $this->mktime(0, 0, 0, 1, 1 + $found, 1970, true),
                                                 $this->mktime(0, 0, 0, 1, 1 + $weekday, 1970, true), $hour);
                }

                // Weekday not found
                require_once 'Zend/Date/Exception.php';
                throw new Zend_Date_Exception("invalid date ($date) operand, weekday expected", 0, null, $date);
                break;

            case self::WEEKDAY_8601:
                $weekday = (int) $this->toString(self::WEEKDAY_8601, 'iso', $locale);
                if ((intval($date) > 0) and (intval($date) < 8)) {
                    return $this->_assign($calc, $this->mktime(0, 0, 0, 1, 1 + intval($date), 1970, true),
                                                 $this->mktime(0, 0, 0, 1, 1 + $weekday, 1970, true), $hour);
                }

                // Weekday not found
                require_once 'Zend/Date/Exception.php';
                throw new Zend_Date_Exception("invalid date ($date) operand, weekday expected", 0, null, $date);
                break;

            case self::DAY_SUFFIX:
                require_once 'Zend/Date/Exception.php';
                throw new Zend_Date_Exception('day suffix not supported', 0, null, $date);
                break;

            case self::WEEKDAY_DIGIT:
                $weekday = (int) $this->toString(self::WEEKDAY_DIGIT, 'iso', $locale);
                if (is_numeric($date) and (intval($date) >= 0) and (intval($date) < 7)) {
                    return $this->_assign($calc, $this->mktime(0, 0, 0, 1, 1 + $date, 1970, true),
                                                 $this->mktime(0, 0, 0, 1, 1 + $weekday, 1970, true), $hour);
                }

                // Weekday not found
                require_once 'Zend/Date/Exception.php';
                throw new Zend_Date_Exception("invalid date ($date) operand, weekday expected", 0, null, $date);
                break;

            case self::DAY_OF_YEAR:
                if (is_numeric($date)) {
                    if (($calc == 'add') || ($calc == 'sub')) {
                        $year = 1970;
                        ++$date;
                        ++$day;
                    }

                    return $this->_assign($calc, $this->mktime(0, 0, 0, 1, $date, $year, true),
                                                 $this->mktime(0, 0, 0, $month, $day, $year, true), $hour);
                }

                require_once 'Zend/Date/Exception.php';
                throw new Zend_Date_Exception("invalid date ($date) operand, day expected", 0, null, $date);
                break;

            case self::WEEKDAY_NARROW:
                $daylist = Zend_Locale_Data::getList($locale, 'day', array('gregorian', 'format', 'abbreviated'));
                $weekday = (int) $this->toString(self::WEEKDAY_DIGIT, 'iso', $locale);
                $cnt = 0;
                foreach ($daylist as $key => $value) {
                    if (strtoupper(iconv_substr($value, 0, 1, 'UTF-8')) == strtoupper($date)) {
                        $found = $cnt;
                        break;
                    }
                    ++$cnt;
                }

                // Weekday found
                if ($cnt < 7) {
                    return $this->_assign($calc, $this->mktime(0, 0, 0, 1, 1 + $found, 1970, true),
                                                 $this->mktime(0, 0, 0, 1, 1 + $weekday, 1970, true), $hour);
                }

                // Weekday not found
                require_once 'Zend/Date/Exception.php';
                throw new Zend_Date_Exception("invalid date ($date) operand, weekday expected", 0, null, $date);
                break;

            case self::WEEKDAY_NAME:
                $daylist = Zend_Locale_Data::getList($locale, 'day', array('gregorian', 'format', 'abbreviated'));
                $weekday = (int) $this->toString(self::WEEKDAY_DIGIT, 'iso', $locale);
                $cnt = 0;
                foreach ($daylist as $key => $value) {
                    if (strtoupper($value) == strtoupper($date)) {
                        $found = $cnt;
                        break;
                    }
                    ++$cnt;
                }

                // Weekday found
                if ($cnt < 7) {
                    return $this->_assign($calc, $this->mktime(0, 0, 0, 1, 1 + $found, 1970, true),
                                                 $this->mktime(0, 0, 0, 1, 1 + $weekday, 1970, true), $hour);
                }

                // Weekday not found
                require_once 'Zend/Date/Exception.php';
                throw new Zend_Date_Exception("invalid date ($date) operand, weekday expected", 0, null, $date);
                break;

            // week formats
            case self::WEEK:
                if (is_numeric($date)) {
                    $week = (int) $this->toString(self::WEEK, 'iso', $locale);
                    return $this->_assign($calc, parent::mktime(0, 0, 0, 1, 1 + ($date * 7), 1970, true),
                                                 parent::mktime(0, 0, 0, 1, 1 + ($week * 7), 1970, true), $hour);
                }

                require_once 'Zend/Date/Exception.php';
                throw new Zend_Date_Exception("invalid date ($date) operand, week expected", 0, null, $date);
                break;

            // month formats
            case self::MONTH_NAME:
                $monthlist = Zend_Locale_Data::getList($locale, 'month');
                $cnt = 0;
                foreach ($monthlist as $key => $value) {
                    if (strtoupper($value) == strtoupper($date)) {
                        $found = $key;
                        break;
                    }
                    ++$cnt;
                }
                $date = array_search($date, $monthlist);

                // Monthname found
                if ($cnt < 12) {
                    $fixday = 0;
                    if ($calc == 'add') {
                        $date += $found;
                        $calc = 'set';
                        if (self::$_options['extend_month'] == false) {
                            $parts = $this->getDateParts($this->mktime($hour, $minute, $second, $date, $day, $year, false));
                            if ($parts['mday'] != $day) {
                                $fixday = ($parts['mday'] < $day) ? -$parts['mday'] : ($parts['mday'] - $day);
                            }
                        }
                    } else if ($calc == 'sub') {
                        $date = $month - $found;
                        $calc = 'set';
                        if (self::$_options['extend_month'] == false) {
                            $parts = $this->getDateParts($this->mktime($hour, $minute, $second, $date, $day, $year, false));
                            if ($parts['mday'] != $day) {
                                $fixday = ($parts['mday'] < $day) ? -$parts['mday'] : ($parts['mday'] - $day);
                            }
                        }
                    }
                    return $this->_assign($calc, $this->mktime(0, 0, 0, $date,  $day + $fixday, $year, true),
                                                 $this->mktime(0, 0, 0, $month, $day, $year, true), $hour);
                }

                // Monthname not found
                require_once 'Zend/Date/Exception.php';
                throw new Zend_Date_Exception("invalid date ($date) operand, month expected", 0, null, $date);
                break;

            case self::MONTH:
                if (is_numeric($date)) {
                    $fixday = 0;
                    if ($calc == 'add') {
                        $date += $month;
                        $calc = 'set';
                        if (self::$_options['extend_month'] == false) {
                            $parts = $this->getDateParts($this->mktime($hour, $minute, $second, $date, $day, $year, false));
                            if ($parts['mday'] != $day) {
                                $fixday = ($parts['mday'] < $day) ? -$parts['mday'] : ($parts['mday'] - $day);
                            }
                        }
                    } else if ($calc == 'sub') {
                        $date = $month - $date;
                        $calc = 'set';
                        if (self::$_options['extend_month'] == false) {
                            $parts = $this->getDateParts($this->mktime($hour, $minute, $second, $date, $day, $year, false));
                            if ($parts['mday'] != $day) {
                                $fixday = ($parts['mday'] < $day) ? -$parts['mday'] : ($parts['mday'] - $day);
                            }
                        }
                    }
                    return $this->_assign($calc, $this->mktime(0, 0, 0, $date, $day + $fixday, $year, true),
                                                 $this->mktime(0, 0, 0, $month, $day, $year, true), $hour);
                }

                require_once 'Zend/Date/Exception.php';
                throw new Zend_Date_Exception("invalid date ($date) operand, month expected", 0, null, $date);
                break;

            case self::MONTH_NAME_SHORT:
                $monthlist = Zend_Locale_Data::getList($locale, 'month', array('gregorian', 'format', 'abbreviated'));
                $cnt = 0;
                foreach ($monthlist as $key => $value) {
                    if (strtoupper($value) == strtoupper($date)) {
                        $found = $key;
                        break;
                    }
                    ++$cnt;
                }
                $date = array_search($date, $monthlist);

                // Monthname found
                if ($cnt < 12) {
                    $fixday = 0;
                    if ($calc == 'add') {
                        $date += $found;
                        $calc = 'set';
                        if (self::$_options['extend_month'] === false) {
                            $parts = $this->getDateParts($this->mktime($hour, $minute, $second, $date, $day, $year, false));
                            if ($parts['mday'] != $day) {
                                $fixday = ($parts['mday'] < $day) ? -$parts['mday'] : ($parts['mday'] - $day);
                            }
                        }
                    } else if ($calc == 'sub') {
                        $date = $month - $found;
                        $calc = 'set';
                        if (self::$_options['extend_month'] === false) {
                            $parts = $this->getDateParts($this->mktime($hour, $minute, $second, $date, $day, $year, false));
                            if ($parts['mday'] != $day) {
                                $fixday = ($parts['mday'] < $day) ? -$parts['mday'] : ($parts['mday'] - $day);
                            }
                        }
                    }
                    return $this->_assign($calc, $this->mktime(0, 0, 0, $date, $day + $fixday, $year, true),
                                                 $this->mktime(0, 0, 0, $month, $day, $year, true), $hour);
                }

                // Monthname not found
                require_once 'Zend/Date/Exception.php';
                throw new Zend_Date_Exception("invalid date ($date) operand, month expected", 0, null, $date);
                break;

            case self::MONTH_SHORT:
                if (is_numeric($date) === true) {
                    $fixday = 0;
                    if ($calc === 'add') {
                        $date += $month;
                        $calc  = 'set';
                        if (self::$_options['extend_month'] === false) {
                            $parts = $this->getDateParts($this->mktime($hour, $minute, $second, $date, $day, $year, false));
                            if ($parts['mday'] != $day) {
                                $fixday = ($parts['mday'] < $day) ? -$parts['mday'] : ($parts['mday'] - $day);
                            }
                        }
                    } else if ($calc === 'sub') {
                        $date = $month - $date;
                        $calc = 'set';
                        if (self::$_options['extend_month'] === false) {
                            $parts = $this->getDateParts($this->mktime($hour, $minute, $second, $date, $day, $year, false));
                            if ($parts['mday'] != $day) {
                                $fixday = ($parts['mday'] < $day) ? -$parts['mday'] : ($parts['mday'] - $day);
                            }
                        }
                    }

                    return $this->_assign($calc, $this->mktime(0, 0, 0, $date,  $day + $fixday, $year, true),
                                                 $this->mktime(0, 0, 0, $month, $day,           $year, true), $hour);
                }

                require_once 'Zend/Date/Exception.php';
                throw new Zend_Date_Exception("invalid date ($date) operand, month expected", 0, null, $date);
                break;

            case self::MONTH_DAYS:
                require_once 'Zend/Date/Exception.php';
                throw new Zend_Date_Exception('month days not supported', 0, null, $date);
                break;

            case self::MONTH_NAME_NARROW:
                $monthlist = Zend_Locale_Data::getList($locale, 'month', array('gregorian', 'stand-alone', 'narrow'));
                $cnt       = 0;
                foreach ($monthlist as $key => $value) {
                    if (strtoupper($value) === strtoupper($date)) {
                        $found = $key;
                        break;
                    }
                    ++$cnt;
                }
                $date = array_search($date, $monthlist);

                // Monthname found
                if ($cnt < 12) {
                    $fixday = 0;
                    if ($calc === 'add') {
                        $date += $found;
                        $calc  = 'set';
                        if (self::$_options['extend_month'] === false) {
                            $parts = $this->getDateParts($this->mktime($hour, $minute, $second, $date, $day, $year, false));
                            if ($parts['mday'] != $day) {
                                $fixday = ($parts['mday'] < $day) ? -$parts['mday'] : ($parts['mday'] - $day);
                            }
                        }
                    } else if ($calc === 'sub') {
                        $date = $month - $found;
                        $calc = 'set';
                        if (self::$_options['extend_month'] === false) {
                            $parts = $this->getDateParts($this->mktime($hour, $minute, $second, $date, $day, $year, false));
                            if ($parts['mday'] != $day) {
                                $fixday = ($parts['mday'] < $day) ? -$parts['mday'] : ($parts['mday'] - $day);
                            }
                        }
                    }
                    return $this->_assign($calc, $this->mktime(0, 0, 0, $date,  $day + $fixday, $year, true),
                                                 $this->mktime(0, 0, 0, $month, $day,           $year, true), $hour);
                }

                // Monthname not found
                require_once 'Zend/Date/Exception.php';
                throw new Zend_Date_Exception("invalid date ($date) operand, month expected", 0, null, $date);
                break;

            // year formats
            case self::LEAPYEAR:
                require_once 'Zend/Date/Exception.php';
                throw new Zend_Date_Exception('leap year not supported', 0, null, $date);
                break;

            case self::YEAR_8601:
                if (is_numeric($date)) {
                    if ($calc === 'add') {
                        $date += $year;
                        $calc  = 'set';
                    } else if ($calc === 'sub') {
                        $date = $year - $date;
                        $calc = 'set';
                    }

                    return $this->_assign($calc, $this->mktime(0, 0, 0, $month, $day, intval($date), true),
                                                 $this->mktime(0, 0, 0, $month, $day, $year,         true), false);
                }

                require_once 'Zend/Date/Exception.php';
                throw new Zend_Date_Exception("invalid date ($date) operand, year expected", 0, null, $date);
                break;

            case self::YEAR:
                if (is_numeric($date)) {
                    if ($calc === 'add') {
                        $date += $year;
                        $calc  = 'set';
                    } else if ($calc === 'sub') {
                        $date = $year - $date;
                        $calc = 'set';
                    }

                    return $this->_assign($calc, $this->mktime(0, 0, 0, $month, $day, intval($date), true),
                                                 $this->mktime(0, 0, 0, $month, $day, $year,         true), false);
                }

                require_once 'Zend/Date/Exception.php';
                throw new Zend_Date_Exception("invalid date ($date) operand, year expected", 0, null, $date);
                break;

            case self::YEAR_SHORT:
                if (is_numeric($date)) {
                    $date = intval($date);
                    if (($calc == 'set') || ($calc == 'cmp')) {
                        $date = self::getFullYear($date);
                    }
                    if ($calc === 'add') {
                        $date += $year;
                        $calc  = 'set';
                    } else if ($calc === 'sub') {
                        $date = $year - $date;
                        $calc = 'set';
                    }

                    return $this->_assign($calc, $this->mktime(0, 0, 0, $month, $day, $date, true),
                                                 $this->mktime(0, 0, 0, $month, $day, $year, true), false);
                }

                require_once 'Zend/Date/Exception.php';
                throw new Zend_Date_Exception("invalid date ($date) operand, year expected", 0, null, $date);
                break;

            case self::YEAR_SHORT_8601:
                if (is_numeric($date)) {
                    $date = intval($date);
                    if (($calc === 'set') || ($calc === 'cmp')) {
                        $date = self::getFullYear($date);
                    }
                    if ($calc === 'add') {
                        $date += $year;
                        $calc  = 'set';
                    } else if ($calc === 'sub') {
                        $date = $year - $date;
                        $calc = 'set';
                    }

                    return $this->_assign($calc, $this->mktime(0, 0, 0, $month, $day, $date, true),
                                                 $this->mktime(0, 0, 0, $month, $day, $year, true), false);
                }

                require_once 'Zend/Date/Exception.php';
                throw new Zend_Date_Exception("invalid date ($date) operand, year expected", 0, null, $date);
                break;

            // time formats
            case self::MERIDIEM:
                require_once 'Zend/Date/Exception.php';
                throw new Zend_Date_Exception('meridiem not supported', 0, null, $date);
                break;

            case self::SWATCH:
                if (is_numeric($date)) {
                    $rest    = intval($date);
                    $hours   = floor($rest * 24 / 1000);
                    $rest    = $rest - ($hours * 1000 / 24);
                    $minutes = floor($rest * 1440 / 1000);
                    $rest    = $rest - ($minutes * 1000 / 1440);
                    $seconds = floor($rest * 86400 / 1000);
                    return $this->_assign($calc, $this->mktime($hours, $minutes, $seconds, 1, 1, 1970, true),
                                                 $this->mktime($hour,  $minute,  $second,  1, 1, 1970, true), false);
                }

                require_once 'Zend/Date/Exception.php';
                throw new Zend_Date_Exception("invalid date ($date) operand, swatchstamp expected", 0, null, $date);
                break;

            case self::HOUR_SHORT_AM:
                if (is_numeric($date)) {
                    return $this->_assign($calc, $this->mktime(intval($date), 0, 0, 1, 1, 1970, true),
                                                 $this->mktime($hour,         0, 0, 1, 1, 1970, true), false);
                }

                require_once 'Zend/Date/Exception.php';
                throw new Zend_Date_Exception("invalid date ($date) operand, hour expected", 0, null, $date);
                break;

            case self::HOUR_SHORT:
                if (is_numeric($date)) {
                    return $this->_assign($calc, $this->mktime(intval($date), 0, 0, 1, 1, 1970, true),
                                                 $this->mktime($hour,         0, 0, 1, 1, 1970, true), false);
                }

                require_once 'Zend/Date/Exception.php';
                throw new Zend_Date_Exception("invalid date ($date) operand, hour expected", 0, null, $date);
                break;

            case self::HOUR_AM:
                if (is_numeric($date)) {
                    return $this->_assign($calc, $this->mktime(intval($date), 0, 0, 1, 1, 1970, true),
                                                 $this->mktime($hour,         0, 0, 1, 1, 1970, true), false);
                }

                require_once 'Zend/Date/Exception.php';
                throw new Zend_Date_Exception("invalid date ($date) operand, hour expected", 0, null, $date);
                break;

            case self::HOUR:
                if (is_numeric($date)) {
                    return $this->_assign($calc, $this->mktime(intval($date), 0, 0, 1, 1, 1970, true),
                                                 $this->mktime($hour,         0, 0, 1, 1, 1970, true), false);
                }

                require_once 'Zend/Date/Exception.php';
                throw new Zend_Date_Exception("invalid date ($date) operand, hour expected", 0, null, $date);
                break;

            case self::MINUTE:
                if (is_numeric($date)) {
                    return $this->_assign($calc, $this->mktime(0, intval($date), 0, 1, 1, 1970, true),
                                                 $this->mktime(0, $minute,       0, 1, 1, 1970, true), false);
                }

                require_once 'Zend/Date/Exception.php';
                throw new Zend_Date_Exception("invalid date ($date) operand, minute expected", 0, null, $date);
                break;

            case self::SECOND:
                if (is_numeric($date)) {
                    return $this->_assign($calc, $this->mktime(0, 0, intval($date), 1, 1, 1970, true),
                                                 $this->mktime(0, 0, $second,       1, 1, 1970, true), false);
                }

                require_once 'Zend/Date/Exception.php';
                throw new Zend_Date_Exception("invalid date ($date) operand, second expected", 0, null, $date);
                break;

            case self::MILLISECOND:
                if (is_numeric($date)) {
                    switch($calc) {
                        case 'set' :
                            return $this->setMillisecond($date);
                            break;
                        case 'add' :
                            return $this->addMillisecond($date);
                            break;
                        case 'sub' :
                            return $this->subMillisecond($date);
                            break;
                    }

                    return $this->compareMillisecond($date);
                }

                require_once 'Zend/Date/Exception.php';
                throw new Zend_Date_Exception("invalid date ($date) operand, milliseconds expected", 0, null, $date);
                break;

            case self::MINUTE_SHORT:
                if (is_numeric($date)) {
                    return $this->_assign($calc, $this->mktime(0, intval($date), 0, 1, 1, 1970, true),
                                                 $this->mktime(0, $minute,       0, 1, 1, 1970, true), false);
                }

                require_once 'Zend/Date/Exception.php';
                throw new Zend_Date_Exception("invalid date ($date) operand, minute expected", 0, null, $date);
                break;

            case self::SECOND_SHORT:
                if (is_numeric($date)) {
                    return $this->_assign($calc, $this->mktime(0, 0, intval($date), 1, 1, 1970, true),
                                                 $this->mktime(0, 0, $second,       1, 1, 1970, true), false);
                }

                require_once 'Zend/Date/Exception.php';
                throw new Zend_Date_Exception("invalid date ($date) operand, second expected", 0, null, $date);
                break;

            // timezone formats
            // break intentionally omitted
            case self::TIMEZONE_NAME:
            case self::TIMEZONE:
            case self::TIMEZONE_SECS:
                require_once 'Zend/Date/Exception.php';
                throw new Zend_Date_Exception('timezone not supported', 0, null, $date);
                break;

            case self::DAYLIGHT:
                require_once 'Zend/Date/Exception.php';
                throw new Zend_Date_Exception('daylight not supported', 0, null, $date);
                break;

            case self::GMT_DIFF:
            case self::GMT_DIFF_SEP:
                require_once 'Zend/Date/Exception.php';
                throw new Zend_Date_Exception('gmtdiff not supported', 0, null, $date);
                break;

            // date strings
            case self::ISO_8601:
                // (-)YYYY-MM-dd
                preg_match('/^(-{0,1}\d{4})-(\d{2})-(\d{2})/', $date, $datematch);
                // (-)YY-MM-dd
                if (empty($datematch)) {
                    preg_match('/^(-{0,1}\d{2})-(\d{2})-(\d{2})/', $date, $datematch);
                }
                // (-)YYYYMMdd
                if (empty($datematch)) {
                    preg_match('/^(-{0,1}\d{4})(\d{2})(\d{2})/', $date, $datematch);
                }
                // (-)YYMMdd
                if (empty($datematch)) {
                    preg_match('/^(-{0,1}\d{2})(\d{2})(\d{2})/', $date, $datematch);
                }
                $tmpdate = $date;
                if (!empty($datematch)) {
                    $dateMatchCharCount = iconv_strlen($datematch[0], 'UTF-8');
                    $tmpdate = iconv_substr($date,
                                            $dateMatchCharCount,
                                            iconv_strlen($date, 'UTF-8') - $dateMatchCharCount,
                                            'UTF-8');
                }
                // (T)hh:mm:ss
                preg_match('/[T,\s]{0,1}(\d{2}):(\d{2}):(\d{2})/', $tmpdate, $timematch);
                if (empty($timematch)) {
                    preg_match('/[T,\s]{0,1}(\d{2})(\d{2})(\d{2})/', $tmpdate, $timematch);
                }
                if (empty($datematch) and empty($timematch)) {
                    require_once 'Zend/Date/Exception.php';
                    throw new Zend_Date_Exception("unsupported ISO8601 format ($date)", 0, null, $date);
                }
                if (!empty($timematch)) {
                    $timeMatchCharCount = iconv_strlen($timematch[0], 'UTF-8');
                    $tmpdate = iconv_substr($tmpdate,
                                            $timeMatchCharCount,
                                            iconv_strlen($tmpdate, 'UTF-8') - $timeMatchCharCount,
                                            'UTF-8');
                }
                if (empty($datematch)) {
                    $datematch[1] = 1970;
                    $datematch[2] = 1;
                    $datematch[3] = 1;
                } else if (iconv_strlen($datematch[1], 'UTF-8') == 2) {
                    $datematch[1] = self::getFullYear($datematch[1]);
                }
                if (empty($timematch)) {
                    $timematch[1] = 0;
                    $timematch[2] = 0;
                    $timematch[3] = 0;
                }

                if (($calc == 'set') || ($calc == 'cmp')) {
                    --$datematch[2];
                    --$month;
                    --$datematch[3];
                    --$day;
                    $datematch[1] -= 1970;
                    $year         -= 1970;
                }
                return $this->_assign($calc, $this->mktime($timematch[1], $timematch[2], $timematch[3], 1 + $datematch[2], 1 + $datematch[3], 1970 + $datematch[1], false),
                                             $this->mktime($hour,         $minute,       $second,       1 + $month,        1 + $day,          1970 + $year,         false), false);
                break;

            case self::RFC_2822:
                 $result = preg_match('/^\w{3},\s(\d{1,2})\s(\w{3})\s(\d{4})\s'
                                    . '(\d{2}):(\d{2}):{0,1}(\d{0,2})\s([+-]'
                                    . '{1}\d{4}|\w{1,20})$/', $date, $match);

                if (!$result) {
                    require_once 'Zend/Date/Exception.php';
                    throw new Zend_Date_Exception("no RFC 2822 format ($date)", 0, null, $date);
                }

                $months  = $this->_getDigitFromName($match[2]);

                if (($calc == 'set') || ($calc == 'cmp')) {
                    --$months;
                    --$month;
                    --$match[1];
                    --$day;
                    $match[3] -= 1970;
                    $year     -= 1970;
                }
                return $this->_assign($calc, $this->mktime($match[4], $match[5], $match[6], 1 + $months, 1 + $match[1], 1970 + $match[3], false),
                                             $this->mktime($hour,     $minute,   $second,   1 + $month,  1 + $day,      1970 + $year,     false), false);
                break;

            case self::TIMESTAMP:
                if (is_numeric($date)) {
                    return $this->_assign($calc, $date, $this->getUnixTimestamp());
                }

                require_once 'Zend/Date/Exception.php';
                throw new Zend_Date_Exception("invalid date ($date) operand, timestamp expected", 0, null, $date);
                break;

            // additional formats
            // break intentionally omitted
            case self::ERA:
            case self::ERA_NAME:
                require_once 'Zend/Date/Exception.php';
                throw new Zend_Date_Exception('era not supported', 0, null, $date);
                break;

            case self::DATES:
                try {
                    $parsed = Zend_Locale_Format::getDate($date, array('locale' => $locale, 'format_type' => 'iso', 'fix_date' => true));

                    if (($calc == 'set') || ($calc == 'cmp')) {
                        --$parsed['month'];
                        --$month;
                        --$parsed['day'];
                        --$day;
                        $parsed['year'] -= 1970;
                        $year  -= 1970;
                    }

                    return $this->_assign($calc, $this->mktime(0, 0, 0, 1 + $parsed['month'], 1 + $parsed['day'], 1970 + $parsed['year'], true),
                                                 $this->mktime(0, 0, 0, 1 + $month,           1 + $day,           1970 + $year,           true), $hour);
                } catch (Zend_Locale_Exception $e) {
                    require_once 'Zend/Date/Exception.php';
                    throw new Zend_Date_Exception($e->getMessage(), 0, $e, $date);
                }
                break;

            case self::DATE_FULL:
                try {
                    $format = Zend_Locale_Data::getContent($locale, 'date', array('gregorian', 'full'));
                    $parsed = Zend_Locale_Format::getDate($date, array('date_format' => $format, 'format_type' => 'iso', 'locale' => $locale));

                    if (($calc == 'set') || ($calc == 'cmp')) {
                        --$parsed['month'];
                        --$month;
                        --$parsed['day'];
                        --$day;
                        $parsed['year'] -= 1970;
                        $year  -= 1970;
                    }
                    return $this->_assign($calc, $this->mktime(0, 0, 0, 1 + $parsed['month'], 1 + $parsed['day'], 1970 + $parsed['year'], true),
                                                 $this->mktime(0, 0, 0, 1 + $month,           1 + $day,           1970 + $year,           true), $hour);
                } catch (Zend_Locale_Exception $e) {
                    require_once 'Zend/Date/Exception.php';
                    throw new Zend_Date_Exception($e->getMessage(), 0, $e, $date);
                }
                break;

            case self::DATE_LONG:
                try {
                    $format = Zend_Locale_Data::getContent($locale, 'date', array('gregorian', 'long'));
                    $parsed = Zend_Locale_Format::getDate($date, array('date_format' => $format, 'format_type' => 'iso', 'locale' => $locale));

                    if (($calc == 'set') || ($calc == 'cmp')){
                        --$parsed['month'];
                        --$month;
                        --$parsed['day'];
                        --$day;
                        $parsed['year'] -= 1970;
                        $year  -= 1970;
                    }
                    return $this->_assign($calc, $this->mktime(0, 0, 0, 1 + $parsed['month'], 1 + $parsed['day'], 1970 + $parsed['year'], true),
                                                 $this->mktime(0, 0, 0, 1 + $month,           1 + $day,           1970 + $year,           true), $hour);
                } catch (Zend_Locale_Exception $e) {
                    require_once 'Zend/Date/Exception.php';
                    throw new Zend_Date_Exception($e->getMessage(), 0, $e, $date);
                }
                break;

            case self::DATE_MEDIUM:
                try {
                    $format = Zend_Locale_Data::getContent($locale, 'date', array('gregorian', 'medium'));
                    $parsed = Zend_Locale_Format::getDate($date, array('date_format' => $format, 'format_type' => 'iso', 'locale' => $locale));

                    if (($calc == 'set') || ($calc == 'cmp')) {
                        --$parsed['month'];
                        --$month;
                        --$parsed['day'];
                        --$day;
                        $parsed['year'] -= 1970;
                        $year  -= 1970;
                    }
                    return $this->_assign($calc, $this->mktime(0, 0, 0, 1 + $parsed['month'], 1 + $parsed['day'], 1970 + $parsed['year'], true),
                                                 $this->mktime(0, 0, 0, 1 + $month,           1 + $day,           1970 + $year,           true), $hour);
                } catch (Zend_Locale_Exception $e) {
                    require_once 'Zend/Date/Exception.php';
                    throw new Zend_Date_Exception($e->getMessage(), 0, $e, $date);
                }
                break;

            case self::DATE_SHORT:
                try {
                    $format = Zend_Locale_Data::getContent($locale, 'date', array('gregorian', 'short'));
                    $parsed = Zend_Locale_Format::getDate($date, array('date_format' => $format, 'format_type' => 'iso', 'locale' => $locale));

                    $parsed['year'] = self::getFullYear($parsed['year']);

                    if (($calc == 'set') || ($calc == 'cmp')) {
                        --$parsed['month'];
                        --$month;
                        --$parsed['day'];
                        --$day;
                        $parsed['year'] -= 1970;
                        $year  -= 1970;
                    }
                    return $this->_assign($calc, $this->mktime(0, 0, 0, 1 + $parsed['month'], 1 + $parsed['day'], 1970 + $parsed['year'], true),
                                                 $this->mktime(0, 0, 0, 1 + $month,           1 + $day,           1970 + $year,           true), $hour);
                } catch (Zend_Locale_Exception $e) {
                    require_once 'Zend/Date/Exception.php';
                    throw new Zend_Date_Exception($e->getMessage(), 0, $e, $date);
                }
                break;

            case self::TIMES:
                try {
                    if ($calc != 'set') {
                        $month = 1;
                        $day   = 1;
                        $year  = 1970;
                    }
                    $parsed = Zend_Locale_Format::getTime($date, array('locale' => $locale, 'format_type' => 'iso', 'fix_date' => true));
                    return $this->_assign($calc, $this->mktime($parsed['hour'], $parsed['minute'], $parsed['second'], $month, $day, $year, true),
                                                 $this->mktime($hour,           $minute,           $second,           $month, $day, $year, true), false);
                } catch (Zend_Locale_Exception $e) {
                    require_once 'Zend/Date/Exception.php';
                    throw new Zend_Date_Exception($e->getMessage(), 0, $e, $date);
                }
                break;

            case self::TIME_FULL:
                try {
                    $format = Zend_Locale_Data::getContent($locale, 'time', array('gregorian', 'full'));
                    $parsed = Zend_Locale_Format::getTime($date, array('date_format' => $format, 'format_type' => 'iso', 'locale' => $locale));
                    if ($calc != 'set') {
                        $month = 1;
                        $day   = 1;
                        $year  = 1970;
                    }

                    if (!isset($parsed['second'])) {
                        $parsed['second'] = 0;
                    }

                    return $this->_assign($calc, $this->mktime($parsed['hour'], $parsed['minute'], $parsed['second'], $month, $day, $year, true),
                                                 $this->mktime($hour,           $minute,           $second,           $month, $day, $year, true), false);
                } catch (Zend_Locale_Exception $e) {
                    require_once 'Zend/Date/Exception.php';
                    throw new Zend_Date_Exception($e->getMessage(), 0, $e, $date);
                }
                break;

            case self::TIME_LONG:
                try {
                    $format = Zend_Locale_Data::getContent($locale, 'time', array('gregorian', 'long'));
                    $parsed = Zend_Locale_Format::getTime($date, array('date_format' => $format, 'format_type' => 'iso', 'locale' => $locale));
                    if ($calc != 'set') {
                        $month = 1;
                        $day   = 1;
                        $year  = 1970;
                    }
                    return $this->_assign($calc, $this->mktime($parsed['hour'], $parsed['minute'], $parsed['second'], $month, $day, $year, true),
                                                 $this->mktime($hour,           $minute,           $second,           $month, $day, $year, true), false);
                } catch (Zend_Locale_Exception $e) {
                    require_once 'Zend/Date/Exception.php';
                    throw new Zend_Date_Exception($e->getMessage(), 0, $e, $date);
                }
                break;

            case self::TIME_MEDIUM:
                try {
                    $format = Zend_Locale_Data::getContent($locale, 'time', array('gregorian', 'medium'));
                    $parsed = Zend_Locale_Format::getTime($date, array('date_format' => $format, 'format_type' => 'iso', 'locale' => $locale));
                    if ($calc != 'set') {
                        $month = 1;
                        $day   = 1;
                        $year  = 1970;
                    }
                    return $this->_assign($calc, $this->mktime($parsed['hour'], $parsed['minute'], $parsed['second'], $month, $day, $year, true),
                                                 $this->mktime($hour,           $minute,           $second,           $month, $day, $year, true), false);
                } catch (Zend_Locale_Exception $e) {
                    require_once 'Zend/Date/Exception.php';
                    throw new Zend_Date_Exception($e->getMessage(), 0, $e, $date);
                }
                break;

            case self::TIME_SHORT:
                try {
                    $format = Zend_Locale_Data::getContent($locale, 'time', array('gregorian', 'short'));
                    $parsed = Zend_Locale_Format::getTime($date, array('date_format' => $format, 'format_type' => 'iso', 'locale' => $locale));
                    if ($calc != 'set') {
                        $month = 1;
                        $day   = 1;
                        $year  = 1970;
                    }

                    if (!isset($parsed['second'])) {
                        $parsed['second'] = 0;
                    }

                    return $this->_assign($calc, $this->mktime($parsed['hour'], $parsed['minute'], $parsed['second'], $month, $day, $year, true),
                                                 $this->mktime($hour,           $minute,           $second,           $month, $day, $year, true), false);
                } catch (Zend_Locale_Exception $e) {
                    require_once 'Zend/Date/Exception.php';
                    throw new Zend_Date_Exception($e->getMessage(), 0, $e, $date);
                }
                break;

            case self::DATETIME:
                try {
                    $parsed = Zend_Locale_Format::getDateTime($date, array('locale' => $locale, 'format_type' => 'iso', 'fix_date' => true));
                    if (($calc == 'set') || ($calc == 'cmp')) {
                        --$parsed['month'];
                        --$month;
                        --$parsed['day'];
                        --$day;
                        $parsed['year'] -= 1970;
                        $year  -= 1970;
                    }
                    return $this->_assign($calc, $this->mktime($parsed['hour'], $parsed['minute'], $parsed['second'], 1 + $parsed['month'], 1 + $parsed['day'], 1970 + $parsed['year'], true),
                                                 $this->mktime($hour,           $minute,           $second,           1 + $month,           1 + $day,           1970 + $year,           true), $hour);
                } catch (Zend_Locale_Exception $e) {
                    require_once 'Zend/Date/Exception.php';
                    throw new Zend_Date_Exception($e->getMessage(), 0, $e, $date);
                }
                break;

            case self::DATETIME_FULL:
                try {
                    $format = Zend_Locale_Data::getContent($locale, 'datetime', array('gregorian', 'full'));
                    $parsed = Zend_Locale_Format::getDateTime($date, array('date_format' => $format, 'format_type' => 'iso', 'locale' => $locale));

                    if (($calc == 'set') || ($calc == 'cmp')) {
                        --$parsed['month'];
                        --$month;
                        --$parsed['day'];
                        --$day;
                        $parsed['year'] -= 1970;
                        $year  -= 1970;
                    }

                    if (!isset($parsed['second'])) {
                        $parsed['second'] = 0;
                    }

                    return $this->_assign($calc, $this->mktime($parsed['hour'], $parsed['minute'], $parsed['second'], 1 + $parsed['month'], 1 + $parsed['day'], 1970 + $parsed['year'], true),
                                                 $this->mktime($hour,           $minute,           $second,           1 + $month,           1 + $day,           1970 + $year,           true), $hour);
                } catch (Zend_Locale_Exception $e) {
                    require_once 'Zend/Date/Exception.php';
                    throw new Zend_Date_Exception($e->getMessage(), 0, $e, $date);
                }
                break;

            case self::DATETIME_LONG:
                try {
                    $format = Zend_Locale_Data::getContent($locale, 'datetime', array('gregorian', 'long'));
                    $parsed = Zend_Locale_Format::getDateTime($date, array('date_format' => $format, 'format_type' => 'iso', 'locale' => $locale));

                    if (($calc == 'set') || ($calc == 'cmp')){
                        --$parsed['month'];
                        --$month;
                        --$parsed['day'];
                        --$day;
                        $parsed['year'] -= 1970;
                        $year  -= 1970;
                    }
                    return $this->_assign($calc, $this->mktime($parsed['hour'], $parsed['minute'], $parsed['second'], 1 + $parsed['month'], 1 + $parsed['day'], 1970 + $parsed['year'], true),
                                                 $this->mktime($hour,           $minute,           $second,           1 + $month,           1 + $day,           1970 + $year,           true), $hour);
                } catch (Zend_Locale_Exception $e) {
                    require_once 'Zend/Date/Exception.php';
                    throw new Zend_Date_Exception($e->getMessage(), 0, $e, $date);
                }
                break;

            case self::DATETIME_MEDIUM:
                try {
                    $format = Zend_Locale_Data::getContent($locale, 'datetime', array('gregorian', 'medium'));
                    $parsed = Zend_Locale_Format::getDateTime($date, array('date_format' => $format, 'format_type' => 'iso', 'locale' => $locale));
                    if (($calc == 'set') || ($calc == 'cmp')) {
                        --$parsed['month'];
                        --$month;
                        --$parsed['day'];
                        --$day;
                        $parsed['year'] -= 1970;
                        $year  -= 1970;
                    }
                    return $this->_assign($calc, $this->mktime($parsed['hour'], $parsed['minute'], $parsed['second'], 1 + $parsed['month'], 1 + $parsed['day'], 1970 + $parsed['year'], true),
                                                 $this->mktime($hour,           $minute,           $second,           1 + $month,           1 + $day,           1970 + $year,           true), $hour);
                } catch (Zend_Locale_Exception $e) {
                    require_once 'Zend/Date/Exception.php';
                    throw new Zend_Date_Exception($e->getMessage(), 0, $e, $date);
                }
                break;

            case self::DATETIME_SHORT:
                try {
                    $format = Zend_Locale_Data::getContent($locale, 'datetime', array('gregorian', 'short'));
                    $parsed = Zend_Locale_Format::getDateTime($date, array('date_format' => $format, 'format_type' => 'iso', 'locale' => $locale));

                    $parsed['year'] = self::getFullYear($parsed['year']);

                    if (($calc == 'set') || ($calc == 'cmp')) {
                        --$parsed['month'];
                        --$month;
                        --$parsed['day'];
                        --$day;
                        $parsed['year'] -= 1970;
                        $year  -= 1970;
                    }

                    if (!isset($parsed['second'])) {
                        $parsed['second'] = 0;
                    }

                    return $this->_assign($calc, $this->mktime($parsed['hour'], $parsed['minute'], $parsed['second'], 1 + $parsed['month'], 1 + $parsed['day'], 1970 + $parsed['year'], true),
                                                 $this->mktime($hour,           $minute,           $second,           1 + $month,           1 + $day,           1970 + $year,           true), $hour);
                } catch (Zend_Locale_Exception $e) {
                    require_once 'Zend/Date/Exception.php';
                    throw new Zend_Date_Exception($e->getMessage(), 0, $e, $date);
                }
                break;

            // ATOM and RFC_3339 are identical
            case self::ATOM:
            case self::RFC_3339:
                $result = preg_match('/^(\d{4})-(\d{2})-(\d{2})T(\d{2}):(\d{2}):(\d{2})\d{0,4}([+-]{1}\d{2}:\d{2}|Z)$/', $date, $match);
                if (!$result) {
                    require_once 'Zend/Date/Exception.php';
                    throw new Zend_Date_Exception("invalid date ($date) operand, ATOM format expected", 0, null, $date);
                }

                if (($calc == 'set') || ($calc == 'cmp')) {
                    --$match[2];
                    --$month;
                    --$match[3];
                    --$day;
                    $match[1] -= 1970;
                    $year     -= 1970;
                }
                return $this->_assign($calc, $this->mktime($match[4], $match[5], $match[6], 1 + $match[2], 1 + $match[3], 1970 + $match[1], true),
                                             $this->mktime($hour,     $minute,   $second,   1 + $month,    1 + $day,      1970 + $year,     true), false);
                break;

            case self::COOKIE:
                $result = preg_match("/^\w{6,9},\s(\d{2})-(\w{3})-(\d{2})\s(\d{2}):(\d{2}):(\d{2})\s.{3,20}$/", $date, $match);
                if (!$result) {
                    require_once 'Zend/Date/Exception.php';
                    throw new Zend_Date_Exception("invalid date ($date) operand, COOKIE format expected", 0, null, $date);
                }
                $matchStartPos = iconv_strpos($match[0], ' ', 0, 'UTF-8') + 1;
                $match[0] = iconv_substr($match[0],
                                         $matchStartPos,
                                         iconv_strlen($match[0], 'UTF-8') - $matchStartPos,
                                         'UTF-8');

                $months    = $this->_getDigitFromName($match[2]);
                $match[3] = self::getFullYear($match[3]);

                if (($calc == 'set') || ($calc == 'cmp')) {
                    --$months;
                    --$month;
                    --$match[1];
                    --$day;
                    $match[3] -= 1970;
                    $year     -= 1970;
                }
                return $this->_assign($calc, $this->mktime($match[4], $match[5], $match[6], 1 + $months, 1 + $match[1], 1970 + $match[3], true),
                                             $this->mktime($hour,     $minute,   $second,   1 + $month,  1 + $day,      1970 + $year,     true), false);
                break;

            case self::RFC_822:
            case self::RFC_1036:
                // new RFC 822 format, identical to RFC 1036 standard
                $result = preg_match('/^\w{0,3},{0,1}\s{0,1}(\d{1,2})\s(\w{3})\s(\d{2})\s(\d{2}):(\d{2}):{0,1}(\d{0,2})\s([+-]{1}\d{4}|\w{1,20})$/', $date, $match);
                if (!$result) {
                    require_once 'Zend/Date/Exception.php';
                    throw new Zend_Date_Exception("invalid date ($date) operand, RFC 822 date format expected", 0, null, $date);
                }

                $months    = $this->_getDigitFromName($match[2]);
                $match[3] = self::getFullYear($match[3]);

                if (($calc == 'set') || ($calc == 'cmp')) {
                    --$months;
                    --$month;
                    --$match[1];
                    --$day;
                    $match[3] -= 1970;
                    $year     -= 1970;
                }
                return $this->_assign($calc, $this->mktime($match[4], $match[5], $match[6], 1 + $months, 1 + $match[1], 1970 + $match[3], false),
                                             $this->mktime($hour,     $minute,   $second,   1 + $month,  1 + $day,      1970 + $year,     false), false);
                break;

            case self::RFC_850:
                $result = preg_match('/^\w{6,9},\s(\d{2})-(\w{3})-(\d{2})\s(\d{2}):(\d{2}):(\d{2})\s.{3,21}$/', $date, $match);
                if (!$result) {
                    require_once 'Zend/Date/Exception.php';
                    throw new Zend_Date_Exception("invalid date ($date) operand, RFC 850 date format expected", 0, null, $date);
                }

                $months    = $this->_getDigitFromName($match[2]);
                $match[3] = self::getFullYear($match[3]);

                if (($calc == 'set') || ($calc == 'cmp')) {
                    --$months;
                    --$month;
                    --$match[1];
                    --$day;
                    $match[3] -= 1970;
                    $year     -= 1970;
                }
                return $this->_assign($calc, $this->mktime($match[4], $match[5], $match[6], 1 + $months, 1 + $match[1], 1970 + $match[3], true),
                                             $this->mktime($hour,     $minute,   $second,   1 + $month,  1 + $day,      1970 + $year,     true), false);
                break;

            case self::RFC_1123:
                $result = preg_match('/^\w{0,3},{0,1}\s{0,1}(\d{1,2})\s(\w{3})\s(\d{2,4})\s(\d{2}):(\d{2}):{0,1}(\d{0,2})\s([+-]{1}\d{4}|\w{1,20})$/', $date, $match);
                if (!$result) {
                    require_once 'Zend/Date/Exception.php';
                    throw new Zend_Date_Exception("invalid date ($date) operand, RFC 1123 date format expected", 0, null, $date);
                }

                $months  = $this->_getDigitFromName($match[2]);

                if (($calc == 'set') || ($calc == 'cmp')) {
                    --$months;
                    --$month;
                    --$match[1];
                    --$day;
                    $match[3] -= 1970;
                    $year     -= 1970;
                }
                return $this->_assign($calc, $this->mktime($match[4], $match[5], $match[6], 1 + $months, 1 + $match[1], 1970 + $match[3], true),
                                             $this->mktime($hour,     $minute,   $second,   1 + $month,  1 + $day,      1970 + $year,     true), false);
                break;

            case self::RSS:
                $result = preg_match('/^\w{3},\s(\d{2})\s(\w{3})\s(\d{2,4})\s(\d{1,2}):(\d{2}):(\d{2})\s.{1,21}$/', $date, $match);
                if (!$result) {
                    require_once 'Zend/Date/Exception.php';
                    throw new Zend_Date_Exception("invalid date ($date) operand, RSS date format expected", 0, null, $date);
                }

                $months  = $this->_getDigitFromName($match[2]);
                $match[3] = self::getFullYear($match[3]);

                if (($calc == 'set') || ($calc == 'cmp')) {
                    --$months;
                    --$month;
                    --$match[1];
                    --$day;
                    $match[3] -= 1970;
                    $year  -= 1970;
                }
                return $this->_assign($calc, $this->mktime($match[4], $match[5], $match[6], 1 + $months, 1 + $match[1], 1970 + $match[3], true),
                                             $this->mktime($hour,     $minute,   $second,   1 + $month,  1 + $day,      1970 + $year,     true), false);
                break;

            case self::W3C:
                $result = preg_match('/^(\d{4})-(\d{2})-(\d{2})T(\d{2}):(\d{2}):(\d{2})[+-]{1}\d{2}:\d{2}$/', $date, $match);
                if (!$result) {
                    require_once 'Zend/Date/Exception.php';
                    throw new Zend_Date_Exception("invalid date ($date) operand, W3C date format expected", 0, null, $date);
                }

                if (($calc == 'set') || ($calc == 'cmp')) {
                    --$match[2];
                    --$month;
                    --$match[3];
                    --$day;
                    $match[1] -= 1970;
                    $year     -= 1970;
                }
                return $this->_assign($calc, $this->mktime($match[4], $match[5], $match[6], 1 + $match[2], 1 + $match[3], 1970 + $match[1], true),
                                             $this->mktime($hour,     $minute,   $second,   1 + $month,    1 + $day,      1970 + $year,     true), false);
                break;

            default:
                if (!is_numeric($date) || !empty($part)) {
                    try {
                        if (empty($part)) {
                            $part  = Zend_Locale_Format::getDateFormat($locale) . " ";
                            $part .= Zend_Locale_Format::getTimeFormat($locale);
                        }

                        $parsed = Zend_Locale_Format::getDate($date, array('date_format' => $part, 'locale' => $locale, 'fix_date' => true, 'format_type' => 'iso'));
                        if ((strpos(strtoupper($part), 'YY') !== false) and (strpos(strtoupper($part), 'YYYY') === false)) {
                            $parsed['year'] = self::getFullYear($parsed['year']);
                        }

                        if (($calc == 'set') || ($calc == 'cmp')) {
                            if (isset($parsed['month'])) {
                                --$parsed['month'];
                            } else {
                                $parsed['month'] = 0;
                            }

                            if (isset($parsed['day'])) {
                                --$parsed['day'];
                            } else {
                                $parsed['day'] = 0;
                            }

                            if (isset($parsed['year'])) {
                                $parsed['year'] -= 1970;
                            } else {
                                $parsed['year'] = 0;
                            }
                        }

                        return $this->_assign($calc, $this->mktime(
                            isset($parsed['hour']) ? $parsed['hour'] : 0,
                            isset($parsed['minute']) ? $parsed['minute'] : 0,
                            isset($parsed['second']) ? $parsed['second'] : 0,
                            isset($parsed['month']) ? (1 + $parsed['month']) : 1,
                            isset($parsed['day']) ? (1 + $parsed['day']) : 1,
                            isset($parsed['year']) ? (1970 + $parsed['year']) : 1970,
                            false), $this->getUnixTimestamp(), false);
                    } catch (Zend_Locale_Exception $e) {
                        if (!is_numeric($date)) {
                            require_once 'Zend/Date/Exception.php';
                            throw new Zend_Date_Exception($e->getMessage(), 0, $e, $date);
                        }
                    }
                }

                return $this->_assign($calc, $date, $this->getUnixTimestamp(), false);
                break;
        }
    }

    /**
     * Returns true when both date objects or date parts are equal.
     * For example:
     * 15.May.2000 <-> 15.June.2000 Equals only for Day or Year... all other will return false
     *
     * @param  string|integer|array|Zend_Date  $date    Date or datepart to equal with
     * @param  string                          $part    OPTIONAL Part of the date to compare, if null the timestamp is used
     * @param  string|Zend_Locale              $locale  OPTIONAL Locale for parsing input
     * @return boolean
     * @throws Zend_Date_Exception
     */
    public function equals($date, $part = self::TIMESTAMP, $locale = null)
    {
        $result = $this->compare($date, $part, $locale);

        if ($result == 0) {
            return true;
        }

        return false;
    }

    /**
     * Returns if the given date or datepart is earlier
     * For example:
     * 15.May.2000 <-> 13.June.1999 will return true for day, year and date, but not for month
     *
     * @param  string|integer|array|Zend_Date  $date    Date or datepart to compare with
     * @param  string                          $part    OPTIONAL Part of the date to compare, if null the timestamp is used
     * @param  string|Zend_Locale              $locale  OPTIONAL Locale for parsing input
     * @return boolean
     * @throws Zend_Date_Exception
     */
    public function isEarlier($date, $part = null, $locale = null)
    {
        $result = $this->compare($date, $part, $locale);

        if ($result == -1) {
            return true;
        }

        return false;
    }

    /**
     * Returns if the given date or datepart is later
     * For example:
     * 15.May.2000 <-> 13.June.1999 will return true for month but false for day, year and date
     * Returns if the given date is later
     *
     * @param  string|integer|array|Zend_Date  $date    Date or datepart to compare with
     * @param  string                          $part    OPTIONAL Part of the date to compare, if null the timestamp is used
     * @param  string|Zend_Locale              $locale  OPTIONAL Locale for parsing input
     * @return boolean
     * @throws Zend_Date_Exception
     */
    public function isLater($date, $part = null, $locale = null)
    {
        $result = $this->compare($date, $part, $locale);

        if ($result == 1) {
            return true;
        }

        return false;
    }

    /**
     * Returns only the time of the date as new Zend_Date object
     * For example:
     * 15.May.2000 10:11:23 will return a dateobject equal to 01.Jan.1970 10:11:23
     *
     * @param  string|Zend_Locale  $locale  OPTIONAL Locale for parsing input
     * @return Zend_Date
     */
    public function getTime($locale = null)
    {
        if (self::$_options['format_type'] == 'php') {
            $format = 'H:i:s';
        } else {
            $format = self::TIME_MEDIUM;
        }

        return $this->copyPart($format, $locale);
    }

    /**
     * Returns the calculated time
     *
     * @param  string                    $calc    Calculation to make
     * @param  string|integer|array|Zend_Date  $time    Time to calculate with, if null the actual time is taken
     * @param  string                          $format  Timeformat for parsing input
     * @param  string|Zend_Locale              $locale  Locale for parsing input
     * @return integer|Zend_Date  new time
     * @throws Zend_Date_Exception
     */
    private function _time($calc, $time, $format, $locale)
    {
        if ($time === null) {
            require_once 'Zend/Date/Exception.php';
            throw new Zend_Date_Exception('parameter $time must be set, null is not allowed');
        }

        if ($time instanceof Zend_Date) {
            // extract time from object
            $time = $time->toString('HH:mm:ss', 'iso');
        } else {
            if (is_array($time)) {
                if ((isset($time['hour']) === true) or (isset($time['minute']) === true) or
                    (isset($time['second']) === true)) {
                    $parsed = $time;
                } else {
                    require_once 'Zend/Date/Exception.php';
                    throw new Zend_Date_Exception("no hour, minute or second given in array");
                }
