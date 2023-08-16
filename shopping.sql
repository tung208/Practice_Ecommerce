-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th8 16, 2023 lúc 01:03 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `shopping`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'Tung Admin', 'slenderman9196@gmail.com', NULL, '$2y$10$pXcU1INO3louV.Qlt8HCh.fzNt0no.Ldm8jW13MDyMrxCtK/E6WuC', NULL, NULL, NULL, '2023-08-14 07:04:28', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `blog_posts`
--

CREATE TABLE `blog_posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `post_title_en` varchar(255) NOT NULL,
  `post_slug_en` varchar(255) NOT NULL,
  `post_image` varchar(255) NOT NULL,
  `post_details_en` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_name_en` varchar(255) NOT NULL,
  `brand_slug_en` varchar(255) NOT NULL,
  `brand_image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `brands`
--

INSERT INTO `brands` (`id`, `brand_name_en`, `brand_slug_en`, `brand_image`, `created_at`, `updated_at`) VALUES
(1, 'Apple Meo Meo', 'apple-meo-meo', 'upload/brand/1774284141591888.Apple-Logo-PNG-Image-715x715.png', NULL, '2023-08-15 02:55:40'),
(2, 'Huawei', 'huawei', 'upload/brand/1774281759976112.Huawei-Logo.wine.png', NULL, NULL),
(3, 'Oppo', 'oppo', 'upload/brand/1774281777574982.Oppo-Logo.wine.png', NULL, NULL),
(4, 'Samsung', 'samsung', 'upload/brand/1774281788038264.Samsung_logo.png', NULL, NULL),
(5, 'Xiaomi', 'xiaomi', 'upload/brand/1774281800599676.unnamed.png', NULL, NULL),
(6, 'Vivo', 'vivo', 'upload/brand/1774281809492073.vivo-Phone-logo.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name_en` varchar(255) NOT NULL,
  `category_slug_en` varchar(255) NOT NULL,
  `category_icon` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `category_name_en`, `category_slug_en`, `category_icon`, `created_at`, `updated_at`) VALUES
(1, 'Bull’s Eye Level', 'bull’s-eye-level', 'upload/category/1774188552111429.Bull\'s Eye level.png', NULL, NULL),
(2, 'Compact', 'compact', 'upload/category/1774188864764619.Compact.png', NULL, NULL),
(3, 'Drill Driver', 'drill-driver', 'upload/category/1774188980538807.Drill Drivers.png', NULL, NULL),
(4, 'Gasoline Generators', 'gasoline-generators', 'upload/category/1774189299552510.Gasoline.png', NULL, NULL),
(5, 'Hammer drills', 'hammer-drills', 'upload/category/1774189694456021.Hammer drills.png', NULL, NULL),
(6, 'Heavy Duty', 'heavy-duty', 'upload/category/1774189715321119.Heavy Duty.png', NULL, NULL),
(7, 'Lightweight', 'lightweight', 'upload/category/1774190889600899.Lightweight.png', NULL, NULL),
(8, 'Line Level', 'line-level', 'upload/category/1774190897837286.Line Level.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
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
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_08_09_054326_create_sessions_table', 1),
(7, '2023_08_09_064723_create_site_settings_table', 1),
(8, '2023_08_09_065424_create_brands_table', 1),
(9, '2023_08_09_065440_create_categories_table', 1),
(10, '2023_08_09_065636_create_blog_posts_table', 1),
(11, '2023_08_09_065718_create_multi_imgs_table', 1),
(12, '2023_08_09_065732_create_orders_table', 1),
(13, '2023_08_09_065740_create_order_items_table', 1),
(14, '2023_08_09_065752_create_products_table', 1),
(15, '2023_08_09_065804_create_reviews_table', 1),
(16, '2023_08_09_070013_create_ship_districts_table', 1),
(17, '2023_08_09_070021_create_ship_divisions_table', 1),
(18, '2023_08_09_070028_create_ship_states_table', 1),
(19, '2023_08_09_070038_create_sliders_table', 1),
(20, '2023_08_09_070100_create_sub_categories_table', 1),
(21, '2023_08_09_070119_create_sub_sub_categories_table', 1),
(22, '2023_08_09_070133_create_whishlists_table', 1),
(23, '2023_08_10_023053_create_admins_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `multi_imgs`
--

CREATE TABLE `multi_imgs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `photo_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `multi_imgs`
--

INSERT INTO `multi_imgs` (`id`, `product_id`, `photo_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'upload/products/multi_image/1774357144344707.jpg', '2023-08-15 21:07:16', NULL),
(2, 1, 'upload/products/multi_image/1774357144422746.jpg', '2023-08-15 21:07:16', NULL),
(3, 1, 'upload/products/multi_image/1774357144502470.jpg', '2023-08-15 21:07:16', NULL),
(4, 2, 'upload/products/multi_image/1774357228456985.jpg', '2023-08-15 21:08:37', NULL),
(5, 2, 'upload/products/multi_image/1774357228585088.jpg', '2023-08-15 21:08:37', NULL),
(6, 2, 'upload/products/multi_image/1774357228664459.jpg', '2023-08-15 21:08:37', NULL),
(7, 2, 'upload/products/multi_image/1774357228743516.png', '2023-08-15 21:08:37', NULL),
(8, 3, 'upload/products/multi_image/1774357523625500.jpg', '2023-08-15 21:13:18', NULL),
(9, 3, 'upload/products/multi_image/1774357523704236.jpg', '2023-08-15 21:13:18', NULL),
(10, 3, 'upload/products/multi_image/1774357523783264.jpg', '2023-08-15 21:13:18', NULL),
(11, 3, 'upload/products/multi_image/1774357523862358.png', '2023-08-15 21:13:18', NULL),
(12, 3, 'upload/products/multi_image/1774357524024367.png', '2023-08-15 21:13:19', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `division_id` bigint(20) UNSIGNED NOT NULL,
  `district_id` bigint(20) UNSIGNED NOT NULL,
  `state_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `post_code` int(11) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `payment_type` varchar(255) NOT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `currency` varchar(255) NOT NULL,
  `amount` double(8,2) NOT NULL,
  `order_number` varchar(255) DEFAULT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `order_date` varchar(255) NOT NULL,
  `order_month` varchar(255) NOT NULL,
  `order_year` varchar(255) NOT NULL,
  `confirmed_date` varchar(255) DEFAULT NULL,
  `processing_date` varchar(255) DEFAULT NULL,
  `picked_date` varchar(255) DEFAULT NULL,
  `shipped_date` varchar(255) DEFAULT NULL,
  `delivered_date` varchar(255) DEFAULT NULL,
  `cancel_date` varchar(255) DEFAULT NULL,
  `return_date` varchar(255) DEFAULT NULL,
  `return_reason` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `color` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `qty` varchar(255) NOT NULL,
  `price` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
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
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `subsubcategory_id` int(11) NOT NULL,
  `product_name_en` varchar(255) NOT NULL,
  `product_slug_en` varchar(255) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `product_qty` varchar(255) NOT NULL,
  `product_tags_en` varchar(255) NOT NULL,
  `product_size_en` varchar(255) DEFAULT NULL,
  `product_color_en` varchar(255) NOT NULL,
  `selling_price` varchar(255) NOT NULL,
  `discount_price` varchar(255) DEFAULT NULL,
  `short_descp_en` text NOT NULL,
  `long_descp_en` text NOT NULL,
  `product_thumbnail` varchar(255) NOT NULL,
  `hot_deals` int(11) DEFAULT NULL,
  `featured` int(11) DEFAULT NULL,
  `special_offer` int(11) DEFAULT NULL,
  `special_deals` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `brand_id`, `category_id`, `subcategory_id`, `subsubcategory_id`, `product_name_en`, `product_slug_en`, `product_code`, `product_qty`, `product_tags_en`, `product_size_en`, `product_color_en`, `selling_price`, `discount_price`, `short_descp_en`, `long_descp_en`, `product_thumbnail`, `hot_deals`, `featured`, `special_offer`, `special_deals`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 1, 2, 'Band Saw', 'band-saw', 'BS1101', '5', 'Lorem,Ipsum,Amet', 'Small,Midium,Large', 'Red,Black,Yellow', '151', '140', 'zzzz', '<p>zzzzzzzzzzzzzzzz</p>', 'upload/products/thumbnail/1774357144252557.jpg', 1, 1, 1, 1, 1, '2023-08-15 21:07:16', NULL),
(2, 1, 5, 1, 2, 'Band Saw', 'band-saw', 'BS1101', '5', 'Lorem,Ipsum,Amet,Dewat', 'Small,Midium,Large', 'Red,Black,Yellow', '151', '140', 'zzzz', '<p>zzzzzzzzzzzzzzzzzzzzzz</p>', 'upload/products/thumbnail/1774357228374135.jpg', 1, 1, 1, 1, 1, '2023-08-15 21:08:36', NULL),
(3, 1, 5, 1, 2, 'High Torque Impact Wrench', 'high-torque-impact-wrench', 'BW1101', '11', 'Lorem,Ipsum,Amet', 'Small,Midium,Large', 'Red,Black,Yellow', '151', '140', 'POWERFUL AND VERSATILE PERFORMANCE', '<ul>\r\n	<li>POWERFUL AND VERSATILE PERFORMANCE: Complete a wide variety of fastening applications with 1,030 ft-lbs. of max fastening torque and 1,400 ft-lbs. of max breakaway torque.</li>\r\n	<li>CONTROL WHEN IT&rsquo;S NEEDED MOST: Maximize user control in a variety of applications with 4-mode speed settings and variable speed trigger.</li>\r\n	<li>PRECISION WRENCH&trade; MODE: Helps prevent overtightening and fastener run-off.</li>\r\n</ul>', 'upload/products/thumbnail/1774381054132434.jpg', 1, 1, 1, 1, 1, '2023-08-15 21:13:18', '2023-08-16 03:27:18');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `comment` text NOT NULL,
  `summary` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('R6nlADktGFxeCW2qNcZelXvA7AqDQlMyF6jvWHRY', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiVDRUOE1jZmd2d0VNangxZXNscVRXTTJBeFNsRmF6d0VSRHFhcVRzbyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM2OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvZWRpdC9wcm9kdWN0LzMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUyOiJsb2dpbl9hZG1pbl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1692183689);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ship_districts`
--

CREATE TABLE `ship_districts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `division_id` bigint(20) UNSIGNED NOT NULL,
  `district_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ship_divisions`
--

CREATE TABLE `ship_divisions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `division_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ship_states`
--

CREATE TABLE `ship_states` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `division_id` bigint(20) UNSIGNED NOT NULL,
  `district_id` bigint(20) UNSIGNED NOT NULL,
  `state_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `site_settings`
--

CREATE TABLE `site_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `phone_one` varchar(255) DEFAULT NULL,
  `phone_two` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `company_address` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `site_settings`
--

INSERT INTO `site_settings` (`id`, `logo`, `phone_one`, `phone_two`, `email`, `company_name`, `company_address`, `facebook`, `twitter`, `linkedin`, `youtube`, `created_at`, `updated_at`) VALUES
(1, 'upload/logo/logo.png', '0969616268', '0968010591', 'nguyentung9196@gmail.com', 'NETKO Solution', '84 Duy Tan Street', 'facebook.com/tung208', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slider_img` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `short_description` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sliders`
--

INSERT INTO `sliders` (`id`, `slider_img`, `title`, `short_description`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'upload/slider/1774187418247720.1773835220620765.slider1.png', 'Get 80% Off On All Types Tools', 'Hot', 'Electric Power Tools Manufacturers', 1, NULL, '2023-08-14 00:21:07'),
(2, 'upload/slider/1774187533056031.slider2.png', 'Get 80% Off On All Types Tools', 'Summer 2023', 'Buy Power & Hand Tool Kit Online', 1, NULL, '2023-08-14 00:20:35');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_name_en` varchar(255) NOT NULL,
  `subcategory_slug_en` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `category_id`, `subcategory_name_en`, `subcategory_slug_en`, `created_at`, `updated_at`) VALUES
(1, 5, 'Generators', 'generators', NULL, '2023-08-14 04:04:22'),
(2, 7, 'Ccissors', 'ccissors', NULL, '2023-08-14 20:44:00'),
(3, 6, 'Hammer Steel', 'hammer-steel', NULL, NULL),
(4, 5, 'Axe Battle', 'axe-battle', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sub_sub_categories`
--

CREATE TABLE `sub_sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `subsubcategory_name_en` varchar(255) NOT NULL,
  `subsubcategory_slug_en` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sub_sub_categories`
--

INSERT INTO `sub_sub_categories` (`id`, `category_id`, `subcategory_id`, `subsubcategory_name_en`, `subsubcategory_slug_en`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 'Diesel Generators', '', NULL, NULL),
(2, 5, 1, 'Natural Gas Generators', '', NULL, NULL),
(3, 6, 3, 'Hammer Steel XL', '', NULL, NULL),
(4, 6, 3, 'Hammer Steel XS', '', NULL, NULL),
(5, 5, 4, 'Axe Steel', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(21, 'Nguyễn Thanh Tùng', 'nguyentung9196@gmail.com', NULL, '$2y$10$pXcU1INO3louV.Qlt8HCh.fzNt0no.Ldm8jW13MDyMrxCtK/E6WuC', NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-14 00:03:15', '2023-08-14 00:03:15');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `whishlists`
--

CREATE TABLE `whishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Chỉ mục cho bảng `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `multi_imgs`
--
ALTER TABLE `multi_imgs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Chỉ mục cho bảng `ship_districts`
--
ALTER TABLE `ship_districts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `ship_divisions`
--
ALTER TABLE `ship_divisions`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `ship_states`
--
ALTER TABLE `ship_states`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `sub_sub_categories`
--
ALTER TABLE `sub_sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Chỉ mục cho bảng `whishlists`
--
ALTER TABLE `whishlists`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `multi_imgs`
--
ALTER TABLE `multi_imgs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `ship_districts`
--
ALTER TABLE `ship_districts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `ship_divisions`
--
ALTER TABLE `ship_divisions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `ship_states`
--
ALTER TABLE `ship_states`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `sub_sub_categories`
--
ALTER TABLE `sub_sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `whishlists`
--
ALTER TABLE `whishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
