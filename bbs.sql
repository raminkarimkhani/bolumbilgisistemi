-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 30 May 2016, 19:17:13
-- Sunucu sürümü: 5.6.26
-- PHP Sürümü: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `bbs`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `acilan_ders`
--

CREATE TABLE IF NOT EXISTS `acilan_ders` (
  `id` mediumint(8) unsigned NOT NULL,
  `personel_id` smallint(5) unsigned NOT NULL,
  `ders_id` smallint(5) unsigned NOT NULL,
  `sube` tinyint(3) unsigned NOT NULL,
  `durum` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `takvim_id` smallint(5) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `acilan_ders`
--

INSERT INTO `acilan_ders` (`id`, `personel_id`, `ders_id`, `sube`, `durum`, `takvim_id`) VALUES
(1, 1, 8, 1, 0, 1),
(2, 1, 8, 2, 0, 1),
(3, 12, 7, 1, 0, 1),
(4, 6, 3, 1, 0, 1),
(5, 6, 3, 2, 0, 1),
(9, 9, 7, 1, 0, 5);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `bina`
--

CREATE TABLE IF NOT EXISTS `bina` (
  `id` tinyint(3) unsigned NOT NULL,
  `adi` varchar(32) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `bina`
--

INSERT INTO `bina` (`id`, `adi`) VALUES
(1, 'A Blok'),
(2, 'B Blok'),
(3, 'C Blok');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ders`
--

CREATE TABLE IF NOT EXISTS `ders` (
  `id` smallint(5) unsigned NOT NULL,
  `kodu` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `adi` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `kredisi` tinyint(3) unsigned NOT NULL,
  `donem` tinyint(3) unsigned NOT NULL,
  `tip` tinyint(3) unsigned NOT NULL,
  `durum` tinyint(3) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `ders`
--

INSERT INTO `ders` (`id`, `kodu`, `adi`, `kredisi`, `donem`, `tip`, `durum`) VALUES
(1, 'Fiz-101', 'Fizik-I', 3, 1, 1, 0),
(2, 'Kim-101', 'Kimya', 3, 1, 1, 0),
(3, 'Mat-1', 'Matematik-I', 4, 1, 1, 0),
(4, 'Tür-101', 'Türk Dili-I', 2, 1, 1, 0),
(5, 'İNG-101', 'İngilizce-I', 3, 1, 1, 0),
(6, 'Tar-101', 'Atatürk İlkeleri ve İnkilap Tarihi-I', 2, 1, 1, 0),
(7, 'BM-101', 'Bilgisayar Mühendisliğine Giriş', 2, 1, 1, 0),
(8, 'BM-103', 'Algoritma ve Programlamaya Giriş', 3, 1, 1, 0),
(9, 'FİZ-102', 'FİZİK-II', 3, 2, 1, 0),
(10, 'MAT-102', 'Matematik-II', 4, 2, 1, 0),
(11, 'MAT-104', 'Lineer Cebir', 3, 2, 1, 0),
(12, 'TAR-102', 'Atatürk İlkeleri ve İnkilap Tarihleri-II', 2, 2, 1, 0),
(13, 'TUR-102', 'Türk Dili-II', 2, 2, 1, 0),
(14, 'ING-102', 'İngilizce-II', 3, 2, 1, 0),
(15, 'BM-102', 'Yapısal Programlama', 3, 2, 1, 0),
(16, 'BM-104', 'Teknik Resim', 2, 2, 1, 0),
(17, 'MAT-201', 'Diferansiyel Denklemler', 4, 3, 1, 0),
(18, 'BM-201', 'Elektrik ve Elektronik Devreler', 3, 3, 1, 0),
(19, 'BM-203', 'Elektrik ve Elektronik Devreler Laboratuvarı', 1, 3, 1, 0),
(20, 'BM-205', 'Sayısal Tasarım-I', 3, 3, 1, 0),
(21, 'BM-207', 'Sayısal Tasarım Laboratuvarı-I', 1, 3, 1, 0),
(22, 'BM-209', 'Nesne Yönelimli Programlama', 4, 3, 1, 0),
(23, 'BM-211', 'Veri Yapıları ve Algoritmalar', 4, 3, 1, 0),
(24, 'BM-213', 'Teknik Resim-I', 3, 3, 1, 0),
(25, 'MAT-202', 'Ayrık Matematik', 2, 4, 1, 0),
(26, 'IST-202', 'İstatistik ve Olasılık', 3, 4, 1, 0),
(27, 'BM-206', 'Sayısal Tasarım-II', 3, 4, 1, 0),
(28, 'BM-208', 'Sayısal Tasarım Laboratuvarı-II', 1, 4, 1, 0),
(29, 'BM-202', 'Veri İletişimi', 3, 4, 1, 0),
(30, 'BM-204', 'Mikrobilgisayarlar', 4, 4, 1, 0),
(31, 'BM-214', 'Teknik Resim-II', 3, 4, 1, 0),
(32, 'EKO-301', 'Ekonomi', 2, 5, 1, 0),
(33, 'MAT-301', 'Sayısal Analiz', 3, 5, 1, 0),
(34, 'BM-301', 'Bilgisayar Organizasyonu', 4, 5, 1, 0),
(35, 'BM-303', 'Bilgisayar Ağları ve Tasarımı', 0, 5, 1, 0),
(36, 'BM-305', 'Biçimsel Diller ve Otomata', 3, 5, 1, 0),
(37, 'BM-307', 'Web Tabanlı Programlama', 3, 5, 1, 0),
(38, 'BM-309', 'Yazılım Mühendisliğine Giriş', 2, 5, 1, 0),
(39, 'BM-302', 'Veritabanı Yönetim Sistemleri', 4, 6, 1, 0),
(40, 'BM-304', 'Yazılım Mühendisliği', 3, 6, 1, 0),
(41, 'BM-306', 'Bilimsel Araştırma Yöntemleri', 3, 6, 1, 0),
(42, 'BM-401', 'İşyeri Eğitimi', 12, 7, 1, 0),
(43, 'BM-402', 'İşletim Sistemleri', 3, 8, 1, 0),
(44, 'BM-400', 'Mezuniyet Tezi', 1, 8, 1, 0),
(45, 'SS-202', 'İşletme Bilimine Giriş', 2, 4, 2, 0),
(46, 'SS-204', 'Temel Hukuk', 2, 4, 2, 0),
(47, 'SS-206', 'Pazarlamaya Giriş', 2, 4, 2, 0),
(48, 'SS-208', 'Davranış Bilimleri', 2, 4, 2, 0),
(49, 'SS-210', 'Eleştirel Düşünme ve Problem Çözme ', 2, 4, 2, 0),
(50, 'SS-301', 'Bilişim Hukuku', 2, 5, 3, 0),
(51, 'SS-303', 'Hakla İlişkiler', 2, 5, 3, 0),
(52, 'SS-305', 'İnsan Kaynakları Yönetimi', 2, 5, 3, 0),
(53, 'SS-307', 'Felsefe', 2, 5, 3, 0),
(54, 'SS-402', 'Kalite ve Güvenilirlik', 3, 7, 4, 0),
(55, 'SS-404', 'Girişimcilik', 3, 7, 4, 0),
(56, 'BM-310', 'Anlamsal Ağlara Giriş', 4, 6, 5, 0),
(57, 'BM-312', 'Bilgisayar Grafiği', 4, 6, 5, 0),
(58, 'BM-314', 'Yapay Zekaya Giriş', 4, 6, 5, 0),
(59, 'BM-316', 'Kriptografi', 4, 6, 5, 0),
(60, 'BM-318', 'Modelleme ve Simülayon', 4, 6, 5, 0),
(61, 'BM-320', 'İleri Programlama', 4, 6, 5, 0),
(62, 'BM-322', 'Oyun Kuramı', 4, 6, 5, 0),
(63, 'BM-324', 'Ağ Tabanlı Programlama', 4, 6, 5, 0),
(64, 'BM-326', 'Sunucu Programlama ve Güvenliği', 4, 6, 5, 0),
(65, 'BM-328', 'Gömülü Bilgisayar Sistemleri', 4, 6, 5, 0),
(66, 'BM-330', 'Paralel Programlama', 4, 6, 5, 0),
(67, 'BM-332', 'Veri Madenciliği', 4, 6, 5, 0),
(68, 'BM-334', 'Kablosuz ve Mobil Ağlar', 4, 6, 5, 0),
(69, 'BM-336', 'İşaret İşleme', 4, 6, 5, 0),
(70, 'BM-338', 'Denetim Sistemleri', 4, 6, 5, 0),
(71, 'BM-340', 'İnsan Bilgisayar Etkileşimi', 4, 6, 5, 0),
(72, 'BM-342', 'Mobil Sistemlerde Uygulama Geliştirme', 4, 6, 5, 0),
(73, 'BM-344', 'Ağ Güvenliği', 4, 6, 5, 0),
(74, 'BM-346', 'Algoritma Analizi', 4, 6, 5, 0),
(75, 'BM-348', 'Dil İşleme', 4, 6, 5, 0),
(76, 'BM-350', 'Sayısal Entegre Tasarım Dili', 4, 6, 5, 0),
(77, 'BM-404', 'Bilgi Güvenliği', 4, 8, 6, 0),
(78, 'BM-406', 'Derleyici Tasarımı', 4, 8, 6, 0),
(79, 'BM-408', 'Sistem Programlama', 4, 8, 6, 0),
(80, 'BM-410', 'Oyun Programlama', 4, 8, 6, 0),
(81, 'BM-412', 'Bulanık Mantık', 4, 8, 6, 0),
(82, 'BM-414', 'Endüstriyel İletişim Sistemleri', 4, 8, 6, 0),
(83, 'BM-416', 'Ses İşleme ve Tanıma ', 4, 8, 6, 0),
(84, 'BM-418', 'Sayısal Denetim Sistemleri', 4, 8, 6, 0),
(85, 'BM-420', 'Robotik', 4, 8, 6, 0),
(86, 'BM-422', 'Stenografi', 4, 8, 6, 0),
(87, 'BM-424', 'Süreç Denetimi', 4, 8, 6, 0),
(88, 'BM-426', 'Görüntü İşleme', 4, 8, 6, 0),
(89, 'BM-428', 'Gömülü Sistem Tasarımı', 4, 8, 6, 0),
(90, 'BM-430', 'Model Tabanlı Yazılım Geliştirme', 4, 8, 6, 0),
(91, 'BM-432', 'Elektronik Ticaret Uygulamaları', 4, 8, 6, 0),
(92, 'BM-434', 'Bioinformatik', 4, 8, 6, 0),
(93, 'BM-901', 'Video İşleme', 3, 8, 1, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `derslik`
--

CREATE TABLE IF NOT EXISTS `derslik` (
  `id` tinyint(3) unsigned NOT NULL,
  `adi` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `kapasite` tinyint(3) unsigned NOT NULL,
  `bina_id` tinyint(3) unsigned NOT NULL,
  `durum` tinyint(3) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `derslik`
--

INSERT INTO `derslik` (`id`, `adi`, `kapasite`, `bina_id`, `durum`) VALUES
(1, 'A-108', 20, 1, 0),
(2, 'A-109', 32, 1, 0),
(3, 'A-110', 32, 1, 0),
(4, 'A-111', 30, 1, 0),
(5, 'A-112', 30, 1, 0),
(6, 'A-115', 14, 1, 0),
(7, 'A-117', 26, 1, 0),
(8, 'A-118', 28, 1, 0),
(9, 'A-205', 30, 1, 0),
(10, 'A-210', 16, 1, 0),
(11, 'A-211', 21, 1, 0),
(12, 'A-212', 30, 1, 0),
(13, 'A-213', 30, 1, 0),
(14, 'A-214', 30, 1, 0),
(15, 'A-215', 30, 1, 0),
(16, 'A-216', 30, 1, 0),
(17, 'B-1', 42, 2, 0),
(18, 'B-2', 38, 2, 0),
(19, 'B-3', 38, 2, 0),
(20, 'B-4', 38, 2, 0),
(21, 'B-5', 30, 2, 0),
(22, 'B-6', 25, 2, 0),
(23, 'B-7', 38, 2, 0),
(24, 'B-8', 30, 2, 0),
(25, 'B-9', 28, 2, 0),
(26, 'B-10', 30, 2, 0),
(27, 'B-11', 28, 2, 0),
(28, 'B-109', 48, 2, 0),
(29, 'B-112', 48, 2, 0),
(30, 'B-117', 25, 2, 0),
(31, 'B-230', 28, 2, 0),
(32, 'B-233', 40, 2, 0),
(33, 'B-234', 30, 2, 0),
(34, 'B-236', 30, 2, 0),
(35, 'B-226', 48, 2, 0),
(36, 'B-223', 45, 2, 0),
(37, 'B-239', 40, 2, 0),
(38, 'B-201', 26, 2, 0),
(39, 'B-207', 21, 2, 0),
(40, 'B-210', 23, 2, 0),
(41, 'B-125', 28, 2, 0),
(42, 'B-116', 30, 2, 0),
(43, 'B-122', 41, 2, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `personel`
--

CREATE TABLE IF NOT EXISTS `personel` (
  `id` smallint(5) unsigned NOT NULL,
  `adi` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `soyadi` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `sicilno` mediumint(8) unsigned NOT NULL,
  `unvan` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `durum` tinyint(3) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `personel`
--

INSERT INTO `personel` (`id`, `adi`, `soyadi`, `sicilno`, `unvan`, `durum`) VALUES
(1, 'O. Ayhan ', 'ERDEM', 1000, 'Prof. Dr. ', 0),
(2, ' Recep ', 'DEMİRCİ', 1001, 'Prof. Dr.', 0),
(3, ' Aydın ', 'ÇETİN', 1002, 'Doç. Dr.', 0),
(4, '  Bünyamin ', 'CİYLAN', 1003, 'Doç. Dr.', 0),
(5, 'Necaattin', 'BARIŞÇI ', 1004, 'Doç. Dr.', 0),
(6, 'Nurettin ', 'DOĞAN', 1005, ' Doç. Dr. ', 0),
(7, 'Nurettin', 'TOPALOĞLU', 1006, ' Doç. Dr.  ', 0),
(8, 'Nursal ', 'ARICI', 1007, ' Doç. Dr. ', 0),
(9, 'Rahmi ', 'CANAL', 1008, ' Doç. Dr. ', 0),
(10, 'Cemal', 'KOÇAK', 1009, ' Yrd. Doç. Dr.  ', 0),
(11, 'Fecir ', 'DURAN', 1010, ' Yrd. Doç. Dr. ', 0),
(12, 'Hüseyin ', 'POLAT', 1011, ' Yrd. Doç. Dr. ', 0),
(13, 'İbrahim Alper ', 'DOĞRU', 1012, ' Yrd. Doç. Dr. ', 0),
(14, 'İsmail ', 'ATACAK', 1013, ' Yrd. Doç. Dr. ', 0),
(15, 'Bayram ', 'KÜÇÜK', 1014, ' Arş. Gör. ', 0),
(16, 'Elvan ', 'DUMAN', 1015, ' Arş. Gör. ', 0),
(17, 'Esra ', 'SÖĞÜT', 1016, ' Arş. Gör. ', 0),
(18, 'Onur ', 'POLAT', 1017, ' Arş. Gör. ', 0),
(19, 'Saadin', 'OYUCU ', 1018, ' Arş. Gör. ', 0),
(20, 'Tuba ', 'GÖKHAN', 1019, ' Arş. Gör. ', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sinav`
--

CREATE TABLE IF NOT EXISTS `sinav` (
  `id` tinyint(3) unsigned NOT NULL,
  `turu` varchar(32) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `sinav`
--

INSERT INTO `sinav` (`id`, `turu`) VALUES
(3, 'Bütünleme'),
(2, 'Dönem Sonu'),
(1, 'Vize');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sinav_programi`
--

CREATE TABLE IF NOT EXISTS `sinav_programi` (
  `id` int(10) unsigned NOT NULL,
  `acilan_ders_id` mediumint(8) unsigned NOT NULL,
  `takvim_id` tinyint(3) unsigned NOT NULL,
  `personel_id` smallint(5) unsigned NOT NULL,
  `derslik_id` tinyint(3) unsigned NOT NULL,
  `tarih` date NOT NULL,
  `saat` time NOT NULL,
  `durum` tinyint(3) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `sinav_programi`
--

INSERT INTO `sinav_programi` (`id`, `acilan_ders_id`, `takvim_id`, `personel_id`, `derslik_id`, `tarih`, `saat`, `durum`) VALUES
(1, 3, 3, 15, 18, '2016-06-06', '10:30:00', 0),
(2, 3, 3, 17, 25, '2016-06-06', '10:30:00', 0),
(3, 9, 3, 16, 33, '2016-06-06', '10:30:00', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `takvim`
--

CREATE TABLE IF NOT EXISTS `takvim` (
  `id` smallint(5) unsigned NOT NULL,
  `yil` year(4) NOT NULL,
  `donem` tinyint(3) unsigned NOT NULL,
  `sinav_id` tinyint(3) unsigned NOT NULL,
  `durum` tinyint(3) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `takvim`
--

INSERT INTO `takvim` (`id`, `yil`, `donem`, `sinav_id`, `durum`) VALUES
(1, 2015, 2, 1, 0),
(3, 2015, 2, 2, 1),
(4, 2015, 2, 3, 0),
(5, 2016, 1, 1, 0),
(6, 2015, 1, 1, 0);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `acilan_ders`
--
ALTER TABLE `acilan_ders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ders_id` (`ders_id`,`sube`,`takvim_id`) USING BTREE,
  ADD KEY `personel_id` (`personel_id`);

--
-- Tablo için indeksler `bina`
--
ALTER TABLE `bina`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `ders`
--
ALTER TABLE `ders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kodu` (`kodu`);

--
-- Tablo için indeksler `derslik`
--
ALTER TABLE `derslik`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `adi` (`adi`),
  ADD KEY `bina_id` (`bina_id`);

--
-- Tablo için indeksler `personel`
--
ALTER TABLE `personel`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sicilno` (`sicilno`);

--
-- Tablo için indeksler `sinav`
--
ALTER TABLE `sinav`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `turu` (`turu`);

--
-- Tablo için indeksler `sinav_programi`
--
ALTER TABLE `sinav_programi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `derslik_id` (`derslik_id`),
  ADD UNIQUE KEY `acilan_ders_id` (`acilan_ders_id`,`takvim_id`,`personel_id`,`durum`) USING BTREE,
  ADD KEY `sinav_id` (`takvim_id`),
  ADD KEY `personel_id` (`personel_id`);

--
-- Tablo için indeksler `takvim`
--
ALTER TABLE `takvim`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `yil` (`yil`,`donem`,`sinav_id`) USING BTREE;

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `acilan_ders`
--
ALTER TABLE `acilan_ders`
  MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- Tablo için AUTO_INCREMENT değeri `bina`
--
ALTER TABLE `bina`
  MODIFY `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Tablo için AUTO_INCREMENT değeri `ders`
--
ALTER TABLE `ders`
  MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=94;
--
-- Tablo için AUTO_INCREMENT değeri `derslik`
--
ALTER TABLE `derslik`
  MODIFY `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=44;
--
-- Tablo için AUTO_INCREMENT değeri `personel`
--
ALTER TABLE `personel`
  MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- Tablo için AUTO_INCREMENT değeri `sinav`
--
ALTER TABLE `sinav`
  MODIFY `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Tablo için AUTO_INCREMENT değeri `sinav_programi`
--
ALTER TABLE `sinav_programi`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Tablo için AUTO_INCREMENT değeri `takvim`
--
ALTER TABLE `takvim`
  MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `acilan_ders`
--
ALTER TABLE `acilan_ders`
  ADD CONSTRAINT `acilan_ders_ibfk_2` FOREIGN KEY (`personel_id`) REFERENCES `personel` (`id`),
  ADD CONSTRAINT `acilan_ders_ibfk_3` FOREIGN KEY (`ders_id`) REFERENCES `ders` (`id`);

--
-- Tablo kısıtlamaları `derslik`
--
ALTER TABLE `derslik`
  ADD CONSTRAINT `derslik_ibfk_1` FOREIGN KEY (`bina_id`) REFERENCES `bina` (`id`);

--
-- Tablo kısıtlamaları `sinav_programi`
--
ALTER TABLE `sinav_programi`
  ADD CONSTRAINT `sinav_programi_ibfk_1` FOREIGN KEY (`acilan_ders_id`) REFERENCES `acilan_ders` (`id`),
  ADD CONSTRAINT `sinav_programi_ibfk_3` FOREIGN KEY (`personel_id`) REFERENCES `personel` (`id`),
  ADD CONSTRAINT `sinav_programi_ibfk_4` FOREIGN KEY (`derslik_id`) REFERENCES `derslik` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
