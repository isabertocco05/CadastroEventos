<!-- Verifica se está autenticado, se não, redireciona para a tela de login -->

<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require "../app/controllers/UserController.php";

$controller = new UserController();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: /app/views/login");
    exit;
}

header("Location: /");
exit;
