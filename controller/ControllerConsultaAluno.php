<?php
/**
 * @author Eloisa Bazzanella e Maria Eduarda Buzana
 */
class ControllerConsultaAluno extends ControllerPadrao {
    
    /** @var ModelAluno $ModelAluno */
    private $ModelAluno;
    
    /** @var PersistenciaAluno $PersistenciaAluno */
    private $PersistenciaAluno;
    
    /** @var ViewConsultaAluno $ViewConsultaAluno */
    private $ViewConsultaAluno;
    
    function __construct() {
        $this->ModelAluno        = new ModelAluno();
        $this->PersistenciaAluno = new PersistenciaAluno();
        $this->ViewConsultaAluno = new ViewConsultaAluno();
    }

    public function processaExibir() {
//        $oPersistenciaTurma = new PersistenciaTurma();
        
//        $this->ViewConsultaAluno->setTurmas($oPersistenciaTurma->listarRegistros());
        if(Redirecionador::getParametro('indice') && Redirecionador::getParametro('valor')){
            $sIndice = Redirecionador::getParametro('indice');
            $sValor = Redirecionador::getParametro('valor'); 
            $this->ViewConsultaAluno->setAlunos($this->PersistenciaAluno->listarComFiltro($sIndice, $sValor));   
        } else {
            $this->ViewConsultaAluno->setAlunos($this->PersistenciaAluno->listarRegistros());
        }
        $this->ViewConsultaAluno->imprime();
    }
    
    public function processaAlterar() {
    }

    public function processaExcluir() {
    }

    public function processaInserir() {
    }

}
