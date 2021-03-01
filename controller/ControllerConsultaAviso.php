<?php
/**
 * @author Eloísa Bazzanella e Maria Eduarda Buzana
 */
class ControllerConsultaAviso extends ControllerPadrao {

    /** @var ModelAviso $ModelAviso */
    private $ModelAviso;
    
    /** @var PersistenciaAviso $PersistenciaAviso */
    private $PersistenciaAviso;
    
    /** @var ViewConsultaAviso $ViewConsultaAviso */
    private $ViewConsultaAviso;
    
    function __construct() {
        $this->ModelAviso        = new ModelAviso();
        $this->PersistenciaAviso = new PersistenciaAviso();
        $this->ViewConsultaAviso = new ViewConsultaAviso();
    }
    
    public function processaExibir() {
        $this->ViewConsultaAviso->setAvisos($this->PersistenciaAviso->listarRegistros());
        $this->ViewConsultaAviso->imprime();
    }

    public function processaInserir() {}
    public function processaAlterar() {}
    public function processaExcluir() {}

}
