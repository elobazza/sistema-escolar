<?php

class ControllerLogin extends ControllerPadrao{ 
     /** @var ModelEscola $ModelEscola */
    private $ModelEscola;
    
    /** @var PersistenciaEscola $PersistenciaEscola */
    private $PersistenciaEscola;
    
    /** @var ViewLogin $ViewLogin */
    private $ViewLogin;
        
    function __construct() {
        $this->ModelEscola = new ModelEscola();
        $this->PersistenciaEscola = new PersistenciaEscola();
        $this->ViewLogin = new ViewLogin();
    }
    
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
            case 'logar';
                $this->processaLogar();
                break;
            default:
                $this->processaExibir();
                break;
        }
    }
    
    public function processaLogar() {
       
        if(Redirecionador::getParametro('nome') && Redirecionador::getParametro('senha')) {
            $xEscola = $this->PersistenciaEscola->selecionarLogin(Redirecionador::getParametro('nome'), Redirecionador::getParametro('senha'));
           
            if($xEscola){
                $_SESSION['id']   = $xEscola->getCodigo();
                $_SESSION['nome'] = $xEscola->getNome();
                $_SESSION['endereco'] = $xEscola->getEndereco();
                $_SESSION['contato'] = $xEscola->getContato();
                $_SESSION['login'] = $xEscola->getLogin();
               
                
                header('Location:index.php?pg=escola');
            }
            else {
                header('Location:index.php?pg=login');
            }
        }
    }
    
    public function processaAlterar() {
        
    }

    public function processaExcluir() {
        
    }

    public function processaExibir() {
        $this->ViewLogin->imprime();
    }

    public function processaInserir() {
        
    }
}