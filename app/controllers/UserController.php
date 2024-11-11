<?php
session_start();
require_once "../app/models/User.php";

class UserController {
    private $model;

    public function __construct() {
        // Inicialize o modelo (ou banco de dados)
    }

    public function login() {
        $usuario = $_POST['usuario'];
        $senha = $_POST['senha'];

        $user = $this->model->getUser($usuario);
        if ($user->login($usuario, $senha)) {
            if ($user->isAdmin()) {
                header("Location: /admin/painel.php"); 
            } else {
                header("Location: /user/painel.php"); 
            }
            exit;
        } else {
            echo "Credenciais inválidas.";
        }
    }



    // public getEventos($user){

    // }
}
