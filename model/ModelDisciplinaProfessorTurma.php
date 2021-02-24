<?php

/**
 * Classe de Modelo de Disciplina/Professor/Turma.
 * 
 * @author  Eloísa Bazzanella, Maria Eduarda Buzana
 * @package model
 * @since   29/12/2020
 */
class ModelDisciplinaProfessorTurma {
    
    /** @var ModelDisciplina $Disciplina */
    private $Disciplina;
    
    /** @var ModelProfessor $Professor */
    private $Professor;
    
    /** @var ModelTurma $Turma */
    private $turma;
    
    private $codigo;
        
    function getDisciplina() {
        if(empty($this->Disciplina)) {
            $this->Disciplina = new ModelDisciplina();
        }
        return $this->Disciplina;
    }

    function getProfessor() {
        if(empty($this->Professor)) {
            $this->Professor = new ModelProfessor();
        }
        return $this->Professor;
    }

    function getTurma() {
        if(empty($this->Turma)) {
            $this->Turma = new ModelTurma();
        }
        return $this->Turma;
    }

    function getCodigo() {
        return $this->codigo;
    }

    function setDisciplina(ModelDisciplina $Disciplina) {
        $this->Disciplina = $Disciplina;
    }

    function setProfessor(ModelProfessor $Professor) {
        $this->Professor = $Professor;
    }

    function setTurma(ModelTurma $Turma) {
        $this->Turma = $Turma;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }
    
}