<header class="navbar">
    <div class="logo">Missfeld</div>
    <form action="dashboard.php" method="GET">
        <input type="text" name="query" class="search-bar" placeholder="Pesquisar curso..." value="<?= isset($_GET['query']) ? htmlspecialchars($_GET['query']) : ''; ?>">
    </form>
    <div class="user-info">
        <?php if(isset($_SESSION['user_id'])): ?>
            <span>Bem-vindo, <?= $_SESSION['name']; ?></span>
            <img src="<?= $_SESSION['avatar']; ?>" alt="Avatar" class="avatar">
            <a href="../models/logout.php" class="btn-logout">Sair</a>
        <?php else: ?>
            <a href="login.php" class="btn-logout">Login</a>
        <?php endif; ?>
    </div>
</header>
