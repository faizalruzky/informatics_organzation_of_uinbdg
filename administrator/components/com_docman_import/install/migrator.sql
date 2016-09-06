CREATE TABLE IF NOT EXISTS `#__docman_tmp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catid` int(11) NOT NULL DEFAULT '1',
  `dmname` text NOT NULL,
  `dmdescription` longtext,
  `dmdate_published` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dmowner` int(4) NOT NULL DEFAULT '-1',
  `dmfilename` text NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `dmurl` text,
  `dmcounter` int(11) DEFAULT '0',
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `dmthumbnail` text,
  `dmlastupdateon` datetime DEFAULT '0000-00-00 00:00:00',
  `dmlastupdateby` int(5) NOT NULL DEFAULT '-1',
  `dmsubmitedby` int(5) NOT NULL DEFAULT '-1',
  `dmmantainedby` int(5) DEFAULT '0',
  `dmlicense_id` int(5) DEFAULT '0',
  `dmlicense_display` tinyint(1) NOT NULL DEFAULT '0',
  `access` int(11) unsigned NOT NULL DEFAULT '0',
  `attribs` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pub_appr_own_cat_name` (`published`,`approved`,`dmowner`,`catid`,`dmname`(64)),
  KEY `appr_pub_own_cat_date` (`approved`,`published`,`dmowner`,`catid`,`dmdate_published`),
  KEY `own_pub_appr_cat_count` (`dmowner`,`published`,`approved`,`catid`,`dmcounter`),
  KEY `own_pub_appr_cat_id` (`dmowner`,`published`,`approved`,`catid`,`id`)
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__docman_categories_tmp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `image` varchar(255) NOT NULL DEFAULT '',
  `section` varchar(50) NOT NULL DEFAULT '',
  `image_position` varchar(30) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `editor` varchar(50) DEFAULT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `count` int(11) NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cat_idx` (`section`,`published`,`access`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`)
) DEFAULT CHARSET=utf8;

TRUNCATE TABLE `#__docman_tmp`;
TRUNCATE TABLE `#__docman_categories_tmp`;