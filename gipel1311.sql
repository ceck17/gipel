-- phpMyAdmin SQL Dump
-- version 4.0.5
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- GÃ©nÃ©rÃ© le: Sam 26 Octobre 2013 Ã  18:07
-- Version du serveur: 5.1.70-cll
-- Version de PHP: 5.3.17

-- --------------------------------------------------------

--
-- Base de donnÃ©es: `gipel1311`
--

-- --------------------------------------------------------

--
-- Structure de la table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `country_id` smallint(4) NOT NULL,
  `country_short` varchar(2) NOT NULL,
  `country_en` varchar(32) DEFAULT NULL,
  `country_fr` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `country`
--

INSERT INTO `country` (`country_id`, `country_short`, `country_en`, `country_fr`) VALUES
(101, 'AD', 'Andorra', 'Andorre'),
(102, 'AE', 'United Arab Emirates', 'Ãmirats Arabes Unis'),
(103, 'AF', 'Afghanistan', 'Afghanistan'),
(104, 'AG', 'Antigua and Barbuda', 'Antigua-et-Barbuda'),
(105, 'AI', 'Anguilla', 'Anguilla'),
(106, 'AL', 'Albania', 'Albanie'),
(107, 'AM', 'Armenia', 'ArmÃ©nie'),
(108, 'AN', 'Netherlands Antilles', 'Antilles NÃ©erlandaises'),
(109, 'AO', 'Angola', 'Angola'),
(110, 'AQ', 'Antarctica', 'Antarctique'),
(111, 'AR', 'Argentina', 'Argentine'),
(112, 'AS', 'American Samoa', 'Samoa AmÃ©ricaines'),
(113, 'AT', 'Austria', 'Autriche'),
(114, 'AU', 'Australia', 'Australie'),
(115, 'AW', 'Aruba', 'Aruba'),
(116, 'AX', 'Ãland Islands', 'Isles d''Ãland'),
(117, 'AZ', 'Azerbaijan', 'AzerbaÃ¯djan'),
(118, 'BA', 'Bosnia and Herzegovina', 'Bosnie-HerzÃ©govine'),
(119, 'BB', 'Barbados', 'Barbade'),
(120, 'BD', 'Bangladesh', 'Bangladesh'),
(121, 'BE', 'Belgium', 'Belgique'),
(122, 'BF', 'Burkina Faso', 'Burkina Faso'),
(123, 'BG', 'Bulgaria', 'Bulgarie'),
(124, 'BH', 'Bahrain', 'BahreÃ¯n'),
(125, 'BI', 'Burundi', 'Burundi'),
(126, 'BJ', 'Benin', 'BÃ©nin'),
(127, 'BM', 'Bermuda', 'Bermudes'),
(128, 'BN', 'Brunei Darussalam', 'BrunÃ©i Darussalam'),
(129, 'BO', 'BoliviaA Plurinational State of', 'Bolivie'),
(130, 'BR', 'Brazil', 'BrÃ©sil'),
(131, 'BS', 'Bahamas', 'Bahamas'),
(132, 'BT', 'Bhutan', 'Bhoutan'),
(133, 'BV', 'Bouvet Island', 'Bouvet, Ãle'),
(134, 'BW', 'Botswana', 'Botswana'),
(135, 'BY', 'Belarus', 'BÃ©larus'),
(136, 'BZ', 'Belize', 'Belize'),
(137, 'CA', 'Canada', 'Canada'),
(138, 'CC', 'Cocos (Keeling) Islands', 'Cocos (Keeling), Ãles'),
(139, 'CD', 'Congo, Democratic Republic of', 'Congo (RÃ©publique DÃ©mocratique)'),
(140, 'CF', 'Central African Republic', 'Centrafricaine, RÃ©publique'),
(141, 'CG', 'Congo', 'Congo'),
(142, 'CH', 'Switzerland', 'Suisse'),
(143, 'CI', 'CÃ´te d''Ivoire', 'CÃ´te d''Ivoire'),
(144, 'CK', 'Cook Islands', 'Cook, Ãles'),
(145, 'CL', 'Chile', 'Chili'),
(146, 'CM', 'Cameroon', 'Cameroun'),
(147, 'CN', 'China', 'Chine'),
(148, 'CO', 'Colombia', 'Colombie'),
(149, 'CR', 'Costa Rica', 'Costa Rica'),
(150, 'CU', 'Cuba', 'Cuba'),
(151, 'CV', 'Cape Verde', 'Cap-Vert'),
(152, 'CX', 'Christmas Island', 'Christmas, Ãle'),
(153, 'CY', 'Cyprus', 'Chypre'),
(154, 'CZ', 'Czech Republic', 'TchÃ¨que, RÃ©publique'),
(155, 'DE', 'Germany', 'Allemagne'),
(156, 'DJ', 'Djibouti', 'Djibouti'),
(157, 'DK', 'Denmark', 'Danemark'),
(158, 'DM', 'Dominica', 'Dominique'),
(159, 'DO', 'Dominican Republic', 'Dominicaine, RÃ©publique'),
(160, 'DZ', 'Algeria', 'AlgÃ©rie'),
(161, 'EC', 'Ecuador', 'Ãquateur'),
(162, 'EE', 'Estonia', 'Estonie'),
(163, 'EG', 'Egypt', 'Ãgypte'),
(164, 'EH', 'Western Sahara', 'Sahara Occidental'),
(165, 'ER', 'Eritrea', 'ÃrythrÃ©e'),
(166, 'ES', 'Spain', 'Espagne'),
(167, 'ET', 'Ethiopia', 'Ãthiopie'),
(168, 'FI', 'Finland', 'Finlande'),
(169, 'FJ', 'Fiji', 'Fidji'),
(170, 'FK', 'Falkland Islands (Malvinas)', 'Falkland, Ãles (Malvinas)'),
(171, 'FM', 'Micronesia, Federated States of', 'MicronÃ©sie, Ãtats FÃ©dÃ©rÃ©s de'),
(172, 'FO', 'Faroe Islands', 'FÃ©roÃ©, Ãles'),
(173, 'FR', 'France', 'France'),
(174, 'GA', 'Gabon', 'Gabon'),
(175, 'GB', 'United Kingdom', 'Royaume-Uni'),
(176, 'GD', 'Grenada', 'Grenade'),
(177, 'GE', 'Georgia', 'GÃ©orgie'),
(178, 'GF', 'French Guiana', 'Guyane FranÃ§aise'),
(179, 'GG', 'Guernsey', 'Guernesey'),
(180, 'GH', 'Ghana', 'Ghana'),
(181, 'GI', 'Gibraltar', 'Gibraltar'),
(182, 'GL', 'Greenland', 'Groenland'),
(183, 'GM', 'Gambia', 'Gambie'),
(184, 'GN', 'Guinea', 'GuinÃ©e'),
(185, 'GP', 'Guadeloupe', 'Guadeloupe'),
(186, 'GQ', 'Equatorial Guinea', 'GuinÃ©e Ãquatoriale'),
(187, 'GR', 'Greece', 'GrÃ¨ce'),
(188, 'GS', 'South Georgia/Sandwich Islands', 'GÃ©orgie et Ãles Sandwich du Sud'),
(189, 'GT', 'Guatemala', 'Guatemala'),
(190, 'GU', 'Guam', 'Guam'),
(191, 'GW', 'Guinea-Bissau', 'GuinÃ©e-Bissau'),
(192, 'GY', 'Guyana', 'Guyana'),
(193, 'HK', 'Hong Kong', 'Hong-Kong'),
(194, 'HM', 'Heard and Mcdonald Islands', 'Heard et Mcdonald, Ãles'),
(195, 'HN', 'Honduras', 'Honduras'),
(196, 'HR', 'Croatia', 'Croatie'),
(197, 'HT', 'Haiti', 'HaÃ¯ti'),
(198, 'HU', 'Hungary', 'Hongrie'),
(199, 'ID', 'Indonesia', 'IndonÃ©sie'),
(200, 'IE', 'Ireland', 'Irlande'),
(201, 'IL', 'Israel', 'IsraÃ«l'),
(202, 'IM', 'Isle of Man', 'Ãle de Man'),
(203, 'IN', 'India', 'Inde'),
(204, 'IO', 'British Indian Ocean Territory', 'OcÃ©an Indien (Territ. Britan.)'),
(205, 'IQ', 'Iraq', 'Iraq'),
(206, 'IR', 'Iran, Islamic Republic of', 'Iran, RÃ©publique Islamique d'''),
(207, 'IS', 'Iceland', 'Islande'),
(208, 'IT', 'Italy', 'Italie'),
(209, 'JE', 'Jersey', 'Jersey'),
(210, 'JM', 'Jamaica', 'JamaÃ¯que'),
(211, 'JO', 'Jordan', 'Jordanie'),
(212, 'JP', 'Japan', 'Japon'),
(213, 'KE', 'Kenya', 'Kenya'),
(214, 'KG', 'Kyrgyzstan', 'Kirghizistan'),
(215, 'KH', 'Cambodia', 'Cambodge'),
(216, 'KI', 'Kiribati', 'Kiribati'),
(217, 'KM', 'Comoros', 'Comores'),
(218, 'KN', 'Saint Kitts and Nevis', 'Saint-Kitts-et-Nevis'),
(219, 'KP', 'Korea, Ddemocratic Republic of', 'CorÃ©e (RÃ©publique Populaire D.)'),
(220, 'KR', 'Korea, Republic of', 'CorÃ©e, RÃ©publique de'),
(221, 'KW', 'Kuwait', 'KoweÃ¯t'),
(222, 'KY', 'Cayman Islands', 'CaÃ¯manes, Ãles'),
(223, 'KZ', 'Kazakhstan', 'Kazakhstan'),
(224, 'LA', 'Lao People S Democrat. Republic', 'Lao (RÃ©publique DÃ©mocrat. Pop.)'),
(225, 'LB', 'Lebanon', 'Liban'),
(226, 'LC', 'Saint Lucia', 'Sainte-Lucie'),
(227, 'LI', 'Liechtenstein', 'Liechtenstein'),
(228, 'LK', 'Sri Lanka', 'Sri Lanka'),
(229, 'LR', 'Liberia', 'LibÃ©ria'),
(230, 'LS', 'Lesotho', 'Lesotho'),
(231, 'LT', 'Lithuania', 'Lituanie'),
(232, 'LU', 'Luxembourg', 'Luxembourg'),
(233, 'LV', 'Latvia', 'Lettonie'),
(234, 'LY', 'Libyan Arab Jamahiriya', 'Libyenne, Jamahiriya Arabe'),
(235, 'MA', 'Morocco', 'Maroc'),
(236, 'MC', 'Monaco', 'Monaco'),
(237, 'MD', 'Moldova, Republic of', 'Moldova, RÃ©publique de'),
(238, 'ME', 'Montenegro', 'MontÃ©nÃ©gro'),
(239, 'MG', 'Madagascar', 'Madagascar'),
(240, 'MH', 'Marshall Islands', 'Marshall, Ãles'),
(241, 'MK', 'Macedonia, Former Yugoslav R.', 'MacÃ©doine (Ex-RÃ©p.Yougoslave)'),
(242, 'ML', 'Mali', 'Mali'),
(243, 'MM', 'Myanmar', 'Myanmar'),
(244, 'MN', 'Mongolia', 'Mongolie'),
(245, 'MO', 'Macao', 'Macao'),
(246, 'MP', 'Northern Mariana Islands', 'Mariannes du Nord, Ãles'),
(247, 'MQ', 'Martinique', 'Martinique'),
(248, 'MR', 'Mauritania', 'Mauritanie'),
(249, 'MS', 'Montserrat', 'Montserrat'),
(250, 'MT', 'Malta', 'Malte'),
(251, 'MU', 'Mauritius', 'Maurice'),
(252, 'MV', 'Maldives', 'Maldives'),
(253, 'MW', 'Malawi', 'Malawi'),
(254, 'MX', 'Mexico', 'Mexique'),
(255, 'MY', 'Malaysia', 'Malaisie'),
(256, 'MZ', 'Mozambique', 'Mozambique'),
(257, 'NA', 'Namibia', 'Namibie'),
(258, 'NC', 'New Caledonia', 'Nouvelle-CalÃ©donie'),
(259, 'NE', 'Niger', 'Niger'),
(260, 'NF', 'Norfolk Island', 'Norfolk, Ãle'),
(261, 'NG', 'Nigeria', 'NigÃ©ria'),
(262, 'NI', 'Nicaragua', 'Nicaragua'),
(263, 'NL', 'Netherlands', 'Pays-Bas'),
(264, 'NO', 'Norway', 'NorvÃ¨ge'),
(265, 'NP', 'Nepal', 'NÃ©pal'),
(266, 'NR', 'Nauru', 'Nauru'),
(267, 'NU', 'Niue', 'NiuÃ©'),
(268, 'NZ', 'New Zealand', 'Nouvelle-ZÃ©lande'),
(269, 'OM', 'Oman', 'Oman'),
(270, 'PA', 'Panama', 'Panama'),
(271, 'PE', 'Peru', 'PÃ©rou'),
(272, 'PF', 'French Polynesia', 'PolynÃ©sie FranÃ§aise'),
(273, 'PG', 'Papua New Guinea', 'Papouasie-Nouvelle-GuinÃ©e'),
(274, 'PH', 'Philippines', 'Philippines'),
(275, 'PK', 'Pakistan', 'Pakistan'),
(276, 'PL', 'Poland', 'Pologne'),
(277, 'PM', 'Saint Pierre and Miquelon', 'Saint-Pierre-et-Miquelon'),
(278, 'PN', 'Pitcairn', 'Pitcairn'),
(279, 'PR', 'Puerto Rico', 'Porto Rico'),
(280, 'PS', 'Palestinian Territory, Occupied', 'Palestinien OccupÃ©, Territoire'),
(281, 'PT', 'Portugal', 'Portugal'),
(282, 'PW', 'Palau', 'Palaos'),
(283, 'PY', 'Paraguay', 'Paraguay'),
(284, 'QA', 'Qatar', 'Qatar'),
(285, 'RE', 'RÃ©union', 'RÃ©union'),
(286, 'RO', 'Romania', 'Roumanie'),
(287, 'RS', 'Serbia', 'Serbie'),
(288, 'RU', 'Russian Federation', 'Russie, FÃ©dÃ©ration de'),
(289, 'RW', 'Rwanda', 'Rwanda'),
(290, 'SA', 'Saudi Arabia', 'Arabie Saoudite'),
(291, 'SB', 'Solomon Islands', 'Salomon, Ãles'),
(292, 'SC', 'Seychelles', 'Seychelles'),
(293, 'SD', 'Sudan', 'Soudan'),
(294, 'SE', 'Sweden', 'SuÃ¨de'),
(295, 'SG', 'Singapore', 'Singapour'),
(296, 'SH', 'Saint Helena', 'Sainte-HÃ©lÃ¨ne'),
(297, 'SI', 'Slovenia', 'SlovÃ©nie'),
(298, 'SJ', 'Svalbard and Jan Mayen', 'Svalbard et Ãle Jan Mayen'),
(299, 'SK', 'Slovakia', 'Slovaquie'),
(300, 'SL', 'Sierra Leone', 'Sierra Leone'),
(301, 'SM', 'San Marino', 'Saint-Marin'),
(302, 'SN', 'Senegal', 'SÃ©nÃ©gal'),
(303, 'SO', 'Somalia', 'Somalie'),
(304, 'SR', 'Suriname', 'Suriname'),
(305, 'ST', 'Sao Tome and Principe', 'Sao TomÃ©-et-Principe'),
(306, 'SV', 'El Salvador', 'El Salvador'),
(307, 'SY', 'Syrian Arab Republic', 'Syrienne, RÃ©publique Arabe'),
(308, 'SZ', 'Swaziland', 'Swaziland'),
(309, 'TC', 'Turks and Caicos Islands', 'Turks et CaÃ¯ques, Ãles'),
(310, 'TD', 'Chad', 'Tchad'),
(311, 'TF', 'French Southern Territories', 'Terres Australes FranÃ§aises'),
(312, 'TG', 'Togo', 'Togo'),
(313, 'TH', 'Thailand', 'ThaÃ¯lande'),
(314, 'TJ', 'Tajikistan', 'Tadjikistan'),
(315, 'TK', 'Tokelau', 'Tokelau'),
(316, 'TL', 'Timor-Leste', 'Timor-Leste'),
(317, 'TM', 'Turkmenistan', 'TurkmÃ©nistan'),
(318, 'TN', 'Tunisia', 'Tunisie'),
(319, 'TO', 'Tonga', 'Tonga'),
(320, 'TR', 'Turkey', 'Turquie'),
(321, 'TT', 'Trinidad and Tobago', 'TrinitÃ©-et-Tobago'),
(322, 'TV', 'Tuvalu', 'Tuvalu'),
(323, 'TW', 'Taiwan, Province of China', 'TaÃ¯wan, Province de Chine'),
(324, 'TZ', 'Tanzania, United Republic of', 'Tanzanie, RÃ©publique-Unie de'),
(325, 'UA', 'Ukraine', 'Ukraine'),
(326, 'UG', 'Uganda', 'Ouganda'),
(327, 'UM', 'United States Minor Out.Islands', 'Ãles Mineures des Ãtats-Unis'),
(328, 'US', 'United States', 'Ãtats-Unis'),
(329, 'UY', 'Uruguay', 'Uruguay'),
(330, 'UZ', 'Uzbekistan', 'OuzbÃ©kistan'),
(331, 'VA', 'Holy See (Vatican City State)', 'Saint-SiÃ¨ge (Vatican)'),
(332, 'VC', 'Saint Vincent & The Grenadines', 'Saint-Vincent-et-Les Grenadines'),
(333, 'VE', 'Venezuela, Bolivarian Republ.of', 'Venezuela '),
(334, 'VG', 'Virgin Islands, British', 'Ãles Vierges Britanniques'),
(335, 'VI', 'Virgin Islands, U.S.', 'Ãles Vierges des Ãtats-Unis'),
(336, 'VN', 'Viet Nam', 'Viet Nam'),
(337, 'VU', 'Vanuatu', 'Vanuatu'),
(338, 'WF', 'Wallis and Futuna', 'Wallis et Futuna'),
(339, 'WS', 'Samoa', 'Samoa'),
(340, 'YE', 'Yemen', 'YÃ©men'),
(341, 'YT', 'Mayotte', 'Mayotte'),
(342, 'ZA', 'South Africa', 'Afrique du Sud'),
(343, 'ZM', 'Zambia', 'Zambie'),
(344, 'ZW', 'Zimbabwe', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Structure de la table `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `gid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `group_itemid` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `wording` varchar(24) NOT NULL DEFAULT '',
  PRIMARY KEY (`gid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=111 ;

--
-- Contenu de la table `group`
--

INSERT INTO `group` (`gid`, `group_itemid`, `wording`) VALUES
(100, 1, 'Famille'),
(101, 1, 'Artiste'),
(102, 2, 'Infos diverses'),
(103, 2, 'Ã  la une'),
(104, 3, 'Administration'),
(105, 3, 'Electronique'),
(106, 4, 'Sites divers'),
(107, 4, 'RÃ©seaux sociaux'),
(110, 4, 'BoÃ®te mail');

-- --------------------------------------------------------

--
-- Structure de la table `input`
--

CREATE TABLE IF NOT EXISTS `input` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `itemid` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `groupid` smallint(6) NOT NULL DEFAULT '0',
  `keywords` text,
  `title` varchar(16) DEFAULT NULL,
  `first_name` varchar(32) NOT NULL DEFAULT '',
  `last_name` varchar(32) NOT NULL DEFAULT '',
  `adress1` varchar(64) NOT NULL DEFAULT '',
  `adress2` varchar(64) DEFAULT NULL,
  `postcode` varchar(8) NOT NULL DEFAULT '',
  `city` varchar(32) NOT NULL DEFAULT '',
  `country_id` smallint(4) NOT NULL DEFAULT '173',
  `phone_home` varchar(24) DEFAULT NULL,
  `phone_work` varchar(24) DEFAULT NULL,
  `phone_cell` varchar(24) DEFAULT NULL,
  `fax` varchar(24) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL DEFAULT '',
  `url` text,
  `gmap` text,
  `birthday` date DEFAULT '1000-01-01',
  `memo` mediumtext,
  `history` text,
  `width` smallint(6) NOT NULL DEFAULT '800',
  `height` smallint(6) NOT NULL DEFAULT '400',
  `clicks` int(11) NOT NULL DEFAULT '1',
  `visibility` varchar(8) NOT NULL DEFAULT 'perso',
  `maked_on` int(11) unsigned NOT NULL DEFAULT '0',
  `maked_by` varchar(64) NOT NULL DEFAULT '',
  `revised_on` int(11) unsigned NOT NULL DEFAULT '0',
  `revised_by` varchar(64) NOT NULL DEFAULT '',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1011 ;

--
-- Contenu de la table `input`
--

INSERT INTO `input` (`uid`, `itemid`, `groupid`, `keywords`, `title`, `first_name`, `last_name`, `adress1`, `adress2`, `postcode`, `city`, `country_id`, `phone_home`, `phone_work`, `phone_cell`, `fax`, `email`, `username`, `password`, `url`, `gmap`, `birthday`, `memo`, `history`, `width`, `height`, `clicks`, `visibility`, `maked_on`, `maked_by`, `revised_on`, `revised_by`) VALUES
(1000, 3, 105, 'Panasonic soldering condition aluminium capacitor', '', 'Panasonic soldering', 'condition capa alu', '', '', '', '', 0, '', '', '', '', '', '', '', 'http://industrial.panasonic.com/www-data/pdf/ABA0000/ABA0000PE278.pdf', '', '1970-01-01', '', '##### Mis a jour le 22 May 2012 - 15:27:07  par  myself #####\r\nMots cle : Panasonic soldering >>> Panasonic soldering condition aluminium capacitor\r\n\r\n##### Cree le 22 May 2012 - 15:26:38  par  myself #####\r\nGroupe : JCAE Passive\r\nKeyWords : Panasonic soldering\r\nNom : Panasonic soldering\r\nVersion : condition capa alu\r\nDate : 1970-01-01\r\nURL : http://industrial.panasonic.com/www-data/pdf/ABA0000/ABA0000PE278.pdf\r\nvisibility : public\r\nowner : \r\n', 900, 900, 121, 'personal', 1337693198, 'Tom', 1337693227, 'Tom'),
(1006, 4, 106, 'forum codeigniter france', NULL, 'forum codeigniter france', '', '', NULL, '', '', 173, NULL, NULL, NULL, NULL, '', 'archibald', 'pump', 'http://forum.codeigniter-france.com/forum.php', NULL, '1000-01-01', '', '##### CrÃ©Ã© le : 2013-09-28 21:26:42 par Allan #####\r\nGroupe : Forum\r\nNom du site : forum codeigniter france\r\nIdentifiant : archibald\r\nMot de passe : pump\r\nURL du site : http://forum.codeigniter-france.com/forum.php\r\nContrÃ´le d''accÃ¨s : personal\r\n', 800, 400, 7, 'personal', 1380389202, 'Allan', 0, ''),
(1007, 2, 102, 'prochaines courses', NULL, 'prochaines courses', '', '', NULL, '', '', 173, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '1000-01-01', '1 bouteille de whisky\n3 sacs poubelle\n1 pot de piment\n', '##### ModifiÃ© le : 2013-10-04 21:58:55 par Allan #####\r\n\r\n##### ModifiÃ© le : 2013-10-02 09:41:42 par Allan #####\r\n\r\n##### CrÃ©Ã© le : 2013-09-28 21:41:44 par Allan #####\r\nGroupe : Vie courante\r\nTitre : prochaines courses\r\nContrÃ´le d''accÃ¨s : communal\r\n', 800, 400, 23, 'communal', 1380390104, 'Allan', 1380909535, 'Allan'),
(1010, 1, 101, 'Marilyn MONROE', '', 'Marilyn', 'MONROE', 'East Side', '40th street', '88888', 'TEXAS CITY', 327, '', '', '', '', '', '', '', NULL, '', '0000-00-00', '', '##### ModifiÃ© le : 2013-10-20 10:19:54 par Allan #####\r\nAdresse :  >>> East Side\r\nAdresse (complÃ©ment) :  >>> 40th street\r\nCode postal :  >>> 88888\r\nVille :  >>> TEXAS CITY\r\n\r\n##### Updated on : 2013-10-18 13:10:28 by Allan #####\r\nBirthday : 0000-00-00 >>> \r\nCountry : France >>> Ãles Mineures des Ãtats-Unis\r\n\r\n##### Created on : 2013-10-18 13:09:56 by Allan #####\r\nGroup : Artiste\r\nFirst name : Marilyn\r\nLast name : MONROE\r\nCountry : France\r\nAccess control : communal\r\n', 800, 400, 35, 'communal', 1382094596, 'Allan', 1382257194, 'Allan');

-- --------------------------------------------------------

--
-- Structure de la table `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `item_id` tinyint(4) unsigned NOT NULL,
  `item_en` varchar(24) NOT NULL,
  `item_fr` varchar(24) NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `item`
--

INSERT INTO `item` (`item_id`, `item_en`, `item_fr`) VALUES
(1, 'Address-book', 'Carnet d''adresses'),
(2, 'Note-pad', 'Bloc-note'),
(3, 'Document', 'Document'),
(4, 'Site and Login', 'Site et Login');

-- --------------------------------------------------------

--
-- Structure de la table `session`
--

CREATE TABLE IF NOT EXISTS `session` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `session`
--


-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_username` varchar(24) NOT NULL,
  `user_password_md5` varchar(32) NOT NULL,
  `user_first_name` varchar(24) NOT NULL,
  `user_last_name` varchar(24) NOT NULL,
  `user_address` varchar(48) DEFAULT NULL,
  `user_postcode` varchar(8) DEFAULT NULL,
  `user_city` varchar(40) DEFAULT NULL,
  `user_country_id` smallint(4) NOT NULL DEFAULT '173',
  `user_email` varchar(64) NOT NULL,
  `user_rights` varchar(16) NOT NULL,
  `user_make_date` int(11) DEFAULT NULL,
  `user_revised_date` int(11) DEFAULT NULL,
  `user_ip` varchar(32) DEFAULT NULL,
  `user_history` text,
  `user_logs` int(11) DEFAULT '1',
  `user_lang` varchar(2) DEFAULT 'fr',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=100 ;

--
-- Contenu de la table `user`
--


