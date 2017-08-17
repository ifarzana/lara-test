-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2017 at 02:03 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lara_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `acl_acl`
--

CREATE TABLE `acl_acl` (
  `id` int(11) NOT NULL,
  `user_group_id` int(11) NOT NULL,
  `resource_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acl_acl`
--

INSERT INTO `acl_acl` (`id`, `user_group_id`, `resource_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(33, 4, 1, '2016-11-29 11:04:04', '2016-11-29 11:04:04'),
(39, 1, 3, NULL, NULL),
(49, 4, 3, '2017-04-12 15:14:01', '2017-04-12 15:14:01');

-- --------------------------------------------------------

--
-- Table structure for table `acl_permission`
--

CREATE TABLE `acl_permission` (
  `id` int(11) NOT NULL,
  `resource_id` int(11) NOT NULL,
  `user_group_id` int(11) NOT NULL,
  `privilege_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acl_permission`
--

INSERT INTO `acl_permission` (`id`, `resource_id`, `user_group_id`, `privilege_id`, `created_at`, `updated_at`) VALUES
(30, 1, 4, 2, '2016-11-29 11:04:04', '2016-11-29 11:04:04'),
(46, 3, 4, 2, '2017-04-12 15:15:15', '2017-04-12 15:15:15'),
(51, 3, 4, 7, NULL, NULL),
(52, 3, 4, 6, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `acl_privilege`
--

CREATE TABLE `acl_privilege` (
  `id` int(11) NOT NULL,
  `privilege` varchar(45) NOT NULL,
  `icon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acl_privilege`
--

INSERT INTO `acl_privilege` (`id`, `privilege`, `icon`) VALUES
(1, 'create', 'fa fa-plus'),
(2, 'read', 'fa fa-eye'),
(3, 'update', 'fa fa-pencil'),
(4, 'delete', 'fa fa-times'),
(5, 'hide', ''),
(6, 'editReview', ''),
(7, 'createReview', '');

-- --------------------------------------------------------

--
-- Table structure for table `acl_privilege_availability`
--

CREATE TABLE `acl_privilege_availability` (
  `id` int(11) NOT NULL,
  `resource_id` int(11) NOT NULL,
  `privilege_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acl_privilege_availability`
--

INSERT INTO `acl_privilege_availability` (`id`, `resource_id`, `privilege_id`) VALUES
(1, 1, 2),
(6, 3, 1),
(7, 3, 2),
(8, 3, 3),
(9, 3, 4),
(13, 3, 5),
(14, 3, 6),
(15, 3, 7);

-- --------------------------------------------------------

--
-- Table structure for table `acl_resource`
--

CREATE TABLE `acl_resource` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `route` varchar(255) NOT NULL,
  `default` tinyint(1) NOT NULL DEFAULT '0',
  `hidden_navigation` tinyint(1) NOT NULL DEFAULT '0',
  `hidden_from_navigation` tinyint(1) NOT NULL DEFAULT '0',
  `hidden_from_dashboard` tinyint(1) NOT NULL DEFAULT '0',
  `icon` varchar(45) NOT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acl_resource`
--

INSERT INTO `acl_resource` (`id`, `name`, `route`, `default`, `hidden_navigation`, `hidden_from_navigation`, `hidden_from_dashboard`, `icon`, `order`, `created_at`, `updated_at`) VALUES
(1, 'Home', 'home', 1, 1, 0, 1, 'fa fa-tachometer ', 1, NULL, NULL),
(3, 'Attractions', 'attractions', 0, 0, 0, 0, 'fa fa-users', 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `at_attraction`
--

CREATE TABLE `at_attraction` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `at_attraction`
--

INSERT INTO `at_attraction` (`id`, `name`, `created_at`, `updated_at`) VALUES
(7, 'Rome vatican', NULL, '2017-08-17 08:55:33'),
(18, 'England', '2017-08-17 08:59:13', '2017-08-17 08:59:13');

-- --------------------------------------------------------

--
-- Table structure for table `at_attraction_reviews`
--

CREATE TABLE `at_attraction_reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `attraction_id` int(11) NOT NULL,
  `isHidden` tinyint(1) NOT NULL DEFAULT '1',
  `rating` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `at_attraction_reviews`
--

INSERT INTO `at_attraction_reviews` (`id`, `user_id`, `attraction_id`, `isHidden`, `rating`, `created_at`, `updated_at`) VALUES
(12, 1, 18, 0, 5, '2017-08-17 11:49:18', '2017-08-17 11:48:38'),
(19, 2, 7, 1, 1, '2017-08-17 11:22:24', '2017-08-17 11:04:44'),
(20, 1, 7, 1, 1, '2017-08-17 11:47:08', '2017-08-17 11:05:45'),
(21, 15, 18, 1, 5, '2017-08-17 11:49:14', '2017-08-17 11:34:21'),
(22, 1, 7, 1, 5, '2017-08-17 11:48:54', '2017-08-17 11:48:54');

-- --------------------------------------------------------

--
-- Table structure for table `um_user`
--

CREATE TABLE `um_user` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `group_id` int(11) NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  `remember_token` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `um_user`
--

INSERT INTO `um_user` (`id`, `email`, `password`, `group_id`, `isActive`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin@gmail.com', '$2y$10$4tv6DigtJZmzeT3Z8XxmAux2CtrkEQ1wllQHaeJ3umNUZFBIvE532', 1, 1, 0, NULL, '2017-08-17 11:05:23'),
(2, 'user@gmail.com', '$2y$10$4tv6DigtJZmzeT3Z8XxmAux2CtrkEQ1wllQHaeJ3umNUZFBIvE532', 4, 1, 5, NULL, '2017-08-17 11:04:26'),
(15, 'user2@gmail.com', '$2y$10$4tv6DigtJZmzeT3Z8XxmAux2CtrkEQ1wllQHaeJ3umNUZFBIvE532', 4, 1, 5, NULL, '2017-08-17 11:04:26'),
(16, 'user3@gmail.com', '$2y$10$4tv6DigtJZmzeT3Z8XxmAux2CtrkEQ1wllQHaeJ3umNUZFBIvE532', 4, 1, 5, NULL, '2017-08-17 11:04:26');

-- --------------------------------------------------------

--
-- Table structure for table `um_user_group`
--

CREATE TABLE `um_user_group` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` varchar(45) DEFAULT NULL,
  `locked` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `um_user_group`
--

INSERT INTO `um_user_group` (`id`, `name`, `description`, `locked`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'Admin group', 1, NULL, '2017-05-08 07:43:06'),
(4, 'User', 'User group', NULL, '2016-06-27 12:30:50', '2016-06-27 14:17:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acl_acl`
--
ALTER TABLE `acl_acl`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_ACL_acl_1_idx` (`user_group_id`),
  ADD KEY `fk_ACL_acl_2_idx` (`resource_id`);

--
-- Indexes for table `acl_permission`
--
ALTER TABLE `acl_permission`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_ACL_permission_1_idx` (`resource_id`),
  ADD KEY `fk_ACL_permission_2_idx` (`user_group_id`),
  ADD KEY `fk_ACL_permission_3_idx` (`privilege_id`);

--
-- Indexes for table `acl_privilege`
--
ALTER TABLE `acl_privilege`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `acl_privilege_availability`
--
ALTER TABLE `acl_privilege_availability`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_ACL_privilege_availability_1_idx` (`resource_id`),
  ADD KEY `fk_ACL_privilege_availability_2_idx` (`privilege_id`);

--
-- Indexes for table `acl_resource`
--
ALTER TABLE `acl_resource`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`),
  ADD UNIQUE KEY `route_UNIQUE` (`route`);

--
-- Indexes for table `at_attraction`
--
ALTER TABLE `at_attraction`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `at_attraction_reviews`
--
ALTER TABLE `at_attraction_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_AT_attraction_reviews_1` (`user_id`),
  ADD KEY `fk_AT_attraction_reviews_2` (`attraction_id`);

--
-- Indexes for table `um_user`
--
ALTER TABLE `um_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD KEY `fk_UM_user_1_idx` (`group_id`);

--
-- Indexes for table `um_user_group`
--
ALTER TABLE `um_user_group`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acl_acl`
--
ALTER TABLE `acl_acl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `acl_permission`
--
ALTER TABLE `acl_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `acl_privilege`
--
ALTER TABLE `acl_privilege`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `acl_privilege_availability`
--
ALTER TABLE `acl_privilege_availability`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `acl_resource`
--
ALTER TABLE `acl_resource`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `at_attraction`
--
ALTER TABLE `at_attraction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `at_attraction_reviews`
--
ALTER TABLE `at_attraction_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `um_user`
--
ALTER TABLE `um_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `um_user_group`
--
ALTER TABLE `um_user_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `acl_acl`
--
ALTER TABLE `acl_acl`
  ADD CONSTRAINT `fk_ACL_acl_1` FOREIGN KEY (`user_group_id`) REFERENCES `um_user_group` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ACL_acl_2` FOREIGN KEY (`resource_id`) REFERENCES `acl_resource` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `acl_permission`
--
ALTER TABLE `acl_permission`
  ADD CONSTRAINT `fk_ACL_permission_1` FOREIGN KEY (`resource_id`) REFERENCES `acl_resource` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ACL_permission_2` FOREIGN KEY (`user_group_id`) REFERENCES `um_user_group` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ACL_permission_3` FOREIGN KEY (`privilege_id`) REFERENCES `acl_privilege` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `acl_privilege_availability`
--
ALTER TABLE `acl_privilege_availability`
  ADD CONSTRAINT `fk_ACL_privilege_availability_1` FOREIGN KEY (`resource_id`) REFERENCES `acl_resource` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ACL_privilege_availability_2` FOREIGN KEY (`privilege_id`) REFERENCES `acl_privilege` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `at_attraction_reviews`
--
ALTER TABLE `at_attraction_reviews`
  ADD CONSTRAINT `fk_AT_attraction_reviews_1` FOREIGN KEY (`user_id`) REFERENCES `um_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_AT_attraction_reviews_2` FOREIGN KEY (`attraction_id`) REFERENCES `at_attraction` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `um_user`
--
ALTER TABLE `um_user`
  ADD CONSTRAINT `fk_UM_user_1` FOREIGN KEY (`group_id`) REFERENCES `um_user_group` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
