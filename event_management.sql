-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 02, 2025 at 04:36 PM
-- Server version: 8.0.40-0ubuntu0.22.04.1
-- PHP Version: 8.1.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `event_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `date` date DEFAULT NULL,
  `venue` varchar(255) NOT NULL,
  `capacity` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `user_id`, `title`, `description`, `date`, `venue`, `capacity`, `created_at`) VALUES
(4, 5, 'Ratione excepturi il', 'Et at alias ipsam au', '1992-08-21', 'Aliqua Qui dolor co', 65, '2025-02-02 03:14:19'),
(5, 5, 'Irfan Chowdhury', 'Quasi praesentium qu', '1979-01-26', 'Quis itaque aut quas', 3, '2025-02-02 05:40:23'),
(10, 5, 'Sint elit harum et', 'Quasi do velit dolor', '1986-04-03', 'Dolor consequatur ar', 100, '2025-02-02 03:14:26'),
(11, 1, 'Tenetur aut doloremq', 'Cumque amet volupta', '1998-01-20', 'Vel nostrud et conse', 0, '2025-02-01 22:10:11'),
(13, 5, 'Nobis veniam quis i', 'Est dolorem maxime o', '1986-06-30', 'Unde aut est qui ess', 30, '2025-02-02 03:14:08'),
(14, 5, 'Eu sit odit in sunt', 'Aliquid sit aspernat', '1975-02-27', 'Adipisicing exercita', 60, '2025-02-02 03:13:53'),
(15, 5, 'Veniam hic voluptas', 'Voluptatum quae quis', '1984-03-21', 'Mollit et nisi dolor', 70, '2025-02-02 03:12:42'),
(16, 5, 'Ut minima sed ex vol', 'Velit beatae sunt re', '1986-11-07', 'In iusto eveniet sa', 67, '2025-02-02 03:08:37'),
(17, 21, 'Commodi laborum Arc', 'Ut quo numquam quam', '2020-06-06', 'Elit autem aut odio', 52, '2025-02-02 10:11:39'),
(18, 21, 'Adipisicing quis qua', 'Esse officia aut cu', '1994-09-03', 'Facilis consequatur', 15, '2025-02-02 10:24:11'),
(19, 21, 'PHP Adda', 'This is a Awesome program.', '2025-02-05', 'Mirpur, Dhaka', 50, '2025-02-02 10:26:14'),
(20, 21, 'Python Adda', 'This is nice program', '2025-02-10', 'Mirpur, Dhaka', 40, '2025-02-02 10:27:10');

-- --------------------------------------------------------

--
-- Table structure for table `event_attendee_registrations`
--

CREATE TABLE `event_attendee_registrations` (
  `id` int NOT NULL,
  `event_id` int NOT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `event_attendee_registrations`
--

INSERT INTO `event_attendee_registrations` (`id`, `event_id`, `user_id`, `created_at`) VALUES
(1, 5, 13, '2025-02-02 05:32:06'),
(2, 10, 14, '2025-02-02 05:33:43'),
(3, 10, 15, '2025-02-02 05:33:48'),
(4, 5, 16, '2025-02-02 05:41:25'),
(5, 5, 17, '2025-02-02 05:41:42'),
(6, 14, 18, '2025-02-02 06:21:27'),
(7, 13, 19, '2025-02-02 06:44:48'),
(8, 10, 19, '2025-02-02 06:46:31'),
(9, 13, 20, '2025-02-02 07:13:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(191) NOT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `address` text,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `phone`, `address`, `password`, `created_at`) VALUES
(1, 'Shellie Duffy', 'zenuwo@mailinator.com', 'admin', NULL, NULL, '$2y$10$3V6nDaru5qltVcY6Bz6CxufurgoFi4kNiROiWkY6zRmA4ngm/opi2', '2025-01-31 15:39:41'),
(2, 'Xavier Mcfarland', 'qyrypufu@mailinator.com', 'admin', NULL, NULL, '$2y$10$bGPA5VtAfWRAcAgQuJYs0OmsS/dmYCgbnxQKJhW.JET.X6L3mRXHO', '2025-01-31 15:40:01'),
(3, 'Macon Hamilton', 'wohylifemailinator', 'admin', NULL, NULL, '$2y$10$t.eYEbUVpG3ZePhPHPoey.evV3/zOOOKGdhPpQNd6P2XJb.aUur/.', '2025-01-31 16:02:48'),
(4, 'Jaden Beasley', 'nawyfigaq@mailinator.com', 'admin', NULL, NULL, '$2y$10$fYiu05kgQMQhWeQVauJm3uoI8gCf9/zc.37ULrKEpyb.ixtCr7pYm', '2025-01-31 16:07:37'),
(5, 'Irfan Chowdhury', 'irfanchowdhury80@gmail.com', 'admin', NULL, NULL, '$2y$10$sHn4OOX/uP7E5t6t9J/IneCwBP8L9o8Bvda1T7brrAFLKNeCFwctC', '2025-01-31 18:00:01'),
(6, 'Nevada Alford', 'maba@mailinator.com', 'admin', NULL, NULL, '$2y$10$pdLr2lOky2CMg2CpnL2/YOOhGz7fxl5K2iYW7SBbw83eI2vxi7Uia', '2025-01-31 18:41:39'),
(8, 'Elizabeth Berger', 'fuxyfuh@mailinator.com', 'admin', NULL, NULL, '$2y$10$vzOhGs6ZJ6Ib4a/4lqF86ugx4x9dsDHBkSNRrGfkBzC4EWueafkzy', '2025-01-31 18:46:15'),
(9, 'Wynne Montgomery', 'zelyb@mailinator.com', 'attendee', '+1 (678) 473-6461', 'Vel doloribus cum oc', NULL, '2025-02-02 10:59:15'),
(13, 'Samuel Battle', 'zugedynizo@mailinator.com', 'attendee', '+1 (258) 215-2549', 'Autem labore esse od', NULL, '2025-02-02 11:32:06'),
(14, 'Maxine Pearson', 'gyguwi@mailinator.com', 'attendee', '+1 (329) 647-3141', 'Ut do dolor elit ne', NULL, '2025-02-02 11:33:43'),
(15, 'Ria Blackwell', 'selefawu@mailinator.com', 'attendee', '+1 (491) 828-1188', 'Et obcaecati eum non', NULL, '2025-02-02 11:33:48'),
(16, 'Ruth Goodwin', 'bemijanag@mailinator.com', 'attendee', '+1 (665) 225-7658', 'Dolor cupidatat mole', NULL, '2025-02-02 11:41:25'),
(17, 'Amela Simon', 'quba@mailinator.com', 'attendee', '+1 (833) 399-9165', 'In aliquip id quis l', NULL, '2025-02-02 11:41:42'),
(18, 'Francesca Moreno', 'namasexuni@mailinator.com', 'attendee', '+1 (424) 251-2375', 'Ipsum commodo magni', NULL, '2025-02-02 12:21:27'),
(19, 'Marcia Tanner', 'cipegucezy@mailinator.com', 'attendee', '+1 (973) 414-8384', 'Est in omnis quia al', NULL, '2025-02-02 12:44:48'),
(20, 'Dalton Odom', 'cyqyb@mailinator.com', 'attendee', '+1 (493) 937-8955', 'Dolores voluptate in', NULL, '2025-02-02 13:13:46'),
(21, 'Mr Admin', 'admin@gmail.com', 'admin', NULL, NULL, '$2y$10$fdCu0f6IlXXx5R3kub5cCOYTw1o9ZnmIH52fzr9uTvJvFF/bEtEFi', '2025-02-02 15:30:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `event_attendee_registrations`
--
ALTER TABLE `event_attendee_registrations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `event_attendee_registrations`
--
ALTER TABLE `event_attendee_registrations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `event_attendee_registrations`
--
ALTER TABLE `event_attendee_registrations`
  ADD CONSTRAINT `event_attendee_registrations_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `event_attendee_registrations_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
