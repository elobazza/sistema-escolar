<?php

class ControllerAluno extends ControllerPadrao {
    
    /** @var ModelAluno $ModelAluno */
    private $ModelAluno;
    
    /** @var PersistenciaAluno $PersistenciaAluno */
    private $PersistenciaAluno;
    
    /** @var ViewCadastroAluno $ViewCadastroAluno */
    private $ViewCadastroAluno;
    
    function __construct() {
        $this->ModelAluno        = new ModelAluno();
        $this->PersistenciaAluno = new PersistenciaAluno();
        $this->ViewCadastroAluno = new ViewCadastroAluno();
    }
    
    public function processaAlterar() { 
        if(Redirecionador::getParametro('efetiva') == 1) {
            if(!empty(Redirecionador::getParametro('nome')) && !empty(Redirecionador::getParametro('cpf')) 
            && !empty(Redirecionador::getParametro('contato')) && !empty(Redirecionador::getParametro('turma'))){
                $this->ModelAluno->setCodigo(Redirecionador::getParametro('codigo'));
                $this->ModelAluno->setNome(Redirecionador::getParametro('nome'));
                $this->ModelAluno->setCpf(Redirecionador::getParametro('cpf'));
                $this->ModelAluno->setContato(Redirecionador::getParametro('contato'));
                $this->ModelAluno->getTurma()->setCodigo(Redirecionador::getParametro('turma'));

                $this->PersistenciaAluno->setModelAluno($this->ModelAluno);
                $this->PersistenciaAluno->alterarRegistro();
                header('Location:index.php?pg=aluno');
            }
            $this->processaExibir();
        }
        else {
           $oAluno = $this->PersistenciaAluno->selecionar(Redirecionador::getParametro('codigo'));
           $this->ViewCadastroAluno->setAluno($oAluno);
           $this->ViewCadastroAluno->setAlterar(1);
           $this->processaExibir();
        }
        
    }

    public function processaExcluir() {
        $this->PersistenciaAluno->excluirRegistro(Redirecionador::getParametro('codigo'));
        header('Location:index.php?pg=aluno');
        $this->processaExibir();
    }

    public function processaExibir() { 
        $oPersistenciaTurma = new PersistenciaTurma();
        
        $this->ViewCadastroAluno->setTurmas($oPersistenciaTurma->listarRegistros());
        if(Redirecionador::getParametro('indice') && Redirecionador::getParametro('valor')){
            $sIndice = Redirecionador::getParametro('indice');
            $sValor = Redirecionador::getParametro('valor'); 
            $this->ViewCadastroAluno->setAlunos($this->PersistenciaAluno->listarComFiltro($sIndice, $sValor));   
        } else {
            $this->ViewCadastroAluno->setAlunos($this->PersistenciaAluno->listarTudo());
        }
        $this->ViewCadastroAluno->imprime();
        
        
    }

    public function processaInserir() {      
        if(!empty(Redirecionador::getParametro('nome')) && !empty(Redirecionador::getParametro('cpf')) 
        && !empty(Redirecionador::getParametro('contato')) && !empty(Redirecionador::getParametro('turma'))){
            $this->ModelAluno->setNome(Redirecionador::getParametro('nome'));
            $this->ModelAluno->setCpf(Redirecionador::getParametro('cpf'));
            $this->ModelAluno->setContato(Redirecionador::getParametro('contato'));
            $this->ModelAluno->getTurma()->setCodigo(Redirecionador::getParametro('turma'));

            $this->PersistenciaAluno->setModelAluno($this->ModelAluno);
            $this->PersistenciaAluno->inserirRegistro();
            header('Location:index.php?pg=aluno');
        }
        
        $this->processaExibir();
    }
}