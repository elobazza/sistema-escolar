<?php

/**
 * @author Eloísa Bazzanella e Maria Eduarda Buzana
 */
class ControllerConsultaNota extends ControllerPadrao {
    
    /** @var ModelNota $ModelNota */
    private $ModelNota;
    
    /** @var PersistenciaNota $PersistenciaNota */
    private $PersistenciaNota;
    
    /** @var PersistenciaAluno $PersistenciaAluno */
    private $PersistenciaAluno;
    
    /** @var PersistenciaDisciplinaProfessorTurma $PersistenciaDisciplinaProfessorTurma */
    private $PersistenciaDisciplinaProfessorTurma;
    
    /** @var ViewConsultaNota $ViewConsultaNota */
    private $ViewConsultaNota;
    
    /** @var ViewConsultaNotaTurma $ViewConsultaNotaTurma */
    private $ViewConsultaNotaTurma;
    
    /** @var ViewConsultaNotaAluno $ViewConsultaNotaAluno */
    private $ViewConsultaNotaAluno;
    
    function __construct() {
        $this->ModelNota        = new ModelNota();
        $this->PersistenciaNota = new PersistenciaNota();
        $this->PersistenciaAluno = new PersistenciaAluno();
        $this->PersistenciaDisciplinaProfessorTurma = new PersistenciaDisciplinaProfessorTurma();
        $this->ViewConsultaNota = new ViewConsultaNota();
        $this->ViewConsultaNotaTurma = new ViewConsultaNotaTurma();
        $this->ViewConsultaNotaAluno = new ViewConsultaNotaAluno();
    }

    public function processaExibir() {
       switch($_SESSION['tipo']) {
            case 1: case 2:
                if(Redirecionador::getParametro('notaTurma')) {
                    $this->ViewConsultaNotaTurma->setAlunos($this->PersistenciaAluno->listarRegistros());
                    $this->ViewConsultaNotaTurma->setMedias($this->PersistenciaAluno->listarMediasPorAluno());
                    $this->ViewConsultaNotaTurma->setCodProfessorDisciplinaTurma(Redirecionador::getParametro('notaTurma'));
                    $this->ViewConsultaNotaTurma->imprime();
                } else if (Redirecionador::getParametro('notaAluno')) {
                    $this->ViewConsultaNotaAluno->setNotas($this->PersistenciaNota->listarNotasAluno(
                            Redirecionador::getParametro('turmaDisc'), Redirecionador::getParametro('notaAluno')
                    ));
                    $this->ViewConsultaNotaAluno->imprime();
                } else {
                    $this->ViewConsultaNota->setDisciplinaProfessorTurmas($this->PersistenciaDisciplinaProfessorTurma->listarRegistros());
                    $this->ViewConsultaNota->imprime();
                }
                break;
            case 3: 
                break;            
        }
    }

    public function processaInserir() {}
    public function processaAlterar() {}
    public function processaExcluir() {}

}