<?php

class ModelAluno {
    private $codigo;
    
    /** @var Turma $turma*/
    private $turma;
    
    private $nome;
    private $cpf;
    private $contato;
    
    function getCodigo() {
        return $this->codigo;
    }
    /**
     * 
     * @return ModelTurma
     */
    function getTurma() {
        if(empty($this->turma)) {
            $this->turma = new ModelTurma();
        }
        
        return $this->turma;
    }

    function getNome() {
        return $this->nome;
    }

    function getCpf() {
        return $this->cpf;
    }

    function getContato() {
        return $this->contato;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setTurma(ModelTurma $turma) {
        $this->turma = $turma;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    function setContato($contato) {
        $this->contato = $contato;
    }


    
}
