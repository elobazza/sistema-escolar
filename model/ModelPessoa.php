<?php

/**
 * Classe de Modelo de Pessoa.
 * 
 * @author  Eloísa Bazzanella, Maria Eduarda Buzana
 * @package model
 * @since   29/12/2020
 */
class ModelPessoa {
        
    /** @var ModelEscola $Escola */
    private $Escola;
        
    /** @var ModelUsuario $Usuario */
    private $Usuario;
    
    private $nome;
    private $cpf;
    private $dataNascimento;
    private $contato;
    
    /**
     * @return ModelEscola
     */
    function getEscola() {
        if(empty($this->Escola)) {
            $this->Escola = new ModelEscola();
        }
        return $this->Escola;
    }

    /**
     * @return ModelUsuario
     */
    function getUsuario() {
        if(empty($this->Usuario)) {
            $this->Usuario = new ModelUsuario();
        }
        return $this->Usuario;
    }

    function getNome() {
        return $this->nome;
    }

    function getCpf() {
        return $this->cpf;
    }

    function getDataNascimento() {
        return $this->dataNascimento;
    }

    function getContato() {
        return $this->contato;
    }

    function setEscola(ModelEscola $Escola) {
        $this->Escola = $Escola;
    }

    function setUsuario(ModelUsuario $Usuario) {
        $this->Usuario = $Usuario;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    function setDataNascimento($dataNascimento) {
        $this->dataNascimento = $dataNascimento;
    }

    function setContato($contato) {
        $this->contato = $contato;
    }
   
}