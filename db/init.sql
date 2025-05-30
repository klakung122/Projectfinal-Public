-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2025 at 12:06 PM
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
-- Database: `projectfinal`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `like`
--

CREATE TABLE `like` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `like`
--

INSERT INTO `like` (`id`, `user_id`, `product_id`) VALUES
(18, 1, 4),
(19, 1, 25),
(20, 1, 3),
(21, 1, 13),
(22, 1, 6),
(23, 1, 1),
(24, 1, 7),
(25, 1, 11),
(26, 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `profile_image2` varchar(255) DEFAULT NULL,
  `profile_image3` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `description` text NOT NULL,
  `garage` tinyint(1) NOT NULL DEFAULT 0,
  `pet` tinyint(1) NOT NULL DEFAULT 0,
  `tel` varchar(30) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT 0,
  `ads` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `price`, `profile_image`, `profile_image2`, `profile_image3`, `address`, `description`, `garage`, `pet`, `tel`, `user_id`, `approved`, `ads`, `created_at`, `updated_at`) VALUES
(1, 'เอ็มบี เวลธี โฮม (MB wealthy home)', 6500.00, '1LJNH2Du86ZpHJawQvMr.jpg', 'Vgk276mWN4bCmbF3W6Su.jpg', '84416MJNVefoG25K4L3C.jpg', 'อำเภอเมือง/ตลาดใหญ่', 'อพาร์ทเม้นท์ใน อ.ถลาง จ.ภูเก็ต อยู่ใกล้ศูนย์การค้า โลตัส แม็คโคร ส่วนราชการ บรรยกาศธรรมชาติ คมนาคมสะดวก ไม่ไกลจากสนามบินภูเก็ต สถานที่ท่องเที่ยว เช่น ชายหาด น้ำตกโตนไทร', 1, 1, '0831822xxx', 1, 1, 0, '2024-11-12 15:05:32', '2024-11-21 08:38:55'),
(2, 'บ้านร่มเย็น', 35000.00, 'dwNujLV3LAM6eU6CNFHZ.jpg', 'wDxSCmpHqPhQHqwFeG5f.jpg', 'DZzxAHRMC1m1y2bng91y.jpg', 'อำเภอกะทู้/กะทู้', 'แต่ละห้องมีโทรทัศน์จอแบนระบบช่องสัญญาณเคเบิลตู้เซฟอิเล็กทรอนิกส์  ห้องน้ำในตัวมีฝักบัวอาบน้ำ    บริการอินเทอร์เน็ตไร้สาย (Wi-Fi) ความเร็วสูงฟรีตลอด    มีแผนกต้อนรับส่วนหน้า (จนถึง 23.00 น.)    บริเวณใกล้เคียง ได้แก่ ย่านธุรกิจย่านการค้าและตลาดท้องถิ่น    โรงแรมไอเช็คอิน ดาริสา ป่าตอง มีห้องพักจำนวน 54 ห้องพร้อมเข้าอยู่    ห้องซูพีเรียร์ ขนาด 16 ตารางเมตร    ห้องดีลักซ์ ขนาด 21 ตารางเมตร    ห้องดีลักซ์ขนาด 28 ตารางเมตร (มีห้องนั่งเล่นแยกต่างหาก)', 1, 1, '0618687xxx', 1, 1, 0, '2024-11-12 15:07:02', '2024-11-24 15:34:29'),
(3, 'ซีทู กะทู้', 13500.00, 'QMX8HtFYdHffiPVxtyo7.jpg', 'fA4e3rvBUMQZ5scHRZqW.jpg', 'uxmYF7TcpHYVUjGYB3iV.jpg', 'อำเภอกะทู้/ป่าตอง', '-สัญญาขั้นต่ำ 1 เดือน  -มีบริการลิฟต์ สระว่ายน้ำ  -มีที่จอดรถยนต์  x ห้ามเลี้ยงสัตว์  ซีทู กะทู้ - C2 Kathu  Tel. 081-370-3355', 0, 0, '0813703xxx', 1, 1, 1, '2024-11-12 15:08:14', '2024-11-20 11:34:34'),
(4, 'เพชรรัตน์แมนชั่น', 5000.00, 'iifpVXNVhhUDvKYpWDEr.jpg', 'WHZ9PmU1gVuNuTrA2J1V.jpg', 'b7Y7DraMJo5jjVXeeMsr.jpg', 'อำเภอเมือง/ตลาดเหนือ', 'มีระเบียงทุกห้อง  มีทั้งเตียงเดี่ยวและเตียงคู่  พร้อมระบบดับเพลิงและเครื่องเตือนควันไฟภายในห้องทุกห้อง  รีโมทที่จอดรถได้20คัน', 0, 0, '0619261xxx', 2, 1, 1, '2024-11-12 15:09:36', '2024-11-20 11:33:31'),
(5, 'เดอะ เบดรูม กะตะ ภูเก็ต', 35000.00, 'ix2BwhZvpzMXLDRFaZJd.jpg', 'Ube65q3mBUq8JMciyfB2.jpg', 'FkEF4ZYLenGRTat9J1Et.jpg', 'อำเภอเมือง/กะรน', 'ข้อมูลเพิ่มเติม เดอะ เบดรูม กะตะ ภูเก็ต ที่พักหาดกะตะภูเก็ต อยู่ใกล้ชายหาด เดินจากที่พักไปแค่ 230 เมตรอยู่ในย่านใจกลางนักท่องเที่ยว ร้านอาหารหากินสะดวก  โทร 085 289 0000 Line id : baangu', 1, 1, '085 289 0000', 1, 1, 0, '2025-01-08 10:50:16', '2025-01-08 10:56:30'),
(6, 'เดอะเบดรูมในหานบีช อพาร์ทเม้นต์', 19000.00, 'ZCArUYJjEGPes2rfyGQ5.jpg', 's8Fjb3g1YwjvxagzkBh4.jpg', 'tENwuqjkeDVKvFBwQv1g.jpg', 'อำเภอเมือง/ราไวย์', 'ห้องพัก รายเดือน ให้เช่า พร้อมเฟอร์นิเจอร์ รายเดือน ในย่านนักท่องเที่ยว ใสยวน ภูเก็ต ที่พักใกล้หาดราไวย์ ห้องพักใกล้หาดในหานภูเก็ต ห้องพักสะอาด มีสระว่ายน้ำในบริเวณที่พัก เดินทางสะดวกในแหล่งช็อปปิ้ง ร้านอาหาร ร้านสะดวกซื้อ ย่านนักท่องเที่ยว สนใจห้องพักรายเดือน ติดต่อโทร 085 289 0000 Line ID : baangu', 1, 0, '085 289 0000', 1, 1, 1, '2025-01-08 10:52:45', '2025-01-08 11:45:34'),
(7, 'The Bed Residence Phuket เดอะเบด เรสซิเด้นซ์ ภูเก็ต (เปิดใหม่ เงียบสงบ เดินทางสะดวก)', 7500.00, 'UN7o2fe3okNpZFKeoBWC.jpg', 'Wsx7Zverakna83KfvmYJ.jpg', 'kxUHCncDrshH9ciU6eev.jpg', 'อำเภอเมือง/วิชิต', 'The Bed Residence Phuket  ห้องพัก Private รายวัน รายเดือน รายปี เปิดให้บริการแล้วครับ   ราคา 7000 บาท / เดือน (สำหรับลูกค้าขั้นต่ำ 12 เดือน)  - เงินประกัน 7,000 บาท  - ค่าไฟ หน่วยละ 8 บาท  - ค่าน้ำขั้นต่ำ 1-5 หน่วย 100 บาท ตั้งแต่ 6 หน่วยขึ้นไป คิดหน่วยละ 20 บาท  ใกล้!  - สวนสุขภาพ  - 7-11  - Big-c  ห้องพักมีทั้งหมด 2 รูปแบบ 3 สี 3 สไตล์  1. ห้องเตียงเดียว Double Bedded Room ที่นอน 6 ฟุต สำหรับลูกค้า 2 คนนอนกันแบบสบายๆ  2. ห้องเตียงแฝด Twin Bedded Room สำหรับลูกค้าที่ต้องพักผ่อนแยกกันแบบชิลๆ  ฟรี!  - ไม่มีค่าส่วนกลาง  - ฟรี! WIFI แบบ Private  - ฟรี! ที่จอดรถ  - ระบบรักษาความปลอดภัย (keycard)  - กล้องวงจรปิด (CCTV)  สิ่งอำนวยความสะดวกในห้องพัก  - เฟอร์นิเจอร์บิ้วอิน  - ลิฟท์  - แอร์ inverter ประหยัดไฟ 1 ดาว  - ทีวี 32 นิ้ว android tv (Disney Hotstar + Netflix + youtube + ฯลฯ)  - ตู้เย็น   - เครื่องทำน้ำอุ่น  - ชุดโต๊ะ+เก้าอี้  - ซิงค์ล้างจาน  สนใจติดต่อสอบถามข้อมูลเพิ่มเติมหรือต้องการดูห้องพัก  โทร 093-579-7974 (9.00-21.00 น.)  Tel 081-271-2253 (9.00-21.00 น.)', 1, 0, '093-579-7974', 1, 1, 0, '2025-01-08 10:54:41', '2025-01-08 10:56:32'),
(8, 'ไออรุณ ภูเก็ต', 6000.00, 'emEsaUW21Ed5gX7FkUZJ.jpg', 'rmoCEjdcpHU384PyuT9e.jpg', 'sRZ3W2RW4aoQV6bu8jKZ.jpg', 'อำเภอเมือง/รัษฎา', 'อพาร์ทเม้นท์ตกแต่งใหม่ ติดถนนใหญ่ 100เมตร จาก ขนส่งภูเก็ตใหม่ มีป้ายรถสองแถวอยู่หน้าตึก  อยู่ใกล้ - Super cheap Phuket - โรงพยาบาล มิชชั่น ภูเก็ต - มหาวิทยาลัยราชภัฏภูเก็ต  มีบริการ - ทำความสะอาดห้อง 10วันครั้ง ฟรี - รับ ซักผ้าห่ม ปลอกหมอน - ตู้ซักผ้า - internet wifi - ลานจอดรถมีหลังคา  ในห้องมี - แอร์ - ตู้เย็น - ทีวี - เครื่องทำน้ำอุ่น - โต๊ะเครื่องแป้ง / โต๊ะทำงาน - กระจก เต็มตัว - ตู้เสื้อผ้า - เตียง 6 ฟุต', 1, 0, '0892885xxx', 1, 1, 0, '2025-01-08 10:56:21', '2025-01-08 10:56:33'),
(9, 'กู๊ดเดย์ ภูเก็ต', 18000.00, '2FfCvaNLq6vMgtocrBfR.jpg', '98jHpy346VdLDkY8sZ8F.jpg', 'hQgSgGkDyar1niq13HvM.jpg', 'อำเภอเมือง/วิชิต', '', 1, 0, '076390xxx', 1, 1, 0, '2025-01-08 11:01:59', '2025-01-08 11:11:07'),
(10, 'บ้านในสวน', 12000.00, 'MxutgH3iWR5NdFH8khs5 (1).jpg', 'Vw5oG3oGcEoWzaeiYWRH (1).jpg', 'Np6ZhkNUX8zjQGszpC2K.jpg', 'อำเภอเมือง/ตลาดใหญ่', 'ห้องพักเปิดใหม่ เฟอร์นิเจอร์ครบครัน     ทำเลที่ตั้ง อยู่ในเขตเทศบาลเมืองพูเก็ต ใกล้ร้านอาหารเพียง 200 ม.  ขับรถ 2 นาที ถึง ศาลากลาง ,Limelight avenue, เทศบาลนครภูเก็ต,  ย่านเมืองเก่าภูเก็ต, Phuket grocery    -บรรยากาศร่มรื่นมีพื้นที่ส่วนตัว เหมาะสำหรับพักผ่อน  -บริการฟรี Wifi เครื่องทำน้ำอุ่น ที่จอดรถ ไดร์เป่าผม  (ลูกค้าสามารถขอเตารีดและกระทะไฟฟ้าเพิ่มได้)    สอบถาม,จองห้องโทร: 0652969952', 1, 1, '0652969952', 1, 1, 0, '2025-01-08 11:03:30', '2025-01-08 11:46:54'),
(11, 'PhuketHut homestay', 12000.00, 'jpADf5aHFHzAAsNVjtRT.jpg', 'yqAXdLdFr6Kvxv9XrATB (1).jpg', 'embMVwbdomTjfoZpVV5m (1).jpg', 'อำเภอเมือง/ตลาดใหญ่', 'บ้านสวนว่างให้เช่า อยู่เขตเทศบาลนครภูเก็ต ห่างจากถนนคนเดิน (Phuket oldtown) 2.5 กม.บรรยากาศเงียบสงบ  เหมาะสำหรับพักผ่อน สนใจติดต่อ 085-3705616', 1, 0, '085-3705616', 1, 1, 0, '2025-01-08 11:04:46', '2025-01-08 11:11:09'),
(12, 'ธีรดา อพาร์ธเม้นต์', 5000.00, 'yy8Zbrpo61nE81vRsH8y.jpg', 'xjXsWw126ksqgiTgR8Zt.jpg', '7CDFdK93qH8grEQUHW1z.jpg', 'อำเภอเมือง/ตลาดใหญ่', 'ตั้งอยู่เลขที่ 11/140 ถนนศักดิเดชน์ซอย1 ตำบลตลาดใหญ่ เมือง ภูเก็ต 83000  ห่างจากเซเว่น 400 เมตร บริเวณใกล้เคียงมีร้านอาหารตามสั่งมากมาย ใกล้สาระพัดช่าง , สวนหลวง , สำนักงานขนส่ง อาชีวะศึกษา,แยกกวางตุ้ง,สามแยกศักดิเดชน์,พูลผล,ภูเก็ตธานี เดินทางไปมาสะดวก     โดยตึกมีห้องทั้งหมด 19 ห้อง สามารถโทรติดต่อดูห้องตัวอย่างได้ ลมถ่ายเทสะดวก ไม่ร้อน มีระเบียง สงบ', 0, 0, '0815982xxx', 1, 1, 0, '2025-01-08 11:06:41', '2025-01-08 11:11:10'),
(13, 'บ้านพิชญาภร', 3800.00, 'BLCBS2EToAs5tvYzJ6bs.jpg', 'DcRuuEgDqtfwTZjybbLH.jpg', 'PJweGQ5tsfyVsuGgCK4X.jpg', 'อำเภอเมือง/รัษฎา', '????บ้านพิชญาภร ห้องพักเปิดใหม่ พร้อมให้บริการ  ถนนตรัง ซอย 8 ใกล้ กู้กู โรงพยาบาลมิชชั่น ม.ราชภัฎ ศาลากลาง สรรพากร ไปรษณีย์นริศรสะอาด สงบ เดินทางสะดวก พร้อมเฟอร์นิเจอร์ครบ   มีที่จอดรถยนต์และรถมอเตอร์ไซน์ ฟรี‼️', 1, 1, '0809626xxx', 1, 1, 1, '2025-01-08 11:13:57', '2025-01-08 11:45:38'),
(14, '2NN APARTMENTS', 4000.00, 'RbgyWmkh6BLnmJ2zwMZB.jpg', 'AnqJbaC6G6V8f7JZm5Y9.jpg', 'fHbZATMzyfQGFGEZcvTD.jpg', 'อำเภอเมือง/วิชิต', 'สอบถามห้องว่าง กรุณาโทรติดต่อนะครับ????  081 978 1246 (คุณขาว)', 0, 1, '081 978 1246', 1, 1, 0, '2025-01-08 11:15:30', '2025-01-08 11:28:26'),
(15, 'บ้านร่มเย็น', 4300.00, '4hfcPp2d6yLiDdcY9UEf.jpg', 'mV9dWPUZPcxV1sXWxLJ6.jpg', 'J72pVQzp2FYGMk87bdFw.jpg', 'อำเภอเมือง/รัษฎา', 'ห้องพัก พร้อมเข้าอยู่ - เฟอร์นิเจอร์ ตู้ เตียง พัดลม แอร์ อ่างล้างจาน ขนาดห้อง 4x4.5เมตร  เช่ารายเดือน  จากปกติห้องพัดลม 3,800 / เดือน  จากปกติห้องแอร์ 4,300 บาท / เดือน    เงินประกัน :3,800 บาท(พัดลม), 4,300(แอร์)  จ่ายล่วงหน้า :1 เดือน  ค่าไฟฟ้า :7 บาทต่อยูนิต ค่าน้ำ :20 บาทต่อยูนิต   ##มีที่จอดรถสำหรับมอเตอร์ไซต์เท่านั้นค่ะ  ﻿##อยู่ขั้นต่ำ 6 เดือน    ติดต่อสอบถามได้ที่ 081-597-4228,  ติดต่อทางไลน์ 092-621-9155 (บ้านร่มเย็น)', 0, 0, '0815974xxx', 1, 1, 0, '2025-01-08 11:18:06', '2025-01-08 11:28:28'),
(18, 'คาเฟ่66โฮลเทล', 6000.00, 'nNiADHLKtdvtAAaJaTXQ.jpg', '7FWmcPyQHkDn5UXa8HRe.jpg', '4PvVgdDnEkTmW7tg9zng.jpg', 'อำเภอเมือง/ตลาดใหญ่', 'ห้องว่างให้เช่าใจกลางเมือง ราคาย่อมเยา รายวัน-รายเดือน อยู่ใกล้แหล่งท่องเที่ยว เดินทางสะดวก ปลอดภัย', 0, 0, '0867400xxx', 1, 1, 1, '2025-01-08 11:21:46', '2025-01-08 11:46:20'),
(19, 'ห้องพักให้เช่า', 2800.00, 'pK7dHyJgaV8zc35km4EL.jpg', 't3DnTSsLaRj8Nydgotur.jpg', 'zaB6gjth2NbXET24WWSH.jpg', 'อำเภอเมือง/รัษฎา', 'ห้องพักให้เช่า อยู่ในซอยลูกแก้ว (ใกล้กับ ซุปเปอร์ชีปใหญ่) และใกลั ม.ราชภัฎภูเก็ต  ห้องใหม่ สะอาด สงบ  **ไม่มีแอร์**  **ไม่อนุญาตให้เลี้ยงสัตว์**', 0, 0, '0959569xxx', 1, 1, 0, '2025-01-08 11:22:44', '2025-01-08 11:28:29'),
(20, 'พรรณี', 3300.00, 'WPe84SzmqAETura5gkyg.jpg', '38DjNuj3LDVWNHJ7MScY.jpg', 'FgmnWx1mjB2tmfeRcZr4.jpg', 'อำเภอเมือง/รัษฎา', 'ห้องโล่งไม่มีเฟอร์นิเจอร์ มีห้องนอนด้านใน มีห้องรับแขก มีห้องนั่งเล่น', 0, 0, '0824207xxx', 1, 1, 0, '2025-01-08 11:24:50', '2025-01-08 11:28:30'),
(21, 'มัฆวัน อพาร์ทเม้นท์', 2800.00, 'G5gKNkbCTgFFxZuwuVQn.jpg', 'yGt6yAHWtgYwKYX4xRkt.jpg', '3uZjxxqpD9ZiFxti1hWB.jpg', 'อำเภอเมือง/ตลาดเหนือ', 'ด่วน ราคาเบาๆ ในตัวเมืองภูเก็ต  ราคาช่วยกันช่วยโควิต 2,500 - 3,500 บาท  ห้องพักสบายๆ พร้อมกับวิวสวยๆ ใจกลางเมืองภูเก็ต  ไปทางไหนก็ใกล้ ทั้งเซ็นทรัล โลตัส บิ๊กซี ไม่ถึง 1 km.', 0, 0, '0817887xxx', 1, 1, 0, '2025-01-08 11:25:59', '2025-01-08 11:28:30'),
(22, 'สมาย เรสซิเดนท์', 7500.00, 'qnPkZGDSbHLRt548TAay.jpg', 'Te5xaeri2576Hupkaapf.jpg', 'bE4Uub6me1q5LGa7NW7F.jpg', 'อำเภอเมือง/ราไวย์', 'อพาร์ทเม้นท์ใหม่ !!! ราคากันเอง บรรยากาศร่มรื่น เงียบสงบ พร้อมบริการครบวงจร (ลิฟท์,สระว่ายน้ำ,ฟิตเนส)  ทำเลใกล้หาดกะตะและราไวย์ เพียง 10 นาที  *** สอบถามห้องพักได้ที่อีเมลนี้ smileresidence@gmail.com ***  หรือโทร 095-0942221', 1, 0, '095-0942221', 1, 1, 1, '2025-01-08 11:27:05', '2025-01-08 11:45:43'),
(23, 'พันวา 109 อพาร์ทเม้นท์', 5000.00, 'mEKe7semJbd5LXbkbEpg.jpg', 'c9yXEw45X3bdWB7yocWu.jpg', 'JoQKZiNpn43arH2pbcCM.jpg', 'อำเภอเมือง/วิชิต', 'ใกล้อ่าวมะขาม แหลมพันวา ตรงข้ามโรงแรม Pullman    อยู่ในซอยโซนร้านค้าและร้านอาหาร ใกล้แฟมิลี่มาร์ท สามารถเดินไปทะเลได้  รายละเอียดห้องพัก  อพาร์ทเม้นต์สร้างใหม่ ห้องพักสะอาด ปลอดภัย วิวสวย บรรยากาศร่มรื่น  ขนาดห้องพัก 24 ตร.ม. แบ่งสัดส่วนห้องน้ำ ห้องครัว/นั่งเล่น ห้องนอน    ราคาค่าเช่า  ค่าเช่ารายเดือน ห้องพัดลมเริ่มต้น 3,200 บาท ห้องแอร์เริ่มต้น 4,500 บาท', 0, 0, '0814997xxx', 1, 1, 0, '2025-01-08 11:28:23', '2025-01-08 11:28:32'),
(24, 'บ้านณรงค์', 2800.00, 'pxmQbgwypAEkCpbJD7cd.jpg', 'gpb4rg6PxyiTNrDzdS1h.jpg', 'r4uca8zHEgkgipJKyghP.jpg', 'อำเภอเมือง/รัษฎา', 'ห้องพักให้เช่า  สะอาด สงบ มีความเป็นส่วนตัว  อยู่ใจกลางเมือง  ใกล้มหาวิทยาลัยราชภัฏภูเก็ต  และใกล้กับแหล่งชุมชน', 0, 0, '0959569xxx', 1, 1, 0, '2025-01-08 11:37:03', '2025-01-08 11:45:00'),
(25, 'ภูเก็ตอันดามันเพลส', 6500.00, 'V8tmqrDTkM8zbi1KbK51.jpg', 'cupuReco6fweNixBWHXC.jpg', 'uopSbTSZdxSQXw6EfTzU.jpg', 'อำเภอเมือง/วิชิต', '', 0, 0, '0629586xxx', 1, 1, 1, '2025-01-08 11:38:15', '2025-01-08 11:46:29'),
(26, 'WINROOMS', 4500.00, '6NdGNmDZq3RN5KSt5Zgp.jpg', 'cPuUZQ7s4VkQbzDUmLbZ.jpg', 'nADwb4QWro6jhH9tYHLd.jpg', 'อำเภอเมือง/รัษฎา', '1. ใกล้สถานีคนส่งผู้โดยสารจังหวัดภูเก็ตแห่งที่ 2 (บขส. 2)  2. ใกล้มหาวิทยาลัยราชภัฏภูเก็ต  3. อยู่ติดถนน  4. ใกล้ร้านสะดวกซื้อ', 0, 0, '0895895xxx', 1, 1, 0, '2025-01-08 11:39:11', '2025-01-08 11:45:02'),
(27, 'บ้านรวยสุข', 5000.00, 't7v1uP9RK5Cpcqh7oHLc.jpg', '5CZsKLFoWB9Q3f5b9w1H.jpg', '6wQ1sjZ7Sd3AM6cZxiVf.jpg', 'อำเภอเมือง/รัษฎา', 'บ้านรวยสุข!!!!  ห้องพักให้เช่ารายเดือนเท่านี้ เอ้ยเท่านั้น สร้างใหม่ มีเพียง จำนวน 16 ห้องครับ  เฟอร์ครบ เตียงขนาด5ฟุต ตู้เสื้อผ้า ชั้นวางทีวี โต๊ะเครื่องแป้ง แอร์ เครื่องทำน้ำอุุ่น อินเตอร์เน็ตไวไฟ WIFI พร้อมกล้องวงจรปิด  ทำเลที่ตั้ง หมู่บ้านศรีสุชาติ 3 ซอยรวยทรัพย์15 ใกล้โบ๊ทพลาซ่า ซอยหลังโรงไฟฟ้า ตรงที่ บขสใหม่ ถ้าเข้ามาทางนี้ ขับตรงมาเรื่อยๆ จะเจอ7-11 อย่าไปสนใจครับเลยไปจนเจอ 7-11 สาขา2 เลี้ยวทางขวาเข้าซอย 7-11 ครับ 9 ตรงเข้าไปสุดจะบังคับเบี่ยงขวาขวา จะอยู่ทางขวามือครับผม', 1, 0, '0937725xxx', 1, 1, 0, '2025-01-08 11:40:22', '2025-01-08 11:45:02'),
(28, 'ธารา นาคา อพาสเม้นต์', 6500.00, 'X6J8ZuB4zRfDhzwaNKrs.jpg', '3YwBFANFJPvPDf4h5aXX.jpg', 'EsU1TnXJfuWCnpMwCHVF.jpg', 'อำเภอเมือง/วิชิต', 'โทร สอบถาม 0896454392  โซน ตลาดนาคา 63/777 หมู่ที่ 4 ต.วิชิต อ.เมือง จ.ภูเก็ต', 0, 0, '0896454392', 1, 1, 0, '2025-01-08 11:42:17', '2025-01-08 11:47:04'),
(29, 'บ้านสวนหลวง', 4500.00, 'U2di8RkdzourBTH45fm2.jpg', 'VCfFPAwHaJqJ32UcQuUW.jpg', '8Uh7yEzJ1BGfidek7iKR.jpg', 'อำเภอเมือง/ตลาดเหนือ', 'ห้องพักอยู่ใจกลางเมือง เดินทางสะดวก ใกล้แหล่งของกิน  ห้างสรรพสินค้า เมืองเก่า บรรยากาศดีแม้อยู่ในเมือง', 1, 1, '0808466xxx', 1, 1, 0, '2025-01-08 11:43:27', '2025-01-08 11:45:04'),
(30, 'บ้านเตชะญา 3', 4500.00, 'pCSyejtTeExnuSqQgddh.jpg', 'boVHS4gs7f1EBoGfgdin.jpg', 'ohPRA7vSvYVNBm3VSoxW.jpg', 'อำเภอเมือง/รัษฎา', '', 1, 1, '0819790xxx', 1, 1, 0, '2025-01-08 11:44:55', '2025-01-08 11:45:04');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `id` int(1) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id`, `type`) VALUES
(1, 'ผู้เช่า'),
(2, 'ผู้ให้เช่า'),
(3, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `type_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `fullname`, `type_id`, `created_at`) VALUES
(1, 'admin', '$2y$10$TzirA0parWMTFOUYqLikvOw7BKKaAody/Z90iXBX6YfJBuHF9WhYq', 'admin@admin.com', 'admin', 3, '2024-11-12 15:02:57'),
(2, '123456', '$2y$10$sKM5imSzsfxta5.LBnr2yOWWZqDuxPps3koYs0hSXmQ3x4SwOHJJa', '123@123.com', '123456', 2, '2024-11-12 15:03:20'),
(3, 'chachiyo', '$2y$10$cMs7RnGBVkolOVMd2eIujuVfDfBNMAVNLTlRWX4r4PIS0ZcN0bvAC', 'naruephat2513@gmail.com', 'nuttajak', 1, '2024-11-25 07:18:04'),
(4, 'nine', '$2y$10$5YehmOP/IolTJJjgODAQDexCRM2Jr8PHMtp.DjzVmPjLxQTbKPwRK', '65202040036@phuket.vc.ac.th', 'halan', 1, '2024-11-27 07:00:39'),
(5, 'คนมีบ้าน', '$2y$10$l.GMCv67a5/lKr8KLwAF9.3/jFLw4a8IxyfxCBeCQJTILleEyUg5W', 'kuy@gmail.com', 'หาคนไร้บ้าน มาอยู๋บ้าน', 2, '2024-12-05 19:07:13'),
(6, 'ytrr', '$2y$10$6MVbgcXq9Ym8fXNauMVPcehvkq92BuQrP69/KyEKP.RkznmwbjGKm', 'pixpox999@gmail.com', 'yr', 1, '2024-12-12 04:19:54'),
(7, 'guest', '', '', '', NULL, '2025-02-10 10:31:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `like`
--
ALTER TABLE `like`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users_type` (`type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `like`
--
ALTER TABLE `like`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `like`
--
ALTER TABLE `like`
  ADD CONSTRAINT `like_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `like_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_type` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
