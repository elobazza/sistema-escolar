<?php
/**
 * @author Eloisa Bazzanella e Maria Eduarda Buzana
 */
class ControllerConsultaTurma extends ControllerPadrao {
    
    /** @var ModelTurma $ModelTurma */
    private $ModelTurma;
    
    /** @var PersistenciaTurma $PersistenciaTurma */
    private $PersistenciaTurma;
    
    /** @var ViewConsultaTurma $ViewConsultaTurma */
    private $ViewConsultaTurma;
    
    function __construct() {
        $this->ModelTurma        = new ModelTurma();
        $this->PersistenciaTurma = new PersistenciaTurma();
        $this->ViewConsultaTurma = new ViewConsultaTurma();
    }

    public function processaExibir() {
        if(Redirecionador::getParametro('indice') && Redirecionador::getParametro('valor')){
            $sIndice = Redirecionador::getParametro('indice');
            $sValor = Redirecionador::getParametro('valor'); 
            $this->ViewConsultaTurma->setTurmas($this->PersistenciaTurma->listarComFiltro($sIndice, $sValor));   
        } else {
            $this->ViewConsultaTurma->setTurmas($this->PersistenciaTurma->listarRegistros());
        }
        $this->ViewConsultaTurma->imprime();
    }
    
    public function processaAlterar() {}
    public function processaExcluir() {}
    public function processaInserir() {}    
    
}