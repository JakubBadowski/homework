-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas generowania: 14 Wrz 2016, 18:27
-- Wersja serwera: 5.7.15-0ubuntu0.16.04.1
-- Wersja PHP: 7.0.8-0ubuntu0.16.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `homework`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `task`
--

INSERT INTO `task` (`id`, `name`) VALUES
(1, 'Task 1'),
(2, 'Task 2'),
(3, 'Task 3'),
(4, 'Task 4'),
(5, 'Task 5'),
(6, 'Task 6'),
(7, 'Task 7'),
(8, 'Task 8'),
(9, 'Task 9'),
(10, 'Task 10'),
(11, 'Task 11'),
(12, 'Task 12'),
(13, 'Task 13'),
(14, 'Task 14'),
(15, 'Task 15');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`id`, `name`) VALUES
(1, 'User 1'),
(2, 'User 2'),
(3, 'User 3');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user_task`
--

CREATE TABLE `user_task` (
  `user_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_task`
--
ALTER TABLE `user_task`
  ADD UNIQUE KEY `task_id` (`task_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT dla tabeli `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
