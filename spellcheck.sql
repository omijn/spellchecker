-- phpMyAdmin SQL Dump
-- version 4.6.0
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 30, 2016 at 09:24 AM
-- Server version: 5.7.12
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spellcheck`
--

-- --------------------------------------------------------

--
-- Table structure for table `adjectives`
--

CREATE TABLE `adjectives` (
  `word` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adjectives`
--

INSERT INTO `adjectives` (`word`) VALUES
('absolute'),
('adventurous'),
('aggressive'),
('alive'),
('angry'),
('bad'),
('bland'),
('book'),
('bookish'),
('brown'),
('crazy'),
('dog'),
('easy'),
('green'),
('happy'),
('interesting'),
('laptop'),
('lazy'),
('lucky'),
('mad'),
('quick'),
('sad'),
('salty'),
('some'),
('sour'),
('sweet'),
('table');

-- --------------------------------------------------------

--
-- Table structure for table `adverbs`
--

CREATE TABLE `adverbs` (
  `word` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adverbs`
--

INSERT INTO `adverbs` (`word`) VALUES
('absolutely'),
('adventurously'),
('aggressively'),
('angrily'),
('bad'),
('badly'),
('blandly'),
('bookishly'),
('crazily'),
('crazy'),
('dog'),
('easily'),
('easy'),
('greenly'),
('happily'),
('here'),
('interestingly'),
('luckily'),
('madly'),
('sadly'),
('some'),
('somely'),
('sourly'),
('sweet'),
('sweetly'),
('there'),
('totally');

-- --------------------------------------------------------

--
-- Table structure for table `nouns`
--

CREATE TABLE `nouns` (
  `word` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nouns`
--

INSERT INTO `nouns` (`word`) VALUES
('arrow'),
('arrows'),
('bad'),
('bads'),
('boat'),
('boats'),
('book'),
('books'),
('breakfast'),
('brown'),
('browns'),
('burger'),
('burgers'),
('cat'),
('cats'),
('chair'),
('chairs'),
('cheap'),
('computer'),
('computers'),
('contribution'),
('contributions'),
('cookie'),
('cookies'),
('cow'),
('cows'),
('crayon'),
('crayons'),
('crazies'),
('crazy'),
('database'),
('databases'),
('dinner'),
('dog'),
('dogs'),
('drink'),
('drinks'),
('examination'),
('examinations'),
('failure'),
('failures'),
('food'),
('foot'),
('foots'),
('fox'),
('foxes'),
('game'),
('games'),
('glass'),
('glasses'),
('green'),
('greens'),
('hello'),
('house'),
('houses'),
('laptop'),
('laptops'),
('lemon'),
('lemons'),
('lion'),
('lions'),
('lunch'),
('mad'),
('man'),
('men'),
('mice'),
('mountain'),
('mountains'),
('mouse'),
('newspaper'),
('newspapers'),
('paper'),
('papers'),
('pen'),
('pencil'),
('pencils'),
('pens'),
('phone'),
('phones'),
('plant'),
('plants'),
('sandwich'),
('sandwiches'),
('side'),
('sides'),
('snack'),
('snacks'),
('sour'),
('sours'),
('stoic'),
('stoics'),
('sweet'),
('sweets'),
('table'),
('tables'),
('ticket'),
('tickets'),
('tiger'),
('tigers'),
('tree'),
('trees'),
('water'),
('woman'),
('women'),
('word'),
('words'),
('world'),
('worlds'),
('zipper'),
('zippers');

-- --------------------------------------------------------

--
-- Table structure for table `other`
--

CREATE TABLE `other` (
  `word` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `other`
--

INSERT INTO `other` (`word`) VALUES
('a'),
('about'),
('above'),
('around'),
('below'),
('down'),
('from'),
('her'),
('hers'),
('him'),
('his'),
('how'),
('I'),
('in'),
('inside'),
('it'),
('mine'),
('my'),
('of'),
('on'),
('other'),
('our'),
('ours'),
('out'),
('outside'),
('over'),
('she'),
('some'),
('the'),
('their'),
('theirs'),
('them'),
('to'),
('too'),
('up'),
('what'),
('when'),
('where'),
('which'),
('who'),
('why'),
('you'),
('your'),
('yours');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `email` varchar(40) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`email`, `password`) VALUES
('test@example.com', '5d41402abc4b2a76b9719d911017c592');

-- --------------------------------------------------------

--
-- Table structure for table `verbs`
--

CREATE TABLE `verbs` (
  `word` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `verbs`
--

INSERT INTO `verbs` (`word`) VALUES
('am'),
('are'),
('contribute'),
('contributes'),
('did'),
('do'),
('does'),
('drink'),
('drinks'),
('drive'),
('drives'),
('eat'),
('eats'),
('go'),
('goes'),
('going'),
('has'),
('have'),
('is'),
('jump'),
('jumps'),
('like'),
('likes'),
('make'),
('makes'),
('run'),
('runs'),
('see'),
('sees'),
('sleep'),
('sleeps'),
('walk'),
('walks'),
('want'),
('wants'),
('water'),
('went'),
('will');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adjectives`
--
ALTER TABLE `adjectives`
  ADD PRIMARY KEY (`word`);

--
-- Indexes for table `adverbs`
--
ALTER TABLE `adverbs`
  ADD PRIMARY KEY (`word`);

--
-- Indexes for table `nouns`
--
ALTER TABLE `nouns`
  ADD PRIMARY KEY (`word`);

--
-- Indexes for table `other`
--
ALTER TABLE `other`
  ADD PRIMARY KEY (`word`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `verbs`
--
ALTER TABLE `verbs`
  ADD PRIMARY KEY (`word`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
