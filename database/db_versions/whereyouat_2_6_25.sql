-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2025 at 11:00 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `whereyouat`
--

-- --------------------------------------------------------

--
-- Table structure for table `businesses`
--

CREATE TABLE `businesses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `trade_name` text DEFAULT NULL,
  `responsible_name` text DEFAULT NULL,
  `responsible_address` text DEFAULT NULL,
  `responsible_phone` text DEFAULT NULL,
  `responsible_email` text DEFAULT NULL,
  `business_address` text DEFAULT NULL,
  `business_number` text DEFAULT NULL,
  `availability` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`availability`)),
  `co_manager_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`co_manager_details`)),
  `ownership_proof` text DEFAULT NULL,
  `terms_approved` text DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_name` text DEFAULT NULL,
  `company_address` text DEFAULT NULL,
  `company_tax_number` text DEFAULT NULL,
  `position` text DEFAULT NULL,
  `proof_of_link` text DEFAULT NULL,
  `company_phone` text DEFAULT NULL,
  `company_email` text DEFAULT NULL,
  `supervisor_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`supervisor_details`)),
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `distance_deliveries`
--

CREATE TABLE `distance_deliveries` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `departure_city` text NOT NULL,
  `arrival_city` text NOT NULL,
  `transaction_date` date NOT NULL,
  `delivery_mode` text NOT NULL,
  `total_price` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `payment_method` text DEFAULT NULL,
  `payment_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`payment_details`)),
  `payment_status` varchar(50) DEFAULT NULL,
  `accepted` int(11) NOT NULL DEFAULT 0,
  `driver_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `distance_deliveries`
--

INSERT INTO `distance_deliveries` (`id`, `user_id`, `departure_city`, `arrival_city`, `transaction_date`, `delivery_mode`, `total_price`, `status`, `payment_method`, `payment_details`, `payment_status`, `accepted`, `driver_id`, `created_at`, `updated_at`) VALUES
(3, 4, 'Karachi', 'Islamabad', '2025-02-04', 'direct', '248.60', 2, 'STRIPE', '{\"id\":\"ch_3QnNcdBJNvSBJ4pq12QU3ilW\",\"object\":\"charge\",\"amount\":24860,\"amount_captured\":24860,\"amount_refunded\":0,\"application\":null,\"application_fee\":null,\"application_fee_amount\":null,\"balance_transaction\":\"txn_3QnNcdBJNvSBJ4pq1CUz5h5z\",\"billing_details\":{\"address\":{\"city\":null,\"country\":null,\"line1\":null,\"line2\":null,\"postal_code\":\"10001\",\"state\":null},\"email\":null,\"name\":null,\"phone\":null},\"calculated_statement_descriptor\":\"Stripe\",\"captured\":true,\"created\":1738342995,\"currency\":\"usd\",\"customer\":null,\"description\":\"Distance Delivery Fee\",\"destination\":null,\"dispute\":null,\"disputed\":false,\"failure_balance_transaction\":null,\"failure_code\":null,\"failure_message\":null,\"fraud_details\":[],\"invoice\":null,\"livemode\":false,\"metadata\":{\"delivery_id\":\"3\",\"user_id\":\"4\"},\"on_behalf_of\":null,\"order\":null,\"outcome\":{\"advice_code\":null,\"network_advice_code\":null,\"network_decline_code\":null,\"network_status\":\"approved_by_network\",\"reason\":null,\"risk_level\":\"normal\",\"risk_score\":8,\"seller_message\":\"Payment complete.\",\"type\":\"authorized\"},\"paid\":true,\"payment_intent\":null,\"payment_method\":\"card_1QnNcbBJNvSBJ4pqcgajVcwM\",\"payment_method_details\":{\"card\":{\"amount_authorized\":24860,\"authorization_code\":null,\"brand\":\"visa\",\"checks\":{\"address_line1_check\":null,\"address_postal_code_check\":\"pass\",\"cvc_check\":\"pass\"},\"country\":\"US\",\"exp_month\":11,\"exp_year\":2025,\"extended_authorization\":{\"status\":\"disabled\"},\"fingerprint\":\"vyyRo4mydWmFhJ6x\",\"funding\":\"credit\",\"incremental_authorization\":{\"status\":\"unavailable\"},\"installments\":null,\"last4\":\"1111\",\"mandate\":null,\"multicapture\":{\"status\":\"unavailable\"},\"network\":\"visa\",\"network_token\":{\"used\":false},\"network_transaction_id\":\"118121121821115\",\"overcapture\":{\"maximum_amount_capturable\":24860,\"status\":\"unavailable\"},\"regulated_status\":\"unregulated\",\"three_d_secure\":null,\"wallet\":null},\"type\":\"card\"},\"receipt_email\":null,\"receipt_number\":null,\"receipt_url\":\"https:\\/\\/pay.stripe.com\\/receipts\\/payment\\/CAcaFwoVYWNjdF8xTGVISFpCSk52U0JKNHBxKNOE9LwGMgbUlyeNkY86LBapMUOxCBPJz5_1Lz39AZUHhtV-Sd2EwVkuZWtPtoKTZtufDKZHf-lpxRfv\",\"refunded\":false,\"review\":null,\"shipping\":null,\"source\":{\"id\":\"card_1QnNcbBJNvSBJ4pqcgajVcwM\",\"object\":\"card\",\"address_city\":null,\"address_country\":null,\"address_line1\":null,\"address_line1_check\":null,\"address_line2\":null,\"address_state\":null,\"address_zip\":\"10001\",\"address_zip_check\":\"pass\",\"allow_redisplay\":\"unspecified\",\"brand\":\"Visa\",\"country\":\"US\",\"customer\":null,\"cvc_check\":\"pass\",\"dynamic_last4\":null,\"exp_month\":11,\"exp_year\":2025,\"fingerprint\":\"vyyRo4mydWmFhJ6x\",\"funding\":\"credit\",\"last4\":\"1111\",\"metadata\":[],\"name\":null,\"regulated_status\":\"unregulated\",\"tokenization_method\":null,\"wallet\":null},\"source_transfer\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":null,\"status\":\"succeeded\",\"transfer_data\":null,\"transfer_group\":null}', 'SUCCESS', 1, 3, '2025-01-31 17:03:03', '2025-01-31 18:56:24');

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `license_photo_front` text DEFAULT NULL,
  `license_photo_back` text DEFAULT NULL,
  `vehicle_make` text DEFAULT NULL,
  `vehicle_model` text DEFAULT NULL,
  `vehicle_year` text DEFAULT NULL,
  `vehicle_plate` text DEFAULT NULL,
  `vehicle_color` text DEFAULT NULL,
  `vehicle_seats` text DEFAULT NULL,
  `vehicle_photo` text DEFAULT NULL,
  `services` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`services`)),
  `packages` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`packages`)),
  `local_delivery_city` text DEFAULT NULL,
  `profile_photo` text DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`id`, `user_id`, `license_photo_front`, `license_photo_back`, `vehicle_make`, `vehicle_model`, `vehicle_year`, `vehicle_plate`, `vehicle_color`, `vehicle_seats`, `vehicle_photo`, `services`, `packages`, `local_delivery_city`, `profile_photo`, `created_at`, `updated_at`) VALUES
(1, 3, 'drivers/1738187131_front.png', 'drivers/1738187131_back.png', '2023', 'LC2300 ZX', '2023', 'CSK-1947', 'Dark Grey', '20', 'vehicles/1738187131_vehicle.webp', '\"[\\\"distance-delivery\\\",\\\"vicinity-delivery\\\"]\"', '\"[\\\"mail-envelope\\\",\\\"parcel-envelope\\\",\\\"mini-carton\\\",\\\"extra-formats\\\"]\"', NULL, 'profile_3.png', '2025-01-29 21:45:31', '2025-02-03 21:25:42'),
(17, 25, 'https://wya.onlinedemolinks.com/wp-content/uploads/forminator/766_b6fe6e46bdb2ae4071ba03fa2c9d5c2a/uploads/nnT7znNGOQMF-freepik__adjust__62564.png', 'https://wya.onlinedemolinks.com/wp-content/uploads/forminator/766_b6fe6e46bdb2ae4071ba03fa2c9d5c2a/uploads/nnT7znNGOQMF-freepik__adjust__62564.png', '2023', 'LC 300 ZX', '2023', 'LC-4560', 'Gray', '7', 'https://wya.onlinedemolinks.com/wp-content/uploads/forminator/766_b6fe6e46bdb2ae4071ba03fa2c9d5c2a/uploads/11ALgkGsGVad-wp10875108.webp', '\"[\\\"passenger-transport\\\",\\\" distance-delivery\\\",\\\" vicinity-delivery\\\"]\"', '\"[\\\"mail-envelope\\\",\\\" parcel-envelope\\\",\\\" mini-carton\\\",\\\" extra-formats\\\"]\"', 'London', NULL, '2025-02-08 18:15:00', '2025-02-08 18:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `local_deliveries`
--

CREATE TABLE `local_deliveries` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `id_photo` text DEFAULT NULL,
  `proof_of_domicile` text DEFAULT NULL,
  `means_of_transport` text DEFAULT NULL,
  `transport_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`transport_details`)),
  `availability_days` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`availability_days`)),
  `availability_hours` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`availability_hours`)),
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
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
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `type` text DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `title`, `type`, `message`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 'Delivery Accepted', 'Distance Delivery', 'Your delivery has been accepted', 0, '2025-01-31 18:27:16', '2025-01-31 18:45:34'),
(2, 4, 'Delivery Accepted', 'Distance Delivery', 'Your delivery has been accepted', 0, '2025-01-31 18:48:53', '2025-01-31 19:35:21'),
(3, 4, 'Delivery Accepted', 'Distance Delivery', 'Your delivery has been accepted', 0, '2025-01-31 18:56:24', '2025-01-31 19:35:18'),
(4, 4, 'Delivery Accepted', 'Vicinity Delivery', 'Your delivery has been accepted', 0, '2025-02-03 16:44:45', '2025-02-03 16:45:12'),
(5, 4, 'Delivery Accepted', 'Vicinity Delivery', 'Your delivery has been accepted', 0, '2025-02-03 21:33:07', '2025-02-03 21:33:27');

-- --------------------------------------------------------

--
-- Table structure for table `package_details`
--

CREATE TABLE `package_details` (
  `id` int(11) NOT NULL,
  `delivery_id` int(11) NOT NULL,
  `package_type` text NOT NULL,
  `qty` int(11) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `package_details`
--

INSERT INTO `package_details` (`id`, `delivery_id`, `package_type`, `qty`, `description`) VALUES
(3, 3, 'parcel-envelope', 2, 'Secret Envelope');

-- --------------------------------------------------------

--
-- Table structure for table `partner_homes`
--

CREATE TABLE `partner_homes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `home_name` text DEFAULT NULL,
  `home_address` text DEFAULT NULL,
  `managers` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`managers`)),
  `ownership_proof` text NOT NULL,
  `terms_approved` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` text DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `role` enum('driver','local_delivery','business','partner_home','user','admin') NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `terms_approved` tinyint(1) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `date_of_birth`, `role`, `email_verified_at`, `password`, `terms_approved`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'Urielle Gaines', 'fobuzimifi@mailinator.com', '+1 (339) 965-6367', NULL, 'driver', NULL, '$2y$12$mZpi3UFYuewbxQbNSv3hM.mgg4Hl4vMLc9iAeI2e8sKLSFw5J6dV6', 1, NULL, '2025-01-29 16:45:31', '2025-01-29 16:45:31'),
(4, 'User', 'user@yopmail.com', '+1 (811) 343-9574', '2005-04-21', 'user', NULL, '$2y$12$X0CAaPRLGyj.PYSgLwK5s.mkTLhCoRJBNhf1UNNs6aNOYTnnensRi', 1, NULL, '2025-01-30 11:15:51', '2025-02-05 15:43:35'),
(5, 'Admin', 'admin_web@yopmail.com', '+1 (886) 965-6369', NULL, 'admin', NULL, '$2y$10$/2BRSE9Z3sJrf4IeC/oJkulVuQyR57No1COYjfN8/yl/j6o.XLzP6', 1, NULL, '2025-01-29 16:45:31', '2025-02-05 10:52:13'),
(25, 'AKevyn Gilliam Sanders', 'benyqeto@mailinator.com', '+1 (634) 738-8629', '2004-03-22', 'driver', NULL, '$2y$12$XVjZhA4Of8lMzfMVIhR8qecrgK6UfRaDh5/De7qs6DQFCvZWlt73K', 1, NULL, '2025-02-08 13:15:00', '2025-02-08 13:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE `user_profiles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` longtext DEFAULT NULL,
  `profile_photo` text DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_profiles`
--

INSERT INTO `user_profiles` (`id`, `user_id`, `address`, `profile_photo`, `created_at`, `updated_at`) VALUES
(1, 4, 'Karachi, SD, Pakistan', 'profile_4.png', '2025-01-30 16:15:51', '2025-02-05 22:00:00'),
(2, 5, 'USA', 'profile_4.png', '2025-01-30 16:15:51', '2025-02-05 15:52:32');

-- --------------------------------------------------------

--
-- Table structure for table `vicinity_deliveries`
--

CREATE TABLE `vicinity_deliveries` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `departure_address` text NOT NULL,
  `arrival_address` text NOT NULL,
  `transaction_date` date NOT NULL,
  `total_price` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `payment_status` varchar(100) DEFAULT NULL,
  `payment_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`payment_details`)),
  `payment_method` text DEFAULT NULL,
  `accepted` int(11) NOT NULL DEFAULT 0,
  `driver_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vicinity_deliveries`
--

INSERT INTO `vicinity_deliveries` (`id`, `user_id`, `departure_address`, `arrival_address`, `transaction_date`, `total_price`, `status`, `payment_status`, `payment_details`, `payment_method`, `accepted`, `driver_id`, `created_at`, `updated_at`) VALUES
(9, 4, 'North Nazimabad', 'Clifton', '2025-02-22', '7.91', 1, 'SUCCESS', '{\"id\":\"ch_3QoXLcBJNvSBJ4pq1yx8Xd0n\",\"object\":\"charge\",\"amount\":791,\"amount_captured\":791,\"amount_refunded\":0,\"application\":null,\"application_fee\":null,\"application_fee_amount\":null,\"balance_transaction\":\"txn_3QoXLcBJNvSBJ4pq1EbMIVPZ\",\"billing_details\":{\"address\":{\"city\":null,\"country\":null,\"line1\":null,\"line2\":null,\"postal_code\":\"10001\",\"state\":null},\"email\":null,\"name\":null,\"phone\":null},\"calculated_statement_descriptor\":\"Stripe\",\"captured\":true,\"created\":1738618708,\"currency\":\"usd\",\"customer\":null,\"description\":\"Vicinity Delivery Fee\",\"destination\":null,\"dispute\":null,\"disputed\":false,\"failure_balance_transaction\":null,\"failure_code\":null,\"failure_message\":null,\"fraud_details\":[],\"invoice\":null,\"livemode\":false,\"metadata\":{\"delivery_id\":\"9\",\"user_id\":\"4\"},\"on_behalf_of\":null,\"order\":null,\"outcome\":{\"advice_code\":null,\"network_advice_code\":null,\"network_decline_code\":null,\"network_status\":\"approved_by_network\",\"reason\":null,\"risk_level\":\"normal\",\"risk_score\":14,\"seller_message\":\"Payment complete.\",\"type\":\"authorized\"},\"paid\":true,\"payment_intent\":null,\"payment_method\":\"card_1QoXLaBJNvSBJ4pq6wthvDGS\",\"payment_method_details\":{\"card\":{\"amount_authorized\":791,\"authorization_code\":null,\"brand\":\"visa\",\"checks\":{\"address_line1_check\":null,\"address_postal_code_check\":\"pass\",\"cvc_check\":\"pass\"},\"country\":\"US\",\"exp_month\":11,\"exp_year\":2026,\"extended_authorization\":{\"status\":\"disabled\"},\"fingerprint\":\"vyyRo4mydWmFhJ6x\",\"funding\":\"credit\",\"incremental_authorization\":{\"status\":\"unavailable\"},\"installments\":null,\"last4\":\"1111\",\"mandate\":null,\"multicapture\":{\"status\":\"unavailable\"},\"network\":\"visa\",\"network_token\":{\"used\":false},\"network_transaction_id\":\"118121121821115\",\"overcapture\":{\"maximum_amount_capturable\":791,\"status\":\"unavailable\"},\"regulated_status\":\"unregulated\",\"three_d_secure\":null,\"wallet\":null},\"type\":\"card\"},\"receipt_email\":null,\"receipt_number\":null,\"receipt_url\":\"https:\\/\\/pay.stripe.com\\/receipts\\/payment\\/CAcaFwoVYWNjdF8xTGVISFpCSk52U0JKNHBxKNTuhL0GMgbnjhLoVLg6LBblxay0zOsb3_vvDgSDuUJi5aSQjyKEA4hSaqT4n3scvkbm10b6WIVshVLC\",\"refunded\":false,\"review\":null,\"shipping\":null,\"source\":{\"id\":\"card_1QoXLaBJNvSBJ4pq6wthvDGS\",\"object\":\"card\",\"address_city\":null,\"address_country\":null,\"address_line1\":null,\"address_line1_check\":null,\"address_line2\":null,\"address_state\":null,\"address_zip\":\"10001\",\"address_zip_check\":\"pass\",\"allow_redisplay\":\"unspecified\",\"brand\":\"Visa\",\"country\":\"US\",\"customer\":null,\"cvc_check\":\"pass\",\"dynamic_last4\":null,\"exp_month\":11,\"exp_year\":2026,\"fingerprint\":\"vyyRo4mydWmFhJ6x\",\"funding\":\"credit\",\"last4\":\"1111\",\"metadata\":[],\"name\":null,\"regulated_status\":\"unregulated\",\"tokenization_method\":null,\"wallet\":null},\"source_transfer\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":null,\"status\":\"succeeded\",\"transfer_data\":null,\"transfer_group\":null}', 'STRIPE', 1, 3, '2025-02-03 21:38:13', '2025-02-03 21:39:18'),
(10, 4, 'Gulshan', 'North Karachi', '2025-02-07', '7.91', 1, 'SUCCESS', '{\"id\":\"ch_3QoXOJBJNvSBJ4pq1U9sZ7yn\",\"object\":\"charge\",\"amount\":791,\"amount_captured\":791,\"amount_refunded\":0,\"application\":null,\"application_fee\":null,\"application_fee_amount\":null,\"balance_transaction\":\"txn_3QoXOJBJNvSBJ4pq1QkFzXk2\",\"billing_details\":{\"address\":{\"city\":null,\"country\":null,\"line1\":null,\"line2\":null,\"postal_code\":\"10001\",\"state\":null},\"email\":null,\"name\":null,\"phone\":null},\"calculated_statement_descriptor\":\"Stripe\",\"captured\":true,\"created\":1738618875,\"currency\":\"usd\",\"customer\":null,\"description\":\"Vicinity Delivery Fee\",\"destination\":null,\"dispute\":null,\"disputed\":false,\"failure_balance_transaction\":null,\"failure_code\":null,\"failure_message\":null,\"fraud_details\":[],\"invoice\":null,\"livemode\":false,\"metadata\":{\"delivery_id\":\"10\",\"user_id\":\"4\"},\"on_behalf_of\":null,\"order\":null,\"outcome\":{\"advice_code\":null,\"network_advice_code\":null,\"network_decline_code\":null,\"network_status\":\"approved_by_network\",\"reason\":null,\"risk_level\":\"normal\",\"risk_score\":36,\"seller_message\":\"Payment complete.\",\"type\":\"authorized\"},\"paid\":true,\"payment_intent\":null,\"payment_method\":\"card_1QoXOIBJNvSBJ4pqghQdRKXc\",\"payment_method_details\":{\"card\":{\"amount_authorized\":791,\"authorization_code\":null,\"brand\":\"visa\",\"checks\":{\"address_line1_check\":null,\"address_postal_code_check\":\"pass\",\"cvc_check\":\"pass\"},\"country\":\"US\",\"exp_month\":11,\"exp_year\":2026,\"extended_authorization\":{\"status\":\"disabled\"},\"fingerprint\":\"vyyRo4mydWmFhJ6x\",\"funding\":\"credit\",\"incremental_authorization\":{\"status\":\"unavailable\"},\"installments\":null,\"last4\":\"1111\",\"mandate\":null,\"multicapture\":{\"status\":\"unavailable\"},\"network\":\"visa\",\"network_token\":{\"used\":false},\"network_transaction_id\":\"118121121821115\",\"overcapture\":{\"maximum_amount_capturable\":791,\"status\":\"unavailable\"},\"regulated_status\":\"unregulated\",\"three_d_secure\":null,\"wallet\":null},\"type\":\"card\"},\"receipt_email\":null,\"receipt_number\":null,\"receipt_url\":\"https:\\/\\/pay.stripe.com\\/receipts\\/payment\\/CAcaFwoVYWNjdF8xTGVISFpCSk52U0JKNHBxKPzvhL0GMgaM2ZDGou46LBZL7Pcz-K8cn8Qk5gHtW-8e48EXyknJ3-fSbLoP2f5xUu2X2wYTktmERq37\",\"refunded\":false,\"review\":null,\"shipping\":null,\"source\":{\"id\":\"card_1QoXOIBJNvSBJ4pqghQdRKXc\",\"object\":\"card\",\"address_city\":null,\"address_country\":null,\"address_line1\":null,\"address_line1_check\":null,\"address_line2\":null,\"address_state\":null,\"address_zip\":\"10001\",\"address_zip_check\":\"pass\",\"allow_redisplay\":\"unspecified\",\"brand\":\"Visa\",\"country\":\"US\",\"customer\":null,\"cvc_check\":\"pass\",\"dynamic_last4\":null,\"exp_month\":11,\"exp_year\":2026,\"fingerprint\":\"vyyRo4mydWmFhJ6x\",\"funding\":\"credit\",\"last4\":\"1111\",\"metadata\":[],\"name\":null,\"regulated_status\":\"unregulated\",\"tokenization_method\":null,\"wallet\":null},\"source_transfer\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":null,\"status\":\"succeeded\",\"transfer_data\":null,\"transfer_group\":null}', 'STRIPE', 0, NULL, '2025-02-03 21:41:01', '2025-02-03 21:41:14');

-- --------------------------------------------------------

--
-- Table structure for table `vicinity_package_details`
--

CREATE TABLE `vicinity_package_details` (
  `id` int(11) NOT NULL,
  `delivery_id` int(11) NOT NULL,
  `package_type` text NOT NULL,
  `qty` int(11) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vicinity_package_details`
--

INSERT INTO `vicinity_package_details` (`id`, `delivery_id`, `package_type`, `qty`, `description`) VALUES
(1, 9, 'mini-carton', 1, 'yess'),
(2, 10, 'parcel-envelope', 1, 'yess');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `businesses`
--
ALTER TABLE `businesses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `distance_deliveries`
--
ALTER TABLE `distance_deliveries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `local_deliveries`
--
ALTER TABLE `local_deliveries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_details`
--
ALTER TABLE `package_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partner_homes`
--
ALTER TABLE `partner_homes`
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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vicinity_deliveries`
--
ALTER TABLE `vicinity_deliveries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vicinity_package_details`
--
ALTER TABLE `vicinity_package_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `businesses`
--
ALTER TABLE `businesses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `distance_deliveries`
--
ALTER TABLE `distance_deliveries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `local_deliveries`
--
ALTER TABLE `local_deliveries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `package_details`
--
ALTER TABLE `package_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `partner_homes`
--
ALTER TABLE `partner_homes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vicinity_deliveries`
--
ALTER TABLE `vicinity_deliveries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `vicinity_package_details`
--
ALTER TABLE `vicinity_package_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
