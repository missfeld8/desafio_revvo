<header class="navbar">
    <div class="logo">Missfeld</div>
    <input type="text" class="search-bar" placeholder="Pesquisar curso...">
    <div class="user-info">
        <span>Bem-vindo, <?= $_SESSION['name'] ?? 'Visitante'; ?></span>
        <img src="<?= $_SESSION['avatar'] ?? 'https://cdn.discordapp.com/attachments/1252674735662436453/1331455873545011200/image.png?ex=6791ae69&is=67905ce9&hm=5cebe944bc634e0fd09e841e8c8f679e1ad6b5f957f49ea0d9eeab7d41090d75&'; ?>" alt="Avatar" class="avatar">
        <a href="logout.php" class="btn-logout">Sair</a> 
    </div>
</header>
