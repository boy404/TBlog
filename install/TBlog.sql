-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2016-07-02 11:17:29
-- 服务器版本: 5.5.44-0ubuntu0.14.04.1
-- PHP 版本: 5.5.9-1ubuntu4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `h2`
--

-- --------------------------------------------------------

--
-- 表的结构 `blog_comment`
--

CREATE TABLE IF NOT EXISTS `blog_comment` (
  `CID` int(11) NOT NULL AUTO_INCREMENT,
  `PID` int(11) NOT NULL DEFAULT '0',
  `upCID` int(11) NOT NULL DEFAULT '0',
  `UID` int(11) NOT NULL DEFAULT '0',
  `time` int(11) NOT NULL,
  `IP` tinytext NOT NULL,
  `name` tinytext NOT NULL,
  `email` tinytext NOT NULL,
  `url` tinytext NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`CID`),
  UNIQUE KEY `CID` (`CID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `blog_comment`
--

INSERT INTO `blog_comment` (`CID`, `PID`, `upCID`, `UID`, `time`, `IP`, `name`, `email`, `url`, `content`) VALUES
(7, 2, 0, 0, 1467170638, '61.131.96.156', 'hello', 'i@tristana.cn', '', '?第一条评论，么么哒。');

-- --------------------------------------------------------

--
-- 表的结构 `blog_meta`
--

CREATE TABLE IF NOT EXISTS `blog_meta` (
  `MID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` tinytext,
  `slug` tinytext,
  `type` tinytext NOT NULL,
  `description` tinytext,
  `count` int(10) unsigned DEFAULT '0',
  `order` int(10) unsigned DEFAULT '0',
  `parent` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`MID`),
  UNIQUE KEY `MID` (`MID`),
  KEY `slug` (`slug`(191))
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `blog_meta`
--

INSERT INTO `blog_meta` (`MID`, `name`, `slug`, `type`, `description`, `count`, `order`, `parent`) VALUES
(1, '默认分类', 'default', 'category', '', 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `blog_nav`
--

CREATE TABLE IF NOT EXISTS `blog_nav` (
  `title` tinytext NOT NULL,
  `slug` tinytext NOT NULL,
  `url` tinytext NOT NULL,
  `order` int(10) unsigned zerofill NOT NULL,
  `other` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `blog_post`
--

CREATE TABLE IF NOT EXISTS `blog_post` (
  `PID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `UID` int(11) unsigned NOT NULL,
  `MID` int(10) unsigned NOT NULL,
  `time` int(11) NOT NULL,
  `slug` tinytext NOT NULL,
  `type` tinytext NOT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  `title` tinytext NOT NULL,
  `content` text NOT NULL,
  `isPost` enum('0','1') NOT NULL,
  PRIMARY KEY (`PID`),
  UNIQUE KEY `pid` (`PID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `blog_post`
--

INSERT INTO `blog_post` (`PID`, `UID`, `MID`, `time`, `slug`, `type`, `order`, `title`, `content`, `isPost`) VALUES
(1, 1, 0, 1467170440, 'about', 'page', 0, '关于', '<p>这是不点儿Blog的第一个页面。。。。<br></p>', '0'),
(2, 1, 1, 1467170524, 'welcome', 'post', 0, '欢迎使用本博客程序', '<p>你看到这个文章的时候，你已经安装成功了。<br></p>', '0');

-- --------------------------------------------------------

--
-- 表的结构 `blog_setting`
--

CREATE TABLE IF NOT EXISTS `blog_setting` (
  `key` varchar(100) NOT NULL,
  `value` text,
  UNIQUE KEY `key` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `blog_setting`
--

INSERT INTO `blog_setting` (`key`, `value`) VALUES
('blogDescription', 'just so so....'),
('blogKeyWorld', 'Tblog'),
('blogLogo', ''),
('blogTitle', 'Tblog');

-- --------------------------------------------------------

--
-- 表的结构 `blog_user`
--

CREATE TABLE IF NOT EXISTS `blog_user` (
  `UID` int(11) NOT NULL AUTO_INCREMENT,
  `name` tinytext NOT NULL,
  `password` tinytext NOT NULL,
  `email` tinytext NOT NULL,
  `url` tinytext NOT NULL,
  PRIMARY KEY (`UID`),
  UNIQUE KEY `aid` (`UID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=2 ;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;