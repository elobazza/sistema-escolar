<?php


class ControllerDisciplina extends ControllerPadrao{
     /** @var ModelDisciplina $ModelDisciplina */
    private $ModelDisciplina;
    
    /** @var PersistenciaDisciplina $PersistenciaDisciplina */
    private $PersistenciaDisciplina;
    
    /** @var ViewCadastroDisciplina $ViewCadastroDisciplina */
    private $ViewCadastroDisciplina;
    
    function __construct() {
        $this->ModelDisciplina        = new ModelDisciplina();
        $this->PersistenciaDisciplina = new PersistenciaDisciplina();
        $this->ViewCadastroDisciplina = new ViewCadastroDisciplina();
    }
    public function processaAlterar() {
        if(Redirecionador::getParametro('efetiva') == 1) {
            if(!empty(Redirecionador::getParametro('nome')) && !empty(Redirecionador::getParametro('credito'))){
                $this->ModelDisciplina->setCodigo(Redirecionador::getParametro('codigo'));
                $this->ModelDisciplina->setNome(Redirecionador::getParametro('nome'));
                $this->ModelDisciplina->setCredito(Redirecionador::getParametro('credito'));

                $this->PersistenciaDisciplina->setModelDisciplina($this->ModelDisciplina);
                $this->PersistenciaDisciplina->alterarRegistro();
                header('Location:index.php?pg=disciplina');
            }
            $this->processaExibir();
        }
        else {
           $oDisciplina = $this->PersistenciaDisciplina->selecionar(Redirecionador::getParametro('codigo'));
           $this->ViewCadastroDisciplina->setDisciplina($oDisciplina);
           $this->ViewCadastroDisciplina->setAlterar(1);
           $this->processaExibir();
        }
    }

    public function processaExcluir() {
        $this->PersistenciaDisciplina->excluirRegistro(Redirecionador::getParametro('codigo'));
        header('Location:index.php?pg=disciplina');
        $this->processaExibir();
    }

    public function processaExibir() {
        if(Redirecionador::getParametro('indice') && Redirecionador::getParametro('valor')){
            $sIndice = Redirecionador::getParametro('indice');
            $sValor = Redirecionador::getParametro('valor'); 
            $this->ViewCadastroDisciplina->setDisciplinas($this->PersistenciaDisciplina->listarComFiltro($sIndice, $sValor));   
        } else {
            $this->ViewCadastroDisciplina->setDisciplinas($this->PersistenciaDisciplina->listarRegistros());
        }
        $this->ViewCadastroDisciplina->imprime();
    }

    public function processaInserir() {
         if(!empty(Redirecionador::getParametro('nome')) && !empty(Redirecionador::getParametro('credito'))){
            $this->ModelDisciplina->setNome(Redirecionador::getParametro('nome'));
            $this->ModelDisciplina->setCredito(Redirecionador::getParametro('credito'));

            $this->PersistenciaDisciplina->setModelDisciplina($this->ModelDisciplina);
            $this->PersistenciaDisciplina->inserirRegistro();
            header('Location:index.php?pg=disciplina');
         }
        $this->processaExibir();
    }

}
