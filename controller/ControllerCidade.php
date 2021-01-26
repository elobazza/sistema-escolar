<?php

class ControllerCidade extends ControllerPadrao{
      /** @var ModelCidade $ModelCidade */
    private $ModelCidade;
    
    /** @var PersistenciaCidade $PersistenciaCidade */
    private $PersistenciaCidade;
    
    /** @var ViewCadastroCidade $ViewCadastroCidade */
    private $ViewCadastroCidade;
    
    function __construct() {
        $this->ModelCidade        = new ModelCidade();
        $this->PersistenciaCidade = new PersistenciaCidade();
        $this->ViewCadastroCidade = new ViewCadastroCidade();
    }
    public function processaAlterar() {
        if(Redirecionador::getParametro('efetiva') == 1) {
            if(!empty(Redirecionador::getParametro('nome'))){
                $this->ModelCidade->setCodigo(Redirecionador::getParametro('codigo'));
                $this->ModelCidade->setNome(Redirecionador::getParametro('nome'));

                $this->PersistenciaCidade->setModelCidade($this->ModelCidade);
                $this->PersistenciaCidade->alterarRegistro();
                header('Location:index.php?pg=cidade');
            }
            $this->processaExibir();
        }
        else {
           $oCidade = $this->PersistenciaCidade->selecionar(Redirecionador::getParametro('codigo'));
           $this->ViewCadastroCidade->setCidade($oCidade);
           $this->ViewCadastroCidade->setAlterar(1);
           $this->processaExibir();
        }
    }

    public function processaExcluir() {
        $this->PersistenciaCidade->excluirRegistro(Redirecionador::getParametro('codigo'));
        header('Location:index.php?pg=cidade');
        $this->processaExibir();
    }

    public function processaExibir() {
        if(Redirecionador::getParametro('indice') && Redirecionador::getParametro('valor')){
            $sIndice = Redirecionador::getParametro('indice');
            $sValor = Redirecionador::getParametro('valor'); 
            $this->ViewCadastroCidade->setCidades($this->PersistenciaCidade->listarComFiltro($sIndice, $sValor));   
        } else {
            $this->ViewCadastroCidade->setCidades($this->PersistenciaCidade->listarRegistros());
        }
        $this->ViewCadastroCidade->imprime();
    }

    public function processaInserir() {
        if(!empty(Redirecionador::getParametro('nome'))){
            $this->ModelCidade->setNome(Redirecionador::getParametro('nome'));

            $this->PersistenciaCidade->setModelCidade($this->ModelCidade);
            $this->PersistenciaCidade->inserirRegistro();
            header('Location:index.php?pg=cidade');
        }
        $this->processaExibir();
    }

}
