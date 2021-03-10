<?php

class ControllerConsultaPresencaIndividual  extends ControllerPadrao {
    
    /** @var ModelPresenca $ModelPresenca */
    private $ModelPresenca;
    
    /** @var PersistenciaPresenca $PersistenciaPresenca */
    private $PersistenciaPresenca;
    
    /** @var PersistenciaAula $PersistenciaAula */
    private $PersistenciaAula;
        
    /** @var ViewVisualizaPresenca $ViewVisualizaPresenca */
    private $ViewVisualizaPresenca;
    
    function __construct() {
        $this->ModelPresenca         = new ModelPresenca();
        $this->PersistenciaPresenca  = new PersistenciaPresenca();
        $this->PersistenciaAula      = new PersistenciaAula();
        $this->ViewVisualizaPresenca = new ViewVisualizaPresencaAluno();
    }

    public function processaExibir() {            
        if(Redirecionador::getParametro('codigo')) {
            $aAulas = $this->PersistenciaAula->listarComFiltro('AULA.id_discproftur', Redirecionador::getParametro('discproftur'));
            if(count($aAulas) > 0) {
                $this->ViewVisualizaPresenca->setPresencas($this->PersistenciaPresenca->listarPresencaAluno($aAulas[0]->getCodigo(), Redirecionador::getParametro('codigo')));                        
            }  
            $this->ViewVisualizaPresenca->imprime();
        } 
    }

    public function processaInserir() {}
    public function processaAlterar() {}
    public function processaExcluir() {}

}