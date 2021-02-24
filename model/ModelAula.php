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
    private $diaSemana;
    
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

    function getDiaSemana() {
        switch($this->diaSemana) {
            case 1: return 'Segunda-Feira';
            case 2: return 'Terça-Feira';
            case 3: return 'Quarta-Feira';
            case 4: return 'Quinta-Feira';
            case 5: return 'Sexta-Feira';
        }
    }
    
    function getDiaSemanaValue() {
        return $this->diaSemana;
    }

    function setDiaSemana($diaSemana) {
        $this->diaSemana = $diaSemana;
    }
}