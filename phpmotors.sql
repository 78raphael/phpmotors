-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 17, 2020 at 05:17 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpmotors`
--

-- --------------------------------------------------------

--
-- Table structure for table `carclassification`
--

CREATE TABLE `carclassification` (
  `classificationId` int(10) NOT NULL,
  `classificationName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carclassification`
--

INSERT INTO `carclassification` (`classificationId`, `classificationName`) VALUES
(1, 'SUV'),
(2, 'Classic'),
(3, 'Sports'),
(4, 'Trucks'),
(5, 'Used');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `clientId` int(10) UNSIGNED NOT NULL,
  `clientFirstname` varchar(15) NOT NULL,
  `clientLastname` varchar(25) NOT NULL,
  `clientEmail` varchar(40) NOT NULL,
  `clientPassword` varchar(255) NOT NULL,
  `clientLevel` enum('1','2','3') NOT NULL DEFAULT '1',
  `comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`clientId`, `clientFirstname`, `clientLastname`, `clientEmail`, `clientPassword`, `clientLevel`, `comment`) VALUES
(23, 'Basic', 'User', 'basic@user.com', '$2y$10$KBC4vmHbSv490dNnGPde1ugZQBIsDyUa9v/fA1aKHAFlQvNURrXIu', '1', NULL),
(24, 'Admin', 'User', 'admin@cit340.net', '$2y$10$nuBz7SFOQuXvbOmuI/xf4unX6mOMD2hTwW2V2BKSzcvOkl7WwB.TS', '3', NULL),
(25, 'Jay', 'Johnson', 'jay@email.com', '$2y$10$ehDXsmC/x9rP7Vz7LZ2LPOZMF/ks4mUUekF.Y0PEy2rAFYFE6DpYy', '1', NULL),
(27, 'Jay', 'Johnson', 'joh18157@gmail.com', '$2y$10$8iMVXtT9rjDEStSlIoIROevmUtsUU7EGE9GM3TN/8HJWuQ9XWD8IO', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `imgId` int(10) UNSIGNED NOT NULL,
  `invId` int(10) UNSIGNED NOT NULL,
  `imgName` varchar(100) CHARACTER SET latin1 NOT NULL,
  `imgPath` varchar(150) CHARACTER SET latin1 NOT NULL,
  `imgDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `imgPrimary` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`imgId`, `invId`, `imgName`, `imgPath`, `imgDate`, `imgPrimary`) VALUES
(17, 1, 'wrangler.jpg', '/phpmotors/images/vehicles/wrangler.jpg', '2020-11-29 05:51:46', 1),
(18, 1, 'wrangler-tn.jpg', '/phpmotors/images/vehicles/wrangler-tn.jpg', '2020-11-29 05:51:46', 1),
(19, 3, 'adventador.jpg', '/phpmotors/images/vehicles/adventador.jpg', '2020-11-29 05:52:27', 1),
(20, 3, 'adventador-tn.jpg', '/phpmotors/images/vehicles/adventador-tn.jpg', '2020-11-29 05:52:27', 1),
(21, 4, 'monster-truck.jpg', '/phpmotors/images/vehicles/monster-truck.jpg', '2020-11-29 05:52:53', 1),
(22, 4, 'monster-truck-tn.jpg', '/phpmotors/images/vehicles/monster-truck-tn.jpg', '2020-11-29 05:52:53', 1),
(23, 5, 'mechanic.jpg', '/phpmotors/images/vehicles/mechanic.jpg', '2020-11-29 05:53:05', 1),
(24, 5, 'mechanic-tn.jpg', '/phpmotors/images/vehicles/mechanic-tn.jpg', '2020-11-29 05:53:05', 1),
(25, 6, 'batmobile.jpg', '/phpmotors/images/vehicles/batmobile.jpg', '2020-11-29 05:54:16', 1),
(26, 6, 'batmobile-tn.jpg', '/phpmotors/images/vehicles/batmobile-tn.jpg', '2020-11-29 05:54:16', 1),
(27, 7, 'mystery-van.jpg', '/phpmotors/images/vehicles/mystery-van.jpg', '2020-11-29 05:55:39', 1),
(28, 7, 'mystery-van-tn.jpg', '/phpmotors/images/vehicles/mystery-van-tn.jpg', '2020-11-29 05:55:39', 1),
(29, 8, 'fire-truck.jpg', '/phpmotors/images/vehicles/fire-truck.jpg', '2020-11-29 05:57:16', 1),
(30, 8, 'fire-truck-tn.jpg', '/phpmotors/images/vehicles/fire-truck-tn.jpg', '2020-11-29 05:57:16', 1),
(31, 9, 'crwn-vic.jpg', '/phpmotors/images/vehicles/crwn-vic.jpg', '2020-11-29 05:57:31', 1),
(32, 9, 'crwn-vic-tn.jpg', '/phpmotors/images/vehicles/crwn-vic-tn.jpg', '2020-11-29 05:57:31', 1),
(33, 10, 'camaro.jpg', '/phpmotors/images/vehicles/camaro.jpg', '2020-11-29 05:57:44', 1),
(34, 10, 'camaro-tn.jpg', '/phpmotors/images/vehicles/camaro-tn.jpg', '2020-11-29 05:57:44', 1),
(35, 11, 'escalade.jpg', '/phpmotors/images/vehicles/escalade.jpg', '2020-11-29 05:58:15', 1),
(36, 11, 'escalade-tn.jpg', '/phpmotors/images/vehicles/escalade-tn.jpg', '2020-11-29 05:58:15', 1),
(37, 12, 'hummer.jpg', '/phpmotors/images/vehicles/hummer.jpg', '2020-11-29 05:58:43', 1),
(38, 12, 'hummer-tn.jpg', '/phpmotors/images/vehicles/hummer-tn.jpg', '2020-11-29 05:58:43', 1),
(39, 13, 'aerocar.jpg', '/phpmotors/images/vehicles/aerocar.jpg', '2020-11-29 05:59:00', 1),
(40, 13, 'aerocar-tn.jpg', '/phpmotors/images/vehicles/aerocar-tn.jpg', '2020-11-29 05:59:00', 1),
(41, 14, 'van.jpg', '/phpmotors/images/vehicles/van.jpg', '2020-11-29 05:59:21', 1),
(42, 14, 'van-tn.jpg', '/phpmotors/images/vehicles/van-tn.jpg', '2020-11-29 05:59:21', 1),
(43, 6, 'Batman.jpg', '/phpmotors/images/vehicles/Batman.jpg', '2020-11-29 20:57:35', 0),
(44, 6, 'Batman-tn.jpg', '/phpmotors/images/vehicles/Batman-tn.jpg', '2020-11-29 20:57:35', 0),
(45, 6, 'Vader_Thumbs_Up1.jpg', '/phpmotors/images/vehicles/Vader_Thumbs_Up1.jpg', '2020-11-30 19:53:35', 0),
(46, 6, 'Vader_Thumbs_Up1-tn.jpg', '/phpmotors/images/vehicles/Vader_Thumbs_Up1-tn.jpg', '2020-11-30 19:53:35', 0),
(47, 7, '8bit_mega_man.png', '/phpmotors/images/vehicles/8bit_mega_man.png', '2020-11-30 19:54:52', 0),
(48, 7, '8bit_mega_man-tn.png', '/phpmotors/images/vehicles/8bit_mega_man-tn.png', '2020-11-30 19:54:52', 0),
(51, 5, 'spiderman-Ohnos.jpeg', '/phpmotors/images/vehicles/spiderman-Ohnos.jpeg', '2020-12-01 05:35:42', 0),
(52, 5, 'spiderman-Ohnos-tn.jpeg', '/phpmotors/images/vehicles/spiderman-Ohnos-tn.jpeg', '2020-12-01 05:35:42', 0),
(53, 5, 'JayAvatar.png', '/phpmotors/images/vehicles/JayAvatar.png', '2020-12-01 05:36:32', 0),
(54, 5, 'JayAvatar-tn.png', '/phpmotors/images/vehicles/JayAvatar-tn.png', '2020-12-01 05:36:32', 0),
(61, 7, '1-up.png', '/phpmotors/images/vehicles/1-up.png', '2020-12-02 05:03:41', 0),
(62, 7, '1-up-tn.png', '/phpmotors/images/vehicles/1-up-tn.png', '2020-12-02 05:03:41', 0);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `invId` int(10) UNSIGNED NOT NULL,
  `invMake` varchar(30) NOT NULL,
  `invModel` varchar(30) NOT NULL,
  `invDescription` text DEFAULT NULL,
  `invImage` varchar(50) NOT NULL,
  `invThumbnail` varchar(50) NOT NULL,
  `invPrice` decimal(10,0) NOT NULL,
  `invStock` smallint(6) NOT NULL,
  `invColor` varchar(20) NOT NULL,
  `classificationId` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`invId`, `invMake`, `invModel`, `invDescription`, `invImage`, `invThumbnail`, `invPrice`, `invStock`, `invColor`, `classificationId`) VALUES
(1, 'Jeep ', 'Wrangler', 'The Jeep Wrangler is small and compact with enough power to get you where you want to go. Its great for everyday driving as well as offroading weather that be on the the rocks or in the mud!', '/phpmotors/images/vehicles/wrangler.jpg', '/phpmotors/images/vehicles/wrangler-tn.jpg', '28045', 4, 'Orange', 1),
(3, 'Lamborghini', 'Adventador', 'This V-12 engine packs a punch in this sporty car. Make sure you wear your seatbelt and obey all traffic laws. ', '/phpmotors/images/vehicles/adventador.jpg', '/phpmotors/images/vehicles/adventador-tn.jpg', '500000', 1, 'Black', 3),
(4, 'Monster', 'Truck', 'Most trucks are for working, this one is for fun. this beast comes with 60in tires giving you tracktions needed to jump and roll in the mud.', '/phpmotors/images/vehicles/monster-truck.jpg', '/phpmotors/images/vehicles/monster-truck-tn.jpg', '150000', 3, 'purple', 4),
(5, 'Mechanic', 'Special', 'Not sure where this car came from. however with a little tlc it will run as good a new.', '/phpmotors/images/vehicles/mechanic.jpg', '/phpmotors/images/vehicles/mechanic-tn.jpg', '100', 200, 'Rust', 5),
(6, 'Batmobile', 'Custom', 'Ever want to be a super hero? now you can with the batmobile. This car allows you to switch to bike mode allowing you to easily maneuver through trafic during rush hour.', '/phpmotors/images/vehicles/batmobile.jpg', '/phpmotors/images/vehicles/batmobile-tn.jpg', '65000', 2, 'Black', 3),
(7, 'Mystery', 'Machine', 'Scooby and the gang always found luck in solving their mysteries because of there 4 wheel drive Mystery Machine. This Van will help you do whatever job you are required to with a success rate of 100%.', '/phpmotors/images/vehicles/mystery-van.jpg', '/phpmotors/images/vehicles/mystery-van-tn.jpg', '10000', 12, 'Green', 1),
(8, 'Spartan', 'Fire Truck', 'Emergencies happen often. Be prepared with this Spartan fire truck. Comes complete with 1000 ft. of hose and a 1000 gallon tank.', '/phpmotors/images/vehicles/fire-truck.jpg', '/phpmotors/images/vehicles/fire-truck-tn.jpg', '50000', 2, 'Red', 4),
(9, 'Ford', 'Crown Victoria', 'After the police force updated their fleet these cars are now available to the public! These cars come equiped with the siren which is convenient for college students running late to class.', '/phpmotors/images/vehicles/crwn-vic.jpg', '/phpmotors/images/vehicles/crwn-vic-tn.jpg', '10000', 5, 'White', 5),
(10, 'Chevy', 'Camaro', 'If you want to look cool this is the ar you need! This car has great performance at an affordable price. Own it today!', '/phpmotors/images/vehicles/camaro.jpg', '/phpmotors/images/vehicles/camaro-tn.jpg', '25000', 10, 'Silver', 3),
(11, 'Cadilac', 'Escalade', 'This stylin car is great for any occasion from going to the beach to meeting the president. The luxurious inside makes this car a home away from home.', '/phpmotors/images/vehicles/escalade.jpg', '/phpmotors/images/vehicles/escalade-tn.jpg', '75195', 4, 'Black', 1),
(12, 'GM', 'Hummer', 'Do you have 6 kids and like to go offroading? The Hummer gives you the small interiors with an engine to get you out of any muddy or rocky situation.', '/phpmotors/images/vehicles/hummer.jpg', '/phpmotors/images/vehicles/hummer-tn.jpg', '58800', 5, 'Yellow', 5),
(13, 'Aerocar International', 'Aerocar', 'Are you sick of rushhour trafic? This car converts into an airplane to get you where you are going fast. Only 6 of these were made, get them while they last!', '/phpmotors/images/vehicles/aerocar.jpg', '/phpmotors/images/vehicles/aerocar-tn.jpg', '1000000', 6, 'Red', 2),
(14, 'FBI', 'Survalence Van', 'do you like police shows? You\'ll feel right at home driving this van, come complete with survalence equipments for and extra fee of $2,000 a month. ', '/phpmotors/images/vehicles/van.jpg', '/phpmotors/images/vehicles/van-tn.jpg', '20000', 1, 'Green', 1),
(27, 'Toyota', 'Hotdog Stand', 'testing enhancement 5', '/phpmotors/images/vehicles/no-image.png', '/phpmotors/images/vehicles/no-image-tn.png', '156', 1, 'Red', 4);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `reviewId` int(10) UNSIGNED NOT NULL,
  `reviewText` text CHARACTER SET latin1 NOT NULL,
  `reviewDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `invId` int(10) UNSIGNED NOT NULL,
  `clientId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`reviewId`, `reviewText`, `reviewDate`, `invId`, `clientId`) VALUES
(2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In congue consequat risus et maximus. Vestibulum ultrices a tortor in dapibus. Duis tellus risus, ornare vitae enim quis, imperdiet faucibus purus. Donec vel arcu sit amet turpis sagittis gravida a quis augue. Duis ac leo sed quam elementum eleifend eu in diam. Nam elementum semper turpis et vehicula. Pellentesque at consequat felis.', '2020-12-05 06:38:21', 6, 23),
(3, 'Add new review 1. Edited. Edited again. Na na na na na na. BAT-MAN!!', '2020-12-06 05:46:26', 6, 24),
(6, 'Dry clean only. No bleach. Tumble dry.', '2020-12-07 05:10:33', 10, 24),
(8, 'Review #1. Edited', '2020-12-09 02:08:45', 7, 24),
(9, 'This still works', '2020-12-09 04:56:12', 3, 24),
(10, 'The yellow is too yellow-y. Like a canary yellow. I was hoping for a banana yellow.', '2020-12-10 21:21:15', 1, 24),
(13, 'This is not a camaro', '2020-12-15 02:31:15', 3, 24),
(19, 'First', '2020-12-15 22:46:05', 9, 25),
(20, 'Too expensive for me. They should lower the price because I don&#39;t have any money', '2020-12-15 22:48:06', 12, 25),
(21, '&#34;What a piece of junk!!&#34;', '2020-12-16 16:35:50', 5, 24),
(22, 'ummm....it&#39;s a plane? i guess?????', '2020-12-16 16:36:25', 13, 24),
(23, 'Does it come in red??', '2020-12-16 16:36:50', 13, 25),
(24, 'I have this as a matchbox car', '2020-12-16 16:37:28', 3, 25),
(25, 'Batmobile lost a wheel and the Joker got a way. HEY!!', '2020-12-16 16:38:12', 6, 25),
(26, 'I saw 2 of these at the local starbucks this morning. That only tells me one thing: there are too many people with bloody MONEY!!!', '2020-12-16 16:39:09', 10, 25),
(27, 'Slightly better than spray painting &#34;Free Candy&#34; on the side.', '2020-12-16 16:39:35', 14, 25),
(28, 'VROOMM!!!!!!! CRUNCH!!!! SMASH!!!!', '2020-12-16 16:40:08', 4, 25);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carclassification`
--
ALTER TABLE `carclassification`
  ADD PRIMARY KEY (`classificationId`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`clientId`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`imgId`),
  ADD KEY `FK_inv_images` (`invId`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`invId`),
  ADD KEY `classificationId` (`classificationId`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`reviewId`),
  ADD KEY `FK_reviews_clients` (`clientId`),
  ADD KEY `FK_reviews_inventory` (`invId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carclassification`
--
ALTER TABLE `carclassification`
  MODIFY `classificationId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `clientId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `imgId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `invId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `reviewId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `FK_inv_images` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`classificationId`) REFERENCES `carclassification` (`classificationId`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `FK_reviews_clients` FOREIGN KEY (`clientId`) REFERENCES `clients` (`clientId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_reviews_inventory` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
