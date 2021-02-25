<?php

/**
 * @author Eloísa Bazzanella e Maria Eduarda Buzana
 */
class ControllerConsultaPresenca extends ControllerPadrao {
    
    /** @var ModelPresenca $ModelPresenca */
    private $ModelPresenca;
    
    /** @var PersistenciaPresenca $PersistenciaPresenca */
    private $PersistenciaPresenca;
    
    /** @var PersistenciaAluno $PersistenciaAluno */
    private $PersistenciaAluno;
    
    /** @var PersistenciaDisciplinaProfessorTurma $PersistenciaDisciplinaProfessorTurma */
    private $PersistenciaDisciplinaProfessorTurma;
    
    /** @var ViewConsultaPresenca $ViewConsultaPresenca */
    private $ViewConsultaPresenca;
    
    /** @var ViewVisualizaPresenca $ViewVisualizaPresenca */
    private $ViewVisualizaPresenca;
    
    function __construct() {
        $this->ModelPresenca        = new ModelPresenca();
        $this->PersistenciaPresenca = new PersistenciaPresenca();
        $this->PersistenciaAluno    = new PersistenciaAluno();
        $this->PersistenciaDisciplinaProfessorTurma = new PersistenciaDisciplinaProfessorTurma();
        $this->ViewConsultaPresenca = new ViewConsultaPresenca();
        $this->ViewVisualizaPresenca= new ViewVisualizaPresenca();
    }

    public function processaExibir() {            
        if(Redirecionador::getParametro('visu') == 1) {
           switch($_SESSION['tipo']) {
                case 1: 
                    break;
                case 2: 
                    $this->ViewVisualizaPresenca->setAlunos($this->PersistenciaAluno->getAlunosTurmaProfDisc(Redirecionador::getParametro('codigo')));
                    break;
                case 3: 
                    break;            
            }
            $this->ViewVisualizaPresenca->imprime();
        } else {
           switch($_SESSION['tipo']) {
                case 1: 
                    break;
                case 2: 
                    $this->ViewConsultaPresenca->setDisciplinaProfessorTurmas($this->PersistenciaDisciplinaProfessorTurma->listarRegistros());
                    break;
                case 3: 
                    break;            
            }
            $this->ViewConsultaPresenca->imprime();
        }
    }

    public function processaInserir() {}
    public function processaAlterar() {}
    public function processaExcluir() {}

}