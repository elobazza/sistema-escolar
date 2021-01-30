<?php

class ControllerLogin extends ControllerPadrao {
    
     /** @var ModelUsuario $ModelUsuario */
    private $ModelUsuario;
    
    /** @var PersistenciaUsuario $PersistenciaUsuario */
    private $PersistenciaUsuario;
    
    /** @var ViewLogin $ViewLogin */
    private $ViewLogin;
        
    function __construct() {
        $this->ModelUsuario = new ModelUsuario();
        $this->PersistenciaUsuario = new PersistenciaUsuario();
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
            $xUsuario = $this->PersistenciaUsuario->selecionarLogin(Redirecionador::getParametro('nome'), Redirecionador::getParametro('senha'));           
            if($xUsuario){
                $_SESSION['id']       = $xUsuario->getCodigo();
//                $_SESSION['nome']     = $xUsuario->getNome();
//                $_SESSION['endereco'] = $xUsuario->getEndereco();
//                $_SESSION['contato']  = $xUsuario->getContato();
                $_SESSION['login']    = $xUsuario->getLogin();
               
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