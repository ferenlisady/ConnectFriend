-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2025 at 08:19 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `connectfriend`
--

-- --------------------------------------------------------

--
-- Table structure for table `avatars`
--

CREATE TABLE `avatars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `avatars`
--

INSERT INTO `avatars` (`id`, `name`, `price`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Superhero Avatar', '110', 'assets/superhero_avatar.png', '2025-01-08 02:09:54', '2025-01-08 02:09:54'),
(2, 'Cartoon Avatar', '40', 'assets/cartoon_avatar.png', '2025-01-08 02:09:54', '2025-01-08 02:09:54'),
(3, 'Animal Avatar', '20', 'assets/animal_avatar.png', '2025-01-08 02:09:54', '2025-01-08 02:09:54'),
(4, 'Fantasy Avatar', '150', 'assets/fantasy_avatar.png', '2025-01-08 02:09:54', '2025-01-08 02:09:54');

-- --------------------------------------------------------

--
-- Table structure for table `avatar_transactions`
--

CREATE TABLE `avatar_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `avatar_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `avatar_transactions`
--

INSERT INTO `avatar_transactions` (`id`, `user_id`, `avatar_id`, `created_at`, `updated_at`) VALUES
(1, 9, 4, '2025-01-09 11:34:48', '2025-01-09 11:34:48');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `receiver_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('Accepted','Pending','Decline') NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`id`, `sender_id`, `receiver_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 10, 9, 'Accepted', '2025-01-09 11:05:21', '2025-01-09 11:14:16');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_01_05_141003_create_friends_table', 1),
(5, '2025_01_07_141705_create_avatars_table', 1),
(6, '2025_01_07_141814_create_avatar_transactions_table', 1),
(7, '2025_01_07_180941_create_user_avatar_shares_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('eZQmRDuWjDKyotV82me58uuufjedTmMuupqO0aN0', 10, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoickFsRHpCdThDQlhHN1d0MVlNREE4QkpSZHJRVmJ3MWVNM095c1FMdCI7czo2OiJsb2NhbGUiO3M6MjoiZW4iO3M6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMyOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvbXktYXZhdGFycyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9maWxlIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTA7fQ==', 1736448653),
('SvQyDzdkx5g6zNBdqLJ3Sw8ShnKV7Z7JHNt0TbAN', 9, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZENRR3pOWVdpSko1U2xqc0Jvcnc3MnFSeTFrWXVRdVZpM2k2NFNvbCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9maWxlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo2OiJsb2NhbGUiO3M6MjoiZW4iO3M6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjk7fQ==', 1736449446);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `field_of_work` text NOT NULL,
  `linkedin_username` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `current_job` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `coin` int(11) NOT NULL DEFAULT 0,
  `profile_picture` varchar(255) NOT NULL DEFAULT 'assets/default.png',
  `visibility` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `gender`, `field_of_work`, `linkedin_username`, `phone_number`, `current_job`, `password`, `coin`, `profile_picture`, `visibility`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Billy Davidson', 'billydavidson@gmail.com', 'male', 'Design, Art, Photography', 'https://www.linkedin.com/in/billydavidson', '089523456790', 'Designer', '$2y$12$cfyd19PlXUy1xuAsN1E3TOHkph/Dk6zE1N2ohZFMcO5BnUswhn7ra', 100, 'assets/profile1.jpg', 1, NULL, '2025-01-08 02:09:54', '2025-01-08 02:09:54'),
(2, 'John Doe', 'johndoe@gmail.com', 'male', 'marketing, business, sales', 'https://www.linkedin.com/in/johndoe', '089523456791', 'Marketing Manager', '$2y$12$86Mz37grWFF9rTItuZp4ze8NbA11PQPKm7BdC9nCIVWVPp8/nvSNy', 100, 'assets/profile2.jpg', 1, NULL, '2025-01-08 02:09:54', '2025-01-08 02:09:54'),
(3, 'Alice Smith', 'alicesmith@gmail.com', 'female', 'finance, consulting, accounting', 'https://www.linkedin.com/in/alicesmith', '089523456792', 'Financial Consultant', '$2y$12$YiirsTR5P9k3VovRfZjHROmNNks9mYUeemDOkbB0g7/MgPLOvfrdO', 100, 'assets/profile3.jpg', 1, NULL, '2025-01-08 02:09:54', '2025-01-08 02:09:54'),
(4, 'Bob Johnson', 'bobjohnson@gmail.com', 'male', 'engineering, construction, design', 'https://www.linkedin.com/in/bobjohnson', '089523456793', 'Civil Engineer', '$2y$12$ubYAr9n3Hi/W4HuLng8.9uWEmGZYUS6GDyWXYHefArxe9HOQSIHjC', 100, 'assets/profile4.jpg', 1, NULL, '2025-01-08 02:09:54', '2025-01-08 02:09:54'),
(5, 'Sarah Lee', 'sarahlee@gmail.com', 'female', 'education, teaching, art', 'https://www.linkedin.com/in/sarahlee', '089523456794', 'Professor', '$2y$12$9yTNtjrWyZXNJui.5OmV0OVHlTkQ/M6plAnJNCIaAohiAvlX8F0dS', 100, 'assets/profile5.jpg', 1, NULL, '2025-01-08 02:09:54', '2025-01-08 02:09:54'),
(6, 'Michael Brown', 'michaelbrown@gmail.com', 'male', 'healthcare, medicine, lifestyle', 'https://www.linkedin.com/in/michaelbrown', '089523456795', 'Doctor', '$2y$12$.SoZjgUgNfUpVqMgcYan8eWQd0qolbXYm.nFNwP2FSYV7DAoHTCPa', 100, 'assets/profile6.jpg', 1, NULL, '2025-01-08 02:09:54', '2025-01-08 02:09:54'),
(7, 'Emily Davis', 'emilydavis@gmail.com', 'female', 'design, architecture, art', 'https://www.linkedin.com/in/emilydavis', '089523456796', 'Architect', '$2y$12$akyKgg275oqCWq8uh64Yv.Cn.kiHkfytFmMg.pXOQ/7R5QUKIakTO', 100, 'assets/profile7.jpg', 1, NULL, '2025-01-08 02:09:54', '2025-01-08 02:09:54'),
(9, 'Feren Lisady', 'ferenlisady06@gmail.com', 'Female', 'Information technology,Science and technology studies,Management', 'https://www.linkedin.com/in/ferenlisady', '0895618739727', 'Student', '$2y$12$bCGt0M9yl8fXXTlvurdZFu.WiqJZL06rjl4P7HeXe4es40ZPCqZuy', 123, 'assets/fantasy_avatar.png', 1, NULL, '2025-01-08 02:26:53', '2025-01-09 11:41:41'),
(10, 'Fani Lisady', 'fanilisady@gmail.com', 'Female', 'IT,Architect,Culinary', 'https://www.linkedin.com/in/fanilisady', '081524046435', 'Student', '$2y$12$XtflNyXWT91Ino8zalqf1eBOI34pPv/DW8onxA.7.yQUrlRPVsiVu', 204, 'assets/default.png', 1, NULL, '2025-01-08 03:12:14', '2025-01-09 10:37:03');

-- --------------------------------------------------------

--
-- Table structure for table `user_avatar_shares`
--

CREATE TABLE `user_avatar_shares` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `receiver_id` bigint(20) UNSIGNED NOT NULL,
  `avatar_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `avatars`
--
ALTER TABLE `avatars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `avatar_transactions`
--
ALTER TABLE `avatar_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `avatar_transactions_user_id_foreign` (`user_id`),
  ADD KEY `avatar_transactions_avatar_id_foreign` (`avatar_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`),
  ADD KEY `friends_sender_id_foreign` (`sender_id`),
  ADD KEY `friends_receiver_id_foreign` (`receiver_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_avatar_shares`
--
ALTER TABLE `user_avatar_shares`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_avatar_shares_sender_id_foreign` (`sender_id`),
  ADD KEY `user_avatar_shares_receiver_id_foreign` (`receiver_id`),
  ADD KEY `user_avatar_shares_avatar_id_foreign` (`avatar_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `avatars`
--
ALTER TABLE `avatars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `avatar_transactions`
--
ALTER TABLE `avatar_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_avatar_shares`
--
ALTER TABLE `user_avatar_shares`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `avatar_transactions`
--
ALTER TABLE `avatar_transactions`
  ADD CONSTRAINT `avatar_transactions_avatar_id_foreign` FOREIGN KEY (`avatar_id`) REFERENCES `avatars` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `avatar_transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `friends_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `friends_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_avatar_shares`
--
ALTER TABLE `user_avatar_shares`
  ADD CONSTRAINT `user_avatar_shares_avatar_id_foreign` FOREIGN KEY (`avatar_id`) REFERENCES `avatars` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_avatar_shares_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_avatar_shares_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
