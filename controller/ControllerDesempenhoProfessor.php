<?php

/**
 * @author Eloísa Bazzanella, Maria Eduarda Buzana
 */
class ControllerDesempenhoProfessor extends ControllerPadrao {
    
    /** @var ViewConsultaDesempenhoProfessor $ViewConsultaDesempenhoProfessor */
    private $ViewConsultaDesempenhoProfessor;
    
    /** @var ViewConsultaDesempenho $ViewConsultaDesempenho */
    private $ViewConsultaDesempenho;
    
    /** @var PersistenciaBoletim $PersistenciaBoletim */
    private $PersistenciaBoletim;
    
    /** @var PersistenciaProfessor $PersistenciaProfessor */
    private $PersistenciaProfessor;
    
    function __construct() {
        $this->ViewConsultaDesempenhoProfessor = new ViewConsultaDesempenhoProfessor();
        $this->ViewConsultaDesempenho = new ViewConsultaDesempenho();
        $this->PersistenciaBoletim    = new PersistenciaBoletim();
        $this->PersistenciaProfessor  = new PersistenciaProfessor();
    }
   
    public function processaExibir() {
        switch($_SESSION['tipo']) {
                case 1: 
                    if(empty(Redirecionador::getParametro('professor'))) {
                        $this->ViewConsultaDesempenho->setProfessores($this->PersistenciaProfessor->listarRegistros());
                        $this->ViewConsultaDesempenho->imprime();
                        
                    } else {
                        $this->ViewConsultaDesempenhoProfessor->setProfessor($this->PersistenciaProfessor->selecionar(Redirecionador::getParametro('professor')));
                        $this->ViewConsultaDesempenhoProfessor->setBoletins($this->PersistenciaBoletim->getDesempenhoProfessor(Redirecionador::getParametro('professor')));
                        $this->ViewConsultaDesempenhoProfessor->imprime();
                    }
                    break;
                case 2: 
                    $this->ViewConsultaDesempenhoProfessor->setProfessor($this->PersistenciaProfessor->selecionar($_SESSION['id']));
                    $this->ViewConsultaDesempenhoProfessor->setBoletins($this->PersistenciaBoletim->getDesempenhoProfessor($_SESSION['id']));
                    $this->ViewConsultaDesempenhoProfessor->imprime();
                    break;          
            }
    }

    public function processaInserir() {}
    public function processaAlterar() {}
    public function processaExcluir() {}
}
