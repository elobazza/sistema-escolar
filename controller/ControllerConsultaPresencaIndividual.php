<?php

class ControllerConsultaPresencaIndividual  extends ControllerPadrao {
    
    /** @var ModelPresenca $ModelPresenca */
    private $ModelPresenca;
    
    /** @var PersistenciaPresenca $PersistenciaPresenca */
    private $PersistenciaPresenca;
        
    /** @var ViewVisualizaPresenca $ViewVisualizaPresenca */
    private $ViewVisualizaPresenca;
    
    function __construct() {
        $this->ModelPresenca         = new ModelPresenca();
        $this->PersistenciaPresenca  = new PersistenciaPresenca();
        $this->ViewVisualizaPresenca = new ViewVisualizaPresencaAluno();
    }

    public function processaExibir() {            
        if(Redirecionador::getParametro('codigo')) {
           switch($_SESSION['tipo']) {
                case 1: 
                    break;
                case 2:
                    $this->ViewVisualizaPresenca->setPresencas($this->PersistenciaPresenca->listarPresencaAluno(21, Redirecionador::getParametro('codigo')));
                    break;
                case 3: 
                    break;            
            }
            $this->ViewVisualizaPresenca->imprime();
        } 
    }

    public function processaInserir() {}
    public function processaAlterar() {}
    public function processaExcluir() {}

}