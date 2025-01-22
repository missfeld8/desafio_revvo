<?php
require '../includes/session.php';
require '../includes/database.php';
checkLogin();

if ($_SESSION['role'] !== 'admin') {
    header('Location: dashboard.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image = $_POST['image'];

    $stmt = $pdo->prepare("INSERT INTO courses (title, description, image) VALUES (?, ?, ?)");
    $stmt->execute([$title, $description, $image]);
    header('Location: courses.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<?php include '../includes/header.php'; ?>
<body>
    <h2>Gerenciar Cursos</h2>
    <form method="POST">
        <input type="text" name="title" placeholder="Título do Curso" required>
        <textarea name="description" placeholder="Descrição" required></textarea>
        <input type="text" name="image" placeholder="URL da Imagem" required>
        <button type="submit" class="btn">Adicionar Curso</button>
    </form>
    <?php include '../includes/footer.php'; ?>
</body>
</html>
