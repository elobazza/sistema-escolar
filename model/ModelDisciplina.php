<?php

/**
 * Classe de Modelo de Disciplina.
 * 
 * @author  Eloísa Bazzanella, Maria Eduarda Buzana
 * @package model
 * @since   29/12/2020
 */
class ModelDisciplina {
    
    private $codigo;
    private $nome;
    private $cargaHoraria;
    
    function getCodigo() {
        return $this->codigo;
    }

    function getNome() {
        return $this->nome;
    }

    function getCargaHoraria() {
        return $this->cargaHoraria;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setCargaHoraria($cargaHoraria) {
        $this->cargaHoraria = $cargaHoraria;
    }

}