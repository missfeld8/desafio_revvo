# Desafio Revvo

Este repositório contém o código do projeto **Desafio Revvo**. O objetivo deste desafio é desenvolver uma aplicação web para o gerenciamento de cursos, permitindo que os usuários possam se cadastrar, fazer login, editar cursos e se inscrever neles.

## Tecnologias Utilizadas

- **PHP**: Linguagem de programação principal para o backend.
- **MySQL**: Banco de dados para armazenar informações dos usuários e cursos.
- **HTML5**: Para o frontend, criando páginas dinâmicas e responsivas.
- **CSS3**: Estilização do layout e design da aplicação.
- **JavaScript**: Responsável por interatividade, como modais e validação de formulários.

## Funcionalidades

- **Cadastro de Usuário**: Usuários podem se registrar com nome, username, senha e avatar.
- **Login de Usuário**: Usuários podem acessar a plataforma utilizando seu username e senha.
- **Gestão de Cursos**: Admins podem criar, editar e excluir cursos.
- **Inscrição em Cursos**: Usuários podem se inscrever nos cursos disponíveis.
- **Modais**: Modal para visualização e edição de cursos.

## considerações finais

- Mateus Missfeld de Oliveira - Desenvolvedor Júnior
- Criei um projeto onde podemos criar contas e ver os cursos, inscrever com usuário comum (user)
- com o login admin e senha 123456 pode adicionar curso, remover curso e editar
- Fiz o soft delete para que nao seja removido do banco de dados
- Procurei entregar da melhor forma e com um pouco a mais de funcionalidades


## Como Rodar o Projeto

### Pré-requisitos

- PHP >= 7.4
- MySQL ou MariaDB
- **XAMPP**: Ferramenta para rodar o servidor web Apache e o banco de dados MySQL localmente

### Passos para Instalação

1. **Clone o repositório**:

    ```bash
    git clone https://github.com/missfeld8/desafio_revvo
    cd desafio-revvo
    ```

2. **Instale o XAMPP**:
   - Se você ainda não tem o XAMPP instalado, baixe e instale-o em [XAMPP](https://www.apachefriends.org/).
   - Abra o painel de controle do XAMPP e inicie o Apache (para o servidor web) e o MySQL (para o banco de dados).

3. **Configure o banco de dados**:
    - Abra o **phpMyAdmin** no seu navegador acessando `http://localhost/phpmyadmin/`.
    - Crie um banco de dados chamado `teste_revvo` (ou altere o nome no arquivo de configuração).
    - Execute o arquivo SQL de inicialização para criar as tabelas necessárias.
    - OBSERVAÇÃO - CRIAR PELO MENOS O USUÁRIO ADMIN COM O PRIVILÉGIO DE ADMIN COMO ESTA DESCRITO PARA PODER CRIAR CURSOS EDITAR E DELETAR.



    ```sql
    CREATE DATABASE teste_revvo;
        USE teste_revvo;

        CREATE TABLE `courses` (
        `id` int(11) NOT NULL,
        `title` varchar(100) NOT NULL,
        `description` text NOT NULL,
        `image` varchar(255) NOT NULL,
        `created_at` datetime DEFAULT NULL,
        `deleted_at` datetime DEFAULT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

        INSERT INTO `courses` (`id`, `title`, `description`, `image`, `created_at`, `deleted_at`) VALUES
        (1, 'Curso de HTML', 'Aprenda HTML do zero.', '../uploads/html.jpg', '2025-01-01 22:39:13', NULL),
        (2, 'Curso de CSS3', 'Estilize suas páginas web.', 'https://cdn.discordapp.com/attachments/1252674735662436453/1331422147913973781/css.jpeg?ex=67918f00&is=67903d80&hm=e277a35ed281c02a56c9fda2087823ae8ceabc15a76877bc01de7cfdaba965ce&', '2025-01-02 22:39:13', NULL),
        (3, 'Curso de PHP', 'Desenvolva aplicações dinâmicas.', 'https://cdn.discordapp.com/attachments/1252674735662436453/1331422148618883103/php.jpeg?ex=67918f00&is=67903d80&hm=88583998b771cc115338829d471f82a6a6b98cbb47008ea8ae84463e2e7140bd&', '2025-01-03 22:39:13', NULL),
        (4, 'Cursos de Flutter', 'Aprenda a criar aplicações em flutter ', '../uploads/60bb4a2e143f632da3e56aea_Flutter app development (2).png', '2025-01-04 22:39:13', NULL),
        (5, 'Curso de Node JS', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit...', '../uploads/nodejs.png', '2025-01-05 22:39:13', NULL),
        (6, 'Curso de C#', 'ddd', '../uploads/reflection-lights-mountain-lake-captured-parco-ciani-lugano-switzerland.jpg', '2025-01-06 22:39:13', NULL);

        CREATE TABLE `my_courses` (
        `id` int(11) NOT NULL,
        `course_id` int(11) NOT NULL,
        `user_id` int(11) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

        CREATE TABLE `users` (
        `id` int(11) NOT NULL,
        `avatar` varchar(255) DEFAULT NULL,
        `name` varchar(255) NOT NULL,
        `username` varchar(50) NOT NULL,
        `password` varchar(255) NOT NULL,
        `role` enum('admin','user') DEFAULT 'user'
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

        INSERT INTO `users` (`id`, `avatar`, `name`, `username`, `password`, `role`) VALUES
        (3, 'https://media.discordapp.net/attachments/1252674735662436453/1331455873545011200/image.png?ex=67945169&is=6792ffe9&hm=13074abcbb90b6f6e5e1f9aa742fac8a4c3d4bdac19fbfe6a37ea0f0aa11394f&=&format=webp&quality=lossless&width=609&height=608', 'Administrador', 'admin', '$2y$10$fN.IU2pyYowfxIZL.g1SdeqbfkF5M8hjRpxNa4WTri99uKUWyYsZu', 'admin');

        -- Índices para tabelas
        ALTER TABLE `courses` ADD PRIMARY KEY (`id`);
        ALTER TABLE `my_courses` ADD PRIMARY KEY (`id`);
        ALTER TABLE `users` ADD PRIMARY KEY (`id`);

        -- AUTO_INCREMENT
        ALTER TABLE `courses` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
        ALTER TABLE `my_courses` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
        ALTER TABLE `users` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
        COMMIT;
    ```

4. **Configuração do Banco de Dados**:
   No arquivo `models/database.php`, configure as credenciais de acesso ao banco de dados.

    ```php
    <?php
    // Configuração do banco de dados
    $host = 'localhost';
    $dbname = 'teste_revvo'; // nome do banco de dados
    $user = 'root';          // usuário do MySQL
    $password = '';          // senha do MySQL (se houver)

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Erro ao conectar ao banco de dados: " . $e->getMessage());
    }
    ?>
    ```

5. **Suba o servidor PHP**:

    Caso esteja usando o XAMPP, o servidor Apache já estará rodando, então basta acessar o projeto pelo navegador:

    ```bash
    http://localhost/desafio-revvo/
    ```

6. **OBRIGADO PELA OPORTUNIDADE**