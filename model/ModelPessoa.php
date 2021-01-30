<?php

/**
 * Classe de Modelo de Pessoa.
 * 
 * @author  Eloísa Bazzanella, Maria Eduarda Buzana
 * @package model
 * @sinse   29/12/2020
 */
class ModelPessoa {
        
    /** @var ModelEscola $escola */
    private $escola;
        
    /** @var ModelUsuario $usuario */
    private $usuario;
    
    private $nome;
    private $cpf;
    private $data_nascimento;
    private $contato;
    
    /**
     * @return ModelEscola
     */
    function getEscola() {
        if(empty($this->escola)) {
            $this->escola = new ModelEscola();
        }
        return $this->escola;
    }

    /**
     * @return ModelUsuario
     */
    function getUsuario() {
        if(empty($this->usuario)) {
            $this->usuario = new ModelUsuario();
        }
        return $this->usuario;
    }

    function getNome() {
        return $this->nome;
    }

    function getCpf() {
        return $this->cpf;
    }

    function getData_nascimento() {
        return $this->data_nascimento;
    }

    function getContato() {
        return $this->contato;
    }

    function setEscola(ModelEscola $escola) {
        $this->escola = $escola;
    }

    function setUsuario(ModelUsuario $usuario) {
        $this->usuario = $usuario;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    function setData_nascimento($data_nascimento) {
        $this->data_nascimento = $data_nascimento;
    }

    function setContato($contato) {
        $this->contato = $contato;
    }
   
}