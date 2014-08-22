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
 * @category   Zend
 * @package    Zend_Gdata
 * @subpackage YouTube
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: UserProfileEntry.php 23775 2011-03-01 17:25:24Z ralph $
 */

/**
 * @see Zend_Gdata_Entry
 */
require_once 'Zend/Gdata/Entry.php';

/**
 * @see Zend_Gdata_Extension_FeedLink
 */
require_once 'Zend/Gdata/Extension/FeedLink.php';

/**
 * @see Zend_Gdata_YouTube_Extension_Description
 */
require_once 'Zend/Gdata/YouTube/Extension/Description.php';

/**
 * @see Zend_Gdata_YouTube_Extension_AboutMe
 */
require_once 'Zend/Gdata/YouTube/Extension/AboutMe.php';

/**
 * @see Zend_Gdata_YouTube_Extension_Age
 */
require_once 'Zend/Gdata/YouTube/Extension/Age.php';

/**
 * @see Zend_Gdata_YouTube_Extension_Username
 */
require_once 'Zend/Gdata/YouTube/Extension/Username.php';

/**
 * @see Zend_Gdata_YouTube_Extension_Books
 */
require_once 'Zend/Gdata/YouTube/Extension/Books.php';

/**
 * @see Zend_Gdata_YouTube_Extension_Company
 */
require_once 'Zend/Gdata/YouTube/Extension/Company.php';

/**
 * @see Zend_Gdata_YouTube_Extension_Hobbies
 */
require_once 'Zend/Gdata/YouTube/Extension/Hobbies.php';

/**
 * @see Zend_Gdata_YouTube_Extension_Hometown
 */
require_once 'Zend/Gdata/YouTube/Extension/Hometown.php';

/**
 * @see Zend_Gdata_YouTube_Extension_Location
 */
require_once 'Zend/Gdata/YouTube/Extension/Location.php';

/**
 * @see Zend_Gdata_YouTube_Extension_Movies
 */
require_once 'Zend/Gdata/YouTube/Extension/Movies.php';

/**
 * @see Zend_Gdata_YouTube_Extension_Music
 */
require_once 'Zend/Gdata/YouTube/Extension/Music.php';

/**
 * @see Zend_Gdata_YouTube_Extension_Occupation
 */
require_once 'Zend/Gdata/YouTube/Extension/Occupation.php';

/**
 * @see Zend_Gdata_YouTube_Extension_School
 */
require_once 'Zend/Gdata/YouTube/Extension/School.php';

/**
 * @see Zend_Gdata_YouTube_Extension_Gender
 */
require_once 'Zend/Gdata/YouTube/Extension/Gender.php';

/**
 * @see Zend_Gdata_YouTube_Extension_Relationship
 */
require_once 'Zend/Gdata/YouTube/Extension/Relationship.php';

/**
 * @see Zend_Gdata_YouTube_Extension_FirstName
 */
require_once 'Zend/Gdata/YouTube/Extension/FirstName.php';

/**
 * @see Zend_Gdata_YouTube_Extension_LastName
 */
require_once 'Zend/Gdata/YouTube/Extension/LastName.php';

/**
 * @see Zend_Gdata_YouTube_Extension_Statistics
 */
require_once 'Zend/Gdata/YouTube/Extension/Statistics.php';

/**
 * @see Zend_Gdata_Media_Extension_MediaThumbnail
 */
require_once 'Zend/Gdata/Media/Extension/MediaThumbnail.php';

/**
 * Represents the YouTube video playlist flavor of an Atom entry
 *
 * @category   Zend
 * @package    Zend_Gdata
 * @subpackage YouTube
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Gdata_YouTube_UserProfileEntry extends Zend_Gdata_Entry
{

    protected $_entryClassName = 'Zend_Gdata_YouTube_UserProfileEntry';

    /**
     * Nested feed links
     *
     * @var array
     */
    protected $_feedLink = array();

    /**
     * The username for this profile entry
     *
     * @var string
     */
    protected $_username = null;

    /**
     * The description of the user
     *
     * @var string
     */
    protected $_description = null;

    /**
     * The contents of the 'About Me' field.
     *
     * @var string
     */
    protected $_aboutMe = null;

    /**
     * The age of the user
     *
     * @var int
     */
    protected $_age = null;

    /**
     * Books of interest to the user
     *
     * @var string
     */
    protected $_books = null;

    /**
     * Company
     *
     * @var string
     */
    protected $_company = null;

    /**
     * Hobbies
     *
     * @var string
     */
    protected $_hobbies = null;

    /**
     * Hometown
     *
     * @var string
     */
    protected $_hometown = null;

    /**
     * Location
     *
     * @var string
     */
    protected $_location = null;

    /**
     * Movies
     *
     * @var string
     */
    protected $_movies = null;

    /**
     * Music
     *
     * @var string
     */
    protected $_music = null;

    /**
     * Occupation
     *
     * @var string
     */
    protected $_occupation = null;

    /**
     * School
     *
     * @var string
     */
    protected $_school = null;

    /**
     * Gender
     *
     * @var string
     */
    protected $_gender = null;

    /**
     * Relationship
     *
     * @var string
     */
    protected $_relationship = null;

    /**
     * First name
     *
     * @var string
     */
    protected $_firstName = null;

    /**
     * Last name
     *
     * @var string
     */
    protected $_lastName = null;

    /**
     * Statistics
     *
     * @var Zend_Gdata_YouTube_Extension_Statistics
     */
    protected $_statistics = null;

    /**
     * Thumbnail
     *
     * @var Zend_Gdata_Media_Extension_MediaThumbnail
     */
    protected $_thumbnail = null;

    /**
     * Creates a User Profile entry, representing an individual user
     * and their attributes.
     *
     * @param DOMElement $element (optional) DOMElement from which this
     *          object should be constructed.
     */
    public function __construct($element = nu