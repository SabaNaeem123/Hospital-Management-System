-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2025 at 06:50 PM
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
-- Database: `hospital`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'Admin', '0192023a7bbd73250516f069df18b500');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `appointment_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `status` enum('booked','completed','canceled by doctor','canceled by patient','canceled by admin','reschedule by doctor','reschedule by admin') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `doctor_id`, `patient_id`, `appointment_date`, `start_time`, `end_time`, `status`) VALUES
(5, 14, 15, '2024-10-29', '09:00:00', '11:10:00', 'canceled by patient'),
(6, 14, 15, '2024-10-29', '09:00:00', '11:10:00', 'booked'),
(7, 14, 15, '2024-10-29', '09:00:00', '11:10:00', 'booked'),
(8, 14, 15, '2024-10-29', '09:00:00', '11:10:00', 'booked'),
(9, 3, 15, '2024-10-29', '07:30:00', '09:30:00', 'reschedule by doctor'),
(10, 3, 15, '2024-10-31', '07:00:00', '09:00:00', 'canceled by doctor'),
(11, 3, 15, '2024-10-31', '07:00:00', '09:00:00', 'booked'),
(12, 3, 15, '2024-10-31', '07:00:00', '09:00:00', 'canceled by doctor'),
(13, 3, 15, '2024-11-01', '07:00:00', '21:00:00', 'canceled by doctor'),
(14, 14, 15, '2024-10-31', '09:00:00', '11:10:00', 'booked'),
(15, 14, 15, '2024-10-31', '09:00:00', '11:10:00', 'booked'),
(16, 3, 15, '2024-11-01', '07:00:00', '21:00:00', 'canceled by doctor'),
(17, 3, 15, '2024-11-01', '07:00:00', '21:00:00', 'booked'),
(18, 3, 15, '2024-11-01', '09:30:00', '09:30:00', 'reschedule by doctor'),
(19, 3, 18, '2024-11-01', '09:00:00', '09:30:00', 'canceled by patient');

-- --------------------------------------------------------

--
-- Table structure for table `cleanup_log`
--

CREATE TABLE `cleanup_log` (
  `id` int(11) NOT NULL,
  `last_cleanup_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cleanup_log`
--

INSERT INTO `cleanup_log` (`id`, `last_cleanup_date`) VALUES
(1, '2024-09-28');

-- --------------------------------------------------------

--
-- Table structure for table `disease`
--

CREATE TABLE `disease` (
  `disease_id` int(11) NOT NULL,
  `disease_name` varchar(255) DEFAULT NULL,
  `intro_title` varchar(255) DEFAULT NULL,
  `intro_text1` text DEFAULT NULL,
  `intro_text2` text DEFAULT NULL,
  `symptom1_title` varchar(255) DEFAULT NULL,
  `symptom1_detail` text DEFAULT NULL,
  `symptom2_title` varchar(255) DEFAULT NULL,
  `symptom2_detail` text DEFAULT NULL,
  `symptom3_title` varchar(255) DEFAULT NULL,
  `symptom3_detail` text DEFAULT NULL,
  `prevention1_title` varchar(255) DEFAULT NULL,
  `prevention1_detail` text DEFAULT NULL,
  `prevention2_title` varchar(255) DEFAULT NULL,
  `prevention2_detail` text DEFAULT NULL,
  `prevention3_title` varchar(255) DEFAULT NULL,
  `prevention3_detail` text DEFAULT NULL,
  `treatment1_title` varchar(255) DEFAULT NULL,
  `treatment1_detail` text DEFAULT NULL,
  `treatment2_title` varchar(255) DEFAULT NULL,
  `treatment2_detail` text DEFAULT NULL,
  `treatment3_title` varchar(255) DEFAULT NULL,
  `treatment3_detail` text DEFAULT NULL,
  `conclusion_heading` varchar(255) DEFAULT NULL,
  `conclusion_text` text DEFAULT NULL,
  `conclusion_point1` varchar(255) DEFAULT NULL,
  `conclusion_point2` varchar(255) DEFAULT NULL,
  `conclusion_point3` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `disease`
--

INSERT INTO `disease` (`disease_id`, `disease_name`, `intro_title`, `intro_text1`, `intro_text2`, `symptom1_title`, `symptom1_detail`, `symptom2_title`, `symptom2_detail`, `symptom3_title`, `symptom3_detail`, `prevention1_title`, `prevention1_detail`, `prevention2_title`, `prevention2_detail`, `prevention3_title`, `prevention3_detail`, `treatment1_title`, `treatment1_detail`, `treatment2_title`, `treatment2_detail`, `treatment3_title`, `treatment3_detail`, `conclusion_heading`, `conclusion_text`, `conclusion_point1`, `conclusion_point2`, `conclusion_point3`) VALUES
(1, 'Asthma', 'Understanding Asthma', 'Asthma is a chronic respiratory condition where the airways become inflamed, leading to narrowing and difficulty in breathing. Common triggers include allergens, pollution, cold air, and exercise. Asthma symptoms can range from mild to severe and may require urgent medical intervention if breathing becomes severely compromised.', 'While there is no cure for asthma, symptoms can be managed through medications, lifestyle adjustments, and avoiding known triggers. With the right treatment plan, individuals with asthma can enjoy an active lifestyle with minimal interruptions.', 'Shortness of Breath', 'Restricted airways make it difficult to breathe normally, especially during physical activity.', 'Wheezing', 'A high-pitched sound that occurs when breathing, due to constricted airways.', 'Chronic Coughing', 'A persistent cough is often triggered by irritants or physical exertion.', 'Avoid Triggers', 'Identifying and avoiding triggers can help prevent asthma attacks.', 'Exercise Regularly', 'Physical activity, when managed, can improve lung function over time.', 'Medications', 'Inhalers and other medications help keep asthma symptoms under control.', 'Inhalers', 'Inhalers deliver medication directly to the lungs for immediate relief.', 'Allergy Treatments', 'For asthma linked to allergies, immunotherapy may reduce reactions.', 'Emergency Plan', 'Having a clear action plan in case of severe attacks is crucial.', 'Managing Asthma', 'Proper management can lead to fewer symptoms and better quality of life for asthma patients.', 'Identifying triggers can reduce attacks.', 'Medication adherence is essential.', 'An action plan prevents emergencies.'),
(2, 'Hypertension', 'Understanding Hypertension', 'Hypertension, or high blood pressure, is a chronic condition where the force of the blood against the artery walls is consistently elevated. This condition can lead to serious health problems, including heart disease, stroke, and kidney damage. Often called the \"silent killer,\" hypertension can progress without any noticeable symptoms.', 'Regular monitoring, lifestyle changes, and medication can help manage blood pressure levels. Avoiding high-sodium diets, maintaining a healthy weight, and staying active are key measures to prevent and manage hypertension. Untreated, it can damage arteries, leading to life-threatening complications.', 'Headaches', 'Severe headaches may occur when blood pressure reaches dangerous levels.', 'Dizziness', 'High blood pressure can cause feelings of lightheadedness or dizziness.', 'Nosebleeds', 'Occasionally, high blood pressure can cause nosebleeds.', 'Reduce Sodium Intake', 'Lowering salt intake can help maintain healthy blood pressure levels.', 'Regular Exercise', 'Physical activity helps lower and stabilize blood pressure.', 'Limit Alcohol', 'Reducing alcohol consumption can prevent spikes in blood pressure.', 'Antihypertensive Medications', 'Medications may be prescribed to help manage blood pressure levels.', 'Healthy Lifestyle Choices', 'Diet and exercise adjustments help maintain normal blood pressure.', 'Routine Monitoring', 'Frequent checks can alert to changes and prevent complications.', 'Managing Blood Pressure', 'Proactive measures and medication can effectively control hypertension.', 'Lifestyle changes significantly impact blood pressure.', 'Routine monitoring aids early intervention.', 'Medications provide necessary control.'),
(3, 'Tuberculosis', 'Understanding Tuberculosis', 'Tuberculosis (TB) is a contagious bacterial infection caused by *Mycobacterium tuberculosis*, primarily affecting the lungs but potentially impacting other parts of the body. TB spreads through airborne particles when an infected person coughs or sneezes. Without treatment, TB can become life-threatening as it progressively damages the lungs and immune system.', 'While TB remains a major global health issue, early detection and a strict treatment regimen can cure the disease. Preventive measures include vaccination with the BCG vaccine, regular screening in high-risk areas, and prompt treatment of latent TB to avoid progression to active, contagious TB.', 'Chronic Cough', 'A prolonged cough, often with blood-streaked mucus, is a primary symptom of active TB.', 'Weight Loss', 'Significant weight loss is common as the body fights infection.', 'Night Sweats', 'Profuse sweating during the night is frequently associated with TB.', 'BCG Vaccine', 'The BCG vaccine provides some protection, particularly for young children in high-risk areas.', 'Adequate Ventilation', 'Good air circulation helps reduce TB transmission in confined spaces.', 'Regular Screening', 'Screening can detect TB early in high-risk populations.', 'Antibiotics', 'A prolonged course of antibiotics is required to eliminate TB bacteria.', 'Directly Observed Therapy', 'This ensures that patients complete their treatment for TB.', 'Isolation Measures', 'Isolation prevents the spread of TB to others.', 'Managing Tuberculosis', 'With proper treatment and preventive care, TB recovery rates are high.', 'Early diagnosis aids treatment.', 'Medication adherence is critical for TB cure.', 'Preventive measures reduce infection risk.'),
(4, 'Cancer', 'Understanding Cancer', 'Cancer is a group of diseases characterized by uncontrolled cell growth, which can invade and damage surrounding tissues. Cancer cells have the potential to spread to other parts of the body through the bloodstream or lymphatic system, a process known as metastasis. Various factors, including genetic mutations, lifestyle choices, and environmental exposures, can contribute to the development of cancer.', 'Early detection and treatment are crucial in managing cancer effectively. Treatments may include surgery, chemotherapy, radiation, and immunotherapy. Advances in cancer research have improved the chances of survival, but preventive measures like a healthy lifestyle and regular screenings remain vital in reducing risk.', 'Unusual Lumps', 'New or persistent lumps in the body can signal abnormal cell growth.', 'Persistent Fatigue', 'Cancer can cause metabolic changes that lead to prolonged fatigue.', 'Unexplained Weight Loss', 'Rapid, unexplained weight loss can be an early warning sign of cancer.', 'Healthy Diet', 'A diet rich in antioxidants can help reduce the risk of cancer development.', 'Regular Screenings', 'Routine screenings can detect cancer early, when it\'s most treatable.', 'Avoid Tobacco', 'Quitting smoking lowers the risk of lung and other cancers significantly.', 'Chemotherapy', 'Chemotherapy targets and kills rapidly growing cancer cells throughout the body.', 'Radiation Therapy', 'Radiation therapy uses high-energy rays to destroy localized cancer cells.', 'Surgery', 'Surgical removal of tumors helps eliminate cancerous cells from the body.', 'Fighting Cancer', 'With early detection, treatment options, and lifestyle changes, cancer survival rates are improving.', 'Regular screenings improve early detection.', 'A healthy lifestyle lowers cancer risk.', 'Combined treatments offer comprehensive management.'),
(5, 'Heart Disease ', 'Understanding Heart Disease', 'Heart disease refers to various conditions that affect the heart’s structure and function. The most common type is coronary artery disease, which occurs when the blood vessels supplying oxygen and nutrients to the heart become narrowed or blocked by fatty deposits. This can result in chest pain, shortness of breath, or even heart attacks.', 'Heart disease can be influenced by genetic factors, lifestyle choices, and other health conditions like high blood pressure. Managing heart disease involves adopting heart-healthy habits, such as maintaining a balanced diet, engaging in regular exercise, and avoiding smoking. Early detection and lifestyle adjustments can significantly reduce the risk of severe complications.', 'Chest Pain', 'Reduced blood flow to the heart can cause chest discomfort or pain.', 'Shortness of Breath', 'Inadequate oxygen supply leads to breathlessness, especially during physical exertion.', 'Fatigue', 'The heart\'s reduced efficiency results in decreased energy levels and increased fatigue.', 'Balanced Diet', 'Eating a diet low in saturated fats and high in fiber can reduce the risk of heart disease.', 'Regular Physical Activity', 'Exercise strengthens the cardiovascular system, reducing heart disease risk.', 'Avoid Smoking', 'Smoking cessation helps prevent the narrowing of blood vessels and lowers heart disease risk.', 'Medications', 'Blood thinners, statins, and other medications help manage heart disease symptoms.', 'Surgical Interventions', 'Procedures like angioplasty and bypass surgery restore blood flow to the heart.', 'Lifestyle Adjustments', 'Dietary changes and exercise are essential for heart health.', 'Managing Heart Health', 'A proactive approach, including lifestyle changes and medical guidance, supports a healthy heart.', 'Early intervention improves treatment outcomes.', 'Lifestyle choices significantly impact heart disease risk.', 'Medications and procedures help manage symptoms.'),
(6, 'Diabetes', 'Understanding Diabetes', 'Diabetes is a chronic metabolic disorder characterized by elevated blood glucose levels due to insufficient or ineffective insulin. Insulin is the hormone responsible for allowing glucose from food to enter the body\'s cells, providing them with the energy needed to function. When insulin production is low or ineffective, glucose remains in the bloodstream, leading to high blood sugar levels.', 'Uncontrolled diabetes can lead to serious health complications, including damage to the heart, kidneys, nerves, and eyes. Managing diabetes involves monitoring blood sugar levels, adopting a healthy lifestyle, and, in some cases, taking medications to keep glucose levels in check. With proper care, individuals with diabetes can lead fulfilling, healthy lives.', 'Frequent Urination', 'High blood glucose levels lead to excess glucose being excreted in urine, causing frequent urination.', 'Increased Thirst', 'Frequent urination depletes fluids, causing increased thirst to replenish lost liquids.', 'Fatigue', 'High blood sugar prevents the body from efficiently converting glucose into energy, leading to fatigue.', 'Healthy Diet', 'A balanced diet rich in vegetables, whole grains, and lean proteins supports stable blood glucose levels.', 'Regular Exercise', 'Physical activity improves the body\'s ability to use insulin effectively, helping control blood sugar.', 'Weight Management', 'Maintaining a healthy weight reduces the strain on the body, improving insulin sensitivity.', 'Insulin Therapy', 'Necessary for some, insulin therapy helps manage blood sugar levels by supplementing natural insulin.', 'Oral Medications', 'Certain medications can help improve insulin sensitivity or stimulate insulin production.', 'Lifestyle Modifications', 'Diet and exercise adjustments play a significant role in managing blood glucose levels.', 'Managing Diabetes Effectively', 'Diabetes can be effectively managed with lifestyle adjustments, regular monitoring, and adherence to treatment.', 'Early detection is essential for effective treatment.', 'Lifestyle changes are powerful in managing diabetes.', 'Continuous monitoring helps prevent complications.');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `specialization` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `years_of_experience` int(11) DEFAULT NULL,
  `medical_license_number` varchar(50) DEFAULT NULL,
  `education` text DEFAULT NULL,
  `consultation_hours` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `social_media` varchar(255) DEFAULT NULL,
  `register_as` enum('Doctor') DEFAULT 'Doctor',
  `register_by` enum('Admin') NOT NULL DEFAULT 'Admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `name`, `email`, `password`, `phone`, `specialization`, `address`, `years_of_experience`, `medical_license_number`, `education`, `consultation_hours`, `bio`, `social_media`, `register_as`, `register_by`) VALUES
(3, 'Naeem', 'naeem@gmail.com', '$2y$10$PnhgZEAWgPWsNaDpBtuCJue9qdo99K5WpCxJwZe3U7KglSc0Zd4Jq', '03228733127', 'Cardiologist', 'R265 sector 12 Korangi Karac', 15, '', '', '', '', '', 'Doctor', 'Admin'),
(4, 'Sarah Smith', 'sarah.smith@hospital.com', 'd28fb238a2f4ef1422b0b0a76f64d4b6', '03322659301', 'Cardiologist', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Doctor', 'Admin'),
(5, 'James Johnson', 'james.johnson@hospital.com', '45955b13fe289369e38f7f184438ee5b', '03322659302', 'Neurologist', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Doctor', 'Admin'),
(6, 'Emma Brown', 'emma.brown@hospital.com', '2798d2bdab1ec9e52029a20f90e2e15f', '03322659303', 'Pediatrician', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Doctor', 'Admin'),
(7, 'Michael Miller', 'michael.miller@hospital.com', 'eeec7abc63a8ed89b25e40bc87950daa', '03322659304', 'Orthopedic Surgeon', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Doctor', 'Admin'),
(8, 'Olivia Wilson', 'olivia.wilson@hospital.com', '5ca2cab2d5182f5da1c4f501b6d0307f', '03322659305', 'Dermatologist', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Doctor', 'Admin'),
(9, 'William Taylor', 'william.taylor@hospital.com', 'e0a987802d69e4722ef1af5bd90c9158', '03322659306', 'Oncologist', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Doctor', 'Admin'),
(10, 'Ava Anderson', 'ava.anderson@hospital.com', 'ef6458867674fbefd90ca35faf5ea315', '03322659307', 'Gynecologist', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Doctor', 'Admin'),
(11, 'Liam Thomas', 'liam.thomas@hospital.com', 'fbfefc7bd3c31b1eb39b46c2db946b38', '03322659308', 'Endocrinologist', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Doctor', 'Admin'),
(12, 'Sophia Moore', 'sophia.moore@hospital.com', '3dd9bd9fd75f1c61c24019ee149faf8a', '03322659309', 'Psychiatrist', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Doctor', 'Admin'),
(13, 'Lucas Martinez', 'lucas.martinez@hospital.com', '27d59ac0699c8fe9fbc09820e83a83c4', '03322659310', 'Radiologist', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Doctor', 'Admin'),
(14, 'Hiba', 'hiba@gmail.com', '$2y$10$1/IWzYrewABssKF0MqUhIuKmvvEs1ld2CQrrlBuGrdx2f8ZDJmtKK', '03228733121', 'Cardiologist', 'R265 sector 12 Korangi Karac', 9, '', '', '', '', '', 'Doctor', 'Admin'),
(15, 'Anwar Tahir', 'anwar@gmail.com', '$2y$10$UR3iGmlZ5QzelP1aiYyssOlDrmsrSjMZ0WRGOG8wIQHV814ooxTA6', '03228733125', 'Psychiatrist', 'R80 Gulistan e Johar Karachi', NULL, NULL, NULL, NULL, NULL, NULL, 'Doctor', 'Admin'),
(16, 'Amar Khan', 'amar@gmail.com', '$2y$10$5tikDmpa./EETtIfOtDf8.6hTS.cTpirCTEvg6BX0EV.o5HKejrIK', '03228733111', 'General Physician', 'R80 Gulistan e Johar Karachi', NULL, NULL, NULL, NULL, NULL, NULL, 'Doctor', 'Admin'),
(17, 'Doctor', 'doctor@gmail.com', '$2y$10$hsNkaeOaX8MJ8arRIokbBeDH/60U8BmH.KVumpfzfJtnV3Z4fo/y6', '03218744121', 'ENT Specialist', 'R265 sector 12 Korangi Karachi', NULL, NULL, NULL, NULL, NULL, NULL, 'Doctor', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_daily_main_availability`
--

CREATE TABLE `doctor_daily_main_availability` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `available_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `status` enum('available','booked') DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor_daily_main_availability`
--

INSERT INTO `doctor_daily_main_availability` (`id`, `doctor_id`, `available_date`, `start_time`, `end_time`, `status`) VALUES
(1, 14, '2024-10-31', '09:00:00', '11:10:00', 'booked'),
(2, 3, '2024-10-31', '07:00:00', '09:00:00', 'available'),
(3, 3, '2024-11-01', '07:00:00', '21:00:00', 'available'),
(4, 3, '2024-11-10', '19:00:00', '21:00:00', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_daily_sub_availability`
--

CREATE TABLE `doctor_daily_sub_availability` (
  `id` int(11) NOT NULL,
  `main_slot_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `available_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `status` enum('available','booked') DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor_daily_sub_availability`
--

INSERT INTO `doctor_daily_sub_availability` (`id`, `main_slot_id`, `doctor_id`, `available_date`, `start_time`, `end_time`, `status`) VALUES
(1, 1, 14, '2024-10-31', '09:00:00', '09:30:00', 'booked'),
(2, 1, 14, '2024-10-31', '09:30:00', '10:00:00', 'booked'),
(3, 1, 14, '2024-10-31', '10:00:00', '10:30:00', 'booked'),
(4, 1, 14, '2024-10-31', '10:30:00', '11:00:00', 'booked'),
(5, 2, 3, '2024-10-31', '07:00:00', '07:30:00', 'booked'),
(6, 2, 3, '2024-10-31', '07:30:00', '08:00:00', 'booked'),
(7, 2, 3, '2024-10-31', '08:00:00', '08:30:00', 'booked'),
(8, 2, 3, '2024-10-31', '08:30:00', '09:00:00', 'booked'),
(9, 3, 3, '2024-11-01', '07:00:00', '07:30:00', 'booked'),
(10, 3, 3, '2024-11-01', '07:30:00', '08:00:00', 'booked'),
(11, 3, 3, '2024-11-01', '08:00:00', '08:30:00', 'booked'),
(12, 3, 3, '2024-11-01', '08:30:00', '09:00:00', 'booked'),
(13, 3, 3, '2024-11-01', '09:00:00', '09:30:00', 'booked'),
(14, 3, 3, '2024-11-01', '09:30:00', '10:00:00', 'booked'),
(15, 3, 3, '2024-11-01', '10:00:00', '10:30:00', 'available'),
(16, 3, 3, '2024-11-01', '10:30:00', '11:00:00', 'available'),
(17, 3, 3, '2024-11-01', '11:00:00', '11:30:00', 'available'),
(18, 3, 3, '2024-11-01', '11:30:00', '12:00:00', 'available'),
(19, 3, 3, '2024-11-01', '12:00:00', '12:30:00', 'available'),
(20, 3, 3, '2024-11-01', '12:30:00', '13:00:00', 'available'),
(21, 3, 3, '2024-11-01', '13:00:00', '13:30:00', 'available'),
(22, 3, 3, '2024-11-01', '13:30:00', '14:00:00', 'available'),
(23, 3, 3, '2024-11-01', '14:00:00', '14:30:00', 'available'),
(24, 3, 3, '2024-11-01', '14:30:00', '15:00:00', 'available'),
(25, 3, 3, '2024-11-01', '15:00:00', '15:30:00', 'available'),
(26, 3, 3, '2024-11-01', '15:30:00', '16:00:00', 'available'),
(27, 3, 3, '2024-11-01', '16:00:00', '16:30:00', 'available'),
(28, 3, 3, '2024-11-01', '16:30:00', '17:00:00', 'available'),
(29, 3, 3, '2024-11-01', '17:00:00', '17:30:00', 'available'),
(30, 3, 3, '2024-11-01', '17:30:00', '18:00:00', 'available'),
(31, 3, 3, '2024-11-01', '18:00:00', '18:30:00', 'available'),
(32, 3, 3, '2024-11-01', '18:30:00', '19:00:00', 'available'),
(33, 3, 3, '2024-11-01', '19:00:00', '19:30:00', 'available'),
(34, 3, 3, '2024-11-01', '19:30:00', '20:00:00', 'available'),
(35, 3, 3, '2024-11-01', '20:00:00', '20:30:00', 'available'),
(36, 3, 3, '2024-11-01', '20:30:00', '21:00:00', 'available'),
(37, 4, 3, '2024-11-10', '19:00:00', '19:30:00', 'available'),
(38, 4, 3, '2024-11-10', '19:30:00', '20:00:00', 'available'),
(39, 4, 3, '2024-11-10', '20:00:00', '20:30:00', 'available'),
(40, 4, 3, '2024-11-10', '20:30:00', '21:00:00', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_monthly_main_availability`
--

CREATE TABLE `doctor_monthly_main_availability` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `week_of_month` enum('first','second','third','fourth','last') NOT NULL,
  `day_of_week` enum('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday') NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `status` enum('available','booked') DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor_monthly_main_availability`
--

INSERT INTO `doctor_monthly_main_availability` (`id`, `doctor_id`, `week_of_month`, `day_of_week`, `start_time`, `end_time`, `status`) VALUES
(1, 3, 'last', 'Thursday', '19:00:00', '21:00:00', 'available'),
(2, 3, 'second', 'Saturday', '21:00:00', '23:00:00', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_monthly_sub_availability`
--

CREATE TABLE `doctor_monthly_sub_availability` (
  `id` int(11) NOT NULL,
  `main_slot_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `week_of_month` enum('first','second','third','fourth','last') NOT NULL,
  `day_of_week` enum('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday') NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `status` enum('available','booked') DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor_monthly_sub_availability`
--

INSERT INTO `doctor_monthly_sub_availability` (`id`, `main_slot_id`, `doctor_id`, `week_of_month`, `day_of_week`, `start_time`, `end_time`, `status`) VALUES
(1, 1, 3, 'last', 'Thursday', '19:00:00', '19:30:00', 'available'),
(2, 1, 3, 'last', 'Thursday', '19:30:00', '20:00:00', 'available'),
(3, 1, 3, 'last', 'Thursday', '20:00:00', '20:30:00', 'available'),
(4, 1, 3, 'last', 'Thursday', '20:30:00', '21:00:00', 'available'),
(5, 2, 3, 'second', 'Saturday', '21:00:00', '21:30:00', 'available'),
(6, 2, 3, 'second', 'Saturday', '21:30:00', '22:00:00', 'available'),
(7, 2, 3, 'second', 'Saturday', '22:00:00', '22:30:00', 'available'),
(8, 2, 3, 'second', 'Saturday', '22:30:00', '23:00:00', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_weekly_main_availability`
--

CREATE TABLE `doctor_weekly_main_availability` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `day_of_week` enum('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday') NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `status` enum('available','booked') DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor_weekly_main_availability`
--

INSERT INTO `doctor_weekly_main_availability` (`id`, `doctor_id`, `day_of_week`, `start_time`, `end_time`, `status`) VALUES
(1, 3, 'Monday', '19:00:00', '21:00:00', 'available'),
(2, 3, 'Wednesday', '17:00:00', '19:00:00', 'available'),
(3, 3, 'Thursday', '14:00:00', '16:00:00', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_weekly_sub_availability`
--

CREATE TABLE `doctor_weekly_sub_availability` (
  `id` int(11) NOT NULL,
  `main_slot_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `available_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `status` enum('available','booked') DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor_weekly_sub_availability`
--

INSERT INTO `doctor_weekly_sub_availability` (`id`, `main_slot_id`, `doctor_id`, `available_date`, `start_time`, `end_time`, `status`) VALUES
(5, 2, 3, '2024-10-30', '17:00:00', '17:30:00', 'available'),
(6, 2, 3, '2024-10-30', '17:30:00', '18:00:00', 'available'),
(7, 2, 3, '2024-10-30', '18:00:00', '18:30:00', 'available'),
(8, 2, 3, '2024-10-30', '18:30:00', '19:00:00', 'available'),
(9, 3, 3, '2024-10-31', '14:00:00', '14:30:00', 'available'),
(10, 3, 3, '2024-10-31', '14:30:00', '15:00:00', 'available'),
(11, 3, 3, '2024-10-31', '15:00:00', '15:30:00', 'available'),
(12, 3, 3, '2024-10-31', '15:30:00', '16:00:00', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `medical_history` text DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `registered_by` enum('admin','doctor','user') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `phone`, `address`, `medical_history`, `password`, `registered_by`, `created_at`) VALUES
(15, 'Samara Khan', 'samara@gmail.com', '03228733125', 'R265 sector 12 Korangi Karac', '', '$2y$10$xmMHbq8FvU4BN2JXfNWL.uLKcVPw5edZWH3aORoYgYSopjBJTu8Bu', 'user', '2024-10-27 07:23:07'),
(17, 'Salman Anas', 'salman@gmail.com', '03228733125', 'R80 Gulistan e Johar Karachi', '', '$2y$10$2ZFkEMzvGqxHviCZHM7z9OG69cYOULf/N9eomsNwgsg8ORRub6uRS', 'user', '2024-10-30 14:29:51'),
(18, 'Amar', 'amar@gmail.com', '03228733125', 'R80 Gulistan e Johar Karachi', 'Diabetes', '$2y$10$sYFmo2PF5Q9aHT.FTnUuB.xYTrrvjc2pjtP/l16bEHVHB4U9VfQjK', 'user', '2024-10-30 16:03:25'),
(20, 'Sara Khan', 'sara@gmail.com', '03228733125', 'R80 Gulistan e Johar Karachi', 'Heart problem', '$2y$10$LR.lLk1LWVsxnFs8V4DtrOWBqdk9oknbYPiI6zNrtMwy.8QepvEme', 'admin', '2024-10-30 16:24:42'),
(22, 'Patient', 'patient@gmail.com', '03218922121', 'R265 sector 12 Korangi Karac', '', '$2y$10$dNwKIw6d9wYq1.FWKMEeSu2WJ1sjUcZ.rIgKSAd9Edsi4.HhxetLG', 'admin', '2025-01-05 17:45:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_id` (`doctor_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `cleanup_log`
--
ALTER TABLE `cleanup_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `disease`
--
ALTER TABLE `disease`
  ADD PRIMARY KEY (`disease_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `doctor_daily_main_availability`
--
ALTER TABLE `doctor_daily_main_availability`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `doctor_daily_sub_availability`
--
ALTER TABLE `doctor_daily_sub_availability`
  ADD PRIMARY KEY (`id`),
  ADD KEY `main_slot_id` (`main_slot_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `doctor_monthly_main_availability`
--
ALTER TABLE `doctor_monthly_main_availability`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `doctor_monthly_sub_availability`
--
ALTER TABLE `doctor_monthly_sub_availability`
  ADD PRIMARY KEY (`id`),
  ADD KEY `main_slot_id` (`main_slot_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `doctor_weekly_main_availability`
--
ALTER TABLE `doctor_weekly_main_availability`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `doctor_weekly_sub_availability`
--
ALTER TABLE `doctor_weekly_sub_availability`
  ADD PRIMARY KEY (`id`),
  ADD KEY `main_slot_id` (`main_slot_id`),
  ADD KEY `doctor_id` (`doctor_id`);

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
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `cleanup_log`
--
ALTER TABLE `cleanup_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `disease`
--
ALTER TABLE `disease`
  MODIFY `disease_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `doctor_daily_main_availability`
--
ALTER TABLE `doctor_daily_main_availability`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `doctor_daily_sub_availability`
--
ALTER TABLE `doctor_daily_sub_availability`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `doctor_monthly_main_availability`
--
ALTER TABLE `doctor_monthly_main_availability`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `doctor_monthly_sub_availability`
--
ALTER TABLE `doctor_monthly_sub_availability`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `doctor_weekly_main_availability`
--
ALTER TABLE `doctor_weekly_main_availability`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `doctor_weekly_sub_availability`
--
ALTER TABLE `doctor_weekly_sub_availability`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`patient_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `doctor_daily_main_availability`
--
ALTER TABLE `doctor_daily_main_availability`
  ADD CONSTRAINT `doctor_daily_main_availability_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `doctor_daily_sub_availability`
--
ALTER TABLE `doctor_daily_sub_availability`
  ADD CONSTRAINT `doctor_daily_sub_availability_ibfk_1` FOREIGN KEY (`main_slot_id`) REFERENCES `doctor_daily_main_availability` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `doctor_daily_sub_availability_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `doctor_monthly_main_availability`
--
ALTER TABLE `doctor_monthly_main_availability`
  ADD CONSTRAINT `doctor_monthly_main_availability_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `doctor_monthly_sub_availability`
--
ALTER TABLE `doctor_monthly_sub_availability`
  ADD CONSTRAINT `doctor_monthly_sub_availability_ibfk_1` FOREIGN KEY (`main_slot_id`) REFERENCES `doctor_monthly_main_availability` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `doctor_monthly_sub_availability_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `doctor_weekly_main_availability`
--
ALTER TABLE `doctor_weekly_main_availability`
  ADD CONSTRAINT `doctor_weekly_main_availability_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `doctor_weekly_sub_availability`
--
ALTER TABLE `doctor_weekly_sub_availability`
  ADD CONSTRAINT `doctor_weekly_sub_availability_ibfk_1` FOREIGN KEY (`main_slot_id`) REFERENCES `doctor_weekly_main_availability` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `doctor_weekly_sub_availability_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
