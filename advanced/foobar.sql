-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- 主機: 127.0.0.1
-- 產生時間： 2016-09-08 09:00:52
-- 伺服器版本: 5.7.11
-- PHP 版本： 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `foobar`
--

-- --------------------------------------------------------

--
-- 資料表結構 `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `group` varchar(45) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `password_hash` varchar(255) NOT NULL,
  `auth_key` varchar(255) NOT NULL,
  `created_at` int(8) NOT NULL,
  `updated_at` int(8) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `group`, `status`, `password_hash`, `auth_key`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@foobar.com', NULL, 1, '$2y$13$x1ZPZ0Rsxf65yss1UgnbGuhvlwnJ3X5SdRLfH0M6RKgJbbXT54nD6', 'HTkqbfoAFQifubcs10i-ck6i1S8M2UMt', 1473320063, 1473320063),
(2, 'student', 'student@foobar.com', NULL, 1, '$2y$13$QJo09GNHZDazMD2nQj2MneeUenZ3aU.ZRmbmrGmYGmOOCx8m0wDcq', 'jGmm14JiU0yD_FZxgVRt2ykuJqD6VLZs', 1473322195, 1473322195),
(6, 'student1', 'student1@foobar.com', NULL, 1, '$2y$13$kQbBf2kmwv8WXClHK2dVwOEE8z8OCLST65iU1oxyMXr3YIqMq2agy', 'MNv_WYwaJlbVTXvQOA-nUmYOkMhHS6m6', 1473323923, 1473323923),
(7, 'vol1', 'asdnjn@jasnd.com', NULL, 1, '$2y$13$wvn.MusH3pw6cdhvjmfg7.rcjvMR7I0oMwn81r/zEwc3.szHD3b66', 'CqNihRIlDEFVtlpVfi6joRPOi3G4DB69', 1473324512, 1473324512);

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
