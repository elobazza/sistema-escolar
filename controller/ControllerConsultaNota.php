<?php

/**
 * @author Eloísa Bazzanella e Maria Eduarda Buzana
 */
class ControllerConsultaNota extends ControllerPadrao {
    
    /** @var ModelNota $ModelNota */
    private $ModelNota;
    
    /** @var PersistenciaNota $PersistenciaNota */
    private $PersistenciaNota;
    
    /** @var ViewConsultaNota $ViewConsultaNota */
    private $ViewConsultaNota;
    
    function __construct() {
        $this->ModelNota        = new ModelNota();
        $this->PersistenciaNota = new PersistenciaNota();
        $this->ViewConsultaNota = new ViewConsultaNota();
    }

    public function processaExibir() {
       switch($_SESSION['tipo']) {
            case 1: 
                $this->ViewConsultaNota->setNotas($this->PersistenciaNota->listarRegistrosEscola());
                break;
            case 2: 
                $this->ViewConsultaNota->setNotas($this->PersistenciaNota->listarRegistrosProfessor());
                break;
            case 3: 
                break;            
        }
        $this->ViewConsultaNota->imprime();
    }

    public function processaInserir() {}
    public function processaAlterar() {}
    public function processaExcluir() {}

}