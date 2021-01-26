<?php

class ModelTurma {
    private $codigo;
    private $nome;
    
    /** @var array $disciplina */
    private $disciplina = [];
    
    function getCodigo() {
        return $this->codigo;
    }

    function getNome() {
        return $this->nome;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }
    
    function getDisciplina() {
        return $this->disciplina;
    }

    function setDisciplina(array $disciplina) {
        $this->disciplina = $disciplina;
    }
}