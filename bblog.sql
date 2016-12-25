-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 25, 2016 at 11:54 PM
-- Server version: 5.7.16-0ubuntu0.16.04.1
-- PHP Version: 5.6.29-1+deb.sury.org~xenial+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bblog`
--

-- --------------------------------------------------------

--
-- Table structure for table `CATS`
--

CREATE TABLE `CATS` (
  `ID` int(10) UNSIGNED NOT NULL,
  `NAME` varchar(30) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `CATS`
--

INSERT INTO `CATS` (`ID`, `NAME`) VALUES
(0, 'دسته بندی نشده'),
(1, 'خبر'),
(2, 'آموزش'),
(3, 'برنامه نویسی'),
(4, 'طراحی وب'),
(5, 'لینوکس');

-- --------------------------------------------------------

--
-- Table structure for table `COMMENTS`
--

CREATE TABLE `COMMENTS` (
  `ID` int(10) UNSIGNED NOT NULL,
  `TYPE` tinyint(3) UNSIGNED NOT NULL DEFAULT '2',
  `SENDER` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `POST` int(10) UNSIGNED NOT NULL,
  `NAME` varchar(50) COLLATE utf8_bin NOT NULL,
  `EMAIL` varchar(60) COLLATE utf8_bin NOT NULL,
  `WEB` varchar(60) COLLATE utf8_bin NOT NULL,
  `TXT` text COLLATE utf8_bin NOT NULL,
  `TIME` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `COMMENTS`
--

INSERT INTO `COMMENTS` (`ID`, `TYPE`, `SENDER`, `POST`, `NAME`, `EMAIL`, `WEB`, `TXT`, `TIME`) VALUES
(13, 1, 0, 3, 'کاربر میهمان', 'guest@gmail.com', '', 'این دیدگاه آزمایشی است...', 1482697276),
(14, 1, 0, 3, 'یک کاربر دیگر', 'anotheruser@mail.com', 'http://google.com', 'تصور کنید این متن یک دیدگاه است...', 1482697318),
(15, 1, 1, 1, 'مدیر وبلاگ', 'contact@gmail.com', '', 'دیدگاهی از سمت مدیر وبلاگ', 1482697438),
(16, 1, 1, 5, 'مدیر وبلاگ', 'contact@gmail.com', '', 'دیدگاه آزمایشی', 1482697451);

-- --------------------------------------------------------

--
-- Table structure for table `POSTS`
--

CREATE TABLE `POSTS` (
  `ID` int(11) UNSIGNED NOT NULL,
  `TYPE` tinyint(1) UNSIGNED ZEROFILL NOT NULL,
  `AUTHOR` int(11) NOT NULL,
  `TITLE` varchar(255) COLLATE utf8_bin NOT NULL,
  `STEXT` text COLLATE utf8_bin NOT NULL,
  `FTEXT` text COLLATE utf8_bin NOT NULL,
  `CAT` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `TIME` int(11) UNSIGNED NOT NULL,
  `TAGS` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `POSTS`
--

INSERT INTO `POSTS` (`ID`, `TYPE`, `AUTHOR`, `TITLE`, `STEXT`, `FTEXT`, `CAT`, `TIME`, `TAGS`) VALUES
(1, 1, 1, 'پست آزمایشی', 'این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است ', 'این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است ', 0, 1482098755, 'پست+آزمایشی+محتوا'),
(2, 1, 1, 'لورم اپیسوم', 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.', 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.', 5, 1482068252, ''),
(3, 1, 1, 'لورم اپیسوم کوتاه', 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای', 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای', 0, 1482093306, ''),
(4, 3, 1, 'یک متن برای پیش نویس', 'این یک پیش نویس است این یک پیش نویس است این یک پیش نویس است این یک پیش نویس است این یک پیش نویس است این یک پیش نویس است این یک پیش نویس است ', '', 2, 1482098739, ''),
(5, 1, 1, 'پست آزمایشی', 'این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است ', 'این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است این یک پست آزمایشی است ', 0, 1482020020, 'پست+آزمایشی+محتوا'),
(6, 3, 1, 'پیش نویس', 'متن برای پیش نویس', '', 0, 1482098713, 'das');

-- --------------------------------------------------------

--
-- Table structure for table `USERS`
--

CREATE TABLE `USERS` (
  `ID` int(11) UNSIGNED NOT NULL,
  `USER` varchar(24) COLLATE utf8_bin NOT NULL,
  `NAME` varchar(24) COLLATE utf8_bin NOT NULL,
  `PASS` char(32) COLLATE utf8_bin NOT NULL,
  `EMAIL` varchar(60) COLLATE utf8_bin NOT NULL,
  `WEB` varchar(60) COLLATE utf8_bin NOT NULL,
  `GRP` tinyint(1) UNSIGNED ZEROFILL NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `USERS`
--

INSERT INTO `USERS` (`ID`, `USER`, `NAME`, `PASS`, `EMAIL`, `WEB`, `GRP`) VALUES
(0, 'GUEST', 'GUEST', 'GUEST', 'GUEST', '', 1),
(1, 'admin', 'مدیر وبلاگ', '5f673888779250d8d6140be27ce59a53', 'contact@gmail.com', '', 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `CATS`
--
ALTER TABLE `CATS`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `COMMENTS`
--
ALTER TABLE `COMMENTS`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `POSTS`
--
ALTER TABLE `POSTS`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `USERS`
--
ALTER TABLE `USERS`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `USER` (`USER`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `CATS`
--
ALTER TABLE `CATS`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `COMMENTS`
--
ALTER TABLE `COMMENTS`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `POSTS`
--
ALTER TABLE `POSTS`
  MODIFY `ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `USERS`
--
ALTER TABLE `USERS`
  MODIFY `ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
