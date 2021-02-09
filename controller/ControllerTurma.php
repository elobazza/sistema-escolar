<?php

class ControllerTurma extends ControllerPadrao{
    
    /** @var ModelTurma $ModelTurma */
    private $ModelTurma;
    
    /** @var PersistenciaTurma $PersistenciaTurma */
    private $PersistenciaTurma;
    
    /** @var ViewCadastroTurma $ViewCadastroTurma */
    private $ViewCadastroTurma;
    
    function __construct() {
        $this->ModelTurma        = new ModelTurma();
        $this->PersistenciaTurma = new PersistenciaTurma();
        $this->ViewCadastroTurma = new ViewCadastroTurma();
    }
    
    public function processaAlterar() {
        if(Redirecionador::getParametro('efetiva') == 1) {
            if(!empty(Redirecionador::getParametro('nome'))){
                $this->ModelTurma->setCodigo(Redirecionador::getParametro('codigo'));
                $this->ModelTurma->setNome(Redirecionador::getParametro('nome'));

                $this->PersistenciaTurma->setModelTurma($this->ModelTurma);
                $this->PersistenciaTurma->alterarRegistro();
                header('Location:index.php?pg=consultaTurma');
            }
            $this->processaExibir();
        }
        else {
           $oTurma = $this->PersistenciaTurma->selecionar(Redirecionador::getParametro('codigo'));
           
           $this->ViewCadastroTurma->setTurma($oTurma); 
           $this->ViewCadastroTurma->setAlterar(1);
           $this->processaExibir();
        }
    }

    public function processaExcluir() {
        $this->PersistenciaTurma->excluirRegistro(Redirecionador::getParametro('codigo'));
        header('Location:index.php?pg=consultaTurma');
        $this->processaExibir();
    }

    public function processaExibir() {        
        if(Redirecionador::getParametro('indice') && Redirecionador::getParametro('valor')){
            $sIndice = Redirecionador::getParametro('indice');
            $sValor = Redirecionador::getParametro('valor'); 
            $this->ViewCadastroTurma->setTurmas($this->PersistenciaTurma->listarComFiltro($sIndice, $sValor));   
        } 
//        else {
//            $this->ViewCadastroTurma->setTurmas($this->PersistenciaTurma->listarTudo());
//        }
        $this->ViewCadastroTurma->imprime();
    }

    public function processaInserir() {
        if(!empty(Redirecionador::getParametro('nome'))){
            $this->ModelTurma->setNome(Redirecionador::getParametro('nome'));

            $this->PersistenciaTurma->setModelTurma($this->ModelTurma);
            $this->PersistenciaTurma->inserirRegistro();
            header('Location:index.php?pg=consultaTurma');
        }
        $this->processaExibir();
    }

}
