<?php

/**
 * @author Eloísa Bazzanella e Maria Eduarda Buzana
 */
class ControllerConsultaPresenca extends ControllerPadrao {
    
    /** @var ModelPresenca $ModelPresenca */
    private $ModelPresenca;
    
    /** @var PersistenciaPresenca $PersistenciaPresenca */
    private $PersistenciaPresenca;
    
    /** @var ViewConsultaPresenca $ViewConsultaPresenca */
    private $ViewConsultaPresenca;
    
    function __construct() {
        $this->ModelPresenca        = new ModelPresenca();
        $this->PersistenciaPresenca = new PersistenciaPresenca();
        $this->ViewConsultaPresenca = new ViewConsultaPresenca();
    }

    public function processaExibir() {
       switch($_SESSION['tipo']) {
            case 1: 
                break;
            case 2: 
                $this->ViewConsultaPresenca->setPresencas($this->PersistenciaPresenca->listarRegistrosProfessor());
                break;
            case 3: 
                break;            
        }
        $this->ViewConsultaPresenca->imprime();
    }

    public function processaInserir() {}
    public function processaAlterar() {}
    public function processaExcluir() {}

}