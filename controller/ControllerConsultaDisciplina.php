<?php
/**
 * @author Eloísa Bazzanella e Maria Eduarda Buzana
 */
class ControllerConsultaDisciplina extends ControllerPadrao {
    
    /** @var ModelDisciplina $ModelDisciplina */
    private $ModelDisciplina;
    
    /** @var PersistenciaDisciplina $PersistenciaDisciplina */
    private $PersistenciaDisciplina;
    
    /** @var ViewConsultaDisciplina $ViewConsultaDisciplina */
    private $ViewConsultaDisciplina;
    
    function __construct() {
        $this->ModelDisciplina        = new ModelDisciplina();
        $this->PersistenciaDisciplina = new PersistenciaDisciplina();
        $this->ViewConsultaDisciplina = new ViewConsultaDisciplina();
    }

    public function processaExibir() {
        if(Redirecionador::getParametro('indice') && Redirecionador::getParametro('valor')){
            $sIndice = Redirecionador::getParametro('indice');
            $sValor = Redirecionador::getParametro('valor'); 
            $this->ViewConsultaDisciplina->setDisciplinas($this->PersistenciaDisciplina->listarComFiltro($sIndice, $sValor));   
        } 
        else if(Redirecionador::getParametro('professor')) {
            $iCodigoProfessor = Redirecionador::getParametro('professor');            
            $this->ViewConsultaDisciplina->setDisciplinas($this->PersistenciaDisciplina->listarDisciplinasPorProfessor($iCodigoProfessor));   
        }
        else {
            $this->ViewConsultaDisciplina->setDisciplinas($this->PersistenciaDisciplina->listarRegistros());
        }
        $this->ViewConsultaDisciplina->imprime();
    }

    public function processaInserir() {}
    public function processaAlterar() {}
    public function processaExcluir() {}

}
