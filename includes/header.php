<header class="navbar">
    <div class="logo">Teste Revvo</div>
    <input type="text" class="search-bar" placeholder="Pesquisar curso...">
    <div class="user-info">
        <span>Bem-vindo, <?= $_SESSION['username'] ?? 'Visitante'; ?></span>
        <img src="https://via.placeholder.com/40" alt="Avatar" class="avatar">
    </div>
</header>
