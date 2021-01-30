<?php

class ControllerEscola extends ControllerPadrao{
    /** @var ModelEscola $ModelEscola */
    private $ModelEscola;
    
    /** @var PersistenciaEscola $PersistenciaEscola */
    private $PersistenciaEscola;
    
    /** @var ViewCadastroEscola $ViewCadastroEscola */
    private $ViewCadastroEscola;
    
    function __construct() {
        $this->ModelEscola        = new ModelEscola();
        $this->PersistenciaEscola = new PersistenciaEscola();
        $this->ViewCadastroEscola = new ViewCadastroEscola();
    }
    public function processaAlterar() {
        if(Redirecionador::getParametro('efetiva') == 1) {
            if(!empty(Redirecionador::getParametro('nome')) && !empty(Redirecionador::getParametro('endereco'))
            && !empty(Redirecionador::getParametro('contato')) && !empty(Redirecionador::getParametro('login'))
            && !empty(Redirecionador::getParametro('senha')) && !empty(Redirecionador::getParametro('cidade'))){
                $this->ModelEscola->setCodigo(Redirecionador::getParametro('codigo'));
                $this->ModelEscola->setNome(Redirecionador::getParametro('nome'));
                $this->ModelEscola->setEndereco(Redirecionador::getParametro('endereco'));
                $this->ModelEscola->setContato(Redirecionador::getParametro('contato'));
                $this->ModelEscola->setLogin(Redirecionador::getParametro('login'));
                $this->ModelEscola->setSenha(Redirecionador::getParametro('senha'));
                $this->ModelEscola->getCidade()->setCodigo(Redirecionador::getParametro('cidade'));

                $this->PersistenciaEscola->setModelEscola($this->ModelEscola);
                $this->PersistenciaEscola->alterarRegistro();
                header('Location:index.php?pg=escola');
            }
            $this->processaExibir();
        }
        else {
           $oEscola = $this->PersistenciaEscola->selecionar(Redirecionador::getParametro('codigo'));
           $this->ViewCadastroEscola->setEscola($oEscola);
           $this->ViewCadastroEscola->setAlterar(1);
           $this->processaExibir();
        }
    }

    public function processaExcluir() {
        $this->PersistenciaEscola->excluirRegistro(Redirecionador::getParametro('codigo'));
        header('Location:index.php?pg=escola');
        $this->processaExibir();
    }

    public function processaExibir() {
        $oPersistenciaCidade = new PersistenciaCidade();   
//        $this->ViewCadastroEscola->setCidades($oPersistenciaCidade->listarRegistros());
        if(Redirecionador::getParametro('indice') && Redirecionador::getParametro('valor')){
            $sIndice = Redirecionador::getParametro('indice');
            $sValor = Redirecionador::getParametro('valor'); 
            $this->ViewCadastroEscola->setEscolas($this->PersistenciaEscola->listarComFiltro($sIndice, $sValor));   
        } else {
            $this->ViewCadastroEscola->setEscolas($this->PersistenciaEscola->listarRegistros());
        }
        $this->ViewCadastroEscola->imprime();
    }

    public function processaInserir() {
        if(!empty(Redirecionador::getParametro('nome')) && !empty(Redirecionador::getParametro('endereco'))
        && !empty(Redirecionador::getParametro('contato')) && !empty(Redirecionador::getParametro('login'))
        && !empty(Redirecionador::getParametro('senha')) && !empty(Redirecionador::getParametro('cidade'))){
            
        
            $this->ModelEscola->setNome(Redirecionador::getParametro('nome'));
            $this->ModelEscola->setEndereco(Redirecionador::getParametro('endereco'));
            $this->ModelEscola->setContato(Redirecionador::getParametro('contato'));
            $this->ModelEscola->setLogin(Redirecionador::getParametro('login'));
            $this->ModelEscola->setSenha(Redirecionador::getParametro('senha'));
            $this->ModelEscola->getCidade()->setCodigo(Redirecionador::getParametro('cidade'));

            $this->PersistenciaEscola->setModelEscola($this->ModelEscola);
            $this->PersistenciaEscola->inserirRegistro();
        }
        $this->processaExibir();
    }

}
