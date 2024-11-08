-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2024 at 09:26 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food_delivery`
--

-- --------------------------------------------------------

--
-- Table structure for table `delivery_methods`
--

CREATE TABLE `delivery_methods` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivery_methods`
--

INSERT INTO `delivery_methods` (`id`, `name`) VALUES
(1, 'Bike'),
(2, 'Car');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `name`, `description`, `price`) VALUES
(1, 'Pizza Margherita', 'Classic pizza with mozzarella and tomato', 12.99),
(2, 'Burger', 'Juicy beef burger with cheese and veggies', 8.99),
(3, 'Pasta Carbonara', 'Pasta with creamy sauce and bacon', 10.99),
(4, 'Salad', 'Healthy green salad with a variety of toppings', 6.49),
(5, 'Margherita Pizza', 'Classic pizza topped with fresh tomatoes, mozzarella, and basil.', 8.99),
(6, 'Cheese Burger', 'Juicy beef patty with cheese, lettuce, tomato, and special sauce.', 6.99),
(7, 'Veggie Wrap', 'Healthy wrap with grilled vegetables, hummus, and lettuce.', 5.99),
(8, 'Chicken Wings', 'Crispy fried chicken wings served with a side of dipping sauce.', 7.49),
(9, 'Caesar Salad', 'Fresh romaine lettuce with Caesar dressing, croutons, and parmesan cheese.', 4.99),
(10, 'Spaghetti Carbonara', 'Pasta in a creamy sauce with bacon, egg, and parmesan cheese.', 9.49);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `delivery_address` text NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `delivery_method` varchar(50) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_name`, `delivery_address`, `payment_method`, `delivery_method`, `total_amount`, `created_at`) VALUES
(1, 'fasfsa', 'asgasgsa', 'cash_on_delivery', 'bike', 3444.00, '2024-11-08 07:14:21'),
(2, 'gaga', 'gagas', 'cash_on_delivery', 'car', 22.00, '2024-11-08 07:58:11'),
(3, 'yuuichi', 'eastwoods', 'cash_on_delivery', 'car', 22.00, '2024-11-08 08:16:54'),
(4, 'luffy', 'wano', 'credit_card', 'bike', 22.00, '2024-11-08 08:25:38');

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `name`) VALUES
(1, 'Credit Card'),
(2, 'Cash on Delivery');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'gege', 'gege@gmail.com', '$2y$10$dh6Y6ksVTgTZZWOjK5T.bekIdB3RUOnnjskfDXxIbhnDeIsLTCgTa'),
(2, 'Admin', 'admin@gmail.com', '$2y$10$tyWNPr7EcStsBiU9oy7VR.Nl4UIh74tIHjQJ0CLSkqZVePkADbXRi'),
(3, 'Yuuichi', 'yuu@gmail.com', '$2y$10$/XFnLgEmI7fnMQL6uqEddueTUW2AJVEIezIdABB1rIiOHgyYXyOsm'),
(4, 'Luffy', 'luffy@gmail.com', '$2y$10$H2B9Do.M5hcVie./SMrHoeadF6fKoYdaOHqSLYjBrt.8MKWphQ7Iq');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `delivery_methods`
--
ALTER TABLE `delivery_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
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
-- AUTO_INCREMENT for table `delivery_methods`
--
ALTER TABLE `delivery_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
