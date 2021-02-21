<?php

/**
 * @author mduda
 */
class ControllerConsultaDisciplinaProfessorTurma extends ControllerPadrao {
    
    /** @var ModelDisciplinaProfessorTurma $ModelDiscProfTurma */
    private $ModelDiscProfTurma;
    
    /** @var PersistenciaDisciplinaProfessorTurma $PersistenciaDiscProfTurma */
    private $PersistenciaDiscProfTurma;
    
    /** @var ViewConsultaDisciplinaProfessorTurma $ViewConsultaDiscProfTurma */
    private $ViewConsultaDiscProfTurma;
    
    function __construct() {
        $this->ModelDiscProfTurma        = new ModelDisciplinaProfessorTurma();
        $this->PersistenciaDiscProfTurma = new PersistenciaDisciplinaProfessorTurma();
        $this->ViewConsultaDiscProfTurma = new ViewConsultaDisciplinaProfessorTurma();
    }

    public function processaExibir() {
        if(Redirecionador::getParametro('indice') && Redirecionador::getParametro('valor')){
            $sIndice = Redirecionador::getParametro('indice');
            $sValor = Redirecionador::getParametro('valor'); 
            $this->ViewConsultaDiscProfTurma->setDiscProfTurmas($this->PersistenciaDiscProfTurma->listarComFiltro($sIndice, $sValor));   
        } else {
            $this->ViewConsultaDiscProfTurma->setDiscProfTurmas($this->PersistenciaDiscProfTurma->listarRegistros());
        }
        $this->ViewConsultaDiscProfTurma->imprime();
    }

    public function processaInserir() {}
    public function processaAlterar() {}
    public function processaExcluir() {}

}