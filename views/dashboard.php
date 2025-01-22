<?php
require '../includes/session.php';
require '../includes/database.php';
checkLogin();

$stmt = $pdo->query("SELECT * FROM courses");
$courses = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<?php include '../includes/header.php'; ?>
<body>
    <section class="courses">
        <h2>Meus Cursos</h2>
        <div class="courses-grid">
            <?php foreach ($courses as $course): ?>
                <div class="course-card">
                    <img src="<?= $course['image']; ?>" alt="Imagem do Curso">
                    <h3><?= $course['title']; ?></h3>
                    <p><?= $course['description']; ?></p>
                    <button class="btn">Ver Curso</button>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <?php include '../includes/footer.php'; ?>
</body>
</html>
