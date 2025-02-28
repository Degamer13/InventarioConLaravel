-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 28-02-2025 a las 22:50:41
-- Versión del servidor: 8.0.30
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inventario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'charcuteria', '2025-02-28 04:28:06', '2025-02-28 04:28:06'),
(2, 'Alcohol', '2025-02-28 19:53:26', '2025-02-28 19:53:26'),
(3, 'Viveres', '2025-02-28 21:10:23', '2025-02-28 21:10:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `cedula` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `telefono` varchar(255) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `cedula`, `email`, `telefono`, `created_at`, `updated_at`) VALUES
(1, 'deivys gamarra', 'V28731970', 'gamarraynunezd@gmail.com', '04128726538', '2025-02-28 04:28:49', '2025-02-28 04:29:05'),
(2, 'andres gamarra', 'V28731968', 'andres@gmail.com', '04249493677', '2025-02-28 08:43:09', '2025-02-28 08:43:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id` bigint UNSIGNED NOT NULL,
  `producto_id` bigint UNSIGNED NOT NULL,
  `proveedor_id` bigint UNSIGNED NOT NULL,
  `categoria_id` bigint UNSIGNED NOT NULL,
  `unidad_medida` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `cantidad` int NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id`, `producto_id`, `proveedor_id`, `categoria_id`, `unidad_medida`, `cantidad`, `precio`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'docena', 12, 8.97, '2025-02-28 04:36:29', '2025-02-28 04:50:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dolares`
--

CREATE TABLE `dolares` (
  `id` bigint UNSIGNED NOT NULL,
  `dolar` decimal(10,2) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `dolares`
--

INSERT INTO `dolares` (`id`, `dolar`, `precio`, `created_at`, `updated_at`) VALUES
(1, 1.00, 64.24, '2025-02-28 05:00:38', '2025-02-28 05:00:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `connection` text COLLATE utf8mb4_spanish2_ci NOT NULL,
  `queue` text COLLATE utf8mb4_spanish2_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_spanish2_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_spanish2_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2025_02_22_005708_create_permission_tables', 1),
(7, '2025_02_22_050605_create_categorias_table', 1),
(8, '2025_02_22_050637_create_productos_table', 1),
(9, '2025_02_22_050657_create_clientes_table', 1),
(10, '2025_02_22_050726_create_proveedores_table', 1),
(11, '2025_02_27_005335_create_dolars_table', 1),
(12, '2025_02_27_225710_create_compras_table', 1),
(13, '2025_02_28_012338_create_ventas_table', 2),
(14, '2025_02_28_022550_create_ventas_table', 3),
(15, '2025_02_28_022631_create_producto_venta_table', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(1, 'App\\Models\\User', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'show-admin', 'web', '2025-02-28 04:23:22', '2025-02-28 04:23:22'),
(2, 'role-list', 'web', '2025-02-28 04:23:22', '2025-02-28 04:23:22'),
(3, 'role-show', 'web', '2025-02-28 04:23:23', '2025-02-28 04:23:23'),
(4, 'role-create', 'web', '2025-02-28 04:23:23', '2025-02-28 04:23:23'),
(5, 'role-edit', 'web', '2025-02-28 04:23:23', '2025-02-28 04:23:23'),
(6, 'role-delete', 'web', '2025-02-28 04:23:23', '2025-02-28 04:23:23'),
(7, 'user-list', 'web', '2025-02-28 04:23:23', '2025-02-28 04:23:23'),
(8, 'user-show', 'web', '2025-02-28 04:23:23', '2025-02-28 04:23:23'),
(9, 'user-create', 'web', '2025-02-28 04:23:23', '2025-02-28 04:23:23'),
(10, 'user-edit', 'web', '2025-02-28 04:23:23', '2025-02-28 04:23:23'),
(11, 'user-delete', 'web', '2025-02-28 04:23:23', '2025-02-28 04:23:23'),
(12, 'permission-list', 'web', '2025-02-28 04:23:23', '2025-02-28 04:23:23'),
(13, 'permission-show', 'web', '2025-02-28 04:23:23', '2025-02-28 04:23:23'),
(14, 'permission-create', 'web', '2025-02-28 04:23:23', '2025-02-28 04:23:23'),
(15, 'permission-edit', 'web', '2025-02-28 04:23:23', '2025-02-28 04:23:23'),
(16, 'permission-delete', 'web', '2025-02-28 04:23:23', '2025-02-28 04:23:23'),
(17, 'categoria-list', 'web', '2025-02-28 04:23:23', '2025-02-28 04:23:23'),
(18, 'categoria-show', 'web', '2025-02-28 04:23:23', '2025-02-28 04:23:23'),
(19, 'categoria-create', 'web', '2025-02-28 04:23:23', '2025-02-28 04:23:23'),
(20, 'categoria-edit', 'web', '2025-02-28 04:23:23', '2025-02-28 04:23:23'),
(21, 'categoria-delete', 'web', '2025-02-28 04:23:23', '2025-02-28 04:23:23'),
(22, 'producto-list', 'web', '2025-02-28 04:23:23', '2025-02-28 04:23:23'),
(23, 'producto-show', 'web', '2025-02-28 04:23:23', '2025-02-28 04:23:23'),
(24, 'producto-create', 'web', '2025-02-28 04:23:23', '2025-02-28 04:23:23'),
(25, 'producto-edit', 'web', '2025-02-28 04:23:23', '2025-02-28 04:23:23'),
(26, 'producto-delete', 'web', '2025-02-28 04:23:23', '2025-02-28 04:23:23'),
(27, 'cliente-list', 'web', '2025-02-28 04:23:23', '2025-02-28 04:23:23'),
(28, 'cliente-show', 'web', '2025-02-28 04:23:23', '2025-02-28 04:23:23'),
(29, 'cliente-create', 'web', '2025-02-28 04:23:23', '2025-02-28 04:23:23'),
(30, 'cliente-edit', 'web', '2025-02-28 04:23:23', '2025-02-28 04:23:23'),
(31, 'cliente-delete', 'web', '2025-02-28 04:23:23', '2025-02-28 04:23:23'),
(32, 'proveedor-list', 'web', '2025-02-28 04:23:24', '2025-02-28 04:23:24'),
(33, 'proveedor-show', 'web', '2025-02-28 04:23:24', '2025-02-28 04:23:24'),
(34, 'proveedor-create', 'web', '2025-02-28 04:23:24', '2025-02-28 04:23:24'),
(35, 'proveedor-edit', 'web', '2025-02-28 04:23:24', '2025-02-28 04:23:24'),
(36, 'proveedor-delete', 'web', '2025-02-28 04:23:24', '2025-02-28 04:23:24'),
(37, 'compra-list', 'web', '2025-02-28 04:23:24', '2025-02-28 04:23:24'),
(38, 'compra-show', 'web', '2025-02-28 04:23:24', '2025-02-28 04:23:24'),
(39, 'compra-create', 'web', '2025-02-28 04:23:24', '2025-02-28 04:23:24'),
(40, 'compra-edit', 'web', '2025-02-28 04:23:24', '2025-02-28 04:23:24'),
(41, 'compra-delete', 'web', '2025-02-28 04:23:24', '2025-02-28 04:23:24'),
(42, 'venta-list', 'web', '2025-02-28 04:23:24', '2025-02-28 04:23:24'),
(43, 'venta-show', 'web', '2025-02-28 04:23:24', '2025-02-28 04:23:24'),
(44, 'venta-create', 'web', '2025-02-28 04:23:24', '2025-02-28 04:23:24'),
(45, 'venta-edit', 'web', '2025-02-28 04:23:24', '2025-02-28 04:23:24'),
(46, 'venta-delete', 'web', '2025-02-28 04:23:24', '2025-02-28 04:23:24'),
(47, 'dolar-list', 'web', '2025-02-28 04:23:24', '2025-02-28 04:23:24'),
(48, 'dolar-show', 'web', '2025-02-28 04:23:24', '2025-02-28 04:23:24'),
(49, 'dolar-create', 'web', '2025-02-28 04:23:24', '2025-02-28 04:23:24'),
(50, 'dolar-edit', 'web', '2025-02-28 04:23:24', '2025-02-28 04:23:24'),
(51, 'dolar-delete', 'web', '2025-02-28 04:23:24', '2025-02-28 04:23:24'),
(52, 'total-venta', 'web', '2025-02-28 09:30:34', '2025-02-28 09:30:34'),
(53, 'total-compra', 'web', '2025-02-28 15:47:35', '2025-02-28 15:47:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_spanish2_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `ubicacion` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `categoria_id` bigint UNSIGNED NOT NULL,
  `marca` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  `precio_caja` decimal(10,2) DEFAULT NULL,
  `unidad_de_medida` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `cantidad_por_unidad` int NOT NULL,
  `cantidad` int NOT NULL,
  `proveedor_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `ubicacion`, `categoria_id`, `marca`, `precio_unitario`, `precio_caja`, `unidad_de_medida`, `cantidad_por_unidad`, `cantidad`, `proveedor_id`, `created_at`, `updated_at`) VALUES
(1, 'mortadela de pollo', 'bodega', 1, 'C.A Ebenezer', 1.00, 10.00, 'docena', 12, 1, 1, '2025-02-28 04:31:24', '2025-02-28 20:10:20'),
(2, 'huevo', 'bodega', 1, 'C.A Ebenezer', 0.20, 15.00, 'caja', 30, 47, 1, '2025-02-28 06:00:27', '2025-02-28 20:10:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_venta`
--

CREATE TABLE `producto_venta` (
  `venta_id` bigint UNSIGNED NOT NULL,
  `producto_id` bigint UNSIGNED NOT NULL,
  `cantidad` int NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `producto_venta`
--

INSERT INTO `producto_venta` (`venta_id`, `producto_id`, `cantidad`, `total`, `created_at`, `updated_at`) VALUES
(4, 2, 3, 0.60, '2025-02-28 07:07:36', '2025-02-28 07:07:36'),
(5, 1, 2, 2.00, '2025-02-28 09:28:57', '2025-02-28 09:28:57'),
(6, 1, 5, 5.00, '2025-02-28 09:34:05', '2025-02-28 09:34:05'),
(6, 2, 5, 1.00, '2025-02-28 09:34:05', '2025-02-28 09:34:05'),
(7, 1, 2, 2.00, '2025-02-28 09:59:28', '2025-02-28 10:22:09'),
(7, 2, 1, 0.20, '2025-02-28 09:59:28', '2025-02-28 10:22:09'),
(8, 2, 1, 0.20, '2025-02-28 06:28:56', '2025-02-28 06:28:56'),
(9, 1, 1, 1.00, '2025-02-28 07:28:34', '2025-02-28 07:28:34'),
(10, 1, 1, 1.00, '2025-02-28 20:10:20', '2025-02-28 20:10:20'),
(10, 2, 1, 0.20, '2025-02-28 20:10:20', '2025-02-28 20:10:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `cedula` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `telefono` varchar(255) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `nombre`, `cedula`, `email`, `telefono`, `created_at`, `updated_at`) VALUES
(1, 'C.A Ebenezer', 'J307636297', 'ebenezer@gmail.com', '04143869692', '2025-02-28 04:30:13', '2025-02-28 04:30:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2025-02-28 04:23:37', '2025-02-28 04:23:37'),
(2, 'ventas', 'web', '2025-02-28 08:19:11', '2025-02-28 08:19:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(22, 2),
(23, 2),
(27, 2),
(28, 2),
(29, 2),
(42, 2),
(43, 2),
(44, 2),
(47, 2),
(48, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$12$SNtEy7neIPH8nSo/NKE2JuZYFd1ruQvLwvxcFY.opUtBwaFpaj3EK', 'PIb5x9GmSwNQn2W18GmVbKMJYYl7hlrhE9IdH9h17x9E4udGllpyuzQSuiMg', '2025-02-28 04:23:37', '2025-02-28 17:08:55'),
(2, 'ventas', 'ventas@gmail.com', NULL, '$2y$12$tTcBtlU.NARJCcPhu/fdgOZC73PdYRa3XH8CV2oWFWPgCwFlLWg/W', 'JnqdFmQIkmEryq8dWY9dZapK0zmOFDHZZ4y08ngNmMsFE1vxil5wk3xvn2tC', '2025-02-28 08:20:49', '2025-02-28 08:20:49'),
(3, 'Deivys', 'gamarraynunezd@gmail.com', NULL, '$2y$12$9W26b6rbae73LbeM3ksVIeCMFy3DNm8KbUGoxwqfB0oRKrH6htdAS', NULL, '2025-02-28 19:45:41', '2025-02-28 19:45:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` bigint UNSIGNED NOT NULL,
  `cliente_id` bigint UNSIGNED NOT NULL,
  `total_dolares` decimal(10,2) NOT NULL,
  `total_bolivares` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `cliente_id`, `total_dolares`, `total_bolivares`, `created_at`, `updated_at`) VALUES
(4, 1, 0.60, 38.54, '2025-02-28 09:23:21', '2025-02-28 07:07:36'),
(5, 2, 2.00, 128.48, '2025-02-28 09:28:57', '2025-02-28 09:28:57'),
(6, 1, 6.00, 385.44, '2025-02-28 09:34:05', '2025-02-28 09:34:05'),
(7, 2, 2.20, 141.33, '2025-02-28 09:59:28', '2025-02-28 09:59:28'),
(8, 1, 0.20, 12.85, '2025-02-28 06:28:56', '2025-02-28 06:28:56'),
(9, 2, 1.00, 64.24, '2025-02-28 07:28:34', '2025-02-28 07:28:34'),
(10, 1, 1.20, 77.09, '2025-02-28 20:10:20', '2025-02-28 20:10:20');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clientes_email_unique` (`email`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `compras_producto_id_foreign` (`producto_id`),
  ADD KEY `compras_proveedor_id_foreign` (`proveedor_id`),
  ADD KEY `compras_categoria_id_foreign` (`categoria_id`);

--
-- Indices de la tabla `dolares`
--
ALTER TABLE `dolares`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

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
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productos_categoria_id_foreign` (`categoria_id`),
  ADD KEY `proveedor_id` (`proveedor_id`);

--
-- Indices de la tabla `producto_venta`
--
ALTER TABLE `producto_venta`
  ADD PRIMARY KEY (`venta_id`,`producto_id`),
  ADD KEY `producto_venta_producto_id_foreign` (`producto_id`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `proveedores_email_unique` (`email`);

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
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ventas_cliente_id_foreign` (`cliente_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `dolares`
--
ALTER TABLE `dolares`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `compras_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`),
  ADD CONSTRAINT `compras_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`),
  ADD CONSTRAINT `compras_proveedor_id_foreign` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores` (`id`);

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
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`),
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `producto_venta`
--
ALTER TABLE `producto_venta`
  ADD CONSTRAINT `producto_venta_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `producto_venta_venta_id_foreign` FOREIGN KEY (`venta_id`) REFERENCES `ventas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
