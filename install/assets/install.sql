-- phpMyAdmin SQL Dump
-- version 4.1.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 24, 2014 at 07:48 PM
-- Server version: 5.5.37-cll
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `crokoco_basedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `short` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `published` tinyint(4) NOT NULL DEFAULT '1',
  `site_id` int(11) NOT NULL,
  `meta_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `article_category_id` int(11) NOT NULL DEFAULT '0',
  `order` int(11) NOT NULL DEFAULT '0',
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `template` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `custom1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `custom2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `custom3` text CHARACTER SET utf8 NOT NULL,
  `custom4` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2279 ;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `url`, `title`, `short`, `content`, `img`, `published`, `site_id`, `meta_title`, `meta_keywords`, `meta_description`, `article_category_id`, `order`, `password`, `template`, `custom1`, `custom2`, `custom3`, `custom4`, `updated`, `created`) VALUES
(2277, '', 'עדכון לדוגמה 1', '', '<p>זהו תוכן לדוגמה, ניתן לערוך תוכן זה.&nbsp;</p>\n', '', 1, 1, '', '', '', 542, 1, '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2278, '', 'עדכון לדוגמה 2', 'לכל מאמר ניתן להגדיר תקציר שיופיע ברשימת המאמרים', '<p>מאמר לדוגמה, לחצו&nbsp;לעריכה</p>\n', '', 1, 1, '', '', '', 542, 2, '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `article_categories`
--

CREATE TABLE IF NOT EXISTS `article_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(155) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(155) NOT NULL,
  `site_id` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=543 ;

--
-- Dumping data for table `article_categories`
--

INSERT INTO `article_categories` (`id`, `title`, `description`, `img`, `site_id`, `order`) VALUES
(542, 'latest-news', '', '', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `autoresponders`
--

CREATE TABLE IF NOT EXISTS `autoresponders` (
  `autoresponder_id` int(11) NOT NULL AUTO_INCREMENT,
  `autoresponder_name` varchar(20) DEFAULT NULL,
  `autoresponder_subject` varchar(200) DEFAULT NULL,
  `autoresponder_message` text,
  `autoresponder_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`autoresponder_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `autoresponders`
--

INSERT INTO `autoresponders` (`autoresponder_id`, `autoresponder_name`, `autoresponder_subject`, `autoresponder_message`, `autoresponder_modified`) VALUES
(2, 'new_lead', 'פנייה חדשה מהאתר', '<p>%owner_name שלום,</p>\r\n<p>&nbsp;</p>\r\n<p>התקבלה פנייה חדשה מהאתר :</p>\r\n<p>שם :  %name <br /> אימייל :  %email <br />טלפון :  %phone</p>\r\n<p>תוכן הפנייה :  %message</p>\r\n<p>נושא הפנייה : %subject</p>\r\n<p>&nbsp;</p>\r\n<p>הודעה זו נשלחה אליך באמצעות <a href="http://croko.co.il">Croko CMS</a>.</p>', '2014-08-24 16:47:07'),
(3, 'new_lead_short', 'פנייה חדשה מהאתר', '<p>%form_header <br /><br /> התקבלה פנייה חדשה מהאתר :   %message<br /><br /> %form_footer <br /><br /> נשלח אליך באמצעות GetControl - קבל בחזרה את השליטה בעסק.</p>', '2011-11-24 14:01:17'),
(6, 'order_error', 'הזמנה מהאתר - ההזמנה נכשלה', '<p> </p>\r\n<table style="width: 100%;" border="0" cellspacing="0" cellpadding="0" bgcolor="#fdfdfd">\r\n<tbody>\r\n<tr>\r\n<td align="center" valign="top">\r\n<table style="width: 581px;" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td>\r\n<table style="width: 100%;" border="0" cellspacing="0" cellpadding="17">\r\n<tbody>\r\n<tr>\r\n<td>\r\n<table style="width: 100%;" border="0" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td>\r\n<table style="width: 100%;" border="0" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td valign="top">\r\n<table style="width: 100%;" border="0" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td bgcolor="#e2e5e7">\r\n<table style="width: 100%;" border="0" cellspacing="0" cellpadding="15">\r\n<tbody>\r\n<tr>\r\n<td style="font-family: Arial; font-size: 13px; line-height: 17px; text-align: right; color: #747474; direction: rtl;">\r\n<p style="color: #747474; font-size: 13px;"><span style="font-size: small; color: #000000;">%owner שלום,</span></p>\r\n<p style="color: #747474; font-size: 13px;"><span style="font-size: small; color: #000000;">התקבלה הזמנת מוצר(ים) חדשה מהאתר אך היא נכשלה מול חברת האשראי. לפניך פרטים שיעזרו לך לפתור את הבעיה. בכדי לקבל את פרטי ההזמנה המלאים יש להתחבר לממשק הניהול ומשם להגיע ללשונית "הזמנות". </span></p>\r\n<table style="color: #747474; font-size: 13px; width: 100%;">\r\n<tbody>\r\n<tr>\r\n<td width="15%">שם מלא</td>\r\n<td>%name</td>\r\n</tr>\r\n<tr>\r\n<td>אימייל</td>\r\n<td>%email</td>\r\n</tr>\r\n<tr>\r\n<td>טלפון</td>\r\n<td>%phone</td>\r\n</tr>\r\n<tr>\r\n<td>כתובת</td>\r\n<td>%address</td>\r\n</tr>\r\n<tr>\r\n<td> </td>\r\n<td> </td>\r\n</tr>\r\n<tr>\r\n<td>סטטוס עסקה</td>\r\n<td>%status</td>\r\n</tr>\r\n<tr>\r\n<td>סיבת הדחייה</td>\r\n<td>%error</td>\r\n</tr>\r\n<tr>\r\n<td>מספר עסקה בפלאפיי</td>\r\n<td>%pelepayindex</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p style="color: #747474;"> </p>\r\n<hr />\r\n<p> </p>\r\n<p style="color: #747474;"><strong style="color: #747474; font-size: 13px;"><span style="color: #000000;">נשלח אוטומטית ממערכת קליטת לידים</span></strong></p>\r\n<p> </p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td><img src="images/hr-big.gif" alt="" width="581" height="11" />\r\n<table style="width: 100%;" border="0" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td style="font-family: Arial; font-size: 10px; line-height: 12px; text-align: center; color: #999;"><br />הודעה זו נשלחה אלייך באופן אוטומטי בעזרת מערכת GetControl<br /><br /></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>', '2012-10-28 15:07:57'),
(7, 'order_ok', 'הזמנה חדשה מהאתר', '<p> </p>\r\n<table style="width: 100%;" border="0" cellspacing="0" cellpadding="0" bgcolor="#fdfdfd">\r\n<tbody>\r\n<tr>\r\n<td align="center" valign="top">\r\n<table style="width: 581px;" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td>\r\n<table style="width: 100%;" border="0" cellspacing="0" cellpadding="17">\r\n<tbody>\r\n<tr>\r\n<td>\r\n<table style="width: 100%;" border="0" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td>\r\n<table style="width: 100%;" border="0" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td valign="top">\r\n<table style="width: 100%;" border="0" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td bgcolor="#e2e5e7">\r\n<table style="width: 100%;" border="0" cellspacing="0" cellpadding="15">\r\n<tbody>\r\n<tr>\r\n<td style="font-family: Arial; font-size: 13px; line-height: 17px; text-align: right; color: #747474; direction: rtl;">\r\n<p style="color: #747474; font-size: 13px;"><span style="font-size: small; color: #000000;">%owner שלום,</span></p>\r\n<p style="color: #747474; font-size: 13px;"><span style="font-size: small; color: #000000;">התקבלה הזמנת מוצר(ים) חדשה מהאתר והתשלום התקבל בהצלחה בכרטיס אשראי. לפניך פרטי העסקה והלקוח, בכדי לקבל את פרטי ההזמנה המלאים יש להתחבר לממשק הניהול ומשם להגיע ללשונית "הזמנות". </span></p>\r\n<table style="color: #747474; font-size: 13px; width: 100%;">\r\n<tbody>\r\n<tr>\r\n<td width="15%">שם מלא</td>\r\n<td>%name</td>\r\n</tr>\r\n<tr>\r\n<td>אימייל</td>\r\n<td>%email</td>\r\n</tr>\r\n<tr>\r\n<td>טלפון</td>\r\n<td>%phone</td>\r\n</tr>\r\n<tr>\r\n<td>כתובת</td>\r\n<td>%address</td>\r\n</tr>\r\n<tr>\r\n<td> </td>\r\n<td> </td>\r\n</tr>\r\n<tr>\r\n<td>מספר אישור עסקה</td>\r\n<td>%confiramtioncode</td>\r\n</tr>\r\n<tr>\r\n<td>מספר עסקה בפלאפיי</td>\r\n<td>%pelepayindex</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p style="color: #747474;"> </p>\r\n<hr />\r\n<p> </p>\r\n<p style="color: #747474;"><strong style="color: #747474; font-size: 13px;"><span style="color: #000000;">נשלח אוטומטית ממערכת קליטת לידים</span></strong></p>\r\n<p> </p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td><img src="images/hr-big.gif" alt="" width="581" height="11" />\r\n<table style="width: 100%;" border="0" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td style="font-family: Arial; font-size: 10px; line-height: 12px; text-align: center; color: #999;"><br />הודעה זו נשלחה אלייך באופן אוטומטי בעזרת מערכת GetControl<br /><br /></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>', '2012-10-28 15:06:50');

-- --------------------------------------------------------

--
-- Table structure for table `autoresponder_log`
--

CREATE TABLE IF NOT EXISTS `autoresponder_log` (
  `autoresponder_log_id` int(16) NOT NULL AUTO_INCREMENT,
  `autoresponder_id` int(11) NOT NULL,
  `autoresponder_log_to_name` varchar(255) DEFAULT NULL,
  `autoresponder_log_to_email` varchar(255) DEFAULT NULL,
  `autoresponder_log_from_email` varchar(250) NOT NULL,
  `autoresponder_log_from_name` varchar(100) NOT NULL,
  `autoresponder_log_subject` varchar(500) NOT NULL,
  `autoresponder_log_message` text NOT NULL,
  `autoresponder_log_substitution_array` varchar(1000) NOT NULL,
  `autoresponder_log_attachments_array` varchar(1000) NOT NULL,
  `autoresponder_log_bcc_notify` int(11) DEFAULT NULL,
  `autoresponder_log_email_sent` int(1) DEFAULT NULL,
  `autoresponder_log_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`autoresponder_log_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE IF NOT EXISTS `content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `published` tinyint(4) NOT NULL,
  `site_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`id`, `name`, `content`, `url`, `published`, `site_id`) VALUES
(1, 'sidebar-about-title', '<h3 class="nlsu">אודותינו</h3>\n', '', 0, 1),
(2, 'sidebar-updates-title', '<h3 class="lsup">עדכונים אחרונים</h3>\n', '', 0, 1),
(3, 'sidebar-about-content', '<p>כאן ניתן להזין תוכן שיוצג לגולשים, לחצו על המלל לביצוע העריכה.</p>\n', '', 0, 1),
(4, 'home-intro', '<h3>ברוכים הבאים</h3>\n\n<p>זהו תוכן שיוצג לגולשים בדף הבית, התוכן ניתן לעריכה על ידי לחיצה על בלוק זה. לאחר ביצוע העריכה יש ללחיץ על &quot;שמירה&quot; בתפריט העליון.</p>\n', '', 0, 1),
(5, 'home-bottom', '<h5 class="firsttitle">אודותינו</h5>\n\n<p>כאן ניתן להזין תוכן שיוצג לגולשים, לחצו על המלל לביצוע העריכה.</p>\n', '', 0, 1),
(6, 'home-latest-news', '<h5 class="secondtitle">עדכונים אחרונים</h5>\n', '', 0, 1),
(7, 'sidebar-content', '<h3>אודותינו</h3>\n\n<p>כאן ניתן להזין תוכן שיוצג לגולשים, כגון מידע כללי על החברה או העסק ופרטים ליצירת קשר.</p>\n', '', 0, 1),
(8, 'sidebar-subtitle', '<h5 class="secondtitle">עדכונים אחרונים</h5>\n', '', 0, 1),
(9, 'main-content', '<p><img class="left" src="http://lorempixel.com/400/300/business" /></p>\n\n<h2>ברוכים הבאים</h2>\n\n<p>כאן ניתן להזין תוכן שיוצג לגולשים, לחצו על המלל לביצוע העריכה. כאן ניתן להזין תוכן שיוצג לגולשים, לחצו על המלל לביצוע העריכה. כאן ניתן להזין תוכן שיוצג לגולשים, לחצו על המלל לביצוע העריכה. כאן ניתן להזין תוכן שיוצג לגולשים, לחצו על המלל לביצוע העריכה. כאן ניתן להזין תוכן שיוצג לגולשים, לחצו על המלל לביצוע העריכה. כאן ניתן להזין תוכן שיוצג לגולשים, לחצו על המלל לביצוע העריכה. כאן ניתן להזין תוכן שיוצג לגולשים, לחצו על המלל לביצוע העריכה.</p>\n\n<p>&nbsp;</p>\n\n<h3>כותרת משנה&nbsp;</h3>\n\n<p>תוכן נוסף&nbsp;<span style="line-height: 20px;">תוכן נוסף&nbsp;</span><span style="line-height: 20px;">תוכן נוסף&nbsp;</span><span style="line-height: 20px;">תוכן נוסף&nbsp;</span><span style="line-height: 20px;">תוכן נוסף&nbsp;</span><span style="line-height: 20px;">תוכן נוסף&nbsp;</span><span style="line-height: 20px;">תוכן נוסף&nbsp;</span><span style="line-height: 20px;">תוכן נוסף&nbsp;</span><span style="line-height: 20px;">תוכן נוסף&nbsp;</span><span style="line-height: 20px;">תוכן נוסף&nbsp;</span><span style="line-height: 20px;">תוכן נוסף&nbsp;</span><span style="line-height: 20px;">תוכן נוסף&nbsp;</span><span style="line-height: 20px;">תוכן נוסף&nbsp;</span><span style="line-height: 20px;">תוכן נוסף&nbsp;</span><span style="line-height: 20px;">תוכן נוסף&nbsp;</span><span style="line-height: 20px;">תוכן נוסף&nbsp;</span><span style="line-height: 20px;">תוכן נוסף&nbsp;</span><span style="line-height: 20px;">תוכן נוסף&nbsp;</span><span style="line-height: 20px;">תוכן נוסף&nbsp;</span><span style="line-height: 20px;">תוכן נוסף&nbsp;</span><span style="line-height: 20px;">תוכן נוסף&nbsp;</span><span style="line-height: 20px;">תוכן נוסף&nbsp;</span><span style="line-height: 20px;">תוכן נוסף&nbsp;</span><span style="line-height: 20px;">תוכן נוסף&nbsp;</span><span style="line-height: 20px;">תוכן נוסף&nbsp;</span><span style="line-height: 20px;">תוכן נוסף&nbsp;</span><span style="line-height: 20px;">תוכן נוסף&nbsp;</span></p>\n', '', 0, 1),
(10, 'articles-title', '<h2>כותרת של דף המאמרים, ניתנת לשינוי</h2>\n', '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE IF NOT EXISTS `galleries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gallery_thumb` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `site_id` int(11) NOT NULL,
  `thumb_width` int(11) NOT NULL DEFAULT '80',
  `full_width` int(11) NOT NULL DEFAULT '900',
  `show_in_menu` tinyint(4) NOT NULL DEFAULT '1',
  `order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `title`, `description`, `gallery_thumb`, `site_id`, `thumb_width`, `full_width`, `show_in_menu`, `order`) VALUES
(1, 'תמונות לאתר', '', '', 1, 80, 900, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `gallery_images`
--

CREATE TABLE IF NOT EXISTS `gallery_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `gallery_id` int(11) NOT NULL,
  `order` tinyint(4) NOT NULL,
  `site_id` int(11) NOT NULL,
  `custom1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `custom2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `gallery_images`
--

INSERT INTO `gallery_images` (`id`, `filename`, `title`, `description`, `gallery_id`, `order`, `site_id`, `custom1`, `custom2`) VALUES
(1, '81012dee22913020dcdb3f377a7c05d5.jpg', 'test', '', 1, 0, 1, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `site_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `menu_title` varchar(85) COLLATE utf8_unicode_ci NOT NULL,
  `short` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `published` tinyint(11) NOT NULL DEFAULT '1',
  `order` int(4) NOT NULL DEFAULT '0',
  `parent` int(11) NOT NULL DEFAULT '0',
  `show_in_menu` tinyint(4) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `site_id` int(11) NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `template` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` tinyint(4) NOT NULL DEFAULT '0',
  `custom1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `custom2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `custom3` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `custom4` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `url`, `title`, `menu_title`, `short`, `content`, `meta_title`, `meta_keywords`, `meta_description`, `img`, `published`, `order`, `parent`, `show_in_menu`, `created`, `updated`, `site_id`, `password`, `template`, `mobile`, `custom1`, `custom2`, `custom3`, `custom4`) VALUES
(1, 'about', 'אודות', '', '', '<p>זהו דף אודות, כאן ניתן להזין תוכן שיוצג לגולשים, לחצו על המלל לביצוע העריכה.&nbsp;</p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>\n', '', '', '', '', 1, 2, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '', '', 0, '', '', '', ''),
(2, 'services', 'שירותים', '', '', '<p>זהו דף שירותים, כאן ניתן להזין תוכן שיוצג לגולשים, לחצו על המלל לביצוע העריכה.</p>\n', '', '', '', '', 1, 3, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '', '', 0, '', '', '', ''),
(3, 'articles', 'עדכונים', '', '', '', '', '', '', '', 1, 4, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '', '', 0, '', '', '', ''),
(4, 'contact', 'יצירת קשר', '', '', '<p>ליצירת קשר ניתן לשלוח אימייל לכתובת email@your-address.com או בטלפון שמפסרו 0000000.&nbsp;</p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>\n\n<p><b class="Bold">השאירו הודעה</b></p>\n\n<p>[contact form=&quot;1&quot;]</p>\n', '', '', '', '', 1, 5, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '', '', 0, '', '', '', ''),
(5, '/', 'בית', '', '', '', '', '', '', '', 1, 1, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '', '', 0, '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `sites`
--

CREATE TABLE IF NOT EXISTS `sites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `owner_name` varchar(85) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `contact_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `online` tinyint(4) NOT NULL DEFAULT '1',
  `site_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `google_analytics_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `head_scripts` text COLLATE utf8_unicode_ci NOT NULL,
  `thanks_scripts` text COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(155) COLLATE utf8_unicode_ci NOT NULL,
  `language` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'he',
  `template` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `template_style` text COLLATE utf8_unicode_ci NOT NULL,
  `design_settings` text COLLATE utf8_unicode_ci NOT NULL,
  `mobile_settings` text COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  `reseller_id` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=237 ;

--
-- Dumping data for table `sites`
--

INSERT INTO `sites` (`id`, `name`, `owner_name`, `description`, `contact_email`, `meta_title`, `meta_keywords`, `meta_description`, `online`, `site_url`, `google_analytics_code`, `head_scripts`, `thanks_scripts`, `logo`, `language`, `template`, `template_style`, `design_settings`, `mobile_settings`, `created`, `updated`, `status`, `reseller_id`, `username`, `password`) VALUES
(1, 'האתר החדש שלי!', 'מנהל אתר', '0', 'your@email.com', '', '', '', 1, '', '', '', '', '', 'he', 'totza', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active', '', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(85) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `nickname` varchar(85) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=294 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nickname`, `email`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', '');
