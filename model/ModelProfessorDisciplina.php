<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelProfessorDisciplina
 *
 * @author eloba
 */
class ModelProfessorDisciplina {
    private $codigo;
    /* @var ModelProfessor $codigoprof */
    private $professor;
    /* @var ModelDisciplina $codigodis */
    private $disciplina;
    
    function getCodigo() {
        return $this->codigo;
    }

    function getProfessor() {
        return $this->professor;
    }

    function getDisciplina() {
        return $this->disciplina;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setProfessor(ModelProfessor $professor) {
        $this->professor = $professor;
    }

    function setDisciplina(ModelDisciplina $disciplina) {
        $this->disciplina = $disciplina;
    }




    
}
