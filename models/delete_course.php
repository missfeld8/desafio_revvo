<?php
require 'database.php';
require 'session.php'; 

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    http_response_code(403); 
    echo json_encode(['success' => false, 'message' => 'Acesso negado.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (!isset($data['id']) || empty($data['id'])) {
        http_response_code(400); 
        echo json_encode(['success' => false, 'message' => 'ID do curso não fornecido.']);
        exit;
    }

    $courseId = $data['id'];

    $stmtCheck = $pdo->prepare("SELECT * FROM courses WHERE id = :id AND deleted_at IS NULL");
    $stmtCheck->execute(['id' => $courseId]);
    $course = $stmtCheck->fetch();

    if (!$course) {
        http_response_code(404); 
        echo json_encode(['success' => false, 'message' => 'Curso não encontrado ou já excluído.']);
        exit;
    }

    $stmtDelete = $pdo->prepare("UPDATE courses SET deleted_at = NOW() WHERE id = :id");
    if ($stmtDelete->execute(['id' => $courseId])) {
        echo json_encode(['success' => true, 'message' => 'Curso excluído com sucesso.']);
    } else {
        http_response_code(500); 
        echo json_encode(['success' => false, 'message' => 'Erro ao excluir o curso.']);
    }
    exit;
}

http_response_code(405);
echo json_encode(['success' => false, 'message' => 'Método não permitido.']);
?>
