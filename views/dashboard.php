<?php 
require '../includes/session.php';
require '../includes/database.php';
checkLogin(); 

// Verificar se o usuário tem permissão de administrador
$isAdmin = $_SESSION['role'] === 'admin';

$stmt = $pdo->query("SELECT * FROM courses");
$courses = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <link rel="stylesheet" href="../assets/css/modal.css">
</head>
<?php include '../includes/header.php'; ?>
<body>
<section class="courses">
    <h2>Cursos</h2>

    <div class="courses-grid">
        <!-- Mostra os cursos existentes -->
        <?php foreach ($courses as $course): ?>
            <div class="course-card">
                <img src="<?= $course['image']; ?>" alt="Imagem do Curso" class="image">
                <h3><?= $course['title']; ?></h3>
                <p><?= strlen($course['description']) > 20 ? substr($course['description'], 0, 20) . '...' : $course['description']; ?></p>
                <button class="btn btn-open-view-course" 
                            data-course-id="<?= $course['id']; ?>"
                            data-course-title="<?= $course['title']; ?>"
                            data-course-description="<?= $course['description']; ?>"
                            data-course-image="<?= $course['image']; ?>">
                        Ver Curso
                </button>

            </div>
        <?php endforeach; ?>
        
        <!-- Adicionar curso -->
        <div class="add-course-card">
            <h3>Adicionar Novo Curso</h3>
            <button class="btn btn-open-add-course">Adicionar</button>
        </div>
    </div>
</section>

<!-- Modal de visualização do curso -->
<div id="viewCourseModalOverlay" class="modal-overlay hidden">
    <div class="modal">
        <div class="modal-header">
            <h3 id="courseTitle"></h3>
            <button class="close-modal-btn">X</button>
        </div>
        <div class="modal-body">
            <img id="courseImage" src="" alt="Imagem do Curso" style="width: 100%; border-radius: 10px; margin-bottom: 15px;">
            <div id="courseDescription" style="max-height: 400px; overflow-y: auto; padding-right: 15px;"></div> <
            <button class="btn">Inscreva-se</button>
        </div>
    </div>
</div>

<!-- Modal de adicionar curso -->
<div id="addCourseModalOverlay" class="modal-overlay hidden">
    <div class="modal">
        <div class="modal-header">
            <h3>Adicionar Novo Curso</h3>
            <button class="close-modal-btn">X</button>
        </div>
        <div class="modal-body">
            <form action="add_course.php" method="POST" enctype="multipart/form-data">
                <label for="title">Título do Curso</label>
                <input type="text" name="title" id="title" required>

                <label for="description">Descrição do Curso</label>
                <textarea name="description" id="description" required></textarea>

                <label for="image">Imagem do Curso</label>
                    <div class="file-input-container">
                        <input type="file" name="image" id="image" accept="image/*" required>
                        <span class="custom-file-btn" onclick="document.getElementById('image').click()">Clique aqui para adicionar imagem</span>
                    </div>
                    <div class="image-preview">
                        <img src="" alt="Pré-visualização da imagem" style="display: none;">
                        <span class="preview-text">Nenhuma imagem selecionada</span>
                    </div>

                <button type="submit" class="btn">Adicionar Curso</button>
            </form>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="../assets/js/modal.js"></script>
<script src="../assets/js/main.js"></script>

</body>
</html>
