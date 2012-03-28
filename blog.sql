-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 20, 2012 at 11:37 PM
-- Server version: 5.1.36
-- PHP Version: 5.3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `exblog`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(64) NOT NULL,
  `slug` varchar(64) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `parent_id`, `name`, `slug`) VALUES
(1, 0, 'Default', 'default');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(32) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `slug` varchar(255) NOT NULL,
  `post` text NOT NULL,
  `date_posted` int(11) NOT NULL DEFAULT '0',
  `cat_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `author`, `title`, `slug`, `post`, `date_posted`, `cat_id`) VALUES
(1, 'Austin', 'Lorem ipsum dolor sit amet', 'lorem-ipsum-dolor-sit-amet', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vitae risus neque. Vestibulum vulputate rhoncus convallis. Phasellus tincidunt libero ut justo pellentesque sit amet gravida felis pharetra. Morbi cursus tellus ipsum. Duis nunc est, rutrum euismod ultricies et, suscipit eget tellus. Nullam eu erat libero. Duis semper viverra est, non aliquam metus suscipit eget.\r\n\r\nPhasellus sit amet nisl sed neque tincidunt accumsan sollicitudin at dui. Nam sit amet sem arcu, sit amet fringilla dolor. Nam vitae adipiscing odio. Vestibulum a sodales odio. Integer magna neque, scelerisque eu lobortis a, sagittis vel nunc. Aenean mollis, est non faucibus dictum, lacus nulla tempor massa, a congue elit ante quis ante. Praesent congue scelerisque suscipit. Maecenas vehicula convallis metus, quis gravida nisl porta nec. Ut aliquam, quam et molestie tincidunt, eros sapien aliquet libero, rutrum tristique est magna at sem. Aenean semper leo vitae lorem egestas non mollis eros imperdiet. Nulla ut ornare magna. In tellus nisi, porttitor ut gravida id, aliquet eget sem. Sed at tincidunt lacus.\r\n\r\nPellentesque tristique, elit non hendrerit imperdiet, mi nunc dapibus odio, at hendrerit justo mi eu dolor. Nulla facilisi. Quisque auctor auctor interdum. Mauris non ligula enim, nec porta orci. Curabitur sed mi eu nisl dignissim pulvinar ut eget arcu. Etiam ante quam, placerat eget lacinia a, bibendum in quam. In vitae dignissim nulla. Donec iaculis odio sit amet leo accumsan consectetur. Vestibulum placerat pulvinar turpis. Nam at augue et urna facilisis gravida at at orci.', 1329780813, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(32) NOT NULL AUTO_INCREMENT,
  `role_id` tinyint(1) NOT NULL,
  `email` varchar(320) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(123) NOT NULL,
  `salt` varchar(10) NOT NULL,
  `ip` varchar(39) NOT NULL,
  `date_registered` int(11) NOT NULL,
  `last_active` int(11) NOT NULL DEFAULT '0',
  `validated` tinyint(1) NOT NULL DEFAULT '0',
  `val_code` varchar(10) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `role_id`, `email`, `username`, `password`, `salt`, `ip`, `date_registered`, `last_active`, `validated`, `val_code`) VALUES
(1, 0, 'admin@example.com', 'admin', 'qMNtAe9IRxiLJu7FW07VwSppQVlZmDISyt2Reb6qt88=', 'rl5w9t3s4g', '127.0.0.1', 1329781006, 0, 1, 'einq1rvk60');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
