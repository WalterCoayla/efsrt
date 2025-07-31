-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-07-2025 a las 04:12:50
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
-- Base de datos: `efsrt`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anexos_03`
--

CREATE TABLE `anexos_03` (
  `id` int(10) UNSIGNED NOT NULL,
  `nro_modulo` int(11) DEFAULT NULL,
  `fecha_desde` timestamp NULL DEFAULT NULL,
  `fecha_hasta` timestamp NULL DEFAULT NULL,
  `horario` varchar(50) DEFAULT NULL,
  `observaciones` varchar(4000) DEFAULT NULL,
  `pago_por` tinyint(4) DEFAULT NULL,
  `movilidad` tinyint(4) DEFAULT NULL,
  `otros` tinyint(4) DEFAULT NULL,
  `solo_EFSRT` tinyint(4) DEFAULT NULL,
  `idEmpresa` int(10) UNSIGNED DEFAULT NULL,
  `detalle_otros` varchar(120) DEFAULT NULL,
  `id_EFSRT` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anexos_04`
--

CREATE TABLE `anexos_04` (
  `id` int(10) UNSIGNED NOT NULL,
  `fecha_inicio` timestamp NULL DEFAULT NULL,
  `fecha_fin` timestamp NULL DEFAULT NULL,
  `problemas_detectados` varchar(4000) DEFAULT NULL,
  `observaciones` varchar(4000) DEFAULT NULL,
  `id_empresa` int(10) UNSIGNED DEFAULT NULL,
  `id_EFSRT` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anexos_05`
--

CREATE TABLE `anexos_05` (
  `id` int(10) UNSIGNED NOT NULL,
  `fecha_inicio` timestamp NULL DEFAULT NULL,
  `fecha_fin` timestamp NULL DEFAULT NULL,
  `total_horas` int(11) DEFAULT NULL,
  `idEmpresa` int(10) UNSIGNED DEFAULT NULL,
  `lugar_oficina` tinyint(4) DEFAULT NULL,
  `lugar_laboratorio` tinyint(4) DEFAULT NULL,
  `lugar_almacen` tinyint(4) DEFAULT NULL,
  `lugar_campo` tinyint(4) DEFAULT NULL,
  `lugar_otros` tinyint(4) DEFAULT NULL,
  `lugar_taller` tinyint(4) DEFAULT NULL,
  `detalle_otros` varchar(120) DEFAULT NULL,
  `horario` varchar(50) DEFAULT NULL,
  `tareas` varchar(4000) DEFAULT NULL,
  `total_puntaje` decimal(5,2) DEFAULT NULL,
  `fecha_anexo` timestamp NULL DEFAULT NULL,
  `lugar_anexo` varchar(50) DEFAULT NULL,
  `id_EFSRT` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE `cargos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cargos`
--

INSERT INTO `cargos` (`id`, `nombre`) VALUES
(1, 'Gerente'),
(2, 'Representante'),
(4, 'Promotor'),
(5, 'Jefe de Recursos Humanos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes`
--

CREATE TABLE `docentes` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_programa` int(10) UNSIGNED NOT NULL,
  `especialidad` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `docentes`
--

INSERT INTO `docentes` (`id`, `id_programa`, `especialidad`) VALUES
(1, 1, 'INGENIERO EN INFORMÁTICA Y SISTEMAS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `efsrt`
--

CREATE TABLE `efsrt` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_estudiante` int(10) UNSIGNED NOT NULL,
  `fecha_registro` date DEFAULT NULL,
  `id_modulo` int(10) UNSIGNED NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `id_docente_asesor` int(10) UNSIGNED DEFAULT NULL,
  `id_empresa` int(10) UNSIGNED NOT NULL,
  `id_semestre` int(10) UNSIGNED NOT NULL,
  `anexo3_PDF` varchar(200) DEFAULT NULL,
  `anexo4_PDF` varchar(200) DEFAULT NULL,
  `anexo5_PDF` varchar(200) DEFAULT NULL,
  `fecha_anexo3` timestamp NULL DEFAULT NULL,
  `fecha_anexo4` timestamp NULL DEFAULT NULL,
  `fecha_anexo5` timestamp NULL DEFAULT NULL,
  `codigo_tramite` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE `empresas` (
  `id` int(10) UNSIGNED NOT NULL,
  `razon_social` varchar(100) DEFAULT NULL,
  `direccion` varchar(150) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `rubro` varchar(200) DEFAULT NULL,
  `id_representante` int(10) UNSIGNED NOT NULL,
  `RUC` varchar(11) DEFAULT NULL,
  `es_activa` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes`
--

CREATE TABLE `estudiantes` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_programa` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Estructura de tabla para la tabla `indicadores_anexo`
--

CREATE TABLE `indicadores_anexo` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_anexo` int(10) UNSIGNED NOT NULL,
  `id_indicador` int(10) UNSIGNED NOT NULL,
  `calificacion` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `indicadores_evaluacion`
--

CREATE TABLE `indicadores_evaluacion` (
  `id` int(10) UNSIGNED NOT NULL,
  `item` int(11) DEFAULT NULL,
  `nombre` varchar(80) DEFAULT NULL,
  `id_tipo_indicador` int(10) UNSIGNED NOT NULL,
  `estado` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
--

CREATE TABLE `modulos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `horas` int(11) DEFAULT NULL,
  `creditos` int(11) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `id_plan` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombres` varchar(60) DEFAULT NULL,
  `apellidos` varchar(60) DEFAULT NULL,
  `dni` varchar(15) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `direccion` varchar(150) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  `usuario` varchar(20) DEFAULT NULL,
  `fecha_nacimiento` timestamp NULL DEFAULT NULL,
  `id_tipo_documento` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id`, `nombres`, `apellidos`, `dni`, `correo`, `direccion`, `telefono`, `password`, `usuario`, `fecha_nacimiento`, `id_tipo_documento`) VALUES
(1, 'Walter', 'Coayla', '04431751', 'walter.coayla@gmail.com', 'Asoc. José Olaya Ñ49', '990220266', NULL, '', '1973-05-31 03:22:36', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planes_estudio`
--

CREATE TABLE `planes_estudio` (
  `id` int(10) UNSIGNED NOT NULL,
  `anio` int(11) DEFAULT NULL,
  `activo` int(11) DEFAULT NULL,
  `id_programa` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programas_estudios`
--

CREATE TABLE `programas_estudios` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(80) DEFAULT NULL,
  `logo` varchar(50) DEFAULT NULL,
  `idTurno` int(10) UNSIGNED NOT NULL,
  `codigo` varchar(10) DEFAULT NULL,
  `abreviacion` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `programas_estudios`
--

INSERT INTO `programas_estudios` (`id`, `nombre`, `logo`, `idTurno`, `codigo`, `abreviacion`) VALUES
(1, 'ARQUITECTURA DE PLATAFORMAS Y SERVICIOS DE TECNOLOGÍAS DE INFORMACION', NULL, 2, 'P6', 'APSTI'),
(2, 'CONTABILIDAD', NULL, 2, NULL, 'CONTA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `representantes`
--

CREATE TABLE `representantes` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_cargo` int(10) UNSIGNED NOT NULL,
  `es_firmante` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `representantes`
--

INSERT INTO `representantes` (`id`, `id_cargo`, `es_firmante`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `semestres`
--

CREATE TABLE `semestres` (
  `id` int(10) UNSIGNED NOT NULL,
  `semestre` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `semestres`
--

INSERT INTO `semestres` (`id`, `semestre`) VALUES
(1, 'Primero'),
(2, 'Segundo'),
(3, 'Tercero'),
(4, 'Cuarto'),
(5, 'Quinto'),
(6, 'Sexto');

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
('4eE9h5JrwRk4cWkbIZxqzEMMpFMOTFeQXQSshUuH', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYjFnYnFZU2c2UUg1MTlmZDhoVjVvZkZOeTFqNmlqOWY1VGxxc0h2aCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fX0=', 1753927876);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_documentos`
--

CREATE TABLE `tipos_documentos` (
  `id` int(10) UNSIGNED NOT NULL,
  `tipo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipos_documentos`
--

INSERT INTO `tipos_documentos` (`id`, `tipo`) VALUES
(1, 'DNI'),
(2, 'CARNET EXTRANJERÍA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_indicadores`
--

CREATE TABLE `tipos_indicadores` (
  `id` int(10) UNSIGNED NOT NULL,
  `item` varchar(1) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turnos`
--

CREATE TABLE `turnos` (
  `id` int(10) UNSIGNED NOT NULL,
  `turno` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `turnos`
--

INSERT INTO `turnos` (`id`, `turno`) VALUES
(1, 'Mañana'),
(2, 'Tarde');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_persona` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `id_persona`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'Walter', 'walter.coayla@gmail.com', NULL, '$2y$12$ugPkuWKrmy81IAdjIrrvwenMaX/Yng2ZZJgLdU2GHJk7oUX636Ol2', NULL, '2025-07-29 07:39:52', '2025-07-29 07:39:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitas_anexo04`
--

CREATE TABLE `visitas_anexo04` (
  `id` int(10) UNSIGNED NOT NULL,
  `numero` int(11) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT NULL,
  `tareas` varchar(250) DEFAULT NULL,
  `porcentaje_avance` int(11) DEFAULT NULL,
  `idAnexo` int(10) UNSIGNED NOT NULL,
  `foto1` varchar(200) DEFAULT NULL,
  `foto2` varchar(200) DEFAULT NULL,
  `foto3` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `anexos_03`
--
ALTER TABLE `anexos_03`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_anexos_03_empresas` (`idEmpresa`),
  ADD KEY `fk_anexos_03_efsrt` (`id_EFSRT`);

--
-- Indices de la tabla `anexos_04`
--
ALTER TABLE `anexos_04`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_anexos_04_empresas` (`id_empresa`),
  ADD KEY `fk_anexos_04_efsrt` (`id_EFSRT`);

--
-- Indices de la tabla `anexos_05`
--
ALTER TABLE `anexos_05`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_anexos_05_empresas` (`idEmpresa`),
  ADD KEY `fk_anexos_05_efsrt` (`id_EFSRT`);

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
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_docentes_programas_estudios` (`id_programa`);

--
-- Indices de la tabla `efsrt`
--
ALTER TABLE `efsrt`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_efsrt_estudiantes` (`id_estudiante`),
  ADD KEY `fk_efsrt_modulos` (`id_modulo`),
  ADD KEY `fk_efsrt_docentes` (`id_docente_asesor`),
  ADD KEY `fk_efsrt_empresas` (`id_empresa`),
  ADD KEY `fk_efsrt_semestres` (`id_semestre`);

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_empresas_representantes` (`id_representante`);

--
-- Indices de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_estudiantes_programas_estudios` (`id_programa`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `indicadores_anexo`
--
ALTER TABLE `indicadores_anexo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_indicadores_anexo_anexos_05` (`id_anexo`),
  ADD KEY `fk_indicadores_anexo_indicadores_evaluacion` (`id_indicador`);

--
-- Indices de la tabla `indicadores_evaluacion`
--
ALTER TABLE `indicadores_evaluacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_indicadores_evaluacion_tipos_indicadores` (`id_tipo_indicador`);

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
-- Indices de la tabla `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_modulos_planes_estudio` (`id_plan`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_personas_tipos_documentos` (`id_tipo_documento`);

--
-- Indices de la tabla `planes_estudio`
--
ALTER TABLE `planes_estudio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_planes_estudio_programas_estudios` (`id_programa`);

--
-- Indices de la tabla `programas_estudios`
--
ALTER TABLE `programas_estudios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_programas_estudios_turnos` (`idTurno`);

--
-- Indices de la tabla `representantes`
--
ALTER TABLE `representantes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_representantes_cargos` (`id_cargo`);

--
-- Indices de la tabla `semestres`
--
ALTER TABLE `semestres`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `tipos_documentos`
--
ALTER TABLE `tipos_documentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipos_indicadores`
--
ALTER TABLE `tipos_indicadores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `turnos`
--
ALTER TABLE `turnos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `visitas_anexo04`
--
ALTER TABLE `visitas_anexo04`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_visitas_anexo04_anexos_04` (`idAnexo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `anexos_03`
--
ALTER TABLE `anexos_03`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `anexos_04`
--
ALTER TABLE `anexos_04`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `anexos_05`
--
ALTER TABLE `anexos_05`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `efsrt`
--
ALTER TABLE `efsrt`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `indicadores_anexo`
--
ALTER TABLE `indicadores_anexo`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `indicadores_evaluacion`
--
ALTER TABLE `indicadores_evaluacion`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `modulos`
--
ALTER TABLE `modulos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `planes_estudio`
--
ALTER TABLE `planes_estudio`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `programas_estudios`
--
ALTER TABLE `programas_estudios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `representantes`
--
ALTER TABLE `representantes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `semestres`
--
ALTER TABLE `semestres`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tipos_documentos`
--
ALTER TABLE `tipos_documentos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipos_indicadores`
--
ALTER TABLE `tipos_indicadores`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `turnos`
--
ALTER TABLE `turnos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `visitas_anexo04`
--
ALTER TABLE `visitas_anexo04`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `anexos_03`
--
ALTER TABLE `anexos_03`
  ADD CONSTRAINT `fk_anexos_03_efsrt` FOREIGN KEY (`id_EFSRT`) REFERENCES `efsrt` (`id`),
  ADD CONSTRAINT `fk_anexos_03_empresas` FOREIGN KEY (`idEmpresa`) REFERENCES `empresas` (`id`);

--
-- Filtros para la tabla `anexos_04`
--
ALTER TABLE `anexos_04`
  ADD CONSTRAINT `fk_anexos_04_efsrt` FOREIGN KEY (`id_EFSRT`) REFERENCES `efsrt` (`id`),
  ADD CONSTRAINT `fk_anexos_04_empresas` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id`);

--
-- Filtros para la tabla `anexos_05`
--
ALTER TABLE `anexos_05`
  ADD CONSTRAINT `fk_anexos_05_efsrt` FOREIGN KEY (`id_EFSRT`) REFERENCES `efsrt` (`id`),
  ADD CONSTRAINT `fk_anexos_05_empresas` FOREIGN KEY (`idEmpresa`) REFERENCES `empresas` (`id`);

--
-- Filtros para la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD CONSTRAINT `fk_docentes_personas` FOREIGN KEY (`id`) REFERENCES `personas` (`id`),
  ADD CONSTRAINT `fk_docentes_programas_estudios` FOREIGN KEY (`id_programa`) REFERENCES `programas_estudios` (`id`);

--
-- Filtros para la tabla `efsrt`
--
ALTER TABLE `efsrt`
  ADD CONSTRAINT `fk_efsrt_docentes` FOREIGN KEY (`id_docente_asesor`) REFERENCES `docentes` (`id`),
  ADD CONSTRAINT `fk_efsrt_empresas` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id`),
  ADD CONSTRAINT `fk_efsrt_estudiantes` FOREIGN KEY (`id_estudiante`) REFERENCES `estudiantes` (`id`),
  ADD CONSTRAINT `fk_efsrt_modulos` FOREIGN KEY (`id_modulo`) REFERENCES `modulos` (`id`),
  ADD CONSTRAINT `fk_efsrt_semestres` FOREIGN KEY (`id_semestre`) REFERENCES `semestres` (`id`);

--
-- Filtros para la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD CONSTRAINT `fk_empresas_representantes` FOREIGN KEY (`id_representante`) REFERENCES `representantes` (`id`);

--
-- Filtros para la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD CONSTRAINT `fk_estudiantes_personas` FOREIGN KEY (`id`) REFERENCES `personas` (`id`),
  ADD CONSTRAINT `fk_estudiantes_programas_estudios` FOREIGN KEY (`id_programa`) REFERENCES `programas_estudios` (`id`);

--
-- Filtros para la tabla `indicadores_anexo`
--
ALTER TABLE `indicadores_anexo`
  ADD CONSTRAINT `fk_indicadores_anexo_anexos_05` FOREIGN KEY (`id_anexo`) REFERENCES `anexos_05` (`id`),
  ADD CONSTRAINT `fk_indicadores_anexo_indicadores_evaluacion` FOREIGN KEY (`id_indicador`) REFERENCES `indicadores_evaluacion` (`id`);

--
-- Filtros para la tabla `indicadores_evaluacion`
--
ALTER TABLE `indicadores_evaluacion`
  ADD CONSTRAINT `fk_indicadores_evaluacion_tipos_indicadores` FOREIGN KEY (`id_tipo_indicador`) REFERENCES `tipos_indicadores` (`id`);

--
-- Filtros para la tabla `modulos`
--
ALTER TABLE `modulos`
  ADD CONSTRAINT `fk_modulos_planes_estudio` FOREIGN KEY (`id_plan`) REFERENCES `planes_estudio` (`id`);

--
-- Filtros para la tabla `personas`
--
ALTER TABLE `personas`
  ADD CONSTRAINT `fk_personas_tipos_documentos` FOREIGN KEY (`id_tipo_documento`) REFERENCES `tipos_documentos` (`id`);

--
-- Filtros para la tabla `planes_estudio`
--
ALTER TABLE `planes_estudio`
  ADD CONSTRAINT `fk_planes_estudio_programas_estudios` FOREIGN KEY (`id_programa`) REFERENCES `programas_estudios` (`id`);

--
-- Filtros para la tabla `programas_estudios`
--
ALTER TABLE `programas_estudios`
  ADD CONSTRAINT `fk_programas_estudios_turnos` FOREIGN KEY (`idTurno`) REFERENCES `turnos` (`id`);

--
-- Filtros para la tabla `representantes`
--
ALTER TABLE `representantes`
  ADD CONSTRAINT `fk_representantes_cargos` FOREIGN KEY (`id_cargo`) REFERENCES `cargos` (`id`),
  ADD CONSTRAINT `fk_representantes_personas` FOREIGN KEY (`id`) REFERENCES `personas` (`id`);

--
-- Filtros para la tabla `visitas_anexo04`
--
ALTER TABLE `visitas_anexo04`
  ADD CONSTRAINT `fk_visitas_anexo04_anexos_04` FOREIGN KEY (`idAnexo`) REFERENCES `anexos_04` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
