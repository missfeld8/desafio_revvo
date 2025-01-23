<?php
require '../includes/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image = $_FILES['image'];

    // Verificar se a imagem foi carregada
    if ($image['error'] === UPLOAD_ERR_OK) {
        $uploadsDir = '../uploads/';
        $imagePath = $uploadsDir . basename($image['name']);
        if (move_uploaded_file($image['tmp_name'], $imagePath)) {
            $stmt = $pdo->prepare("INSERT INTO courses (title, description, image, created_at, deleted_at) VALUES (:title, :description, :image, NOW(), NULL)");
            $stmt->execute([
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'image' => $imagePath, 
            ]);

            header('Location: dashboard.php');
            exit;
        } else {
            echo "Erro ao mover a imagem para o diretório de uploads.";
        }
    } else {
        echo "Erro ao carregar a imagem.";
    }
}
?>
