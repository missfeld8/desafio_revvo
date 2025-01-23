<?php
require 'database.php';
require 'session.php';

if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Você precisa estar logado para se inscrever no curso.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (!isset($data['course_id']) || empty($data['course_id'])) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'ID do curso não fornecido.']);
        exit;
    }

    $courseId = $data['course_id'];
    $userId = $_SESSION['user_id'];

    // Verificar se a inscrição já existe
    $stmtCheck = $pdo->prepare("SELECT * FROM my_courses WHERE course_id = :course_id AND user_id = :user_id");
    $stmtCheck->execute(['course_id' => $courseId, 'user_id' => $userId]);
    $existingSubscription = $stmtCheck->fetch();

    if ($existingSubscription) {
        echo json_encode(['success' => false, 'message' => 'Você já está inscrito neste curso.']);
        exit;
    }

    $stmt = $pdo->prepare("INSERT INTO my_courses (course_id, user_id) VALUES (:course_id, :user_id)");
    if ($stmt->execute(['course_id' => $courseId, 'user_id' => $userId])) {
        echo json_encode(['success' => true, 'message' => 'Inscrição realizada com sucesso.']);
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Erro ao realizar a inscrição.']);
    }
    exit;
}

http_response_code(405);
echo json_encode(['success' => false, 'message' => 'Método não permitido.']);
?>
