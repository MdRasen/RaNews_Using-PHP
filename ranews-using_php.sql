-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 18, 2023 at 02:01 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ranews-using_php`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `name_slug` varchar(191) NOT NULL,
  `short_desc` mediumtext,
  `sort` int NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=active; 1=disabled',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `name_slug`, `short_desc`, `sort`, `status`, `created_at`) VALUES
(25, 'অন্যান্য', 'অন্যান্য', NULL, 9999, 0, '2023-12-09 11:47:42'),
(26, 'সর্বশেষ', 'সর্বশেষ', '', 1, 0, '2023-12-09 11:47:42'),
(27, 'রাজনীতি', 'রাজনীতি', '', 2, 0, '2023-12-09 11:47:54'),
(28, 'বাংলাদেশ', 'বাংলাদেশ', '', 3, 0, '2023-12-09 11:48:14'),
(29, 'অপরাধ', 'অপরাধ', '', 4, 0, '2023-12-09 11:48:27'),
(30, 'বিশ্ব', 'বিশ্ব', '', 5, 1, '2023-12-09 11:48:37'),
(31, 'খেলা', 'খেলা', '', 6, 0, '2023-12-09 11:48:58'),
(32, 'বিনোদন', 'বিনোদন', '', 7, 0, '2023-12-09 11:49:03');

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` int NOT NULL,
  `image_src` varchar(191) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `image_src`, `created_at`) VALUES
(9, 'assets/admin/upload/images/1701973038.jpeg', '2023-12-08 00:17:18'),
(10, 'assets/admin/upload/images/1701973048.jpg', '2023-12-08 00:17:28'),
(11, 'assets/admin/upload/images/1701973052.jpg', '2023-12-08 00:17:32'),
(12, 'assets/admin/upload/images/1701973056.jpg', '2023-12-08 00:17:36'),
(13, 'assets/admin/upload/images/1701973061.jpg', '2023-12-08 00:17:41'),
(14, 'assets/admin/upload/images/1701973064.jpg', '2023-12-08 00:17:44');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int NOT NULL,
  `title` varchar(191) NOT NULL,
  `title_slug` varchar(191) NOT NULL,
  `image` varchar(191) DEFAULT NULL,
  `category_id` int NOT NULL,
  `description` longtext NOT NULL,
  `tags` mediumtext,
  `created_by_id` int NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=active; 1= disabled',
  `top_status` tinyint(1) NOT NULL DEFAULT '0',
  `total_views` int NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `title_slug`, `image`, `category_id`, `description`, `tags`, `created_by_id`, `status`, `top_status`, `total_views`, `updated_at`, `created_at`) VALUES
(18, 'বিদেশি শিক্ষার্থীদের দুঃসংবাদ দিল কানাডা, আগের চেয়ে ব্যাংকে দ্বিগুণ অর্থ দেখাতে হবে', 'বিদেশি-শিক্ষার্থীদের-দুঃসংবাদ-দিল-কানাডা-আগের-চেয়ে-ব্যাংকে-দ্বিগুণ-অর্থ-দেখাতে-হবে', 'assets/admin/upload/images/1702101102.jpg', 26, '<p style=\"font-family: Shurjo, SolaimanLipi, &quot;Siyam Rupali&quot;, Roboto, Arial, Helvetica, monospace; margin-right: 0px; margin-bottom: var(--space1_6); margin-left: 0px; padding: 0px; font-size: var(--fs-18); line-height: 1.7; white-space-collapse: break-spaces; color: rgb(18, 18, 18);\">বিদেশি শিক্ষার্থীদের আবেদনের খরচ বাড়িয়ে দ্বিগুণ করেছে কানাডার সরকার। দেশটির অভিবাসনবিষয়ক মন্ত্রী মার্ক মিলার সম্প্রতি এ ঘোষণা দিয়েছেন। ২০২৪ সালের ১ জানুয়ারি থেকে নতুন এ নিয়ম কার্যকর হবে।</p><p style=\"font-family: Shurjo, SolaimanLipi, &quot;Siyam Rupali&quot;, Roboto, Arial, Helvetica, monospace; margin-right: 0px; margin-bottom: var(--space1_6); margin-left: 0px; padding: 0px; font-size: var(--fs-18); line-height: 1.7; white-space-collapse: break-spaces; color: rgb(18, 18, 18);\"><br></p><p style=\"font-family: Shurjo, SolaimanLipi, &quot;Siyam Rupali&quot;, Roboto, Arial, Helvetica, monospace; margin-right: 0px; margin-bottom: var(--space1_6); margin-left: 0px; padding: 0px; font-size: var(--fs-18); line-height: 1.7; white-space-collapse: break-spaces; color: rgb(18, 18, 18);\">সিবিসির খবরে বলা হয়েছে, দুই দশক ধরে কানাডায় উচ্চশিক্ষা গ্রহণে আগ্রহী প্রত্যেক শিক্ষার্থীকে ব্যাংকে দেখাতে হতো যে তাঁর ১০ হাজার ডলার আছে। নতুন বছরে চালু হতে যাওয়া নিয়ম অনুসারে, এখন থেকে শিক্ষার্থীদের ব্যাংকে ২০ হাজার ৬৩৫ ডলার দেখাতে হবে। এ অর্থ শিক্ষার্থীদের কানাডায় জীবনযাপনের নিশ্চয়তার জন্য।</p>', 'কানাডা,শিক্ষা,বিদেশি,শিক্ষার্থী,উচ্চশিক্ষা', 67, 0, 0, 1230, '2023-12-09 11:51:42', '2023-12-09 11:51:42'),
(19, 'মুন্সিগঞ্জে বহুতল ভবনে বিস্ফোরণে এক পরিবারের ৪ জন দগ্ধ', 'মুন্সিগঞ্জে-বহুতল-ভবনে-বিস্ফোরণে-এক-পরিবারের-৪-জন-দগ্ধ', 'assets/admin/upload/images/1702101194.jpg', 26, '<p style=\"font-family: Shurjo, SolaimanLipi, &quot;Siyam Rupali&quot;, Roboto, Arial, Helvetica, monospace; margin-right: 0px; margin-bottom: var(--space1_6); margin-left: 0px; padding: 0px; font-size: var(--fs-18); line-height: 1.7; white-space-collapse: break-spaces; color: rgb(18, 18, 18);\">মুন্সিগঞ্জ শহরের ইদ্রাকপুর এলাকায় সদর উপজেলা পরিষদ-সংলগ্ন একটি আবাসিক ভবনের পঞ্চম তলায় বিস্ফোরণসহ অগ্নিকাণ্ডের ঘটনা ঘটেছে। এতে শিশু-নারীসহ একই পরিবারের চারজন দগ্ধ হয়েছেন। আজ শনিবার সকাল সাড়ে ছয়টার দিকে এ দুর্ঘটনা ঘটে।</p><p style=\"font-family: Shurjo, SolaimanLipi, &quot;Siyam Rupali&quot;, Roboto, Arial, Helvetica, monospace; margin-right: 0px; margin-bottom: var(--space1_6); margin-left: 0px; padding: 0px; font-size: var(--fs-18); line-height: 1.7; white-space-collapse: break-spaces; color: rgb(18, 18, 18);\"><br></p><p style=\"font-family: Shurjo, SolaimanLipi, &quot;Siyam Rupali&quot;, Roboto, Arial, Helvetica, monospace; margin-right: 0px; margin-bottom: var(--space1_6); margin-left: 0px; padding: 0px; font-size: var(--fs-18); line-height: 1.7; white-space-collapse: break-spaces; color: rgb(18, 18, 18);\">আহত ব্যক্তিরা হলেন মুন্সিগঞ্জ জেনারেল হাসপাতালের ওয়ান-স্টপ ক্রাইসিস সেলের কর্মকর্তা মো. রিজভী (৪৫), তাঁর মা শাহেদা বেগম (৬৫), আড়াই বছরের ছেলে মে. রাইয়ান ও স্ত্রী রোজী বেগম (৩০)। আহত চারজনকে রাজধানীর শেখ হাসিনা জাতীয় বার্ন ও প্লাস্টিক সার্জারি ইনস্টিটিউটে পাঠানো হয়েছে। তাঁরা ওই ভবনের পাঁচতলার ১২ নম্বর ফ্ল্যাটের ভাড়াটে ছিলেন।</p>', 'মুন্সিগঞ্জ,মুন্সিগঞ্জ সদর,ঢাকা বিভাগ,ভবন বিস্ফোরণ,অগ্নিকাণ্ড', 67, 0, 0, 3681, '2023-12-09 11:53:14', '2023-12-09 11:53:14'),
(20, 'সুইফটময় এক বছর', 'সুইফটময়-এক-বছর', 'assets/admin/upload/images/1702101626.jpg', 32, '<p>সুইফটের গানের সাংস্কৃতিক প্রভাব তো বটেই, আছে বিরাট অর্থনৈতিক প্রভাবও।</p><p> টাইম বলছে, বিনোদনকর্মী হিসেবে সুইফটের অবদানের জন্যই তাঁকে বর্ষসেরা ব্যক্তিত্বের খেতাব দিয়ে সম্মাননা জানানো হয়েছে। সাময়িকীটির প্রধান সম্পাদক স্যাক জ্যাকবস লিখিত বিবৃতিতে সুইফট সম্পর্কে বলেছেন, ‘টেলর সুইফট সীমানা পেরিয়ে যাওয়ার উপায় খুঁজে পেয়েছেন, পেরেছেন আলোর উৎস হতে...সুইফট এক বিরল ব্যক্তিত্ব, যিনি একই সঙ্গে নিজের গল্পের লেখক ও নায়ক।’ একই সঙ্গে বলা হয়েছে, এখন এই গ্রহের কেউ সুইফটের মতো করে এত মানুষকে নাড়িয়ে দিতে পারেন না।</p>', 'টেইলর সুইফ,টটাইম সাময়িকী,সংগীত শিল্পী', 67, 0, 0, 8560, '2023-12-16 18:48:15', '2023-12-09 12:00:26'),
(21, 'অনেক মানুষের দেওয়া অকারণ অপমান হজম করেছি: প্রভা', 'অনেক-মানুষের-দেওয়া-অকারণ-অপমান-হজম-করেছি-প্রভা', 'assets/admin/upload/images/1702101770.jpg', 32, '<p>আলহামদুলিল্লাহ। আমার শুটিং খুব ভালো হয়েছে। আমি এখন একসঙ্গে দু–তিনটি কাজ করি। এরপর চার–পাঁচ মাস বিরতি নিই। আমি এখন কোথাও বেড়াতে যাওয়ার আগে দু–তিনটি ভালো কাজ করি। এদিকে আবার মানহীন কাজ করলে নিজের সঙ্গে নিজেরও পোষায় না। অভিনয়ের জন্য অনেক স্ক্রিপ্টই তো আসে, কিন্তু অনেক সময় নিজের সঙ্গে আপস করতে পারি না। এরপরও যাচাই–বাছাই শেষে কোথাও ঘুরতে যাওয়ার আগে মনে হয় যে এবার আমার কাজ করতে হবে।</p><p>আমি তো অভিনয় ছাড়া কোনো কাজ শিখিনি। ঘুরতে যাওয়ার আগে তো টাকা লাগে। নিজের টাকায় ঘোরাঘুরির আনন্দটাই অন্য রকম। (হাসি) তাই দু–তিনটি কাজ করলেই একটা ভালো ট্যুর দেওয়া যায়। ভালো তো এটা।<br></p><p><br></p>', 'সাদিয়া জাহান প্রভা,অভিনয় শিল্পী,খবর,তারকার ভ্রমণ,তারকা', 67, 0, 1, 7860, '2023-12-16 18:48:08', '2023-12-09 12:02:50'),
(22, 'ঢাকায় শুরু হয়েছে ‘আমার শহর, আমার খাবার’ প্রদর্শনী', 'ঢাকায়-শুরু-হয়েছে-আমার-শহর-আমার-খাবার-প্রদর্শনী', 'assets/admin/upload/images/1702101870.jpg', 26, '<p>ঢাকায় শুরু হয়েছে ‘আমার শহর, আমার খাবার’ প্রদর্শনী। আজ শুক্রবার বাংলা একাডেমির নভেরা গ্যালারিতে এ প্রদর্শনীর উদ্বোধন করা হয়। ১৬ ডিসেম্বর পর্যন্ত প্রদর্শনীটি ঘুরে দেখতে পারবেন সর্বস্তরের মানুষ।</p><p>প্রদর্শনীটি আয়োজনে সহযোগিতা করেছে জাতিসংঘের খাদ্য ও কৃষি সংস্থা (এফএও) এবং স্থানীয় সরকার, পল্লী উন্নয়ন ও সমবায় মন্ত্রণালয়। ঢাকা বিভাগের চার সিটি করপোরেশনে (ঢাকা উত্তর, ঢাকা দক্ষিণ, গাজীপুর ও নারায়ণগঞ্জ) নগর খাদ্যব্যবস্থায় সমাজের সব স্তরের মানুষের অন্তর্ভুক্তি, অভিঘাত সামলে নেওয়ার সক্ষমতা বৃদ্ধি এবং এই ব্যবস্থাকে টেকসই রূপ দেওয়ার লক্ষ্য নিয়ে এ প্রদর্শনীর আয়োজন করা হয়েছে।</p>', 'রাজধানী,ঢাকা,খাবার দাবার,বর্ণিল খাবার,দেশি খাবার,খাবার প্রদর্শনী', 67, 0, 1, 5630, '2023-12-16 18:47:11', '2023-12-09 12:04:30'),
(23, 'ঢাকায় ৫৫ মামলায় বিএনপির ৮৪৫ নেতা-কর্মীর সাজা', 'ঢাকায়-৫৫-মামলায়-বিএনপির-৮৪৫-নেতা-কর্মীর-সাজা', 'assets/admin/upload/images/1702102530.jpg', 27, '<p>ঢাকায় সাম্প্রতিক কালে অন্তত ৫৫টি মামলায় বিএনপি এবং দলের অঙ্গ ও সহযোগী সংগঠনের ৮৪৫ নেতা-কর্মীর কারাদণ্ড হয়েছে। এর মধ্যে শুধু গত নভেম্বরেই ৩৩টি মামলায় অন্তত ৬১৫ জনের সাজা হয়।</p><p>বিএনপির নেতা-কর্মীদের বিরুদ্ধে মামলাগুলোয় সাজা হচ্ছে দ্বাদশ জাতীয় সংসদ নির্বাচনের আগে। এসব মামলার বেশির ভাগ ২০১৩ ও ২০১৮ সালে করা।</p><p>আদালত-সংশ্লিষ্ট সূত্র ও আইনজীবীদের তথ্য অনুযায়ী, ঢাকার আদালতে আগস্ট মাসে ৩টি, অক্টোবরে ৬টি, নভেম্বরে ৩৩টি এবং ডিসেম্বরের প্রথম ৭ দিনে ১৩টি মামলায় বিএনপির নেতা-কর্মীদের সাজার তথ্য পাওয়া যায়। সেপ্টেম্বরে কোনো মামলায় সাজার খবর পাওয়া যায়নি। উল্লেখ্য, এটা শুধু তথ্য পাওয়া মামলার হিসাব।</p>', 'বিএনপি,বিএনপির নেতা-কর্মী', 67, 0, 0, 5690, '2023-12-16 18:48:02', '2023-12-09 12:15:30'),
(24, 'ছিলেন পৌর সচিব, এখন বিপুল সম্পদের মালিক', 'ছিলেন-পৌর-সচিব-এখন-বিপুল-সম্পদের-মালিক', 'assets/admin/upload/images/1702102621.jpg', 25, '<p>যশোর জেলার শার্শা উপজেলার বেনাপোল পৌরসভার সচিব ছিলেন রফিকুল ইসলাম। চাকরিকালে ব্যাপক অনিয়ম-দুর্নীতির মাধ্যমে তিনি বিপুল সম্পদের মালিক হয়েছেন বলে অভিযোগ রয়েছে।</p><p>রফিকুলের বিরুদ্ধে শতকোটি টাকার অবৈধ সম্পদ অর্জনের একটি অভিযোগ দুর্নীতি দমন কমিশন (দুদক) অনুসন্ধান করছে বলে সূত্র প্রথম আলোকে নিশ্চিত করেছে।</p><p>অনুসন্ধানে জানা গেছে, ‘রাইসা বিল্ডার্স’ নামের একটি নির্মাণপ্রতিষ্ঠানের পরিচালক পদে আছেন রফিকুল। প্রতিষ্ঠানটির স্বত্বাধিকারী তাঁর স্ত্রী ইসরাত জাহান। রফিকুল পৌর সচিব থাকাকালে প্রতিষ্ঠানটি চালু করা হয়।</p><p>রাইসা বিল্ডার্স রাজধানীর মিরপুরের পীরেরবাগে একটি ১০ তলা (আবাসিক-বাণিজ্যিক) ও একটি ৯ তলা ভবন (আবাসিক) নির্মাণ করেছে। পীরেরবাগে প্রতিষ্ঠানটির আরেকটি ১০ তলা আবাসিক ভবন নির্মাণাধীন। এসব ভবন নির্মাণের ক্ষেত্রে কোথাও থেকে ঋণ নিতে হয়নি বলে রফিকুল নিজেই প্রথম আলোর কাছে স্বীকার করেছেন।</p>', 'অনুসন্ধান,রাইসা বিল্ডার্স,অবৈধ সম্পদ', 67, 0, 0, 78, '2023-12-17 20:04:47', '2023-12-07 12:17:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=user; 1=admin',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=active; 1=banned',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `image`, `password`, `type`, `status`, `created_at`) VALUES
(46, 'user', 'user@gmail.com', '01234567890', 'assets/admin/upload/images/1701279393.jpg', '$2y$10$ToHvuSerG/eAR9YYuVfKu.dduwZVO/5nBQAZK0ySXgeJ4rX5UDI9e', 0, 0, '2023-11-28 14:04:10'),
(47, 'User1', 'user1@gmail.com', '876867868768', 'assets/admin/upload/images/1701279411.jpg', '$2y$10$x6clthTB5Dtkltp0k9KrbuYRo.RkANbMLhvHSCBSqu4bWTlqpEtzC', 0, 0, '2023-11-28 14:04:19'),
(60, 'devRasen', 'aamin.hossegseggn99@gmail.com', '64644648412', 'assets/admin/upload/images/1701279429.jpg', '$2y$10$ZARGGoXFjqPkS9JOzq5mseTUE40LHZO0nxAuUHzR/9yhBCos//BW2', 0, 1, '2023-11-29 16:47:13'),
(66, 'user2', 'user222@gmail.comm', '', 'assets/admin/upload/images/1701276083.jpg', '$2y$10$r9Uf5Ub/yM8m86EcIOJ2NOqYYlowe.1nw6fVZX4PXnZTFo.bbbeAC', 0, 1, '2023-11-29 21:20:26'),
(67, 'Mohammad Rasen', 'aamin.hossen99@gmail.com', '1234567890', 'assets/admin/upload/images/1702734656.jpg', '$2y$10$9FyNMQNmqP8kP7TiVxiFe.BQsp1lZtK/P5CNpmtqIcsU6kygE6GIy', 1, 0, '2023-11-30 00:04:37'),
(69, 'Demo User', 'demouser@gmail.com', '', NULL, '$2y$10$6r5X/wxkMWQ0IGntoK0jEeeNaFUEqlWkk2sjIjNGOwGwQ.nZwzJte', 0, 1, '2023-12-04 21:59:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
