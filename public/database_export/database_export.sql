-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2025. Ápr 29. 18:38
-- Kiszolgáló verziója: 10.4.32-MariaDB
-- PHP verzió: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `coffeshop_backend`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `contents`
--

CREATE TABLE `contents` (
  `cup_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_type` char(1) NOT NULL DEFAULT 'F',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `contents`
--

INSERT INTO `contents` (`cup_id`, `product_id`, `product_type`, `created_at`, `updated_at`) VALUES
(1, 20014, 'F', NULL, NULL),
(2, 20015, 'F', NULL, NULL),
(3, 20014, 'F', NULL, NULL),
(4, 20015, 'F', NULL, NULL),
(5, 20016, 'F', NULL, NULL),
(6, 20016, 'F', NULL, NULL),
(7, 20017, 'F', NULL, NULL),
(8, 20017, 'F', NULL, NULL),
(9, 20018, 'F', NULL, NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `dictionaries`
--

CREATE TABLE `dictionaries` (
  `code` char(3) NOT NULL,
  `description` varchar(40) NOT NULL,
  `reference` char(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `dictionaries`
--

INSERT INTO `dictionaries` (`code`, `description`, `reference`, `created_at`, `updated_at`) VALUES
('ACC', 'Accepted', 'S', NULL, NULL),
('BAS', 'Base Ingredients', 'I', NULL, NULL),
('CAN', 'Canceled', 'S', NULL, NULL),
('COF', 'Coffee', 'F', NULL, NULL),
('COM', 'Completed', 'S', NULL, NULL),
('COR', 'Core', 'I', NULL, NULL),
('FRU', 'Fruit purees / juices', 'I', NULL, NULL),
('HOD', 'Hot drinks', 'F', NULL, NULL),
('ICE', 'Ice', 'I', NULL, NULL),
('ICF', 'Iced Coffee', 'F', NULL, NULL),
('ICT', 'Iced Tea', 'F', NULL, NULL),
('IDR', 'Iced drinks', 'F', NULL, NULL),
('MIL', 'Milks', 'I', NULL, NULL),
('PRO', 'In Progress', 'S', NULL, NULL),
('PUP', 'Picked Up', 'S', NULL, NULL),
('REC', 'Received', 'S', NULL, NULL),
('SWE', 'Sweeteners', 'I', NULL, NULL),
('SYR', 'Flavored Syrups', 'I', NULL, NULL),
('TEA', 'Tea', 'F', NULL, NULL),
('TOP', 'Toppings', 'I', NULL, NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `failed_jobs`
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
-- Tábla szerkezet ehhez a táblához `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_01_10_162116_create_personal_access_tokens_table', 1),
(5, '2025_01_10_162317_create_dictionaries_table', 1),
(6, '2025_01_10_162332_create_products_table', 1),
(7, '2025_01_10_162402_create_product_recipes_table', 1),
(8, '2025_01_10_162423_create_orders_table', 1),
(9, '2025_01_10_162437_create_order_items_table', 1),
(10, '2025_01_10_162449_create_contents_table', 1),
(11, '2025_02_01_105301_insert_product_recipe', 1),
(12, '2025_03_07_173637_insert_contents_items_orders', 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `orders`
--

CREATE TABLE `orders` (
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `user` bigint(20) UNSIGNED DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `total_cost` decimal(10,2) NOT NULL DEFAULT 0.00,
  `order_status` char(3) NOT NULL DEFAULT 'REC',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `orders`
--

INSERT INTO `orders` (`order_id`, `user`, `date`, `total_cost`, `order_status`, `created_at`, `updated_at`) VALUES
(1, 2, '2025-04-29 16:37:16', 1.50, 'COM', NULL, NULL),
(2, 1, '2025-04-29 16:37:16', 2.50, 'COM', NULL, NULL),
(3, 2, '2025-04-29 16:37:16', 1.50, 'COM', NULL, NULL),
(4, 1, '2025-04-29 16:37:16', 2.50, 'COM', NULL, NULL),
(5, 1, '2025-04-29 16:37:16', 2.80, 'COM', NULL, NULL),
(6, 2, '2025-04-29 16:37:16', 2.80, 'COM', NULL, NULL),
(7, 2, '2025-04-29 16:37:16', 4.00, 'COM', NULL, NULL),
(8, 1, '2025-04-29 16:37:16', 4.00, 'COM', NULL, NULL),
(9, 2, '2025-04-29 16:37:16', 3.50, 'COM', NULL, NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `order_items`
--

CREATE TABLE `order_items` (
  `cup_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `item_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `order_items`
--

INSERT INTO `order_items` (`cup_id`, `order_id`, `item_price`, `created_at`, `updated_at`) VALUES
(1, 1, 0.00, NULL, NULL),
(2, 2, 0.00, NULL, NULL),
(3, 3, 0.00, NULL, NULL),
(4, 4, 0.00, NULL, NULL),
(5, 5, 0.00, NULL, NULL),
(6, 6, 0.00, NULL, NULL),
(7, 7, 0.00, NULL, NULL),
(8, 8, 0.00, NULL, NULL),
(9, 9, 0.00, NULL, NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `personal_access_tokens`
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
-- Tábla szerkezet ehhez a táblához `products`
--

CREATE TABLE `products` (
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(40) NOT NULL,
  `src` varchar(255) DEFAULT NULL,
  `type` char(1) NOT NULL,
  `category` char(3) NOT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 1,
  `current_price` decimal(8,2) NOT NULL,
  `unit` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `products`
--

INSERT INTO `products` (`product_id`, `name`, `src`, `type`, `category`, `is_available`, `current_price`, `unit`, `created_at`, `updated_at`) VALUES
(20000, 'Ground Coffee', NULL, 'I', 'COR', 1, 0.00, 2, NULL, NULL),
(20001, 'Water', 'images/water.png', 'I', 'COR', 1, 0.00, 10, NULL, NULL),
(20002, 'Milk', 'images/milk.png', 'I', 'MIL', 1, 0.00, 100, NULL, NULL),
(20003, 'Whipped Cream', 'images/whipped.png', 'I', 'TOP', 1, 0.30, 30, NULL, NULL),
(20004, 'Chocolate Syrup', 'images/ChocholateSyr.png', 'I', 'SYR', 1, 0.50, 20, NULL, NULL),
(20005, 'Matcha Powder', 'images/matcha.png', 'I', 'BAS', 1, 2.50, 2, NULL, NULL),
(20006, 'Honey', NULL, 'I', 'SWE', 1, 0.00, 10, NULL, NULL),
(20007, 'Cinnamon Syrup', 'images/cinamonSyr.png', 'I', 'SYR', 1, 0.50, 10, NULL, NULL),
(20008, 'Vanilla Syrup', 'images/VanilliaSyr.png', 'I', 'SYR', 1, 0.50, 20, NULL, NULL),
(20009, 'Coconut Syrup', 'images/coconutSyr.png', 'I', 'SYR', 1, 0.50, 20, NULL, NULL),
(20010, 'Lavender Syrup', 'images/levanderSyr.png', 'I', 'SYR', 1, 0.80, 10, NULL, NULL),
(20011, 'Chai Tea', 'images/chaiTea.png', 'I', 'BAS', 1, 2.30, 20, NULL, NULL),
(20012, 'Peach Tea Bag', 'images/peachTea.png', 'I', 'COR', 1, 1.50, 1, NULL, NULL),
(20013, 'Black Tea Bag', 'images/blackTea.png', 'I', 'COR', 1, 1.20, 1, NULL, NULL),
(20014, 'Espresso', 'images/espresso.png', 'F', 'COF', 1, 1.50, 30, NULL, NULL),
(20015, 'Cappuccino', 'images/cappuccino.png', 'F', 'COF', 1, 2.50, 150, NULL, NULL),
(20016, 'Latte', 'images/latte.png', 'F', 'COF', 1, 2.80, 250, NULL, NULL),
(20017, 'Frappuccino', 'images/frappuccino.png', 'F', 'ICF', 1, 4.00, 300, NULL, NULL),
(20018, 'Matcha Latte', 'images/matcha_latte.png', 'F', 'HOD', 1, 3.50, 250, NULL, NULL),
(20019, 'Flat White', 'images/flat_white.png', 'F', 'COF', 1, 3.20, 200, NULL, NULL),
(20020, 'Melange', 'images/melange.png', 'F', 'COF', 1, 2.70, 200, NULL, NULL),
(20021, 'Hot Chocolate', 'images/hot_chocolate.png', 'F', 'HOD', 1, 1.80, 250, NULL, NULL),
(20022, 'Green Tea', 'images/green_tea.png', 'F', 'TEA', 1, 1.50, 200, NULL, NULL),
(20023, 'Iced Coffee', 'images/iced_coffee.png', 'F', 'ICF', 1, 3.00, 300, NULL, NULL),
(20024, 'Snow Coffee', 'images/winter_coffee.png', 'F', 'ICF', 1, 3.50, 350, NULL, NULL),
(20025, 'Tea Latte', 'images/tea_latte.png', 'F', 'HOD', 1, 2.80, 250, NULL, NULL),
(20026, 'Iced Latte', 'images/iced_latte.png', 'F', 'ICF', 1, 3.00, 250, NULL, NULL),
(20027, 'Iced Mocha', 'images/iced_mocha.png', 'F', 'ICF', 1, 3.50, 300, NULL, NULL),
(20028, 'Macchiato', 'images/macchiato.png', 'F', 'COF', 1, 2.00, 90, NULL, NULL),
(20029, 'Caramel Latte', 'images/caramel_latte.png', 'F', 'COF', 1, 3.50, 250, NULL, NULL),
(20030, 'Affogato', 'images/affogato.png', 'F', 'COF', 1, 4.00, 150, NULL, NULL),
(20031, 'Vanilla Latte', 'images/vanilla_latte.png', 'F', 'COF', 1, 3.50, 250, NULL, NULL),
(20032, 'Iced Matcha Latte', 'images/iced_matcha_latte.png', 'F', 'IDR', 1, 3.80, 250, NULL, NULL),
(20033, 'Cinnamon Latte', 'images/cinnamon_latte.png', 'F', 'COF', 1, 3.30, 250, NULL, NULL),
(20034, 'Chai Latte', 'images/chai_latte.png', 'F', 'HOD', 1, 3.20, 250, NULL, NULL),
(20035, 'Ristretto', 'images/ristretto.png', 'F', 'COF', 1, 1.50, 20, NULL, NULL),
(20036, 'Turmeric Latte', 'images/turmeric_latte.png', 'F', 'HOD', 1, 3.50, 250, NULL, NULL),
(20037, 'Honey Lavender Latte', 'images/honey_lavender_latte.png', 'F', 'COF', 1, 3.80, 250, NULL, NULL),
(20038, 'Iced Americano', 'images/iced_americano.png', 'F', 'ICF', 1, 2.50, 300, NULL, NULL),
(20039, 'Caramel Macchiato', 'images/caramel_macchiato.png', 'F', 'COF', 1, 3.50, 250, NULL, NULL),
(20040, 'Iced Flat White', 'images/iced_flat_white.png', 'F', 'ICF', 1, 3.50, 250, NULL, NULL),
(20041, 'Chocolate Affogato', 'images/affogato_chocolate.png', 'F', 'COF', 1, 4.20, 150, NULL, NULL),
(20042, 'Coconut Latte', 'images/coconut_latte.png', 'F', 'COF', 1, 3.50, 250, NULL, NULL),
(20043, 'Iced Caramel Latte', 'images/iced_caramel_latte.png', 'F', 'ICF', 1, 3.80, 300, NULL, NULL),
(20044, 'Peach Iced Tea', 'images/iced_peach_tea.png', 'F', 'ICT', 1, 2.50, 300, NULL, NULL),
(20045, 'Iced Chai Latte', 'images/iced_chai_latte.png', 'F', 'IDR', 1, 3.50, 300, NULL, NULL),
(20046, 'Classic Lemonade', 'images/classic_lemonade.png', 'F', 'IDR', 1, 2.50, 300, NULL, NULL),
(20047, 'Strawberry Lemonade', 'images/strawberry_lemonade.png', 'F', 'IDR', 1, 3.00, 300, NULL, NULL),
(20048, 'Blueberry Lemonade', 'images/blueberry_lemonade.png', 'F', 'IDR', 1, 3.20, 300, NULL, NULL),
(20049, 'Lavender Lemonade', 'images/lavender_lemonade.png', 'F', 'IDR', 1, 3.50, 300, NULL, NULL),
(20050, 'Berry Punch', 'images/berry_punch2.png', 'F', 'HOD', 1, 4.00, 350, NULL, NULL),
(20051, 'Citrus Punch', 'images/citrus_punch.png', 'F', 'HOD', 1, 3.50, 300, NULL, NULL),
(20052, 'Peach Punch', 'images/peach_punch.png', 'F', 'HOD', 1, 3.70, 300, NULL, NULL),
(20053, 'Espresso Coffee', 'images/espressoIngredient.png', 'I', 'BAS', 1, 2.00, 30, NULL, NULL),
(20054, 'Ice', NULL, 'I', 'ICE', 1, 0.00, 200, NULL, NULL),
(20055, 'Caramel Syrup', 'images/caramellSyr.png', 'I', 'SYR', 1, 0.50, 20, NULL, NULL),
(20056, 'Vanilla Ice Cream', 'images/vanillia.png', 'I', 'TOP', 1, 0.50, 100, NULL, NULL),
(20057, 'Turmeric Powder', 'images/turmericPow.png', 'I', 'BAS', 1, 2.70, 2, NULL, NULL),
(20058, 'Raspberry Puree', NULL, 'I', 'FRU', 1, 0.00, 20, NULL, NULL),
(20059, 'Blueberry Puree', NULL, 'I', 'FRU', 1, 0.00, 30, NULL, NULL),
(20060, 'Cranberry Juice', NULL, 'I', 'FRU', 1, 0.00, 50, NULL, NULL),
(20061, 'Lime Juice', NULL, 'I', 'FRU', 1, 0.00, 20, NULL, NULL),
(20062, 'Peach Puree', NULL, 'I', 'FRU', 1, 0.00, 40, NULL, NULL),
(20063, 'Strawberry Puree', NULL, 'I', 'FRU', 1, 0.00, 30, NULL, NULL),
(20064, 'Lemon Juice', NULL, 'I', 'FRU', 1, 0.00, 10, NULL, NULL),
(20065, 'Orange Juice', NULL, 'I', 'FRU', 1, 0.00, 50, NULL, NULL),
(20066, 'Sugar Syrup', NULL, 'I', 'SWE', 1, 0.00, 10, NULL, NULL),
(20067, 'Green Tea Bag', 'images/greenTea.png', 'I', 'COR', 1, 1.20, 1, NULL, NULL),
(20068, 'Almond Milk', 'images/almondMilk.png', 'I', 'MIL', 1, 0.30, 100, NULL, NULL),
(20069, 'Oat Milk', 'images/OatMilk.png', 'I', 'MIL', 1, 0.30, 100, NULL, NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `product_recipes`
--

CREATE TABLE `product_recipes` (
  `product` bigint(20) UNSIGNED NOT NULL,
  `ingredient` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `product_recipes`
--

INSERT INTO `product_recipes` (`product`, `ingredient`, `quantity`, `created_at`, `updated_at`) VALUES
(20014, 20000, 3, NULL, NULL),
(20014, 20001, 3, NULL, NULL),
(20015, 20000, 3, NULL, NULL),
(20015, 20001, 3, NULL, NULL),
(20015, 20002, 1, NULL, NULL),
(20015, 20003, 1, NULL, NULL),
(20016, 20000, 3, NULL, NULL),
(20016, 20001, 3, NULL, NULL),
(20016, 20002, 2, NULL, NULL),
(20017, 20000, 3, NULL, NULL),
(20017, 20001, 3, NULL, NULL),
(20017, 20002, 1, NULL, NULL),
(20017, 20004, 1, NULL, NULL),
(20017, 20054, 1, NULL, NULL),
(20018, 20002, 2, NULL, NULL),
(20018, 20005, 1, NULL, NULL),
(20018, 20006, 1, NULL, NULL),
(20019, 20000, 3, NULL, NULL),
(20019, 20001, 3, NULL, NULL),
(20019, 20002, 2, NULL, NULL),
(20020, 20000, 3, NULL, NULL),
(20020, 20001, 3, NULL, NULL),
(20020, 20002, 2, NULL, NULL),
(20020, 20003, 1, NULL, NULL),
(20021, 20002, 2, NULL, NULL),
(20021, 20003, 1, NULL, NULL),
(20021, 20004, 2, NULL, NULL),
(20022, 20001, 20, NULL, NULL),
(20022, 20067, 1, NULL, NULL),
(20023, 20000, 3, NULL, NULL),
(20023, 20001, 3, NULL, NULL),
(20023, 20002, 1, NULL, NULL),
(20023, 20008, 1, NULL, NULL),
(20023, 20054, 1, NULL, NULL),
(20024, 20000, 3, NULL, NULL),
(20024, 20001, 3, NULL, NULL),
(20024, 20002, 1, NULL, NULL),
(20024, 20007, 1, NULL, NULL),
(20024, 20054, 1, NULL, NULL),
(20025, 20001, 15, NULL, NULL),
(20025, 20002, 1, NULL, NULL),
(20025, 20013, 1, NULL, NULL),
(20026, 20000, 3, NULL, NULL),
(20026, 20001, 3, NULL, NULL),
(20026, 20002, 1, NULL, NULL),
(20026, 20054, 1, NULL, NULL),
(20027, 20000, 3, NULL, NULL),
(20027, 20001, 3, NULL, NULL),
(20027, 20002, 1, NULL, NULL),
(20027, 20004, 2, NULL, NULL),
(20027, 20054, 1, NULL, NULL),
(20028, 20000, 3, NULL, NULL),
(20028, 20001, 3, NULL, NULL),
(20028, 20002, 1, NULL, NULL),
(20029, 20000, 3, NULL, NULL),
(20029, 20001, 3, NULL, NULL),
(20029, 20002, 2, NULL, NULL),
(20029, 20055, 1, NULL, NULL),
(20030, 20000, 3, NULL, NULL),
(20030, 20001, 3, NULL, NULL),
(20030, 20003, 1, NULL, NULL),
(20030, 20056, 1, NULL, NULL),
(20031, 20000, 3, NULL, NULL),
(20031, 20001, 3, NULL, NULL),
(20031, 20002, 2, NULL, NULL),
(20031, 20008, 1, NULL, NULL),
(20032, 20002, 1, NULL, NULL),
(20032, 20005, 1, NULL, NULL),
(20032, 20006, 1, NULL, NULL),
(20032, 20054, 1, NULL, NULL),
(20033, 20000, 3, NULL, NULL),
(20033, 20001, 3, NULL, NULL),
(20033, 20002, 2, NULL, NULL),
(20033, 20007, 1, NULL, NULL),
(20034, 20002, 2, NULL, NULL),
(20034, 20006, 1, NULL, NULL),
(20034, 20011, 1, NULL, NULL),
(20035, 20000, 3, NULL, NULL),
(20035, 20001, 2, NULL, NULL),
(20036, 20002, 2, NULL, NULL),
(20036, 20006, 1, NULL, NULL),
(20036, 20057, 1, NULL, NULL),
(20037, 20000, 3, NULL, NULL),
(20037, 20001, 3, NULL, NULL),
(20037, 20002, 2, NULL, NULL),
(20037, 20006, 1, NULL, NULL),
(20037, 20010, 1, NULL, NULL),
(20038, 20000, 3, NULL, NULL),
(20038, 20001, 13, NULL, NULL),
(20038, 20054, 1, NULL, NULL),
(20039, 20000, 3, NULL, NULL),
(20039, 20001, 3, NULL, NULL),
(20039, 20002, 2, NULL, NULL),
(20039, 20055, 1, NULL, NULL),
(20040, 20000, 3, NULL, NULL),
(20040, 20001, 3, NULL, NULL),
(20040, 20002, 1, NULL, NULL),
(20040, 20054, 1, NULL, NULL),
(20041, 20000, 3, NULL, NULL),
(20041, 20001, 3, NULL, NULL),
(20041, 20004, 1, NULL, NULL),
(20041, 20056, 1, NULL, NULL),
(20042, 20000, 3, NULL, NULL),
(20042, 20001, 3, NULL, NULL),
(20042, 20002, 2, NULL, NULL),
(20042, 20009, 1, NULL, NULL),
(20043, 20000, 3, NULL, NULL),
(20043, 20001, 3, NULL, NULL),
(20043, 20002, 1, NULL, NULL),
(20043, 20054, 1, NULL, NULL),
(20043, 20055, 1, NULL, NULL),
(20044, 20001, 10, NULL, NULL),
(20044, 20012, 1, NULL, NULL),
(20044, 20054, 1, NULL, NULL),
(20045, 20002, 1, NULL, NULL),
(20045, 20006, 1, NULL, NULL),
(20045, 20011, 1, NULL, NULL),
(20045, 20054, 1, NULL, NULL),
(20046, 20001, 25, NULL, NULL),
(20046, 20054, 1, NULL, NULL),
(20046, 20064, 3, NULL, NULL),
(20046, 20066, 2, NULL, NULL),
(20047, 20001, 24, NULL, NULL),
(20047, 20054, 1, NULL, NULL),
(20047, 20063, 1, NULL, NULL),
(20047, 20064, 2, NULL, NULL),
(20047, 20066, 1, NULL, NULL),
(20048, 20001, 24, NULL, NULL),
(20048, 20054, 1, NULL, NULL),
(20048, 20059, 1, NULL, NULL),
(20048, 20064, 2, NULL, NULL),
(20048, 20066, 1, NULL, NULL),
(20049, 20001, 24, NULL, NULL),
(20049, 20010, 1, NULL, NULL),
(20049, 20054, 1, NULL, NULL),
(20049, 20064, 2, NULL, NULL),
(20049, 20066, 1, NULL, NULL),
(20050, 20001, 24, NULL, NULL),
(20050, 20058, 1, NULL, NULL),
(20050, 20059, 1, NULL, NULL),
(20050, 20060, 1, NULL, NULL),
(20050, 20064, 2, NULL, NULL),
(20051, 20001, 19, NULL, NULL),
(20051, 20061, 1, NULL, NULL),
(20051, 20064, 2, NULL, NULL),
(20051, 20065, 1, NULL, NULL),
(20051, 20066, 2, NULL, NULL),
(20052, 20001, 23, NULL, NULL),
(20052, 20062, 1, NULL, NULL),
(20052, 20064, 2, NULL, NULL),
(20052, 20066, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_subscribed` tinyint(1) NOT NULL DEFAULT 0,
  `profile_type` char(255) NOT NULL DEFAULT 'U'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `is_subscribed`, `profile_type`) VALUES
(1, 'Test Admin', 'testadmin@example.com', NULL, '$2y$12$.U6fJ.CkfYa4ZD93WvIIPu4zVnD38RpeEXmsH2IHSDRQo/b4s1DAm', NULL, '2025-04-29 14:37:15', '2025-04-29 14:37:15', 1, 'A'),
(2, 'Test User', 'testuser@example.com', NULL, '$2y$12$k6xrIgV1X6qKFa9e31lqye2RNv2G.SgRsGh4UsorOA.b57t3LMqTG', NULL, '2025-04-29 14:37:16', '2025-04-29 14:37:16', 1, 'U'),
(3, 'Guest User', 'guestuser@example.com', NULL, '$2y$12$FaWRmrTewRMAg32alYTo..fmjD3ay9bSM9YGpWIsdH.RpxND9zEHu', NULL, '2025-04-29 14:37:16', '2025-04-29 14:37:16', 0, 'U');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- A tábla indexei `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- A tábla indexei `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`cup_id`,`product_id`),
  ADD KEY `contents_product_id_foreign` (`product_id`);

--
-- A tábla indexei `dictionaries`
--
ALTER TABLE `dictionaries`
  ADD PRIMARY KEY (`code`);

--
-- A tábla indexei `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- A tábla indexei `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- A tábla indexei `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `orders_user_foreign` (`user`),
  ADD KEY `orders_order_status_foreign` (`order_status`);

--
-- A tábla indexei `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`cup_id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`);

--
-- A tábla indexei `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- A tábla indexei `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- A tábla indexei `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `products_category_foreign` (`category`);

--
-- A tábla indexei `product_recipes`
--
ALTER TABLE `product_recipes`
  ADD PRIMARY KEY (`product`,`ingredient`),
  ADD KEY `product_recipes_ingredient_foreign` (`ingredient`);

--
-- A tábla indexei `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT a táblához `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT a táblához `order_items`
--
ALTER TABLE `order_items`
  MODIFY `cup_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT a táblához `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `products`
--
ALTER TABLE `products`
  MODIFY `product_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20070;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `contents`
--
ALTER TABLE `contents`
  ADD CONSTRAINT `contents_cup_id_foreign` FOREIGN KEY (`cup_id`) REFERENCES `order_items` (`cup_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `contents_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_order_status_foreign` FOREIGN KEY (`order_status`) REFERENCES `dictionaries` (`code`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_user_foreign` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_foreign` FOREIGN KEY (`category`) REFERENCES `dictionaries` (`code`) ON DELETE CASCADE;

--
-- Megkötések a táblához `product_recipes`
--
ALTER TABLE `product_recipes`
  ADD CONSTRAINT `product_recipes_ingredient_foreign` FOREIGN KEY (`ingredient`) REFERENCES `products` (`product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_recipes_product_foreign` FOREIGN KEY (`product`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
