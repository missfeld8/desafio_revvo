<?php
// index.php (Redirecionamento baseado no login)
session_start();

if (isset($_SESSION['user_id'])) {
    // Se o usuário estiver logado, redireciona para a dashboard
    header('Location: views/dashboard.php');
    exit;
} else {
    // Caso contrário, redireciona para a página de login
    header('Location: views/login.php');
    exit;
}
?>
