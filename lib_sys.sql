-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2023 at 12:25 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lib_sys`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `isbn` varchar(255) NOT NULL,
  `library` enum('San Bartolome','San Francisco','Batasan') NOT NULL,
  `book_title` varchar(255) NOT NULL,
  `book_author` varchar(255) NOT NULL,
  `book_published` date NOT NULL,
  `book_category` varchar(255) NOT NULL,
  `book_image` varchar(255) NOT NULL,
  `book_stocks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `isbn`, `library`, `book_title`, `book_author`, `book_published`, `book_category`, `book_image`, `book_stocks`) VALUES
(4, '9780619035693', 'San Bartolome', 'C++ Programming: Program Design Including Data Structures - Softcover', 'Malik, D.S', '2002-04-11', 'Information Technology', '/images/books/4.jpg', 10),
(5, '9788120305960', 'San Bartolome', 'The C programming language/ Brian W.Kernighan and Dennis M. Ritchie', 'Kernighan, Brian W', '2009-01-01', 'Information Technology', '/images/books/5.jpg', 0),
(6, ' 9780789560995', 'Batasan', 'Java programming: complete concepts and techniques/ Gary B. Shelly, Thomas J. Cashman and Joy L. Starks', 'Shelly, Gary B', '2001-01-19', 'Information Technology', '/images/books/6.jpg', 4),
(7, '9780273779872', 'San Bartolome', 'C++ : How to program/ Paul Deitel and Harvey Deitel', 'Trajano, Emily F', '2013-01-01', 'Information Technology', '/images/books/7.jpg', 7),
(8, '9781423901969', 'San Bartolome', 'Programming logic and design: comprehensive/ Joyce Farrel', 'Farrel, Joyce', '2008-01-10', 'Information Technology', '/images/books/8.jpg', 6),
(9, '9780619215217', 'Batasan', 'Javascript / Don Gosselin', 'Gosselin, Don', '2004-03-01', 'Information Technology', '/images/books/9.jpg', 6),
(10, '9780072901689', 'San Francisco', 'Classical and object-oriented software engineering with UML and C++/ Stephen R. Schach', 'Stephen R Schach', '1998-01-01', 'Information Technology', '/images/books/10.gif', 4),
(11, '9780132350884', 'San Bartolome', 'Clean Code', 'Robert C. Martin', '2008-08-01', 'Information Technology', '/images/books/11.jpg', 4),
(12, '9780201616224', 'Batasan', 'The Pragmatic Programmer', 'Andrew Hunt and David Thomas', '1999-10-01', 'Information Technology', '/images/books/12.jpg', 0),
(13, '9780735619678', 'San Bartolome', 'Code Complete.', 'Steve McConnell', '1993-01-01', 'Information Technology', '/images/books/13.jpg', 19),
(15, '9780593715833', 'San Bartolome', 'The Diary Of A CEO', 'Steven Bartlett', '2023-01-01', 'Business/economics', '/images/books/15.png', 22),
(16, '9781983254806', 'Batasan', 'Your Next Five Moves', 'Patrick Bet-David', '2020-08-18', 'Business/economics', '/images/books/16.png', 14),
(17, '9781416534129', 'San Bartolome', 'How To Be Single', 'Liz Tuccillo', '2008-10-08', 'Relationship', '/images/books/17.jpg', 7),
(18, '9781797119731', 'San Bartolome', 'How To Not Die Alone', 'Logan Ury', '2021-02-02', 'Relationship', '/images/books/18.jpg', 0),
(19, '9780575001749', 'San Francisco', 'Freedom From The Known', 'Jiddu Krishnamurti', '1969-01-01', 'Philosophy', '/images/books/19.jpg', 14),
(20, '9789353577209', 'San Bartolome', 'The Big Question Of Life', 'Om Swami', '2021-12-10', 'Philosophy', '/images/books/20.jpg', 19),
(21, '9783442178582', 'Batasan', 'Atomic Habits', 'Clear, James', '2018-01-01', 'Productivity', '/images/books/21.jpg', 42),
(22, '9780062641540', 'San Francisco', 'The Subtle Art of Not Giving A F*ck', 'Mark Manson', '2016-09-13', 'Productivity', '/images/books/22.png', 69),
(24, '694206969696969', 'Batasan', 'Serge Edward: The Prodigy', 'Serge Edward Oliveros', '2023-12-18', 'Biography', 'images/books/BOOK_65801C2757E00.jpg', 69);

-- --------------------------------------------------------

--
-- Table structure for table `borrowed_books`
--

CREATE TABLE `borrowed_books` (
  `borrowed_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `borrower_id` int(11) NOT NULL,
  `reference_number` varchar(255) NOT NULL,
  `borrowed_date` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrowed_books`
--

INSERT INTO `borrowed_books` (`borrowed_id`, `book_id`, `borrower_id`, `reference_number`, `borrowed_date`) VALUES
(47, 21, 3, '5149138163', '2023-12-18'),
(48, 16, 3, '6591409230', '2023-12-18'),
(49, 10, 3, '5630864856', '2023-12-18'),
(50, 9, 3, '9300717275', '2023-12-18'),
(51, 8, 3, '9300717275', '2023-12-18'),
(52, 5, 3, '9300717275', '2023-12-18'),
(53, 10, 3, '6697545058', '2023-12-18');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `student_id` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `access` enum('student','librarian') NOT NULL DEFAULT 'student'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_id`, `first_name`, `last_name`, `email`, `password`, `access`) VALUES
(3, '23-2583', 'Mark Ian', 'Bustillo', 'bustillo.markian.buenavista@gmail.com', '$2y$10$0waJENJ3urt9TsdDj83HWOmPB3CeFqVMYo.ReOfZJB.4E5/sAgT4S', 'librarian'),
(4, 'asdas', 'dasdas', 'dasdas', 'bustillomarkian23@gmail.com', '$2y$10$Yq.jbVkBn04d3kaDKMjWeOSzuNrrNjAz2yHV38NbmIcI2iPlGBl0G', 'student'),
(5, '23-6969', 'Kaa', 'akssaksak', 'adrialsarmiento@gmail.com', '$2y$10$l8r0isfWSVF8ypCuyk55uuAXWGZkSlePeVlzfFmnPR2oJQk8kdDKq', 'librarian');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `borrowed_books`
--
ALTER TABLE `borrowed_books`
  ADD PRIMARY KEY (`borrowed_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`,`email`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `borrowed_books`
--
ALTER TABLE `borrowed_books`
  MODIFY `borrowed_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
