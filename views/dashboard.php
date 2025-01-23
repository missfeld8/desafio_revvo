<?php
require '../models/database.php';
require '../models/session.php';

$query = isset($_GET['query']) ? $_GET['query'] : '';
$sliderCourses = [];
if (empty($query)) {
    $stmtSlider = $pdo->query("SELECT * FROM courses WHERE deleted_at IS NULL ORDER BY created_at DESC LIMIT 3");
    $sliderCourses = $stmtSlider->fetchAll();
}

if (!empty($query)) {
    $stmt = $pdo->prepare("SELECT * FROM courses WHERE (title LIKE :query OR description LIKE :query) AND deleted_at IS NULL LIMIT 50");
    $stmt->execute(['query' => '%' . $query . '%']);
} else {
    $stmt = $pdo->query("SELECT * FROM courses WHERE deleted_at IS NULL LIMIT 50");
}

$courses = $stmt->fetchAll();

// Se o usuário estiver logado, mostrar os cursos inscritos
$myCourses = [];
if (isset($_SESSION['user_id'])) {
    $stmtMyCourses = $pdo->prepare("SELECT courses.* FROM courses
                                    JOIN my_courses ON courses.id = my_courses.course_id
                                    WHERE my_courses.user_id = :user_id AND courses.deleted_at IS NULL");
    $stmtMyCourses->execute(['user_id' => $_SESSION['user_id']]);
    $myCourses = $stmtMyCourses->fetchAll();
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>
    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <link rel="stylesheet" href="../assets/css/modal.css">
</head>

<?php include '../views/header.php'; ?>

<body>
    <!-- Slider de Cursos -->
    <?php if (empty($query) && !empty($sliderCourses)): ?>
    <section class="slider-courses">
        <div class="slick-slider">
            <?php foreach ($sliderCourses as $course): ?>
                <div class="course-slide">
                    <img src="<?= htmlspecialchars($course['image']); ?>" alt="Imagem do Curso">
                    <h3><?= htmlspecialchars($course['title']); ?></h3>
                    <p><?= htmlspecialchars(substr($course['description'], 0, 100)) . '...'; ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- Exibir Cursos -->
    <section class="courses">
        <h2>Cursos</h2>

        <div class="courses-grid">
            <?php if (count($courses) > 0): ?>
                <?php foreach ($courses as $course): ?>
                    <div class="course-card">
                        <img src="<?= htmlspecialchars($course['image']); ?>" alt="Imagem do Curso" class="image">
                        <h3><?= htmlspecialchars($course['title']); ?></h3>
                        <p><?= strlen($course['description']) > 20 ? htmlspecialchars(substr($course['description'], 0, 20)) . '...' : htmlspecialchars($course['description']); ?></p>
                        <button class="btn btn-open-view-course" 
                            data-course-id="<?= htmlspecialchars($course['id']); ?>"
                            data-course-title="<?= htmlspecialchars($course['title']); ?>"
                            data-course-description="<?= htmlspecialchars($course['description']); ?>"
                            data-course-image="<?= htmlspecialchars($course['image']); ?>">
                        Ver Curso
                        </button>
                    </div>
                <?php endforeach; ?>
                 <!-- Adicionar curso -->
                 <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                    <div class="add-course-card">
                        <h3>Adicionar Novo Curso</h3>
                        <button class="btn btn-open-add-course">Adicionar</button>
                    </div>
                    <?php endif; ?>
            </div>
            <?php else: ?>
                <div class="text-center">
                    <p>Nenhum curso encontrado para a pesquisa "<?php echo htmlspecialchars($query); ?>"</p>
                    <dotlottie-player src="https://lottie.host/da9b628d-b117-4db6-a166-d5bf327094a3/pFfN5enX5J.lottie" background="transparent" speed="1" style="width: 300px; height: 300px" loop autoplay></dotlottie-player>
                </div>
            <?php endif; ?>



        </div>
    </section>

    <?php if (isset($_SESSION['user_id']) && empty($query)): ?>
            <section class="courses">
                <h2>Meus Cursos</h2>

                <div class="meus-cursos">
                    <?php if (count($myCourses) > 0): ?>
                        <div class="courses-grid">
                            <?php foreach ($myCourses as $course): ?>
                                <div class="course-card">
                                    <img src="<?= htmlspecialchars($course['image']); ?>" alt="Imagem do Curso" class="image">
                                    <h3><?= htmlspecialchars($course['title']); ?></h3>
                                    <p><?= strlen($course['description']) > 20 ? htmlspecialchars(substr($course['description'], 0, 20)) . '...' : htmlspecialchars($course['description']); ?></p>
                                    <button class="btn btn-open-view-course"
                                        data-course-id="<?= htmlspecialchars($course['id']); ?>"
                                        data-course-title="<?= htmlspecialchars($course['title']); ?>"
                                        data-course-description="<?= htmlspecialchars($course['description']); ?>"
                                        data-course-image="<?= htmlspecialchars($course['image']); ?>">
                                        Ver Curso
                                    </button>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p style="text-align: center;">Você ainda não está inscrito em nenhum curso.</p>
                        <div class="lottie-container" style="display: flex; justify-content: center;">
                            <dotlottie-player src="https://lottie.host/4cccc686-d710-4ddf-aae5-1a8c91d45233/7a33GiKx8o.lottie" background="transparent" speed="1" style="width: 300px; height: 300px" loop autoplay></dotlottie-player>
                        </div>
                    <?php endif; ?>
                </div>
            </section>
    <?php endif; ?>


            <!-- Modal de visualização do curso -->
        <div id="viewCourseModalOverlay" class="modal-overlay hidden">
            <div class="modal">
                <div class="modal-header">
                    <h3 id="courseTitle"></h3>
                    <button class="close-modal-btn">X</button>
                </div>
                <div class="modal-body">
                    <img id="courseImage" src="" alt="Imagem do Curso" style="width: 100%; border-radius: 10px; margin-bottom: 15px;">
                    <div id="courseDescription" style="max-height: 400px; overflow-y: auto; padding-right: 15px;"></div>
                    
                    <!-- Botão Inscrever-se/Desinscrever-se -->
                    <div class="btn-center">
                        <?php 
                        $isSubscribed = false;
                        if (isset($_SESSION['user_id'])) {
                            $userId = $_SESSION['user_id'];
                            $stmtCheckSubscription = $pdo->prepare("SELECT * FROM my_courses WHERE course_id = :course_id AND user_id = :user_id");
                            $stmtCheckSubscription->execute(['course_id' => $course['id'], 'user_id' => $userId]);
                            $isSubscribed = $stmtCheckSubscription->fetch() !== false;
                        }
                        ?>
                        <?php if ($isSubscribed): ?>
                            <button id="subscribeButton" class="btn" data-course-id="<?= htmlspecialchars($course['id']); ?>" data-subscribed="true">Desinscrever-se</button>
                        <?php else: ?>
                            <button id="subscribeButton" class="btn" data-course-id="<?= htmlspecialchars($course['id']); ?>" data-subscribed="false">Inscrever-se</button>
                        <?php endif; ?>
                    </div>

                    <!-- Funcionalidades de admin -->
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                        <div class="admin-options">
                            <button id="editCourseButton" class="btn btn-edit-course" data-course-id="<?= htmlspecialchars($course['id']); ?>" style="background: #ffa500;">Editar</button>
                            <button id="deleteCourseButton" class="btn btn-delete-course hidden" data-course-id="<?= htmlspecialchars($course['id']); ?>" style="background: #dc3545;">Excluir</button>
                        </div>
                    <?php endif; ?>
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
                    <form id="addCourseForm" action="../models/add_course.php" method="POST" enctype="multipart/form-data">
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

    <!-- Modal de edição de curso -->
        <div id="editCourseModalOverlay" class="modal-overlay hidden">
            <div class="modal">
                <div class="modal-header">
                    <h3>Editar Curso</h3>
                    <button class="close-modal-btn">X</button>
                </div>
                <div class="modal-body">
                    <form id="editCourseForm" action="../models/edit_course.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="course_id" id="edit-course-id" required>

                        <label for="edit-title">Título do Curso</label>
                        <input type="text" name="title" id="edit-title" required>

                        <label for="edit-description">Descrição do Curso</label>
                        <textarea name="description" id="edit-description" required></textarea>

                        <label for="edit-image">Imagem do Curso</label>
                        <div class="file-input-container">
                            <input type="file" name="image" id="edit-image" accept="image/*">
                            <span class="custom-file-btn" onclick="document.getElementById('edit-image').click()">Clique aqui para adicionar imagem</span>
                        </div>
                        <div class="image-preview">
                            <img id="edit-preview-image" src="" alt="Pré-visualização da imagem" style="display: none;">
                            <span class="preview-text">Nenhuma imagem selecionada</span>
                        </div>

                        <button type="submit" class="btn">Salvar Alterações</button>
                    </form>
                </div>
            </div>
        </div>


    <?php include '../views/footer.php'; ?>

    <!-- Scripts -->
    <script src="../assets/js/modal.js"></script>
    <script src="../assets/js/main.js"></script>
</body>
</html>
