-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01/05/2025 às 02:13
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `fullstack`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `acao` varchar(255) NOT NULL,
  `data_hora` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `logs`
--

INSERT INTO `logs` (`id`, `usuario_id`, `acao`, `data_hora`) VALUES
(41, 1, 'Usuário efetuou logout', '2025-04-15 18:44:17'),
(42, 1, 'Login efetuado com sucesso', '2025-04-15 18:45:10'),
(43, 1, 'Usuário efetuou logout', '2025-04-15 18:45:18'),
(44, 1, 'Login efetuado com sucesso', '2025-04-15 18:46:14'),
(45, 1, 'Usuário efetuou logout', '2025-04-15 18:46:14'),
(46, 1, 'Login efetuado com sucesso', '2025-04-15 18:46:33'),
(47, 1, 'Usuário efetuou logout', '2025-04-15 18:46:33'),
(48, 1, 'Login efetuado com sucesso', '2025-04-15 18:47:33'),
(49, 1, 'Usuário efetuou logout', '2025-04-15 18:47:34'),
(50, 1, 'Login efetuado com sucesso', '2025-04-15 18:47:41'),
(51, 1, 'Usuário efetuou logout', '2025-04-15 18:48:22'),
(52, 1, 'Login efetuado com sucesso', '2025-04-15 18:48:30'),
(53, 1, 'Usuário efetuou logout', '2025-04-15 18:50:01'),
(54, 1, 'Login efetuado com sucesso', '2025-04-15 18:50:05'),
(55, 1, 'Usuário efetuou logout', '2025-04-15 18:50:06'),
(56, 0, 'Falha ao realizar o login, email ou senha', '2025-04-15 18:50:22'),
(57, 0, 'Falha ao realizar o login, email ou senha', '2025-04-15 18:52:47'),
(58, 1, 'Login efetuado com sucesso', '2025-04-15 18:53:02'),
(59, 1, 'Usuário efetuou logout', '2025-04-15 18:53:15'),
(60, 1, 'Login efetuado com sucesso', '2025-04-15 20:28:04'),
(61, 1, 'Usuário efetuou logout', '2025-04-15 20:28:31'),
(62, 0, 'Falha ao realizar o login, email ou senha', '2025-04-15 20:28:49'),
(63, 1, 'Login efetuado com sucesso', '2025-04-15 20:48:05'),
(64, 1, 'Usuário efetuou logout', '2025-04-15 20:52:12'),
(65, 1, 'Login efetuado com sucesso', '2025-04-15 20:52:24'),
(66, 1, 'Usuário efetuou logout', '2025-04-15 20:52:34'),
(67, 0, 'Falha ao realizar o login, email ou senha', '2025-04-15 20:58:53'),
(68, 1, 'Login efetuado com sucesso', '2025-04-15 20:59:00'),
(69, 1, 'Usuário efetuou logout', '2025-04-15 21:05:16'),
(70, 0, 'Falha ao realizar o login, email ou senha', '2025-04-15 21:05:21'),
(71, 0, 'Falha ao realizar o login, email ou senha', '2025-04-15 21:14:10'),
(72, 1, 'Login efetuado com sucesso', '2025-04-15 21:14:51'),
(73, 1, 'Usuário efetuou logout', '2025-04-15 21:16:06'),
(74, 1, 'Login efetuado com sucesso', '2025-04-15 21:30:06'),
(75, 1, 'Usuário efetuou logout', '2025-04-15 21:30:35'),
(76, 0, 'Falha ao realizar o login, email ou senha', '2025-04-15 21:30:52'),
(77, 0, 'Falha ao realizar o login, email ou senha', '2025-04-21 19:07:00'),
(78, 1, 'Login efetuado com sucesso', '2025-04-21 19:07:40'),
(79, 1, 'Usuário efetuou logout', '2025-04-21 19:09:58');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome_usuario` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome_usuario`, `email`, `senha`) VALUES
(1, 'Teste', 'teste@1', '123');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
