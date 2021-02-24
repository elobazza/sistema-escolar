<?php
/**
 * @author Eloisa Bazzanella e Maria Eduarda Buzana
 */
class ModelAula {
    
    /** @var ModelDisciplinaProfessorTurma $DisciplinaProfessorTurma */
    private $DisciplinaProfessorTurma;
    
    private $codigo;
    private $horarioInicio;
    private $horarioFim;
    
    /**
     * @return ModelDisciplinaProfessorTurma
     */
    function getDisciplinaProfessorTurma() {
        if(empty($this->DisciplinaProfessorTurma)) {
            $this->DisciplinaProfessorTurma = new ModelDisciplinaProfessorTurma();
        }
        return $this->DisciplinaProfessorTurma;
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
    
    function setDisciplinaProfessorTurma(ModelDisciplinaProfessorTurma $DisciplinaProfessorTurma) {
        $this->DisciplinaProfessorTurma = $DisciplinaProfessorTurma;
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