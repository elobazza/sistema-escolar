<?php

/**
 * Classe Controlador Tela Principal
 * 
 * @author Eloísa Bazzanella e Maria Eduarda Buzana
 */
class ControllerTelaPrincipal extends ControllerPadrao {
    
    /** @var ModelEscola $ModelEscola */
    private $ModelEscola;
    
    /** @var ViewTelaPrincipal $ViewTelaPrincipal */
    private $ViewTelaPrincipal;
    
    function __construct() {
        $this->ModelEscola = new ModelEscola();
        $this->ViewTelaPrincipal = new ViewTelaPrincipal();
    }

    
    public function processaExibir() {
       $this->ViewTelaPrincipal->imprime();
    }
    
    
    public function processaAlterar() {
    }

    public function processaExcluir() {
    }

    public function processaInserir() {
    }

}
