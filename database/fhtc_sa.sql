-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 21, 2025 at 08:58 AM
-- Server version: 8.4.5
-- PHP Version: 8.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `joodta5_fhtc.sa`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `crsId` int NOT NULL,
  `crsNameEn` varchar(255) NOT NULL,
  `crsNameAr` varchar(255) NOT NULL,
  `typId` int NOT NULL,
  `crsDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `spcId` int DEFAULT NULL,
  `spcSubId` int DEFAULT NULL,
  `crsPrice` decimal(10,2) NOT NULL,
  `crsStatus` tinyint NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`crsId`, `crsNameEn`, `crsNameAr`, `typId`, `crsDate`, `spcId`, `spcSubId`, `crsPrice`, `crsStatus`) VALUES
(1, 'Course Name', 'اسم الدورة', 1, '2025-08-21 08:05:43', 1, 30, 150.30, 1);

-- --------------------------------------------------------

--
-- Table structure for table `courses__inparson`
--

CREATE TABLE `courses__inparson` (
  `crsId` int NOT NULL,
  `crsInId` int NOT NULL,
  `crsInCreditHoursNumber` int DEFAULT NULL COMMENT 'عدد الساعات المعتمدة',
  `crsInAccreditationNumber` int DEFAULT NULL COMMENT 'رقم الإعتماد',
  `crsInLecturer` json NOT NULL COMMENT 'المحاضرين',
  `crsInImageAr` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT 'بروشور الدورة للعربي',
  `crsInImageEn` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT 'بروشور الدورة للإنجليزي',
  `crsInLocation` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL COMMENT 'موقع إنعقاد الدورة',
  `lctDateStart` date NOT NULL COMMENT 'تاريخ البدأ',
  `lctDateEnd` date NOT NULL COMMENT 'تاريخ النهاية',
  `lctTimeStart` time NOT NULL COMMENT 'وقت البدأ',
  `lctTimeEnd` time NOT NULL COMMENT 'وقت الإنتهاء',
  `lctStatus` int NOT NULL DEFAULT '1' COMMENT 'حالة التسجيل',
  `crsInSummaryEn` mediumtext CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT 'ملخص إنجليزي',
  `crsInSummaryAr` mediumtext CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT 'ملخص عربي',
  `crsInDetailsAr` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT 'تفاصيل عربي',
  `crsInDetailsEn` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT 'تفاصيل إنجليزي',
  `crsInTimeTableEn` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci COMMENT 'الجدول الزمني إنجليزي',
  `crsInTimeTableAr` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci COMMENT 'الجدول الزمني عربي',
  `crsInAttachment` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL COMMENT 'رابط مرفق بعد التسجيل'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `invoice__body`
--

CREATE TABLE `invoice__body` (
  `invId` int NOT NULL,
  `invItmId` int NOT NULL,
  `crsId` int NOT NULL,
  `crsQty` int NOT NULL DEFAULT '0',
  `crsPrice` decimal(6,2) NOT NULL DEFAULT '0.00',
  `crsTotal` decimal(6,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `invoice__body`
--

INSERT INTO `invoice__body` (`invId`, `invItmId`, `crsId`, `crsQty`, `crsPrice`, `crsTotal`) VALUES
(2, 1, 1, 1, 287.50, 287.50),
(3, 2, 1, 1, 23.00, 23.00);

-- --------------------------------------------------------

--
-- Table structure for table `invoice__header`
--

CREATE TABLE `invoice__header` (
  `usrId` int NOT NULL,
  `invId` int NOT NULL,
  `invDateTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `invAmountPrice` decimal(6,2) NOT NULL DEFAULT '0.00',
  `invAmountTax` decimal(6,2) NOT NULL DEFAULT '0.00',
  `invAmountTotal` decimal(6,2) NOT NULL DEFAULT '0.00',
  `invTransaction` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `trnStatus` varchar(255) DEFAULT NULL,
  `trnAmount` decimal(6,2) DEFAULT '0.00',
  `trnMessage` varchar(255) DEFAULT NULL,
  `invStatus` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `invoice__header`
--

INSERT INTO `invoice__header` (`usrId`, `invId`, `invDateTime`, `invAmountPrice`, `invAmountTax`, `invAmountTotal`, `invTransaction`, `trnStatus`, `trnAmount`, `trnMessage`, `invStatus`) VALUES
(1, 2, '2025-01-23 08:37:06', 571.50, 85.73, 571.50, '{\"id\":\"57ec4f45-4575-4243-8ab4-59a14763b87c\",\"status\":\"paid\",\"amount\":\"57150\",\"message\":\"APPROVED\"}', 'paid', 230.00, 'APPROVED', 5),
(16, 3, '2025-01-23 08:37:54', 200.00, 30.00, 230.00, '{\"id\":\"57ec4f45-4575-4243-8ab4-59a14763b87c\",\"status\":\"paid\",\"amount\":\"57150\",\"message\":\"APPROVED\"}', 'paid', 230.00, 'APPROVED', 0);

-- --------------------------------------------------------

--
-- Table structure for table `lookup__countries`
--

CREATE TABLE `lookup__countries` (
  `cntId` int NOT NULL,
  `cntAlpha2` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `cntAlpha3` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `cntNameAr` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `cntNameEn` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `cntCurNameAr` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `cntCurNameEn` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `cntCurCode` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `cntCurDefault` bit(1) NOT NULL DEFAULT b'0',
  `cntDefault` bit(1) NOT NULL DEFAULT b'0',
  `cntStatus` bit(1) NOT NULL DEFAULT b'0',
  `cntCurStatus` bit(1) NOT NULL DEFAULT b'0',
  `cntLng` varchar(10) DEFAULT NULL,
  `cntDir` varchar(10) DEFAULT 'ltr',
  `cntOrder` int NOT NULL DEFAULT '100'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lookup__countries`
--

INSERT INTO `lookup__countries` (`cntId`, `cntAlpha2`, `cntAlpha3`, `cntNameAr`, `cntNameEn`, `cntCurNameAr`, `cntCurNameEn`, `cntCurCode`, `cntCurDefault`, `cntDefault`, `cntStatus`, `cntCurStatus`, `cntLng`, `cntDir`, `cntOrder`) VALUES
(1, NULL, NULL, 'أكروتيري ودهكيليا', 'Akrotiri and Dhekelia', 'يورو', 'Euro', 'EUR', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(2, NULL, NULL, 'أرض الصومال', 'Somaliland', 'شيلينغ صومالي', 'Somaliland Shilling', 'SOS', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(3, NULL, NULL, 'ويلز', 'Wales', 'لا يوجد عملة', 'No currency', NULL, b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(4, 'AD', 'AND', 'أندورا', 'Andorra', 'يورو', 'Euro', 'EUR', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(5, 'AE', 'ARE', 'الإمارات العربية المتحدة', 'United Arab Emirates', 'درهم إماراتي', 'UAE Dirham', 'AED', b'0', b'0', b'0', b'1', 'en', 'ltr', 400),
(6, 'AF', 'AFG', 'أفغانستان', 'Afghanistan', 'أفغاني', 'Afghan Afghani', 'AFN', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(7, 'AG', 'ATG', 'أنتيغوا وبربودا', 'Antigua and Barbuda', 'دولار شرق الكاريبي', 'East Caribbean Dollar', 'XCD', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(8, 'AI', 'AIA', 'أنغويلا', 'Anguilla', 'دولار شرق الكاريبي', 'East Caribbean Dollar', 'XCD', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(9, 'AL', 'ALB', 'ألبانيا', 'Albania', 'ليك', 'Albanian Lek', 'ALL', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(10, 'AM', 'ARM', 'أرمينيا', 'Armenia', 'درام أرميني', 'Armenian Dram', 'AMD', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(11, 'AO', 'AGO', 'أنغولا', 'Angola', 'كوانزا أنغولي', 'Angolan Kwanza', 'AOA', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(12, 'AQ', 'ATA', 'أنتاركتيكا', 'Antarctica', 'لا يوجد عملة', 'No currency', NULL, b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(13, 'AR', 'ARG', 'الأرجنتين', 'Argentina', 'بيزو أرجنتيني', 'Argentine Peso', 'ARS', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(14, 'AS', 'ASM', 'ساموا الأمريكية', 'American Samoa', 'دولار ساموا الأمريكية', 'US Dollar', 'USD', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(15, 'AT', 'AUT', 'النمسا', 'Austria', 'يورو', 'Euro', 'EUR', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(16, 'AU', 'AUS', 'أستراليا', 'Australia', 'دولار أسترالي', 'Australian Dollar', 'AUD', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(17, 'AW', 'ABW', 'أروبا', 'Aruba', 'فلورين أروبي', 'Aruban Florin', 'AWG', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(18, 'AX', 'ALA', 'جزر آلاند', 'Åland Islands', 'يورو', 'Euro', 'EUR', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(19, 'AZ', 'AZE', 'أذربيجان', 'Azerbaijan', 'مانات أذربيجاني', 'Azerbaijani Manat', 'AZN', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(20, 'BA', 'BIH', 'البوسنة والهرسك', 'Bosnia and Herzegovina', 'مارك بوسني', 'Bosnia-Herzegovina Convertible Mark', 'BAM', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(21, 'BB', 'BRB', 'بربادوس', 'Barbados', 'دولار بربادوسي', 'Barbadian Dollar', 'BBD', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(22, 'BD', 'BGD', 'بنغلاديش', 'Bangladesh', 'تاكا بنغلاديشي', 'Bangladeshi Taka', 'BDT', b'0', b'0', b'1', b'0', 'bn', 'ltr', 100),
(23, 'BE', 'BEL', 'بلجيكا', 'Belgium', 'يورو', 'Euro', 'EUR', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(24, 'BF', 'BFA', 'بوركينا فاسو', 'Burkina Faso', 'فرنك غرب أفريقي', 'West African CFA Franc', 'XOF', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(25, 'BG', 'BGR', 'بلغاريا', 'Bulgaria', 'ليف بلغاري', 'Bulgarian Lev', 'BGN', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(26, 'BH', 'BHR', 'البحرين', 'Bahrain', 'دينار بحريني', 'Bahraini Dinar', 'BHD', b'0', b'0', b'0', b'1', 'en', 'ltr', 300),
(27, 'BI', 'BDI', 'بوروندي', 'Burundi', 'فرنك بوروندي', 'Burundian Franc', 'BIF', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(28, 'BJ', 'BEN', 'بنين', 'Benin', 'فرنك غرب أفريقي', 'West African CFA Franc', 'XOF', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(29, 'BL', 'BLM', 'سانت بارتيليمي', 'Saint Barthélemy', 'يورو', 'Euro', 'EUR', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(30, 'BM', 'BMU', 'برمودا', 'Bermuda', 'دولار برمودي', 'Bermudan Dollar', 'BMD', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(31, 'BN', 'BRN', 'بروناي', 'Brunei', 'دولار بروناي', 'Brunei Dollar', 'BND', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(32, 'BO', 'BOL', 'بوليفيا', 'Bolivia', 'بوليفيانو', 'Boliviano', 'BOB', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(33, 'BQ', 'BES', 'بونير', 'Bonaire', 'دولار أمريكي', 'US Dollar', 'USD', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(34, 'BR', 'BRA', 'البرازيل', 'Brazil', 'ريال برازيلي', 'Brazilian Real', 'BRL', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(35, 'BS', 'BHS', 'جزر البهاما', 'Bahamas', 'دولار بهامي', 'Bahamian Dollar', 'BSD', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(36, 'BT', 'BTN', 'بوتان', 'Bhutan', 'نغولترم بوتاني', 'Bhutanese Ngultrum', 'BTN', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(37, 'BW', 'BWA', 'بوتسوانا', 'Botswana', 'بولا بوتسواني', 'Botswanan Pula', 'BWP', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(38, 'BY', 'BLR', 'روسيا البيضاء', 'Belarus', 'روبل بيلاروسي', 'Belarusian Ruble', 'BYN', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(39, 'BZ', 'BLZ', 'بليز', 'Belize', 'دولار بليزي', 'Belize Dollar', 'BZD', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(40, 'CA', 'CAN', 'كندا', 'Canada', 'دولار كندي', 'Canadian Dollar', 'CAD', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(41, 'CC', 'CCK', 'جزر كوكوس (كيلينغ)', 'Cocos (Keeling) Islands', 'دولار أسترالي', 'Australian Dollar', 'AUD', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(42, 'CD', 'COD', 'جمهورية الكونغو الديمقراطية', 'Democratic Republic of the Congo', 'فرنك كونغولي', 'Congolese Franc', 'CDF', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(43, 'CF', 'CAF', 'جمهورية أفريقيا الوسطى', 'Central African Republic', 'فرنك وسط أفريقيا', 'Central African CFA Franc', 'XAF', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(44, 'CG', 'COG', 'الكونغو', 'Congo', 'فرنك وسط أفريقيا', 'Central African CFA Franc', 'XAF', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(45, 'CH', 'CHE', 'سويسرا', 'Switzerland', 'فرنك سويسري', 'Swiss Franc', 'CHF', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(46, 'CK', 'COK', 'جزر كوك', 'Cook Islands', 'دولار جزر كوك', 'Cook Islands Dollar', 'CKD', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(47, 'CL', 'CHL', 'تشيلي', 'Chile', 'بيزو تشيلي', 'Chilean Peso', 'CLP', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(48, 'CM', 'CMR', 'الكاميرون', 'Cameroon', 'فرنك وسط أفريقيا', 'Central African CFA Franc', 'XAF', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(49, 'CN', 'CHN', 'الصين', 'China', 'يوان صيني', 'Chinese Yuan', 'CNY', b'0', b'0', b'1', b'0', 'zh', 'ltr', 100),
(50, 'CO', 'COL', 'كولومبيا', 'Colombia', 'بيزو كولومبي', 'Colombian Peso', 'COP', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(51, 'CR', 'CRI', 'كوستاريكا', 'Costa Rica', 'كولون كوستاريكي', 'Costa Rican Colón', 'CRC', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(52, 'CU', 'CUB', 'كوبا', 'Cuba', 'بيزو كوبي', 'Cuban Peso', 'CUP', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(53, 'CV', 'CPV', 'الرأس الأخضر', 'Cape Verde', 'اسكودو الرأس الأخضر', 'Cape Verdean Escudo', 'CVE', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(54, 'CW', 'CUW', 'كوراساو', 'Curaçao', 'فلورين جزر الأنتيل الهولندية', 'Netherlands Antillean Guilder', 'ANG', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(55, 'CX', 'CXR', 'جزيرة عيد الميلاد', 'Christmas Island', 'دولار أسترالي', 'Australian Dollar', 'AUD', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(56, 'CY', 'CYP', 'قبرص', 'Cyprus', 'يورو', 'Euro', 'EUR', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(57, 'CZ', 'CZE', 'جمهورية التشيك', 'Czech Republic', 'كرونة تشيكية', 'Czech Koruna', 'CZK', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(58, 'DJ', 'DJI', 'جيبوتي', 'Djibouti', 'فرنك جيبوتي', 'Djiboutian Franc', 'DJF', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(59, 'DK', 'DNK', 'الدنمارك', 'Denmark', 'كرونة دانمركية', 'Danish Krone', 'DKK', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(60, 'DM', 'DMA', 'الدومينيكا', 'Dominica', 'دولار شرق الكاريبي', 'East Caribbean Dollar', 'XCD', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(61, 'DO', 'DOM', 'جمهورية الدومينيكان', 'Dominican Republic', 'بيزو دومنيكاني', 'Dominican Peso', 'DOP', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(62, 'DZ', 'DZA', 'الجزائر', 'Algeria', 'دينار جزائري', 'Algerian Dinar', 'DZD', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(63, 'EC', 'ECU', 'الإكوادور', 'Ecuador', 'دولار أمريكي', 'US Dollar', 'USD', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(64, 'EE', 'EST', 'إستونيا', 'Estonia', 'يورو', 'Euro', 'EUR', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(65, 'EG', 'EGY', 'مصر', 'Egypt', 'جنيه مصري', 'Egyptian Pound', 'EGP', b'0', b'0', b'0', b'1', 'en', 'ltr', 500),
(66, 'EH', 'ESH', 'الصحراء الغربية', 'Western Sahara', 'درهم مغربي', 'Moroccan Dirham', 'MAD', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(67, 'ER', 'ERI', 'إريتريا', 'Eritrea', 'ناكفا إريتري', 'Eritrean Nakfa', 'ERN', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(68, 'ES', 'ESP', 'إسبانيا', 'Spain', 'يورو', 'Euro', 'EUR', b'0', b'0', b'1', b'0', 'es', 'ltr', 100),
(69, 'ET', 'ETH', 'إثيوبيا', 'Ethiopia', 'بير إثيوبي', 'Ethiopian Birr', 'ETB', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(70, 'FI', 'FIN', 'فنلندا', 'Finland', 'يورو', 'Euro', 'EUR', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(71, 'FJ', 'FJI', 'فيجي', 'Fiji', 'دولار فيجي', 'Fijian Dollar', 'FJD', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(72, 'FK', 'FLK', 'جزر فوكلاند', 'Falkland Islands', 'جنيه جزر فوكلاند', 'Falkland Islands Pound', 'FKP', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(73, 'FM', 'FSM', 'ميكرونيزيا', 'Micronesia', 'دولار أمريكي', 'US Dollar', 'USD', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(74, 'FO', 'FRO', 'جزر فارو', 'Faroe Islands', 'كرونة فاروية', 'Faroese Króna', 'FOK', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(75, 'FR', 'FRA', 'فرنسا', 'France', 'يورو', 'Euro', 'EUR', b'0', b'0', b'1', b'0', 'fr', 'ltr', 100),
(76, 'GA', 'GAB', 'الغابون', 'Gabon', 'فرنك وسط أفريقيا', 'Central African CFA Franc', 'XAF', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(77, 'GB', 'GBR', 'المملكة المتحدة', 'United Kingdom', 'جنيه إسترليني', 'British Pound', 'GBP', b'0', b'0', b'0', b'1', 'en', 'ltr', 800),
(78, 'GE', 'GEO', 'جورجيا', 'Georgia', 'لاري جورجي', 'Georgian Lari', 'GEL', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(79, 'GF', 'GUF', 'غيانا الفرنسية', 'French Guiana', 'يورو', 'Euro', 'EUR', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(80, 'GG', 'GGY', 'غيرنسي', 'Guernsey', 'جنيه غيرنسي', 'Guernsey Pound', 'GGP', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(81, 'GM', 'GMB', 'غامبيا', 'Gambia', 'دالاسي غامبي', 'Gambian Dalasi', 'GMD', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(82, 'GP', 'GLP', 'غوادلوب', 'Guadeloupe', 'يورو', 'Euro', 'EUR', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(83, 'GQ', 'GNQ', 'غينيا الاستوائية', 'Equatorial Guinea', 'فرنك وسط أفريقيا', 'Central African CFA Franc', 'XAF', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(84, 'GS', 'SGS', 'جنوب جورجيا وجزر ساندويتش الجنوبية', 'South Georgia and the South Sandwich Islands', 'لا يوجد عملة', 'No currency', NULL, b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(85, 'GU', 'GUM', 'غوام', 'Guam', 'دولار أمريكي', 'US Dollar', 'USD', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(86, 'GY', 'GUY', 'غيانا', 'Guyana', 'دولار غياني', 'Guyanese Dollar', 'GYD', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(87, 'HK', 'HKG', 'هونغ كونغ', 'Hong Kong', 'دولار هونغ كونغ', 'Hong Kong Dollar', 'HKD', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(88, 'HM', 'HMD', 'جزيرة هيرد وجزر ماكدونالد', 'Heard Island and McDonald Islands', 'لا يوجد عملة', 'No currency', NULL, b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(89, 'HN', 'HND', 'هندوراس', 'Honduras', 'ليمبيرا هندوراسي', 'Honduran Lempira', 'HNL', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(90, 'HR', 'HRV', 'كرواتيا', 'Croatia', 'كونا كرواتي', 'Croatian Kuna', 'HRK', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(91, 'HT', 'HTI', 'هايتي', 'Haiti', 'جورد هايتي', 'Haitian Gourde', 'HTG', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(92, 'HU', 'HUN', 'المجر', 'Hungary', 'فورنت هنغاري', 'Hungarian Forint', 'HUF', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(93, 'ID', 'IDN', 'إندونيسيا', 'Indonesia', 'روبية إندونيسية', 'Indonesian Rupiah', 'IDR', b'0', b'0', b'1', b'0', 'id', 'ltr', 100),
(94, 'IE', 'IRL', 'أيرلندا', 'Ireland', 'يورو', 'Euro', 'EUR', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(95, 'IL', 'ISR', 'إسرائيل', 'Israel', 'شيكل إسرائيلي جديد', 'Israeli New Shekel', 'ILS', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(96, 'IM', 'IMN', 'جزيرة مان', 'Isle of Man', 'جنيه مانكس', 'Manx Pound', 'IMP', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(97, 'IN', 'IND', 'الهند', 'India', 'روبية هندية', 'Indian Rupee', 'INR', b'0', b'0', b'1', b'0', 'hi', 'ltr', 100),
(98, 'IQ', 'IRQ', 'العراق', 'Iraq', 'دينار عراقي', 'Iraqi Dinar', 'IQD', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(99, 'IR', 'IRN', 'إيران', 'Iran', 'ريال إيراني', 'Iranian Rial', 'IRR', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(100, 'IS', 'ISL', 'آيسلندا', 'Iceland', 'كرونة آيسلندية', 'Icelandic Króna', 'ISK', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(101, 'IT', 'ITA', 'إيطاليا', 'Italy', 'يورو', 'Euro', 'EUR', b'0', b'0', b'0', b'0', 'en', 'ltr', 900),
(102, 'JE', 'JEY', 'جيرسي', 'Jersey', 'جنيه جيرسي', 'Jersey Pound', 'JEP', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(103, 'JM', 'JAM', 'جامايكا', 'Jamaica', 'دولار جامايكي', 'Jamaican Dollar', 'JMD', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(104, 'JO', 'JOR', 'الأردن', 'Jordan', 'دينار أردني', 'Jordanian Dinar', 'JOD', b'0', b'0', b'0', b'1', 'en', 'ltr', 600),
(105, 'JP', 'JPN', 'اليابان', 'Japan', 'ين ياباني', 'Japanese Yen', 'JPY', b'0', b'0', b'1', b'0', 'ja', 'ltr', 100),
(106, 'KE', 'KEN', 'كينيا', 'Kenya', 'شيلينغ كيني', 'Kenyan Shilling', 'KES', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(107, 'KG', 'KGZ', 'قيرغيزستان', 'Kyrgyzstan', 'سوم قيرغيزستاني', 'Kyrgyzstani Som', 'KGS', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(108, 'KH', 'KHM', 'كمبوديا', 'Cambodia', 'ريال كمبودي', 'Cambodian Riel', 'KHR', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(109, 'KI', 'KIR', 'كيريباتي', 'Kiribati', 'دولار أسترالي', 'Australian Dollar', 'AUD', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(110, 'KM', 'COM', 'جزر القمر', 'Comoros', 'فرنك قمري', 'Comorian Franc', 'KMF', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(111, 'KN', 'KNA', 'سانت كيتس ونيفيس', 'Saint Kitts and Nevis', 'دولار شرق الكاريبي', 'East Caribbean Dollar', 'XCD', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(112, 'KP', 'PRK', 'كوريا الشمالية', 'North Korea', 'وون كوري شمالي', 'North Korean Won', 'KPW', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(113, 'KR', 'KOR', 'كوريا الجنوبية', 'South Korea', 'وون كوري جنوبي', 'South Korean Won', 'KRW', b'0', b'0', b'1', b'0', 'ko', 'ltr', 100),
(114, 'KW', 'KWT', 'الكويت', 'Kuwait', 'دينار كويتي', 'Kuwaiti Dinar', 'KWD', b'0', b'0', b'0', b'1', 'en', 'ltr', 700),
(115, 'KY', 'CYM', 'جزر كايمان', 'Cayman Islands', 'دولار جزر كايمان', 'Cayman Islands Dollar', 'KYD', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(116, 'KZ', 'KAZ', 'كازاخستان', 'Kazakhstan', 'تينغ كازاخستاني', 'Kazakhstani Tenge', 'KZT', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(117, 'LA', 'LAO', 'لاوس', 'Laos', 'كيب لاوسي', 'Lao Kip', 'LAK', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(118, 'LB', 'LBN', 'لبنان', 'Lebanon', 'ليرة لبنانية', 'Lebanese Pound', 'LBP', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(119, 'LC', 'LCA', 'سانت لوسيا', 'Saint Lucia', 'دولار شرق الكاريبي', 'East Caribbean Dollar', 'XCD', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(120, 'LI', 'LIE', 'ليختنشتاين', 'Liechtenstein', 'فرنك سويسري', 'Swiss Franc', 'CHF', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(121, 'LK', 'LKA', 'سريلانكا', 'Sri Lanka', 'روبية سريلانكية', 'Sri Lankan Rupee', 'LKR', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(122, 'LR', 'LBR', 'ليبيريا', 'Liberia', 'دولار ليبيري', 'Liberian Dollar', 'LRD', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(123, 'LS', 'LSO', 'ليسوتو', 'Lesotho', 'لوتي ليسوتو', 'Lesotho Loti', 'LSL', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(124, 'LT', 'LTU', 'ليتوانيا', 'Lithuania', 'يورو', 'Euro', 'EUR', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(125, 'LU', 'LUX', 'لوكسمبورغ', 'Luxembourg', 'يورو', 'Euro', 'EUR', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(126, 'LV', 'LVA', 'لاتفيا', 'Latvia', 'يورو', 'Euro', 'EUR', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(127, 'LY', 'LBY', 'ليبيا', 'Libya', 'دينار ليبي', 'Libyan Dinar', 'LYD', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(128, 'MA', 'MAR', 'المغرب', 'Morocco', 'درهم مغربي', 'Moroccan Dirham', 'MAD', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(129, 'MC', 'MCO', 'موناكو', 'Monaco', 'يورو', 'Euro', 'EUR', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(130, 'MD', 'MDA', 'مولدوفا', 'Moldova', 'ليو مولدوفي', 'Moldovan Leu', 'MDL', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(131, 'ME', 'MNE', 'الجبل الأسود', 'Montenegro', 'يورو', 'Euro', 'EUR', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(132, 'MF', 'MAF', 'سانت مارتن', 'Saint Martin (French part)', 'يورو', 'Euro', 'EUR', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(133, 'MG', 'MDG', 'مدغشقر', 'Madagascar', 'أرياري ملغاشي', 'Malagasy Ariary', 'MGA', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(134, 'MH', 'MHL', 'جزر مارشال', 'Marshall Islands', 'دولار أمريكي', 'US Dollar', 'USD', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(135, 'MK', 'MKD', 'مقدونيا الشمالية', 'North Macedonia', 'دينار مقدوني', 'North Macedonian Denar', 'MKD', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(136, 'ML', 'MLI', 'مالي', 'Mali', 'فرنك غرب أفريقي', 'West African CFA Franc', 'XOF', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(137, 'MM', 'MMR', 'ميانمار', 'Myanmar', 'كيات ميانماري', 'Myanma Kyat', 'MMK', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(138, 'MN', 'MNG', 'منغوليا', 'Mongolia', 'توغروغ منغولي', 'Mongolian Tögrög', 'MNT', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(139, 'MO', 'MAC', 'ماكاو', 'Macao', 'باتاكا ماكاوية', 'Macanese Pataca', 'MOP', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(140, 'MP', 'MNP', 'جزر ماريانا الشمالية', 'Northern Mariana Islands', 'دولار أمريكي', 'US Dollar', 'USD', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(141, 'MQ', 'MTQ', 'مارتينيك', 'Martinique', 'يورو', 'Euro', 'EUR', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(142, 'MR', 'MRT', 'موريتانيا', 'Mauritania', 'أوقية موريتانية', 'Mauritanian Ouguiya', 'MRU', b'0', b'0', b'1', b'0', 'ar', 'rtl', 100),
(143, 'MS', 'MSR', 'مونتسيرات', 'Montserrat', 'دولار شرق الكاريبي', 'East Caribbean Dollar', 'XCD', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(144, 'MT', 'MLT', 'مالطا', 'Malta', 'يورو', 'Euro', 'EUR', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(145, 'MU', 'MUS', 'موريشيوس', 'Mauritius', 'روبية موريشيوسية', 'Mauritian Rupee', 'MUR', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(146, 'MV', 'MDV', 'جزر المالديف', 'Maldives', 'روفيا مالديفية', 'Maldivian Rufiyaa', 'MVR', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(147, 'MW', 'MWI', 'مالاوي', 'Malawi', 'كواشا ملاوي', 'Malawian Kwacha', 'MWK', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(148, 'MX', 'MEX', 'المكسيك', 'Mexico', 'بيزو مكسيكي', 'Mexican Peso', 'MXN', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(149, 'MY', 'MYS', 'ماليزيا', 'Malaysia', 'رينغيت ماليزي', 'Malaysian Ringgit', 'MYR', b'0', b'0', b'1', b'0', 'ms', 'ltr', 100),
(150, 'MZ', 'MOZ', 'موزمبيق', 'Mozambique', 'ميتيكال موزمبيقي', 'Mozambican Metical', 'MZN', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(151, 'NA', 'NAM', 'ناميبيا', 'Namibia', 'دولار ناميبي', 'Namibian Dollar', 'NAD', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(152, 'NC', 'NCL', 'كاليدونيا الجديدة', 'New Caledonia', 'فرنك فرنسي', 'CFP Franc', 'XPF', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(153, 'NE', 'NER', 'النيجر', 'Niger', 'فرنك غرب أفريقي', 'West African CFA Franc', 'XOF', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(154, 'NF', 'NFK', 'جزيرة نورفولك', 'Norfolk Island', 'دولار أسترالي', 'Australian Dollar', 'AUD', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(155, 'NG', 'NGA', 'نيجيريا', 'Nigeria', 'نايرا نيجيري', 'Nigerian Naira', 'NGN', b'0', b'0', b'1', b'0', 'en', 'ltr', 100),
(156, 'NI', 'NIC', 'نيكاراغوا', 'Nicaragua', 'قرطبة نيكاراغوية', 'Nicaraguan Córdoba', 'NIO', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(157, 'NL', 'NLD', 'هولندا', 'Netherlands', 'يورو', 'Euro', 'EUR', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(158, 'NO', 'NOR', 'النرويج', 'Norway', 'كرونة نرويجية', 'Norwegian Krone', 'NOK', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(159, 'NP', 'NPL', 'نيبال', 'Nepal', 'روبية نيبالية', 'Nepalese Rupee', 'NPR', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(160, 'NR', 'NRU', 'ناورو', 'Nauru', 'دولار أسترالي', 'Australian Dollar', 'AUD', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(161, 'NU', 'NIU', 'نيوي', 'Niue', 'دولار نيوزيلندي', 'New Zealand Dollar', 'NZD', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(162, 'NZ', 'NZL', 'نيوزيلندا', 'New Zealand', 'دولار نيوزيلندي', 'New Zealand Dollar', 'NZD', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(163, 'OM', 'OMN', 'سلطنة عمان', 'Oman', 'ريال عماني', 'Omani Rial', 'OMR', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(164, 'PA', 'PAN', 'بنما', 'Panama', 'بالبوا بنمي', 'Panamanian Balboa', 'PAB', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(165, 'PE', 'PER', 'بيرو', 'Peru', 'سول بيروفي', 'Peruvian Sol', 'PEN', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(166, 'PF', 'PYF', 'بولينيزيا الفرنسية', 'French Polynesia', 'فرنك فرنسي', 'CFP Franc', 'XPF', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(167, 'PG', 'PNG', 'بابوا غينيا الجديدة', 'Papua New Guinea', 'كينا بابوا غينيا الجديدة', 'Papua New Guinean Kina', 'PGK', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(168, 'PH', 'PHL', 'الفلبين', 'Philippines', 'بيزو فلبيني', 'Philippine Peso', 'PHP', b'0', b'0', b'1', b'0', 'fil', 'ltr', 100),
(169, 'PK', 'PAK', 'باكستان', 'Pakistan', 'روبية باكستانية', 'Pakistani Rupee', 'PKR', b'0', b'0', b'1', b'0', 'ur', 'rtl', 100),
(170, 'PL', 'POL', 'بولندا', 'Poland', 'زلوتي بولندي', 'Polish Złoty', 'PLN', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(171, 'PM', 'SPM', 'سانت بيير وميكلون', 'Saint Pierre and Miquelon', 'يورو', 'Euro', 'EUR', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(172, 'PN', 'PCN', 'بيcairn', 'Pitcairn', 'دولار نيوزيلندي', 'New Zealand Dollar', 'NZD', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(173, 'PR', 'PRI', 'بورتوريكو', 'Puerto Rico', 'دولار أمريكي', 'US Dollar', 'USD', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(174, 'PS', 'PSE', 'فلسطين', 'Palestine', 'شيكل إسرائيلي جديد', 'Israeli New Shekel', 'ILS', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(175, 'PT', 'PRT', 'البرتغال', 'Portugal', 'يورو', 'Euro', 'EUR', b'0', b'0', b'1', b'0', 'pt', 'ltr', 100),
(176, 'PW', 'PLW', 'بالاو', 'Palau', 'دولار أمريكي', 'US Dollar', 'USD', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(177, 'PY', 'PRY', 'باراغواي', 'Paraguay', 'غواراني باراغواي', 'Paraguayan Guaraní', 'PYG', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(178, 'QA', 'QAT', 'قطر', 'Qatar', 'ريال قطري', 'Qatari Riyal', 'QAR', b'0', b'0', b'0', b'1', 'en', 'ltr', 200),
(179, 'RE', 'REU', 'ريونيون', 'Réunion', 'يورو', 'Euro', 'EUR', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(180, 'RO', 'ROU', 'رومانيا', 'Romania', 'ليو روماني', 'Romanian Leu', 'RON', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(181, 'RS', 'SRB', 'صربيا', 'Serbia', 'دينار صربي', 'Serbian Dinar', 'RSD', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(182, 'RU', 'RUS', 'روسيا', 'Russia', 'روبل روسي', 'Russian Ruble', 'RUB', b'0', b'0', b'1', b'0', 'ru', 'ltr', 100),
(183, 'RW', 'RWA', 'رواندا', 'Rwanda', 'فرنك رواندي', 'Rwandan Franc', 'RWF', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(184, 'SA', 'SAU', 'المملكة العربية السعودية', 'Saudi Arabia', 'ريال سعودي', 'Saudi Riyal', 'SAR', b'1', b'1', b'1', b'1', 'ar', 'rtl', 100),
(185, 'SB', 'SLB', 'جزر سليمان', 'Solomon Islands', 'دولار جزر سليمان', 'Solomon Islands Dollar', 'SBD', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(186, 'SC', 'SYC', 'سيشيل', 'Seychelles', 'روبية سيشيلية', 'Seychellois Rupee', 'SCR', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(187, 'SD', 'SDN', 'السودان', 'Sudan', 'جنيه سوداني', 'Sudanese Pound', 'SDG', b'0', b'0', b'0', b'0', 'ar', 'ltr', 100),
(188, 'SE', 'SWE', 'السويد', 'Sweden', 'كرونة سويدية', 'Swedish Krona', 'SEK', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(189, 'SG', 'SGP', 'سنغافورة', 'Singapore', 'دولار سنغافوري', 'Singapore Dollar', 'SGD', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(190, 'SH', 'SHN', 'سانت هيلينا', 'Saint Helena', 'جنيه سانت هيلين', 'Saint Helena Pound', 'SHP', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(191, 'SI', 'SVN', 'سلوفينيا', 'Slovenia', 'يورو', 'Euro', 'EUR', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(192, 'SJ', 'SJM', 'سفالبارد وجان مايين', 'Svalbard and Jan Mayen', 'كرونة نرويجية', 'Norwegian Krone', 'NOK', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(193, 'SK', 'SVK', 'سلوفاكيا', 'Slovakia', 'يورو', 'Euro', 'EUR', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(194, 'SL', 'SLE', 'سيراليون', 'Sierra Leone', 'ليون سيراليوني', 'Sierra Leonean Leone', 'SLL', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(195, 'SM', 'SMR', 'سان مارينو', 'San Marino', 'يورو', 'Euro', 'EUR', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(196, 'SN', 'SEN', 'السنغال', 'Senegal', 'فرنك غرب أفريقي', 'West African CFA Franc', 'XOF', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(197, 'SO', 'SOM', 'الصومال', 'Somalia', 'شيلينغ صومالي', 'Somali Shilling', 'SOS', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(198, 'SR', 'SUR', 'سورينام', 'Suriname', 'دولار سورينامي', 'Surinamese Dollar', 'SRD', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(199, 'SS', 'SSD', 'جنوب السودان', 'South Sudan', 'جنيه جنوب سوداني', 'South Sudanese Pound', 'SSP', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(200, 'SV', 'SLV', 'السلفادور', 'El Salvador', 'دولار سلفادوري', 'Salvadoran Colón', 'SVC', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(201, 'SX', 'SXM', 'سينت مارتن', 'Sint Maarten (Dutch part)', 'فلورين جزر الأنتيل الهولندية', 'Netherlands Antillean Guilder', 'ANG', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(202, 'SY', 'SYR', 'سوريا', 'Syria', 'ليرة سورية', 'Syrian Pound', 'SYP', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(203, 'SZ', 'SWZ', 'سوازيلاند', 'Swaziland', 'ليلانغيني سوازي', 'Swazi Lilangeni', 'SZL', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(204, 'TC', 'TCA', 'جزر توركس وكايكوس', 'Turks and Caicos Islands', 'دولار أمريكي', 'US Dollar', 'USD', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(205, 'TD', 'TCD', 'تشاد', 'Chad', 'فرنك وسط أفريقيا', 'Central African CFA Franc', 'XAF', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(206, 'TG', 'TGO', 'توغو', 'Togo', 'فرنك غرب أفريقي', 'West African CFA Franc', 'XOF', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(207, 'TH', 'THA', 'تايلاند', 'Thailand', 'باهت تايلاندي', 'Thai Baht', 'THB', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(208, 'TJ', 'TJK', 'طاجيكستان', 'Tajikistan', 'سوموني طاجيكي', 'Tajikistani Somoni', 'TJS', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(209, 'TL', 'TLS', 'تيمور الشرقية', 'Timor-Leste', 'دولار أمريكي', 'US Dollar', 'USD', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(210, 'TM', 'TKM', 'تركمانستان', 'Turkmenistan', 'مانات تركمانستاني', 'Turkmenistani Manat', 'TMT', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(211, 'TN', 'TUN', 'تونس', 'Tunisia', 'دينار تونسي', 'Tunisian Dinar', 'TND', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(212, 'TO', 'TON', 'تونغا', 'Tonga', 'بانغا تونغية', 'Tongan Paʻanga', 'TOP', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(213, 'TR', 'TUR', 'تركيا', 'Turkey', 'ليرة تركية', 'Turkish Lira', 'TRY', b'0', b'0', b'1', b'0', 'tr', 'ltr', 100),
(214, 'TT', 'TTO', 'ترينيداد وتوباغو', 'Trinidad and Tobago', 'دولار ترينيداد وتوباغو', 'Trinidad and Tobago Dollar', 'TTD', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(215, 'TV', 'TUV', 'توفالو', 'Tuvalu', 'دولار أسترالي', 'Australian Dollar', 'AUD', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(216, 'TW', 'TWN', 'تايوان', 'Taiwan', 'دولار تايواني جديد', 'New Taiwan Dollar', 'TWD', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(217, 'TZ', 'TZA', 'تنزانيا', 'Tanzania', 'شيلينغ تنزاني', 'Tanzanian Shilling', 'TZS', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(218, 'UA', 'UKR', 'أوكرانيا', 'Ukraine', 'هريفنا أوكرانية', 'Ukrainian Hryvnia', 'UAH', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(219, 'UG', 'UGA', 'أوغندا', 'Uganda', 'شيلينغ أوغندي', 'Ugandan Shilling', 'UGX', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(220, 'US', 'USA', 'الولايات المتحدة', 'United States', 'دولار أمريكي', 'US Dollar', 'USD', b'0', b'0', b'1', b'1', 'en', 'ltr', 1000),
(221, 'UY', 'URY', 'أوروغواي', 'Uruguay', 'بيزو أوروغواياني', 'Uruguayan Peso', 'UYU', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(222, 'UZ', 'UZB', 'أوزبكستان', 'Uzbekistan', 'سوم أوزبكستاني', 'Uzbekistani Som', 'UZS', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(223, 'VA', 'VAT', 'مدينة الفاتيكان', 'Vatican City', 'يورو', 'Euro', 'EUR', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(224, 'VC', 'VCT', 'سانت فنسنت وجزر غرينادين', 'Saint Vincent and the Grenadines', 'دولار شرق الكاريبي', 'East Caribbean Dollar', 'XCD', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(225, 'VE', 'VEN', 'فنزويلا', 'Venezuela', 'بوليفار فنزويلي', 'Venezuelan Bolívar', 'VES', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(226, 'VG', 'VGB', 'جزر العذراء البريطانية', 'British Virgin Islands', 'دولار أمريكي', 'US Dollar', 'USD', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(227, 'VI', 'VIR', 'جزر العذراء الأمريكية', 'U.S. Virgin Islands', 'دولار أمريكي', 'US Dollar', 'USD', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(228, 'VN', 'VNM', 'فيتنام', 'Vietnam', 'دونغ فيتنامي', 'Vietnamese Dong', 'VND', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(229, 'VU', 'VUT', 'فانواتو', 'Vanuatu', 'فاتو فانواتو', 'Vanuatu Vatu', 'VUV', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(230, 'WF', 'WLF', 'واليس وفوتونا', 'Wallis and Futuna', 'فرنك فرنسي', 'CFP Franc', 'XPF', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(231, 'WS', 'WSM', 'ساموا', 'Samoa', 'تالا ساموي', 'Samoan Tala', 'WST', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(232, 'XK', 'KOS', 'كوسوفو', 'Kosovo', 'يورو', 'Euro', 'EUR', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(233, 'YE', 'YEM', 'اليمن', 'Yemen', 'ريال يمني', 'Yemeni Rial', 'YER', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(234, 'YT', 'MYT', 'مايوت', 'Mayotte', 'يورو', 'Euro', 'EUR', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(235, 'ZA', 'ZAF', 'جنوب أفريقيا', 'South Africa', 'راند جنوب أفريقيا', 'South African Rand', 'ZAR', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(236, 'ZM', 'ZMB', 'زامبيا', 'Zambia', 'كواشا زامبية', 'Zambian Kwacha', 'ZMW', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(237, 'ZW', 'ZWE', 'زيمبابوي', 'Zimbabwe', 'دولار زيمبابوي', 'Zimbabwean Dollar', 'ZWL', b'0', b'0', b'0', b'0', 'en', 'ltr', 100),
(238, 'EU', 'EUR', 'منطقة اليورو', 'Eurozone', 'يورو', 'Euro', 'EUR', b'0', b'0', b'0', b'1', 'en', 'ltr', 1100),
(239, 'DE', 'DEU', 'ألمانيا', 'Germany', 'يورو', 'Euro', 'EUR', b'0', b'0', b'1', b'1', 'de', 'ltr', 100);

-- --------------------------------------------------------

--
-- Table structure for table `lookup__courses_type`
--

CREATE TABLE `lookup__courses_type` (
  `typId` int NOT NULL,
  `typName_en` varchar(25) NOT NULL,
  `typName_ar` varchar(25) NOT NULL,
  `typStatus` tinyint NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `lookup__courses_type`
--

INSERT INTO `lookup__courses_type` (`typId`, `typName_en`, `typName_ar`, `typStatus`) VALUES
(1, 'In-Person course', 'دورة حضورية', 1),
(2, 'Online course', 'دورة عن بعد', 1),
(3, 'Recorded course', 'دورة مسجلة', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lookup__role`
--

CREATE TABLE `lookup__role` (
  `rolId` int NOT NULL,
  `rolNameAr` varchar(50) NOT NULL,
  `rolNameEn` varchar(50) NOT NULL,
  `rolStatus` tinyint NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `lookup__role`
--

INSERT INTO `lookup__role` (`rolId`, `rolNameAr`, `rolNameEn`, `rolStatus`) VALUES
(1, 'متدرب', 'trainee', 1),
(2, 'مدرب / محاضر', 'instructor', 1),
(3, 'مدير النظام', 'Administrator', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lookup__specialization`
--

CREATE TABLE `lookup__specialization` (
  `spcId` int NOT NULL,
  `spcNameAr` varchar(255) NOT NULL,
  `spcNameEn` varchar(255) NOT NULL,
  `spcStatus` tinyint NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `lookup__specialization`
--

INSERT INTO `lookup__specialization` (`spcId`, `spcNameAr`, `spcNameEn`, `spcStatus`) VALUES
(1, 'طب الأسنان والخدمات المساندة', 'Dentistry and Related Specialties', 1),
(2, 'إدارة صحية وصحة مجتمعية', 'Health Administration and Community Health', 1),
(3, 'المختبرات والتقنيات الطبية', 'Laboratories and Medical Technology', 1),
(4, 'طب بشري', 'Medicine and Surgery', 1),
(5, 'تمريض وقبالة', 'Nursing and Midwifery', 1),
(6, 'صيدلية وفينو الصيدلة', 'Pharmacists and Pharmacy Technicians', 1),
(7, 'فنيون ومساعدون صحيون', 'Technicians and Health Assistants', 1),
(8, 'العلاج والتأهيل', 'Therapy and Rehabilitation', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lookup__sub_specialization`
--

CREATE TABLE `lookup__sub_specialization` (
  `spcId` int NOT NULL,
  `spcSubId` int NOT NULL,
  `spcSubNameAr` varchar(255) NOT NULL,
  `spcSubNameEn` varchar(255) NOT NULL,
  `spcSubStatus` tinyint NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `lookup__sub_specialization`
--

INSERT INTO `lookup__sub_specialization` (`spcId`, `spcSubId`, `spcSubNameAr`, `spcSubNameEn`, `spcSubStatus`) VALUES
(1, 1, 'مساعد طبيب أسنان', 'Dental Assistant', 1),
(1, 2, 'أمراض الفم والوجه والفكين', 'Oral Pathology', 1),
(1, 3, 'تقنية الأسنان', 'Dental Technology', 1),
(1, 4, 'تقويم الأسنان', 'Orthodontics', 1),
(1, 5, 'جراحة الفم', 'Oral Surgery', 1),
(1, 6, 'طب الأسنان التحفظي', 'Conservative Dentistry', 1),
(1, 7, 'الصحة العامة للأسنان', 'Dental Public Health', 1),
(1, 8, 'طب أسنان الأطفال', 'Pediatric Dentistry', 1),
(1, 9, 'طب دواعم السن', 'Periodontics', 1),
(1, 10, 'طب الأسنان التعويضي', 'Prosthodontics', 1),
(1, 11, 'طب الأسنان العام', 'General Dentistry', 1),
(1, 12, 'جراحة الوجه والفكين', 'Oral and Maxillofacial Surgery', 1),
(1, 13, 'طب االأسنان المتقدم العام', 'Advanced General Dentistry', 1),
(1, 14, 'أشعة الفم والوجه والفكين', 'Oral and Maxillofacial Radiology', 1),
(1, 15, 'طب الفم', 'Oral Medicine', 1),
(1, 16, 'اصلاح الأسنان', 'Restorative Dentistry', 1),
(1, 17, 'علم أحياء الفم', 'Oral Biology', 1),
(1, 18, 'المداوة اللبية', 'Endodontics', 1),
(1, 19, 'طب الأسنان الوقائي', 'Preventive Dentistry', 1),
(1, 20, 'طب أسنان ذوي الاحتياجات الخاصة', 'Special Needs Dentistry', 1),
(1, 21, 'صحة فم وأسنان', 'Dental Hygiene', 1),
(1, 22, 'اسنان', 'Dental', 1),
(1, 23, 'آلام الفم والوجه ', 'Orofacial Pain', 1),
(1, 24, 'طب الأسنان الشرعي', 'Forensic Dentistry', 1),
(1, 25, 'علم أنسجة الفم', 'Oral Histology', 1),
(1, 26, 'تخدير اسنان', 'Dental Anaesthesiology', 1),
(1, 27, 'تقويم الأسنان والوجه والفكين', 'Orthodontics and Dentofacial Orthopdics', 1),
(1, 28, 'تجميل أسنان', 'Dental Esthetics', 1),
(1, 29, 'طب أسنان الأسرة', 'Family Dentistry', 1),
(1, 30, 'Implantology', 'Implantology', 1),
(1, 31, 'أمراض المفصل الصدغي الفكي ', 'Temporomandibular Joint Disorders', 1),
(1, 32, 'طب أسنان المسنين', 'Geriatric Dentistry', 1),
(1, 33, 'طب أسنان المستشفيات', 'Hospital-Based Dentistry', 1),
(1, 34, 'Orthognathic and Facial Plastic Surgery', 'Orthognathic and Facial Plastic Surgery', 1),
(2, 35, 'صحة البيئة والسلامة المهنية', 'Environmental Health and Safety', 1),
(2, 36, 'الصحة العامة - إدارة مستشفيات', 'Public Health - Hospitals Administration', 1),
(2, 37, 'الوبائيات', 'Epidemiology', 1),
(2, 38, 'الصحية العامة - تغذية ', 'Public Health - Nutrition', 1),
(2, 39, 'الصحية العامة - تعزيز الصحة', 'Public Health - Health Promotion', 1),
(2, 40, 'الصحية العامة - صحية بيئة', 'Public Health - Environment Health', 1),
(2, 41, 'الصحية العامة - صحة المجتمع', 'Public Health - Community Health', 1),
(2, 42, 'الصحة العامة', 'Public Health', 1),
(2, 43, 'التعليم الطبي', 'Medical Education', 1),
(2, 44, 'تثقيف صحي', 'Health Education', 1),
(2, 45, 'المعلوماتية الصحية', 'Health Informatics', 1),
(2, 46, 'سلامة وصحة مهنية', 'Occupational Safety and Health', 1),
(2, 47, 'مكافحة العدوى', 'Infection Control', 1),
(2, 48, 'الإدارة الصحية', 'Health Administration', 1),
(2, 49, 'الإدارة الصحية - إدارة المخاطر', 'Health Administration - Risk Management', 1),
(2, 50, 'الإدارة الصحية - إدارة الجودة', 'Health Administration - Quality Management', 1),
(2, 51, 'إدارة المعلومات الصحية', 'Health Information Management', 1),
(3, 52, 'تقنية أشعة', 'Radiological Technology', 1),
(3, 53, 'تقنية أشعة - المعلوماتية في التصوير الطبي', 'Radiological Technology - Medical Imagin', 1),
(3, 54, 'تقنية أشعة - مخطط الجرعات الاشعاعية', 'Radiological Technology - Radiation Dosimetrist', 1),
(3, 55, 'تقنية أشعة - حماية اشعاعية', 'Radiological Technology - Radiation Protection', 1),
(3, 56, 'تقنية أشعة - اشعة فوق صوتية', 'Radiological Technology - Ultrasound', 1),
(3, 57, 'تقنية أشعة - الرنين المغناطيسي', 'Radiological Technology - Magnetic Resonance Technology', 1),
(3, 58, 'الأشعة العلاجية', 'Radiotherapy', 1),
(3, 59, 'الطب النووي', 'Nuclear Medicine', 1),
(3, 60, 'الفيزياء الطبية - فيزياء حماية الأشعة', 'Medical Physics - Radiation Protection', 1),
(3, 61, 'الفيزياء الطبية - فيزياء العلاج الاشعاعي', 'Medical Physicis - Radiotherapy', 1),
(3, 62, 'الفيزياء الطبية - فيزياء الطب النووي', 'Medical Physicis - Medical Nuclear Physics', 1),
(3, 63, 'الفيزياء الطبية', 'Medical Physics', 1),
(3, 64, 'تقنية القلب', 'Cardiovascular Technology', 1),
(3, 65, 'الأطراف الصناعية والأجهزة التعويضية', 'Prosthetics & Orthotics', 1),
(3, 66, 'تقنية تخدير', 'Anesthesia Technology', 1),
(3, 67, 'معلوماتية حيوية طبية', 'Health Bioinformatics', 1),
(3, 68, 'تخطيط النوم', 'Polysomnography', 1),
(3, 69, 'علم الوراثة - علم الوراثة الخلوية', 'Genetics - Cytogenetics', 1),
(3, 70, 'علم الدم - علم مطابقة الأنسجة', 'Hematology - Histocompatibility', 1),
(3, 71, 'أحياء دقيقة - فطريات', 'Microbiology - Mycology', 1),
(3, 72, 'مختبرات - علم أجنة', 'Laboratory - Embryology', 1),
(3, 73, 'أحياء دقيقة - طفيليات', 'Microbiology - Parasitology', 1),
(3, 74, 'مختبرات - علم الوراثة الجزيئية', 'Laboratory - Molecular Genetics', 1),
(3, 75, 'الكيمياء الحيوية السريرية - علوم السموم الجنائي', 'Clinical Biochemistry - Forensic Toxicology', 1),
(3, 76, 'مختبرات - نقل الدم وبنوك الدم', 'Laboratory -Transfusion & Blood Bank', 1),
(3, 77, 'مختبرات - علم أمراض الخلايا ', 'Laboratory - Cytopathology', 1),
(3, 78, 'الكيمياء الحيوية السريرية - علوم السموم السريري', 'Clinical Biochemistry - Clinical Toxicology', 1),
(3, 79, 'علم الوراثة - علم المعلوماتية الحيوية للوراثة الطبية', 'Genetics Bioinformatics of Clinical Genetics', 1),
(3, 80, 'مختبرات - علم المناعة السريرية', 'Laboratory - Clinical Immunology', 1),
(3, 81, 'مختبرات', 'Laboratory', 1),
(3, 82, 'مختبرات - علم الدم', 'Laboratory - Hematology', 1),
(3, 83, 'أحياء دقيقة - فيروسات', 'Microbiology - Virology', 1),
(3, 84, 'مختبرات علم الوراثة', 'Laboratory - Genetics', 1),
(3, 85, 'مختبرات - الكيمياء الحيوية السريرية', 'Laboratory - Clinical Biochemistry', 1),
(3, 86, 'مختبرات - علم أمراض الأنسجة', 'Laboratory - Histopathology', 1),
(3, 87, 'مختبرات - أحياء دقيقة جزيئية', 'Microbiology - Molecular Microbiology', 1),
(3, 88, 'مختبرات - أحياء دقيقة', 'Laboratory - Microbiology', 1),
(3, 89, 'علم المناعة السريرية - علم مطابقة الأنسجة', 'Clinical Immunology - Histocompatibility', 1),
(3, 90, 'تقنية حيوية طبية', 'Biomedical Technology', 1),
(3, 91, 'الأجهزة الطبية', 'Medical Devices', 1),
(3, 92, 'علم  وظائف الأعضاء الاكلينيكي', 'Clinical Physiology', 1),
(3, 93, 'المختبرات الجنائية', 'Forensic Laboratories', 1),
(3, 94, 'هندسة وراثية', 'Genetic engineering', 1),
(3, 95, 'الإرشاد الوراثي', 'Genetic Counselling', 1),
(3, 96, 'سحب الدم', 'Phlebotomy', 1),
(4, 97, 'الغدد الصماء', 'Endocrinology', 1),
(4, 98, 'Vascualr Endovascular Surgery', 'Vascular and Endovascular Surgery', 1),
(4, 99, 'طب الأمراض الرثوية', 'Rheumatology', 1),
(4, 100, 'رعاية االأطفال المعقدة/ العناية التلطيفية', 'Pediatric Complex Care -Palliative Care', 1),
(4, 101, 'حديثي الولادة', 'Neonatology', 1),
(4, 102, 'Pediatic Emergency Medicine Truama', 'Pediatric Emergency Medicine Trauma', 1),
(4, 103, 'Perinatal Neonatal Medicine', 'Perinatal Neonatal Medicine', 1),
(4, 104, 'Bariatric Medicine', 'Bariatric medicine', 1),
(4, 105, 'Hip and knee arthroplasty Surgery', 'Hip and knee arthroplasty Surgery', 1),
(4, 106, 'ضربات القلب الجنينية', 'Fetal Echocardiography', 1),
(4, 107, 'Hand And Wrist Surgery ', 'Hand and Wrist Surgery', 1),
(4, 108, 'Epidemiology', 'Epidemiology', 1),
(4, 109, 'Renal Transplant', 'Renal transplant', 1),
(4, 110, 'Developmental Pediatrics', 'Developmental Pediatrics', 1),
(4, 111, 'الطب المهني', 'Occupational Medicine', 1),
(4, 112, 'علم أمراض الدم', 'Hematological Pathology', 1),
(4, 113, 'جراحة الأطفال', 'Pediatric Surgery', 1),
(4, 114, 'Thoracis Surgery', 'Thoracic Surgery', 1),
(4, 115, 'طب الأطفال حديثي الولادة', 'Neonatal Intensive Care', 1),
(4, 116, 'طب الكلى', 'Nephrology', 1),
(4, 117, 'علم أمراض الأعصاب', 'Neuropathology', 1),
(4, 118, 'طب الحساسية والمناعية', 'Allergy and Immumology', 1),
(4, 119, 'طب الأطفال', 'Pediatrics', 1),
(4, 120, 'الطب الوقائي والصحة العامة', 'Preventive Medicine and Public Health', 1),
(4, 121, 'طب الأسرة', 'Family Medicine', 1),
(4, 122, 'الجراحة العامة', 'General surgery', 1),
(4, 123, 'الطب الباطني', 'Internal Medicine', 1),
(4, 124, 'علم الأمراض التشريحي', 'Anatomic Pathology', 1),
(4, 125, 'جراحة المخ والأعصاب', 'Neurosurgery', 1),
(4, 126, 'طب الطوارئ', 'Emergency Medicine', 1),
(4, 127, 'جراحة الفم والأذن والحنجرة والرأس والعنق', 'Otorhinolaryngology (ENT)', 1),
(4, 128, 'جراحة العظام', 'Orthopedic Surgery', 1),
(4, 129, 'طب النساء والولادة', 'Obstetrics and Gynecology', 1),
(4, 130, 'جراحة الأوعية الدموية ', 'Vascular Surgery', 1),
(4, 131, 'الطب العام', 'General Practice', 1),
(4, 132, 'طب الوراثة', 'Medical Genetics', 1),
(4, 133, 'علم الأمراض السريري', 'Clinical Pathology', 1),
(4, 134, 'الطب النووي', 'Nuclear Medicine', 1),
(4, 135, 'جراحة المسالك البولية', 'Urology', 1),
(4, 136, 'الطب النفسي', 'Psychiatry', 1),
(4, 137, 'طب الأعصاب', 'Neurology', 1),
(4, 138, 'جراحة القلب والصدر', 'Thoracic and Cardiac Surgery', 1),
(4, 139, 'جراحة القلب ', 'Cardiac Surgery', 1),
(4, 140, 'طب أعصاب الأطفال', 'Pediatric Neurology', 1),
(4, 141, 'طب التخدير', 'Anesthesia', 1),
(4, 142, 'الأشعة التشخيصية', 'Diagnostic Radiology', 1),
(4, 143, 'طب الأمراض الجلدية', 'Dermatology', 1),
(4, 144, 'علم الأحياء الدقيقة الطبية', 'Medical Microbiology', 1),
(4, 145, 'الطب الطبيعي واعادة التأهيل', 'Physical Medicine and Rehabilitation', 1),
(4, 146, 'العلاج الاشعاعي للأورام ', 'Radiation Oncology', 1),
(4, 147, 'طب العناية المركزة', 'Critical Care Medicine', 1),
(4, 148, 'طب العيون', 'Ophthalmology', 1),
(4, 149, 'الطب الشرعي', 'Forensic Medicine', 1),
(4, 150, 'جراحة التجميل', 'Plastic Surgery', 1),
(4, 151, 'طب الجهاز الهضمي', 'Gastroenterology', 1),
(4, 152, 'طب المسنين', 'Geriatric Medicine', 1),
(4, 153, 'الصحة العامة', 'Public Health', 1),
(4, 154, 'جراحة الجهاز الهضمي', 'Gastrointestinal Surgery', 1),
(4, 155, 'طب القلب والأوعية الدموية', 'Cardiovascular Medicine', 1),
(4, 156, 'طب الجهاز التنفسي', 'Pulmonology', 1),
(4, 157, 'طب نقل الدم ومشتقاته', 'Blood Transfusion Medicine', 1),
(4, 158, 'طب أمراض الدم', 'Hematology', 1),
(4, 159, 'طب الأورام', 'Medical Oncology', 1),
(4, 160, 'طب الأمراض المعدية', 'Infectious Disease', 1),
(5, 161, 'قبالة', 'Midwifery', 1),
(5, 162, 'تمريض', 'Nursing', 1),
(5, 163, 'تمريض الرعاية الحرجة للكبار', 'Adult Critical Care Nursing', 1),
(5, 164, 'تمريض الباطنة والجراحة', 'Medical and Surgical Nursing', 1),
(5, 165, 'إدارة التمريض', 'Nursing Administration', 1),
(5, 166, 'تمريض الرعاية الأولية', 'Primary Health Care Nursing', 1),
(5, 167, 'تمريض الصحة النفسية والعقلية', 'Psychological and Mental Health Nursing', 1),
(5, 168, 'تعليم التمريض', 'Nursing Education', 1),
(5, 169, 'تمريض معالجة الألم', 'Pain Management Nursing', 1),
(5, 170, 'تمريض العناية القلبية والأوعية الدموية', 'Cardiovascular Nursing', 1),
(5, 171, 'تمريض الأمومة والطفولة', 'Maternity and Child Health Nursing', 1),
(5, 172, 'تمريض الغسيل الكلوي', 'Hemodialysis Nursing', 1),
(5, 173, 'تمريض أطفال', 'Pediatric Nursing', 1),
(5, 174, 'تمريض التخدير', 'Anesthesia Nursing', 1),
(5, 175, 'التمريض التلطيفي وتمريض الأورام', 'Oncology and Palliative Care Nursing', 1),
(5, 176, 'تمريض النساء والولادة', 'Obstetrics and Gynecologic Nursing', 1),
(5, 177, 'تمريض رعاية كبار السن', 'Geriatric Nursing', 1),
(5, 178, 'تمريض الرعاية الحرجة للأطفال', 'Pediatric Nursing Critical Care', 1),
(5, 179, 'تمريض العناية الحرجة لحديثي الولادة', 'Neonatal Critical Care Nursing', 1),
(5, 180, 'تمريض رعاية القدم السكرية', 'Diabetic Podiatry Care Nursing', 1),
(5, 181, 'تمريض الطوارئ', 'Emergency Care Nursing', 1),
(5, 182, 'تمريض مرضى السكري', 'Diabetic Care Nursing', 1),
(5, 183, 'تمريض العناية بالجروح', 'Wound Care Nursing', 1),
(5, 184, 'تمريض رعاية صحة المجتمع', 'Community and Public Health Nursing', 1),
(5, 185, 'تمريض الكوارث والطوارئ', 'Disaster and Emergency Nursing', 1),
(5, 186, 'تمريض العناية ماقبل وأثناء وبعد العمليات', 'Pre, Intra and Postoperative nursing care', 1),
(6, 187, 'الصيدلة السريرية في علاجيات الأمراض المعدية', 'Clinical Pharmacy -Infectious Diseases', 1),
(6, 188, 'رعاية صيدلانية (رعاية أولية)', 'Pharmaceutical care (Ambulatory)', 1),
(6, 189, 'الصيدلة', 'Pharmacy', 1),
(6, 190, 'الصيدلة الحيوية', 'Biopharmaceutics', 1),
(6, 191, 'علم الأدوية', 'Pharmacology', 1),
(6, 192, 'علم السموم', 'Toxicology', 1),
(6, 193, 'علم الأدوية الجيني', 'Pharmacogenetics', 1),
(6, 194, 'العلوم الصيدلانية', 'Pharmaceutical Sciences', 1),
(6, 195, 'صيدلانيات', 'Pharmaceutics', 1),
(6, 196, 'الرقاية النوعية للمستحضرات الصيدلية', 'Quality Control of Pharmaceutical', 1),
(6, 197, 'صيدلية الطب الشرعي', 'Forensic Pharmacy', 1),
(6, 198, 'اقتصاديات الدواء', 'Medicine Economics', 1),
(6, 199, 'علم الميكروبات الصيدلاني', 'Pharmaceutical Microbiology', 1),
(6, 200, 'الصيدلة الصناعية', 'Industrial Pharmacy', 1),
(6, 201, 'الصيدلة النووية', 'Radiopharmaceutics and PET Radiochemistry', 1),
(6, 202, 'علم الأدوية والسموم', 'Pharmacology & Toxicology', 1),
(6, 203, 'الكيمياء الصيدلانية', 'Pharmaceutical Chemistry', 1),
(6, 204, 'التحيليل الصيدلاني', 'Pharmaceutical Analysis', 1),
(6, 205, 'علم العقاقير', 'Pharmacognosy', 1),
(6, 206, 'الصيدلية السريرية (علاجيات طب الأطفال)', 'Clinical Pharmacy ( Pediatrics)', 1),
(6, 207, 'الصيدلية السريرية (زراعة الأعضاء)', 'Clinical Pharmacy (Transplant)', 1),
(6, 208, 'الصيدلية السريرية (علاجيات العناية المركزة)', 'Clinical Pharmacy (Critical Care Pharmacotherapy)', 1),
(6, 209, 'الصيدلية السريرية (علاجيات أمراض القلب)', 'Clinical Pharmacy (Cardiology Pharmacotherapy)', 1),
(6, 210, 'الصيدلية السريرية (علاجيات أمراض السرطان)', 'Clinical Pharmacy (Oncology Pharmacotherapy)', 1),
(6, 211, 'الصيدلية السريرية (علاجيات طب الباطنية)', 'Clinical Pharmacy (Internal Medicine Pharmacotherapy)', 1),
(6, 212, 'الصيدلية السريرية (علاجيات الأمراض المعدية)', 'Clinical Pharmacy (Infectious Diseases Pharmacotherapy)', 1),
(6, 213, 'الصيدلية السريرية (طب الطوارئ)', 'Clinical Pharmacy (Emergency Medicine)', 1),
(6, 214, 'الصيدلية السريرية ', 'Clinical Pharmacy', 1),
(6, 215, 'الصيدلية السريرية (علاحيات أمراض الكلى)', 'Clinical Pharmacy (nephrology Medicine Pharmacotherapy)', 1),
(6, 216, 'الصيدلية السريرية (التغذية الوريدية العلاجية)', 'Clinical Pharmacy (Parenteral Nutrition)', 1),
(6, 217, 'رعاية صيدلانية ', 'Pharmaceutical care', 1),
(6, 218, 'إدرة صيدلانية', 'Pharmaceutical Administration', 1),
(6, 219, 'سياسة وإدارة الرعاية الصحية', 'Healthcare Policy and Management', 1),
(6, 220, 'إدارة جودة الخدمات الصيدلانية', 'Quality Management of Pharmaceutical Services', 1),
(7, 221, 'النسخ الطبي', 'Medical Transcription', 1),
(7, 222, 'نظارات', 'Optics', 1),
(7, 223, 'الخدمات الطبية الطارئة', 'Paramedic Science', 1),
(7, 224, 'السكرتارية الطبية', 'Medical secretary', 1),
(7, 225, 'تجبير عظام', 'Plastering', 1),
(7, 226, 'قسطرة قلب', 'Cardiac Catheterization', 1),
(7, 227, 'الصحة الوقائية', 'Preventive Health', 1),
(7, 228, 'علم الغذاء غير سريري/سلامة الأغذية', 'Food Science And Technology (Food Safety)', 1),
(7, 229, 'علم الغذاء غير سريري', 'Food Science And Technology', 1),
(7, 230, 'الأحياء (الجينوما والتقنية الحيوية)', 'Biology (Genomic & Biotechnology)', 1),
(7, 231, 'تفتيت الحصى', 'Lithotripsy', 1),
(7, 232, 'إدارة خدمات صحية ومستشفيات', 'Health services administration and Hosiptals', 1),
(7, 233, 'علم وظائف الأعصاب', 'Neurophysiology', 1),
(7, 234, 'تأمين صحي', 'Health Insurance', 1),
(7, 235, 'عيون', 'Ophthalmology', 1),
(7, 236, 'التموين الطبي', 'Medical Supply', 1),
(7, 237, 'غسيل كلى', 'Hemodialysis', 1),
(7, 238, 'مساعد صحي مختبر', 'Health Assistant - Laboratory', 1),
(7, 239, 'الاحصاء الطبي', 'Biomedical Statistics', 1),
(7, 240, 'الترميز الطبي', 'Medical Coding', 1),
(7, 241, 'مكافحة العدوى', 'Infection Control', 1),
(7, 242, 'التعقيم الطبي', 'Medical Sterilization', 1),
(7, 243, 'تقنية الموجات الصوتية للقلب', 'Echocardiography', 1),
(7, 244, 'مختبر أحياء الدقيقة', 'Laboratory (Microbiology)', 1),
(7, 245, 'مختبر كيمياء الحيوية ', 'Laboratory-Biochemistry', 1),
(7, 246, 'غرف عمليات', 'Operation Rooms', 1),
(7, 247, 'فني طب شرعي ', 'Fornesic Technician', 1),
(8, 248, 'علاج طبيعي', 'Physiotherapy', 1),
(8, 249, 'علاج طبيعي - أعصاب', 'Physiotherapy - Neurological', 1),
(8, 250, 'علاج طبيعي - صحة المرأة ', 'Physiotherapy - Women Health', 1),
(8, 251, 'علاج طبيعي - القلب والأوعية الدموية', 'Physiotherapy - Cardiovascular', 1),
(8, 252, 'علاج طبيعي - شيخوخة', 'Physiotherapy - Geriatrics', 1),
(8, 253, 'علاج طبيعي - عضلات وعظام', 'Physiotherapy - Musculoskeletal', 1),
(8, 254, 'علاج طبيعي - أطفال', 'Physiotherapy - Pediatrics', 1),
(8, 255, 'علاج طبيعي - التوازن', 'Physiotherapy - Vestibular', 1),
(8, 256, 'علاج طبيعي - العلاج الطبيعي الرياضي', 'Physiotherapy - Sport Physical Therapy', 1),
(8, 257, 'علم النفس - علم نفس الأطفال السريري', 'Psychology - Clinical Child Psychology', 1),
(8, 258, 'علم النفس - علم النفس الجنائي', 'Psychology - Forensic psychology', 1),
(8, 259, 'علم النفس - العلاج أسري', 'Psychology - Family Therpay', 1),
(8, 260, 'علم النفس', 'Psychology', 1),
(8, 261, 'علم النفس - علم النفس الارشاردي', 'Psychology - Counseling Psychology', 1),
(8, 262, 'علم النفس - علم النفس العصبي السريري', 'Psychology - Clinical Psychology', 1),
(8, 263, 'علم النفس - علم النفس  السريري', 'Psychology - Clinical Neuropsychology', 1),
(8, 264, 'خدمة اجتماعية', 'Social Service', 1),
(8, 265, 'علاج النطق والتخاطب', 'Speech and Hearing Therapy', 1),
(8, 266, 'سمعيات', 'Audiology', 1),
(8, 267, 'بصريات - قرنية', 'Optometry - Cornea', 1),
(8, 268, 'بصريات - قرنية وعدسات لاصقة اكلينيكية', 'Optometry - Cornea & Clinical Contact Lens', 1),
(8, 269, 'بصريات - تقنية عيون', 'Optometry - Opthalmology technology', 1),
(8, 270, 'بصريات - عدسات لاصقة', 'Optometry - Contact Lens', 1),
(8, 271, 'بصريات', 'Optometry', 1),
(8, 272, 'بصريات - تقويم البصر', 'Optometry - Orthoptics', 1),
(8, 273, 'غرف عمليات', 'Operation Rooms', 1),
(8, 274, 'علاج القدم والكاحل', 'Podiatry', 1),
(8, 275, 'تروية القلب', 'Cardiac Perfusion', 1),
(8, 276, 'العلاج التنفسي', 'Respiratory Therapy', 1),
(8, 277, 'علم الاجتماع', 'Sociology', 1),
(8, 278, 'علاج وظيفي', 'Occupational Therapy', 1),
(8, 279, 'خدمات طبية طارئة - إدارة الطوارئ', 'Emergency Medical Services - Emergency Management', 1),
(8, 280, 'خدمات طبية طارئة', 'Emergency Medical Services', 1),
(8, 281, 'خدمات طبية طارئة - عناية حرجة', 'Emergency Medical Services - Critical Care', 1),
(8, 282, 'التغذية العلاجية', 'Clincal Nutrition', 1),
(8, 283, 'خدمات غذاء وتغذية', 'Food and Nutrition Services', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lookup__unclassified`
--

CREATE TABLE `lookup__unclassified` (
  `unclassId` int NOT NULL,
  `unclassAr` varchar(25) NOT NULL,
  `unclassEn` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `lookup__unclassified`
--

INSERT INTO `lookup__unclassified` (`unclassId`, `unclassAr`, `unclassEn`) VALUES
(1, 'طالب', 'Student'),
(2, 'موظف', 'Employee'),
(3, 'غير ذلك', 'N/A');

-- --------------------------------------------------------

--
-- Table structure for table `users__account`
--

CREATE TABLE `users__account` (
  `usrId` int NOT NULL,
  `usrMobile` varchar(50) DEFAULT NULL,
  `usrEmail` varchar(100) NOT NULL,
  `usrPassword` varchar(25) NOT NULL,
  `rolId` int NOT NULL DEFAULT '1',
  `usrStatus` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users__account`
--

INSERT INTO `users__account` (`usrId`, `usrMobile`, `usrEmail`, `usrPassword`, `rolId`, `usrStatus`) VALUES
(1, '00966506252520', 'abohamam@hotmail.com', '111111', 1, 1),
(13, '009665067371793', 'abohamam@yahoo.com', '111111', 2, 1),
(14, '009665067371793', 'abohamam@gmail.com', '111111', 3, 1),
(16, '9660506858585', 'aaa@hotmail.com', '222222', 1, 1),
(17, '009665067371793', 'saeed@hotmail.com', '111111', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users__profile_admin`
--

CREATE TABLE `users__profile_admin` (
  `usrId` int NOT NULL,
  `admnImage` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `admnNameAr` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `admnNameEn` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `admnGander` tinyint NOT NULL DEFAULT '1',
  `admnMobile` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `admnWhatsUp` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users__profile_admin`
--

INSERT INTO `users__profile_admin` (`usrId`, `admnImage`, `admnNameAr`, `admnNameEn`, `admnGander`, `admnMobile`, `admnWhatsUp`) VALUES
(13, 'https://cdn-icons-png.flaticon.com/512/7922/7922268.png', 'محمد علي', 'Mohammed Ali', 1, '+966555555555', NULL),
(17, 'https://cdn-icons-png.flaticon.com/512/1912/1912333.png', 'أمل محمد', 'Amal Mohammed', 0, '+966777777777', '+966777777777');

-- --------------------------------------------------------

--
-- Table structure for table `users__profile_lecturer`
--

CREATE TABLE `users__profile_lecturer` (
  `usrId` int NOT NULL,
  `lctImage` varchar(255) DEFAULT NULL,
  `lctNameAr` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `lctNameEn` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `lctGander` tinyint NOT NULL DEFAULT '1',
  `cntId` int NOT NULL,
  `lctMobile` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `lctWhatsUp` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `lctExperienceEn` text,
  `lctExperienceAr` text,
  `lctEducationAr` text,
  `lctEducationEn` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users__profile_lecturer`
--

INSERT INTO `users__profile_lecturer` (`usrId`, `lctImage`, `lctNameAr`, `lctNameEn`, `lctGander`, `cntId`, `lctMobile`, `lctWhatsUp`, `lctExperienceEn`, `lctExperienceAr`, `lctEducationAr`, `lctEducationEn`) VALUES
(13, 'https://cdn-icons-png.flaticon.com/512/7922/7922268.png', 'محمد علي', 'Mohammed Ali', 1, 9, '+966555555555', NULL, 'With over [X] years of experience in professional training and development, [Trainer Name] has successfully designed and delivered customized learning programs across sectors including [industry examples]. Their expertise spans in-person workshops, virtual classrooms, and blended learning environments, with a focus on engaging adult learners through interactive methodologies and real-world application. Known for their ability to simplify complex topics and foster inclusive learning spaces, they’ve empowered teams to improve performance, adopt new technologies, and embrace continuous growth.', 'يمتلك [اسم المدرب] خبرة تزيد عن [X] سنوات في مجال التدريب والتطوير المهني، حيث قام بتصميم وتنفيذ برامج تدريبية مخصصة في قطاعات متنوعة مثل [أمثلة على الصناعات]. تشمل خبرته التدريب الحضوري، الفصول الافتراضية، وأنظمة التعلم المدمج، مع التركيز على تحفيز المتدربين البالغين من خلال أساليب تفاعلية وتطبيقات عملية. يُعرف بقدرته على تبسيط المفاهيم المعقدة وخلق بيئة تعليمية شاملة، مما ساهم في تمكين الفرق من تحسين الأداء، واعتماد التقنيات الحديثة، وتعزيز ثقافة التعلم المستمر.', 'يحمل [اسم المدرب] شهادة جامعية في [مجال الدراسة] من جامعة [اسم الجامعة]، بالإضافة إلى شهادات تخصصية في تصميم المحتوى التدريبي، تعليم الكبار، و[أدوات أو منصات ذات صلة مثل أنظمة إدارة التعلم أو البرمجيات التقنية]. توفر خلفيته الأكاديمية أساسًا نظريًا قويًا، بينما تضمن مشاركته المستمرة في التطوير المهني مواكبته لأحدث الاتجاهات في أساليب التعليم، التعلم الرقمي، وتطوير القوى العاملة.\n', 'holds a degree in [Field of Study] from [University Name], complemented by specialized certifications in instructional design, adult education, and [any relevant tools or platforms, e.g., LMS, coaching, or technical software]. Their academic background provides a strong theoretical foundation, while ongoing professional development ensures they stay current with evolving trends in pedagogy, digital learning, and workforce development.'),
(17, 'https://cdn-icons-png.flaticon.com/512/1912/1912333.png', 'أمل محمد', 'Amal Mohammed', 0, 15, '+966777777777', '+966777777777', 'With over [X] years of experience in professional training and development, [Trainer Name] has successfully designed and delivered customized learning programs across sectors including [industry examples]. Their expertise spans in-person workshops, virtual classrooms, and blended learning environments, with a focus on engaging adult learners through interactive methodologies and real-world application. Known for their ability to simplify complex topics and foster inclusive learning spaces, they’ve empowered teams to improve performance, adopt new technologies, and embrace continuous growth.', 'تمتع هذا المدرب بخبرة واسعة تمتد لأكثر من [X] سنوات في مجال التدريب المهني وتطوير القدرات، حيث قدم برامج تدريبية ناجحة لمؤسسات محلية ودولية في مجالات متعددة مثل [مثال: التقنية، الإدارة، خدمة العملاء]. يتميز بأسلوب تدريبي تفاعلي يركز على إشراك المتدربين وتحفيزهم، مع القدرة على تبسيط المفاهيم المعقدة وتحويلها إلى تطبيقات عملية. ساهمت خبرته في تحسين أداء الفرق، وتعزيز مهاراتهم، وتحقيق نتائج ملموسة على مستوى الأفراد والمؤسسات.', 'يحمل المدرب شهادة جامعية في [اسم التخصص] من جامعة [اسم الجامعة]، بالإضافة إلى مجموعة من الشهادات المهنية المعتمدة في مجالات التدريب، تطوير المحتوى، وإدارة التعلم الإلكتروني. وقد حرص على مواكبة أحدث الأساليب التعليمية من خلال المشاركة المستمرة في ورش العمل والدورات المتقدمة، مما عزز من قدرته على تقديم محتوى تدريبي عالي الجودة يتماشى مع احتياجات السوق ومتطلبات المتدربين.\n', 'holds a degree in [Field of Study] from [University Name], complemented by specialized certifications in instructional design, adult education, and [any relevant tools or platforms, e.g., LMS, coaching, or technical software]. Their academic background provides a strong theoretical foundation, while ongoing professional development ensures they stay current with evolving trends in pedagogy, digital learning, and workforce development.');

-- --------------------------------------------------------

--
-- Table structure for table `users__profile_trainee`
--

CREATE TABLE `users__profile_trainee` (
  `usrId` int NOT NULL,
  `trnNameAr` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `trnNameEn` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `trnGander` tinyint NOT NULL DEFAULT '1',
  `cntId` int NOT NULL,
  `trnMobile` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `trnWhatsUp` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `isSCFHS` tinyint NOT NULL DEFAULT '0',
  `trnSCFHS` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `spcId` int DEFAULT NULL,
  `spcSubId` int DEFAULT NULL,
  `unclassId` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users__profile_trainee`
--

INSERT INTO `users__profile_trainee` (`usrId`, `trnNameAr`, `trnNameEn`, `trnGander`, `cntId`, `trnMobile`, `trnWhatsUp`, `isSCFHS`, `trnSCFHS`, `spcId`, `spcSubId`, `unclassId`) VALUES
(1, 'أسامة زيدان', 'Osama Zidan', 1, 9, '+966555555555', NULL, 1, '1234-1234-2365-25632', 1, 7, NULL),
(16, 'داليا الكناني', 'Dalia Kenani', 0, 15, '+966777777777', '+966777777777', 0, NULL, NULL, NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`crsId`),
  ADD KEY `typId` (`typId`),
  ADD KEY `spcId` (`spcId`),
  ADD KEY `spcSubId` (`spcSubId`);

--
-- Indexes for table `courses__inparson`
--
ALTER TABLE `courses__inparson`
  ADD PRIMARY KEY (`crsInId`),
  ADD KEY `crsId` (`crsId`);

--
-- Indexes for table `invoice__body`
--
ALTER TABLE `invoice__body`
  ADD PRIMARY KEY (`invItmId`),
  ADD KEY `invId` (`invId`),
  ADD KEY `crsId` (`crsId`);

--
-- Indexes for table `invoice__header`
--
ALTER TABLE `invoice__header`
  ADD PRIMARY KEY (`invId`),
  ADD KEY `usrId` (`usrId`);

--
-- Indexes for table `lookup__countries`
--
ALTER TABLE `lookup__countries`
  ADD PRIMARY KEY (`cntId`);

--
-- Indexes for table `lookup__courses_type`
--
ALTER TABLE `lookup__courses_type`
  ADD PRIMARY KEY (`typId`);

--
-- Indexes for table `lookup__role`
--
ALTER TABLE `lookup__role`
  ADD PRIMARY KEY (`rolId`);

--
-- Indexes for table `lookup__specialization`
--
ALTER TABLE `lookup__specialization`
  ADD PRIMARY KEY (`spcId`);

--
-- Indexes for table `lookup__sub_specialization`
--
ALTER TABLE `lookup__sub_specialization`
  ADD PRIMARY KEY (`spcSubId`),
  ADD KEY `spcId` (`spcId`);

--
-- Indexes for table `lookup__unclassified`
--
ALTER TABLE `lookup__unclassified`
  ADD PRIMARY KEY (`unclassId`);

--
-- Indexes for table `users__account`
--
ALTER TABLE `users__account`
  ADD PRIMARY KEY (`usrId`),
  ADD UNIQUE KEY `usrEmail` (`usrEmail`),
  ADD KEY `rolId` (`rolId`);

--
-- Indexes for table `users__profile_admin`
--
ALTER TABLE `users__profile_admin`
  ADD PRIMARY KEY (`usrId`);

--
-- Indexes for table `users__profile_lecturer`
--
ALTER TABLE `users__profile_lecturer`
  ADD PRIMARY KEY (`usrId`),
  ADD KEY `cntId` (`cntId`);

--
-- Indexes for table `users__profile_trainee`
--
ALTER TABLE `users__profile_trainee`
  ADD PRIMARY KEY (`usrId`),
  ADD KEY `unclassId` (`unclassId`),
  ADD KEY `spcId` (`spcId`),
  ADD KEY `spcSubId` (`spcSubId`),
  ADD KEY `cntId` (`cntId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `crsId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `courses__inparson`
--
ALTER TABLE `courses__inparson`
  MODIFY `crsInId` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice__body`
--
ALTER TABLE `invoice__body`
  MODIFY `invItmId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `invoice__header`
--
ALTER TABLE `invoice__header`
  MODIFY `invId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lookup__countries`
--
ALTER TABLE `lookup__countries`
  MODIFY `cntId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

--
-- AUTO_INCREMENT for table `lookup__courses_type`
--
ALTER TABLE `lookup__courses_type`
  MODIFY `typId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lookup__role`
--
ALTER TABLE `lookup__role`
  MODIFY `rolId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lookup__specialization`
--
ALTER TABLE `lookup__specialization`
  MODIFY `spcId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `lookup__sub_specialization`
--
ALTER TABLE `lookup__sub_specialization`
  MODIFY `spcSubId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=284;

--
-- AUTO_INCREMENT for table `lookup__unclassified`
--
ALTER TABLE `lookup__unclassified`
  MODIFY `unclassId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users__account`
--
ALTER TABLE `users__account`
  MODIFY `usrId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`typId`) REFERENCES `lookup__courses_type` (`typId`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `courses_ibfk_2` FOREIGN KEY (`spcId`) REFERENCES `lookup__specialization` (`spcId`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `courses_ibfk_3` FOREIGN KEY (`spcSubId`) REFERENCES `lookup__sub_specialization` (`spcSubId`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `courses__inparson`
--
ALTER TABLE `courses__inparson`
  ADD CONSTRAINT `courses__inparson_ibfk_1` FOREIGN KEY (`crsId`) REFERENCES `courses` (`crsId`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `invoice__body`
--
ALTER TABLE `invoice__body`
  ADD CONSTRAINT `invoice__body_ibfk_1` FOREIGN KEY (`invId`) REFERENCES `invoice__header` (`invId`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `invoice__body_ibfk_2` FOREIGN KEY (`crsId`) REFERENCES `courses` (`crsId`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `invoice__header`
--
ALTER TABLE `invoice__header`
  ADD CONSTRAINT `invoice__header_ibfk_1` FOREIGN KEY (`usrId`) REFERENCES `users__account` (`usrId`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `lookup__sub_specialization`
--
ALTER TABLE `lookup__sub_specialization`
  ADD CONSTRAINT `lookup__sub_specialization_ibfk_1` FOREIGN KEY (`spcId`) REFERENCES `lookup__specialization` (`spcId`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `users__account`
--
ALTER TABLE `users__account`
  ADD CONSTRAINT `users__account_ibfk_1` FOREIGN KEY (`rolId`) REFERENCES `lookup__role` (`rolId`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `users__profile_trainee`
--
ALTER TABLE `users__profile_trainee`
  ADD CONSTRAINT `users__profile_trainee_ibfk_1` FOREIGN KEY (`usrId`) REFERENCES `users__account` (`usrId`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `users__profile_trainee_ibfk_2` FOREIGN KEY (`unclassId`) REFERENCES `lookup__unclassified` (`unclassId`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `users__profile_trainee_ibfk_3` FOREIGN KEY (`spcId`) REFERENCES `lookup__specialization` (`spcId`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `users__profile_trainee_ibfk_4` FOREIGN KEY (`spcSubId`) REFERENCES `lookup__sub_specialization` (`spcSubId`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `users__profile_trainee_ibfk_5` FOREIGN KEY (`cntId`) REFERENCES `lookup__countries` (`cntId`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
