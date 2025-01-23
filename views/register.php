<?php
require '../includes/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $avatar = 'https://via.placeholder.com/150'; // Padrão para avatar

    // Inserir o novo usuário no banco
    $stmt = $pdo->prepare("INSERT INTO users (name, username, password, avatar) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $username, $password, $avatar]);

    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Teste Revvo</title>
    <link rel="stylesheet" href="../assets/css/login.css">
</head>
<body>
    <section class="login-container">
        <h1>Cadastro - Teste Revvo</h1>
        <form action="register.php" method="POST" class="login-form">
            <input type="text" name="name" placeholder="Nome" required>
            <input type="text" name="username" placeholder="Usuário" required>
            <input type="password" name="password" placeholder="Senha" required>
            <button type="submit" class="btn">Cadastrar</button>
        </form>
    </section>
</body>
</html>
