<?php
// Incluindo o arquivo de configuração e as classes necessárias
require_once 'config.php';
require_once 'models/User.php';
require_once 'models/Course.php';
require_once 'controllers/DashboardController.php';

// Iniciando a sessão e verificando se o usuário está logado
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Criando uma instância do controller da dashboard
$dashboardController = new DashboardController();
$dashboardController->handleRequest();

// Atribuindo as variáveis para visualização
$user = $_SESSION['user'];
$courses = $dashboardController->getCourses();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Desafio Revvo</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="courses.php">Cursos</a></li>
                <li><a href="logout.php">Sair</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>Bem-vindo, <?php echo htmlspecialchars($user['name']); ?></h1>
        
        <!-- Modal que aparece uma vez após o login -->
        <?php if (!isset($_SESSION['modal_shown'])): ?>
            <div id="modal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <p>Bem-vindo à sua dashboard! Aproveite a plataforma.</p>
                </div>
            </div>
            <?php $_SESSION['modal_shown'] = true; ?>
        <?php endif; ?>

        <!-- Exibindo cursos -->
        <section class="courses">
            <h2>Cursos Disponíveis</h2>
            <ul>
                <?php foreach ($courses as $course): ?>
                    <li>
                        <a href="course_details.php?id=<?php echo $course['id']; ?>"><?php echo htmlspecialchars($course['name']); ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>

        <!-- Admin Section -->
        <?php if ($user['role'] == 'admin'): ?>
            <section class="admin">
                <h2>Área Administrativa</h2>
                <a href="add_course.php" class="btn">Adicionar Curso</a>
            </section>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2025 Desafio Revvo</p>
    </footer>

    <script src="js/scripts.js"></script>
</body>
</html>
