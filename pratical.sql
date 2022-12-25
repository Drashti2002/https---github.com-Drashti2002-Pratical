-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 25, 2022 at 10:47 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pratical`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `event_desc` longtext DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `user_id`, `event_name`, `event_desc`, `start_date`, `end_date`, `type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Test event1234', 'test description12344', '2022-12-24', '2022-12-25', 'weekly', '2022-12-24 07:08:36', '2022-12-24 08:14:38', NULL),
(2, 1, 'sdfsdf', 'fgkjgfkj', '2022-12-25', '2022-12-31', 'weekly', '2022-12-24 07:13:49', '2022-12-24 07:13:49', NULL),
(3, 1, 'fsfhsfh', 'fhgfdjgh', '2022-12-24', '2022-12-24', 'single', '2022-12-24 07:20:04', '2022-12-24 07:20:04', NULL),
(4, 1, 'tjtitjer', 'jtrerhtreth', '2022-12-24', '2022-12-24', 'yearly', '2022-12-24 07:22:14', '2022-12-24 13:00:14', '2022-12-23 18:30:00'),
(5, 1, 'dfgdfg', 'fdgdfgdfg', '2022-12-25', '2022-12-31', 'weekly', '2022-12-24 07:25:06', '2022-12-24 12:59:14', '2022-12-23 18:30:00'),
(6, 1, 'gjgghsghsghsf', 'djfghdjkfghsutjfg', '2023-01-01', '2023-01-07', 'create', '2022-12-25 00:56:27', '2022-12-25 00:56:27', NULL),
(7, 1, 'rtyryrtyrtyrty', 'tertertertdfvbcvbc', '2022-11-01', NULL, 'monthly', '2022-12-25 01:11:45', '2022-12-25 03:20:02', NULL),
(8, 1, 'dfsdfsdf', NULL, '2022-12-25', '2022-12-26', 'create', '2022-12-25 03:16:36', '2022-12-25 03:19:23', '2022-12-24 18:30:00'),
(9, 1, 'fsdfsdf', NULL, '2022-12-25', '2022-12-26', 'create', '2022-12-25 03:17:21', '2022-12-25 03:19:11', '2022-12-24 18:30:00'),
(10, 1, 'sdfsdfsdf', NULL, '2022-12-25', '2022-12-26', 'create', '2022-12-25 03:17:46', '2022-12-25 03:19:14', '2022-12-24 18:30:00'),
(11, 1, 'fggdfg', NULL, '2022-12-25', '2022-12-26', 'create', '2022-12-25 03:21:17', '2022-12-25 03:21:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2022_12_23_171028_add_phone_in_user', 2),
(5, '2022_12_24_121328_create_events_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `phone`) VALUES
(1, 'Test', 'test@gmail.com', NULL, '$2y$10$43ORDmiEtIvKkkRvdh4doeBUrJ78k8bnYbreU.NnapcwMN9cf1hmS', NULL, '2022-12-23 11:46:31', '2022-12-23 11:46:31', '9898989898'),
(2, 'Test1', 'test1@gmail.com', NULL, '$2y$10$Hf9XEtm3gjTnQQ4H6HHbBO.qv.CMLUgbukDNRrUehPVGbqleqCcV6', NULL, '2022-12-23 11:49:49', '2022-12-23 11:49:49', '9879879874');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
