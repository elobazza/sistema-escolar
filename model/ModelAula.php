<?php

/**
 * Classe de Modelo de Aula.
 * 
 * @author  Eloísa Bazzanella, Maria Eduarda Buzana
 * @package model
 * @sinse   29/12/2020
 */
class ModelAula {
    
    /** @var ModelDisciplinaProfessorTurma $disciplinaProfessorTurma */
    private $disciplinaProfessorTurma;
    
    private $codigo;
    private $horarioInicio;
    private $horarioFim;
    
    /**
     * @return ModelDisciplinaProfessorTurma
     */
    function getDisciplinaProfessorTurma() {
        if(empty($this->disciplinaProfessorTurma)) {
            $this->disciplinaProfessorTurma = new ModelDisciplinaProfessorTurma();
        }
        return $this->disciplinaProfessorTurma;
    }
    
    function getCodigo() {
        return $this->codigo;
    }

    function getHorarioInicio() {
        return $this->horarioInicio;
    }

    function getHorarioFim() {
        return $this->horarioFim;
    }
    
    function setDisciplinaProfessorTurma(ModelDisciplinaProfessorTurma $disciplinaProfessorTurma) {
        $this->disciplinaProfessorTurma = $disciplinaProfessorTurma;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setHorarioInicio($horarioInicio) {
        $this->horarioInicio = $horarioInicio;
    }

    function setHorarioFim($horarioFim) {
        $this->horarioFim = $horarioFim;
    }

}