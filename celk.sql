-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 18/06/2023 às 17:45
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `celk`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `failed_jobs`
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
-- Estrutura para tabela `machines`
--

CREATE TABLE `machines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(220) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `machines`
--

INSERT INTO `machines` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'trator', '2023-06-06 20:14:05', '2023-06-06 20:14:05'),
(2, 'colheitadeiras', '2023-06-06 20:14:05', '2023-06-06 20:14:05'),
(3, 'planteira', '2023-06-17 21:48:33', '2023-06-17 21:48:33'),
(4, 'planteira', '2023-06-17 21:50:45', '2023-06-17 21:50:45'),
(5, 'planteira v3', '2023-06-17 21:53:12', '2023-06-17 21:53:12'),
(6, 'planteira v2', '2023-06-17 22:03:20', '2023-06-17 22:03:20'),
(7, 'planteira v4', '2023-06-17 22:08:47', '2023-06-17 22:08:47'),
(8, 'planteira v5', '2023-06-17 22:22:13', '2023-06-17 22:22:13'),
(9, 'planteira v7', '2023-06-17 22:24:49', '2023-06-17 22:24:49'),
(10, 'planteira v8', '2023-06-17 22:25:36', '2023-06-17 22:25:36'),
(11, 'planteira v8', '2023-06-17 22:26:39', '2023-06-17 22:26:39');

-- --------------------------------------------------------

--
-- Estrutura para tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_06_17_195711_create_machines', 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `personal_access_tokens`
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
-- Estrutura para tabela `receptor`
--

CREATE TABLE `receptor` (
  `id_receptor` int(11) NOT NULL,
  `nome` varchar(220) NOT NULL,
  `motivo_transfusao` varchar(220) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `receptor`
--

INSERT INTO `receptor` (`id_receptor`, `nome`, `motivo_transfusao`, `usuario_id`) VALUES
(1, 'Ana', 'acidente de carro', 0),
(2, 'jone', 'leocemia', 0),
(3, 'mirene', 'complicacoes no parto', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `senha_usuario` varchar(230) NOT NULL,
  `telefone` int(11) DEFAULT NULL,
  `genero` varchar(30) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `cidade` varchar(30) DEFAULT NULL,
  `grupo_sanguineo` varchar(30) DEFAULT NULL,
  `codigo_autenticacao` int(11) DEFAULT NULL,
  `data_codigo_autenticacao` datetime DEFAULT NULL,
  `recuperar_senha` varchar(220) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `usuario`, `senha_usuario`, `telefone`, `genero`, `data_nascimento`, `cidade`, `grupo_sanguineo`, `codigo_autenticacao`, `data_codigo_autenticacao`, `recuperar_senha`) VALUES
(2, 'rosa', 'rosaduarte@gmail.com', '$2y$10$iraCwLENS1o.pgAvk0Z0KecPyOZoYN/OvgyMu25Kkwk1r4kNGpppa', 0, '', NULL, NULL, NULL, NULL, NULL, '$2y$10$gvEYXtwCOv/JAfTCjECob.feetXX/PQBSNttmknXEPZEm296vMlhy'),
(3, 'jose', 'jose@gmail.com', '$2y$10$wcoLQJ6.r8jIQ27rjj4jMuS9FcvALOewOAqjWEKxlzZUvYCN6tvJC', 0, '', NULL, NULL, NULL, NULL, NULL, ''),
(4, 'paula', 'paula@gmail', '$2y$10$h/.DWTW5suOZw5ocaaq2QOFmGtk29g0q1GZQbucUOEThuuPsETGQe', 0, '', NULL, NULL, NULL, 362932, '2023-06-13 20:29:03', ''),
(5, 'joao', 'joao@gmail.com', '$2y$10$B5i.3IFjRQ8/7tLBSPMz4OseRwaPi5EB4jqVPYBj7E83ELVexBF.i', 934567890, 'masculino', '0000-00-00', 'viana', 'nao_sei', NULL, NULL, 'NULL'),
(6, 'lany', 'lany@gmail.com', '$2y$10$fGcTtDzCPrn6V.oL8qGo8OWi1uy6jojZ8GNVrmQoURQzXZny83csu', 912334567, 'feminino', '1997-04-09', 'Kilamba Kiaxi', 'AB-', NULL, NULL, ''),
(7, '', '', '$2y$10$/HwBW/0qzXkJgGI4qXE9COBkRXZyJ8KVRcqCi9cf1XHwGbqVyllUi', 0, 'masculino', '1997-04-09', 'vvvv', '', NULL, NULL, ''),
(8, '', '', '$2y$10$g0AkpkwCNR1IauiuL52V2.3ujtRRCYACSJ3PwYce6o0apAoo8D2Ku', 0, 'feminino', '0000-00-00', 'nn', 'B-', NULL, NULL, ''),
(9, 'g', 'gg@gmail.', '$2y$10$khRBNZ0TkpjQwmUJssz9bO93o7j2lFIpIlni0EowhMbsaVfC9RqDC', 934567890, 'feminino', '1997-09-07', 'luanda', '', NULL, NULL, '');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Índices de tabela `machines`
--
ALTER TABLE `machines`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Índices de tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Índices de tabela `receptor`
--
ALTER TABLE `receptor`
  ADD PRIMARY KEY (`id_receptor`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `machines`
--
ALTER TABLE `machines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `receptor`
--
ALTER TABLE `receptor`
  MODIFY `id_receptor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
