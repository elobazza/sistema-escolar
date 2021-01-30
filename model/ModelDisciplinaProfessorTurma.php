<?php

/**
 * Classe de Modelo de Disciplina/Professor/Turma.
 * 
 * @author  Eloísa Bazzanella, Maria Eduarda Buzana
 * @package model
 * @sinse   29/12/2020
 */
class ModelDisciplinaProfessorTurma {
    
    /** @var ModelDisciplina $disciplina */
    private $disciplina;
    
    /** @var ModelProfessor $professor */
    private $professor;
    
    /** @var ModelTurma $turma */
    private $turma;
    
    private $codigo;
        
    function getDisciplina() {
        if(empty($this->disciplina)) {
            $this->disciplina = new ModelDisciplina();
        }
        return $this->disciplina;
    }

    function getProfessor() {
        if(empty($this->professor)) {
            $this->professor = new ModelProfessor();
        }
        return $this->professor;
    }

    function getTurma() {
        if(empty($this->turma)) {
            $this->turma = new ModelTurma();
        }
        return $this->turma;
    }

    function getCodigo() {
        return $this->codigo;
    }

    function setDisciplina(ModelDisciplina $disciplina) {
        $this->disciplina = $disciplina;
    }

    function setProfessor(ModelProfessor $professor) {
        $this->professor = $professor;
    }

    function setTurma(ModelTurma $turma) {
        $this->turma = $turma;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }
    
}