<?php
session_start(); // Inicia a sessão

session_unset();

session_destroy();

header('Location: login.php');
exit;
?>
