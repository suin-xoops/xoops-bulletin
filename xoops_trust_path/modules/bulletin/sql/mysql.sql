#
# Table structure for table `stories`
#

CREATE TABLE `stories` (
  `storyid` int(8) unsigned NOT NULL auto_increment,
  `uid` int(5) unsigned NOT NULL default '0',
  `title` varchar(255) NOT NULL default '',
  `created` int(10) unsigned NOT NULL default '0',
  `published` int(10) unsigned NOT NULL default '0',
  `expired` int(10) unsigned NOT NULL default '0',
  `hostname` varchar(20) NOT NULL default '',
  `html` tinyint(1) NOT NULL default '0',
  `smiley` tinyint(1) NOT NULL default '0',
  `br` tinyint(1) NOT NULL default '0',
  `xcode` tinyint(1) NOT NULL default '0',
  `hometext` text NOT NULL,
  `bodytext` text NOT NULL,
  `counter` int(8) unsigned NOT NULL default '0',
  `topicid` smallint(4) unsigned NOT NULL default '1',
  `ihome` tinyint(1) NOT NULL default '0',
  `notifypub` tinyint(1) NOT NULL default '0',
  `type` tinyint(1) NOT NULL default '0',
  `topicimg` tinyint(1) NOT NULL default '0',
  `comments` smallint(5) unsigned NOT NULL default '0',
  `block` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`storyid`),
  KEY `idxstoriestopic` (`topicid`),
  KEY `ihome` (`ihome`),
  KEY `uid` (`uid`),
  KEY `published_ihome` (`published`,`ihome`),
  KEY `title` (`title`(40)),
  KEY `created` (`created`),
  FULLTEXT KEY `search` (`title`,`hometext`,`bodytext`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table `topics`
#

CREATE TABLE `topics` (
  `topic_id` smallint(4) unsigned NOT NULL auto_increment,
  `topic_pid` smallint(4) unsigned NOT NULL default '0',
  `topic_imgurl` varchar(20) NOT NULL default '',
  `topic_title` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`topic_id`),
  KEY `pid` (`topic_pid`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

#
# Table structure for table `relation`
#

CREATE TABLE `relation` (
  `storyid` int(8) NOT NULL default '0',
  `linkedid` int(8) NOT NULL default '0',
  `dirname` varchar(25) NOT NULL default ''
) TYPE=MyISAM;