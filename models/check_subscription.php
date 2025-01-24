<?php
require 'database.php';
require 'session.php';

if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    echo json_encode(['isSubscribed' => false]);
    exit;
}

if (!isset($_GET['course_id'])) {
    http_response_code(400);
    echo json_encode(['isSubscribed' => false]);
    exit;
}

$courseId = $_GET['course_id'];
$userId = $_SESSION['user_id'];

$stmtCheckSubscription = $pdo->prepare("SELECT * FROM my_courses WHERE course_id = :course_id AND user_id = :user_id");
$stmtCheckSubscription->execute(['course_id' => $courseId, 'user_id' => $userId]);

$isSubscribed = $stmtCheckSubscription->fetch() !== false;
echo json_encode(['isSubscribed' => $isSubscribed]);
?>
