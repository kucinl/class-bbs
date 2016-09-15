-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-09-15 17:33:20
-- 服务器版本： 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bbs`
--

-- --------------------------------------------------------

--
-- 表的结构 `bbs_comments`
--

CREATE TABLE `bbs_comments` (
  `id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL DEFAULT '0',
  `uid` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `content` text,
  `replytime` char(10) DEFAULT NULL,
  `is_t` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `bbs_comments`
--

INSERT INTO `bbs_comments` (`id`, `topic_id`, `uid`, `content`, `replytime`, `is_t`) VALUES
(4, 7, 3, '4444444', '1449842603', 0),
(2, 5, 1, '55555555555', '1449751745', 0),
(3, 4, 1, '22222222222222222', '1449819271', 0),
(7, 20, 111, '111111', '1450100713', 0),
(6, 4, 1, '哈哈哈哈', '1450093762', 0),
(8, 20, 1, '222', '1450101429', 0),
(9, 20, 1, '55555555', '1450101809', 0),
(10, 20, 1, '111111', '1450102009', 0),
(11, 20, 1, '222222', '1450102362', 0),
(12, 8, 1, '222', '1450102428', 0),
(13, 8, 1, '5555555', '1450102873', 0),
(14, 20, 1, '22222222', '1450105233', 0),
(15, 25, 2147483647, '哈哈哈', '1450178535', 0),
(16, 25, 2147483647, '呵呵', '1450178562', 0),
(17, 25, 2147483647, '哈哈', '1450178699', 0),
(18, 25, 2147483647, '22222222', '1450179424', 0),
(19, 25, 2147483647, '1111111111', '1450179728', 0),
(20, 25, 3130102333, NULL, '1450179841', 0),
(21, 25, 3130102333, NULL, '1450180009', 0),
(22, 25, 3130102333, '啊啊啊啊啊啊啊啊啊', '1450180066', 0),
(23, 25, 3130102333, '呵呵呵', '1450180084', 0),
(24, 25, 3130102333, '1111111', '1450180155', 0),
(25, 25, 3130102308, '再试试看', '1450181532', 0),
(26, 25, 3130102308, 'WW', '1450181550', 0),
(27, 25, 3130102333, 'XIXI', '1450181579', 0),
(28, 25, 3130102308, '呵呵', '1450183669', 0),
(29, 25, 3130102308, '哈哈过哈哈', '1450183767', 0),
(30, 29, 3130102333, '哈哈哈哈', '1450350130', 0),
(31, 29, 3130102308, '111111111', '1451627944', 0),
(32, 30, 3130102333, '你好啊', '1451653840', 0),
(33, 30, 3130102333, 'O(∩_∩)O~', '1451653919', 0),
(34, 30, 3130102333, '1', '1451654111', 1),
(35, 31, 3130102333, '评论一下', '1451655315', 1),
(40, 31, 3130102308, '你好', '1451815058', 0),
(41, 31, 3130102308, '11', '1452172391', 0),
(42, 31, 3130102308, '你好吗', '1452172402', 0);

-- --------------------------------------------------------

--
-- 表的结构 `bbs_nodes`
--

CREATE TABLE `bbs_nodes` (
  `node_id` smallint(5) NOT NULL,
  `pid` smallint(5) NOT NULL DEFAULT '0',
  `type` tinyint(4) NOT NULL DEFAULT '0',
  `in_code` varchar(32) DEFAULT NULL,
  `cname` varchar(30) DEFAULT NULL COMMENT '分类名称',
  `content` varchar(255) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `master` varchar(100) NOT NULL,
  `listnum` mediumint(8) UNSIGNED DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `bbs_nodes`
--

INSERT INTO `bbs_nodes` (`node_id`, `pid`, `type`, `in_code`, `cname`, `content`, `keywords`, `master`, `listnum`) VALUES
(1, 0, 0, NULL, '项目管理与案例分析', '这门课程是软件工程学生的必修课，也是不可忽视的一门课。', '', '金波', 3),
(2, 0, 0, NULL, '软件需求分析与设计', '', '', '邢卫，刘玉生，林海', 3),
(4, 0, 0, NULL, '测试版主', '', '', 'lin', 1),
(5, 0, 1, '1', '1', '1', NULL, 'kucin', 1),
(6, 0, 1, '1', '1', '1', NULL, 'kucin', 0),
(7, 0, 1, '1', '1', '1', NULL, 'kucin', 0),
(8, 0, 1, '1', '1', '1', NULL, 'kucin', 0),
(9, 0, 1, '111111111', '测试', '测试', NULL, 'kucin', 0),
(10, 0, 1, '1', '1', '1', NULL, 'kucin', 0),
(11, 0, 1, '1', '1', '1', NULL, 'kucin', 0),
(12, 0, 1, '5', NULL, NULL, NULL, 'kucin', 0),
(13, 0, 1, '123456', 'lin的小组', '不需要简介', NULL, 'lin', 3),
(14, 0, 1, '123456', '继续', '1', NULL, 'lin', 0),
(15, 0, 1, '670b14728ad9902aecba32e22fa4f6bd', 'kucin的小组', '何必多少', NULL, 'kucin', 3),
(16, 0, 1, '670b14728ad9902aecba32e22fa4f6bd', '1111111', 'llllll', NULL, '正上', 0),
(17, 0, 0, 'e10adc3949ba59abbe56e057f20f883e', 'test', '', NULL, 'kucin', 0);

-- --------------------------------------------------------

--
-- 表的结构 `bbs_settings`
--

CREATE TABLE `bbs_settings` (
  `id` tinyint(5) NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `value` text NOT NULL,
  `type` tinyint(3) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `bbs_settings`
--

INSERT INTO `bbs_settings` (`id`, `title`, `value`, `type`) VALUES
(1, 'site_name', 'StartBBS- 开源微社区-烧饼bbs', 0),
(2, 'welcome_tip', '欢迎使用课程论坛！', 0),
(3, 'short_intro', '新一代简洁社区软件', 0),
(4, 'show_captcha', 'on', 0),
(5, 'site_run', '0', 0),
(6, 'site_stats', '统计代码																																																																																																																														', 0),
(7, 'site_keywords', '轻量 •  易用  •  社区系统', 0),
(8, 'site_description', 'Startbbs', 0),
(9, 'money_title', '银币', 0),
(10, 'per_page_num', '20', 0),
(11, 'is_rewrite', 'off', 0),
(12, 'show_editor', 'on', 0),
(13, 'comment_order', 'desc', 0);

-- --------------------------------------------------------

--
-- 表的结构 `bbs_topics`
--

CREATE TABLE `bbs_topics` (
  `topic_id` int(11) NOT NULL,
  `node_id` smallint(5) NOT NULL DEFAULT '0',
  `uid` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `ruid` int(11) UNSIGNED DEFAULT NULL,
  `title` varchar(128) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `content` text,
  `addtime` int(10) DEFAULT NULL,
  `updatetime` int(10) DEFAULT NULL,
  `lastreply` int(10) DEFAULT NULL,
  `views` int(10) DEFAULT '0',
  `comments` smallint(8) DEFAULT '0',
  `t_coms` int(11) NOT NULL DEFAULT '0',
  `favorites` int(10) UNSIGNED DEFAULT '0',
  `closecomment` tinyint(1) DEFAULT NULL,
  `is_top` tinyint(1) NOT NULL DEFAULT '0',
  `is_hidden` tinyint(1) NOT NULL DEFAULT '0',
  `ord` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `bbs_topics`
--

INSERT INTO `bbs_topics` (`topic_id`, `node_id`, `uid`, `ruid`, `title`, `keywords`, `content`, `addtime`, `updatetime`, `lastreply`, `views`, `comments`, `t_coms`, `favorites`, `closecomment`, `is_top`, `is_hidden`, `ord`) VALUES
(26, 0, 3130102308, NULL, '1111', '111', '111111111', 1450183492, 1450183492, NULL, 1, 0, 0, 0, NULL, 0, 0, 0),
(27, 0, 3130102333, NULL, '1', '1', '1', 1450279514, 1450279514, NULL, 3, 0, 0, 0, NULL, 0, 0, 0),
(29, 15, 3130102308, 3130102308, '哈哈哈哈哈', '', '1111111111111111111111', 1450341962, 1452180487, 1450350130, 3, 2, 0, 0, NULL, 1, 0, 4294967295),
(30, 15, 3130102308, 3130102308, '测试01-01', '', '啊啊啊', 1451653701, 1451653701, NULL, 0, 3, 1, 0, NULL, 0, 0, 0),
(31, 15, 3130102333, 3130102308, '你好', '', '内容', 1451655294, 1451655294, NULL, 0, 4, 1, 0, NULL, 0, 0, 0),
(32, 1, 3130102308, NULL, '大家好，希望大家都能学得开心', '', '1111111111111', 1451660405, 1452179117, 1451660405, 1, 0, 0, 0, NULL, 1, 0, 4294967295),
(33, 1, 3130102308, NULL, '这是今天的第2次发帖了', '', '11111111111111111', 1451660427, 1452181653, 1451660427, 1, 0, 0, 0, NULL, 0, 0, 1452181653);

-- --------------------------------------------------------

--
-- 表的结构 `bbs_users`
--

CREATE TABLE `bbs_users` (
  `uid` int(11) UNSIGNED NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` char(32) DEFAULT NULL,
  `salt` char(6) DEFAULT NULL COMMENT '混淆码',
  `email` varchar(50) DEFAULT NULL,
  `avatar` varchar(100) DEFAULT 'uploads/avatar/default/',
  `topics` int(11) DEFAULT '0',
  `replies` int(11) DEFAULT '0',
  `messages_unread` int(11) DEFAULT '0',
  `regtime` int(10) DEFAULT NULL,
  `lastlogin` int(10) DEFAULT NULL,
  `lastpost` int(10) DEFAULT NULL,
  `qq` varchar(20) DEFAULT NULL,
  `group_type` tinyint(3) NOT NULL DEFAULT '0',
  `gid` tinyint(3) NOT NULL DEFAULT '3',
  `introduction` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `bbs_users`
--

INSERT INTO `bbs_users` (`uid`, `username`, `password`, `salt`, `email`, `avatar`, `topics`, `replies`, `messages_unread`, `regtime`, `lastlogin`, `lastpost`, `qq`, `group_type`, `gid`, `introduction`) VALUES
(3130102308, 'kucin', 'a297d009d55b8adb406697f6bbd78d93', '259ebc', '961635991@qq.com', 'uploads/avatar/7/47/3130102308_', 15, 2, 0, 1449748752, 1473783521, 1451660427, NULL, 0, 1, '大家好，我是kucin唷'),
(3130102333, '正上', 'bf3d5cecc82edf74003b6ade86f39f88', 'fa7a67', 'linzhengshang@outlook.com', 'uploads/avatar/7/47/3130102333_', 7, 2, 0, 1449748752, 1473783648, 1450350130, NULL, 1, 2, '唷，boys'),
(123456, '金波', 'bf3d5cecc82edf74003b6ade86f39f88', 'fa7a67', '', 'uploads/avatar/6/56/123456_', 2, 0, 0, NULL, 1452180539, 1451660522, NULL, 1, 2, '');

-- --------------------------------------------------------

--
-- 表的结构 `bbs_user_groups`
--

CREATE TABLE `bbs_user_groups` (
  `gid` int(11) NOT NULL,
  `group_type` tinyint(3) NOT NULL DEFAULT '0',
  `group_name` varchar(50) DEFAULT NULL,
  `usernum` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `bbs_user_groups`
--

INSERT INTO `bbs_user_groups` (`gid`, `group_type`, `group_name`, `usernum`) VALUES
(1, 0, '管理员', 1),
(2, 1, '教师', 0),
(3, 2, '学生', 0);

-- --------------------------------------------------------

--
-- 表的结构 `bbs_user_nodes`
--

CREATE TABLE `bbs_user_nodes` (
  `uid` int(11) UNSIGNED NOT NULL,
  `node_id` smallint(6) NOT NULL,
  `is_master` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `bbs_user_nodes`
--

INSERT INTO `bbs_user_nodes` (`uid`, `node_id`, `is_master`) VALUES
(123456, 1, 1),
(123456, 15, 0),
(3130102308, 15, 0),
(3130102308, 17, 0),
(3130102333, 1, 0),
(3130102333, 2, 0),
(3130102333, 15, 1),
(3130102333, 16, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bbs_comments`
--
ALTER TABLE `bbs_comments`
  ADD PRIMARY KEY (`id`,`topic_id`,`uid`);

--
-- Indexes for table `bbs_nodes`
--
ALTER TABLE `bbs_nodes`
  ADD PRIMARY KEY (`node_id`,`pid`);

--
-- Indexes for table `bbs_settings`
--
ALTER TABLE `bbs_settings`
  ADD PRIMARY KEY (`id`,`title`,`type`);

--
-- Indexes for table `bbs_topics`
--
ALTER TABLE `bbs_topics`
  ADD PRIMARY KEY (`topic_id`,`node_id`,`uid`),
  ADD KEY `updatetime` (`updatetime`),
  ADD KEY `ord` (`ord`);
ALTER TABLE `bbs_topics` ADD FULLTEXT KEY `title` (`title`);

--
-- Indexes for table `bbs_users`
--
ALTER TABLE `bbs_users`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `user_name` (`username`);

--
-- Indexes for table `bbs_user_groups`
--
ALTER TABLE `bbs_user_groups`
  ADD PRIMARY KEY (`gid`,`group_type`);

--
-- Indexes for table `bbs_user_nodes`
--
ALTER TABLE `bbs_user_nodes`
  ADD PRIMARY KEY (`uid`,`node_id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `bbs_comments`
--
ALTER TABLE `bbs_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- 使用表AUTO_INCREMENT `bbs_nodes`
--
ALTER TABLE `bbs_nodes`
  MODIFY `node_id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- 使用表AUTO_INCREMENT `bbs_settings`
--
ALTER TABLE `bbs_settings`
  MODIFY `id` tinyint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- 使用表AUTO_INCREMENT `bbs_topics`
--
ALTER TABLE `bbs_topics`
  MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- 使用表AUTO_INCREMENT `bbs_user_groups`
--
ALTER TABLE `bbs_user_groups`
  MODIFY `gid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
