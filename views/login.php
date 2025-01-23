<?php
require '../includes/session.php';
require '../includes/database.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();

    // Verificar se o usuário existe e se a senha está correta
    if ($user) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id']; 
            $_SESSION['username'] = $user['username'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['role'] = $user['role']; 
            $_SESSION['avatar'] = $user['avatar']; 
            header('Location: dashboard.php');
            exit;
        } else {
            $error = 'Usuário ou senha inválidos!';
        }
    } else {
        $error = 'Usuário não encontrado!';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Teste Revvo</title>
    <link rel="stylesheet" href="../assets/css/login.css">
</head>
<body>
    <section class="login-container">
        <h1>Login - Desafio Revvo</h1>
        <?php if (isset($error)): ?>
            <p class="error"><?= $error; ?></p>
        <?php endif; ?>
        <form action="login.php" method="POST" class="login-form">
            <input type="text" name="username" placeholder="Usuário" required>
            <input type="password" name="password" placeholder="Senha" required>
            <button type="submit" class="btn">Entrar</button>
        </form>
        <p>Não tem uma conta? <a href="register.php">Registre-se</a></p>
    </section>
</body>
</html>
