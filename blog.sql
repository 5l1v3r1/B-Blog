-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 14, 2016 at 10:49 AM
-- Server version: 5.7.16-0ubuntu0.16.04.1
-- PHP Version: 5.6.27-1+deb.sury.org~xenial+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `POSTS`
--

CREATE TABLE `POSTS` (
  `ID` int(11) UNSIGNED NOT NULL,
  `TITLE` varchar(100) COLLATE utf8_bin NOT NULL,
  `STEXT` text COLLATE utf8_bin NOT NULL,
  `FTEXT` text COLLATE utf8_bin NOT NULL,
  `TYPE` tinyint(1) UNSIGNED ZEROFILL NOT NULL,
  `TIME` int(11) UNSIGNED NOT NULL,
  `POSTER` int(11) NOT NULL,
  `TAGS` text COLLATE utf8_bin NOT NULL,
  `LINK` varchar(30) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `POSTS`
--

INSERT INTO `POSTS` (`ID`, `TITLE`, `STEXT`, `FTEXT`, `TYPE`, `TIME`, `POSTER`, `TAGS`, `LINK`) VALUES
(1, 'پست آزمایشی', 'این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است ', 'این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است ', 1, 324121, 1, '', ''),
(2, 'لورم اپیسوم', 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.', 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.', 1, 324121, 1, '', ''),
(3, 'لورم اپیسوم کوتاه', 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای', 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای', 1, 324121, 1, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `USERS`
--

CREATE TABLE `USERS` (
  `ID` int(11) UNSIGNED ZEROFILL NOT NULL,
  `USER` varchar(24) COLLATE utf8_bin NOT NULL,
  `NAME` varchar(24) COLLATE utf8_bin NOT NULL,
  `PASS` char(32) COLLATE utf8_bin NOT NULL,
  `EMAIL` varchar(60) COLLATE utf8_bin NOT NULL,
  `GRP` tinyint(1) UNSIGNED ZEROFILL NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `USERS`
--

INSERT INTO `USERS` (`ID`, `USER`, `NAME`, `PASS`, `EMAIL`, `GRP`) VALUES
(00000000001, 'admin', 'امیرحسین حسین زاده', 'saoihaoihoih3oih2oi13h', 'contact@gmail.com', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `POSTS`
--
ALTER TABLE `POSTS`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `USERS`
--
ALTER TABLE `USERS`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `POSTS`
--
ALTER TABLE `POSTS`
  MODIFY `ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `USERS`
--
ALTER TABLE `USERS`
  MODIFY `ID` int(11) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
