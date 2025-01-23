<?php
require 'database.php';
require 'session.php';

if (!isset($_GET['course_id'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'ID do curso não fornecido.']);
    exit;
}

$courseId = $_GET['course_id'];

$stmt = $pdo->prepare("SELECT * FROM courses WHERE id = :id AND deleted_at IS NULL");
$stmt->execute(['id' => $courseId]);
$course = $stmt->fetch();

if ($course) {
    echo json_encode(['success' => true, 'course' => $course]);
} else {
    http_response_code(404);
    echo json_encode(['success' => false, 'message' => 'Curso não encontrado.']);
}
?>
