-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Apr 25, 2022 at 12:56 AM
-- Server version: 8.0.28
-- PHP Version: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `actors`
--

CREATE TABLE `actors` (
  `actor_id` bigint UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `actors`
--

INSERT INTO `actors` (`actor_id`, `first_name`, `last_name`, `avatar`, `description`, `created_at`, `updated_at`) VALUES
(1, 'An', 'Nhật An', NULL, NULL, '2022-04-24 04:49:58', '2022-04-24 04:49:58'),
(2, 'An', 'Khánh', NULL, NULL, '2022-04-24 07:07:34', '2022-04-24 07:07:34');

-- --------------------------------------------------------

--
-- Table structure for table `actor_movie`
--

CREATE TABLE `actor_movie` (
  `movie_actor_id` bigint UNSIGNED NOT NULL,
  `movie_movie_id` bigint UNSIGNED NOT NULL,
  `actor_actor_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `actor_movie`
--

INSERT INTO `actor_movie` (`movie_actor_id`, `movie_movie_id`, `actor_actor_id`, `created_at`, `updated_at`) VALUES
(1, 3, 2, '2022-04-25 00:35:58', '2022-04-25 00:35:58');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `title`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Hành Động', 'hanh-dong', NULL, '2022-04-23 09:42:50', '2022-04-23 09:42:50'),
(2, 'Khoa Học Viễn Tưởng', 'khoa-hoc-vien-tuong', NULL, '2022-04-23 13:52:38', '2022-04-23 13:52:38'),
(3, 'Tâm Lý', 'tam-ly', NULL, '2022-04-23 13:52:45', '2022-04-23 13:52:45'),
(4, 'Tình Cảm', 'tinh-cam', NULL, '2022-04-23 13:52:52', '2022-04-23 13:52:52');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `language_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`language_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Tiếng Anh', '2022-04-24 02:59:32', '2022-04-24 02:59:32'),
(2, 'Tiếng Việt', '2022-04-24 02:59:40', '2022-04-24 02:59:40');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `movie_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `images` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trailer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `release_date` date DEFAULT NULL,
  `duaration` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `director` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movie_id`, `title`, `slug`, `description`, `images`, `trailer`, `release_date`, `duaration`, `director`, `language_id`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Phim con heo', 'phim-con-heo', 'Hello', 'https://nhungcuonsachhay.com/wp-content/uploads/2021/05/Thang-quy-nho-Nguyen-Nhat-Anh.jpg', 'htppps', '2022-04-22', '120 phút', NULL, 1, 1, '2022-04-25 00:31:43', '2022-04-25 00:31:43'),
(2, 'Phim con heo', 'phim-con-heo', 'Hello', 'https://nhungcuonsachhay.com/wp-content/uploads/2021/05/Thang-quy-nho-Nguyen-Nhat-Anh.jpg', 'htppps', '2022-04-22', '120 phút', NULL, 1, 1, '2022-04-25 00:34:55', '2022-04-25 00:34:55'),
(3, 'Phim con heo', 'phim-con-heo', 'Hello', 'https://nhungcuonsachhay.com/wp-content/uploads/2021/05/Thang-quy-nho-Nguyen-Nhat-Anh.jpg', 'htppps', '2022-04-22', '120 phút', NULL, 1, 1, '2022-04-25 00:35:58', '2022-04-25 00:35:58');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` bigint UNSIGNED NOT NULL,
  `total_price` decimal(19,4) NOT NULL,
  `total_seat` tinyint NOT NULL,
  `status` enum('new','paid','unpaid','canceled') COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` decimal(19,4) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

CREATE TABLE `seats` (
  `seat_id` bigint UNSIGNED NOT NULL,
  `number` smallint NOT NULL,
  `type_seat_id` bigint UNSIGNED NOT NULL,
  `room_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shows`
--

CREATE TABLE `shows` (
  `show_id` bigint UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `movie_id` bigint UNSIGNED NOT NULL,
  `room_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `ticket_id` bigint UNSIGNED NOT NULL,
  `price` decimal(19,4) NOT NULL,
  `status` enum('active','canceled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `order_id` bigint UNSIGNED NOT NULL,
  `show_id` bigint UNSIGNED NOT NULL,
  `seat_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `type_seats`
--

CREATE TABLE `type_seats` (
  `type_seat_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `type_seats`
--

INSERT INTO `type_seats` (`type_seat_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Ghế 4DX', '2022-04-24 03:25:26', '2022-04-24 03:25:26'),
(2, 'Ghế Imax', '2022-04-24 03:25:26', '2022-04-24 03:25:26'),
(3, 'Ghế thường', '2022-04-24 03:25:26', '2022-04-24 03:25:26'),
(4, 'Ghế đôi', '2022-04-24 03:25:26', '2022-04-24 03:25:26'),
(5, 'Giường nằm', '2022-04-24 03:25:26', '2022-04-24 03:25:26'),
(6, 'Gold Class', '2022-04-24 03:25:26', '2022-04-24 03:25:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint UNSIGNED NOT NULL,
  `id_card_number` int DEFAULT NULL,
  `first_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('male','female') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'male',
  `birthday` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `status` enum('active','inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `role` enum('admin','customer') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'customer',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `id_card_number`, `first_name`, `last_name`, `gender`, `birthday`, `password`, `avatar`, `telephone`, `email`, `email_verified_at`, `status`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, NULL, 'An', 'Nhật', 'male', '2000-04-14 00:00:00', '$2y$10$wo78Hlkj2EII1CBQsAq7TO0lrnqNrLbOoU6gJx4GFD1Kwnv8pbW0K', 'https://lh3.googleusercontent.com/a-/AOh14GgbTYnLp4THmULBL3hvWinMgGV7V0stfA_Jr8_izw=s288-p-rw-no', '0901234567', 'admin@gmail.com', NULL, 'active', 'admin', NULL, '2022-04-23 07:36:36', '2022-04-23 09:37:13'),
(2, NULL, 'An', 'Khánh', 'male', '2000-04-05 00:00:00', '$2y$10$Uscyf9e0E3TCvVrG5lFYZekNiNSxg3RUwSeFtL5S5lGjpzvyOe5GO', 'https://lh3.googleusercontent.com/a-/AOh14GgbTYnLp4THmULBL3hvWinMgGV7V0stfA_Jr8_izw=s288-p-rw-no', '0901234111', 'DH51804249@student.stu.edu.vn', NULL, 'active', 'customer', NULL, '2022-04-23 09:36:31', '2022-04-23 09:36:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actors`
--
ALTER TABLE `actors`
  ADD PRIMARY KEY (`actor_id`);

--
-- Indexes for table `actor_movie`
--
ALTER TABLE `actor_movie`
  ADD PRIMARY KEY (`movie_actor_id`),
  ADD KEY `movie_id` (`movie_movie_id`),
  ADD KEY `actor_id` (`actor_actor_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`language_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`movie_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `language_id` (`language_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`seat_id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `type_seat_id` (`type_seat_id`);

--
-- Indexes for table `shows`
--
ALTER TABLE `shows`
  ADD PRIMARY KEY (`show_id`),
  ADD KEY `movie_id` (`movie_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `seat_id` (`seat_id`),
  ADD KEY `show_id` (`show_id`);

--
-- Indexes for table `type_seats`
--
ALTER TABLE `type_seats`
  ADD PRIMARY KEY (`type_seat_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actors`
--
ALTER TABLE `actors`
  MODIFY `actor_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `actor_movie`
--
ALTER TABLE `actor_movie`
  MODIFY `movie_actor_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `language_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `movie_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seats`
--
ALTER TABLE `seats`
  MODIFY `seat_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shows`
--
ALTER TABLE `shows`
  MODIFY `show_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticket_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `type_seats`
--
ALTER TABLE `type_seats`
  MODIFY `type_seat_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `actor_movie`
--
ALTER TABLE `actor_movie`
  ADD CONSTRAINT `actor_movie_ibfk_1` FOREIGN KEY (`movie_movie_id`) REFERENCES `movies` (`movie_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `actor_movie_ibfk_2` FOREIGN KEY (`actor_actor_id`) REFERENCES `actors` (`actor_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `movies_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `movies_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`language_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `seats`
--
ALTER TABLE `seats`
  ADD CONSTRAINT `seats_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `seats_ibfk_2` FOREIGN KEY (`type_seat_id`) REFERENCES `type_seats` (`type_seat_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `shows`
--
ALTER TABLE `shows`
  ADD CONSTRAINT `shows_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `shows_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tickets_ibfk_2` FOREIGN KEY (`seat_id`) REFERENCES `seats` (`seat_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tickets_ibfk_3` FOREIGN KEY (`show_id`) REFERENCES `shows` (`show_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
