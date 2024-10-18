-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 18 أكتوبر 2024 الساعة 15:22
-- إصدار الخادم: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- بنية الجدول `categories`
--

CREATE TABLE `categories` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `parent` int(11) NOT NULL,
  `Orderning` int(11) DEFAULT NULL,
  `Visibility` tinyint(4) NOT NULL DEFAULT 0,
  `Allow_Comment` tinyint(4) NOT NULL DEFAULT 0,
  `Allow_Ads` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `categories`
--

INSERT INTO `categories` (`ID`, `Name`, `Description`, `parent`, `Orderning`, `Visibility`, `Allow_Comment`, `Allow_Ads`) VALUES
(3, 'الاوحة الام', '', 0, 1, 0, 0, 0),
(4, 'كارت الشاشة', '', 0, 2, 0, 0, 0),
(5, 'المعالجات', '', 0, 3, 0, 0, 0),
(6, 'HDD/SSD', '', 0, 4, 0, 0, 0),
(7, 'RAM', '', 0, 5, 0, 0, 0),
(8, 'POWER SUPPLY', '', 0, 6, 0, 0, 0),
(9, 'CASE', '', 0, 7, 0, 0, 0),
(10, 'اكسسوارات', '', 0, 8, 0, 0, 0),
(11, 'شاشات', '', 0, 9, 0, 0, 0),
(12, 'لابتوب', '', 0, 10, 0, 0, 0),
(13, 'INTEL', 'good', 5, 2, 0, 0, 0),
(14, 'AMD', 'good', 5, 2, 0, 0, 0),
(15, 'TRANSCEND', 'good', 7, 2, 0, 0, 0),
(16, 'TEAM GROUP', 'good', 7, 3, 0, 0, 0),
(17, 'HYPER X', 'good', 7, 4, 0, 0, 0),
(18, 'G.SKILL', 'good', 7, 4, 0, 0, 0),
(21, 'THERMALTAKE ', 'good', 7, 4, 0, 0, 0),
(22, 'XPG', 'good', 7, 4, 0, 0, 0),
(23, 'CORSAIR', 'good', 7, 2, 0, 0, 0),
(24, 'CRUCIAL  	 	', 'good', 7, 2, 0, 0, 0),
(26, 'TFORCE ', 'good', 7, 5, 0, 0, 0),
(27, 'RAM DDR4 ', 'good', 7, 4, 0, 0, 0),
(28, 'MSI', 'good', 3, 5, 0, 0, 0),
(29, 'ASUS', 'good', 3, 5, 0, 0, 0),
(30, 'GIGYBYTE', 'good', 3, 3, 0, 0, 0),
(31, 'ASROCK', 'good', 3, 5, 0, 0, 0),
(32, 'SSD+M.2', 'good', 6, 3, 0, 0, 0),
(33, 'HDD', 'good', 6, 3, 0, 0, 0),
(37, 'CART MSI', 'good', 4, 1, 0, 0, 0),
(38, 'CART ASROCK', 'good', 4, 3, 0, 0, 0),
(39, 'CART ZOTAC', 'good', 4, 3, 0, 0, 0),
(40, 'CART GIGABYTE', 'good', 4, 5, 0, 0, 0),
(41, 'CART ASUS', 'good', 4, 4, 0, 0, 0),
(42, 'CART INNO3D', 'good', 4, 5, 0, 0, 0),
(43, 'CART GALAX', 'good', 4, 3, 0, 0, 0),
(44, 'CART PNY', 'good', 4, 5, 0, 0, 0),
(48, 'MONITOR ASUS', 'good', 11, 5, 0, 0, 0),
(49, 'MONITOR SAMSUNG', 'good', 11, 3, 0, 0, 0),
(52, 'POWER SUPPLY AEROCOOL', 'good', 8, 5, 0, 0, 0),
(54, 'POWER SUPPLY ASUS', 'good', 8, 5, 0, 0, 0),
(55, 'POWER SUPPLY EVGA	 	 	 	', 'good', 8, 5, 0, 0, 0),
(56, 'POWER SUPPLY COOLERMASTER 	 	 	 	', 'good', 8, 5, 0, 0, 0),
(57, 'POWER SUPPLY THERMALTAKE', 'good', 8, 1, 0, 0, 0),
(58, 'POWER SUPPLY GIGBYTE', 'good', 8, 5, 0, 0, 0),
(59, 'FAP HEXA', 'good', 8, 5, 0, 0, 0),
(60, ' ALL CASE ', 'good', 9, 5, 0, 0, 0),
(61, 'ALL Acs', 'good', 10, 5, 0, 0, 0),
(62, 'COOLER', 'good', 0, 1, 0, 0, 0),
(63, 'COOLER ALL', 'good', 62, 5, 0, 0, 0);

-- --------------------------------------------------------

--
-- بنية الجدول `comments`
--

CREATE TABLE `comments` (
  `c_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `comment_date` date NOT NULL,
  `item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `items`
--

CREATE TABLE `items` (
  `Item_ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `Price` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `Add_Date` date NOT NULL,
  `Country_Made` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL,
  `Approve` tinyint(4) NOT NULL DEFAULT 0,
  `Cat_ID` int(11) NOT NULL,
  `Member_ID` int(11) NOT NULL,
  `tags` varchar(255) NOT NULL,
  `Image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `items`
--

INSERT INTO `items` (`Item_ID`, `Name`, `Description`, `Price`, `qty`, `Add_Date`, `Country_Made`, `Status`, `Approve`, `Cat_ID`, `Member_ID`, `tags`, `Image`) VALUES
(21, 'ASROCK B450 PRO4', 'Socket AM4, Digi Power design, 9 Power Phase design, Supports 105W Water Cooling (Pinnacle Ridge); Supports 95W Water Cooling (Summit Ridge); Supports 65W Water Cooling (Raven Ridge) Chipset: AMD Promontory B450 Memory: 4x DDR4-3200+(OC)/2933/2667/2400/2133 DIMM Slots, Dual Channel, ECC, Non-ECC, Unbuffered, Max Capacity of 64GB (AMD Ryzen series CPUs (Pinnacle Ridge)) Slots: 4x PCI-Express 3.0 x16 Slots (one runs at x8, two run at x4), 4x PCI Express 2.0 x1 Slots SATA: 4x SATA3 Ports, Support RAID 0, 1, 10, NCQ, AHCI and Hot Plug; 2x SATA3 Ports by AS Media ASM1061, supports NCQ, AHCI and Hot Plug', '85', 1, '2020-12-04', 'TAIWAN', '1', 1, 31, 32, 'ATX,AMD,ASROCK', '47514_B450 Pro4.png'),
(22, 'RYZEN 5 3400G', 'AMD Ryzen™ 5 3400G with Radeon™ RX Vega 11 Graphics / 4 Cores 8 Threads', '155', 1, '2020-12-04', 'USA', '1', 1, 14, 32, 'RYZEN,APU,R5', '12588_A_v7nv-as.jpg'),
(23, 'core i3 9100f', 'Intel Core i3-9100F Desktop Processor 4 Core Up to 4.2 GHz without Processor Graphics LGA1151 300 Series 65W Visit the Intel Store', '90', 1, '2020-12-04', 'usa', '1', 1, 13, 32, 'intel,ci3', '97718_intel_bx80684i39100f_core_i3_i3_9100f_quad_core_1573508231000_1514726.jpg'),
(25, 'core i5 9400f', '6 Cores/ 6 Threads 2.90 GHz up to 4.10 GHz Max Turbo Frequency/ 9 MB cache, Bus Speed: 8 GT/s DMI3 Compatible only with Motherboards based on Intel 300 Series Chipsets: Intel B360 Chipset, Intel H370 Chipset, Intel H310 Chipset, Intel Q370 Chipset, Intel Z390 Chipset, Intel Z370 Chipset Discrete GPU required No integrated graphics. Max Memory bandwidth - 41.6 GB/s. Max Memory Channels - 2 Intel Optane Memory supported', '150', 1, '2020-12-04', 'USA', '1', 1, 13, 32, 'intel,ci5,cpu', '54404_19-117-981-V01.jpg'),
(26, 'FOUNOSTAR 32 INCH Model FD310QDJ', 'FOUNOSTAR  Model FD310QDJ  Size 32', '240', 1, '2020-12-04', 'CHINA', '1', 1, 11, 32, '165HZ,27_INCH,IPS,FHD', '25512_119656168_3277064332390154_3215571400065650254_n.jpg'),
(27, 'FOUNOSTAR 27 INCH  Model FD270DKF', 'FOUNOSTAR  Model  FD270DKF Size 27\" frameless  curved  Display FHD IPS Resolution 1920*1080 Refresh Rate HDMI: 144HZ     DP 165HZ  Viewing angle H:178°V:178° Respone Time : 1ms  DP+HDMI+USB Flicker Free + Low blue Light Freesync', '210', 1, '2020-12-04', 'CHINA', 'جديد', 1, 11, 32, '165HZ,27_INCH,IPS,FHD', '30895_119163714_10158528690499076_5244885138641474329_n.jpg'),
(28, 'GIGABYTE B450M DS3H', 'Supports AMD 1st & 2nd generation Ryzen/ Ryzen with Radeon Vega graphics processors Dual channel non-ECC unbuffered DDR4, 4 DIMMs HDMI, DVI D ports for multiple display PCIe Gen3 M.2 NVMe High quality audio capacitors and audio noise guard RGB fusion supports RGB LED strips in 7 colors Realtek Gigabit LAN', '85', 1, '2020-12-04', 'TAIWAN', '1', 1, 30, 32, 'Micro_ATX,gigabyte,amd', '825_91Rx29tuyAL._AC_SL1500_-1500x1036.jpg'),
(29, 'FSP 500W HEXA+', 'POWER SUPPLY', '45', 1, '2020-12-04', 'TAIWAN', '1', 1, 59, 32, '500W,FSP,PSU', '3812_HEXA_500-1200x1200.jpg'),
(30, 'HDD WD 1TB BLUE 7200RPM ', 'Storage Drive', '45', 1, '2020-12-04', 'Iraq', '1', 1, 33, 32, 'HDD,WD', '55685_4Uwmn8XkzTpZyCHDxc6YmSeKu0CRJM137Xiuju9A.jpeg'),
(31, 'ASUS TUF GTX 1650 SUPER', 'GRAPHICS CARD', '195', 1, '2020-12-04', 'Iraq', '1', 1, 41, 32, 'ASUS,VGA,1650S', '73958_81o8cabn1zL._SL1500_.jpg'),
(32, 'ZOTAC GTX 1660 SUPER', 'GRAPHICS CARD', '260', 1, '2020-12-04', '', '1', 1, 39, 32, 'ZOTAC,VGA,1660S', '93222_zt-t16620f-10l_image1.jpg'),
(35, 'INTEL CI5 9600KF', '', '210', 1, '2020-12-08', '', 'جديد', 1, 13, 32, 'CI5,KF', '58828_hpit-528_hpit_528_01_800x800.jpg'),
(36, ' INTEL Ci5 10400               ', '', '200', 1, '2020-12-08', '', '1', 1, 13, 32, '', '280_1589327172_1558678.jpg'),
(37, 'INTEL Ci9 10850K', '', '530', 1, '2020-12-08', '', 'جديد', 1, 13, 32, '', '87707_Intel-i9-10900K-1-2060x1545.jpg'),
(38, 'INTEL CI7 9700K                		 		', '', '340', 1, '2020-12-08', '', '1', 1, 13, 32, '', '50057_71Q5sdPHD-L._AC_SX466_.jpg'),
(41, ' INTEL Ci5-10600K', '', '280', 1, '2020-12-08', '', 'جديد', 1, 13, 32, '', '50290_71LqOVOXZmL._AC_SL1500_.jpg'),
(42, 'INTEL CI9 9900K', '', '450', 1, '2020-12-08', '', 'جديد', 1, 13, 32, '', '49957_CP65JIN_193693_800x800.jpg'),
(43, 'INTEL CI7 10700                  	 		', '', '340', 1, '2020-12-08', '', 'جديد', 1, 13, 32, '', '41720_717j+x+sAFL._AC_SL1500_.jpg'),
(44, 'INTEL CI7 10700K              	 		', '', '400', 1, '2020-12-08', '', '1', 1, 13, 32, '', '80121_717j+x+sAFL._AC_SL1500_.jpg'),
(46, 'INTEL CORE I3-10100          	 		', '', '125', 1, '2020-12-08', '', 'جديد', 1, 13, 32, '', '5843_package1.jpg'),
(47, 'INTEL CI9 9900KF', '', '415', 1, '2020-12-08', '', 'جديد', 1, 13, 32, '', '38184_51JO5mCAKoL._AC_SX466_.jpg'),
(48, 'INTEL CORE I3-9100F  	 		', '', '95', 1, '2020-12-08', '', 'جديد', 1, 13, 32, '', '29659_intel-processor-i3-9100f-500x500.jpg'),
(50, 'AMD Ryzen™ 9 3900XT             		 		', '', '525', 1, '2020-12-08', '', '1', 1, 14, 32, '', '28029_amd_ryzen_9_3900x_12core_24thr_1594414229_cc52b9bb_progressive.jpg'),
(51, '        AMD Ryzen 5 3400G              		 		', '', '155', 1, '2020-12-08', '', 'جديد', 1, 14, 32, '', '98619_19-113-570-V02.jpg'),
(54, 'AMD Ryzen™ 5 3600      	 		', '', '190', 1, '2020-12-08', '', 'جديد', 1, 14, 32, '', '93992_CP-AMD-100-100000281BOX-1.jpg'),
(55, '    AMD RYZEN 5 2600   		 		', '', '130', 1, '2020-12-08', '', 'جديد', 1, 14, 32, '', '6495_CP-AMD-100-100000281BOX-1.jpg'),
(56, 'AMD Ryzen™ 7 3800XT        	 		', '', '380', 1, '2020-12-08', '', 'جديد', 1, 14, 32, '', '9155_71-udC1UaXL._AC_SL1384_.jpg'),
(57, 'AMD Ryzen™ 7 2700X 	 		', '', '195', 1, '2020-12-08', '', '1', 1, 14, 32, '', '44739_51XoylGq9iL._SL1000_2700Xsdkj.jpg'),
(58, 'AMD Ryzen™ 5 3600X', '', '210', 1, '2020-12-08', '', 'جديد', 1, 14, 32, '', '2797_19-113-568-V11.jpg'),
(60, 'AMD Ryzen™ 7 3700X               		 		', '', '350', 1, '2020-12-08', '', 'جديد', 1, 14, 32, 'RYZEN,R7', '91915_image.jpg'),
(61, 'AMD Ryzen™ 7 3800X        		 		', '', '380', 1, '2020-12-08', '', 'جديد', 1, 14, 32, '', '30628_image.jpg'),
(68, 'HyperX Fury RGB 8GB 8X1 3600', '', '60', 1, '2020-12-08', '', 'جديد', 1, 17, 32, '', '94986_kingston_hyperx_fury_8gb_ddr4_3200mhz_rgb_01_l.jpg'),
(69, 'HyperX Fury RGB 8GB 8X1 3200', '', '50', 1, '2020-12-08', '', 'جديد', 1, 17, 32, '', '90645_kingston_hyperx_fury_8gb_ddr4_3200mhz_rgb_01_l.jpg'),
(73, 'G.SKILL Trident Z RGB 8GB 8X1 3600', '', '60', 1, '2020-12-08', '', 'جديد', 1, 18, 32, '', '80243_20-232-476-S01.jpg'),
(74, 'G.SKILL Trident Z RGB 8GB 8X1 3200', '', '50', 1, '2020-12-08', '', 'جديد', 1, 18, 32, '', '90761_20-232-476-S01.jpg'),
(76, 'Corsair 8GB 8X1 3200 VENGEANCE PRO Black RGB	 	 	', '', '55', 1, '2020-12-08', '', 'جديد', 1, 23, 32, '', '70751_81EEpt-xy0L._AC_SL1500_.jpg'),
(78, 'THERMALTAKE 8GB 8X1 3200 TOUGHRAM WHITE 	 	', '', '60', 1, '2020-12-08', '', 'جديد', 1, 21, 32, '', '73584_thw_01_4.jpg'),
(79, 'ADATA XPG D60 RGB 8GB 8X1 3200	 	 	', '', '50', 1, '2020-12-08', '', 'جديد', 1, 22, 32, '', '24881_productGallery38.png'),
(85, 'ADATA XPG D50 GRAY 8X1 8GB 3200MHZ	 	 	', '', '45', 1, '2020-12-08', '', 'جديد', 1, 22, 32, '', '55333_XPG-SPECTRIX-D50-2DIMMs-TEMP.jpg'),
(86, 'ADATA XPG D50 WHITE 8X1 8GB 3200MHZ	 	 	', '', '45', 1, '2020-12-08', '', 'جديد', 1, 22, 32, '', '60430_productGallery216.png'),
(87, 'ADATA XPG D41 RGB 8GB 8X1 3200 	', '', '55', 1, '2020-12-08', '', 'جديد', 1, 22, 32, '', '88628_1593084029_1567781.jpg'),
(95, 'MSI RTX 2060 VENTUS', '', '350', 1, '2020-12-08', '', 'جديد', 1, 37, 32, '2060', '91607_61NQBW4ytbL._AC_SL1000_ (1).jpg'),
(103, 'MSI GTX1650 SUPER VENTUS	 	', '', '195', 1, '2020-12-08', '', 'جديد', 1, 37, 32, 'SUPER,1650', '16148_MSI-GeForce-GTX-1650-SUPER-VENTUS-XS-OC.jpg'),
(116, 'ZOTAC GAMING GeForce GTX 1660 SUPER Twin Fan 6GB', '', '270', 1, '2020-12-08', '', '1', 1, 39, 32, '', '74751_e24244b16072f00c256a7254974f9bf1.jpg'),
(133, 'ASUS B450M-A PRIME', '', '95', 1, '2020-12-09', 'العراق', '1', 1, 29, 32, 'b450', '26521_91PNJDfS7sL._AC_SL1500_ (1).jpg'),
(134, 'ASUS B450-PLUS GAMING', '', '140', 1, '2020-12-09', 'العراق', '1', 1, 29, 32, 'b450', '21426_91NAiiZP9CL._AC_SX679_.jpg'),
(135, 'ASUS B550M-k PRIME', '', '125', 1, '2020-12-09', '', '1', 1, 29, 32, 'B550', '36241_P_setting_fff_1_90_end_600 (1).jpeg'),
(136, 'ASUS TUF B550-PLUS GAMING', '', '155', 1, '2020-12-09', 'العراق', '1', 1, 29, 32, 'B550', '59893_81tuIOTnHtL._AC_SL1500_.jpg'),
(137, 'ASUS X570-P PRIME', '', '200', 1, '2020-12-09', 'العراق', '1', 1, 29, 32, 'X570', '80221_91OLGGjucCL._AC_SL1500_.jpg'),
(138, 'ASUS X570-PLUS GAMING ( WI-FI)', '', '260', 1, '2020-12-09', 'العراق', '1', 1, 29, 32, 'X570', '23726_91rZkdZy3VL._AC_SL1500_.jpg'),
(139, 'ASUS B460M-k PRIME', '', '95', 1, '2020-12-09', 'العراق', '1', 1, 29, 32, 'b460', '50753_ImgW (2).jpeg'),
(140, 'ASUS TUF B460-PLUS GAMING', '', '145', 1, '2020-12-09', 'العراق', '1', 1, 29, 32, 'B460', '28831_ImgW (3).jpeg'),
(141, 'ASUS Z490-P PRIME', '', '170', 1, '2020-12-09', 'العراق', '1', 1, 29, 32, '', '93601_91zHo0TyF3L._AC_SL1500_.jpg'),
(142, 'ASUS TUF Z490-PLUS GAMING', '', '200', 1, '2020-12-09', 'العراق', '1', 1, 29, 32, '', '40124_91gq-03s1JL._AC_SX466_.jpg'),
(143, 'ASUS ROG STRIX Z490-G GAMING', '', '240', 1, '2020-12-09', 'العراق', '1', 1, 29, 32, 'Z490', '62631_81p-BDK6ijL._AC_SL1500_.jpg'),
(144, 'ASUS ROG STRIX Z490-F GAMING', '', '265', 1, '2020-12-09', 'العراق', '1', 1, 29, 32, 'Z490', '18936_91h0ykA5erL._AC_SL1500_.jpg'),
(145, 'FSP 700W HYPERK', '', '80', 1, '2020-12-09', 'العراق', '1', 1, 59, 32, '700W', '21552_6c03e5fbecbaac70bdf9213b5e49f1ce.jpeg'),
(146, 'AeroCool P7-850W Platinum Fully Mod', '', '190', 1, '2020-12-09', '', '1', 1, 52, 32, '850W', '66915_9e113828-9c25-4bff-ac00-931c8712ed14.jpg'),
(148, 'AeroCool Cylon 600W  RGB', '', '55', 1, '2020-12-09', '', '1', 1, 52, 32, '600W', '77324_AeroCool-Cylon-600W-Circle-Infographic-3-700x700px.jpg'),
(149, 'AeroCool Cylon 700W RGB', '', '65', 1, '2020-12-09', '', '1', 1, 52, 32, '700W', '76236_1-12.jpg'),
(150, 'AeroCool LUX 650W Bronze RGB', '', '60', 1, '2020-12-09', '', '1', 1, 52, 32, '650W', '65121_Lux-550W-Infographic-700x700px-01.jpg'),
(154, 'AeroCool LUX 750W Bronze RGB', '', '70', 1, '2020-12-09', '', '1', 1, 52, 32, '750W', '46553_aerocool_lux_750m_rgb_750W80_plus_bronze_01_l (1).jpg'),
(155, 'AeroCool KCAS 650W Gold RGB', '', '80', 1, '2020-12-09', '', '1', 1, 52, 32, '650W', '55946_AeroCool-KCAS-650M-Infographic-1-700x700px-1.jpg'),
(156, 'AeroCool KCAS 750W Gold RGB', '', '90', 1, '2020-12-09', '', '1', 1, 52, 32, '750W', '79502_AeroCool-KCAS-750G-Infographic-1-700x700px.jpg'),
(157, 'AeroCool KCAS 850W Gold RGB', '', '100', 1, '2020-12-09', '', '1', 1, 52, 32, '850W', '34223_AeroCool-KCAS-850G-Infographic-1-700x700px.jpg'),
(158, 'CASE FANTECH CG73', '4 فانات', '50', 1, '2020-12-09', 'العراق', '1', 1, 60, 32, '', '7645_Fantech-CG73-1-500x500w.png'),
(159, 'havit headphones hv-h2232d', '', '20', 1, '2020-12-09', '', 'جديد', 1, 61, 32, '', '34941_5-9.jpg'),
(160, 'CASE FANTECH CG71W', 'بدون فانات', '40', 1, '2020-12-09', 'العراق', '1', 1, 60, 32, '', '27796_ab3e6c051964a5430802f71835298399.jpeg'),
(161, 'havit headphones h2026d', '', '16', 1, '2020-12-09', '', 'جديد', 1, 61, 32, '', '22736_H2026d-1.jpg'),
(162, 'CASE FANTECH CG71B', 'بدون فانات', '40', 1, '2020-12-09', 'العراق', '1', 1, 60, 32, '', '13697_HTB1co.Va4D1gK0jSZFK763JrVXaA.png_350x350.png'),
(163, 'havit headphones h2026d', '', '25', 1, '2020-12-09', '', 'جديد', 1, 61, 32, '', '40075_H2028U-4.jpg'),
(165, 'CASE FANTECH CG72', 'بدون فانات', '40', 1, '2020-12-09', 'العراق', '1', 1, 60, 32, '', '73601_HTB1rDCXXYY1gK0jSZTE760DQVXaC.png'),
(166, 'havit headphones h2575bt WIERLESS', 'سماعات لاسلكية احترافية من HAVIT', '16', 1, '2020-12-09', '', '1', 1, 61, 32, '', '41667_AURICULAR-HAVIT-HV-H2575BT-1000x1000.jpg'),
(167, 'HIVET MIC RGB gk56', 'مايكروفون احترافي للبثوث من HAVIT', '30', 1, '2020-12-09', '', '1', 1, 61, 32, '', '25531_麦克风.33jpg-1.jpg'),
(168, 'havit mouse ms1012a', '', '16', 1, '2020-12-09', '', 'جديد', 1, 61, 32, '', '47798_havitrgb-backlit-programable.jpg'),
(169, 'CASE SATE K381 ', 'كيس مع 8 فانات', '70', 1, '2020-12-09', 'العراق', '1', 1, 60, 32, '', '55422_unnamed (4).png'),
(170, 'havit mouse ms1012a', '', '8', 1, '2020-12-09', '', 'جديد', 1, 61, 32, '', '12102_MS1018-4_1024x1024.jpg'),
(171, 'havit mouse ms952', '', '25', 1, '2020-12-09', '', 'جديد', 1, 61, 32, '', '57050_61wDiTMQjAL._AC_SS350_.jpg'),
(172, 'havit mouse hv-ms736', '', '8', 1, '2020-12-09', '', 'جديد', 1, 61, 32, '', '95001_large_3e8bf-Havit-HV-MS736BK-Mice-Havit-HV-MS736-Wired-USB2-0-Gaming-Mouse-with-LED-Black.jpg'),
(173, 'havit mouse hv-ms798', '', '16', 1, '2020-12-09', '', 'جديد', 1, 61, 32, '', '57241_HTB1P4M6XpGWBuNjy0Fbq6z4sXXa8.jpg'),
(174, 'havit mouse ms1019', '', '16', 1, '2020-12-09', '', 'جديد', 1, 61, 32, '', '18921_MS1019-2-1.jpg'),
(175, 'havit mouse ms80', '', '5', 1, '2020-12-09', '', 'جديد', 1, 61, 32, '', '30753_havit-hv-ms80-mouse-bd-500x500.jpg'),
(176, 'havit mouse hv-ms689', '', '5', 1, '2020-12-09', '', 'جديد', 1, 61, 32, '', '50881_22.jpg'),
(177, 'havit mouse hv-m54206', '', '5', 1, '2020-12-09', '', 'جديد', 1, 61, 32, '', '35656_A65-1.jpg'),
(178, 'havit mouse wireless ms882gt', '', '8', 1, '2020-12-09', '', 'جديد', 1, 61, 32, '', '75448_MS981GT_2.jpg'),
(179, 'mouse m300 roccket', '', '4', 1, '2020-12-09', '', 'جديد', 1, 61, 32, '', '34817_86223cf450b48a2b01226f1d299f2673.png'),
(180, 'razer mouse deathadder', '', '12', 1, '2020-12-09', '', 'جديد', 1, 61, 32, '', '38540_26-153-220-Z01.jpg'),
(181, 'Havit Gaming Wireless Keyboard & Mouse KB585GCM', ' كيبورت مع ماوس العاب ضوئي لاسلكي', '17', 1, '2020-12-09', '', '1', 1, 61, 32, '', '14243_938a1d24535582c21f2a18ba13109397.jpg'),
(182, 'HAVIT Backlit Mechanical Gaming Keyboard KB856L', 'كيبورت ميكانيكي ماركة HAVIT', '40', 1, '2020-12-09', '', '1', 1, 61, 32, 'Mechanical', '70225_eng_pl_RGB-Havit-KB856L-gaming-keyboard-with-stand-18831_1.jpg'),
(183, 'HAVIT Backlit Mechanical Gaming Keyboard  KB435L', 'كيبورت ميكانيكي ماركة HAVIT', '30', 1, '2020-12-09', '', '1', 1, 61, 32, 'Mechanical', '69200_KB435L白底图01.jpg'),
(184, 'HAVIT Multi-function backlit keyboard KB510L', 'كيبورت ضوئي احترافي', '12', 1, '2020-12-09', '', '1', 1, 61, 32, '', '64245_1-31.jpg'),
(185, 'KEYBOARD + MOUSE KM950 GAMING', 'كيبورت مع ماوس العاب ضوئي', '12', 1, '2020-12-09', '', '1', 1, 61, 32, '', '80562_1285ee3b14178647402055c4a8f407ac.jpg'),
(186, 'KEYBOARD + MOUSE KM950 GAMING', 'كيبورت مع ماوس العاب ضوئي', '12', 1, '2020-12-09', '', '1', 1, 61, 32, '', '99742_photo_2020-05-29_21-05-35-1.jpg'),
(187, 'TP-LINK WI-FI USB ADAPTER TL-WN725N', 'تحويلة وايفاي USB', '10', 1, '2020-12-09', '', '1', 1, 61, 32, 'WI-FI,TP-LINK,ADAPTER', '68661_de5c087ab90fd5c86b0109d2cd0835c13d382d7a.jpeg'),
(188, 'keyboard gk103', '', '18', 1, '2020-12-09', '', 'جديد', 1, 61, 32, '', '53130_51VSlYXoKnL._AC_SX425_.jpg'),
(189, 'MOUSE HAVIT HV-MS55GT WIRELESS', 'ماوس لاسلكي للمصممين من ماركة HAVIT', '18', 1, '2020-12-09', '', '1', 1, 61, 32, 'MOUSE,HAVIT', '48988_unnamed.jpg'),
(190, 'sandisk usb 3.0 64GB', 'FLASH 64GB USB 3.0 اصلي', '12', 1, '2020-12-09', '', '1', 1, 61, 32, 'USB', '15488_sandisk-cruzer-glide-3-0-usb-flash-drive-16gb-32gb-64gb-1.png'),
(191, 'hdmi 2.0 4k premium 2M', 'كيبل HDMI اصلي ', '6', 1, '2020-12-09', '', '1', 1, 61, 32, 'HDMI', '98248_scp-990uhdv_1logo (1).png'),
(193, 'MSI H310m-vdH', '', '75', 1, '2020-12-10', '', '1', 1, 28, 32, 'H310', '87111_1559310316_1481572.jpg'),
(195, 'MSI Z390 A-PRO', '', '130', 1, '2020-12-10', '', 'جديد', 1, 28, 32, 'Z390', '34143_81YOcB0sHbL._AC_SL1500_.jpg'),
(196, 'MSI MAG Z490 Tomahawk', '', '230', 1, '2020-12-10', '', 'جديد', 1, 28, 32, 'Z490', '91727_51MqCbI23LL._AC_.jpg'),
(197, 'MSI MPG Z490 Gaming Edge WI-FI', '', '235', 1, '2020-12-10', '', 'جديد', 1, 28, 32, 'Z490', '64003_ImgW.jpg'),
(198, 'MSI MEG Z490 Gaming Plus', '', '200', 1, '2020-12-10', '', 'جديد', 1, 28, 32, 'Z490', '33222_91D8uWFdGDL._AC_SL1500_.jpg'),
(199, 'MSI B450M Mortar Max', '', '120', 1, '2020-12-10', '', 'جديد', 1, 28, 32, 'B450', '88423_f443a52c4978a7b3680828aab6f92611.jpg'),
(200, 'MSI Bb450i Gaming Plus AC', '', '160', 1, '2020-12-10', '', 'جديد', 1, 28, 32, 'B450', '58775_2965917-a.jpg'),
(201, 'MSI B450 Tomahawk Max', '', '130', 1, '2020-12-10', '', 'جديد', 1, 28, 32, 'B450', '61040_iil-192976-636982.png'),
(202, 'MSI X470 Gaming Plus Max', '', '155', 1, '2020-12-10', '', 'جديد', 1, 28, 32, 'X470', '40842_91Cbp1gUy1L._AC_SL1500_.jpg'),
(203, 'MSI X570 A-PRO', '', '170', 1, '2020-12-10', '', 'جديد', 1, 28, 32, 'X570', '81900_81zOWi9F7VL._AC_SX569_.jpg'),
(204, 'MSI B550m Mortar', '', '170', 1, '2020-12-10', '', 'جديد', 1, 28, 32, 'B550', '22550_13-144-327-V12.jpg'),
(206, 'MSI MAG X570 Tomahawk WI-FI', '', '285', 1, '2020-12-10', '', 'جديد', 1, 28, 32, 'X570', '46863_A686S200706DbNp5.jpg'),
(207, 'MSI MAG X570 ACE', '', '455', 1, '2020-12-10', '', 'جديد', 1, 28, 32, 'X570', '21911_13-144-259-V06.jpg'),
(208, 'MSI TXR40 PRO WI-FI', '', '570', 1, '2020-12-10', '', 'جديد', 1, 28, 32, 'TXR40', '13786_msi_trx40_pro_wifi_motherboard_1532288.jpg'),
(209, 'ASROCK Z390 Taichi', '', '200', 1, '2020-12-10', '', 'جديد', 1, 31, 32, 'Z390', '92840_Z390 Taichi Ultimate(M1).png'),
(210, 'ASROCK Z390m PRO4', '', '140', 1, '2020-12-10', '', 'جديد', 1, 31, 32, 'Z390', '32158_71W1ZO4d5-L._AC_SX679_.jpg'),
(211, 'ASROCK Z390 Steel Legend', '', '150', 1, '2020-12-10', '', 'جديد', 1, 31, 32, 'Z390', '72915_13-157-876-V51.jpg'),
(212, 'ASROCK Z390 Extreme4', 'ATX BORD', '160', 1, '2020-12-10', 'Iraq', 'جديد', 1, 31, 32, 'Z390', '83681_907370290388AA0B9FF64D1590E3454B.jpg'),
(213, 'ASROCK H410 hvs', '', '80', 1, '2020-12-10', '', '1', 1, 31, 32, 'H410', '42517_90801759D370BAB3837E4CEF914D20A6.jpg'),
(215, 'ASROCK B460m HDV', '', '95', 1, '2020-12-10', '', '1', 1, 31, 32, 'B460', '34382_B460M-HDV(M1).png'),
(216, 'ASROCK B460m steel legend', '', '120', 1, '2020-12-10', '', '1', 1, 31, 32, 'b450', '23751_13-157-950-V08.jpg'),
(217, 'ASROCK Z490 phantom gaming 4', '', '180', 1, '2020-12-10', '', '1', 1, 31, 32, 'Z490', '38739_Z490 Phantom Gaming 4(M1).png'),
(218, 'ASROCK Z490M Pro4', '', '175', 1, '2020-12-10', '', '1', 1, 31, 32, 'Z490', '5415_Z490M Pro4(M1).png'),
(219, 'ASUS TUF X470-plus gaming', '', '150', 1, '2020-12-10', '', '1', 1, 29, 32, 'X470', '54693_ImgW (1).jpg'),
(221, 'ASROCK B450m-hdv', '', '80', 1, '2020-12-10', '', '1', 1, 31, 32, 'b450', '84395_B450M-HDV(M1).png'),
(222, 'ASROCK B450m steel legend', '', '100', 1, '2020-12-10', '', '1', 1, 31, 32, 'B450', '53479_B450M Steel Legend(M1).png'),
(223, 'ASROCK TRX40 Creator', '', '500', 1, '2020-12-10', '', '1', 1, 31, 32, 'TRX40', '23305_TRX40 Creator(M1).png'),
(224, 'ASROCK X570 steel legend', '', '220', 1, '2020-12-10', '', '1', 1, 31, 32, 'X570', '57622_907703177521BEC13D774A1F9D625E7B.jpg'),
(225, 'aorus z390 pro wifi', '', '245', 1, '2020-12-10', '', '1', 1, 30, 32, 'Z390', '2188_81ldB93kBeL._AC_SL1500_.jpg'),
(226, 'aorus z390 elite', '', '230', 1, '2020-12-10', '', '1', 1, 30, 32, 'Z390', '28398_81KiEqUgDbL._AC_SL1500_.jpg'),
(228, 'aorus x570 xtreme', '', '760', 1, '2020-12-10', '', '1', 1, 30, 32, 'X570', '72448_81cjC6qipzL._AC_SL1500_.jpg'),
(229, 'aorus x570 pro wifi', '', '260', 1, '2020-12-10', '', '1', 1, 30, 32, 'X570', '51336_81l2MT0wuYL._AC_SL1500_.jpg'),
(231, 'aorus b450 pro wifi', '', '150', 1, '2020-12-10', '', '1', 1, 30, 32, 'b450', '79906_81kcEq5tMNL._SL1500_.jpg'),
(232, 'Aorus B450m elite', '', '125', 1, '2020-12-11', 'Iraq', 'جديد', 1, 30, 32, 'b450', '50976_b450mm.png'),
(233, 'aorus Z490 Ultra	', '', '350', 1, '2020-12-11', 'Iraq', 'جديد', 1, 30, 32, 'Z490', '2531_81OhMrdFX1L._AC_SL1500_.jpg'),
(234, 'ASUS TUF Liquid Cooler 240M RGB', '', '120', 1, '2020-12-11', 'Iraq', 'جديد', 1, 63, 32, 'AIO', '81287_kv-pd.png'),
(235, ' MSI MAG CORELIQUID 240R', '', '125', 1, '2020-12-18', 'Iraq', 'جديد', 1, 63, 32, 'COOLER', '35984_product_5_20200514174401_5ebd12e12f1b3.png'),
(236, 'MSI RTX 2080 SUPER VENTUS', '', '800', 1, '2020-12-18', 'Iraq', 'جديد', 1, 37, 32, 'RTX,2080', '75327_product_4_20180919150424_5ba1f4f88c3e2.png'),
(238, 'INTEL Ci5 10400F', '', '170', 1, '2020-12-18', '', 'جديد', 1, 13, 32, '', '90867_71bdmuhAypL._AC_SL1500_-1375x1500.jpg'),
(240, 'INTEL Ci3 10100F', 'INTEL', '115', 1, '2020-12-29', 'Iraq', 'جديد', 1, 13, 32, '', '11137_bx8070110100f-image-main-600x600.jpg'),
(242, 'GALAX RTX 3060TI 8GB', 'RTX', '635', 1, '2020-12-29', 'Iraq', 'جديد', 1, 43, 32, 'RTX,3060TI', '53354_3060ti_ex_gx_box_p_all_1 (1).PNG'),
(245, 'Asus vg27aq 27inch 165hz 1ms FHD IPS G-sync', 'good', '520', 1, '2020-12-30', 'USA', 'جديد', 1, 48, 32, '', '68873_81-53iRCjcL._AC_SL1500_.jpg'),
(248, 'Asus xg27wq 27 INCH VA 1ms FHD FreeSync ', '', '550', 1, '2020-12-30', '', 'جديد', 1, 48, 32, '', '31542_P_setting_000_1_90_end_500.jpg'),
(249, 'Asus ProArt pa278qv 27 INCH 75HZ ips 5MS Adaptive FHD', '', '460', 1, '2020-12-30', '', 'جديد', 1, 48, 32, '', '61362_24-281-062-V01.jpg'),
(251, 'WD Green 1TB', '', '35', 1, '2020-12-30', '', 'جديد', 1, 33, 32, '', '77175_51B0POR9akL__03091.1602692995.PNG'),
(252, 'ASUS VG278qv 165hz 27INC TN 0.4MS GSYNC-COMP FHD', '', '490', 1, '2020-12-30', '', 'جديد', 1, 48, 32, '', '59329_P_setting_fff_1_90_end_600 (1).PNG'),
(253, ' Seagate 1TB HDD', '', '35', 1, '2020-12-30', '', 'جديد', 1, 33, 32, '', '71092_3060ti_ex_gx_box_p_all_1 (1).PNG'),
(254, 'ASUS VG248QG 165HZ 24INC TN 0.5MS ADAPTIVE FREE FHD', '', '280', 1, '2020-12-30', '', 'جديد', 1, 48, 32, '', '37272_asus_24_vg248qg_fhd_g_sync_1491890 (1).jpg'),
(257, 'ASUS VG279Q1A 165HZ 27 INCH IPS 1MS ADAPTIVE FREE FHD', '', '380', 1, '2020-12-30', '', 'جديد', 1, 48, 32, '', '44591_P_setting_000_1_90_end_500 (1).jpg'),
(258, 'ASUS VP279QGL 75HZ 27INC IPS 1MS ADAPTIVE FREE FHD', '', '270', 1, '2020-12-30', '', 'جديد', 1, 48, 32, '', '79983_91hJd8gKbjL._AC_SL1500_.jpg'),
(259, 'ASUS VG279QM 75HZ 27 INCH IPS 1MS G-SYNC COMP FREE FHD', '', '440', 1, '2020-12-30', '', 'جديد', 1, 48, 32, '', '80094_81PQfy+307L._AC_SY450_.jpg'),
(260, 'ASUS XG258Q 240HZ 25 INCH TN 1MS G-SYNC COMP  FHD', '', '460', 1, '2020-12-30', '', 'جديد', 1, 48, 32, '', '9313_h525.png'),
(261, 'ssd lexar 250gb nvme', '', '45', 1, '2020-12-30', '', 'جديد', 1, 32, 32, '', '76505_71NqCvUBapL._SL1500_.jpg'),
(262, 'ASUS VG24VQ 144HZ 24 INCH VA 1MS FREESYNC  FHD', '', '260', 1, '2020-12-30', '', 'جديد', 1, 48, 32, '', '40618_065de1073817cfe2335fafabda1827e0.jpg'),
(263, 'SSD KINGSTON 128gb nvme', '', '30', 1, '2020-12-30', '', 'جديد', 1, 32, 32, '', '62885_LD0005570038_2.jpg'),
(264, 'ASUS MB16AC 60HZ 16 INCH IPS 5MS NONTOUCH  FHD', '', '260', 1, '2020-12-30', '', 'جديد', 1, 48, 32, '', '17216_P_setting_xxx_0_90_end_692.png'),
(265, 'ASUS MB16AMT 60HZ 16 INCH IPS 5MS TOUCH  FHD', '', '390', 1, '2020-12-30', '', 'جديد', 1, 48, 32, '', '64906_P_setting_fff_1_90_end_500.jpg'),
(266, 'CASE  CL7713', '', '70', 1, '2020-12-30', 'Iraq', 'جديد', 1, 60, 32, '', '99987_123724372_10158658000069076_9006893294852374238_o-550x550.jpg'),
(267, 'CASE CL3303 W', '', '60', 1, '2020-12-30', '', 'جديد', 1, 60, 32, '', '3797_124137175_10158658434444076_6008609886212609003_o-550x550h.jpg'),
(269, 'CASE CL3303 B', '', '60', 1, '2020-12-30', '', 'جديد', 1, 60, 32, '', '49162_66 (2)-1365x2048.jpg'),
(270, 'SSD Adata 120gb', '', '25', 1, '2020-12-30', '', 'جديد', 1, 32, 32, '', '39977_ADATA-SSD-SU-650-NS38-120GB.jpg'),
(271, 'CASE CL7713 W', '', '70', 1, '2020-12-30', '', 'جديد', 1, 60, 32, '', '34215_ATX-Gaming-Case-PC-Gaming-Computer-Parts-Computer-Case-Cl-7713W-Tempered-Glass-Design.jpg'),
(272, 'SSD Adata 240gb', '', '40', 1, '2020-12-30', '', 'جديد', 1, 32, 32, '', '92221_productGallery6099.jpg'),
(273, 'SSD Adata 480gb', '', '60', 1, '2020-12-30', '', 'جديد', 1, 32, 32, '', '71969_41WzwjUI0FL._AC_.jpg'),
(274, 'CASE H250X', '', '60', 1, '2020-12-30', '', 'جديد', 1, 60, 32, '', '52886_H250X_main3.jpg'),
(275, 'CASE F922', '', '130', 1, '2020-12-30', '', 'جديد', 1, 60, 32, '', '11055_F922-1.jpg'),
(276, 'CASE FALCON B700', '', '45', 1, '2020-12-30', '', 'جديد', 1, 60, 32, '', '34179_photo_2020-11-18_13-52-36-550x550h.jpg'),
(277, 'AMD Ryzen™ 5 5600X', '', '350', 1, '2020-12-30', '', 'جديد', 1, 14, 32, '', '14845_61vGQNUEsGL._AC_SX466_.jpg'),
(278, 'CASE GANK 5 B', '', '60', 1, '2020-12-30', '', 'جديد', 1, 60, 32, '', '14772_lLgdVnYF1596530293-700x700.jpg'),
(279, ' ASRock B550 Steel Legend', '', '175', 1, '2020-12-30', '', 'جديد', 1, 31, 32, '', '59599_B550 Steel Legend(M1).png'),
(280, 'CASE GANK 5 W', '', '60', 1, '2020-12-30', '', 'جديد', 1, 60, 32, '', '37713_f7c3c48c8fe775e28bfa019ca7eb1921.jpg'),
(281, 'CASE JNP ALEXANDER C3908 B 6 FAN', '', '80', 1, '2020-12-30', '', 'جديد', 1, 60, 32, '', '24020_H9cd3c9d047d84ca59e839316c7ef7897U.jpg'),
(282, 'CASE JNP ALEXANDER C3908 W 6 FAN', '', '80', 1, '2020-12-30', '', 'جديد', 1, 60, 32, '', '1464_Cover-707x707-17.png'),
(283, 'CASE ABKO H300G', '', '80', 1, '2020-12-30', '', 'جديد', 1, 60, 32, '', '20705_helios_300G_main21 (1).jpg'),
(284, 'CASE SATE K381 8 FAN', '', '80', 1, '2020-12-30', '', 'جديد', 1, 60, 32, '', '22954_unnamed.png'),
(285, 'CASE SATE K870 8 FAN', '', '55', 1, '2020-12-30', '', 'جديد', 1, 60, 32, '', '29891_unnamed (2).png'),
(287, 'CASE SATE K874', '', '60', 1, '2020-12-30', '', 'جديد', 1, 60, 32, '', '37975_H7bf72c34844947999b3c73fd1c738c9fi.jpg_640x640.jpg'),
(288, 'CASE DIM21 W', '', '60', 1, '2020-12-30', '', 'جديد', 1, 60, 32, '', '98377_614kqm3zOYL._AC_SL1500_.jpg'),
(290, 'CASE DIM21 B', '', '60', 1, '2020-12-30', '', 'جديد', 1, 60, 32, '', '41913_71djTWPq8bL._AC_SL1500_.jpg'),
(292, 'CASE AIGO BF1', '', '60', 1, '2020-12-31', '', 'جديد', 1, 60, 32, '', '87071_1.jpg'),
(293, 'CASE Xigmatek Aquarius Plus BLACK', '', '120', 1, '2020-12-31', '', 'جديد', 1, 60, 32, '', '99084_04acebcacd7c773f9f1402a972c09165-hi.jpg'),
(294, 'CASE Xigmatek Aquarius Plus WHITE', '', '125', 1, '2020-12-31', '', 'جديد', 1, 60, 32, '', '21941_aquaplus1.png'),
(295, 'COOLER H240 RGP ALSEYE', '', '80', 1, '2020-12-31', '', 'جديد', 1, 63, 32, '', '76075_88885487.jpg'),
(297, 'RTX 3070 TWIN X2', '', '750', 1, '2020-12-31', '', 'جديد', 1, 60, 32, '', '17546_products_id_564_1.png'),
(298, 'COOLER H360 RGP ALSEYE', '', '90', 1, '2020-12-31', '', 'جديد', 1, 63, 32, '', '42398_88885486.jpg'),
(299, 'Seagate BarraCuda 1TB', '', '45', 1, '2020-12-31', '', 'جديد', 1, 33, 32, '', '220_TB2HUU7o98mpuFjSZFMXXaxpVXa_!!39602566.jpg'),
(301, ' Seagate 2TB Sky Hawk', '', '65', 1, '2020-12-31', '', 'جديد', 1, 33, 32, '', '69137_seagate-skyhawk-2tb-1.jpg'),
(303, 'COOLER H120D RGP ALSEYE', '', '35', 1, '2020-12-31', '', 'جديد', 1, 63, 32, '', '58661_ALSEYE-H120D-RGB-120-PWM-4.jpg_q50.jpg'),
(304, 'COOLER FP-301 RGP FANTECH', '', '25', 1, '2020-12-31', '', 'جديد', 1, 61, 32, '', '59944_2020062910372440875_1 (1).jpg'),
(305, 'COOLER DR12 PRO RGP DARCKFLASH', '', '25', 1, '2020-12-31', '', 'جديد', 1, 61, 32, '', '44719_unnamed.jpg'),
(306, 'COOLER PCCOOLER HELO RGP', '', '30', 1, '2020-12-31', '', 'جديد', 1, 61, 32, '', '88520_ventilyator_dlya_korpusa_pccooler_halo_rgb_kit_120x120x25mm_1000_2000_rpm_989320_1.jpg'),
(307, 'CASE Xigmatek Zest', '', '120', 1, '2021-01-03', '', 'جديد', 1, 60, 32, '', '52630_zip_20190102172701340.jpg'),
(308, 'xigmatek windpower AIR COOLER', '', '40', 1, '2021-01-03', '', 'جديد', 1, 63, 32, '', '63290_233629335.jpeg');

-- --------------------------------------------------------

--
-- بنية الجدول `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `address` text NOT NULL,
  `product` varchar(255) NOT NULL,
  `amount_paid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL COMMENT 'To identify User ',
  `Username` varchar(255) NOT NULL COMMENT 'User name To Login',
  `Password` varchar(255) NOT NULL COMMENT 'Password To login',
  `Email` varchar(255) NOT NULL,
  `FullName` varchar(255) NOT NULL,
  `GroupID` int(11) NOT NULL DEFAULT 0 COMMENT 'identify User Group',
  `TrustStatus` int(11) NOT NULL DEFAULT 0 COMMENT 'Seller Rank',
  `RegStatus` int(11) NOT NULL DEFAULT 0 COMMENT 'User Approval',
  `Date` date NOT NULL,
  `avatar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Password`, `Email`, `FullName`, `GroupID`, `TrustStatus`, `RegStatus`, `Date`, `avatar`) VALUES
(26, 'pro', '492ffc24f175ac8d2dcb6eb5bfaa7be73c61a0e9', 'ibrahimaa9@gmail.com', 'Ibrahim Abd Al-Razak', 1, 0, 1, '2020-09-01', ''),
(32, 'ibrahim', '8250a1abf3fc19f45bd40c26741061db5f0509e6', 'ibrahimaa9@gmail.com', 'Ibrahim Abd Al-Razak', 0, 0, 1, '2020-12-04', '29940_43590368_729849230682851_103712658355650560_o.png'),
(33, 'hassan', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'hassan@gmali.com', 'hadi', 1, 0, 0, '0000-00-00', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `items_comment` (`item_id`),
  ADD KEY `comment_user` (`user_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`Item_ID`),
  ADD KEY `member_1` (`Member_ID`),
  ADD KEY `cat_1` (`Cat_ID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `Item_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=310;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'To identify User ', AUTO_INCREMENT=34;

--
-- قيود الجداول المُلقاة.
--

--
-- قيود الجداول `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comment_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `items_comment` FOREIGN KEY (`item_id`) REFERENCES `items` (`Item_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- قيود الجداول `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `cat_1` FOREIGN KEY (`Cat_ID`) REFERENCES `categories` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `member_1` FOREIGN KEY (`Member_ID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
