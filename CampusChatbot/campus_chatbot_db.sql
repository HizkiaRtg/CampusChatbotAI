-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2025 at 11:17 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `campus_chatbot_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat_histories`
--

CREATE TABLE `chat_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `session_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `matched_training_id` bigint(20) UNSIGNED DEFAULT NULL,
  `confidence_score` decimal(5,2) DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chat_histories`
--

INSERT INTO `chat_histories` (`id`, `user_id`, `session_id`, `question`, `answer`, `matched_training_id`, `confidence_score`, `created_at`, `updated_at`) VALUES
(1, NULL, 'kH8kVske0R0KtFXYx3xZxbUZRF5tCxbxMnMf0KZQ', 'jadwal senin apa', 'Jadwal kuliah hari Senin:\n08.00-10.00: Pemrograman Web (Ruang A301)\n10.00-12.00: Basis Data (Ruang B205)\n13.00-15.00: Algoritma (Ruang A302)\n15.00-17.00: Jaringan Komputer (Lab Komputer 1)', 1, '100.00', '2025-11-05 11:42:29', '2025-11-05 11:42:29'),
(2, NULL, 'kH8kVske0R0KtFXYx3xZxbUZRF5tCxbxMnMf0KZQ', 'jadwal senin?', 'Jadwal kuliah hari Senin:\n08.00-10.00: Pemrograman Web (Ruang A301)\n10.00-12.00: Basis Data (Ruang B205)\n13.00-15.00: Algoritma (Ruang A302)\n15.00-17.00: Jaringan Komputer (Lab Komputer 1)', 1, '100.00', '2025-11-05 11:42:40', '2025-11-05 11:42:40'),
(3, NULL, 'kH8kVske0R0KtFXYx3xZxbUZRF5tCxbxMnMf0KZQ', 'jadwal rabu?', 'Jadwal kuliah hari Rabu:\n08.00-10.00: Rekayasa Perangkat Lunak (Ruang A302)\n10.00-12.00: Pemrograman Mobile (Lab Komputer 3)\n13.00-15.00: Matematika Diskrit (Ruang C102)\n15.00-17.00: Free/Konsultasi Dosen', 3, '100.00', '2025-11-05 11:42:46', '2025-11-05 11:42:46'),
(4, NULL, 'kH8kVske0R0KtFXYx3xZxbUZRF5tCxbxMnMf0KZQ', 'ruangan?', 'Maaf, saya tidak menemukan jawaban pasti untuk pertanyaan Anda. Mungkin Anda ingin bertanya tentang: administrasi, akademik, beasiswa?', NULL, '0.00', '2025-11-05 11:43:15', '2025-11-05 11:43:15'),
(5, NULL, 'kH8kVske0R0KtFXYx3xZxbUZRF5tCxbxMnMf0KZQ', 'dimana lab komputer 1', 'Lab Komputer 1 berada di Gedung B lantai 2. Memiliki 50 unit komputer dengan spesifikasi Core i5, RAM 8GB. Buka Senin-Jumat 08.00-17.00.', 9, '100.00', '2025-11-05 11:43:27', '2025-11-05 11:43:27'),
(6, NULL, 'kH8kVske0R0KtFXYx3xZxbUZRF5tCxbxMnMf0KZQ', 'cara daftar krs', 'Pendaftaran KRS (Kartu Rencana Studi):\n1. Login ke portal akademik (akademik.campus.ac.id)\n2. Pilih menu \"KRS\"\n3. Pilih mata kuliah yang ingin diambil\n4. Submit dan cetak KRS\n5. Minta persetujuan dosen wali\nBatas waktu: 2 minggu pertama di awal semester', 19, '100.00', '2025-11-05 11:44:51', '2025-11-05 11:44:51'),
(7, NULL, 'kH8kVske0R0KtFXYx3xZxbUZRF5tCxbxMnMf0KZQ', 'dimana lab', 'Lab Komputer 1 berada di Gedung B lantai 2. Memiliki 50 unit komputer dengan spesifikasi Core i5, RAM 8GB. Buka Senin-Jumat 08.00-17.00.', 9, '100.00', '2025-11-05 11:45:08', '2025-11-05 11:45:08'),
(31, NULL, 'DO6GpC9tZ6vDliD696caDEFf2Xo0BJk5wi5lpzGW', 'jadwal senin apa', 'Jadwal kuliah hari Senin:\n08.00-10.00: Pemrograman Web (Ruang A301)\n10.00-12.00: Basis Data (Ruang B205)\n13.00-15.00: Algoritma (Ruang A302)\n15.00-17.00: Jaringan Komputer (Lab Komputer 1)', 1, '100.00', '2025-11-05 13:14:06', '2025-11-05 13:14:06'),
(32, NULL, 'DO6GpC9tZ6vDliD696caDEFf2Xo0BJk5wi5lpzGW', 'dimana lab komputer 1', 'Lab Komputer 1 berada di Gedung B lantai 2. Memiliki 50 unit komputer dengan spesifikasi Core i5, RAM 8GB. Buka Senin-Jumat 08.00-17.00.', 9, '100.00', '2025-11-05 13:14:09', '2025-11-05 13:14:09'),
(33, NULL, 'DO6GpC9tZ6vDliD696caDEFf2Xo0BJk5wi5lpzGW', 'cara daftar krs', 'Pendaftaran KRS (Kartu Rencana Studi):\n1. Login ke portal akademik (akademik.campus.ac.id)\n2. Pilih menu \"KRS\"\n3. Pilih mata kuliah yang ingin diambil\n4. Submit dan cetak KRS\n5. Minta persetujuan dosen wali\nBatas waktu: 2 minggu pertama di awal semester', 19, '100.00', '2025-11-05 13:14:10', '2025-11-05 13:14:10'),
(34, NULL, 'DO6GpC9tZ6vDliD696caDEFf2Xo0BJk5wi5lpzGW', 'beasiswa apa saja', 'Beasiswa yang tersedia:\n1. Beasiswa PPA (Peningkatan Prestasi Akademik) - IPK min 3.00\n2. Beasiswa BBM (Bantuan Biaya Mahasiswa) - untuk kurang mampu\n3. Beasiswa Prestasi - juara kompetisi\n4. Beasiswa KIP-K - dari pemerintah\n5. Beasiswa Yayasan - dari sponsor perusahaan\nInfo: beasiswa@campus.ac.id', 35, '100.00', '2025-11-05 13:14:13', '2025-11-05 13:14:13'),
(35, NULL, 'DO6GpC9tZ6vDliD696caDEFf2Xo0BJk5wi5lpzGW', 'jadwal hari rabu apa?', 'Jadwal kuliah hari Rabu:\n08.00-10.00: Rekayasa Perangkat Lunak (Ruang A302)\n10.00-12.00: Pemrograman Mobile (Lab Komputer 3)\n13.00-15.00: Matematika Diskrit (Ruang C102)\n15.00-17.00: Free/Konsultasi Dosen', 3, '100.00', '2025-11-05 13:14:20', '2025-11-05 13:14:20'),
(36, NULL, 'DO6GpC9tZ6vDliD696caDEFf2Xo0BJk5wi5lpzGW', 'jadwal hari kamis?', 'Jadwal kuliah hari Kamis:\n08.00-10.00: Kecerdasan Buatan (Ruang A301)\n10.00-12.00: Data Mining (Lab Komputer 1)\n13.00-15.00: Grafika Komputer (Lab Komputer 2)\n15.00-17.00: Praktikum Web (Lab Komputer 3)', 4, '100.00', '2025-11-05 13:14:26', '2025-11-05 13:14:26'),
(37, NULL, 'DO6GpC9tZ6vDliD696caDEFf2Xo0BJk5wi5lpzGW', 'kalo jadwal sabtu?', 'Sabtu tidak masuk kuliah', 48, '100.00', '2025-11-05 13:14:32', '2025-11-05 13:14:32'),
(38, NULL, 'DO6GpC9tZ6vDliD696caDEFf2Xo0BJk5wi5lpzGW', 'kalo minggu?', 'Maaf, saya tidak menemukan jawaban pasti untuk pertanyaan Anda. Mungkin Anda ingin bertanya tentang: administrasi, akademik, beasiswa?', NULL, '0.00', '2025-11-05 13:14:38', '2025-11-05 13:14:38'),
(39, NULL, 'DO6GpC9tZ6vDliD696caDEFf2Xo0BJk5wi5lpzGW', 'jadwal hari minggu?', 'Sabtu tidak masuk kuliah', 48, '85.00', '2025-11-05 13:14:47', '2025-11-05 13:14:47'),
(40, NULL, 'DO6GpC9tZ6vDliD696caDEFf2Xo0BJk5wi5lpzGW', 'hari minggu', 'Libur kampus:\n1. Libur semester: Juli-Agustus & Januari-Februari\n2. Libur nasional & keagamaan\n3. Dies natalis kampus: 17 Agustus\n4. Cuti bersama sesuai ketentuan pemerintah\nKalender akademik lengkap bisa diunduh di portal.', 43, '57.00', '2025-11-05 13:14:57', '2025-11-05 13:14:57'),
(41, NULL, 'DO6GpC9tZ6vDliD696caDEFf2Xo0BJk5wi5lpzGW', 'hari minggu?', 'Libur kampus:\n1. Libur semester: Juli-Agustus & Januari-Februari\n2. Libur nasional & keagamaan\n3. Dies natalis kampus: 17 Agustus\n4. Cuti bersama sesuai ketentuan pemerintah\nKalender akademik lengkap bisa diunduh di portal.', 43, '57.00', '2025-11-05 13:15:02', '2025-11-05 13:15:02'),
(42, NULL, 'DO6GpC9tZ6vDliD696caDEFf2Xo0BJk5wi5lpzGW', 'jadwal hari minggu', 'Sabtu tidak masuk kuliah', 48, '85.00', '2025-11-05 13:15:14', '2025-11-05 13:15:14'),
(43, 1, '7CjX7FUEKFT4YmwJK7W1SAc744Yn8rLOfhKAcpDi', 'Jadwal minggu', 'Hari minggu tidak ada jadwal kuliah, silahkan istirahat 😊', 49, '100.00', '2025-11-05 13:15:48', '2025-11-05 13:15:48'),
(44, NULL, 'aqmfFEd2i8rb5rBL8QWazu4s4dp7QHvu043UMKjX', 'jadwal senin apa', 'Jadwal kuliah hari Senin:\n08.00-10.00: Pemrograman Web (Ruang A301)\n10.00-12.00: Basis Data (Ruang B205)\n13.00-15.00: Algoritma (Ruang A302)\n15.00-17.00: Jaringan Komputer (Lab Komputer 1)', 1, '100.00', '2025-11-05 13:16:08', '2025-11-05 13:16:08'),
(45, NULL, 'aqmfFEd2i8rb5rBL8QWazu4s4dp7QHvu043UMKjX', 'dimana lab komputer 1', 'Lab Komputer 1 berada di Gedung B lantai 2. Memiliki 50 unit komputer dengan spesifikasi Core i5, RAM 8GB. Buka Senin-Jumat 08.00-17.00.', 9, '100.00', '2025-11-05 13:16:09', '2025-11-05 13:16:09'),
(46, NULL, 'aqmfFEd2i8rb5rBL8QWazu4s4dp7QHvu043UMKjX', 'kalo jadwal hari rabu?', 'Jadwal kuliah hari Rabu:\n08.00-10.00: Rekayasa Perangkat Lunak (Ruang A302)\n10.00-12.00: Pemrograman Mobile (Lab Komputer 3)\n13.00-15.00: Matematika Diskrit (Ruang C102)\n15.00-17.00: Free/Konsultasi Dosen', 3, '100.00', '2025-11-05 13:16:18', '2025-11-05 13:16:18'),
(47, NULL, 'aqmfFEd2i8rb5rBL8QWazu4s4dp7QHvu043UMKjX', 'hari kamis?', 'Jadwal kuliah hari Kamis:\n08.00-10.00: Kecerdasan Buatan (Ruang A301)\n10.00-12.00: Data Mining (Lab Komputer 1)\n13.00-15.00: Grafika Komputer (Lab Komputer 2)\n15.00-17.00: Praktikum Web (Lab Komputer 3)', 4, '67.50', '2025-11-05 13:16:25', '2025-11-05 13:16:25'),
(48, NULL, 'aqmfFEd2i8rb5rBL8QWazu4s4dp7QHvu043UMKjX', 'Jadwal hari sabtu ada?', 'Sabtu tidak masuk kuliah', 48, '90.00', '2025-11-05 13:16:36', '2025-11-05 13:16:36'),
(49, NULL, 'aqmfFEd2i8rb5rBL8QWazu4s4dp7QHvu043UMKjX', 'jadwal minggu?', 'Hari minggu tidak ada jadwal kuliah, silahkan istirahat 😊', 49, '100.00', '2025-11-05 13:16:42', '2025-11-05 13:16:42'),
(50, NULL, 'aqmfFEd2i8rb5rBL8QWazu4s4dp7QHvu043UMKjX', 'ada beasiswa ngak?', 'Beasiswa yang tersedia:\n1. Beasiswa PPA (Peningkatan Prestasi Akademik) - IPK min 3.00\n2. Beasiswa BBM (Bantuan Biaya Mahasiswa) - untuk kurang mampu\n3. Beasiswa Prestasi - juara kompetisi\n4. Beasiswa KIP-K - dari pemerintah\n5. Beasiswa Yayasan - dari sponsor perusahaan\nInfo: beasiswa@campus.ac.id', 35, '73.00', '2025-11-05 13:16:53', '2025-11-05 13:16:53'),
(51, NULL, 'aqmfFEd2i8rb5rBL8QWazu4s4dp7QHvu043UMKjX', 'krs?', 'Pendaftaran KRS (Kartu Rencana Studi):\n1. Login ke portal akademik (akademik.campus.ac.id)\n2. Pilih menu \"KRS\"\n3. Pilih mata kuliah yang ingin diambil\n4. Submit dan cetak KRS\n5. Minta persetujuan dosen wali\nBatas waktu: 2 minggu pertama di awal semester', 19, '100.00', '2025-11-05 13:16:57', '2025-11-05 13:16:57');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_applications`
--

CREATE TABLE `job_applications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telegram_username` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `job_available` varchar(255) NOT NULL,
  `summary` text NOT NULL,
  `cv_path` varchar(255) NOT NULL,
  `app_name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'new',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_applications`
--

INSERT INTO `job_applications` (`id`, `name`, `email`, `telegram_username`, `phone`, `job_available`, `summary`, `cv_path`, `app_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Andi Prasetyo', 'andi.prasetyo@email.com', '@andipras', '081234567801', 'Cyber security', 'Experienced frontend developer with 3 years of experience in React and Vue.js. Strong skills in responsive design and modern JavaScript frameworks.', 'cv/andi_prasetyo_cv.pdf', 'BestKreatifTeknologi', 'new', '2024-10-01 01:15:00', '2025-11-01 08:30:23'),
(2, 'Maria Stefani', 'maria.stefani@email.com', '@mariastef', '082345678912', 'Cyber security', 'Creative UI/UX designer with a passion for user-centered design. 4 years experience in creating intuitive interfaces for web and mobile applications.', 'cv/maria_stefani_cv.pdf', 'CyberVenturesIndonesia', 'reviewed', '2024-10-02 02:30:00', '2025-11-01 08:30:23'),
(3, 'Bambang Susilo', 'bambang.susilo@email.com', '@bambangss', '083456789023', 'Cyber security', 'Senior backend developer specializing in PHP Laravel and Node.js. Strong database optimization skills and API development experience.', 'cv/bambang_susilo_cv.pdf', 'AlgonesiaDigitalKreasi', 'interviewed', '2024-10-03 03:45:00', '2025-11-01 08:30:23'),
(4, 'Putri Anggraini', 'putri.anggraini@email.com', '@putrianggi', '084567890134', 'Cyber security', 'Results-driven digital marketer with expertise in SEO, SEM, and social media marketing. Proven track record of increasing online engagement by 150%.', 'cv/putri_anggraini_cv.pdf', 'AksaratechGlobalKreasi', 'new', '2024-10-04 04:00:00', '2025-11-01 08:30:23'),
(5, 'Ricky Harun', 'ricky.harun@email.com', '@rickyharun', '085678901245', 'Cyber security', 'DevOps engineer with 5 years experience in AWS, Docker, and Kubernetes. Strong automation and CI/CD pipeline implementation skills.', 'cv/ricky_harun_cv.pdf', 'OrbitasiInovasiDigital', 'accepted', '2024-10-05 06:20:00', '2025-11-01 08:30:23'),
(6, 'Sari Wulandari', 'sari.wulandari@email.com', '@sariwulan', '086789012356', 'Cyber security', 'Strategic product manager with experience leading cross-functional teams. Expert in agile methodologies and product roadmap development.', 'cv/sari_wulandari_cv.pdf', 'BestKreatifTeknologi', 'reviewed', '2024-10-06 07:30:00', '2025-11-01 08:30:23'),
(7, 'Tommy Wijaya', 'tommy.wijaya@email.com', '@tommywijaya', '087890123467', 'Cyber security', 'Detail-oriented data analyst proficient in Python, SQL, and Tableau. Experience in extracting insights from large datasets to drive business decisions.', 'cv/tommy_wijaya_cv.pdf', 'CyberVenturesIndonesia', 'new', '2024-10-07 01:45:00', '2025-11-01 08:30:23'),
(8, 'Nina Kartika', 'nina.kartika@email.com', '@ninakartika', '088901234578', 'Cyber security', 'Creative content writer with expertise in SEO writing and storytelling. 3 years experience creating engaging content for various industries.', 'cv/nina_kartika_cv.pdf', 'AlgonesiaDigitalKreasi', 'rejected', '2024-10-08 02:00:00', '2025-11-01 08:30:23'),
(9, 'Fadli Rahman', 'fadli.rahman@email.com', '@fadlirahman', '089012345689', 'Cyber security', 'Mobile app developer specializing in Flutter and React Native. Published 10+ apps on App Store and Google Play with 100k+ downloads.', 'cv/fadli_rahman_cv.pdf', 'AksaratechGlobalKreasi', 'interviewed', '2024-10-09 03:15:00', '2025-11-01 08:30:23'),
(10, 'Laras Santi', 'laras.santi@email.com', '@larassanti', '081123456790', 'Cyber security', 'Quality assurance engineer with strong automation testing skills. Experience with Selenium, Jest, and Cypress testing frameworks.', 'cv/laras_santi_cv.pdf', 'OrbitasiInovasiDigital', 'new', '2024-10-10 04:30:00', '2025-11-01 08:30:23'),
(11, 'Eko Prasetyo', 'eko.prasetyo@email.com', '@ekopras', '082234567801', 'Cyber security', 'Versatile full stack developer with expertise in MERN stack. Strong problem-solving skills and ability to work independently or in teams.', 'cv/eko_prasetyo_cv.pdf', 'BestKreatifTeknologi', 'reviewed', '2024-10-11 05:45:00', '2025-11-01 08:30:23'),
(12, 'Diah Permata', 'diah.permata@email.com', '@diahpermata', '083345678912', 'Cyber security', 'Experienced HR manager with 6 years in recruitment, employee relations, and organizational development. Strong interpersonal skills.', 'cv/diah_permata_cv.pdf', 'CyberVenturesIndonesia', 'accepted', '2024-10-12 06:00:00', '2025-11-01 08:30:23'),
(13, 'Agung Nugroho', 'agung.nugroho@email.com', '@agungnug', '084456789023', 'Cyber security', 'System administrator with expertise in Linux servers, network security, and system monitoring. 7 years of IT infrastructure experience.', 'cv/agung_nugroho_cv.pdf', 'AlgonesiaDigitalKreasi', 'new', '2024-10-13 07:15:00', '2025-11-01 08:30:23'),
(14, 'Fitri Handayani', 'fitri.handayani@email.com', '@fitrihanda', '085567890134', 'Cyber security', 'Creative graphic designer with strong Adobe Creative Suite skills. Portfolio includes branding, illustration, and digital design projects.', 'cv/fitri_handayani_cv.pdf', 'AksaratechGlobalKreasi', 'reviewed', '2024-10-14 08:30:00', '2025-11-01 08:30:23'),
(15, 'Hendra Gunawan', 'hendra.gunawan@email.com', '@hendragun', '086678901245', 'Cyber security', 'Business analyst with strong analytical and communication skills. Experience in requirements gathering, process improvement, and stakeholder management.', 'cv/hendra_gunawan_cv.pdf', 'OrbitasiInovasiDigital', 'interviewed', '2024-10-15 01:00:00', '2025-11-01 08:30:23'),
(16, 'Indah Puspita', 'indah.puspita@email.com', '@indahpuspita', '087789012356', 'Cyber security', 'Social media manager with proven track record in growing brand presence across platforms. Expert in content strategy and community engagement.', 'cv/indah_puspita_cv.pdf', 'BestKreatifTeknologi', 'new', '2024-10-16 02:15:00', '2025-11-01 08:30:23'),
(17, 'Joko Susanto', 'joko.susanto@email.com', '@jokosusanto', '088890123467', 'Cyber security', 'DBA with 8 years experience managing MySQL, PostgreSQL, and MongoDB databases. Strong optimization and backup/recovery skills.', 'cv/joko_susanto_cv.pdf', 'CyberVenturesIndonesia', 'rejected', '2024-10-17 03:30:00', '2025-11-01 08:30:23'),
(18, 'Kartika Sari', 'kartika.sari@email.com', '@kartikasari', '089901234578', 'Cyber security', 'PMP certified project manager with 5 years experience delivering complex IT projects on time and within budget. Strong leadership skills.', 'cv/kartika_sari_cv.pdf', 'AlgonesiaDigitalKreasi', 'accepted', '2024-10-18 04:45:00', '2025-11-01 08:30:23'),
(19, 'Lukman Hakim', 'lukman.hakim@email.com', '@lukmanhakim', '081012345689', 'Cyber security', 'Cybersecurity analyst with expertise in penetration testing, vulnerability assessment, and security incident response. CISSP certified.', 'cv/lukman_hakim_cv.pdf', 'AksaratechGlobalKreasi', 'new', '2024-10-19 06:00:00', '2025-11-01 08:30:23'),
(20, 'Maya Angelina', 'maya.angelina@email.com', '@mayaangel', '082123456790', 'Cyber security', 'Customer-focused professional with experience in client relationship management and customer retention strategies. Strong communication skills.', 'cv/maya_angelina_cv.pdf', 'OrbitasiInovasiDigital', 'reviewed', '2024-10-20 07:15:00', '2025-11-01 08:30:23'),
(21, 'Nanda Pratama', 'nanda.pratama@email.com', '@nandapratama', '083234567801', 'Cyber security', 'Machine learning engineer with expertise in TensorFlow, PyTorch, and scikit-learn. Experience in developing predictive models and NLP applications.', 'cv/nanda_pratama_cv.pdf', 'BestKreatifTeknologi', 'interviewed', '2024-10-21 08:30:00', '2025-11-01 08:30:23'),
(22, 'Olivia Tan', 'olivia.tan@email.com', '@oliviatan', '084345678912', 'Cyber security', 'Professional video editor proficient in Adobe Premiere Pro and After Effects. Portfolio includes corporate videos, commercials, and social media content.', 'cv/olivia_tan_cv.pdf', 'CyberVenturesIndonesia', 'new', '2024-10-22 01:30:00', '2025-11-01 08:30:23'),
(23, 'Putra Adiputra', 'putra.adiputra@email.com', '@putraadi', '085456789023', 'Cyber security', 'Network engineer with CCNA certification and 4 years experience in network design, implementation, and troubleshooting.', 'cv/putra_adiputra_cv.pdf', 'AlgonesiaDigitalKreasi', 'reviewed', '2024-10-23 02:45:00', '2025-11-01 08:30:23'),
(24, 'Ratna Dewi', 'ratna.dewi@email.com', '@ratnadewi', '086567890134', 'Cyber security', 'High-performing sales executive with consistent record of exceeding targets. Strong negotiation and relationship building skills.', 'cv/ratna_dewi_cv.pdf', 'AksaratechGlobalKreasi', 'accepted', '2024-10-24 03:00:00', '2025-11-01 08:30:23'),
(25, 'Surya Kusuma', 'surya.kusuma@email.com', '@suryakusuma', '087678901245', 'Cyber security', 'Senior software architect with 10+ years experience designing scalable systems. Expert in microservices architecture and cloud computing.', 'cv/surya_kusuma_cv.pdf', 'OrbitasiInovasiDigital', 'new', '2024-10-25 04:15:00', '2025-11-01 08:30:23'),
(26, 'Tania Kusuma', 'tania.kusuma@email.com', '@taniakusuma', '088789012356', 'Cyber security', 'Technical writer with ability to translate complex technical concepts into clear documentation. Experience with API documentation and user guides.', 'uploads/cvs/tes.pdf', 'BestKreatifTeknologi', 'rejected', '2024-10-26 05:30:00', '2025-11-01 08:47:05'),
(27, 'Umar Bakri', 'umar.bakri@email.com', '@umarbakri', '089890123467', 'Cyber security', 'IT support specialist with strong troubleshooting skills. Experience providing technical support for hardware, software, and network issues.', 'cv/umar_bakri_cv.pdf', 'CyberVenturesIndonesia', 'interviewed', '2024-10-27 06:45:00', '2025-11-01 08:30:23'),
(28, 'Vera Amelia', 'vera.amelia@email.com', '@veramelia', '081901234578', 'Cyber security', 'Financial analyst with CFA Level 2 certification. Strong financial modeling and data analysis skills. Experience in investment analysis.', 'cv/vera_amelia_cv.pdf', 'AlgonesiaDigitalKreasi', 'new', '2024-10-28 07:00:00', '2025-11-01 08:30:23'),
(29, 'Wawan Setiawan', 'wawan.setiawan@email.com', '@wawanset', '082012345689', 'Cyber security', 'Blockchain developer with expertise in Solidity, Web3.js, and smart contract development. Experience with Ethereum and Polygon networks.', 'cv/wawan_setiawan_cv.pdf', 'AksaratechGlobalKreasi', 'rejected', '2024-10-29 08:15:00', '2025-11-01 08:30:23'),
(30, 'Yuni Kartika', 'yuni.kartika@email.com', '@yunikartika', '083123456790', 'Cyber security', 'Operations manager with expertise in process optimization and team leadership. 6 years experience improving operational efficiency.', 'cv/yuni_kartika_cv.pdf', 'OrbitasiInovasiDigital', 'reviewed', '2024-10-30 01:20:00', '2025-11-01 08:30:23'),
(31, 'Zainal Abidin', 'zainal.abidin@email.com', '@zainalabidin', '084234567801', 'Cyber security', 'Cloud engineer certified in AWS and Azure. Experience in cloud migration, infrastructure as code, and serverless architecture.', 'cv/zainal_abidin_cv.pdf', 'BestKreatifTeknologi', 'accepted', '2024-10-15 02:30:00', '2025-11-01 08:30:23'),
(32, 'Annisa Rahma', 'annisa.rahma@email.com', '@annisarahma', '085345678912', 'Cyber security', 'Certified Scrum Master with experience facilitating agile ceremonies and removing team blockers. Strong coaching and mentoring abilities.', 'cv/annisa_rahma_cv.pdf', 'CyberVenturesIndonesia', 'new', '2024-10-16 03:45:00', '2025-11-01 08:30:23'),
(33, 'Bayu Pratama', 'bayu.pratama@email.com', '@bayupratama', '086456789023', 'Cyber security', 'SEO specialist with proven track record of improving organic search rankings. Expert in keyword research, on-page, and off-page optimization.', 'cv/bayu_pratama_cv.pdf', 'AlgonesiaDigitalKreasi', 'interviewed', '2024-10-17 04:00:00', '2025-11-01 08:30:23'),
(34, 'Citra Dewi', 'citra.dewi@email.com', '@citradewi', '087567890134', 'Cyber security', 'E-commerce manager with experience in online marketplace management, inventory control, and customer service optimization.', 'cv/citra_dewi_cv.pdf', 'AksaratechGlobalKreasi', 'reviewed', '2024-10-18 05:15:00', '2025-11-01 08:30:23'),
(35, 'Deni Kurniawan', 'deni.kurniawan@email.com', '@denikurniawan', '088678901245', 'Cyber security', 'Game developer proficient in Unity and Unreal Engine. Portfolio includes mobile games and VR experiences with engaging gameplay mechanics.', 'cv/deni_kurniawan_cv.pdf', 'OrbitasiInovasiDigital', 'new', '2024-10-19 06:30:00', '2025-11-01 08:30:23'),
(36, 'Elsa Damayanti', 'elsa.damayanti@email.com', '@elsadamayanti', '089789012356', 'Cyber security', 'Legal officer with experience in contract review, compliance, and corporate law. Strong attention to detail and analytical thinking.', 'cv/elsa_damayanti_cv.pdf', 'BestKreatifTeknologi', 'rejected', '2024-10-20 07:45:00', '2025-11-01 08:30:23'),
(37, 'Fajar Ramadhan', 'fajar.ramadhan@email.com', '@fajarramadhan', '081890123467', 'Cyber security', 'IoT engineer with experience in embedded systems, sensor integration, and MQTT protocols. Strong Arduino and Raspberry Pi skills.', 'cv/fajar_ramadhan_cv.pdf', 'CyberVenturesIndonesia', 'accepted', '2024-10-21 08:00:00', '2025-11-01 08:30:23'),
(38, 'Gita Savitri', 'gita.savitri@email.com', '@gitasavitri', '082901234578', 'Cyber security', 'Brand manager with creative vision and strategic thinking. Experience in brand positioning, campaign management, and market research.', 'cv/gita_savitri_cv.pdf', 'AlgonesiaDigitalKreasi', 'new', '2024-10-22 01:15:00', '2025-11-01 08:30:23'),
(39, 'Hadi Wijaya', 'hadi.wijaya@email.com', '@hadiwijaya', '083012345689', 'Cyber security', 'ERP consultant with expertise in SAP and Oracle systems. Experience in business process analysis and system implementation.', 'cv/hadi_wijaya_cv.pdf', 'AksaratechGlobalKreasi', 'reviewed', '2024-10-23 02:30:00', '2025-11-01 08:30:23'),
(40, 'Ika Purnama', 'ika.purnama@email.com', '@ikapurnama', '084123456790', 'Cyber security', 'Supply chain analyst with expertise in logistics optimization, demand forecasting, and inventory management using advanced analytics.', 'cv/ika_purnama_cv.pdf', 'OrbitasiInovasiDigital', 'interviewed', '2024-10-24 03:45:00', '2025-11-01 08:30:23'),
(41, 'Jefri Nichol', 'jefri.nichol@email.com', '@jefrinichol', '085234567801', 'Cyber security', 'Animation designer skilled in 2D and 3D animation. Experience with Maya, Blender, and motion graphics for various media projects.', 'cv/jefri_nichol_cv.pdf', 'BestKreatifTeknologi', 'new', '2024-10-25 04:00:00', '2025-11-01 08:30:23'),
(42, 'Kirana Larasati', 'kirana.larasati@email.com', '@kiranalas', '086345678912', 'Cyber security', 'Research analyst with strong quantitative and qualitative research skills. Experience in market research and competitive analysis.', 'cv/kirana_larasati_cv.pdf', 'CyberVenturesIndonesia', 'reviewed', '2024-10-26 05:15:00', '2025-11-01 08:30:23'),
(43, 'Luthfi Hakim', 'luthfi.hakim@email.com', '@luthfihakim', '087456789023', 'Cyber security', 'Automation engineer with expertise in RPA tools like UiPath and Blue Prism. Experience automating business processes to improve efficiency.', 'cv/luthfi_hakim_cv.pdf', 'AlgonesiaDigitalKreasi', 'accepted', '2024-10-27 06:30:00', '2025-11-01 08:30:23'),
(44, 'Melati Kusuma', 'melati.kusuma@email.com', '@melatikus', '088567890134', 'Cyber security', 'Event coordinator with experience planning and executing corporate events, conferences, and workshops. Strong organizational skills.', 'cv/melati_kusuma_cv.pdf', 'AksaratechGlobalKreasi', 'new', '2024-10-28 07:45:00', '2025-11-01 08:30:23'),
(45, 'Naufal Aziz', 'naufal.aziz@email.com', '@naufalaziz', '089678901245', 'Cyber security', 'Frontend architect with deep expertise in React ecosystem, state management, and performance optimization. Mentor for junior developers.', 'cv/naufal_aziz_cv.pdf', 'OrbitasiInovasiDigital', 'interviewed', '2024-10-29 08:00:00', '2025-11-01 08:30:23'),
(47, 'Prima Ananda', 'prima.ananda@email.com', '@primaananda', '082890123467', 'Cyber security', 'UX researcher with expertise in user interviews, usability testing, and creating user personas. Data-driven approach to design decisions.', 'cv/prima_ananda_cv.pdf', 'CyberVenturesIndonesia', 'new', '2024-10-15 02:15:00', '2025-11-01 08:30:23'),
(48, 'Qori Sandrina', 'qori.sandrina@email.com', '@qorisand', '083901234578', 'Cyber security', 'Performance engineer specialized in application performance monitoring, load testing, and optimization strategies for high-traffic systems.', 'cv/qori_sandrina_cv.pdf', 'AlgonesiaDigitalKreasi', 'reviewed', '2024-10-16 03:30:00', '2025-11-01 08:30:23'),
(49, 'Rama Doni', 'rama.doni@email.com', '@ramadoni', '084012345689', 'Cyber security', 'Integration specialist with expertise in API integration, middleware solutions, and system interconnectivity. Strong problem-solving abilities.', 'cv/rama_doni_cv.pdf', 'AksaratechGlobalKreasi', 'accepted', '2024-10-17 04:45:00', '2025-11-01 08:30:23'),
(50, 'Saskia Putri', 'saskia.putri@email.com', '@saskiaputri', '085123456790', 'Cyber security', 'Training specialist with experience in developing training programs, conducting workshops, and measuring training effectiveness.', 'cv/saskia_putri_cv.pdf', 'OrbitasiInovasiDigital', 'new', '2024-10-18 06:00:00', '2025-11-01 08:30:23');

-- --------------------------------------------------------

--
-- Table structure for table `keywords`
--

CREATE TABLE `keywords` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `training_data_id` bigint(20) UNSIGNED NOT NULL,
  `keyword` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `weight` decimal(3,2) DEFAULT 1.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `keywords`
--

INSERT INTO `keywords` (`id`, `training_data_id`, `keyword`, `weight`, `created_at`, `updated_at`) VALUES
(1, 1, 'senin', '1.50', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(2, 1, 'jadwal', '1.20', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(3, 1, 'kuliah', '1.00', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(4, 2, 'selasa', '1.50', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(5, 2, 'jadwal', '1.20', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(6, 2, 'kuliah', '1.00', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(7, 3, 'rabu', '1.50', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(8, 3, 'jadwal', '1.20', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(9, 3, 'kuliah', '1.00', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(10, 4, 'kamis', '1.50', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(11, 4, 'jadwal', '1.20', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(12, 4, 'kuliah', '1.00', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(13, 5, 'jumat', '1.50', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(14, 5, 'jadwal', '1.20', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(15, 5, 'kuliah', '1.00', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(16, 6, 'pemrograman', '1.50', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(17, 6, 'web', '1.50', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(18, 6, 'kapan', '1.20', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(19, 7, 'basis', '1.50', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(20, 7, 'data', '1.50', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(21, 7, 'database', '1.50', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(22, 7, 'jam', '1.20', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(23, 8, 'a301', '1.80', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(24, 8, 'ruang', '1.20', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(25, 8, 'dimana', '1.20', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(26, 8, 'lokasi', '1.00', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(27, 9, 'lab', '1.50', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(28, 9, 'komputer', '1.50', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(29, 9, '1', '1.30', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(30, 9, 'dimana', '1.20', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(31, 10, 'b205', '1.80', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(32, 10, 'ruang', '1.20', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(33, 10, 'lokasi', '1.20', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(34, 11, 'gedung', '1.50', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(35, 11, 'c', '1.50', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(36, 11, 'dimana', '1.20', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(37, 12, 'seminar', '1.80', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(38, 12, 'ruang', '1.20', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(39, 12, 'dimana', '1.20', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(40, 13, 'perpustakaan', '1.80', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(41, 13, 'perpus', '1.80', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(42, 13, 'library', '1.50', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(43, 13, 'dimana', '1.20', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(44, 14, 'kantin', '1.80', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(45, 14, 'makan', '1.30', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(46, 14, 'dimana', '1.20', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(47, 15, 'dosen', '1.50', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(48, 15, 'pemrograman', '1.50', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(49, 15, 'web', '1.50', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(50, 15, 'siapa', '1.20', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(51, 16, 'dosen', '1.50', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(52, 16, 'basis', '1.50', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(53, 16, 'data', '1.50', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(54, 16, 'database', '1.50', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(55, 17, 'dosen', '1.50', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(56, 17, 'algoritma', '1.50', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(57, 17, 'kontak', '1.20', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(58, 18, 'konsultasi', '1.50', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(59, 18, 'dosen', '1.50', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(60, 18, 'jam', '1.20', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(61, 19, 'krs', '1.80', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(62, 19, 'daftar', '1.30', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(63, 19, 'cara', '1.20', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(64, 19, 'kartu', '1.00', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(65, 19, 'rencana', '1.00', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(66, 20, 'spp', '1.80', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(67, 20, 'bayar', '1.50', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(68, 20, 'cara', '1.20', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(69, 20, 'pembayaran', '1.30', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(70, 21, 'uas', '1.50', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(71, 21, 'ujian', '1.50', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(72, 21, 'akhir', '1.30', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(73, 21, 'syarat', '1.30', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(74, 22, 'transkrip', '1.80', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(75, 22, 'nilai', '1.30', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(76, 22, 'cetak', '1.30', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(77, 23, 'cuti', '1.80', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(78, 23, 'kuliah', '1.20', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(79, 23, 'cara', '1.20', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(80, 23, 'ajukan', '1.20', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(81, 24, 'wifi', '1.80', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(82, 24, 'password', '1.50', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(83, 24, 'internet', '1.30', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(84, 25, 'olahraga', '1.50', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(85, 25, 'fasilitas', '1.30', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(86, 25, 'sport', '1.30', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(87, 26, 'parkir', '1.80', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(88, 26, 'motor', '1.50', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(89, 26, 'dimana', '1.20', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(90, 27, 'atm', '1.80', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(91, 27, 'bank', '1.30', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(92, 27, 'dimana', '1.20', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(93, 28, 'organisasi', '1.50', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(94, 28, 'ukm', '1.50', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(95, 28, 'bem', '1.30', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(96, 28, 'himpunan', '1.20', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(97, 29, 'ukm', '1.80', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(98, 29, 'daftar', '1.30', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(99, 29, 'cara', '1.20', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(100, 30, 'wisuda', '1.80', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(101, 30, 'kapan', '1.30', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(102, 30, 'graduation', '1.30', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(103, 31, 'sks', '1.80', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(104, 31, 'maksimal', '1.30', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(105, 31, 'berapa', '1.20', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(106, 32, 'ipk', '1.80', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(107, 32, 'lulus', '1.50', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(108, 32, 'minimal', '1.30', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(109, 33, 'mengulang', '1.50', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(110, 33, 'mata', '1.30', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(111, 33, 'kuliah', '1.30', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(112, 33, 'cara', '1.20', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(113, 34, 'uts', '1.50', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(114, 34, 'uas', '1.50', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(115, 34, 'ujian', '1.50', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(116, 34, 'kapan', '1.30', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(117, 35, 'beasiswa', '1.80', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(118, 35, 'scholarship', '1.50', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(119, 35, 'bantuan', '1.20', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(120, 36, 'beasiswa', '1.80', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(121, 36, 'prestasi', '1.50', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(122, 36, 'syarat', '1.30', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(123, 37, 'skripsi', '1.80', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(124, 37, 'mulai', '1.30', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(125, 37, 'syarat', '1.30', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(126, 37, 'thesis', '1.50', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(127, 38, 'skripsi', '1.80', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(128, 38, 'biaya', '1.50', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(129, 38, 'berapa', '1.20', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(130, 39, 'skripsi', '1.80', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(131, 39, 'lama', '1.30', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(132, 39, 'waktu', '1.30', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(133, 40, 'jam', '1.50', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(134, 40, 'operasional', '1.50', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(135, 40, 'buka', '1.30', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(136, 40, 'kampus', '1.20', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(137, 41, 'telepon', '1.50', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(138, 41, 'nomor', '1.50', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(139, 41, 'kontak', '1.50', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(140, 41, 'hubungi', '1.20', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(141, 42, 'transportasi', '1.50', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(142, 42, 'umum', '1.30', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(143, 42, 'cara', '1.20', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(144, 42, 'ke', '1.00', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(145, 43, 'libur', '1.80', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(146, 43, 'hari', '1.20', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(147, 43, 'holiday', '1.30', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(148, 44, 'ktm', '1.80', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(149, 44, 'kartu', '1.50', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(150, 44, 'mahasiswa', '1.30', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(151, 44, 'buat', '1.20', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(152, 45, 'surat', '1.50', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(153, 45, 'keterangan', '1.50', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(154, 45, 'aktif', '1.50', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(155, 45, 'mahasiswa', '1.30', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(156, 46, 'kesehatan', '1.50', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(157, 46, 'klinik', '1.50', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(158, 46, 'dokter', '1.30', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(159, 46, 'layanan', '1.20', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(160, 47, 'konseling', '1.80', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(161, 47, 'psikologi', '1.50', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(162, 47, 'curhat', '1.30', '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(164, 48, 'Jadwal', '1.00', '2025-11-05 12:23:26', '2025-11-05 12:23:26'),
(165, 48, 'hari', '1.00', '2025-11-05 12:23:30', '2025-11-05 12:23:30'),
(166, 48, 'kuliah', '1.00', '2025-11-05 12:23:33', '2025-11-05 12:23:33'),
(167, 49, 'Hari', '1.00', '2025-11-05 12:24:46', '2025-11-05 12:24:46'),
(168, 49, 'Libur', '1.00', '2025-11-05 12:24:56', '2025-11-05 12:24:56'),
(169, 49, 'Kuliah', '1.00', '2025-11-05 12:25:02', '2025-11-05 12:25:02');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `training_data`
--

CREATE TABLE `training_data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT 'umum',
  `priority` int(11) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `training_data`
--

INSERT INTO `training_data` (`id`, `question`, `answer`, `category`, `priority`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'jadwal senin apa', 'Jadwal kuliah hari Senin:\n08.00-10.00: Pemrograman Web (Ruang A301)\n10.00-12.00: Basis Data (Ruang B205)\n13.00-15.00: Algoritma (Ruang A302)\n15.00-17.00: Jaringan Komputer (Lab Komputer 1)', 'jadwal', 10, 1, '2025-11-05 18:16:23', '2025-11-05 12:29:54'),
(2, 'jadwal selasa', 'Jadwal kuliah hari Selasa:\n08.00-10.00: Kalkulus (Ruang C101)\n10.00-12.00: Sistem Operasi (Lab Komputer 2)\n13.00-15.00: Struktur Data (Ruang A301)\n15.00-17.00: Bahasa Inggris (Ruang B103)', 'jadwal', 10, 1, '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(3, 'jadwal rabu', 'Jadwal kuliah hari Rabu:\n08.00-10.00: Rekayasa Perangkat Lunak (Ruang A302)\n10.00-12.00: Pemrograman Mobile (Lab Komputer 3)\n13.00-15.00: Matematika Diskrit (Ruang C102)\n15.00-17.00: Free/Konsultasi Dosen', 'jadwal', 10, 1, '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(4, 'jadwal kamis', 'Jadwal kuliah hari Kamis:\n08.00-10.00: Kecerdasan Buatan (Ruang A301)\n10.00-12.00: Data Mining (Lab Komputer 1)\n13.00-15.00: Grafika Komputer (Lab Komputer 2)\n15.00-17.00: Praktikum Web (Lab Komputer 3)', 'jadwal', 10, 1, '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(5, 'jadwal jumat', 'Jadwal kuliah hari Jumat:\n08.00-10.00: Etika Profesi (Ruang B205)\n10.00-12.00: Keamanan Jaringan (Lab Komputer 1)\n13.00-15.00: Seminar Proposal/Skripsi (Ruang Seminar)\nJumat sore libur', 'jadwal', 10, 1, '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(6, 'kapan kuliah pemrograman web', 'Kuliah Pemrograman Web dijadwalkan setiap hari Senin pukul 08.00-10.00 di Ruang A301. Dosen pengampu: Dr. Budi Santoso, M.Kom', 'jadwal', 9, 1, '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(7, 'jam berapa kuliah basis data', 'Kuliah Basis Data dijadwalkan setiap hari Senin pukul 10.00-12.00 di Ruang B205. Dosen pengampu: Prof. Ani Wijaya, M.T.', 'jadwal', 9, 1, '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(8, 'ruang a301 dimana', 'Ruang A301 terletak di Gedung A lantai 3, sebelah kanan dari tangga utama. Kapasitas 40 mahasiswa, dilengkapi proyektor dan AC.', 'ruangan', 9, 1, '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(9, 'dimana lab komputer 1', 'Lab Komputer 1 berada di Gedung B lantai 2. Memiliki 50 unit komputer dengan spesifikasi Core i5, RAM 8GB. Buka Senin-Jumat 08.00-17.00.', 'ruangan', 9, 1, '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(10, 'lokasi ruang b205', 'Ruang B205 terletak di Gedung B lantai 2, menghadap ke aula utama. Dilengkapi dengan whiteboard elektronik dan sound system.', 'ruangan', 9, 1, '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(11, 'gedung c dimana', 'Gedung C adalah gedung baru di sebelah timur kampus, dekat dengan lapangan basket. Terdiri dari 5 lantai dengan fasilitas modern.', 'ruangan', 9, 1, '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(12, 'ruang seminar dimana', 'Ruang Seminar terletak di lantai 1 Gedung Rektorat, di sebelah kiri pintu masuk utama. Kapasitas 100 orang dengan fasilitas multimedia lengkap.', 'ruangan', 9, 1, '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(13, 'perpustakaan dimana', 'Perpustakaan berada di Gedung D lantai 1-3. Buka Senin-Jumat 08.00-20.00, Sabtu 08.00-14.00. Fasilitas: ruang baca, ruang diskusi, akses WiFi, dan koleksi 50.000+ buku.', 'ruangan', 10, 1, '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(14, 'kantin dimana', 'Kantin kampus ada 2 lokasi:\n1. Kantin Utama: Di belakang Gedung A, menyediakan berbagai menu nasi, mie, snack\n2. Kantin Mini: Lantai 1 Gedung C, menyediakan minuman dan snack', 'ruangan', 8, 1, '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(15, 'siapa dosen pemrograman web', 'Dosen Pemrograman Web adalah Dr. Budi Santoso, M.Kom. Ruang dosen: Gedung A lantai 4 nomor A401. Jam konsultasi: Senin & Rabu 15.00-17.00. Email: budi.santoso@campus.ac.id', 'dosen', 8, 1, '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(16, 'dosen basis data siapa', 'Dosen Basis Data adalah Prof. Ani Wijaya, M.T. Ruang dosen: Gedung B lantai 3 nomor B301. Jam konsultasi: Selasa & Kamis 13.00-15.00. Email: ani.wijaya@campus.ac.id', 'dosen', 8, 1, '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(17, 'kontak dosen algoritma', 'Dosen Algoritma adalah Dr. Ir. Siti Rahmawati, M.Kom. Ruang: A402. Konsultasi: Rabu 10.00-12.00. Email: siti.rahmawati@campus.ac.id. HP: 0812-3456-7890', 'dosen', 7, 1, '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(18, 'jam konsultasi dosen', 'Setiap dosen memiliki jadwal konsultasi berbeda. Silakan cek di portal akademik atau tanyakan dosen spesifik yang Anda cari. Umumnya dosen ada di kampus Senin-Jumat 08.00-16.00.', 'dosen', 7, 1, '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(19, 'cara daftar krs', 'Pendaftaran KRS (Kartu Rencana Studi):\n1. Login ke portal akademik (akademik.campus.ac.id)\n2. Pilih menu \"KRS\"\n3. Pilih mata kuliah yang ingin diambil\n4. Submit dan cetak KRS\n5. Minta persetujuan dosen wali\nBatas waktu: 2 minggu pertama di awal semester', 'administrasi', 10, 1, '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(20, 'cara bayar spp', 'Pembayaran SPP dapat dilakukan melalui:\n1. Transfer Bank: BNI 1234567890 a.n. Kampus XYZ\n2. Mobile Banking\n3. ATM\n4. Kasir kampus (Gedung Rektorat lt.1)\nBatas pembayaran: tanggal 10 setiap bulan. Upload bukti pembayaran di portal akademik.', 'administrasi', 10, 1, '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(21, 'syarat ujian akhir semester', 'Syarat mengikuti UAS:\n1. Kehadiran minimal 75%\n2. Mengerjakan semua tugas\n3. Mengikuti UTS\n4. SPP lunas\n5. Tidak ada tunggakan administrasi\nKonfirmasi ke bagian akademik jika ada kendala.', 'administrasi', 9, 1, '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(22, 'cara cetak transkrip', 'Untuk mencetak transkrip nilai:\n1. Datang ke bagian akademik dengan KTM\n2. Isi formulir permohonan transkrip\n3. Bayar biaya cetak Rp 25.000\n4. Proses 3 hari kerja\nAtau bisa cetak sementara di portal akademik (unofficial).', 'administrasi', 8, 1, '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(23, 'cara ajukan cuti kuliah', 'Prosedur cuti kuliah:\n1. Download formulir cuti di portal akademik\n2. Isi formulir dan lampirkan alasan\n3. Tanda tangan dosen wali dan orang tua\n4. Submit ke bagian akademik\n5. Tunggu persetujuan (max 7 hari kerja)\nCuti max 2 semester berturut-turut.', 'administrasi', 8, 1, '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(24, 'wifi password apa', 'WiFi kampus:\nSSID: Campus-WiFi\nPassword: kampus2024\nAtau login dengan akun portal akademik Anda di SSID \"Campus-Student\". Kecepatan 100 Mbps. Koneksi stabil di seluruh area kampus.', 'fasilitas', 9, 1, '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(25, 'fasilitas olahraga apa saja', 'Fasilitas olahraga kampus:\n1. Lapangan basket (outdoor)\n2. Lapangan futsal (indoor, Gedung Olahraga)\n3. Lapangan voli (outdoor)\n4. Gym (Gedung Olahraga lt.2)\n5. Jogging track\nBuka Senin-Sabtu 06.00-18.00. Gratis untuk mahasiswa.', 'fasilitas', 8, 1, '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(26, 'parkir motor dimana', 'Area parkir motor:\n1. Parkir Utama: Depan Gedung A (kapasitas 200)\n2. Parkir Belakang: Samping Gedung C (kapasitas 150)\nBiaya: Gratis dengan stiker parkir mahasiswa. Stiker bisa diurus di Satpam kampus dengan KTM.', 'fasilitas', 7, 1, '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(27, 'ada atm tidak', 'ATM tersedia di:\n1. BNI: Lobby Gedung Rektorat\n2. BCA: Dekat kantin utama\n3. Mandiri: Gedung C lantai 1\nSemua ATM beroperasi 24 jam.', 'fasilitas', 7, 1, '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(28, 'organisasi kampus apa saja', 'Organisasi mahasiswa:\n1. BEM (Badan Eksekutif Mahasiswa)\n2. Himpunan Mahasiswa Jurusan\n3. UKM Olahraga (Basket, Futsal, Badminton)\n4. UKM Seni (Musik, Tari, Teater)\n5. UKM Kerohanian (IMM, PMK, BKM)\n6. Komunitas IT (Programming, Robotika, Cyber Security)\nPendaftaran di awal semester.', 'organisasi', 8, 1, '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(29, 'cara daftar ukm', 'Pendaftaran UKM:\n1. Datang saat Open Recruitment (awal semester)\n2. Isi formulir pendaftaran\n3. Ikuti seleksi (jika ada)\n4. Bayar iuran anggota (varies per UKM)\nInfo lengkap: bem@campus.ac.id atau cek Instagram @bem_campus', 'organisasi', 8, 1, '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(30, 'kapan wisuda', 'Wisuda diadakan 2 kali setahun:\n1. Periode 1: Maret/April (untuk lulusan semester ganjil)\n2. Periode 2: September/Oktober (untuk lulusan semester genap)\nPengumuman jadwal pasti 2 bulan sebelumnya di portal akademik.', 'organisasi', 7, 1, '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(31, 'berapa sks maksimal per semester', 'Beban SKS per semester:\n- IPK ≥ 3.00: Max 24 SKS\n- IPK 2.50-2.99: Max 21 SKS\n- IPK 2.00-2.49: Max 18 SKS\n- IPK < 2.00: Max 15 SKS\nSemester 1-2: Max 20 SKS', 'akademik', 9, 1, '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(32, 'ipk minimal untuk lulus', 'Syarat kelulusan:\n1. IPK minimal 2.00\n2. Lulus semua mata kuliah wajib\n3. Total SKS minimal 144 SKS\n4. Tidak ada nilai E\n5. Lulus skripsi\n6. Lulus TOEFL min 450\n7. Tidak ada tunggakan administrasi', 'akademik', 9, 1, '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(33, 'cara mengulang mata kuliah', 'Mengulang mata kuliah:\n1. Nilai D atau E bisa diulang\n2. Daftar saat KRS semester berikutnya\n3. Nilai terbaru yang dihitung di IPK\n4. Mata kuliah dapat diulang max 2 kali\n5. Biaya normal sesuai SKS', 'akademik', 8, 1, '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(34, 'kapan uts dan uas', 'Jadwal ujian:\n- UTS (Ujian Tengah Semester): Minggu ke-8\n- UAS (Ujian Akhir Semester): Minggu ke-16\nJadwal detail diumumkan 2 minggu sebelumnya di portal akademik dan papan pengumuman.', 'akademik', 9, 1, '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(35, 'beasiswa apa saja yang tersedia', 'Beasiswa yang tersedia:\n1. Beasiswa PPA (Peningkatan Prestasi Akademik) - IPK min 3.00\n2. Beasiswa BBM (Bantuan Biaya Mahasiswa) - untuk kurang mampu\n3. Beasiswa Prestasi - juara kompetisi\n4. Beasiswa KIP-K - dari pemerintah\n5. Beasiswa Yayasan - dari sponsor perusahaan\nInfo: beasiswa@campus.ac.id', 'beasiswa', 9, 1, '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(36, 'syarat beasiswa prestasi', 'Syarat Beasiswa Prestasi:\n1. IPK minimal 3.25\n2. Aktif berorganisasi\n3. Juara 1-3 lomba tingkat nasional/internasional\n4. Surat rekomendasi dosen\n5. Essay motivasi\nNominal: Rp 3.000.000 - 5.000.000 per semester', 'beasiswa', 8, 1, '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(37, 'syarat mulai skripsi', 'Syarat mengambil skripsi:\n1. Lulus minimal 120 SKS\n2. IPK minimal 2.00\n3. Lulus semua mata kuliah prasyarat\n4. Tidak ada nilai E\n5. Proposal skripsi disetujui dosen pembimbing\n6. Mengikuti seminar proposal', 'skripsi', 9, 1, '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(38, 'biaya skripsi berapa', 'Biaya skripsi:\n1. Bimbingan skripsi: Gratis\n2. Seminar proposal: Rp 100.000\n3. Sidang skripsi: Rp 150.000\n4. Cetak buku skripsi: ~Rp 300.000 (5 eksemplar)\n5. Total estimasi: Rp 550.000 - 700.000', 'skripsi', 8, 1, '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(39, 'lama pengerjaan skripsi', 'Waktu pengerjaan skripsi:\n- Minimal: 1 semester (6 bulan)\n- Maksimal: 4 semester (2 tahun)\nJika lebih dari 2 tahun, harus daftar ulang dan bayar perpanjangan. Konsultasi rutin dengan dosen pembimbing sangat dianjurkan.', 'skripsi', 8, 1, '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(40, 'jam operasional kampus', 'Jam operasional:\n- Senin-Jumat: 07.00-17.00\n- Sabtu: 07.00-14.00 (terbatas)\n- Minggu & hari libur: Tutup\nBagian akademik: 08.00-15.00 (Senin-Jumat)\nPerpustakaan: 08.00-20.00 (Senin-Jumat)', 'umum', 8, 1, '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(41, 'nomor telepon kampus', 'Kontak kampus:\nTelepon: (021) 1234-5678\nWhatsApp: 0812-3456-7890\nEmail: info@campus.ac.id\nWebsite: www.campus.ac.id\nAlamat: Jl. Pendidikan No. 123, Jakarta Selatan 12345', 'umum', 9, 1, '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(42, 'cara ke kampus naik transportasi umum', 'Akses transportasi umum:\n1. TransJakarta: Halte Kampus XYZ (Koridor 6)\n2. KRL: Stasiun Universitas (15 menit jalan kaki)\n3. Angkot: Jurusan Ragunan-Blok M, turun depan kampus\n4. Ojek Online: Pakai pin lokasi \"Kampus XYZ\"\nTersedia juga shuttle bus gratis dari stasiun setiap 30 menit.', 'umum', 7, 1, '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(43, 'hari libur kampus', 'Libur kampus:\n1. Libur semester: Juli-Agustus & Januari-Februari\n2. Libur nasional & keagamaan\n3. Dies natalis kampus: 17 Agustus\n4. Cuti bersama sesuai ketentuan pemerintah\nKalender akademik lengkap bisa diunduh di portal.', 'umum', 7, 1, '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(44, 'cara buat ktm baru', 'Pembuatan KTM (Kartu Tanda Mahasiswa):\n1. Datang ke bagian kemahasiswaan dengan foto 3x4 (2 lembar)\n2. Isi formulir permohonan KTM\n3. Bayar biaya cetak Rp 50.000\n4. Proses 5 hari kerja\n5. Ambil KTM dengan bukti pembayaran\nKTM hilang? Lapor dan buat baru dengan prosedur sama + surat kehilangan.', 'layanan', 8, 1, '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(45, 'surat keterangan mahasiswa aktif', 'Surat Keterangan Mahasiswa Aktif:\n1. Login portal akademik\n2. Menu \"Layanan Surat\"\n3. Pilih \"Surat Keterangan Aktif\"\n4. Cetak (bermeterai digital)\nAtau datang langsung ke bagian akademik dengan KTM, proses 1 hari kerja. Gratis.', 'layanan', 8, 1, '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(46, 'layanan kesehatan kampus', 'Klinik Kampus (Gedung Rektorat lt.1):\n- Buka: Senin-Jumat 08.00-15.00\n- Dokter umum & perawat\n- Obat-obatan dasar gratis\n- Konsultasi kesehatan gratis\n- Rujukan ke RS jika perlu\nKontak: 0812-9999-8888', 'layanan', 7, 1, '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(47, 'konseling psikologi', 'Layanan Konseling:\n- Lokasi: Gedung C lantai 1\n- Jadwal: Senin-Jumat 09.00-16.00\n- Psikolog profesional\n- Gratis & rahasia\n- Buat janji: konseling@campus.ac.id atau WA 0812-7777-6666\nJangan ragu untuk curhat masalah akademik atau personal!', 'layanan', 8, 1, '2025-11-05 18:16:23', '2025-11-05 18:16:23'),
(48, 'Jadwal sabtu', 'Sabtu tidak masuk kuliah', 'jadwal', 5, 1, '2025-11-05 12:03:38', '2025-11-05 12:22:57'),
(49, 'Jadwal minggu', 'Hari minggu tidak ada jadwal kuliah, silahkan istirahat 😊', 'jadwal', 5, 1, '2025-11-05 12:24:31', '2025-11-05 12:24:31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_unicode_ci DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$10$oK9Ts3mTgzlQ64rZvkCIN.DpByQq6RvP3nGVxi9KCIQNutVqlMAkm', 'admin', '2025-11-05 18:16:23', '2025-11-05 18:58:37'),
(2, 'Mahasiswa', 'user@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', '2025-11-05 18:16:23', '2025-11-05 18:58:44'),
(3, 'evan', 'evan@gmail.com', '$2y$12$GnavmbIus6UbPXIRAKfIdO2uAAElW0Via0iCzqNwFgxlAL41yFQea', 'user', '2025-11-05 11:57:16', '2025-11-05 11:57:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat_histories`
--
ALTER TABLE `chat_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `matched_training_id` (`matched_training_id`),
  ADD KEY `idx_session` (`session_id`),
  ADD KEY `idx_user` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `job_applications`
--
ALTER TABLE `job_applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_email` (`email`),
  ADD KEY `idx_job_available` (`job_available`),
  ADD KEY `idx_created_at` (`created_at`);

--
-- Indexes for table `keywords`
--
ALTER TABLE `keywords`
  ADD PRIMARY KEY (`id`),
  ADD KEY `training_data_id` (`training_data_id`),
  ADD KEY `idx_keyword` (`keyword`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `training_data`
--
ALTER TABLE `training_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_category` (`category`),
  ADD KEY `idx_active` (`is_active`);
ALTER TABLE `training_data` ADD FULLTEXT KEY `idx_question` (`question`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat_histories`
--
ALTER TABLE `chat_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_applications`
--
ALTER TABLE `job_applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `keywords`
--
ALTER TABLE `keywords`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `training_data`
--
ALTER TABLE `training_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chat_histories`
--
ALTER TABLE `chat_histories`
  ADD CONSTRAINT `chat_histories_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `chat_histories_ibfk_2` FOREIGN KEY (`matched_training_id`) REFERENCES `training_data` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `keywords`
--
ALTER TABLE `keywords`
  ADD CONSTRAINT `keywords_ibfk_1` FOREIGN KEY (`training_data_id`) REFERENCES `training_data` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
