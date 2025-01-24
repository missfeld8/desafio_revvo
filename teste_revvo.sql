-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24/01/2025 às 07:32
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
-- Banco de dados: `teste_revvo`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `courses`
--

INSERT INTO `courses` (`id`, `title`, `description`, `image`, `created_at`, `deleted_at`) VALUES
(1, 'Curso de HTML', 'Aprenda HTML do zero.', '../uploads/html.jpg', '2025-01-01 22:39:13', NULL),
(2, 'Cutrso de CSS3', 'Estilize suas páginas web.', 'https://cdn.discordapp.com/attachments/1252674735662436453/1331422147913973781/css.jpeg?ex=67918f00&is=67903d80&hm=e277a35ed281c02a56c9fda2087823ae8ceabc15a76877bc01de7cfdaba965ce&', '2025-01-02 22:39:13', NULL),
(3, 'Curso de PHP', 'Desenvolva aplicações dinâmicas.', 'https://cdn.discordapp.com/attachments/1252674735662436453/1331422148618883103/php.jpeg?ex=67918f00&is=67903d80&hm=88583998b771cc115338829d471f82a6a6b98cbb47008ea8ae84463e2e7140bd&', '2025-01-03 22:39:13', NULL),
(4, 'Cursos de Flutter', 'Aprenda a criar aplicações em flutter ', '../uploads/60bb4a2e143f632da3e56aea_Flutter app development (2).png', '2025-01-04 22:39:13', NULL),
(5, 'Curso de Node JS', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed quis scelerisque arcu, ut mollis justo. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Vestibulum est sapien, vestibulum ac ipsum vehicula, ornare fringilla sem. Morbi euismod facilisis pretium. Cras facilisis nisi non elit consectetur porttitor. Nulla facilisi. Pellentesque et enim congue, sagittis neque non, lacinia sapien. Praesent at finibus sapien. Cras eget neque ut nibh rhoncus consectetur. Sed in cursus est. Proin nec nibh vel dolor volutpat aliquam a vel libero. Praesent a mi non risus volutpat luctus eu eget dolor. Nullam rutrum massa sodales lorem semper aliquam. Quisque eget elementum neque, eget iaculis ipsum. Etiam tellus justo, scelerisque in ultricies in, sodales in tellus. Proin dui nunc, pretium eu pretium vitae, consectetur a dui.\n\nEtiam interdum sapien ligula, eget sagittis lacus ullamcorper ac. Nunc dignissim ex ac iaculis luctus. Proin fermentum in sem sed dictum. Mauris vulputate eu odio sed sollicitudin. Fusce a tempor enim. Nam lobortis, quam et porttitor hendrerit, orci eros lacinia enim, quis maximus turpis tortor eget diam. Cras ut orci sagittis, lacinia felis eu, finibus ex. Curabitur gravida diam sit amet rhoncus rutrum. Cras fringilla imperdiet tempor. Pellentesque ornare ultrices sapien in ultrices. Fusce pharetra, ligula eu mollis tempus, nibh ante dapibus augue, id dictum lectus quam tempor dolor. Sed euismod tempor commodo. Aliquam scelerisque consequat pellentesque. Nam velit quam, convallis nec sapien ut, posuere feugiat massa. Donec ac semper justo, et vulputate dui. Pellentesque vitae tristique lectus.\n\nVivamus feugiat fringilla dignissim. Suspendisse scelerisque non dui eu consequat. Quisque pellentesque bibendum ante, at feugiat justo sollicitudin a. Fusce suscipit ultrices magna et hendrerit. Cras non rhoncus justo, et aliquam ante. Pellentesque elementum viverra ligula non aliquam. Duis tempus finibus porttitor. Nam molestie sollicitudin ipsum, quis scelerisque ex dictum a. Vestibulum nec eros blandit, dictum risus vel, ultrices magna. Aliquam a nibh et arcu feugiat pellentesque et quis mi. Suspendisse interdum, dui ut molestie congue, urna orci faucibus est, lobortis vestibulum tellus sem nec lorem. Proin suscipit ante in libero imperdiet aliquam. Maecenas ut felis non purus scelerisque luctus id a nisi.', '../uploads/nodejs.png', '2025-01-05 22:39:13', NULL),
(6, 'Curso de C#', 'ddd', '../uploads/reflection-lights-mountain-lake-captured-parco-ciani-lugano-switzerland.jpg', '2025-01-06 22:39:13', NULL),
(8, 'Curso de Unity', 'Curso de Desenvolvimento de Jogos com Unity\r\nAprenda a criar jogos incríveis e interativos com o Unity, uma das plataformas mais populares e poderosas do mercado. Neste curso, você vai dominar as principais ferramentas e conceitos da Unity, desde o desenvolvimento de 2D até 3D, explorando a criação de cenários, personagens, animações e scripts para dar vida às suas ideias.\r\n\r\nCom uma abordagem prática, você vai aprender a programar em C# e como aplicar essa linguagem para interagir com o motor gráfico da Unity, criando experiências de jogo envolventes e dinâmicas. Ao longo do curso, você terá acesso a projetos reais que podem ser utilizados para portfólio, além de aprender técnicas para otimização e publicação de jogos para diferentes plataformas.\r\n\r\nConteúdo do Curso:\r\n\r\nIntrodução ao Unity e ao ambiente de desenvolvimento\r\nProgramação em C# para Unity\r\nCriação e manipulação de objetos 3D e 2D\r\nAnimações e controle de personagens\r\nInteligência artificial básica para inimigos\r\nImplementação de física e colisões\r\nÁudio e efeitos visuais\r\nPreparação para publicação de jogos\r\nPré-requisitos: Nenhum! O curso é ideal tanto para iniciantes quanto para quem já tem alguma experiência em programação.\r\n\r\nObjetivo: Ao final do curso, você será capaz de criar e publicar seu próprio jogo, com habilidades para seguir no desenvolvimento de jogos de forma independente ou em equipe.', '../uploads/unity.png', '2025-01-22 23:14:14', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `my_courses`
--

CREATE TABLE `my_courses` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `avatar`, `name`, `username`, `password`, `role`) VALUES
(3, 'https://media.discordapp.net/attachments/1252674735662436453/1331455873545011200/image.png?ex=67945169&is=6792ffe9&hm=13074abcbb90b6f6e5e1f9aa742fac8a4c3d4bdac19fbfe6a37ea0f0aa11394f&=&format=webp&quality=lossless&width=609&height=608', 'Administrador', 'admin', '$2y$10$fN.IU2pyYowfxIZL.g1SdeqbfkF5M8hjRpxNa4WTri99uKUWyYsZu', 'admin');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `my_courses`
--
ALTER TABLE `my_courses`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `my_courses`
--
ALTER TABLE `my_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
