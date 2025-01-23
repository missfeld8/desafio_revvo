<?php
require 'database.php';
require 'session.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Acesso negado.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;

    if (!isset($data['course_id']) || empty($data['course_id'])) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'ID do curso não fornecido.']);
        exit;
    }

    $courseId = $data['course_id'];
    $title = $data['title'];
    $description = $data['description'];

    // Verificar se uma nova imagem foi enviada
    $imageUpdated = false;
    if (!empty($_FILES['image']['name'])) {
        $targetDir = "../uploads/";
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $allowedTypes = array("jpg", "jpeg", "png", "gif");

        if (in_array($imageFileType, $allowedTypes)) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                $imageUpdated = true;
            } else {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => 'Erro ao fazer upload da imagem.']);
                exit;
            }
        } else {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Tipo de arquivo não suportado.']);
            exit;
        }
    }

    $stmt = $pdo->prepare("UPDATE courses SET title = :title, description = :description" . ($imageUpdated ? ", image = :image" : "") . " WHERE id = :id AND deleted_at IS NULL");
    $params = ['title' => $title, 'description' => $description, 'id' => $courseId];
    if ($imageUpdated) {
        $params['image'] = $targetFile;
    }

    if ($stmt->execute($params)) {
        echo json_encode(['success' => true, 'message' => 'Curso atualizado com sucesso.']);
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Erro ao atualizar o curso.']);
    }
    exit;
}

http_response_code(405);
echo json_encode(['success' => false, 'message' => 'Método não permitido.']);
?>
