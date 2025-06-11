-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2025 at 01:08 PM
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
-- Database: `movie_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `favourite_movies`
--

CREATE TABLE `favourite_movies` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `movie_id` int(11) DEFAULT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `favourite_movies`
--

INSERT INTO `favourite_movies` (`id`, `user_id`, `movie_id`, `added_at`) VALUES
(1, 7, 6, '2025-05-31 09:58:24'),
(2, 7, 12, '2025-05-31 14:09:24'),
(3, 9, 3, '2025-06-02 15:58:55'),
(4, 7, 3, '2025-06-02 16:47:31');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `genre` varchar(50) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image_url` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `title`, `genre`, `year`, `description`, `image_url`, `created_at`) VALUES
(3, 'Interstellar', 'Sci-Fi', 2014, 'A team travels through a wormhole in space.', 'https://m.media-amazon.com/images/I/91vIHsL-zjL.jpg', '2025-05-29 11:14:09'),
(4, 'The Dark Knight', 'Action', 2008, 'Batman faces Joker in Gotham.', 'https://musicart.xboxlive.com/7/abb02f00-0000-0000-0000-000000000002/504/image.jpg', '2025-05-29 11:14:09'),
(5, 'The Matrix', 'Sci-Fi', 1999, 'A hacker discovers the truth of his reality.', 'https://m.media-amazon.com/images/I/51EG732BV3L._AC_.jpg', '2025-05-29 11:14:09'),
(6, 'Forrest Gump', 'Drama', 1994, 'The life journey of a simple man.', 'https://m.media-amazon.com/images/I/91++WV6FP4L._AC_UF1000,1000_QL80_.jpg', '2025-05-29 11:14:09'),
(7, 'Inception', 'Action', 2010, 'A thief who steals secrets through dreams.', 'https://m.media-amazon.com/images/I/81p+xe8cbnL._AC_SY679_.jpg', '2025-05-29 11:14:09'),
(8, 'Spider-Man: No Way Home', 'Action', 2021, 'Peter Parker faces multiverse villains.', 'https://m.media-amazon.com/images/I/71niXI3lxlL._AC_SY679_.jpg', '2025-05-29 11:14:09'),
(9, 'The Hangover', 'Comedy', 2009, 'A group wakes up after a wild night.', 'https://m.media-amazon.com/images/M/MV5BMTM2MTM4MzY2OV5BMl5BanBnXkFtZTcwNjQ3NzI4NA@@._V1_.jpg', '2025-05-29 11:14:09'),
(10, 'The Conjuring', 'Horror', 2013, 'Paranormal investigators help a family.', 'https://m.media-amazon.com/images/I/5147F62RsML._AC_UF894,1000_QL80_.jpg', '2025-05-29 11:14:09'),
(11, 'Gladiator', 'Action', 2000, 'A Roman general seeks revenge.', 'https://m.media-amazon.com/images/I/912Ht9rUWWS.jpg', '2025-05-29 11:14:09'),
(12, 'Dune', 'Sci-Fi', 2021, 'A noble family becomes entangled in war over a planet.', 'https://sm.ign.com/ign_ap/cover/d/dune-2021/dune-2021_1pb8.jpg', '2025-05-29 11:14:09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`) VALUES
(7, 'lana', '$2y$10$NSeYh5odMWNhf0tj.LFt4u.23EGjJk/BQd42g9YQuCdQztXjB5sH6', 'lana@gmail.com', 'user'),
(8, 'Hala', '$2y$10$9VBcCiZla4VIrL5wEzirhuTBsD0I4uL9JNC6BInFUvYnllB319A4.', 'hala@gmail.com', 'admin'),
(9, 'sarah', '$2y$10$T8luMorpVMvyMienBZVJQu8VreFURNQ.3PKy1zMzpw2SPi9lTjWLq', 'sarah@gmail.com', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `favourite_movies`
--
ALTER TABLE `favourite_movies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `favourite_movies`
--
ALTER TABLE `favourite_movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `favourite_movies`
--
ALTER TABLE `favourite_movies`
  ADD CONSTRAINT `favourite_movies_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `favourite_movies_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
