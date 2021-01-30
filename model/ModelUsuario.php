<?php

/**
 * Classe de Modelo de Usuario.
 * 
 * @author  Eloísa Bazzanella, Maria Eduarda Buzana
 * @package model
 * @sinse   29/12/2020
 */
class ModelUsuario {
    
    private $codigo;
    private $login;
    private $senha;
    private $tipo;
    
    function getCodigo() {
        return $this->codigo;
    }

    function getLogin() {
        return $this->login;
    }

    function getSenha() {
        return $this->senha;
    }

    function getTipo() {
        return $this->tipo;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }
    
}