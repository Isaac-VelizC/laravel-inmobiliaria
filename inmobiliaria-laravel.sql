-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-07-2025 a las 18:07:45
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inmobiliaria-laravel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agentes`
--

CREATE TABLE `agentes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('activo','inactivo') NOT NULL DEFAULT 'activo',
  `oficina` bigint(20) UNSIGNED DEFAULT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `agentes`
--

INSERT INTO `agentes` (`id`, `status`, `oficina`, `id_user`, `created_at`, `updated_at`) VALUES
(1, 'activo', 1, 4, '2025-07-17 02:08:31', '2025-07-17 02:08:31'),
(2, 'activo', 1, 5, '2025-07-17 02:09:29', '2025-07-17 02:09:29'),
(3, 'activo', 1, 6, '2025-07-17 02:10:46', '2025-07-17 02:10:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel_cache_isa.veliz@gmail.com|127.0.0.1', 'i:1;', 1752702194),
('laravel_cache_isa.veliz@gmail.com|127.0.0.1:timer', 'i:1752702194;', 1752702194),
('soluciones_inmobiliarias_cache_heydi.perez@gmial.com|127.0.0.1', 'i:1;', 1752788371),
('soluciones_inmobiliarias_cache_heydi.perez@gmial.com|127.0.0.1:timer', 'i:1752788371;', 1752788371),
('soluciones_inmobiliarias_cache_julia.casa@gmil.com|127.0.0.1', 'i:2;', 1752788110),
('soluciones_inmobiliarias_cache_julia.casa@gmil.com|127.0.0.1:timer', 'i:1752788110;', 1752788110),
('soluciones_inmobiliarias_cache_julia.ramos@gmail.com|127.0.0.1', 'i:1;', 1752760992),
('soluciones_inmobiliarias_cache_julia.ramos@gmail.com|127.0.0.1:timer', 'i:1752760992;', 1752760992),
('soluciones_inmobiliarias_cache_romina.flores@gmail.com|127.0.0.1', 'i:1;', 1752788308),
('soluciones_inmobiliarias_cache_romina.flores@gmail.com|127.0.0.1:timer', 'i:1752788308;', 1752788308),
('soluciones_inmobiliarias_cache_romina.ramos@gmail.com|127.0.0.1', 'i:1;', 1752788288),
('soluciones_inmobiliarias_cache_romina.ramos@gmail.com|127.0.0.1:timer', 'i:1752788288;', 1752788288),
('soluciones_inmobiliarias_cache_spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:10:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:16:\"Administrar Todo\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:16:\"Gestion Usuarios\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:17:\"Gestion Servicios\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:15:\"Crear Propiedad\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:16:\"Editar Propiedad\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:16:\"Borrar Propiedad\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:14:\"Show Propiedad\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:11:\"Crear Citas\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:12:\"Editar Citas\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:10:\"Show Citas\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}}s:5:\"roles\";a:2:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:5:\"Admin\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:3;s:1:\"b\";s:6:\"Agente\";s:1:\"c\";s:3:\"web\";}}}', 1752941062);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` datetime NOT NULL DEFAULT '2025-07-16 21:37:11',
  `time` time NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'pendiente',
  `detail` text DEFAULT NULL,
  `propiedad` bigint(20) UNSIGNED NOT NULL,
  `usuario` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita_groups`
--

CREATE TABLE `cita_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL DEFAULT '2025-07-16',
  `time` time NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 1,
  `status` varchar(50) NOT NULL DEFAULT 'pendiente',
  `detail` text DEFAULT NULL,
  `propiedad` bigint(20) UNSIGNED NOT NULL,
  `agente` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cita_groups`
--

INSERT INTO `cita_groups` (`id`, `name`, `date`, `time`, `cantidad`, `status`, `detail`, `propiedad`, `agente`, `created_at`, `updated_at`) VALUES
(1, 'Grupo 1', '2025-07-17', '09:30:00', 4, 'confirmada', NULL, 1, 2, '2025-07-17 02:18:12', '2025-07-17 18:15:44'),
(2, 'Grupo 2', '2025-07-18', '14:45:00', 8, 'confirmada', NULL, 3, 2, '2025-07-17 17:54:49', '2025-07-17 18:16:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuestas`
--

CREATE TABLE `encuestas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `enabled_until` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `encuestas`
--

INSERT INTO `encuestas` (`id`, `name`, `enabled_until`, `created_at`, `updated_at`) VALUES
(1, 'Encuesta de Satisfacción por la Visita al Inmueble', '2025-08-16 21:37:29', '2025-07-17 01:37:29', '2025-07-17 01:37:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
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
-- Estructura de tabla para la tabla `hotspots`
--

CREATE TABLE `hotspots` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `sceneId` bigint(20) UNSIGNED NOT NULL,
  `targetScene` bigint(20) UNSIGNED DEFAULT NULL,
  `pitch` double NOT NULL,
  `yaw` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `propiedad_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `hotspots`
--

INSERT INTO `hotspots` (`id`, `nombre`, `sceneId`, `targetScene`, `pitch`, `yaw`, `created_at`, `updated_at`, `propiedad_id`) VALUES
(1, 'dorm 2', 3, 4, -8.196520214584275, -138.56872526587583, '2025-07-17 17:27:34', '2025-07-17 17:27:35', 2),
(2, 'dorm 1', 4, 3, 2.5573618612747344, -116.91681999142196, '2025-07-17 17:28:05', '2025-07-17 17:28:06', 2),
(3, 'hab 1', 6, 8, 5.531067322662807, -128.58584646121633, '2025-07-17 17:50:46', '2025-07-17 17:50:46', 3),
(4, 'hab 2', 6, 7, -2.3929778933438155, -135.79972235550454, '2025-07-17 17:51:42', '2025-07-17 17:51:42', 3),
(5, 'hab 2', 7, 8, -1.3080085693481431, -144.6619355467309, '2025-07-17 17:52:30', '2025-07-17 17:52:30', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen_servicios`
--

CREATE TABLE `imagen_servicios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `path` varchar(255) DEFAULT NULL,
  `id_servicio` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `path` longtext DEFAULT NULL,
  `propiedad` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `images`
--

INSERT INTO `images` (`id`, `name`, `type`, `path`, `propiedad`, `created_at`, `updated_at`) VALUES
(1, NULL, 'casa_fuera', 'imagenes/rPssyTyPDjlicCGXbSLvsIUzXuMm7egGGPggGbe5.webp', 1, '2025-07-17 17:15:16', '2025-07-17 17:15:16'),
(2, NULL, 'casa_fuera', 'imagenes/pAAuJ1sTg4Ny4shQZNU2JZezUVnUVyB7kCaDCnID.webp', 2, '2025-07-17 17:26:14', '2025-07-17 17:26:14'),
(3, NULL, '360', 'imagenes/OG3lopLCxdDnqqtQNoSJ9rQEUqbns6x4krU2Tg2R.webp', 2, '2025-07-17 17:27:04', '2025-07-17 17:27:04'),
(4, NULL, '360', 'imagenes/csNO9tHZIFIQDSpDyovBqHPjPdxTMIMlxPtlynWf.webp', 2, '2025-07-17 17:27:05', '2025-07-17 17:27:05'),
(5, NULL, 'casa_fuera', 'imagenes/mFfpbDMRGh7athySJ5Z0g7ja3Hn6S0MtusiHHx6j.webp', 3, '2025-07-17 17:49:38', '2025-07-17 17:49:38'),
(6, NULL, '360', 'imagenes/r6NkCw49zcgnklsyCG5k4ICuGoi1sJqvFJW6gOZ6.webp', 3, '2025-07-17 17:50:00', '2025-07-17 17:50:00'),
(7, NULL, '360', 'imagenes/unLRv2wqUUlPNuLw1RHVJmldnN1PtuMZduT6jHGa.webp', 3, '2025-07-17 17:50:00', '2025-07-17 17:50:00'),
(8, NULL, '360', 'imagenes/raz1BC3sJV7K7bJcEmrBpeiWfwLfyJQfCH6x4nId.webp', 3, '2025-07-17 17:50:00', '2025-07-17 17:50:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
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
-- Estructura de tabla para la tabla `job_batches`
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
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_02_26_184329_create_personas_table', 1),
(5, '2025_02_26_184338_create_propietarios_table', 1),
(6, '2025_02_26_184354_create_oficinas_table', 1),
(7, '2025_02_26_184401_create_agentes_table', 1),
(8, '2025_02_26_184417_create_tipo_traspasos_table', 1),
(9, '2025_02_26_184452_create_propiedades_table', 1),
(10, '2025_02_26_184509_create_images_table', 1),
(11, '2025_02_26_184516_create_hotspots_table', 1),
(12, '2025_02_26_184525_create_visitas_table', 1),
(13, '2025_02_26_184538_create_transaccions_table', 1),
(14, '2025_02_26_184547_create_citas_table', 1),
(15, '2025_02_26_184608_create_servicios_tipos_table', 1),
(16, '2025_02_26_184621_create_solicitud_servicios_table', 1),
(17, '2025_02_26_184631_create_servicios_destalles_table', 1),
(18, '2025_02_26_184642_create_servicios_table', 1),
(19, '2025_02_26_184653_create_imagen_servicios_table', 1),
(20, '2025_02_26_184713_create_encuestas_table', 1),
(21, '2025_02_26_184723_create_preguntas_table', 1),
(22, '2025_02_26_184729_create_respuestas_table', 1),
(23, '2025_02_26_201236_create_permission_tables', 1),
(24, '2025_03_10_193922_create_cita_groups_table', 1),
(25, '2025_03_10_194604_create_user_cita_groups_table', 1),
(26, '2025_03_13_204535_create_respuestas_seleccionadas_table', 1),
(27, '2025_03_13_204547_create_resultados_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 3),
(3, 'App\\Models\\User', 4),
(3, 'App\\Models\\User', 5),
(3, 'App\\Models\\User', 6),
(4, 'App\\Models\\User', 7),
(4, 'App\\Models\\User', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oficinas`
--

CREATE TABLE `oficinas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `city` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `country` varchar(20) NOT NULL,
  `number` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `oficinas`
--

INSERT INTO `oficinas` (`id`, `name`, `address`, `city`, `status`, `country`, `number`, `created_at`, `updated_at`) VALUES
(1, 'Oficina Central', 'Potosí, calle Padilla Nº66, zona central', 'Potosí', 1, 'Bolivia', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Administrar Todo', 'web', '2025-07-17 01:37:26', '2025-07-17 01:37:26'),
(2, 'Gestion Usuarios', 'web', '2025-07-17 01:37:27', '2025-07-17 01:37:27'),
(3, 'Gestion Servicios', 'web', '2025-07-17 01:37:27', '2025-07-17 01:37:27'),
(4, 'Crear Propiedad', 'web', '2025-07-17 01:37:27', '2025-07-17 01:37:27'),
(5, 'Editar Propiedad', 'web', '2025-07-17 01:37:27', '2025-07-17 01:37:27'),
(6, 'Borrar Propiedad', 'web', '2025-07-17 01:37:27', '2025-07-17 01:37:27'),
(7, 'Show Propiedad', 'web', '2025-07-17 01:37:27', '2025-07-17 01:37:27'),
(8, 'Crear Citas', 'web', '2025-07-17 01:37:27', '2025-07-17 01:37:27'),
(9, 'Editar Citas', 'web', '2025-07-17 01:37:27', '2025-07-17 01:37:27'),
(10, 'Show Citas', 'web', '2025-07-17 01:37:27', '2025-07-17 01:37:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `surnames` varchar(50) NOT NULL,
  `ci` varchar(20) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `id_user` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id`, `name`, `surnames`, `ci`, `phone`, `address`, `id_user`, `created_at`, `updated_at`) VALUES
(1, 'Karla', 'Rosa', '9876543', '29847239', 'Calle Rosas', 3, '2025-07-17 01:37:26', '2025-07-17 01:37:26'),
(2, 'Marcelo', 'Llanos Perez', NULL, '97845343', 'Calle Hoyos #89', 4, '2025-07-17 02:08:31', '2025-07-17 02:08:31'),
(3, 'Julia', 'Casa Loza', NULL, '98375223', 'Calle Lindaura #98', 5, '2025-07-17 02:09:29', '2025-07-17 02:09:29'),
(4, 'Gabriel Juan', 'Lopez Calle', NULL, '92837492', 'Calle uno #58', 6, '2025-07-17 02:10:46', '2025-07-17 02:10:46'),
(5, 'Romina', 'Ramos Flores', NULL, '98358232', 'Calle Junin #59', 7, '2025-07-17 17:42:14', '2025-07-17 17:42:14'),
(6, 'Heydi', 'Perez Quiñones', NULL, '37468232', NULL, 8, '2025-07-17 17:58:32', '2025-07-17 17:58:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` text NOT NULL,
  `encuesta_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`id`, `question`, `encuesta_id`, `created_at`, `updated_at`) VALUES
(1, '¿Qué tan satisfecho está con el estado de conservación del inmueble?', 1, '2025-07-17 01:37:29', '2025-07-17 01:37:29'),
(2, '¿Considera que la información proporcionada por el agente fue clara y útil?', 1, '2025-07-17 01:37:29', '2025-07-17 01:37:29'),
(3, '¿Cómo calificaría la atención recibida por parte del agente inmobiliario?', 1, '2025-07-17 01:37:29', '2025-07-17 01:37:29'),
(4, '¿Qué tan probable es que nos recomiende a amigos o familiares?', 1, '2025-07-17 01:37:29', '2025-07-17 01:37:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propiedades`
--

CREATE TABLE `propiedades` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(250) NOT NULL,
  `address` varchar(200) NOT NULL,
  `city` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL DEFAULT 'Bolivia',
  `zip_code` varchar(10) NOT NULL DEFAULT '0000',
  `tipo_propiedad` bigint(20) UNSIGNED DEFAULT NULL,
  `tipo_traspaso` bigint(20) UNSIGNED DEFAULT NULL,
  `num_rooms` int(11) NOT NULL DEFAULT 0,
  `num_bedrooms` int(11) NOT NULL DEFAULT 0,
  `num_bathrooms` int(11) NOT NULL DEFAULT 0,
  `num_hall` int(11) NOT NULL DEFAULT 0,
  `num_kitchens` int(11) NOT NULL DEFAULT 0,
  `num_garages` int(11) NOT NULL DEFAULT 0,
  `constructed_area` decimal(10,2) NOT NULL,
  `ground_surface` decimal(10,2) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(12,2) NOT NULL,
  `coin` varchar(3) NOT NULL DEFAULT 'USD',
  `bank_financing` enum('Si','No') NOT NULL DEFAULT 'No',
  `date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `latitude` varchar(50) DEFAULT NULL,
  `longitude` varchar(20) DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `state_advertising` varchar(20) NOT NULL DEFAULT 'no',
  `propietario` bigint(20) UNSIGNED DEFAULT NULL,
  `id_user` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `propiedades`
--

INSERT INTO `propiedades` (`id`, `name`, `address`, `city`, `country`, `zip_code`, `tipo_propiedad`, `tipo_traspaso`, `num_rooms`, `num_bedrooms`, `num_bathrooms`, `num_hall`, `num_kitchens`, `num_garages`, `constructed_area`, `ground_surface`, `description`, `price`, `coin`, `bank_financing`, `date`, `end_date`, `latitude`, `longitude`, `status`, `state_advertising`, `propietario`, `id_user`, `created_at`, `updated_at`) VALUES
(1, 'Casa de noelia', 'Calle Castro Rojas #4', 'Cochabamba', 'Bolivia', '0000', 1, 1, 4, 3, 3, 1, 2, 1, 1200.00, 200.00, 'Inmobiliaria Horizonte Azul S.A. es una empresa dedicada a ofrecer soluciones integrales en bienes raíces, especializada en la compra, venta, alquiler y administración de propiedades residenciales, comerciales e industriales. Fundada en 2010, nuestra misión es brindar un servicio personalizado y confiable que facilite a nuestros clientes encontrar el inmueble ideal para sus necesidades, ya sea su nuevo hogar, oficina o inversión.', 50000.00, 'USD', 'No', '2025-07-16', '2025-07-31', '-17.381141', '-66.170936', 'Disponible', 'publicitado', 1, 1, '2025-07-17 02:17:04', '2025-07-17 02:17:04'),
(2, 'Residencial A', 'Calle Falsa 123, Piso 2, Madrid', 'Santa Cruz de la Sierra', 'Bolivia', '0000', 1, 1, 8, 3, 2, 0, 1, 1, 200.00, 120.00, 'Casa familiar luminosa con amplio jardín y piscina en barrio tranquilo\n\nEsta hermosa vivienda de 150 m² construidos se ubica en el corazón del residencial El Bosque, a pocos minutos de colegios y supermercados. Cuenta con 4 dormitorios espaciosos, 3 baños modernos, cocina equipada con electrodomésticos de alta gama y un amplio salón comedor con grandes ventanales que ofrecen gran entrada de luz natural.\n\nEl inmueble dispone de garaje para dos coches, piscina privada y terraza con zona de barbacoa, ideal para reuniones familiares. Recientemente reformada, cuenta con suelos de madera maciza, aire acondicionado central y ventanas con doble acristalamiento para un óptimo aislamiento térmico y acústico.\n\nSe encuentra en una zona segura y tranquila, con fácil acceso a transporte público y cerca de parques para disfrutar en familia.\n\nNo pierda la oportunidad de conocer esta excelente opción. Contáctenos para agendar una visita o recibir más información.', 250.00, 'USD', 'No', '2025-07-17', '2025-07-27', '-17.782248', '-63.175727', 'Disponible', 'publicitado', 2, 1, '2025-07-17 17:25:56', '2025-07-17 17:25:56'),
(3, 'Ático Mirador Sol', 'Calle Maria Luisa #54', 'Trinidad', 'Bolivia', '0000', 1, 1, 8, 2, 2, 1, 2, 1, 120.00, 98.00, 'Ático moderno con vistas panorámicas y piscina comunitaria en Valencia\n\nEste espectacular ático de 98 m² construidos está situado en la séptima planta de un edificio contemporáneo en la exclusiva zona del Lago. Ofrece 2 dormitorios luminosos, 2 baños completos, cocina independiente totalmente equipada y un salón-comedor con acceso a una amplia terraza con hermosas vistas a la ciudad y al lago.\n\nEl inmueble incluye plaza de garaje, acceso por ascensor y uso de una piscina comunitaria en la azotea. El edificio, de reciente construcción, destaca por su seguridad, eficiencia energética y excelentes acabados.\n\nIdeal para quienes buscan confort, tranquilidad y una ubicación privilegiada cerca de comercios, transporte público y zonas verdes.\n\nContáctanos para concertar una visita y descubrir todo lo que este ático puede ofrecer.', 320.00, 'USD', 'No', '2025-07-19', '2025-07-31', '-14.827114', '-64.899729', 'Disponible', 'publicitado', 2, 1, '2025-07-17 17:49:21', '2025-07-17 17:49:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propietarios`
--

CREATE TABLE `propietarios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `surnames` varchar(50) NOT NULL,
  `ci` varchar(20) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `status` enum('activo','inactivo') NOT NULL DEFAULT 'activo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `propietarios`
--

INSERT INTO `propietarios` (`id`, `name`, `surnames`, `ci`, `phone`, `address`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Noelia', 'Flores Colque', NULL, '29364239', NULL, 'noelia.flores@gmail.com', 'activo', '2025-07-17 02:11:45', '2025-07-17 02:11:45'),
(2, 'Angel', 'Ramos Rodriguez', NULL, '93853095', NULL, 'angel.ramos@gmail.com', 'activo', '2025-07-17 02:12:22', '2025-07-17 02:12:22'),
(3, 'Pepe', 'Condori Condori', NULL, '92834023', NULL, 'pepe.condori@gmail.com', 'activo', '2025-07-17 02:13:08', '2025-07-17 02:13:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE `respuestas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `respuestas`
--

INSERT INTO `respuestas` (`id`, `question`, `created_at`, `updated_at`) VALUES
(1, 'Muy malo', '2025-07-17 01:37:29', '2025-07-17 01:37:29'),
(2, 'Malo', '2025-07-17 01:37:29', '2025-07-17 01:37:29'),
(3, 'Regular', '2025-07-17 01:37:29', '2025-07-17 01:37:29'),
(4, 'Bueno', '2025-07-17 01:37:29', '2025-07-17 01:37:29'),
(5, 'Excelente', '2025-07-17 01:37:29', '2025-07-17 01:37:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas_seleccionadas`
--

CREATE TABLE `respuestas_seleccionadas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pregunta_id` bigint(20) UNSIGNED NOT NULL,
  `respuesta_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `respuestas_seleccionadas`
--

INSERT INTO `respuestas_seleccionadas` (`id`, `pregunta_id`, `respuesta_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2025-07-17 01:37:29', '2025-07-17 01:37:29'),
(2, 1, 2, '2025-07-17 01:37:29', '2025-07-17 01:37:29'),
(3, 1, 3, '2025-07-17 01:37:29', '2025-07-17 01:37:29'),
(4, 1, 4, '2025-07-17 01:37:29', '2025-07-17 01:37:29'),
(5, 1, 5, '2025-07-17 01:37:29', '2025-07-17 01:37:29'),
(6, 2, 1, '2025-07-17 01:37:29', '2025-07-17 01:37:29'),
(7, 2, 2, '2025-07-17 01:37:29', '2025-07-17 01:37:29'),
(8, 2, 3, '2025-07-17 01:37:29', '2025-07-17 01:37:29'),
(9, 2, 4, '2025-07-17 01:37:29', '2025-07-17 01:37:29'),
(10, 2, 5, '2025-07-17 01:37:29', '2025-07-17 01:37:29'),
(11, 3, 1, '2025-07-17 01:37:29', '2025-07-17 01:37:29'),
(12, 3, 2, '2025-07-17 01:37:29', '2025-07-17 01:37:29'),
(13, 3, 3, '2025-07-17 01:37:29', '2025-07-17 01:37:29'),
(14, 3, 4, '2025-07-17 01:37:29', '2025-07-17 01:37:29'),
(15, 3, 5, '2025-07-17 01:37:29', '2025-07-17 01:37:29'),
(16, 4, 1, '2025-07-17 01:37:29', '2025-07-17 01:37:29'),
(17, 4, 2, '2025-07-17 01:37:29', '2025-07-17 01:37:29'),
(18, 4, 3, '2025-07-17 01:37:29', '2025-07-17 01:37:29'),
(19, 4, 4, '2025-07-17 01:37:29', '2025-07-17 01:37:29'),
(20, 4, 5, '2025-07-17 01:37:29', '2025-07-17 01:37:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resultados`
--

CREATE TABLE `resultados` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `cita_id` bigint(20) UNSIGNED NOT NULL,
  `encuesta_id` bigint(20) UNSIGNED NOT NULL,
  `pregunta_id` bigint(20) UNSIGNED NOT NULL,
  `respuesta_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2025-07-17 01:37:26', '2025-07-17 01:37:26'),
(2, 'Secretaria', 'web', '2025-07-17 01:37:26', '2025-07-17 01:37:26'),
(3, 'Agente', 'web', '2025-07-17 01:37:26', '2025-07-17 01:37:26'),
(4, 'Cliente', 'web', '2025-07-17 01:37:26', '2025-07-17 01:37:26'),
(5, 'Contador', 'web', '2025-07-17 01:37:26', '2025-07-17 01:37:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(3, 3),
(4, 1),
(4, 3),
(5, 1),
(5, 3),
(6, 1),
(7, 1),
(7, 3),
(8, 1),
(9, 1),
(10, 1),
(10, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `detail` text DEFAULT NULL,
  `worker` varchar(100) DEFAULT NULL,
  `description` text NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `price` decimal(10,5) NOT NULL DEFAULT 0.00000,
  `status` varchar(50) NOT NULL DEFAULT 'pendiente',
  `id_solicitud` bigint(20) UNSIGNED DEFAULT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `tipo_servicio` bigint(20) UNSIGNED DEFAULT NULL,
  `id_propiedad` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios_destalles`
--

CREATE TABLE `servicios_destalles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios_tipos`
--

CREATE TABLE `servicios_tipos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `detail` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
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
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('UO4xpzvkNVKmaos90VHOjMr2i6dDxsSU1PmUQtVL', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36 Edg/138.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMG1LV3VaTGx3MElIazBwZXFlU0RJbGNjYzdDRVFOdWptZWk5a1E4ZCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fX0=', 1752854826);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_servicios`
--

CREATE TABLE `solicitud_servicios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `detail` text DEFAULT NULL,
  `date` date NOT NULL,
  `date_end` date NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'pendiente',
  `description` text NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `tipo_servicio` bigint(20) UNSIGNED NOT NULL,
  `id_propiedad` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_propiedad`
--

CREATE TABLE `tipo_propiedad` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `detail` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_propiedad`
--

INSERT INTO `tipo_propiedad` (`id`, `name`, `detail`) VALUES
(1, 'Casa', 'Vivienda unifamiliar que ofrece espacios para vivir, como dormitorios, cocina y sala de estar.'),
(2, 'Departamento', 'Unidad habitacional ubicada dentro de un edificio que comparte áreas comunes.'),
(3, 'Local Comercial', 'Espacio destinado a actividades comerciales, como tiendas o restaurantes.'),
(4, 'Terreno', 'Extensión de tierra sin edificar, que puede ser utilizada para construcción futura.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_traspasos`
--

CREATE TABLE `tipo_traspasos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `detail` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_traspasos`
--

INSERT INTO `tipo_traspasos` (`id`, `name`, `detail`) VALUES
(1, 'Venta Directa', 'Transacción en la que el comprador adquiere la propiedad directamente del vendedor sin intermediarios.'),
(2, 'Venta en Contado', 'Transacción donde el comprador paga el total del precio de la propiedad al momento de la compra.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transaccions`
--

CREATE TABLE `transaccions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `propiedad` bigint(20) UNSIGNED NOT NULL,
  `comprador` bigint(20) UNSIGNED NOT NULL,
  `vendedor` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('Admin','Secretaria','Agente','Cliente','Contador') NOT NULL DEFAULT 'Cliente',
  `status` enum('activo','inactivo') NOT NULL DEFAULT 'activo',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `rol`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Rachel Starr', 'isa.veliz@gmail.com', NULL, '$2y$12$lXmLjshUGwfJJ4FcZJ8uaO1Xe/OeWbzeuBYdfG78SRn.hpIJnMwsy', 'Admin', 'activo', NULL, '2025-07-17 01:37:26', '2025-07-17 01:37:26'),
(2, 'Maria', 'maria@gmail.com', NULL, '$2y$12$B2UMrMfSoo7sYK08dTEf5exAEJnjafYzBRXnXZ7JdXY4eNElcjbM.', 'Admin', 'activo', NULL, '2025-07-17 01:37:26', '2025-07-17 01:37:26'),
(3, 'Karla', 'karla.rosa@gmail.com', NULL, '$2y$12$KUFZ2bzTSzs/TTG7zRfowuTmLtVCKJH/SKtD6p5OTZcg4KnnGNVDW', 'Secretaria', 'activo', NULL, '2025-07-17 01:37:26', '2025-07-17 01:37:26'),
(4, 'marcelo.llanos@gmail.com', 'marcelo.llanos@gmail.com', NULL, '$2y$12$M5f1n.tG1foq1LH9HweV.en1Eo95D34jknoQ9e0MzEWkqHjVkgbYS', 'Agente', 'activo', NULL, '2025-07-17 02:08:31', '2025-07-17 02:08:31'),
(5, 'julia.casa@gmail.com', 'julia.casa@gmail.com', NULL, '$2y$12$jN7UWVWQk.MxK0Jv8jE1wOLEnelLBZY/5YpU98IYkpPMZ/Xug56WO', 'Agente', 'activo', NULL, '2025-07-17 02:09:29', '2025-07-17 02:09:29'),
(6, 'gabriel.lopez@gmail.com', 'gabriel.lopez@gmail.com', NULL, '$2y$12$QXwjfkf1yk2lPwjVCY1P3uPpJebmNmdPyPCXHQISRK0/nwaAGMU96', 'Agente', 'activo', NULL, '2025-07-17 02:10:45', '2025-07-17 17:42:34'),
(7, 'romina.ramos@gmail.com', 'romina.ramos@gmail.com', NULL, '$2y$12$sgUIuFWgfhYHoMY20QmwtO2asbxXoUu6zTn78bVJWcU1mf9NM2XlW', 'Cliente', 'activo', NULL, '2025-07-17 17:42:14', '2025-07-17 17:42:14'),
(8, 'Heydi', 'heydi.perez@gmail.com', NULL, '$2y$12$3srwOVk65eYFpX9zf3uFGOpgYprUvax/rqOh1P6GotS6wg/3KHp96', 'Cliente', 'activo', NULL, '2025-07-17 17:58:32', '2025-07-17 17:58:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_cita_groups`
--

CREATE TABLE `user_cita_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `group` bigint(20) UNSIGNED NOT NULL,
  `propiedad` bigint(20) UNSIGNED NOT NULL,
  `usuario` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `user_cita_groups`
--

INSERT INTO `user_cita_groups` (`id`, `group`, `propiedad`, `usuario`, `created_at`, `updated_at`) VALUES
(1, 2, 3, 8, '2025-07-17 18:00:42', '2025-07-17 18:00:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitas`
--

CREATE TABLE `visitas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ip_visitante` varchar(255) DEFAULT NULL,
  `propiedad_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `visitas`
--

INSERT INTO `visitas` (`id`, `ip_visitante`, `propiedad_id`, `created_at`, `updated_at`) VALUES
(1, '127.0.0.1', 1, '2025-07-17 17:18:20', '2025-07-17 17:18:20'),
(2, '127.0.0.1', 2, '2025-07-17 17:29:02', '2025-07-17 17:29:02'),
(3, '127.0.0.1', 3, '2025-07-17 17:59:12', '2025-07-17 17:59:12'),
(4, '127.0.0.1', 2, '2025-07-18 01:32:41', '2025-07-18 01:32:41'),
(5, '127.0.0.1', 3, '2025-07-18 01:39:00', '2025-07-18 01:39:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `agentes`
--
ALTER TABLE `agentes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agentes_oficina_foreign` (`oficina`),
  ADD KEY `agentes_id_user_foreign` (`id_user`);

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `citas_propiedad_foreign` (`propiedad`),
  ADD KEY `citas_usuario_foreign` (`usuario`);

--
-- Indices de la tabla `cita_groups`
--
ALTER TABLE `cita_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cita_groups_propiedad_foreign` (`propiedad`),
  ADD KEY `cita_groups_agente_foreign` (`agente`);

--
-- Indices de la tabla `encuestas`
--
ALTER TABLE `encuestas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `hotspots`
--
ALTER TABLE `hotspots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hotspots_sceneid_foreign` (`sceneId`),
  ADD KEY `hotspots_targetscene_foreign` (`targetScene`),
  ADD KEY `hotspots_propiedad_id_foreign` (`propiedad_id`);

--
-- Indices de la tabla `imagen_servicios`
--
ALTER TABLE `imagen_servicios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `imagen_servicios_id_servicio_foreign` (`id_servicio`);

--
-- Indices de la tabla `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `images_propiedad_foreign` (`propiedad`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `oficinas`
--
ALTER TABLE `oficinas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personas_ci_unique` (`ci`),
  ADD KEY `personas_id_user_foreign` (`id_user`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `preguntas_encuesta_id_foreign` (`encuesta_id`);

--
-- Indices de la tabla `propiedades`
--
ALTER TABLE `propiedades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `propiedades_tipo_propiedad_foreign` (`tipo_propiedad`),
  ADD KEY `propiedades_tipo_traspaso_foreign` (`tipo_traspaso`),
  ADD KEY `propiedades_propietario_foreign` (`propietario`),
  ADD KEY `propiedades_id_user_foreign` (`id_user`);

--
-- Indices de la tabla `propietarios`
--
ALTER TABLE `propietarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `propietarios_ci_unique` (`ci`),
  ADD UNIQUE KEY `propietarios_email_unique` (`email`);

--
-- Indices de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `respuestas_seleccionadas`
--
ALTER TABLE `respuestas_seleccionadas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `respuestas_seleccionadas_pregunta_id_foreign` (`pregunta_id`),
  ADD KEY `respuestas_seleccionadas_respuesta_id_foreign` (`respuesta_id`);

--
-- Indices de la tabla `resultados`
--
ALTER TABLE `resultados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resultados_user_id_foreign` (`user_id`),
  ADD KEY `resultados_cita_id_foreign` (`cita_id`),
  ADD KEY `resultados_encuesta_id_foreign` (`encuesta_id`),
  ADD KEY `resultados_pregunta_id_foreign` (`pregunta_id`),
  ADD KEY `resultados_respuesta_id_foreign` (`respuesta_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `servicios_id_solicitud_foreign` (`id_solicitud`),
  ADD KEY `servicios_id_user_foreign` (`id_user`),
  ADD KEY `servicios_tipo_servicio_foreign` (`tipo_servicio`),
  ADD KEY `servicios_id_propiedad_foreign` (`id_propiedad`);

--
-- Indices de la tabla `servicios_destalles`
--
ALTER TABLE `servicios_destalles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `servicios_tipos`
--
ALTER TABLE `servicios_tipos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `solicitud_servicios`
--
ALTER TABLE `solicitud_servicios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `solicitud_servicios_id_user_foreign` (`id_user`),
  ADD KEY `solicitud_servicios_tipo_servicio_foreign` (`tipo_servicio`),
  ADD KEY `solicitud_servicios_id_propiedad_foreign` (`id_propiedad`);

--
-- Indices de la tabla `tipo_propiedad`
--
ALTER TABLE `tipo_propiedad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_traspasos`
--
ALTER TABLE `tipo_traspasos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `transaccions`
--
ALTER TABLE `transaccions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaccions_propiedad_foreign` (`propiedad`),
  ADD KEY `transaccions_comprador_foreign` (`comprador`),
  ADD KEY `transaccions_vendedor_foreign` (`vendedor`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `user_cita_groups`
--
ALTER TABLE `user_cita_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_cita_groups_group_foreign` (`group`),
  ADD KEY `user_cita_groups_propiedad_foreign` (`propiedad`),
  ADD KEY `user_cita_groups_usuario_foreign` (`usuario`);

--
-- Indices de la tabla `visitas`
--
ALTER TABLE `visitas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visitas_propiedad_id_foreign` (`propiedad_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `agentes`
--
ALTER TABLE `agentes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cita_groups`
--
ALTER TABLE `cita_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `encuestas`
--
ALTER TABLE `encuestas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `hotspots`
--
ALTER TABLE `hotspots`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `imagen_servicios`
--
ALTER TABLE `imagen_servicios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `oficinas`
--
ALTER TABLE `oficinas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `propiedades`
--
ALTER TABLE `propiedades`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `propietarios`
--
ALTER TABLE `propietarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `respuestas_seleccionadas`
--
ALTER TABLE `respuestas_seleccionadas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `resultados`
--
ALTER TABLE `resultados`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `servicios_destalles`
--
ALTER TABLE `servicios_destalles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `servicios_tipos`
--
ALTER TABLE `servicios_tipos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `solicitud_servicios`
--
ALTER TABLE `solicitud_servicios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_propiedad`
--
ALTER TABLE `tipo_propiedad`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipo_traspasos`
--
ALTER TABLE `tipo_traspasos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `transaccions`
--
ALTER TABLE `transaccions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `user_cita_groups`
--
ALTER TABLE `user_cita_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `visitas`
--
ALTER TABLE `visitas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `agentes`
--
ALTER TABLE `agentes`
  ADD CONSTRAINT `agentes_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `agentes_oficina_foreign` FOREIGN KEY (`oficina`) REFERENCES `oficinas` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_propiedad_foreign` FOREIGN KEY (`propiedad`) REFERENCES `propiedades` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `citas_usuario_foreign` FOREIGN KEY (`usuario`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `cita_groups`
--
ALTER TABLE `cita_groups`
  ADD CONSTRAINT `cita_groups_agente_foreign` FOREIGN KEY (`agente`) REFERENCES `agentes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cita_groups_propiedad_foreign` FOREIGN KEY (`propiedad`) REFERENCES `propiedades` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `hotspots`
--
ALTER TABLE `hotspots`
  ADD CONSTRAINT `hotspots_propiedad_id_foreign` FOREIGN KEY (`propiedad_id`) REFERENCES `propiedades` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hotspots_sceneid_foreign` FOREIGN KEY (`sceneId`) REFERENCES `images` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hotspots_targetscene_foreign` FOREIGN KEY (`targetScene`) REFERENCES `images` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `imagen_servicios`
--
ALTER TABLE `imagen_servicios`
  ADD CONSTRAINT `imagen_servicios_id_servicio_foreign` FOREIGN KEY (`id_servicio`) REFERENCES `servicios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_propiedad_foreign` FOREIGN KEY (`propiedad`) REFERENCES `propiedades` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `personas`
--
ALTER TABLE `personas`
  ADD CONSTRAINT `personas_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD CONSTRAINT `preguntas_encuesta_id_foreign` FOREIGN KEY (`encuesta_id`) REFERENCES `encuestas` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `propiedades`
--
ALTER TABLE `propiedades`
  ADD CONSTRAINT `propiedades_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `propiedades_propietario_foreign` FOREIGN KEY (`propietario`) REFERENCES `propietarios` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `propiedades_tipo_propiedad_foreign` FOREIGN KEY (`tipo_propiedad`) REFERENCES `tipo_propiedad` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `propiedades_tipo_traspaso_foreign` FOREIGN KEY (`tipo_traspaso`) REFERENCES `tipo_traspasos` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `respuestas_seleccionadas`
--
ALTER TABLE `respuestas_seleccionadas`
  ADD CONSTRAINT `respuestas_seleccionadas_pregunta_id_foreign` FOREIGN KEY (`pregunta_id`) REFERENCES `preguntas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `respuestas_seleccionadas_respuesta_id_foreign` FOREIGN KEY (`respuesta_id`) REFERENCES `respuestas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `resultados`
--
ALTER TABLE `resultados`
  ADD CONSTRAINT `resultados_cita_id_foreign` FOREIGN KEY (`cita_id`) REFERENCES `cita_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `resultados_encuesta_id_foreign` FOREIGN KEY (`encuesta_id`) REFERENCES `encuestas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `resultados_pregunta_id_foreign` FOREIGN KEY (`pregunta_id`) REFERENCES `preguntas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `resultados_respuesta_id_foreign` FOREIGN KEY (`respuesta_id`) REFERENCES `respuestas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `resultados_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD CONSTRAINT `servicios_id_propiedad_foreign` FOREIGN KEY (`id_propiedad`) REFERENCES `propiedades` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `servicios_id_solicitud_foreign` FOREIGN KEY (`id_solicitud`) REFERENCES `solicitud_servicios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `servicios_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `servicios_tipo_servicio_foreign` FOREIGN KEY (`tipo_servicio`) REFERENCES `servicios_tipos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `solicitud_servicios`
--
ALTER TABLE `solicitud_servicios`
  ADD CONSTRAINT `solicitud_servicios_id_propiedad_foreign` FOREIGN KEY (`id_propiedad`) REFERENCES `propiedades` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `solicitud_servicios_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `solicitud_servicios_tipo_servicio_foreign` FOREIGN KEY (`tipo_servicio`) REFERENCES `servicios_tipos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `transaccions`
--
ALTER TABLE `transaccions`
  ADD CONSTRAINT `transaccions_comprador_foreign` FOREIGN KEY (`comprador`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaccions_propiedad_foreign` FOREIGN KEY (`propiedad`) REFERENCES `propiedades` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaccions_vendedor_foreign` FOREIGN KEY (`vendedor`) REFERENCES `agentes` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `user_cita_groups`
--
ALTER TABLE `user_cita_groups`
  ADD CONSTRAINT `user_cita_groups_group_foreign` FOREIGN KEY (`group`) REFERENCES `cita_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_cita_groups_propiedad_foreign` FOREIGN KEY (`propiedad`) REFERENCES `propiedades` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_cita_groups_usuario_foreign` FOREIGN KEY (`usuario`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `visitas`
--
ALTER TABLE `visitas`
  ADD CONSTRAINT `visitas_propiedad_id_foreign` FOREIGN KEY (`propiedad_id`) REFERENCES `propiedades` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
