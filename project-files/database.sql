-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Sep 09, 2012 at 11:18 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `boncuisson`
--

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `id` int(1) NOT NULL AUTO_INCREMENT COMMENT 'The primary key of this table, used to select the one row that it will always have',
  `address` varchar(255) NOT NULL COMMENT 'The address of the company, displayed in the header',
  `companyName` varchar(255) NOT NULL COMMENT 'The name of the company which owns this site',
  `email` varchar(255) NOT NULL COMMENT 'The primary email of the company, displayed in the header',
  `phone` varchar(255) NOT NULL COMMENT 'The primary phone number of the company, displayed in the header',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `entrees`
--

CREATE TABLE IF NOT EXISTS `entrees` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'The primary key of this table, and the ID of the entree item',
  `visible` int(11) NOT NULL COMMENT 'Set whether or not a entree item should display',
  `showIcon` int(11) NOT NULL COMMENT 'Whether or not a Fleur de Lis shouule be shown beside the entree item as a bullet',
  `serving` int(10) NOT NULL COMMENT 'The timestamp in which this entree item will be served',
  `type` tinytext NOT NULL COMMENT 'Whether this entree is a lunch or dinner',
  `price` longtext NOT NULL COMMENT 'A JSON encoded array containing all of the pricing and suggested serving information for this entree item',
  `name` varchar(255) NOT NULL COMMENT 'The name of the entree item',
  `description` longtext NOT NULL COMMENT 'The description of the entree item',
  `imageURL` longtext NOT NULL COMMENT 'The URL of the image for this entree item',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

--
-- Table structure for table `home`
--

CREATE TABLE IF NOT EXISTS `home` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'The primary key of the table',
  `line1` longtext NOT NULL COMMENT 'The first line of text to display on the home page',
  `line2` longtext NOT NULL COMMENT 'The second line of text to display on the home page',
  `line3` longtext NOT NULL COMMENT 'The third line of text to display on the home page',
  `image1` longtext NOT NULL COMMENT 'The first image to display on the home page',
  `image2` longtext NOT NULL COMMENT 'The second image to display on the home page',
  `image3` longtext NOT NULL COMMENT 'The third image to display on the home page',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'The primary key of this table, and the ID of the menu item',
  `visible` int(1) NOT NULL COMMENT 'Set whether or not a menu item should display',
  `position` int(11) NOT NULL COMMENT 'The position of the menu item within the current food category',
  `type` varchar(255) NOT NULL COMMENT 'The menu which a particular food item will appear under',
  `price` int(5) NOT NULL COMMENT 'The price of the item. Values may range from 0.00 to 99999.00',
  `perUnit` varchar(255) NOT NULL COMMENT 'Optional. The amount of food a buyer will receive for the listed price, such as per pint, dozen, etc...',
  `showIcon` int(1) NOT NULL COMMENT 'Whether or not a Fleur de Lis shouule be shown beside the menu item as a bullet',
  `name` varchar(255) NOT NULL COMMENT 'The name of the food item',
  `tagline` longtext NOT NULL COMMENT 'A short description of the food item',
  `description` longtext NOT NULL COMMENT 'A description of the food item',
  `variations` longtext NOT NULL COMMENT 'A JSON array storing pricing for additional sizes of this particular food item',
  `imageURL` longtext NOT NULL COMMENT 'Optional. The URL of the image showing the food item',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=63 ;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'The primary key of this table, and the ID of the page category',
  `visible` int(1) NOT NULL COMMENT 'Set whether or not a page should display in the menu',
  `position` int(11) NOT NULL COMMENT 'The numerical position of the page on the menu',
  `URL` varchar(255) NOT NULL COMMENT 'The SEO friendly URL of the page',
  `type` varchar(255) NOT NULL COMMENT 'The type of page: menu, reviews, entrees, or home',
  `title` varchar(255) NOT NULL COMMENT 'The title of the page',
  `category` varchar(255) NOT NULL COMMENT 'Used only for type "menu", which will indicate what kind of menu type should be fetched from the menu table',
  `pageTop` longtext NOT NULL COMMENT 'The text for this value will display above the main content of each module, except for the home and not found modules',
  `pageBottom` longtext NOT NULL COMMENT 'The text for this value will display below the main content of each module, except for the home and not found modules',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'The primary key of this table, and the ID of the review',
  `timestamp` int(10) NOT NULL COMMENT 'The timestamp indicating when the review was published',
  `IPAddress` varchar(255) NOT NULL COMMENT 'The IP address which left a review',
  `name` varchar(255) NOT NULL COMMENT 'The name of the reviewer',
  `rating` int(1) NOT NULL COMMENT 'The numerical rating from the user, valid values range from 0 to 5',
  `review` longtext NOT NULL COMMENT 'The review from the user',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'The primary key of this table, and the ID of the user',
  `firstname` varchar(255) NOT NULL COMMENT 'The first name of the user',
  `lastname` varchar(255) NOT NULL COMMENT 'The last name of the user',
  `email` varchar(255) NOT NULL COMMENT 'The user''s email address',
  `username` varchar(255) NOT NULL COMMENT 'The user name of the user',
  `password` varchar(255) NOT NULL COMMENT 'The user''s password',
  `changepassword` int(1) NOT NULL COMMENT 'Whether or not the system requires the user to change his or her password, because the user has forgotten their password, and the system has assigned them a new one that needs changed',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;