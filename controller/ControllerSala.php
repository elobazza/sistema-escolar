<?php


class ControllerSala extends ControllerPadrao {
    /** @var ModelSala $ModelSala */
    private $ModelSala;
    
    /** @var PersistenciaSala $PersistenciaSala */
    private $PersistenciaSala;
    
    /** @var ViewCadastroSala $ViewCadastroSala */
    private $ViewCadastroSala;
    
    function __construct() {
        $this->ModelSala        = new ModelSala();
        $this->PersistenciaSala = new PersistenciaSala();
        $this->ViewCadastroSala = new ViewCadastroSala();
    }
    
    public function processaAlterar() {
         if(Redirecionador::getParametro('efetiva') == 1) {
             if(!empty(Redirecionador::getParametro('descricao')) && !empty(Redirecionador::getParametro('escola'))){
                $this->ModelSala->setCodigo(Redirecionador::getParametro('codigo'));
                $this->ModelSala->setDescricao(Redirecionador::getParametro('descricao'));
                $this->ModelSala->getEscola()->setCodigo(Redirecionador::getParametro('escola'));

                $this->PersistenciaSala->setModelSala($this->ModelSala);
                $this->PersistenciaSala->alterarRegistro();
                header('Location:index.php?pg=sala');
             }
            $this->processaExibir();
        }
        else {
           $oSala = $this->PersistenciaSala->selecionar(Redirecionador::getParametro('codigo'));
           $this->ViewCadastroSala->setSala($oSala);
           $this->ViewCadastroSala->setAlterar(1);
           $this->processaExibir();
        }
    }

    public function processaExcluir() {
        $this->PersistenciaSala->excluirRegistro(Redirecionador::getParametro('codigo'));
        header('Location:index.php?pg=sala');
        $this->processaExibir();
    }

    public function processaExibir() {
        $oPersistenciaEscola = new PersistenciaEscola();
        
        $this->ViewCadastroSala->setEscolas($oPersistenciaEscola->listarRegistros());
        
        if(Redirecionador::getParametro('indice') && Redirecionador::getParametro('valor')){
            $sIndice = Redirecionador::getParametro('indice');
            $sValor = Redirecionador::getParametro('valor'); 
            $this->ViewCadastroSala->setSalas($this->PersistenciaSala->listarComFiltro($sIndice, $sValor));   
        } else {
            $this->ViewCadastroSala->setSalas($this->PersistenciaSala->listarTudo());
        }
        $this->ViewCadastroSala->imprime();
    }

    public function processaInserir() {
        if(!empty(Redirecionador::getParametro('descricao')) && !empty(Redirecionador::getParametro('escola'))){
            $this->ModelSala->setDescricao(Redirecionador::getParametro('descricao'));
            $this->ModelSala->getEscola()->setCodigo(Redirecionador::getParametro('escola'));

            $this->PersistenciaSala->setModelSala($this->ModelSala);
            $this->PersistenciaSala->inserirRegistro();
        }
        $this->processaExibir();
    }

}
