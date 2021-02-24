<?php

/**
 * Classe de Modelo de Turma.
 * 
 * @author  Eloísa Bazzanella, Maria Eduarda Buzana
 * @package model
 * @since   29/12/2020
 */
class ModelTurma {
    
    private $codigo;
    private $nome;
        
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
    
}