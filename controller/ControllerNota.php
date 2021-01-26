<?php


class ControllerNota extends ControllerPadrao{
     /** @var ModelNota $ModelNota */
    private $ModelNota;
    
    /** @var PersistenciaNota $PersistenciaNota */
    private $PersistenciaNota;
    
    /** @var ViewCadastroNota $ViewCadastroNota */
    private $ViewCadastroNota;
    
    function __construct() {
        $this->ModelNota        = new ModelNota();
        $this->PersistenciaNota = new PersistenciaNota();
        $this->ViewCadastroNota = new ViewCadastroNota();
    }

    public function processaAlterar() {
        if(Redirecionador::getParametro('efetiva') == 1) {
            if(!empty(Redirecionador::getParametro('nota')) && !empty(Redirecionador::getParametro('aluno')) && !empty(Redirecionador::getParametro('disciplina'))){
                $this->ModelNota->setCodigo(Redirecionador::getParametro('codigo'));
                $this->ModelNota->setNota(Redirecionador::getParametro('nota'));
                $this->ModelNota->getAluno()->setCodigo(Redirecionador::getParametro('aluno'));
                $this->ModelNota->getDisciplina()->setCodigo(Redirecionador::getParametro('disciplina'));

                $this->PersistenciaNota->setModelNota($this->ModelNota);
                $this->PersistenciaNota->alterarRegistro();
                header('Location:index.php?pg=nota');
            }
            $this->processaExibir();
        }
        else {
           $oNota = $this->PersistenciaNota->selecionar(Redirecionador::getParametro('codigo'));
           $this->ViewCadastroNota->setNota($oNota);
           $this->ViewCadastroNota->setAlterar(1);
           $this->processaExibir();
        }
        
    }

    public function processaExcluir() {
        $this->PersistenciaNota->excluirRegistro(Redirecionador::getParametro('codigo'));
        header('Location:index.php?pg=nota');
        $this->processaExibir();
    }

    public function processaExibir() {
        $oPersistenciaAluno = new PersistenciaAluno();
        $this->ViewCadastroNota->setAlunos($oPersistenciaAluno->listarRegistros());
        
        $oPersistenciaDisciplina = new PersistenciaDisciplina();
        $this->ViewCadastroNota->setDisciplinas($oPersistenciaDisciplina->listarRegistros());
        if(Redirecionador::getParametro('indice') && Redirecionador::getParametro('valor')){
            $sIndice = Redirecionador::getParametro('indice');
            $sValor = Redirecionador::getParametro('valor'); 
            $this->ViewCadastroNota->setNotas($this->PersistenciaNota->listarComFiltro($sIndice, $sValor));   
        } else {
            $this->ViewCadastroNota->setNotas($this->PersistenciaNota->listarTudo());
        }
        $this->ViewCadastroNota->imprime();
    }

    public function processaInserir() {
        if(!empty(Redirecionador::getParametro('nota')) && !empty(Redirecionador::getParametro('aluno')) && !empty(Redirecionador::getParametro('disciplina'))){
            $this->ModelNota->setNota(Redirecionador::getParametro('nota'));
            $this->ModelNota->getAluno()->setCodigo(Redirecionador::getParametro('aluno'));
            $this->ModelNota->getDisciplina()->setCodigo(Redirecionador::getParametro('disciplina'));

            $this->PersistenciaNota->setModelNota($this->ModelNota);
            $this->PersistenciaNota->inserirRegistro();
        }
        $this->processaExibir();
    }

}
