-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2026 at 03:06 AM
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
-- Database: `securevault`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action` enum('register','login','logout','upload','download','share','revoke_share','delete','view','preview') NOT NULL,
  `file_id` int(11) DEFAULT NULL,
  `target_user_id` int(11) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(500) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `file_id`, `target_user_id`, `ip_address`, `user_agent`, `details`, `created_at`) VALUES
(1, 1, 'register', NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'New user registered: indri', '2026-05-28 00:39:04'),
(2, 1, 'login', NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', NULL, '2026-05-28 00:39:18'),
(3, 1, 'upload', 1, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'Uploaded: Kelompok 6 - How Does Digital Transformation Improve Organizational Resilience.pdf (1472545 bytes)', '2026-05-28 01:01:33'),
(4, 1, 'download', 1, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'Downloaded: Kelompok 6 - How Does Digital Transformation Improve Organizational Resilience.pdf', '2026-05-28 01:01:47'),
(5, 1, 'download', 1, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'Downloaded: Kelompok 6 - How Does Digital Transformation Improve Organizational Resilience.pdf', '2026-05-28 01:02:41'),
(6, 1, 'logout', NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', NULL, '2026-05-28 01:04:40'),
(7, 2, 'register', NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'New user registered: hilal', '2026-05-28 01:05:14'),
(8, 1, 'login', NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', NULL, '2026-05-28 01:05:26'),
(9, 1, 'download', 1, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'Downloaded: Kelompok 6 - How Does Digital Transformation Improve Organizational Resilience.pdf', '2026-05-28 01:05:44'),
(10, 1, 'share', 1, 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', NULL, '2026-05-28 01:05:44'),
(11, 1, 'logout', NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', NULL, '2026-05-28 01:05:55'),
(12, 2, 'login', NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', NULL, '2026-05-28 01:06:06'),
(13, 2, 'download', 1, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'Downloaded: Kelompok 6 - How Does Digital Transformation Improve Organizational Resilience.pdf', '2026-05-28 01:06:19');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `filename_original` varchar(255) NOT NULL,
  `filename_stored` varchar(255) NOT NULL,
  `file_size` bigint(20) NOT NULL,
  `mime_type` varchar(100) DEFAULT NULL,
  `file_hash` varchar(64) NOT NULL,
  `original_hash` varchar(64) NOT NULL,
  `session_key_enc` text NOT NULL,
  `session_key_iv` varchar(64) NOT NULL,
  `aes_tag` varchar(64) NOT NULL,
  `is_deleted` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `owner_id`, `filename_original`, `filename_stored`, `file_size`, `mime_type`, `file_hash`, `original_hash`, `session_key_enc`, `session_key_iv`, `aes_tag`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 'Kelompok 6 - How Does Digital Transformation Improve Organizational Resilience.pdf', '98723105-8ee9-41ba-8d24-b9440cd98576.enc', 1472545, 'application/pdf', 'd262929aefdd5b34c61bd552c535892c48cf408b6d3400eb60a665cdcebab3fa', 'b26f765145b892beda664e16ea5ed8f34dfb9e5d67375b07c983bd7d15ee481a', 'fRG+YbE81iiG9QK+Z69n+TvJC8ywQYyn1PgNBlGZIuXgMrsTPVQaBD2yhRjT5aZSfpUtn1FKI22VCoO8BhPUptWWK7jI7TIJhYfojhK2bz+x45iiWd4WTDBFUrekMV9O4GrnB3ur+rKSB3cbuBoa75I8k+nP2Nj72MPx8fDz7q+KSgsBDGO6bHemlH4NXUfVCpBBaGhvlvRichNQiU5SncekibaYqUUFk4ddpLOwR6yLAmJSRD+yGxI23+ebbiPVdPlOt1x6/1bBJdiX+U4E7aCOote08tHGuapL0oLeDyVY3O9fHjrvwINbItR0geS+RvLp/jgboz2dYk5iDDF8lQ==', 'f9882cb18e9c62ceee8f8a7b', '1528318a4f34e146b60c583126263b80', 0, '2026-05-28 01:01:33', '2026-05-28 01:01:33');

-- --------------------------------------------------------

--
-- Table structure for table `file_shares`
--

CREATE TABLE `file_shares` (
  `id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `recipient_id` int(11) NOT NULL,
  `session_key_enc` text NOT NULL,
  `permission` enum('read') DEFAULT 'read',
  `shared_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_revoked` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `file_shares`
--

INSERT INTO `file_shares` (`id`, `file_id`, `owner_id`, `recipient_id`, `session_key_enc`, `permission`, `shared_at`, `is_revoked`) VALUES
(1, 1, 1, 2, 'mRdmzolZC7Y77s0JR8cL/I7gjXMGoLnWGzQamtXbrArHQmHRNFjqqyTFDcJ5cebU797ZKNF6rCl5K62I+Z9tJsE0nPo6zl1CW3kplFAm/eJyVTrH1++k/bEOsP7GPxvMm3qXgUpP46tbwIKTLfbeLexT061aqgSGQqT9MvrNF903QwcH9gbF1FmwwNlyUAPcYoyDoqJMEil5tO2rnGYCIk8zAvTVos/KL/V/GWJLlvXakvrnxuJtfmCrfC3I78IJLWy9Xr6O7w2EMrTGhOyyh+nUGDSI+KCks7C45w3QPcT3rk5icVxbB/C5lqcHbRYmXVsuGgujUq2c55x+to6sNA==', 'read', '2026-05-28 01:05:44', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `public_key` text NOT NULL,
  `private_key_enc` text NOT NULL,
  `private_key_iv` varchar(64) NOT NULL,
  `private_key_salt` varchar(64) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_login` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password_hash`, `public_key`, `private_key_enc`, `private_key_iv`, `private_key_salt`, `created_at`, `last_login`, `is_active`) VALUES
(1, 'indri', 'indri@mail.com', '$2y$12$zJhD3Pn2xUJb7d4SPYKdxeWCgUg8MTROjU0PodfXvm0168Cxkke32', '-----BEGIN PUBLIC KEY-----\r\nMIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA3u4jf9NGQ5tZ4ikQHCgO\r\nXszIhjMyYDev6imj4inVoIC7olzVwRVohz2N6MGcGlm5rvel16SWS05q2Y5PPU2T\r\nA+AzV3FatCZKYODkBZD3j/57vRzYOPHD5fEHGRdTVdvbXzIMf5N38EUGiTqSrivY\r\n8ITqZCobiZNhX1K18sHVToUdG6OYuSm5LegKgTEwbneTc+sXaEdePqX35+L+ryLd\r\nM44o2lakFgmixtwep+Mcu1jFvLud8sDkBRJAbbY4cmBuOreemarWcc11uYXvhu9P\r\n17NyqEx7wk9ftps8T6/A6nlOl4BYJ9q3x7j02/bsWytbaIdnO12FdrnSVQdygs0l\r\nQwIDAQAB\r\n-----END PUBLIC KEY-----', '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', '0a82e2ead03672788b192fe17def827c', '58766385872371f059e4928c3702b9ca', '2026-05-28 00:39:04', '2026-05-28 01:05:26', 1),
(2, 'hilal', 'hilal@mail.com', '$2y$12$dyNqbS.gKUAg7tRsrPt/GextW3zYI7r8VMdXyzK.ltKGZu0QNkprm', '-----BEGIN PUBLIC KEY-----\r\nMIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAs8cZIPwTSper91zGtOFu\r\nplXaymSgXztx8XYIpAZx5lKQ1vPnM5gcQ16w9DvUPGdFY/UehSMoiFTWvx3pQ6S8\r\n1qzZQHaN/ZGy0IBOyhL9Adbe3s+DieLbyKA+B1s8GXfPF30EfWxLfd45S/KouRlg\r\nOlT8T0JFuRCZp5+3o9Paars1ZucucEfJpOxHD2gprkmJS2ECpG8Gb62Rd1eUHipT\r\nPvfgLWUF9v5yX/4UgZZIXfQuqevbeg/p/5OxWMxjz796FmzdXD8h/91meZS52lj1\r\n84CrW4oE6k9S5JXTYnYZZtR/zUC8om7qwXo/vDBSS9wCeA31B+WeJOKm2KMofTGr\r\nhQIDAQAB\r\n-----END PUBLIC KEY-----', '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', '313eee7a6e7103e7a4fe9f1a71e1ed32', '1813614c9dd433ce010c603552e3a805', '2026-05-28 01:05:14', '2026-05-28 01:06:06', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_sessions`
--

CREATE TABLE `user_sessions` (
  `session_token_hash` char(64) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `expires_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_active` tinyint(1) DEFAULT 1,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_logs_user` (`user_id`),
  ADD KEY `idx_logs_file` (`file_id`),
  ADD KEY `idx_logs_created` (`created_at`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `filename_stored` (`filename_stored`),
  ADD KEY `idx_files_owner` (`owner_id`);

--
-- Indexes for table `file_shares`
--
ALTER TABLE `file_shares`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_share` (`file_id`,`recipient_id`),
  ADD KEY `owner_id` (`owner_id`),
  ADD KEY `idx_shares_file` (`file_id`),
  ADD KEY `idx_shares_recipient` (`recipient_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_sessions`
--
ALTER TABLE `user_sessions`
  ADD PRIMARY KEY (`session_token_hash`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `idx_sessions_cleanup` (`expires_at`,`is_active`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `file_shares`
--
ALTER TABLE `file_shares`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `activity_logs_ibfk_2` FOREIGN KEY (`file_id`) REFERENCES `files` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `file_shares`
--
ALTER TABLE `file_shares`
  ADD CONSTRAINT `file_shares_ibfk_1` FOREIGN KEY (`file_id`) REFERENCES `files` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `file_shares_ibfk_2` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `file_shares_ibfk_3` FOREIGN KEY (`recipient_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_sessions`
--
ALTER TABLE `user_sessions`
  ADD CONSTRAINT `user_sessions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
