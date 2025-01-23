<header class="navbar">
    <div class="logo">Missfeld</div>
    <input type="text" class="search-bar" placeholder="Pesquisar curso...">
    <div class="user-info">
        <?php if(isset($_SESSION['user_id'])): ?>
            <span>Bem-vindo, <?= $_SESSION['name']; ?></span>
            <img src="<?= $_SESSION['avatar']; ?>" alt="Avatar" class="avatar">
            <a href="logout.php" class="btn-logout">Sair</a>
        <?php else: ?>
            <a href="login.php" class="btn-logout">Login</a>
        <?php endif; ?>
    </div>
</header>
