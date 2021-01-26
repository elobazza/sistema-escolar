<?php
/**
 * Description of ControllerPadrao
 *
 * @author eloba
 */
abstract class ControllerPadrao {
    
    public function processa() {        
        switch (Redirecionador::getParametro('acao')) {
            case 'insere';
                $this->processaInserir();
                break;
            case 'altera';
                $this->processaAlterar();
                break;
            case 'exclui';
                $this->processaExcluir();
                break;
            default:
                $this->processaExibir();
                break;
        }
    }
    
    abstract function processaExibir();
    
    abstract function processaInserir();
    
    abstract function processaAlterar();
    
    abstract function processaExcluir();
}