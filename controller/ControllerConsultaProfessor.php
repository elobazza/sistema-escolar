<?php
/**
 * @author Eloisa Bazzanella e Maria Eduarda Buzana
 */
class ControllerConsultaProfessor extends ControllerPadrao {
    
    /** @var ModelProfessor $ModelProfessor */
    private $ModelProfessor;
    
    /** @var PersistenciaProfessor $PersistenciaProfessor */
    private $PersistenciaProfessor;
    
    /** @var ViewConsultaProfessor $ViewConsultaProfessor */
    private $ViewConsultaProfessor;
    
    function __construct() {
        $this->ModelProfessor        = new ModelProfessor();
        $this->PersistenciaProfessor = new PersistenciaProfessor();
        $this->ViewConsultaProfessor = new ViewConsultaProfessor();
    }

    public function processaExibir() {
        if(Redirecionador::getParametro('indice') && Redirecionador::getParametro('valor')){
            $sIndice = Redirecionador::getParametro('indice');
            $sValor = Redirecionador::getParametro('valor'); 
            $this->ViewConsultaProfessor->setProfessores($this->PersistenciaProfessor->listarComFiltro($sIndice, $sValor));   
        } else {
            $this->ViewConsultaProfessor->setProfessores($this->PersistenciaProfessor->listarRegistros());
        }
        $this->ViewConsultaProfessor->imprime();
    }
    
    public function processaAlterar() {}
    public function processaExcluir() {}
    public function processaInserir() {}    
    
}