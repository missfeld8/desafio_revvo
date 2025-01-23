<?php
require 'database.php';
require 'session.php';

if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Você precisa estar logado para remover a inscrição no curso.']);
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

    $stmtDelete = $pdo->prepare("DELETE FROM my_courses WHERE course_id = :course_id AND user_id = :user_id");
    if ($stmtDelete->execute(['course_id' => $courseId, 'user_id' => $userId])) {
        echo json_encode(['success' => true, 'message' => 'Inscrição removida com sucesso.']);
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Erro ao remover a inscrição.']);
    }
    exit;
}

http_response_code(405);
echo json_encode(['success' => false, 'message' => 'Método não permitido.']);
?>
