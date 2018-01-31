-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2018 �?02 �?01 �?02:02
-- 服务器版本: 5.5.53
-- PHP 版本: 5.5.38

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `tplay`
--

-- --------------------------------------------------------

--
-- 表的结构 `tplay_admin`
--

CREATE TABLE IF NOT EXISTS `tplay_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(20) DEFAULT NULL COMMENT '昵称',
  `name` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `create_time` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` timestamp NULL DEFAULT NULL COMMENT '修改时间',
  `login_time` timestamp NULL DEFAULT NULL COMMENT '最后登录时间',
  `login_ip` varchar(100) DEFAULT NULL COMMENT '最后登录ip',
  `admin_cate_id` int(2) NOT NULL DEFAULT '1' COMMENT '管理员分组',
  PRIMARY KEY (`id`),
  KEY `id` (`id`) USING BTREE,
  KEY `admin_cate_id` (`admin_cate_id`) USING BTREE,
  KEY `nickname` (`nickname`) USING BTREE
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `tplay_admin`
--

INSERT INTO `tplay_admin` (`id`, `nickname`, `name`, `password`, `create_time`, `update_time`, `login_time`, `login_ip`, `admin_cate_id`) VALUES
(1, 'Tplay', 'admin', '31c64b511d1e90fcda8519941c1bd660', '2018-01-29 07:43:32', '2018-01-31 03:52:24', '0000-00-00 00:00:00', '0.0.0.0', 1);

-- --------------------------------------------------------

--
-- 表的结构 `tplay_admin_cate`
--

CREATE TABLE IF NOT EXISTS `tplay_admin_cate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `permissions` text COMMENT '权限菜单',
  `create_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  `desc` text COMMENT '备注',
  PRIMARY KEY (`id`),
  KEY `id` (`id`) USING BTREE,
  KEY `name` (`name`) USING BTREE,
  KEY `create_time` (`create_time`) USING BTREE
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- 转存表中的数据 `tplay_admin_cate`
--

INSERT INTO `tplay_admin_cate` (`id`, `name`, `permissions`, `create_time`, `update_time`, `desc`) VALUES
(1, '超级管理员', '57,58,60,61,68,82,83,84,30,29,73,74,37,38,40,41,85,86,63,64,33,34,70,71,49,50,51,53,54,77,78,80', '2018-01-28 16:00:00', '2018-01-28 16:00:00', '超级管理员，拥有最高权限！');

-- --------------------------------------------------------

--
-- 表的结构 `tplay_admin_log`
--

CREATE TABLE IF NOT EXISTS `tplay_admin_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_menu_id` int(11) NOT NULL COMMENT '操作菜单id',
  `admin_id` int(11) NOT NULL COMMENT '操作者id',
  `ip` varchar(100) DEFAULT NULL COMMENT '操作ip',
  `operation_id` varchar(200) DEFAULT NULL COMMENT '操作关联id',
  `create_time` timestamp NULL DEFAULT NULL COMMENT '操作时间',
  PRIMARY KEY (`id`),
  KEY `id` (`id`) USING BTREE,
  KEY `admin_id` (`admin_id`) USING BTREE,
  KEY `create_time` (`create_time`) USING BTREE
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=135 ;

--
-- 转存表中的数据 `tplay_admin_log`
--

INSERT INTO `tplay_admin_log` (`id`, `admin_menu_id`, `admin_id`, `ip`, `operation_id`, `create_time`) VALUES
(1, 77, 1, '0.0.0.0', '45', '0000-00-00 00:00:00'),
(2, 77, 1, '0.0.0.0', '46', '0000-00-00 00:00:00'),
(3, 78, 1, '0.0.0.0', '45', '0000-00-00 00:00:00'),
(4, 77, 1, '0.0.0.0', '46', '0000-00-00 00:00:00'),
(5, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(6, 66, 1, '0.0.0.0', '', '0000-00-00 00:00:00'),
(7, 80, 1, '0.0.0.0', '', '0000-00-00 00:00:00'),
(8, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(9, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(10, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(11, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(12, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(13, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(14, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(15, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(16, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(17, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(18, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(19, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(20, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(21, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(22, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(23, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(24, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(25, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(26, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(27, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(28, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(29, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(30, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(31, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(32, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(33, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(34, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(35, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(36, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(37, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(38, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(39, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(40, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(41, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(42, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(43, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(44, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(45, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(46, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(47, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(48, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(49, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(50, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(51, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(52, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(53, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(54, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(55, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(56, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(57, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(58, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(59, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(60, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(61, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(62, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(63, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(64, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(65, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(66, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(67, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(68, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(69, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(70, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(71, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(72, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(73, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(74, 71, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(75, 66, 1, '0.0.0.0', '', '0000-00-00 00:00:00'),
(76, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(77, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(78, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(79, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(80, 66, 1, '0.0.0.0', '', '0000-00-00 00:00:00'),
(81, 66, 1, '0.0.0.0', '', '0000-00-00 00:00:00'),
(82, 33, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(83, 33, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(84, 33, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(85, 33, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(86, 71, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(87, 71, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(88, 71, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(89, 71, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(90, 71, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(91, 71, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(92, 71, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(93, 71, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(94, 71, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(95, 71, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(96, 71, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(97, 71, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(98, 71, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(99, 71, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(100, 71, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(101, 71, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(102, 71, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(103, 71, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(104, 71, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(105, 71, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(106, 71, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(107, 71, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(108, 71, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(109, 71, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(110, 71, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(111, 71, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(112, 71, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(113, 71, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(114, 71, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(115, 71, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(116, 71, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(117, 71, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(118, 71, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(119, 71, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(120, 71, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(121, 71, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(122, 71, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(123, 71, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(124, 71, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(125, 71, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(126, 71, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(127, 71, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(128, 66, 1, '0.0.0.0', '', '0000-00-00 00:00:00'),
(129, 71, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(130, 71, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(131, 71, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(132, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(133, 2, 1, '0.0.0.0', '1', '0000-00-00 00:00:00'),
(134, 66, 1, '0.0.0.0', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- 表的结构 `tplay_admin_menu`
--

CREATE TABLE IF NOT EXISTS `tplay_admin_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `module` varchar(50) DEFAULT NULL COMMENT '模块',
  `controller` varchar(100) DEFAULT NULL COMMENT '控制器',
  `function` varchar(100) DEFAULT NULL COMMENT '方法',
  `parameter` varchar(50) DEFAULT NULL COMMENT '参数',
  `description` varchar(250) DEFAULT NULL COMMENT '描述',
  `is_display` int(1) NOT NULL DEFAULT '1' COMMENT '1显示在左侧菜单2只作为节点',
  `type` int(1) NOT NULL DEFAULT '1' COMMENT '1权限节点2普通节点',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '上级菜单0为顶级菜单',
  `create_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  `icon` varchar(100) DEFAULT NULL COMMENT '图标',
  `is_open` int(1) NOT NULL DEFAULT '0' COMMENT '0默认闭合1默认展开',
  `orders` int(11) NOT NULL DEFAULT '0' COMMENT '排序值，越小越靠前',
  PRIMARY KEY (`id`),
  KEY `id` (`id`) USING BTREE,
  KEY `module` (`module`) USING BTREE,
  KEY `controller` (`controller`) USING BTREE,
  KEY `function` (`function`) USING BTREE,
  KEY `is_display` (`is_display`) USING BTREE,
  KEY `type` (`type`) USING BTREE
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=87 ;

--
-- 转存表中的数据 `tplay_admin_menu`
--

INSERT INTO `tplay_admin_menu` (`id`, `name`, `module`, `controller`, `function`, `parameter`, `description`, `is_display`, `type`, `pid`, `create_time`, `update_time`, `icon`, `is_open`, `orders`) VALUES
(1, '设置', 'admin', 'index', 'index', '', '管理软件的基础信息，包括个人的基本信息管理。', 1, 2, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'fa-cogs', 0, 1),
(2, '个人信息', 'admin', 'admin', 'personal', '', '对个人的一些信息进行管理。', 1, 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'fa-cog', 0, 0),
(4, '会员管理', 'admin', 'index', 'index', '', '后台管理员管理，包括后台权限组的管理。', 1, 2, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'fa-user', 0, 2),
(6, '角色分组', 'admin', 'admin', 'adminCate', '', '管理员角色分组管理。', 1, 2, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'fa-group', 0, 2),
(73, '添加/修改管理员', 'admin', 'admin', 'publish', '', '添加/修改管理员。', 2, 1, 72, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, 0),
(74, '删除管理员', 'admin', 'admin', 'delete', '', '删除管理员。', 2, 1, 72, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, 0),
(77, '添加/修改菜单', 'admin', 'menu', 'publish', '', '添加/修改菜单。', 2, 1, 76, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, 0),
(78, '删除菜单', 'admin', 'menu', 'delete', '', '删除菜单。', 2, 1, 76, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, 0),
(30, '删除权限分组', 'admin', 'admin', 'adminCateDelete', '', '删除后台管理员权限分组。', 2, 1, 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, 0),
(13, '修改密码', 'admin', 'admin', 'editPassword', '', '修改个人登录密码。', 1, 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'fa-edit', 0, 1),
(29, '添加/修改权限分组', 'admin', 'admin', 'adminCatePublish', '', '添加/修改管理员权限分组。', 2, 1, 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, 0),
(79, '文件管理', 'admin', 'attachment', 'index', '', '文件管理。', 1, 2, 47, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'fa-file', 0, 1),
(33, '文件审核', 'admin', 'attachment', 'audit', '', '对文件进行审核。', 2, 1, 79, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, 0),
(34, '文件删除', 'admin', 'attachment', 'delete', '', '对文件进行删除操作。', 2, 1, 79, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, 0),
(35, '门户管理', 'admin', 'index', 'index', '', '门户内容管理', 1, 2, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'fa-th', 0, 6),
(36, '分类管理', 'admin', 'articlecate', 'index', '', '分类列表管理。', 1, 2, 35, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'fa-tags', 0, 0),
(37, '添加/修改分类', 'admin', 'articlecate', 'publish', '', '添加/修改分类操作。', 2, 1, 36, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, 0),
(38, '删除分类', 'admin', 'articlecate', 'delete', '', '删除分类操作。', 2, 1, 36, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, 0),
(39, '文章管理', 'admin', 'article', 'index', '', '文章列表管理', 1, 2, 35, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'fa-file-text', 0, 0),
(40, '添加/修改文章', 'admin', 'article', 'publish', '', '添加/修改文章操作。', 2, 1, 39, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, 0),
(41, '删除文章', 'admin', 'article', 'delete', '', '删除文章操作。', 2, 1, 39, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, 0),
(46, '日志管理', 'admin', 'admin', 'log', '', '管理员操作日志。', 1, 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'fa-book', 0, 6),
(47, '数据管理', 'admin', 'index', 'index', '', '数据相关的管理。', 1, 2, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'fa-cubes', 0, 5),
(48, '数据库', 'admin', 'databackup', 'index', '', '数据库管理', 1, 2, 47, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'fa-database', 0, 2),
(49, '数据库备份', 'admin', 'databackup', 'export', '', '数据库备份。', 2, 1, 48, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, 0),
(50, '数据库优化', 'admin', 'databackup', 'optimize', '', '数据库优化。', 2, 1, 48, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, 0),
(51, '数据库修复', 'admin', 'databackup', 'repair', '', '数据库修复', 2, 1, 48, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, 0),
(52, '备份管理', 'admin', 'databackup', 'importlist', '', '数据库备份文件管理。', 1, 2, 47, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'fa-bookmark', 0, 3),
(53, '数据库备份还原', 'admin', 'databackup', 'import', '', '数据库还原。', 2, 1, 52, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, 0),
(54, '数据库备份删除', 'admin', 'databackup', 'del', '', '数据库备份删除。', 2, 1, 52, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, 0),
(75, '菜单管理', 'admin', 'index', 'index', '', '菜单管理。', 1, 2, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'fa-sitemap', 0, 3),
(56, '邮件配置', 'admin', 'emailconfig', 'index', '', '邮件配置。', 1, 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'fa-envelope', 0, 3),
(57, '修改邮件配置', 'admin', 'emailconfig', 'publish', '', '修改邮件配置。', 2, 1, 56, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, 0),
(58, '发送测试邮件', 'admin', 'emailconfig', 'mailto', '', '发送测试邮件。', 2, 1, 56, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, 0),
(59, '短信配置', 'admin', 'smsconfig', 'index', '', '短信配置。', 1, 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'fa-comment', 0, 4),
(60, '修改短信配置', 'admin', 'smsconfig', 'publish', '', '修改短信配置。', 2, 1, 59, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, 0),
(61, '发送测试短信', 'admin', 'smsconfig', 'smsto', '', '发送测试短信。', 2, 1, 59, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, 0),
(62, '留言管理', 'admin', 'tomessages', 'index', '', '留言管理。', 1, 2, 35, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'fa-comments', 0, 0),
(63, '标记留言', 'admin', 'tomessages', 'mark', '', '标记留言。', 2, 1, 62, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, 0),
(64, '删除留言', 'admin', 'tomessages', 'delete', '', '删除留言。', 2, 1, 62, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, 0),
(65, '添加留言', 'admin', 'tomessages', 'publish', '', '添加留言。', 2, 2, 62, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, 0),
(66, '管理员登录', 'admin', 'common', 'login', '', '管理员登录。', 2, 2, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, 100),
(67, '系统设置', 'admin', 'webconfig', 'index', '', '网站信息设置。', 1, 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'fa-desktop', 0, 2),
(68, '修改网站配置', 'admin', 'webconfig', 'publish', '', '修改网站配置信息。', 2, 1, 67, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, 0),
(69, '上传文件', 'admin', 'common', 'upload', '', '上传文件。', 2, 2, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, 199),
(70, '上传附件', 'admin', 'attachment', 'upload', '', '上传附件。', 2, 1, 79, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, 0),
(71, '文件下载', 'admin', 'attachment', 'download', '', '文件下载。', 2, 1, 79, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, 0),
(72, '管理员', 'admin', 'admin', 'index', '', '管理员列表。', 1, 2, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'fa-user', 0, 1),
(76, '后台菜单', 'admin', 'menu', 'index', '', '添加/修改菜单。', 1, 2, 75, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'fa-sliders', 0, 0),
(80, '菜单排序', 'admin', 'menu', 'orders', '', '后台菜单排序。', 2, 1, 76, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, 0),
(81, 'URL美化', 'admin', 'urlsconfig', 'index', '', 'URL美化设置。', 1, 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'fa-link', 0, 5),
(82, '新增/修改url美化', 'admin', 'urlsconfig', 'publish', '', '新增/修改url美化规则。', 2, 1, 81, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, 0),
(83, '启用/禁用url美化', 'admin', 'urlsconfig', 'status', '', '启用/禁用url美化规则。', 2, 1, 81, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, 0),
(84, '删除url美化规则', 'admin', 'urlsconfig', 'delete', '', '删除url美化规则。', 2, 1, 81, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, 0),
(85, '置顶/取消置顶', 'admin', 'article', 'is_top', '', '置顶或取消置顶文章操作。', 2, 1, 39, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, 0),
(86, '审核/下架文章', 'admin', 'article', 'status', '', '对文章进行审核或者下架操作。', 2, 1, 39, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `tplay_article`
--

CREATE TABLE IF NOT EXISTS `tplay_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `tag` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `article_cate_id` int(11) NOT NULL,
  `thumb` int(11) DEFAULT NULL,
  `content` text,
  `admin_id` int(11) NOT NULL,
  `create_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  `edit_admin_id` int(11) NOT NULL COMMENT '最后修改人',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '0待审核1已审核',
  `is_top` int(1) NOT NULL DEFAULT '0' COMMENT '1置顶0普通',
  PRIMARY KEY (`id`),
  KEY `id` (`id`) USING BTREE,
  KEY `status` (`status`) USING BTREE,
  KEY `is_top` (`is_top`) USING BTREE,
  KEY `article_cate_id` (`article_cate_id`) USING BTREE,
  KEY `admin_id` (`admin_id`) USING BTREE,
  KEY `create_time` (`create_time`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tplay_article_cate`
--

CREATE TABLE IF NOT EXISTS `tplay_article_cate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `tag` varchar(250) DEFAULT NULL COMMENT '关键词',
  `description` varchar(250) DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  `pid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tplay_attachment`
--

CREATE TABLE IF NOT EXISTS `tplay_attachment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `module` char(15) DEFAULT NULL COMMENT '所属模块',
  `filename` char(50) DEFAULT NULL COMMENT '文件名',
  `filepath` char(200) DEFAULT NULL COMMENT '文件路径+文件名',
  `filesize` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文件大小',
  `fileext` char(10) NOT NULL DEFAULT '' COMMENT '文件后缀',
  `user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '会员ID',
  `uploadip` char(15) NOT NULL DEFAULT '' COMMENT '上传IP',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0未审核1已审核-1不通过',
  `create_time` timestamp NULL DEFAULT NULL,
  `admin_id` int(11) NOT NULL COMMENT '审核者id',
  `audit_time` timestamp NULL DEFAULT NULL COMMENT '审核时间',
  `use` varchar(200) DEFAULT NULL COMMENT '用处',
  `download` int(11) NOT NULL DEFAULT '0' COMMENT '下载量',
  PRIMARY KEY (`id`),
  KEY `id` (`id`) USING BTREE,
  KEY `status` (`status`) USING BTREE,
  KEY `filename` (`filename`) USING BTREE,
  KEY `create_time` (`create_time`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='附件表' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `tplay_attachment`
--

INSERT INTO `tplay_attachment` (`id`, `module`, `filename`, `filepath`, `filesize`, `fileext`, `user_id`, `uploadip`, `status`, `create_time`, `admin_id`, `audit_time`, `use`, `download`) VALUES
(1, 'admin', '79811855a6c06de53047471c4ff82a36.jpg', '\\tplay\\public\\uploads\\admin\\admin_thumb\\20180104\\79811855a6c06de53047471c4ff82a36.jpg', 13781, 'jpg', 1, '127.0.0.1', 1, '2018-01-22 16:00:00', 1, '0000-00-00 00:00:00', 'admin_thumb', 46);

-- --------------------------------------------------------

--
-- 表的结构 `tplay_emailconfig`
--

CREATE TABLE IF NOT EXISTS `tplay_emailconfig` (
  `email` varchar(5) NOT NULL COMMENT '邮箱配置标识',
  `from_email` varchar(50) NOT NULL COMMENT '邮件来源也就是邮件地址',
  `from_name` varchar(50) NOT NULL,
  `smtp` varchar(50) NOT NULL COMMENT '邮箱smtp服务器',
  `username` varchar(100) NOT NULL COMMENT '邮箱账号',
  `password` varchar(100) NOT NULL COMMENT '邮箱密码',
  `title` varchar(200) NOT NULL COMMENT '邮件标题',
  `content` text NOT NULL COMMENT '邮件模板',
  KEY `email` (`email`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tplay_emailconfig`
--

INSERT INTO `tplay_emailconfig` (`email`, `from_email`, `from_name`, `smtp`, `username`, `password`, `title`, `content`) VALUES
('email', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `tplay_messages`
--

CREATE TABLE IF NOT EXISTS `tplay_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(50) DEFAULT NULL,
  `is_look` int(1) NOT NULL DEFAULT '0' COMMENT '0未读1已读',
  `message` text,
  `create_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tplay_smsconfig`
--

CREATE TABLE IF NOT EXISTS `tplay_smsconfig` (
  `sms` varchar(10) NOT NULL DEFAULT 'sms' COMMENT '标识',
  `appkey` varchar(200) DEFAULT NULL,
  `secretkey` varchar(200) DEFAULT NULL,
  `type` varchar(100) DEFAULT 'normal' COMMENT '短信类型',
  `name` varchar(100) DEFAULT NULL COMMENT '短信签名',
  `code` varchar(100) DEFAULT NULL COMMENT '短信模板ID',
  `content` text COMMENT '短信默认模板',
  KEY `sms` (`sms`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tplay_smsconfig`
--

INSERT INTO `tplay_smsconfig` (`sms`, `appkey`, `secretkey`, `type`, `name`, `code`, `content`) VALUES
('sms', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `tplay_urlconfig`
--

CREATE TABLE IF NOT EXISTS `tplay_urlconfig` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aliases` varchar(200) DEFAULT NULL COMMENT '想要设置的别名',
  `url` varchar(200) DEFAULT NULL COMMENT '原url结构',
  `desc` text COMMENT '备注',
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '0禁用1使用',
  `create_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`) USING BTREE,
  KEY `status` (`status`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tplay_webconfig`
--

CREATE TABLE IF NOT EXISTS `tplay_webconfig` (
  `web` varchar(20) NOT NULL COMMENT '网站配置标识',
  `name` varchar(200) DEFAULT NULL COMMENT '网站名称',
  `keywords` text COMMENT '关键词',
  `desc` text COMMENT '描述',
  `is_log` int(1) NOT NULL DEFAULT '1' COMMENT '1开启日志0关闭',
  `file_type` varchar(200) DEFAULT NULL COMMENT '允许上传的类型',
  `file_size` bigint(20) DEFAULT NULL COMMENT '允许上传的最大值',
  `statistics` text COMMENT '统计代码',
  `black_ip` text COMMENT 'ip黑名单',
  `url_suffix` varchar(20) DEFAULT NULL COMMENT 'url伪静态后缀',
  KEY `web` (`web`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tplay_webconfig`
--

INSERT INTO `tplay_webconfig` (`web`, `name`, `keywords`, `desc`, `is_log`, `file_type`, `file_size`, `statistics`, `black_ip`, `url_suffix`) VALUES
('web', 'Tplay后台管理框架', 'Tplay,后台管理,thinkphp5,layui', 'Tplay是一款基于ThinkPHP5.0.12 + layui2.2.45 + ECharts + Mysql开发的后台管理框架，集成了一般应用所必须的基础性功能，为开发者节省大量的时间。', 1, 'jpg,png,gif,mp4,zip,jpeg', 500, '', '', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
