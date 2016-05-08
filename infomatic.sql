-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2016 at 03:01 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `infomatic`
--

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(20) NOT NULL,
  `title` varchar(60) NOT NULL,
  `news` text NOT NULL,
  `level` int(1) NOT NULL,
  `post_by` varchar(40) NOT NULL,
  `post_date` date NOT NULL,
  `enabled` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `news`, `level`, `post_by`, `post_date`, `enabled`) VALUES
(6, 'Undian MPP 2016', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. dsadasd', 1, 'Zaman AK', '2016-04-27', 1),
(7, 'Baihaqi hilang sejak semalam', 'Praesent in elementum nisi. Vivamus tempor laoreet egestas. Sed blandit, dolor eu faucibus maximus, magna tortor porta odio, nec luctus turpis tortor vitae nunc. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Integer eu mi lobortis, dictum risus ut, consequat urna. Integer consequat eros turpis, eget ornare tortor pellentesque quis. Nam vestibulum, urna sed pretium faucibus, nisi sem euismod mauris, sit amet elementum nibh felis id nulla.', 1, 'Zaman AK', '2016-04-28', 1),
(8, 'Seminat PHP Zero to Hero', 'Nulla risus ex, bibendum at porttitor in, ullamcorper blandit libero. Nam quis neque quis urna ultricies blandit vel ut erat. Quisque semper, risus vel dignissim consequat, urna massa hendrerit tellus, et venenatis nisi neque ut felis. Integer condimentum orci urna, tincidunt facilisis lacus aliquam vitae. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec imperdiet, metus sed aliquet placerat, risus nibh sagittis nibh, eu pellentesque orci arcu quis mauris. Aliquam laoreet, est ut vulputate pulvinar, eros velit laoreet massa, nec efficitur sapien elit eu tellus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean pulvinar maximus nibh tincidunt aliquam. Nunc et nisi congue erat cursus sagittis eu ac dui. Nam lacinia, magna a euismod congue, est nulla volutpat tortor, malesuada feugiat neque quam a turpis. Nulla nec eros pretium, tempor lectus eu, hendrerit lorem.', 2, 'Mohamad Zulfahmy', '2016-04-28', 1),
(9, 'Seminar Android', 'Cras iaculis pharetra maximus. Vivamus pulvinar erat accumsan nunc condimentum, eget aliquet tellus lobortis. Nam urna odio, blandit accumsan lectus scelerisque, sollicitudin auctor urna. Donec at libero at arcu sagittis vehicula. Nullam ornare scelerisque orci, sed consectetur nisi ullamcorper nec. Suspendisse dictum aliquet sagittis. Donec dictum urna elit, vel maximus nulla tristique et.', 3, 'Zaman AK', '2016-04-28', 1),
(10, 'Displin pelajar sekolah semakin merosot', 'orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 2, 'Mohamad Zulfahmy', '2016-04-28', 1),
(11, '21 orang pelajar ditahan ponteng', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purp', 1, 'Mohamad Zulfahmy', '2016-04-28', 1),
(12, 'pelajar makin kurang minat dal', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.\r\n\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 3, 'Mohamad Zulfahmy', '2016-04-28', 0),
(13, 'Mesyuarat agung PIBG', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn''t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 1, 'Mohamad Zulfahmy', '2016-04-28', 1),
(14, 'sekolah ditutup pada hari sela', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn''t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 3, 'Mohamad Zulfahmy', '2016-04-28', 0),
(15, 'semua pelajar diminta pergi ke', 'orem ipsum dolor sit amet, consectetur adipiscing elit. Donec sem mauris, feugiat sit amet rhoncus sit amet, efficitur porttitor ligula. Cras vitae bibendum odio. Praesent et felis volutpat, posuere purus vel, sagittis nulla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Cras rhoncus, nunc eget suscipit fermentum, sapien libero maximus sem, vitae fringilla tellus magna ut justo. Nulla mollis, ante non elementum euismod, sem mi rutrum erat, quis pellentesque arcu sapien at leo. Praesent enim erat, tempor non massa vel, molestie consequat justo. Aenean finibus felis ut neque faucibus lobortis. Duis egestas lacus sem, quis commodo odio placerat vitae. Phasellus eget hendrerit risus. Fusce imperdiet, nulla eu laoreet molestie, turpis justo convallis diam, sit amet condimentum purus metus in metus. Donec fermentum magna in tellus pulvinar facilisis. Proin a mattis nibh.', 3, 'Mohamad Zulfahmy', '2016-04-28', 0),
(16, 'semua pelajar dikehendaki mema', 'Vivamus consectetur elit ipsum. Pellentesque eros est, iaculis et blandit nec, bibendum ut lorem. Nulla posuere fermentum mi, eu sodales velit tincidunt vel. Donec nec sem bibendum, sodales sem at, vulputate metus. Quisque maximus sagittis tincidunt. Aenean at erat dignissim, efficitur nunc pretium, cursus mauris. Mauris laoreet et diam non semper. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam malesuada vulputate ipsum vel dictum. Phasellus consequat accumsan lacus nec bibendum. Vivamus at nulla diam. Morbi auctor mauris elit, a consequat lacus dapibus imperdiet. Vestibulum dictum, mauris id lacinia congue, justo nulla feugiat turpis, ut dapibus massa mauris sodales odio.', 3, 'Mohamad Zulfahmy', '2016-04-28', 0),
(17, 'Kolej ditutup 30/4/2016', 'Praesent in elementum nisi. Vivamus tempor laoreet egestas. Sed blandit, dolor eu faucibus maximus, magna tortor porta odio, nec luctus turpis tortor vitae nunc. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Integer eu mi lobortis, dictum risus ut, consequat urna. Integer consequat eros turpis, eget ornare tortor pellentesque quis. Nam vestibulum, urna sed pretium faucibus, nisi sem euismod mauris, sit amet elementum nibh felis id nulla.', 3, 'Mohamad Zulfahmy', '2016-04-28', 1),
(19, 'LAPAR TAHAP GABAN', 'asdasdsdsdas', 3, 'Zaman AK', '2016-04-29', 1),
(20, 'Hari ni present', 'LOrem ipsum', 2, 'Mohamad Zulfahmy', '2016-04-29', 1),
(21, 'zulfahmy', 'Nama saya  zulfahmy', 3, 'Mohamad Zulfahmy', '2016-04-29', 1),
(22, 'Mesyuarat Kaunseling', 'Mari datang beramai - ramai', 1, 'Zaman AK', '2016-04-29', 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(20) NOT NULL,
  `sitename` varchar(60) NOT NULL,
  `enabled` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `sitename`, `enabled`) VALUES
(1, 'Infomatic Board System', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(20) NOT NULL,
  `name` varchar(60) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` text NOT NULL,
  `level` int(11) NOT NULL,
  `enabled` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `password`, `email`, `level`, `enabled`) VALUES
(1, 'Mohamad Zulfahmy', 'zulfahmy', '81dc9bdb52d04dc20036dbd8313ed055', 'me@zulfahmy.net', 2, 1),
(3, 'Kamal Adli', 'kamal', '81dc9bdb52d04dc20036dbd8313ed055', 'admin@den.my', 2, 1),
(4, 'Zaman AK', 'zaman', '81dc9bdb52d04dc20036dbd8313ed055', 'zaman@zaman.com', 1, 1),
(5, 'zukiee', 'lejen45', '81dc9bdb52d04dc20036dbd8313ed055', 'zukiee_45@yahoo.com', 2, 0),
(6, 'aikaal', 'drak', '81dc9bdb52d04dc20036dbd8313ed055', 'drak_aikal95@gmail.com', 2, 0),
(7, 'nash', 'zimber', '81dc9bdb52d04dc20036dbd8313ed055', 'nashzimber@yahoo.com', 2, 0),
(8, 'zuhairah', 'loren', '81dc9bdb52d04dc20036dbd8313ed055', 'zu_lorea@net.com', 2, 1),
(9, 'umai', 'skittle', '827ccb0eea8a706c4c34a16891f84e7b', 'umai98@yahoo.my', 2, 1),
(10, 'nana', 'are', '827ccb0eea8a706c4c34a16891f84e7b', 'nana_re@net.com', 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
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
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
