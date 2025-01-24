<?php
require '../models/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Verificar se o username já existe no banco de dados
    $stmtCheck = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
    $stmtCheck->execute([$username]);
    $usernameExists = $stmtCheck->fetchColumn() > 0;

    if ($usernameExists) {
        $error = "O nome de usuário já está em uso. Por favor, escolha outro.";
    } else {
        $avatar = 'https://media.discordapp.net/attachments/1252674735662436453/1331455873545011200/image.png?ex=67945169&is=6792ffe9&hm=13074abcbb90b6f6e5e1f9aa742fac8a4c3d4bdac19fbfe6a37ea0f0aa11394f&=&format=webp&quality=lossless&width=609&height=608'; 

        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
            $avatarFile = $_FILES['avatar'];

            $uploadDir = '../uploads/avatars/';
            $avatarFileName = time() . '_' . basename($avatarFile['name']);
            $uploadPath = $uploadDir . $avatarFileName;

            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (in_array($avatarFile['type'], $allowedTypes)) {
                if (move_uploaded_file($avatarFile['tmp_name'], $uploadPath)) {
                    $avatar = $uploadPath; 
                } else {
                    $error = 'Erro ao enviar a imagem!';
                }
            } else {
                $error = 'Formato de imagem inválido!';
            }
        }

        if (!isset($error)) {
            $stmt = $pdo->prepare("INSERT INTO users (name, username, password, avatar) VALUES (?, ?, ?, ?)");
            $stmt->execute([$name, $username, $password, $avatar]);

            header('Location: login.php');
            exit;
        }
    }
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
        <?php if (isset($error)): ?>
            <div class="error-message">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>
        <form action="register.php" method="POST" enctype="multipart/form-data" class="login-form">
            <input type="text" name="name" placeholder="Nome" required>
            <input type="text" name="username" placeholder="Usuário" required>
            <input type="password" name="password" placeholder="Senha" required>
            <input type="file" name="avatar" accept="image/*">

            <button type="submit" class="btn">Cadastrar</button>
        </form>
    </section>
</body>
</html>
