<?php
class Evento {
    private $nome;
    private $hora;
    private $local;
    private $limite_insc;
    private $disponibilidade;
    private $inscritos = 0;

    public function __construct($hora, $local, $nome, $limite_insc) {
        $this->hora = $hora;
        $this->local = $local;
        $this->nome = $nome;
        $this->limite_insc = $limite_insc;
        $this->disponibilidade = true;
    }

    public function isDisponivel() {
        return $this->disponibilidade && $this->inscritos < $this->limite_insc;
    }

    public function addParticipante() {
        if ($this->isDisponivel()) {
            $this->inscritos++;
            // Atualiza disponibilidade
            if ($this->inscritos >= $this->limite_insc) {
                $this->disponibilidade = false;
            }
            return true;
        }
        return false;
    }

    public function excluir() {
        $this->disponibilidade = false;
        return true;
    }
}
