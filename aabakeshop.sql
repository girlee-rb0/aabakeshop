-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2024 at 06:20 PM
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
-- Database: `aabakeshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` int(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `description` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `firstname`, `lastname`, `email`, `username`, `password`, `phone_number`, `role`, `description`) VALUES
(16, 'mark angelo', 'antang', 'markangeloabaigar.antang@bicol-u.edu.ph', 'mark', '$2y$10$Rus6SFqCM0I2cXfKg42MbunLW2KjOSBKBxSuSk0p9vGMgy3nzhj0.', 0, 'admin', 0),
(17, 'Girlie', 'Bo', 'girlie@gmail.com', 'Girlie', '$2y$10$Edov7w0fZ/IQz25Ulba93uYVgRZfkYnT5TlYwapuLftT2IggtiPmm', 0, 'admin', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cake_ingredient`
--

CREATE TABLE `cake_ingredient` (
  `cake_ingredient_id` int(11) NOT NULL,
  `ingredient_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `measurement` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cake_ingredient`
--

INSERT INTO `cake_ingredient` (`cake_ingredient_id`, `ingredient_id`, `quantity`, `measurement`) VALUES
(1, 1, 500, 'grams\r\n'),
(2, 2, 250, 'grams'),
(3, 3, 2, 'unit'),
(4, 4, 200, 'grams'),
(5, 5, 250, 'millimeters'),
(6, 6, 50, 'millimeters'),
(7, 7, 50, 'millimeters'),
(8, 8, 50, 'millimeters'),
(9, 9, 50, 'millimeters');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` decimal(10,2) GENERATED ALWAYS AS (`quantity` * `price`) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(255) NOT NULL,
  `Category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `Category_name`) VALUES
(1, 'Cakes');

-- --------------------------------------------------------

--
-- Table structure for table `flavors`
--

CREATE TABLE `flavors` (
  `Flavor_id` int(255) NOT NULL,
  `Flavor_name` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flavors`
--

INSERT INTO `flavors` (`Flavor_id`, `Flavor_name`, `Status`) VALUES
(1, 'chocolate', 'A'),
(2, 'Vanilla', 'A'),
(3, 'Strawberry', 'A'),
(4, 'Mocha', 'A'),
(5, 'cheese', 'A'),
(6, 'Yema', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `ingredient_id` int(11) NOT NULL,
  `ingredient_name` varchar(255) NOT NULL,
  `measurement` varchar(11) NOT NULL,
  `quantity` int(255) NOT NULL,
  `cost` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`ingredient_id`, `ingredient_name`, `measurement`, `quantity`, `cost`) VALUES
(1, 'flour', 'kilogram', 25, 40),
(2, 'Sugar', 'kilogram', 25, 85),
(3, 'Eggs', 'units', 15, 8),
(4, 'Butter', 'kilogram', 5, 300),
(5, 'Milk', 'liters', 10, 130);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `product_id` int(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `price` int(255) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `subtotal` int(255) NOT NULL,
  `status` varchar(255) DEFAULT 'pending',
  `tracking_number` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `session_id`, `product_id`, `product_name`, `quantity`, `price`, `order_date`, `subtotal`, `status`, `tracking_number`) VALUES
(66, 12, 'tv1do7re2ohrq4bkq3qh93793i', 1, 'Birthday Cake', 2, 300, '2024-05-30 15:47:36', 600, 'received', '4B8C39692C03C658'),
(67, 12, 'tv1do7re2ohrq4bkq3qh93793i', 2, 'Wedding Cake', 1, 300, '2024-05-10 15:47:37', 300, 'received', '956EACC40C08082F'),
(68, 18, 'tv1do7re2ohrq4bkq3qh93793i', 10, 'Round Cake', 1, 300, '2024-05-30 15:50:54', 300, 'received', '7EF1C0C8917BC8A1'),
(69, 18, 'tv1do7re2ohrq4bkq3qh93793i', 9, 'Yema Cake', 1, 300, '2024-05-30 15:50:54', 300, 'received', 'B0009FF90E481610'),
(70, 18, 'tv1do7re2ohrq4bkq3qh93793i', 8, 'Blueberry', 1, 300, '2024-05-30 15:54:04', 300, 'received', '8370275E64760D17'),
(71, 18, 'tv1do7re2ohrq4bkq3qh93793i', 5, 'Valentines Cake', 1, 300, '2024-05-30 15:54:11', 300, 'received', 'F3BC7B33E5185205'),
(72, 18, 'tv1do7re2ohrq4bkq3qh93793i', 6, 'Mini Cake', 1, 300, '2024-05-30 15:54:11', 300, 'received', '2219730EC64668AB'),
(73, 18, 'tv1do7re2ohrq4bkq3qh93793i', 7, 'Monogram Cake', 1, 300, '2024-05-30 15:54:12', 300, 'received', '00D4595C12F19877'),
(74, 17, 'tv1do7re2ohrq4bkq3qh93793i', 18, 'keyk', 1, 1200, '2024-05-30 09:57:29', 1200, 'pending', '696D31A39926A635'),
(75, 17, 'tv1do7re2ohrq4bkq3qh93793i', 2, 'Wedding Cake', 3, 300, '2024-05-30 09:57:51', 900, 'pending', '9FB494669A5A780B');

-- --------------------------------------------------------

--
-- Table structure for table `price`
--

CREATE TABLE `price` (
  `price_id` int(255) NOT NULL,
  `flavor_id` int(255) NOT NULL,
  `size_id` int(255) NOT NULL,
  `Price` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `price`
--

INSERT INTO `price` (`price_id`, `flavor_id`, `size_id`, `Price`) VALUES
(1, 1, 1, 300),
(2, 2, 1, 300),
(3, 3, 1, 300),
(4, 4, 1, 300);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `category_id` varchar(255) NOT NULL,
  `size_id` varchar(255) NOT NULL,
  `stock` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `Description`, `category_id`, `size_id`, `stock`, `price`, `status`, `product_image`) VALUES
(1, 'Birthday Cake', 'A delicious cake perfect for birthdays.', '1', 'S', '5', '300', 'A', '../assets/img/birthday-cake.png'),
(2, 'Wedding Cake', 'An elegant cake for weddings and special occasions', '1', 'S', '5', '300', 'A', '../assets/img/wedding-cake.png'),
(4, 'Celebration Cake', 'A festive cake for celebration and parties', '1', 'S', '5', '300', 'A', '../assets/img/popular-img1.png'),
(5, 'Valentines Cake', 'A special cake made with love for valentine\'s day.', '1', 'S', '5', '300', 'A', '../assets/img/valentine.png'),
(6, 'Mini Cake', 'Adorable mini cakes for individuals', '1', 'S', '5', '300', 'A', '../assets/img/popular-img2.png'),
(7, 'Monogram Cake', 'Personalize cake with monogram design', '1', 'S', '5', '300', 'A', '../assets/img/monogram.png'),
(8, 'Blueberry', 'A desser made with fresh soft cheese.', '1', 'S', '5', '300', 'A', '../assets/img/popular-img3.png'),
(9, 'Yema Cake', 'A classic yema flavored cake', '1', 'S', '5', '300', 'A', '../assets/img/slicecd.jpg'),
(10, 'Round Cake', 'A classic round mocha flavored cake', '1', 'S', '5', '300', 'A', '../assets/img/MOCHA.png'),
(18, 'keyk', 'asdasdfsdfs', '', '', '', '1200', '', '../uploads/admin_bkg.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `size_id` int(255) NOT NULL,
  `cake_size` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`size_id`, `cake_size`, `status`) VALUES
(1, 'standard', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `firstname`, `lastname`, `username`, `password`, `email`, `role`, `last_login`) VALUES
(11, 'mark angelo', 'antang', 'mark', '$2y$10$cxPzHig4gXuzInf4gXtDQuODEW4iNUZWTP2xyeORI/CLmR9Fhhfs6', 'markangeloabaigar.antang@bicol-u.edu.ph', 'user', NULL),
(12, 'mark angelo', 'antang', 'marco', '$2y$10$MLkzew7S4C.HizUKDy5VFO2cbEgObhmGujhOdSAF1BijxxINz42au', 'kram@gmail.com', 'user', '2024-05-30 23:38:32'),
(13, 'Girlie', 'Bo', 'Girlie', '$2y$10$F0HekhY0KrNxPkwoWY4zj.EPiiPXoaGBDyYYxHjjKZ5IvmdqpxpHC', 'girlie@gmail.com', 'user', NULL),
(14, 'Carl', 'Tolarba', 'Carl', '$2y$10$ByX0zcifiJu/WDN576jyU.XZVdeoa7UflQXXepW.yMGyKf9gvspeq', 'Carl@gmail.com', 'user', NULL),
(15, 'Ayessha', 'Agnes', 'ayessha', '$2y$10$QkiblwXY1ptko87wUrjp6egBEKfNsy3KKt3.nuJS8suWtbD5GSApG', 'Ayessha@gmail.com', 'user', NULL),
(16, 'Lance', 'Velasco', 'Lance', '$2y$10$K0BlOCB2h0I5gkHzKzycMuRxNboFRKkrpeVjMTit1C2y.Zd.UsVPm', 'Lance@gmail.com', 'user', NULL),
(17, 'Jirlie', 'Vo', 'jirliee', '$2y$10$MS0txWUzX.b/bHpUpNnCuu7/2MK2vg7UlSFBBne5ygjCnbYgZugou', 'girliebo@gmail.com', 'user', '2024-05-30 23:54:22'),
(18, 'JJ', 'Jo', 'jjo', '$2y$10$mV5TywDwTA4PG7pvMCo18O5oQp3syJTz2Ri7IGvDYhthabkXcUnV2', 'jjo@gmail.com', 'user', '2024-05-31 00:09:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `cake_ingredient`
--
ALTER TABLE `cake_ingredient`
  ADD PRIMARY KEY (`cake_ingredient_id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `flavors`
--
ALTER TABLE `flavors`
  ADD PRIMARY KEY (`Flavor_id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`ingredient_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `price`
--
ALTER TABLE `price`
  ADD PRIMARY KEY (`price_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`size_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `cake_ingredient`
--
ALTER TABLE `cake_ingredient`
  MODIFY `cake_ingredient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `flavors`
--
ALTER TABLE `flavors`
  MODIFY `Flavor_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `ingredient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `price`
--
ALTER TABLE `price`
  MODIFY `price_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `size`
--
ALTER TABLE `size`
  MODIFY `size_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
