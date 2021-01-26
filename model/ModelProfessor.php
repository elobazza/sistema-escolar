<?php

class ModelProfessor {
    private $codigo;
    private $nome;
    private $cpf;
    private $contato;
    private $especialidade;
    private $salario;
    /** @var ModelDisciplina */
    private $disciplina = [];
    private $escola;
    
    function getCodigo() {
        return $this->codigo;
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

     function getEspecialidade() {
        return $this->especialidade;
    }

     function getSalario() {
        return $this->salario;
    }

     function getDisciplina() {
        return $this->disciplina;
    }

     function getEscola() {
        return $this->escola;
    }

     function setCodigo($codigo) {
        $this->codigo = $codigo;
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

     function setEspecialidade($especialidade) {
        $this->especialidade = $especialidade;
    }

     function setSalario($salario) {
         $this->salario = $salario;
    }

     function setDisciplina(array $disciplina) {
        $this->disciplina = $disciplina;
    }

     function setEscola($escola) {
      $this->escola = $escola;
    }


}
