-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: database:3306
-- Generation Time: Apr 17, 2022 at 02:43 AM
-- Server version: 8.0.28
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tournoi`
--

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--

CREATE TABLE `matches` (
  `id` int NOT NULL,
  `player1` int NOT NULL,
  `goal_player1` int NOT NULL DEFAULT '0',
  `player2` int NOT NULL,
  `goal_player2` int NOT NULL DEFAULT '0',
  `tournament_id` int NOT NULL,
  `isFinished` varchar(5) NOT NULL DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `matches`
--

INSERT INTO `matches` (`id`, `player1`, `goal_player1`, `player2`, `goal_player2`, `tournament_id`, `isFinished`) VALUES
(8, 0, 11, 3, 0, 12, 'true'),
(9, 1, 6, 0, 4, 12, 'true'),
(12, 1, 7, 3, 3, 14, 'true'),
(13, 0, 5, 1, 3, 14, 'false');

-- --------------------------------------------------------

--
-- Table structure for table `participant`
--

CREATE TABLE `participant` (
  `id` int NOT NULL,
  `tournament_id` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `participant`
--

INSERT INTO `participant` (`id`, `tournament_id`, `user_id`) VALUES
(20, 12, 0),
(22, 12, 3),
(25, 12, 1),
(29, 14, 0),
(30, 14, 1),
(31, 14, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tournament`
--

CREATE TABLE `tournament` (
  `id` int NOT NULL,
  `name` varchar(64) NOT NULL,
  `host` varchar(64) NOT NULL,
  `admissionPrice` varchar(64) NOT NULL,
  `isFinished` varchar(5) NOT NULL DEFAULT 'false',
  `winner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tournament`
--

INSERT INTO `tournament` (`id`, `name`, `host`, `admissionPrice`, `isFinished`, `winner`) VALUES
(12, 'tournament freestyle', 'professeurChen', '200', 'true', '1'),
(14, 'fullspeed tournament', 'professeurChen', '50', 'false', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `firstname` varchar(64) NOT NULL,
  `lastname` varchar(64) NOT NULL,
  `mail` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'user',
  `token` int NOT NULL DEFAULT '0',
  `timeRole` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `pseudo`, `firstname`, `lastname`, `mail`, `password`, `role`, `token`, `timeRole`) VALUES
(0, 'admin', 'admin', 'admin', 'admin@mail.com', '$2y$10$MTvZqFINYsMl6LdbBug1wOa.WTqdsMjLn6LcfRMTy9O13iJgCQPG6', 'admin', 0, '0'),
(1, 'pipouman', 'michel', 'cartier', 'michelcartier@gmail.com', '$2y$10$Etuav5dJh8/rnlc.tOjR8.q6aw9UUzuJ6zngCiju6ctVAm78ZzUYW', 'user', 500, '0'),
(2, 'professeurChen', 'corleone', 'freeze', 'freezy@gmail.com', '$2y$10$TLMIK8LR5RqpTV6KP6/6zOfd18uVov2iW7fVhyDgWsLIlLqssI0JO', 'host', 18700, '2022-05-17'),
(3, 'theo2008', 'theodore', 'blaireau', 'theo2008@gmail.com', '$2y$10$ZxaBb4EFObz9YYjVVYdWfuHo/CfeG1DeYUHJQ7Z1XUJ8nSCe9ACTa', 'user', 2000, '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `matches_ibfk_1` (`player1`),
  ADD KEY `matches_ibfk_2` (`player2`),
  ADD KEY `matches_ibfk_3` (`tournament_id`);

--
-- Indexes for table `participant`
--
ALTER TABLE `participant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tournament_id` (`tournament_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tournament`
--
ALTER TABLE `tournament`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `matches`
--
ALTER TABLE `matches`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `participant`
--
ALTER TABLE `participant`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tournament`
--
ALTER TABLE `tournament`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `matches`
--
ALTER TABLE `matches`
  ADD CONSTRAINT `matches_ibfk_1` FOREIGN KEY (`player1`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `matches_ibfk_2` FOREIGN KEY (`player2`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `matches_ibfk_3` FOREIGN KEY (`tournament_id`) REFERENCES `tournament` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `participant`
--
ALTER TABLE `participant`
  ADD CONSTRAINT `participant_ibfk_1` FOREIGN KEY (`tournament_id`) REFERENCES `tournament` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `participant_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
