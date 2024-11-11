<?php 
class User {
    private $usuario;
    private $senha;
    private $admin;
    private $eventos_inscirtos;

    public function __construct($usuario, $senha, $admin = false, $eventos_inscirtos) {
        $this->usuario = $usuario;
        $this->senha = password_hash($senha, PASSWORD_BCRYPT);
        $this->admin = $admin;
        $this->eventos_inscirtos = $eventos_inscirtos;
    }

    public function login($inputUsuario, $inputSenha) {
        // implementar o metodo 
    }

    public function inscrever(Evento $evento) {
        if ($evento->isDisponivel()) {
            return $evento->addParticipante();
        }
        return false;
    }

    public function excluirEvento(Evento $evento) {
        if ($this->admin) {
            return $evento->excluir();
        }
        return false;
    }

    public function addEvento($hora, $local, $nome, $limite_insc) {
        if ($this->admin) {
            return new Evento($hora, $local, $nome, $limite_insc);
        }
        return null;
    }

}