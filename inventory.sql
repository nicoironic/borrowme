/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.5.25a : Database - inventory
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`inventory` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `inventory`;

/*Table structure for table `bf_activities` */

DROP TABLE IF EXISTS `bf_activities`;

CREATE TABLE `bf_activities` (
  `activity_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `activity` varchar(255) NOT NULL,
  `module` varchar(255) NOT NULL,
  `created_on` datetime NOT NULL,
  `deleted` tinyint(12) NOT NULL DEFAULT '0',
  PRIMARY KEY (`activity_id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8;

/*Data for the table `bf_activities` */

insert  into `bf_activities`(`activity_id`,`user_id`,`activity`,`module`,`created_on`,`deleted`) values (1,1,'logged in from: 127.0.0.1','users','2013-12-07 09:40:11',0),(2,1,'logged in from: 127.0.0.1','users','2013-12-07 10:25:48',0),(3,1,'logged in from: 127.0.0.1','users','2013-12-07 10:26:28',0),(4,1,'deleted user: admin','users','2013-12-07 10:28:09',0),(5,1,'App settings saved from: 127.0.0.1','core','2013-12-07 10:29:05',0),(6,1,'logged in from: 127.0.0.1','users','2013-12-08 07:12:06',0),(7,1,'Created Module: teachers : 127.0.0.1','modulebuilder','2013-12-08 07:51:46',0),(8,1,'Deleted Module: teachers : 127.0.0.1','builder','2013-12-08 07:52:13',0),(9,1,'Created Module: Teachers : 127.0.0.1','modulebuilder','2013-12-08 07:52:59',0),(10,1,'Created Module: Students : 127.0.0.1','modulebuilder','2013-12-08 08:01:19',0),(11,1,'Created Module: Lab Incharge : 127.0.0.1','modulebuilder','2013-12-08 08:05:09',0),(12,1,'Created Module: Laboratories : 127.0.0.1','modulebuilder','2013-12-08 08:24:29',0),(13,1,'Created Module: Subjects : 127.0.0.1','modulebuilder','2013-12-08 08:32:03',0),(14,1,'Created Module: Items : 127.0.0.1','modulebuilder','2013-12-08 08:38:42',0),(15,1,'Created Module: Items : 127.0.0.1','modulebuilder','2013-12-08 08:38:45',0),(16,1,'Created Module: Returned Items : 127.0.0.1','modulebuilder','2013-12-08 08:44:20',0),(17,1,'logged in from: 127.0.0.1','users','2013-12-08 17:17:47',0),(18,1,'logged in from: 127.0.0.1','users','2013-12-08 17:20:30',0),(19,1,'logged in from: 127.0.0.1','users','2013-12-10 14:13:52',0),(20,1,'logged in from: 127.0.0.1','users','2013-12-11 14:13:03',0),(21,3,'registered a new account.','users','2013-12-11 16:06:01',0),(22,4,'registered a new account.','users','2013-12-11 16:08:32',0),(23,7,'registered a new account.','lab_incharge','2013-12-11 16:22:41',0),(24,8,'registered a new account.','lab_incharge','2013-12-11 16:24:54',0),(25,9,'registered a new account.','lab_incharge','2013-12-11 16:28:38',0),(26,10,'registered a new account.','lab_incharge','2013-12-11 16:29:56',0),(27,11,'registered a new account.','lab_incharge','2013-12-11 16:34:43',0),(28,1,'Created record with ID: 1 : 127.0.0.1','lab_incharge','2013-12-11 16:34:43',0),(29,12,'registered a new account.','lab_incharge','2013-12-11 16:40:38',0),(30,1,'Created record with ID: 1 : 127.0.0.1','lab_incharge','2013-12-11 16:40:38',0),(31,1,'Created record with ID: 8 : 127.0.0.1','lab_incharge','2013-12-11 16:54:06',0),(32,1,'Created record with ID: 9 : 127.0.0.1','lab_incharge','2013-12-11 16:56:29',0),(33,1,'Updated record with ID: 9 : 127.0.0.1','lab_incharge','2013-12-11 17:31:54',0),(34,1,'Updated record with ID: 9 : 127.0.0.1','lab_incharge','2013-12-11 17:32:04',0),(35,1,'Created record with ID: 14 : 127.0.0.1','lab_incharge','2013-12-11 17:56:03',0),(36,1,'Updated record with ID: 14 : 127.0.0.1','lab_incharge','2013-12-11 17:59:57',0),(37,1,'Updated record with ID: 14 : 127.0.0.1','lab_incharge','2013-12-11 18:00:03',0),(38,1,'Deleted record with ID: 14 : 127.0.0.1','lab_incharge','2013-12-11 18:00:29',0),(39,1,'logged in from: 127.0.0.1','users','2013-12-12 15:33:17',0),(40,1,'logged in from: 127.0.0.1','users','2013-12-12 16:27:59',0),(41,1,'logged in from: 127.0.0.1','users','2013-12-12 17:27:42',0),(42,1,'logged in from: 127.0.0.1','users','2013-12-13 15:05:06',0),(43,1,'Created record with ID: 2 : 127.0.0.1','students','2013-12-13 15:18:38',0),(44,1,'Created record with ID: 3 : 127.0.0.1','students','2013-12-13 15:20:18',0),(45,1,'Created record with ID: 4 : 127.0.0.1','students','2013-12-13 15:21:47',0),(46,1,'Created record with ID: 2 : 127.0.0.1','teachers','2013-12-13 15:36:38',0),(47,1,'Created record with ID: 1 : 127.0.0.1','lab_incharge','2013-12-13 15:46:23',0),(48,1,'Created record with ID: 5 : 127.0.0.1','students','2013-12-13 15:47:03',0),(49,1,'Created record with ID: 3 : 127.0.0.1','teachers','2013-12-13 15:48:16',0),(50,1,'Created record with ID: 1 : 127.0.0.1','laboratories','2013-12-13 16:20:21',0),(51,1,'Created record with ID: 2 : 127.0.0.1','lab_incharge','2013-12-13 16:21:04',0),(52,1,'Updated record with ID: 1 : 127.0.0.1','laboratories','2013-12-13 16:21:28',0),(53,1,'Updated record with ID: 1 : 127.0.0.1','laboratories','2013-12-13 17:12:05',0),(54,1,'logged in from: 127.0.0.1','users','2013-12-14 08:28:57',0),(55,1,'Created record with ID: 1 : 127.0.0.1','subjects','2013-12-14 10:31:33',0),(56,1,'logged in from: 127.0.0.1','users','2013-12-14 11:04:45',0),(57,1,'logged in from: 127.0.0.1','users','2014-01-06 17:11:09',0),(58,1,'logged in from: 127.0.0.1','users','2014-01-06 17:13:31',0),(59,1,'logged in from: 127.0.0.1','users','2014-01-07 13:29:26',0),(60,1,'Created record with ID: 1 : 127.0.0.1','items','2014-01-07 13:49:33',0),(61,1,'Updated record with ID: 1 : 127.0.0.1','items','2014-01-07 13:49:50',0),(62,1,'Created record with ID: 2 : 127.0.0.1','items','2014-01-07 13:50:07',0),(63,1,'Updated record with ID: 1 : 127.0.0.1','laboratories','2014-01-07 13:55:21',0),(64,1,'logged in from: 127.0.0.1','users','2014-01-07 14:50:23',0),(65,1,'Updated record with ID: 5 : 127.0.0.1','students','2014-01-07 15:26:14',0),(66,1,'logged in from: 127.0.0.1','users','2014-01-07 15:26:51',0),(67,1,'Updated record with ID: 3 : 127.0.0.1','teachers','2014-01-07 15:32:47',0),(68,1,'Updated record with ID: 5 : 127.0.0.1','students','2014-01-07 15:33:28',0),(69,10,'logged in from: 127.0.0.1','users','2014-01-07 15:35:33',0);

/*Table structure for table `bf_countries` */

DROP TABLE IF EXISTS `bf_countries`;

CREATE TABLE `bf_countries` (
  `iso` char(2) NOT NULL DEFAULT 'US',
  `name` varchar(80) NOT NULL,
  `printable_name` varchar(80) NOT NULL,
  `iso3` char(3) DEFAULT NULL,
  `numcode` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`iso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `bf_countries` */

insert  into `bf_countries`(`iso`,`name`,`printable_name`,`iso3`,`numcode`) values ('AD','ANDORRA','Andorra','AND',20),('AE','UNITED ARAB EMIRATES','United Arab Emirates','ARE',784),('AF','AFGHANISTAN','Afghanistan','AFG',4),('AG','ANTIGUA AND BARBUDA','Antigua and Barbuda','ATG',28),('AI','ANGUILLA','Anguilla','AIA',660),('AL','ALBANIA','Albania','ALB',8),('AM','ARMENIA','Armenia','ARM',51),('AN','NETHERLANDS ANTILLES','Netherlands Antilles','ANT',530),('AO','ANGOLA','Angola','AGO',24),('AQ','ANTARCTICA','Antarctica',NULL,NULL),('AR','ARGENTINA','Argentina','ARG',32),('AS','AMERICAN SAMOA','American Samoa','ASM',16),('AT','AUSTRIA','Austria','AUT',40),('AU','AUSTRALIA','Australia','AUS',36),('AW','ARUBA','Aruba','ABW',533),('AZ','AZERBAIJAN','Azerbaijan','AZE',31),('BA','BOSNIA AND HERZEGOVINA','Bosnia and Herzegovina','BIH',70),('BB','BARBADOS','Barbados','BRB',52),('BD','BANGLADESH','Bangladesh','BGD',50),('BE','BELGIUM','Belgium','BEL',56),('BF','BURKINA FASO','Burkina Faso','BFA',854),('BG','BULGARIA','Bulgaria','BGR',100),('BH','BAHRAIN','Bahrain','BHR',48),('BI','BURUNDI','Burundi','BDI',108),('BJ','BENIN','Benin','BEN',204),('BM','BERMUDA','Bermuda','BMU',60),('BN','BRUNEI DARUSSALAM','Brunei Darussalam','BRN',96),('BO','BOLIVIA','Bolivia','BOL',68),('BR','BRAZIL','Brazil','BRA',76),('BS','BAHAMAS','Bahamas','BHS',44),('BT','BHUTAN','Bhutan','BTN',64),('BV','BOUVET ISLAND','Bouvet Island',NULL,NULL),('BW','BOTSWANA','Botswana','BWA',72),('BY','BELARUS','Belarus','BLR',112),('BZ','BELIZE','Belize','BLZ',84),('CA','CANADA','Canada','CAN',124),('CC','COCOS (KEELING) ISLANDS','Cocos (Keeling) Islands',NULL,NULL),('CD','CONGO, THE DEMOCRATIC REPUBLIC OF THE','Congo, the Democratic Republic of the','COD',180),('CF','CENTRAL AFRICAN REPUBLIC','Central African Republic','CAF',140),('CG','CONGO','Congo','COG',178),('CH','SWITZERLAND','Switzerland','CHE',756),('CI','COTE D\'IVOIRE','Cote D\'Ivoire','CIV',384),('CK','COOK ISLANDS','Cook Islands','COK',184),('CL','CHILE','Chile','CHL',152),('CM','CAMEROON','Cameroon','CMR',120),('CN','CHINA','China','CHN',156),('CO','COLOMBIA','Colombia','COL',170),('CR','COSTA RICA','Costa Rica','CRI',188),('CS','SERBIA AND MONTENEGRO','Serbia and Montenegro',NULL,NULL),('CU','CUBA','Cuba','CUB',192),('CV','CAPE VERDE','Cape Verde','CPV',132),('CX','CHRISTMAS ISLAND','Christmas Island',NULL,NULL),('CY','CYPRUS','Cyprus','CYP',196),('CZ','CZECH REPUBLIC','Czech Republic','CZE',203),('DE','GERMANY','Germany','DEU',276),('DJ','DJIBOUTI','Djibouti','DJI',262),('DK','DENMARK','Denmark','DNK',208),('DM','DOMINICA','Dominica','DMA',212),('DO','DOMINICAN REPUBLIC','Dominican Republic','DOM',214),('DZ','ALGERIA','Algeria','DZA',12),('EC','ECUADOR','Ecuador','ECU',218),('EE','ESTONIA','Estonia','EST',233),('EG','EGYPT','Egypt','EGY',818),('EH','WESTERN SAHARA','Western Sahara','ESH',732),('ER','ERITREA','Eritrea','ERI',232),('ES','SPAIN','Spain','ESP',724),('ET','ETHIOPIA','Ethiopia','ETH',231),('FI','FINLAND','Finland','FIN',246),('FJ','FIJI','Fiji','FJI',242),('FK','FALKLAND ISLANDS (MALVINAS)','Falkland Islands (Malvinas)','FLK',238),('FM','MICRONESIA, FEDERATED STATES OF','Micronesia, Federated States of','FSM',583),('FO','FAROE ISLANDS','Faroe Islands','FRO',234),('FR','FRANCE','France','FRA',250),('GA','GABON','Gabon','GAB',266),('GB','UNITED KINGDOM','United Kingdom','GBR',826),('GD','GRENADA','Grenada','GRD',308),('GE','GEORGIA','Georgia','GEO',268),('GF','FRENCH GUIANA','French Guiana','GUF',254),('GH','GHANA','Ghana','GHA',288),('GI','GIBRALTAR','Gibraltar','GIB',292),('GL','GREENLAND','Greenland','GRL',304),('GM','GAMBIA','Gambia','GMB',270),('GN','GUINEA','Guinea','GIN',324),('GP','GUADELOUPE','Guadeloupe','GLP',312),('GQ','EQUATORIAL GUINEA','Equatorial Guinea','GNQ',226),('GR','GREECE','Greece','GRC',300),('GS','SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS','South Georgia and the South Sandwich Islands',NULL,NULL),('GT','GUATEMALA','Guatemala','GTM',320),('GU','GUAM','Guam','GUM',316),('GW','GUINEA-BISSAU','Guinea-Bissau','GNB',624),('GY','GUYANA','Guyana','GUY',328),('HK','HONG KONG','Hong Kong','HKG',344),('HM','HEARD ISLAND AND MCDONALD ISLANDS','Heard Island and Mcdonald Islands',NULL,NULL),('HN','HONDURAS','Honduras','HND',340),('HR','CROATIA','Croatia','HRV',191),('HT','HAITI','Haiti','HTI',332),('HU','HUNGARY','Hungary','HUN',348),('ID','INDONESIA','Indonesia','IDN',360),('IE','IRELAND','Ireland','IRL',372),('IL','ISRAEL','Israel','ISR',376),('IN','INDIA','India','IND',356),('IO','BRITISH INDIAN OCEAN TERRITORY','British Indian Ocean Territory',NULL,NULL),('IQ','IRAQ','Iraq','IRQ',368),('IR','IRAN, ISLAMIC REPUBLIC OF','Iran, Islamic Republic of','IRN',364),('IS','ICELAND','Iceland','ISL',352),('IT','ITALY','Italy','ITA',380),('JM','JAMAICA','Jamaica','JAM',388),('JO','JORDAN','Jordan','JOR',400),('JP','JAPAN','Japan','JPN',392),('KE','KENYA','Kenya','KEN',404),('KG','KYRGYZSTAN','Kyrgyzstan','KGZ',417),('KH','CAMBODIA','Cambodia','KHM',116),('KI','KIRIBATI','Kiribati','KIR',296),('KM','COMOROS','Comoros','COM',174),('KN','SAINT KITTS AND NEVIS','Saint Kitts and Nevis','KNA',659),('KP','KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF','Korea, Democratic People\'s Republic of','PRK',408),('KR','KOREA, REPUBLIC OF','Korea, Republic of','KOR',410),('KW','KUWAIT','Kuwait','KWT',414),('KY','CAYMAN ISLANDS','Cayman Islands','CYM',136),('KZ','KAZAKHSTAN','Kazakhstan','KAZ',398),('LA','LAO PEOPLE\'S DEMOCRATIC REPUBLIC','Lao People\'s Democratic Republic','LAO',418),('LB','LEBANON','Lebanon','LBN',422),('LC','SAINT LUCIA','Saint Lucia','LCA',662),('LI','LIECHTENSTEIN','Liechtenstein','LIE',438),('LK','SRI LANKA','Sri Lanka','LKA',144),('LR','LIBERIA','Liberia','LBR',430),('LS','LESOTHO','Lesotho','LSO',426),('LT','LITHUANIA','Lithuania','LTU',440),('LU','LUXEMBOURG','Luxembourg','LUX',442),('LV','LATVIA','Latvia','LVA',428),('LY','LIBYAN ARAB JAMAHIRIYA','Libyan Arab Jamahiriya','LBY',434),('MA','MOROCCO','Morocco','MAR',504),('MC','MONACO','Monaco','MCO',492),('MD','MOLDOVA, REPUBLIC OF','Moldova, Republic of','MDA',498),('MG','MADAGASCAR','Madagascar','MDG',450),('MH','MARSHALL ISLANDS','Marshall Islands','MHL',584),('MK','MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF','Macedonia, the Former Yugoslav Republic of','MKD',807),('ML','MALI','Mali','MLI',466),('MM','MYANMAR','Myanmar','MMR',104),('MN','MONGOLIA','Mongolia','MNG',496),('MO','MACAO','Macao','MAC',446),('MP','NORTHERN MARIANA ISLANDS','Northern Mariana Islands','MNP',580),('MQ','MARTINIQUE','Martinique','MTQ',474),('MR','MAURITANIA','Mauritania','MRT',478),('MS','MONTSERRAT','Montserrat','MSR',500),('MT','MALTA','Malta','MLT',470),('MU','MAURITIUS','Mauritius','MUS',480),('MV','MALDIVES','Maldives','MDV',462),('MW','MALAWI','Malawi','MWI',454),('MX','MEXICO','Mexico','MEX',484),('MY','MALAYSIA','Malaysia','MYS',458),('MZ','MOZAMBIQUE','Mozambique','MOZ',508),('NA','NAMIBIA','Namibia','NAM',516),('NC','NEW CALEDONIA','New Caledonia','NCL',540),('NE','NIGER','Niger','NER',562),('NF','NORFOLK ISLAND','Norfolk Island','NFK',574),('NG','NIGERIA','Nigeria','NGA',566),('NI','NICARAGUA','Nicaragua','NIC',558),('NL','NETHERLANDS','Netherlands','NLD',528),('NO','NORWAY','Norway','NOR',578),('NP','NEPAL','Nepal','NPL',524),('NR','NAURU','Nauru','NRU',520),('NU','NIUE','Niue','NIU',570),('NZ','NEW ZEALAND','New Zealand','NZL',554),('OM','OMAN','Oman','OMN',512),('PA','PANAMA','Panama','PAN',591),('PE','PERU','Peru','PER',604),('PF','FRENCH POLYNESIA','French Polynesia','PYF',258),('PG','PAPUA NEW GUINEA','Papua New Guinea','PNG',598),('PH','PHILIPPINES','Philippines','PHL',608),('PK','PAKISTAN','Pakistan','PAK',586),('PL','POLAND','Poland','POL',616),('PM','SAINT PIERRE AND MIQUELON','Saint Pierre and Miquelon','SPM',666),('PN','PITCAIRN','Pitcairn','PCN',612),('PR','PUERTO RICO','Puerto Rico','PRI',630),('PS','PALESTINIAN TERRITORY, OCCUPIED','Palestinian Territory, Occupied',NULL,NULL),('PT','PORTUGAL','Portugal','PRT',620),('PW','PALAU','Palau','PLW',585),('PY','PARAGUAY','Paraguay','PRY',600),('QA','QATAR','Qatar','QAT',634),('RE','REUNION','Reunion','REU',638),('RO','ROMANIA','Romania','ROM',642),('RU','RUSSIAN FEDERATION','Russian Federation','RUS',643),('RW','RWANDA','Rwanda','RWA',646),('SA','SAUDI ARABIA','Saudi Arabia','SAU',682),('SB','SOLOMON ISLANDS','Solomon Islands','SLB',90),('SC','SEYCHELLES','Seychelles','SYC',690),('SD','SUDAN','Sudan','SDN',736),('SE','SWEDEN','Sweden','SWE',752),('SG','SINGAPORE','Singapore','SGP',702),('SH','SAINT HELENA','Saint Helena','SHN',654),('SI','SLOVENIA','Slovenia','SVN',705),('SJ','SVALBARD AND JAN MAYEN','Svalbard and Jan Mayen','SJM',744),('SK','SLOVAKIA','Slovakia','SVK',703),('SL','SIERRA LEONE','Sierra Leone','SLE',694),('SM','SAN MARINO','San Marino','SMR',674),('SN','SENEGAL','Senegal','SEN',686),('SO','SOMALIA','Somalia','SOM',706),('SR','SURINAME','Suriname','SUR',740),('ST','SAO TOME AND PRINCIPE','Sao Tome and Principe','STP',678),('SV','EL SALVADOR','El Salvador','SLV',222),('SY','SYRIAN ARAB REPUBLIC','Syrian Arab Republic','SYR',760),('SZ','SWAZILAND','Swaziland','SWZ',748),('TC','TURKS AND CAICOS ISLANDS','Turks and Caicos Islands','TCA',796),('TD','CHAD','Chad','TCD',148),('TF','FRENCH SOUTHERN TERRITORIES','French Southern Territories',NULL,NULL),('TG','TOGO','Togo','TGO',768),('TH','THAILAND','Thailand','THA',764),('TJ','TAJIKISTAN','Tajikistan','TJK',762),('TK','TOKELAU','Tokelau','TKL',772),('TL','TIMOR-LESTE','Timor-Leste',NULL,NULL),('TM','TURKMENISTAN','Turkmenistan','TKM',795),('TN','TUNISIA','Tunisia','TUN',788),('TO','TONGA','Tonga','TON',776),('TR','TURKEY','Turkey','TUR',792),('TT','TRINIDAD AND TOBAGO','Trinidad and Tobago','TTO',780),('TV','TUVALU','Tuvalu','TUV',798),('TW','TAIWAN, PROVINCE OF CHINA','Taiwan, Province of China','TWN',158),('TZ','TANZANIA, UNITED REPUBLIC OF','Tanzania, United Republic of','TZA',834),('UA','UKRAINE','Ukraine','UKR',804),('UG','UGANDA','Uganda','UGA',800),('UM','UNITED STATES MINOR OUTLYING ISLANDS','United States Minor Outlying Islands',NULL,NULL),('US','UNITED STATES','United States','USA',840),('UY','URUGUAY','Uruguay','URY',858),('UZ','UZBEKISTAN','Uzbekistan','UZB',860),('VA','HOLY SEE (VATICAN CITY STATE)','Holy See (Vatican City State)','VAT',336),('VC','SAINT VINCENT AND THE GRENADINES','Saint Vincent and the Grenadines','VCT',670),('VE','VENEZUELA','Venezuela','VEN',862),('VG','VIRGIN ISLANDS, BRITISH','Virgin Islands, British','VGB',92),('VI','VIRGIN ISLANDS, U.S.','Virgin Islands, U.s.','VIR',850),('VN','VIET NAM','Viet Nam','VNM',704),('VU','VANUATU','Vanuatu','VUT',548),('WF','WALLIS AND FUTUNA','Wallis and Futuna','WLF',876),('WS','SAMOA','Samoa','WSM',882),('YE','YEMEN','Yemen','YEM',887),('YT','MAYOTTE','Mayotte',NULL,NULL),('ZA','SOUTH AFRICA','South Africa','ZAF',710),('ZM','ZAMBIA','Zambia','ZMB',894),('ZW','ZIMBABWE','Zimbabwe','ZWE',716);

/*Table structure for table `bf_email_queue` */

DROP TABLE IF EXISTS `bf_email_queue`;

CREATE TABLE `bf_email_queue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `to_email` varchar(128) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `alt_message` text,
  `max_attempts` int(11) NOT NULL DEFAULT '3',
  `attempts` int(11) NOT NULL DEFAULT '0',
  `success` tinyint(1) NOT NULL DEFAULT '0',
  `date_published` datetime DEFAULT NULL,
  `last_attempt` datetime DEFAULT NULL,
  `date_sent` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `bf_email_queue` */

/*Table structure for table `bf_items` */

DROP TABLE IF EXISTS `bf_items`;

CREATE TABLE `bf_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `specifications` text NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `bf_items` */

insert  into `bf_items`(`id`,`name`,`description`,`specifications`,`quantity`,`status`,`created_on`,`modified_on`) values (1,'test2','test2','test','12','Active','2014-01-07 13:49:33','2014-01-07 13:49:50'),(2,'test','test','test','12','Active','2014-01-07 13:50:07','0000-00-00 00:00:00');

/*Table structure for table `bf_lab_incharge` */

DROP TABLE IF EXISTS `bf_lab_incharge`;

CREATE TABLE `bf_lab_incharge` (
  `worker_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT '0',
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `contact_details` text NOT NULL,
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`worker_id`),
  KEY `SECONDARY` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `bf_lab_incharge` */

insert  into `bf_lab_incharge`(`worker_id`,`user_id`,`firstname`,`lastname`,`address`,`contact_details`,`created_on`,`modified_on`) values (1,9,'Test','Lab Incharge','test','test','2013-12-13 15:46:23','0000-00-00 00:00:00'),(2,12,'Test 2','Lab Incharge','test','test','2013-12-13 16:21:04','0000-00-00 00:00:00');

/*Table structure for table `bf_laboratories` */

DROP TABLE IF EXISTS `bf_laboratories`;

CREATE TABLE `bf_laboratories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `worker_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `bf_laboratories` */

insert  into `bf_laboratories`(`id`,`name`,`teacher_id`,`worker_id`,`subject_id`,`status`,`created_on`,`modified_on`) values (1,'Test',3,1,1,'Inactive','2013-12-13 16:20:21','2014-01-07 13:55:21');

/*Table structure for table `bf_login_attempts` */

DROP TABLE IF EXISTS `bf_login_attempts`;

CREATE TABLE `bf_login_attempts` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(40) NOT NULL,
  `login` varchar(50) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `bf_login_attempts` */

insert  into `bf_login_attempts`(`id`,`ip_address`,`login`,`time`) values (3,'127.0.0.1','test@teacher.com','2014-01-07 22:34:24');

/*Table structure for table `bf_permissions` */

DROP TABLE IF EXISTS `bf_permissions`;

CREATE TABLE `bf_permissions` (
  `permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(100) NOT NULL,
  `status` enum('active','inactive','deleted') NOT NULL DEFAULT 'active',
  PRIMARY KEY (`permission_id`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=utf8;

/*Data for the table `bf_permissions` */

insert  into `bf_permissions`(`permission_id`,`name`,`description`,`status`) values (2,'Site.Content.View','Allow users to view the Content Context','active'),(3,'Site.Reports.View','Allow users to view the Reports Context','active'),(4,'Site.Settings.View','Allow users to view the Settings Context','active'),(5,'Site.Developer.View','Allow users to view the Developer Context','active'),(6,'Bonfire.Roles.Manage','Allow users to manage the user Roles','active'),(7,'Bonfire.Users.Manage','Allow users to manage the site Users','active'),(8,'Bonfire.Users.View','Allow users access to the User Settings','active'),(9,'Bonfire.Users.Add','Allow users to add new Users','active'),(10,'Bonfire.Database.Manage','Allow users to manage the Database settings','active'),(11,'Bonfire.Emailer.Manage','Allow users to manage the Emailer settings','active'),(12,'Bonfire.Logs.View','Allow users access to the Log details','active'),(13,'Bonfire.Logs.Manage','Allow users to manage the Log files','active'),(14,'Bonfire.Emailer.View','Allow users access to the Emailer settings','active'),(15,'Site.Signin.Offline','Allow users to login to the site when the site is offline','active'),(16,'Bonfire.Permissions.View','Allow access to view the Permissions menu unders Settings Context','active'),(17,'Bonfire.Permissions.Manage','Allow access to manage the Permissions in the system','active'),(18,'Bonfire.Roles.Delete','Allow users to delete user Roles','active'),(19,'Bonfire.Modules.Add','Allow creation of modules with the builder.','active'),(20,'Bonfire.Modules.Delete','Allow deletion of modules.','active'),(21,'Permissions.Administrator.Manage','To manage the access control permissions for the Administrator role.','active'),(22,'Permissions.Editor.Manage','To manage the access control permissions for the Editor role.','active'),(24,'Permissions.User.Manage','To manage the access control permissions for the User role.','active'),(25,'Permissions.Developer.Manage','To manage the access control permissions for the Developer role.','active'),(27,'Activities.Own.View','To view the users own activity logs','active'),(28,'Activities.Own.Delete','To delete the users own activity logs','active'),(29,'Activities.User.View','To view the user activity logs','active'),(30,'Activities.User.Delete','To delete the user activity logs, except own','active'),(31,'Activities.Module.View','To view the module activity logs','active'),(32,'Activities.Module.Delete','To delete the module activity logs','active'),(33,'Activities.Date.View','To view the users own activity logs','active'),(34,'Activities.Date.Delete','To delete the dated activity logs','active'),(35,'Bonfire.UI.Manage','Manage the Bonfire UI settings','active'),(36,'Bonfire.Settings.View','To view the site settings page.','active'),(37,'Bonfire.Settings.Manage','To manage the site settings.','active'),(38,'Bonfire.Activities.View','To view the Activities menu.','active'),(39,'Bonfire.Database.View','To view the Database menu.','active'),(40,'Bonfire.Migrations.View','To view the Migrations menu.','active'),(41,'Bonfire.Builder.View','To view the Modulebuilder menu.','active'),(42,'Bonfire.Roles.View','To view the Roles menu.','active'),(43,'Bonfire.Sysinfo.View','To view the System Information page.','active'),(44,'Bonfire.Translate.Manage','To manage the Language Translation.','active'),(45,'Bonfire.Translate.View','To view the Language Translate menu.','active'),(46,'Bonfire.UI.View','To view the UI/Keyboard Shortcut menu.','active'),(49,'Bonfire.Profiler.View','To view the Console Profiler Bar.','active'),(50,'Bonfire.Roles.Add','To add New Roles','active'),(51,'Site.Users.View','Allow user to view the Users Context.','active'),(56,'Teachers.Users.View','','active'),(57,'Teachers.Users.Create','','active'),(58,'Teachers.Users.Edit','','active'),(59,'Teachers.Users.Delete','','active'),(60,'Students.Users.View','','active'),(61,'Students.Users.Create','','active'),(62,'Students.Users.Edit','','active'),(63,'Students.Users.Delete','','active'),(64,'Lab_Incharge.Users.View','','active'),(65,'Lab_Incharge.Users.Create','','active'),(66,'Lab_Incharge.Users.Edit','','active'),(67,'Lab_Incharge.Users.Delete','','active'),(68,'Site.Resources.View','Allow user to view the Resources Context.','active'),(69,'Laboratories.Resources.View','','active'),(70,'Laboratories.Resources.Create','','active'),(71,'Laboratories.Resources.Edit','','active'),(72,'Laboratories.Resources.Delete','','active'),(73,'Subjects.Resources.View','','active'),(74,'Subjects.Resources.Create','','active'),(75,'Subjects.Resources.Edit','','active'),(76,'Subjects.Resources.Delete','','active'),(77,'Items.Resources.View','','active'),(78,'Items.Resources.Create','','active'),(79,'Items.Resources.Edit','','active'),(80,'Items.Resources.Delete','','active'),(81,'Site.Logs.View','Allow user to view the Logs Context.','active'),(82,'Returned_Items.Resources.View','','active'),(83,'Returned_Items.Resources.Create','','active'),(84,'Returned_Items.Resources.Edit','','active'),(85,'Returned_Items.Resources.Delete','','active'),(86,'Returned_Items.Logs.View','','active'),(87,'Returned_Items.Logs.Create','','active'),(88,'Returned_Items.Logs.Edit','','active'),(89,'Returned_Items.Logs.Delete','','active');

/*Table structure for table `bf_returned_items` */

DROP TABLE IF EXISTS `bf_returned_items`;

CREATE TABLE `bf_returned_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `worker_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `bf_returned_items` */

/*Table structure for table `bf_role_permissions` */

DROP TABLE IF EXISTS `bf_role_permissions`;

CREATE TABLE `bf_role_permissions` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  PRIMARY KEY (`role_id`,`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `bf_role_permissions` */

insert  into `bf_role_permissions`(`role_id`,`permission_id`) values (1,2),(1,3),(1,4),(1,5),(1,6),(1,7),(1,8),(1,9),(1,10),(1,11),(1,12),(1,13),(1,14),(1,15),(1,16),(1,17),(1,18),(1,19),(1,20),(1,21),(1,22),(1,24),(1,25),(1,27),(1,28),(1,29),(1,30),(1,31),(1,32),(1,33),(1,34),(1,35),(1,36),(1,37),(1,38),(1,39),(1,40),(1,41),(1,42),(1,43),(1,44),(1,45),(1,46),(1,49),(1,50),(1,51),(1,56),(1,57),(1,58),(1,59),(1,60),(1,61),(1,62),(1,63),(1,64),(1,65),(1,66),(1,67),(1,68),(1,69),(1,70),(1,71),(1,72),(1,73),(1,74),(1,75),(1,76),(1,77),(1,78),(1,79),(1,80),(1,81),(1,82),(1,83),(1,84),(1,85),(1,86),(1,87),(1,88),(1,89),(2,2),(2,3),(2,51),(2,68),(2,81),(6,2),(6,3),(6,4),(6,5),(6,6),(6,7),(6,8),(6,9),(6,10),(6,11),(6,12),(6,13),(6,49),(6,51),(6,68),(6,81);

/*Table structure for table `bf_roles` */

DROP TABLE IF EXISTS `bf_roles`;

CREATE TABLE `bf_roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(60) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `default` tinyint(1) NOT NULL DEFAULT '0',
  `can_delete` tinyint(1) NOT NULL DEFAULT '1',
  `login_destination` varchar(255) NOT NULL DEFAULT '/',
  `deleted` int(1) NOT NULL DEFAULT '0',
  `default_context` varchar(255) NOT NULL DEFAULT 'content',
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `bf_roles` */

insert  into `bf_roles`(`role_id`,`role_name`,`description`,`default`,`can_delete`,`login_destination`,`deleted`,`default_context`) values (1,'Administrator','Has full control over every aspect of the site.',0,0,'',0,'content'),(2,'Editor','Can handle day-to-day management, but does not have full power.',0,1,'',0,'content'),(4,'User','This is the default user with access to login.',1,0,'',0,'content'),(6,'Developer','Developers typically are the only ones that can access the developer tools. Otherwise identical to Administrators, at least until the site is handed off.',0,1,'',0,'content');

/*Table structure for table `bf_schema_version` */

DROP TABLE IF EXISTS `bf_schema_version`;

CREATE TABLE `bf_schema_version` (
  `type` varchar(40) NOT NULL,
  `version` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `bf_schema_version` */

insert  into `bf_schema_version`(`type`,`version`) values ('core',37),('items_',2),('laboratories_',2),('lab_incharge_',2),('returned_items_',2),('students_',2),('subjects_',2),('teachers_',2);

/*Table structure for table `bf_sessions` */

DROP TABLE IF EXISTS `bf_sessions`;

CREATE TABLE `bf_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `bf_sessions` */

/*Table structure for table `bf_settings` */

DROP TABLE IF EXISTS `bf_settings`;

CREATE TABLE `bf_settings` (
  `name` varchar(30) NOT NULL,
  `module` varchar(50) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `bf_settings` */

insert  into `bf_settings`(`name`,`module`,`value`) values ('auth.allow_name_change','core','1'),('auth.allow_register','core','1'),('auth.allow_remember','core','1'),('auth.do_login_redirect','core','1'),('auth.login_type','core','email'),('auth.name_change_frequency','core','1'),('auth.name_change_limit','core','1'),('auth.password_force_mixed_case','core','0'),('auth.password_force_numbers','core','0'),('auth.password_force_symbols','core','0'),('auth.password_min_length','core','8'),('auth.password_show_labels','core','0'),('auth.remember_length','core','1209600'),('auth.user_activation_method','core','0'),('auth.use_extended_profile','core','0'),('auth.use_usernames','core','1'),('ext.country','core','US'),('ext.state','core','CA'),('ext.street_name','core',''),('ext.type','core','small'),('form_save','core.ui','ctrl+s/⌘+s'),('goto_content','core.ui','alt+c'),('mailpath','email','/usr/sbin/sendmail'),('mailtype','email','text'),('password_iterations','users','8'),('protocol','email','mail'),('sender_email','email',''),('site.languages','core','a:3:{i:0;s:7:\"english\";i:1;s:7:\"persian\";i:2;s:10:\"portuguese\";}'),('site.list_limit','core','25'),('site.show_front_profiler','core','1'),('site.show_profiler','core','1'),('site.status','core','1'),('site.system_email','core','admin@borrowme.com'),('site.title','core','BorrowMe'),('smtp_host','email',''),('smtp_pass','email',''),('smtp_port','email',''),('smtp_timeout','email',''),('smtp_user','email',''),('updates.bleeding_edge','core','0'),('updates.do_check','core','0');

/*Table structure for table `bf_states` */

DROP TABLE IF EXISTS `bf_states`;

CREATE TABLE `bf_states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(40) NOT NULL,
  `abbrev` char(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;

/*Data for the table `bf_states` */

insert  into `bf_states`(`id`,`name`,`abbrev`) values (1,'Alaska','AK'),(2,'Alabama','AL'),(3,'American Samoa','AS'),(4,'Arizona','AZ'),(5,'Arkansas','AR'),(6,'California','CA'),(7,'Colorado','CO'),(8,'Connecticut','CT'),(9,'Delaware','DE'),(10,'District of Columbia','DC'),(11,'Florida','FL'),(12,'Georgia','GA'),(13,'Guam','GU'),(14,'Hawaii','HI'),(15,'Idaho','ID'),(16,'Illinois','IL'),(17,'Indiana','IN'),(18,'Iowa','IA'),(19,'Kansas','KS'),(20,'Kentucky','KY'),(21,'Louisiana','LA'),(22,'Maine','ME'),(23,'Marshall Islands','MH'),(24,'Maryland','MD'),(25,'Massachusetts','MA'),(26,'Michigan','MI'),(27,'Minnesota','MN'),(28,'Mississippi','MS'),(29,'Missouri','MO'),(30,'Montana','MT'),(31,'Nebraska','NE'),(32,'Nevada','NV'),(33,'New Hampshire','NH'),(34,'New Jersey','NJ'),(35,'New Mexico','NM'),(36,'New York','NY'),(37,'North Carolina','NC'),(38,'North Dakota','ND'),(39,'Northern Mariana Islands','MP'),(40,'Ohio','OH'),(41,'Oklahoma','OK'),(42,'Oregon','OR'),(43,'Palau','PW'),(44,'Pennsylvania','PA'),(45,'Puerto Rico','PR'),(46,'Rhode Island','RI'),(47,'South Carolina','SC'),(48,'South Dakota','SD'),(49,'Tennessee','TN'),(50,'Texas','TX'),(51,'Utah','UT'),(52,'Vermont','VT'),(53,'Virgin Islands','VI'),(54,'Virginia','VA'),(55,'Washington','WA'),(56,'West Virginia','WV'),(57,'Wisconsin','WI'),(58,'Wyoming','WY'),(59,'Armed Forces Africa','AE'),(60,'Armed Forces Canada','AE'),(61,'Armed Forces Europe','AE'),(62,'Armed Forces Middle East','AE'),(63,'Armed Forces Pacific','AP');

/*Table structure for table `bf_students` */

DROP TABLE IF EXISTS `bf_students`;

CREATE TABLE `bf_students` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT '0',
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `contact_details` text NOT NULL,
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `bf_students` */

insert  into `bf_students`(`student_id`,`user_id`,`firstname`,`lastname`,`address`,`contact_details`,`created_on`,`modified_on`) values (5,10,'Test','Student','test','test','2013-12-13 15:47:03','2014-01-07 15:33:28');

/*Table structure for table `bf_subjects` */

DROP TABLE IF EXISTS `bf_subjects`;

CREATE TABLE `bf_subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `bf_subjects` */

insert  into `bf_subjects`(`id`,`name`,`description`,`time_start`,`time_end`,`status`,`created_on`,`modified_on`) values (1,'test','test','03:20:00','06:00:00','Active','2013-12-14 10:31:33','0000-00-00 00:00:00');

/*Table structure for table `bf_teachers` */

DROP TABLE IF EXISTS `bf_teachers`;

CREATE TABLE `bf_teachers` (
  `teacher_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT '0',
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `contact_details` text NOT NULL,
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`teacher_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `bf_teachers` */

insert  into `bf_teachers`(`teacher_id`,`user_id`,`firstname`,`lastname`,`address`,`contact_details`,`created_on`,`modified_on`) values (3,11,'Test','Teacher','test','test','2013-12-13 15:48:16','2014-01-07 15:32:47');

/*Table structure for table `bf_user_cookies` */

DROP TABLE IF EXISTS `bf_user_cookies`;

CREATE TABLE `bf_user_cookies` (
  `user_id` bigint(20) NOT NULL,
  `token` varchar(128) NOT NULL,
  `created_on` datetime NOT NULL,
  KEY `token` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `bf_user_cookies` */

/*Table structure for table `bf_user_meta` */

DROP TABLE IF EXISTS `bf_user_meta`;

CREATE TABLE `bf_user_meta` (
  `meta_id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) NOT NULL DEFAULT '',
  `meta_value` text,
  PRIMARY KEY (`meta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `bf_user_meta` */

/*Table structure for table `bf_users` */

DROP TABLE IF EXISTS `bf_users`;

CREATE TABLE `bf_users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL DEFAULT '4',
  `role_desc` varchar(30) DEFAULT NULL,
  `email` varchar(120) NOT NULL,
  `username` varchar(30) NOT NULL DEFAULT '',
  `password_hash` char(60) NOT NULL,
  `reset_hash` varchar(40) DEFAULT NULL,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_ip` varchar(40) NOT NULL DEFAULT '',
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `reset_by` int(10) DEFAULT NULL,
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `ban_message` varchar(255) DEFAULT NULL,
  `display_name` varchar(255) DEFAULT '',
  `display_name_changed` date DEFAULT NULL,
  `timezone` char(4) NOT NULL DEFAULT 'UM6',
  `language` varchar(20) NOT NULL DEFAULT 'english',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `activate_hash` varchar(40) NOT NULL DEFAULT '',
  `password_iterations` int(4) NOT NULL,
  `force_password_reset` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `bf_users` */

insert  into `bf_users`(`id`,`role_id`,`role_desc`,`email`,`username`,`password_hash`,`reset_hash`,`last_login`,`last_ip`,`created_on`,`deleted`,`reset_by`,`banned`,`ban_message`,`display_name`,`display_name_changed`,`timezone`,`language`,`active`,`activate_hash`,`password_iterations`,`force_password_reset`) values (1,1,NULL,'admin@mybonfire.com','admin','$2a$08$2/uriM88AssTxWV77HtOj.H9jRjuXFsREKvgoAi0hwvjU.whUx7v6',NULL,'2014-01-07 15:26:51','127.0.0.1','2013-12-07 09:29:58',0,NULL,0,NULL,'admin',NULL,'UM6','english',1,'',0,0),(2,1,NULL,'admin@mybonfire.com','admin','$2a$08$vJqDur1JWy4oeEo8vQ7iku/uH5t1ALKfFURWJjYQjLNsVHrhQnoXu',NULL,'0000-00-00 00:00:00','','2013-12-07 09:39:14',1,NULL,0,NULL,'admin',NULL,'UM6','english',1,'',0,0),(5,4,NULL,'vaganic@gmail.com','vaganic','$2a$08$j3i6/CM6ewQDucS79depC.gEGRdCIiSoaaXSwl6EWCYl88NKYNtvO',NULL,'0000-00-00 00:00:00','','2013-12-13 15:20:18',0,NULL,0,NULL,'vaganic',NULL,'UM6','english',1,'',8,0),(6,4,NULL,'vaganic@gmail.coms','vaganic2','$2a$08$GaqUkgq3PXRKd9mfCAHXiu8aATG/3n7/TjFtHG8euk3XXZjDYOFUO',NULL,'0000-00-00 00:00:00','','2013-12-13 15:21:47',0,NULL,0,NULL,'vaganic2',NULL,'UM6','english',1,'',8,0),(8,4,NULL,'nico@gmail.com','niconico','$2a$08$sMdExdFYGyAsHdXiqtP6F.WGGwT30BrehXsGqG.JsvK1ebMNL2Qgi',NULL,'0000-00-00 00:00:00','','2013-12-13 15:36:38',0,NULL,0,NULL,'niconico',NULL,'UM6','english',1,'',8,0),(9,4,NULL,'lab@incharge.com','labincharge','$2a$08$cO9iu9KbkW6k0pRTtYbOGuSgWTPutx0OyNsiMS6i6bipiITZbXj1y',NULL,'0000-00-00 00:00:00','','2013-12-13 15:46:23',0,NULL,0,NULL,'labincharge',NULL,'UM6','english',1,'',8,0),(10,4,'student','test@student.com','student','$2a$08$2/uriM88AssTxWV77HtOj.H9jRjuXFsREKvgoAi0hwvjU.whUx7v6',NULL,'2014-01-07 15:35:33','127.0.0.1','2013-12-13 15:47:03',0,NULL,0,NULL,'student',NULL,'UM6','english',1,'',8,0),(11,4,NULL,'test@teacher.com','teacher','$2a$08$UpfJLa95tGHv3djIPwZkbuBX76V/o6x4S0nEpHpaIUiWxO8oHemki',NULL,'0000-00-00 00:00:00','','2013-12-13 15:48:16',0,NULL,0,NULL,'teacher',NULL,'UM6','english',1,'',8,0),(12,4,NULL,'test2@labincharge.com','test2lab','$2a$08$ttV1FPtdY7inqx8e5ci1o.IwL4hoyN4ucxwx1WkaYKG9kLm5JUXeK',NULL,'0000-00-00 00:00:00','','2013-12-13 16:21:04',0,NULL,0,NULL,'test2lab',NULL,'UM6','english',1,'',8,0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
