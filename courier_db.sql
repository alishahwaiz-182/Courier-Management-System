-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2026 at 04:51 PM
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
-- Database: `courier_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(3, 'admin', '$2y$10$wruMVynR3lFj3bpx1r6Uc.MUPVGPqH65Fdr5Ve9lQqd8gV21awkPO');

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`id`, `username`, `password`, `city`) VALUES
(4, 'haris', '$2y$10$dS45GRsi9T3UP2Lbc2WyEehWRVTJWfh5x8s/.XTdndqEYFKrvtUgS', 'karachi'),
(5, 'ayan', '$2y$10$pu3LeClD8M/IP7IGnjsPdeHjmnZ3LSjmuEIHnX0vz.6QZDXixSyTK', 'hyderabad'),
(6, 'faizan', '$2y$10$EZ7WQbhrogM7WHw2W9q1tOrL65Ece9ihawMKcembe7tolTvT5/6jy', 'lahore');

-- --------------------------------------------------------

--
-- Table structure for table `couriers`
--

CREATE TABLE `couriers` (
  `id` int(11) NOT NULL,
  `tracking_number` varchar(50) DEFAULT NULL,
  `sender_name` varchar(100) DEFAULT NULL,
  `receiver_name` varchar(100) DEFAULT NULL,
  `from_city` varchar(100) DEFAULT NULL,
  `to_city` varchar(100) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `couriers`
--

INSERT INTO `couriers` (`id`, `tracking_number`, `sender_name`, `receiver_name`, `from_city`, `to_city`, `status`, `created_at`) VALUES
(1, 'TRK69D7D003C4265', 'raza', 'mubeen', 'karachi', 'nawabshah', 'Delivered', '2026-04-09 16:12:51'),
(2, 'TRK69D7D02083563', 'ali', 'ahmed', 'karachi', 'hyderabad', 'Delivered', '2026-04-09 16:13:20'),
(3, 'TRK69D7D03DD93C6', 'amna', 'zara', 'lahore', 'karachi', 'Delivered', '2026-04-09 16:13:49'),
(4, 'TRK69D7D063636B6', 'khalid', 'sara', 'multan', 'karachi', 'Pending', '2026-04-09 16:14:27'),
(5, 'TRK69D7D0785269E', 'faizan', 'ahad', 'lahore', 'hyderabad', 'Pending', '2026-04-09 16:14:48'),
(6, 'TRK69D7D0BDD514A', 'mubashir', 'moin', 'hyderabad', 'karachi', 'Pending', '2026-04-09 16:15:57'),
(7, 'TRK69D90330ED60F', 'raza', 'ali', 'hyderabad', 'karachi', 'Pending', '2026-04-10 14:03:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(2, 'abdullah', 'abdullah@gmail.com', '$2y$10$LWEVTIXIqx0XiO4ex8rjN.pyjigeL/0OAC.oLRn.AZJlAGxyrtVtS'),
(3, 'ali', 'ali@gmail.com', '$2y$10$oeIzWS4w8jHZ4kMG61vpNexLFlXy6.ao73Sl75bQvgzAXsgyMhXZm'),
(4, 'ahmed', 'ahmed@gmail.com', '$2y$10$h3pw9yOYOBqwfRzxdDeRyeIs2CCCx.PdTMwwT9V59ttLrt6onoZyC'),
(5, 'Alishahwaiz', 'alishahwaiz182@gmail', '$2y$10$KHcJ0kbu.pQKZxm8f921V.1XZrBjvCcyJt/EY/5xyexuMVV357Qoe'),
(6, 'Alishahwaiz', 'alishahwaiz182@gmail.com', '$2y$10$2UDYTk./MNA6r3LBVBK7c.sbxN4W66AeKgP.XOnEZOH2aHHNv7asW');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `couriers`
--
ALTER TABLE `couriers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `couriers`
--
ALTER TABLE `couriers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
