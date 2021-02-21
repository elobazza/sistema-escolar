<?php

/**
 * 
 * @author mduda
 */
class ControllerDisciplinaProfessorTurma extends ControllerPadrao {
    
     /** @var ModelDiscProfTurma $ModelDiscProfTurma */
    private $ModelDiscProfTurma;
    
    /** @var PersistenciaDiscProfTurma $PersistenciaDiscProfTurma */
    private $PersistenciaDiscProfTurma;
    
    /** @var ViewCadastroDiscProfTurma $ViewCadastroDiscProfTurma */
    private $ViewCadastroDiscProfTurma;
    
    function __construct() {
        $this->ModelDiscProfTurma        = new ModelDisciplinaProfessorTurma();
        $this->PersistenciaDiscProfTurma = new PersistenciaDisciplinaProfessorTurma();
        $this->ViewCadastroDiscProfTurma = new ViewCadastroDisciplinaProfessorTurma();
    }

    public function processaAlterar() {
        if(Redirecionador::getParametro('efetiva') == 1) {
            if(!empty(Redirecionador::getParametro('turma')) && !empty(Redirecionador::getParametro('disciplina'))
            && !empty(Redirecionador::getParametro('turma'))){
                $this->ModelDiscProfTurma->setCodigo(Redirecionador::getParametro('codigo'));
                $this->ModelDiscProfTurma->getDisciplina()->setCodigo(Redirecionador::getParametro('disciplina'));
                $this->ModelDiscProfTurma->getTurma()->setCodigo(Redirecionador::getParametro('turma'));
                $this->ModelDiscProfTurma->getProfessor()->getUsuario()->setCodigo(Redirecionador::getParametro('professor'));

                $this->PersistenciaDiscProfTurma->setModelDiscProfTurma($this->ModelDiscProfTurma);
                if($this->PersistenciaDiscProfTurma->alterarRegistro()) {
                    header('Location:index.php?pg=consultaDisciplinaProfessorTurma&message=sucessoalteracao');
                } else {
                    header('Location:index.php?pg=consultaDisciplinaProfessorTurma&message=erroalteracao');
                }
            }
            $this->processaExibir();
        }
        else {
           $oDiscProfTurma = $this->PersistenciaDiscProfTurma->listarComFiltro('id_discproftur', Redirecionador::getParametro('codigo'));
           $this->ViewCadastroDiscProfTurma->setDiscProfTurma($oDiscProfTurma[0]);
           $this->ViewCadastroDiscProfTurma->setAlterar(1);
           $this->processaExibir();
        }
    }

    public function processaExcluir() {
        if($this->PersistenciaDiscProfTurma->excluirRegistro(Redirecionador::getParametro('codigo'))) {
            header('Location:index.php?pg=consultaDisciplinaProfessorTurma&message=sucessoexclusao');
        } else {
            header('Location:index.php?pg=consultaDisciplinaProfessorTurma&message=erroexclusao');
        }
        $this->processaExibir();
    }

    public function processaExibir() {
        $oPersistenciaTurma = new PersistenciaTurma();        
        $this->ViewCadastroDiscProfTurma->setTurmas($oPersistenciaTurma->listarRegistros());
        $oPersistenciaProfessor = new PersistenciaProfessor();        
        $this->ViewCadastroDiscProfTurma->setProfessores($oPersistenciaProfessor->listarRegistros());
        $oPersistenciaDisciplina = new PersistenciaDisciplina();        
        $this->ViewCadastroDiscProfTurma->setDisciplinas($oPersistenciaDisciplina->listarRegistros());
        if(Redirecionador::getParametro('indice') && Redirecionador::getParametro('valor')){
            $sIndice = Redirecionador::getParametro('indice');
            $sValor = Redirecionador::getParametro('valor'); 
            $this->ViewCadastroDiscProfTurma->setDiscProfTurmas($this->PersistenciaDiscProfTurma->listarComFiltro($sIndice, $sValor));   
        } else {
            $this->ViewCadastroDiscProfTurma->setDiscProfTurmas($this->PersistenciaDiscProfTurma->listarRegistros());
        }
        $this->ViewCadastroDiscProfTurma->imprime();
    }

    public function processaInserir() {
        if(!empty(Redirecionador::getParametro('turma')) && !empty(Redirecionador::getParametro('disciplina'))
           && !empty(Redirecionador::getParametro('turma'))){
            $this->ModelDiscProfTurma->getDisciplina()->setCodigo(Redirecionador::getParametro('disciplina'));
            $this->ModelDiscProfTurma->getTurma()->setCodigo(Redirecionador::getParametro('turma'));
            $this->ModelDiscProfTurma->getProfessor()->getUsuario()->setCodigo(Redirecionador::getParametro('professor'));

            $this->PersistenciaDiscProfTurma->setModelDiscProfTurma($this->ModelDiscProfTurma);            
            if($this->PersistenciaDiscProfTurma->inserirRegistro()) {
                header('Location:index.php?pg=consultaDisciplinaProfessorTurma&message=sucessoinclusao');
            } else {
                header('Location:index.php?pg=consultaDisciplinaProfessorTurma&message=erroinclusao');
            }
        }
        $this->processaExibir();
    }

}
