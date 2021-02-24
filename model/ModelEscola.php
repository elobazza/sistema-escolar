<?php

/**
 * Classe de Modelo de Escola.
 * 
 * @author  Eloísa Bazzanella, Maria Eduarda Buzana
 * @package model
 * @since   29/12/2020
 */
class ModelEscola {
    
    /** @var ModelUsuario $Uuario */
    private $Usuario;
    
    /** @var ModelEndereco $Endereco */
    private $Endereco;
    
    private $nome;
    private $contato;
    
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

    function getContato() {
        return $this->contato;
    }

    function setUsuario(ModelUsuario $Usuario) {
        $this->Usuario = $Usuario;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setContato($contato) {
        $this->contato = $contato;
    }
    
    function getEndereco() {
        return $this->Endereco;
    }

    function setEndereco($Endereco) {
        $this->Endereco = $Endereco;
    }


    
}