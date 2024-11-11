<!-- Verifica se está autenticado, se não, redireciona para a tela de login -->

<?php
session_start();
require "../app/controllers/MainController.php";

$controller = new MainController();

if (!isset($_SESSION['user_id'])) {
    header("Location: /login");
    exit;
}

header("Location: /");
exit;
