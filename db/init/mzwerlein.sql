-- phpMyAdmin SQL Dump
-- version 5.1.4-dev+20220331.b9ddf0b305
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 31, 2024 at 06:57 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mzwerlein`
--

-- --------------------------------------------------------

--
-- Table structure for table `authUsers`
--

CREATE TABLE `authUsers` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `authUsers`
--

INSERT INTO `authUsers` (`id`, `email`, `password`, `role`) VALUES
(1, '?', '?', '?'),
(2, 'asgregers', '$2y$10$7UBLP48AIHjkbXIGFNsAWuQNqvCGRN0LqWVmlJANts8pFfmhQ45q2', 'user'),
(3, 'agfhstrhtrh', '$2y$10$yvYtgxinuqm3QuYoRzV8g.eeqdw.V1mcX6jxh5bjr40RXRgeTlMKW', 'user'),
(4, 'rsgrthtrhrtdhy', '$2y$10$RrzIvcEhgrhm5Q1NlK/7pen0ryrCHuisBjWxkncgnLcICZ..HsL5m', 'user'),
(5, 'regytshthtr', '$2y$10$yB9SRqmo2Nl9mKiNqvJ0yOXdMYRYP2wUKpsSu4lPb4K9Ksy1.XxoG', 'user'),
(6, 'abc@gmail.com', '$2y$10$4BRQZlqT6CApoyEHuNa.qe0NDsEmsOZepxYnLPh8scML8GfeGHCpa', 'admin'),
(7, 'def@gmail.com', '$2y$10$1o8rE5OAmNoXAFHqsk5knO1Ffj5reV9h2AuNwqlGfJWlAfQ/xfiyS', 'admin'),
(8, 'asdf@gmail.com', '$2y$10$nUxlaSepEIY3b.lZXaBNQupfvO30mVE4vcjbrxSJyipJgmoP9c8um', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `Food`
--

CREATE TABLE `Food` (
  `FoodID` int(10) UNSIGNED NOT NULL,
  `Name` varchar(50) NOT NULL,
  `FoodCategoryID` int(11) NOT NULL,
  `FoodQuantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `Food`
--

INSERT INTO `Food` (`FoodID`, `Name`, `FoodCategoryID`, `FoodQuantity`) VALUES
(3, 'Carrot', 2, 19),
(8, 'Beet', 2, 54),
(10, 'Mango', 1, 0),
(11, 'Blueberry', 1, 0),
(13, 'Strawberry', 1, 2),
(14, 'Blackberry', 1, -2),
(15, 'Spinach', 2, 6),
(16, 'Onion', 2, 4),
(18, 'Lettuce', 2, 5),
(20, 'Olive', 1, 0),
(28, 'Orange', 1, 0),
(30, 'Banana', 1, -3),
(31, 'Korn', 2, 14),
(35, 'weag', 1, 29),
(36, 'raegshb', 3, 5),
(37, 'sththtrdh', 2, 53),
(38, 'dhdjytdst', 2, 53),
(39, 'gargragwga', 2, 20),
(40, 'esgththtdr', 2, 49),
(42, 'argesgt', 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `foodAuthUsers`
--

CREATE TABLE `foodAuthUsers` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `foodAuthUsers`
--

INSERT INTO `foodAuthUsers` (`id`, `email`, `password`, `role`) VALUES
(1, 'jnytjtjhdfh', '$2y$10$xSkngX1WNQKrZxDRA1ulg.uX3vXkJdKtDk2RIoVS8zOvS.9nkT4lq', 'user'),
(2, 'def@gmail.com', '$2y$10$vhjvp6bT9wNvhAMqRkUH9uG4.wsYrFTk68IJc9s/NvDxaMTmWf9Um', 'admin'),
(3, 'abc@gmail.com', '$2y$10$vHqpvFbq2nNa.IA4eVt4Ou9HpE75MDh2jtAwpKpSvbipl6ovLg0ie', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `FoodCategory`
--

CREATE TABLE `FoodCategory` (
  `FoodCategoryID` int(10) UNSIGNED NOT NULL,
  `Category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `FoodCategory`
--

INSERT INTO `FoodCategory` (`FoodCategoryID`, `Category`) VALUES
(1, 'Fruit'),
(2, 'Vegetable'),
(3, 'Topping');

-- --------------------------------------------------------

--
-- Table structure for table `FoodMenu`
--

CREATE TABLE `FoodMenu` (
  `MenuItemID` int(11) NOT NULL,
  `MenuItemName` varchar(50) NOT NULL,
  `Ingredients` varchar(50) NOT NULL,
  `Price` int(11) NOT NULL,
  `MenuName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `FoodMenu`
--

INSERT INTO `FoodMenu` (`MenuItemID`, `MenuItemName`, `Ingredients`, `Price`, `MenuName`) VALUES
(1, 'Jungle Juice', 'banana strawberry orangejuice', 5, 'juices'),
(3, '', 'sgththsth', 5, ''),
(4, '', 'ragrehtrh', 0, ''),
(5, '', 'ragrgsehg', 5, ''),
(6, '', 'argreg', 0, ''),
(7, '', 'asgragre', 5, ''),
(8, 'ragregare', 'earagra', 5, ''),
(9, 'raegregargtr', 'easewtaet', 5, ''),
(10, 'htrshtsedrgh', 'segrthshst', 5, 'food'),
(11, 'regsehtrht', 'Array', 5, 'food'),
(12, 'ragrthhsthtrjr', 'Array', 5, 'food'),
(13, 'argreage', 'Banana;Beet;Blackberry', 5, 'food'),
(14, '', 'Spinach, Strawberry', 0, 'food'),
(15, 'food', 'Banana, Carrot', 5, 'food'),
(16, 'a', 'Banana, Blackberry', 5, 'food'),
(17, 'abc', 'Banana, Beet, Blackberry', 5, 'food');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authUsers`
--
ALTER TABLE `authUsers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `Food`
--
ALTER TABLE `Food`
  ADD PRIMARY KEY (`FoodID`);

--
-- Indexes for table `foodAuthUsers`
--
ALTER TABLE `foodAuthUsers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `FoodCategory`
--
ALTER TABLE `FoodCategory`
  ADD PRIMARY KEY (`FoodCategoryID`);

--
-- Indexes for table `FoodMenu`
--
ALTER TABLE `FoodMenu`
  ADD PRIMARY KEY (`MenuItemID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authUsers`
--
ALTER TABLE `authUsers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `Food`
--
ALTER TABLE `Food`
  MODIFY `FoodID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `foodAuthUsers`
--
ALTER TABLE `foodAuthUsers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `FoodCategory`
--
ALTER TABLE `FoodCategory`
  MODIFY `FoodCategoryID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `FoodMenu`
--
ALTER TABLE `FoodMenu`
  MODIFY `MenuItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
