-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2024 at 02:53 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book_records`
--

-- --------------------------------------------------------

--
-- Table structure for table `book_records`
--

CREATE TABLE `book_records` (
  `id` int(11) NOT NULL,
  `book_name` varchar(255) NOT NULL,
  `book_discription` varchar(255) NOT NULL,
  `ISBN` int(6) NOT NULL,
  `book_autor_id` int(11) DEFAULT NULL,
  `book_publisher_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_records`
--

INSERT INTO `book_records` (`id`, `book_name`, `book_discription`, `ISBN`, `book_autor_id`, `book_publisher_id`) VALUES
(44, 'Scarlett Guerrero', 'Dolor qui velit iust', 962525, 2, 5),
(45, 'Angela Hines', 'Excepturi sint saepe', 100362, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `phptest3_author`
--

CREATE TABLE `phptest3_author` (
  `author_id` int(11) NOT NULL,
  `author_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `phptest3_author`
--

INSERT INTO `phptest3_author` (`author_id`, `author_title`) VALUES
(1, 'Stephen King'),
(2, 'J.K. Rowling'),
(3, 'J.R.R Tolkien'),
(4, 'James Patterson'),
(5, 'William Shakespeare');

-- --------------------------------------------------------

--
-- Table structure for table `phptest3_publisher`
--

CREATE TABLE `phptest3_publisher` (
  `publisher_id` int(11) NOT NULL,
  `publisher_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `phptest3_publisher`
--

INSERT INTO `phptest3_publisher` (`publisher_id`, `publisher_title`) VALUES
(1, 'HarperCollins'),
(2, 'Macmillan Publishers'),
(3, 'Penguin Random House'),
(4, 'Simon and Schuster'),
(5, 'Hachette Book Group');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book_records`
--
ALTER TABLE `book_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_autor_id` (`book_autor_id`),
  ADD KEY `book_publisher_id` (`book_publisher_id`);

--
-- Indexes for table `phptest3_author`
--
ALTER TABLE `phptest3_author`
  ADD PRIMARY KEY (`author_id`);

--
-- Indexes for table `phptest3_publisher`
--
ALTER TABLE `phptest3_publisher`
  ADD PRIMARY KEY (`publisher_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book_records`
--
ALTER TABLE `book_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `phptest3_author`
--
ALTER TABLE `phptest3_author`
  MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `phptest3_publisher`
--
ALTER TABLE `phptest3_publisher`
  MODIFY `publisher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book_records`
--
ALTER TABLE `book_records`
  ADD CONSTRAINT `book_records_ibfk_1` FOREIGN KEY (`book_autor_id`) REFERENCES `phptest3_author` (`author_id`),
  ADD CONSTRAINT `book_records_ibfk_2` FOREIGN KEY (`book_publisher_id`) REFERENCES `phptest3_publisher` (`publisher_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
