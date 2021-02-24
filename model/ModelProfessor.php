<?php

/**
 * Classe de Modelo de Professor.
 * 
 * @author  Eloísa Bazzanella, Maria Eduarda Buzana
 * @package model
 * @since   29/12/2020
 */
class ModelProfessor extends ModelPessoa {
    
    private $especialidade;
    private $salario;
    
    function getEspecialidade() {
        return $this->especialidade;
    }

    function getSalario() {
        return $this->salario;
    }

    function setEspecialidade($especialidade) {
        $this->especialidade = $especialidade;
    }

    function setSalario($salario) {
         $this->salario = $salario;
    }

}