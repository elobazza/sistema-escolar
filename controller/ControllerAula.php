<?php
/**
 * @author Eloisa Bazzanella e Maria Eduarda Buzana
 */
class ControllerAula extends ControllerPadrao {
    
     /** @var ModelAula $ModelAula */
    private $ModelAula;
    
    /** @var PersistenciaAula $PersistenciaAula */
    private $PersistenciaAula;
    
    /** @var ViewCadastroAula $ViewCadastroAula */
    private $ViewCadastroAula;
    
    function __construct() {
        $this->ModelAula        = new ModelAula();
        $this->PersistenciaAula = new PersistenciaAula();
        $this->ViewCadastroAula = new ViewCadastroAula();
    }

    public function processaAlterar() {
        if(Redirecionador::getParametro('efetiva') == 1) {
            if(!empty(Redirecionador::getParametro('horarioInicio')) && !empty(Redirecionador::getParametro('horarioFim'))
               && !empty(Redirecionador::getParametro('discproftur'))){
                $this->ModelAula->setCodigo(Redirecionador::getParametro('codigo'));
                $this->ModelAula->setHorarioInicio(Redirecionador::getParametro('horarioInicio'));
                $this->ModelAula->setHorarioFim(Redirecionador::getParametro('horarioFim'));
                $this->ModelAula->getDisciplinaProfessorTurma()->setCodigo(Redirecionador::getParametro('discproftur'));

                $this->PersistenciaAula->setModelAula($this->ModelAula);
                if($this->PersistenciaAula->alterarRegistro()) {
                    header('Location:index.php?pg=consultaAula&message=sucessoalteracao');
                } else {
                    header('Location:index.php?pg=consultaAula&message=erroalteracao');
                }
            }
            $this->processaExibir();
        }
        else {
           $oAula = $this->PersistenciaAula->selecionar(Redirecionador::getParametro('codigo'));
           $this->ViewCadastroAula->setAula($oAula);
           $this->ViewCadastroAula->setAlterar(1);
           $this->processaExibir();
        }
    }

    public function processaExcluir() {
        if($this->PersistenciaAula->excluirRegistro(Redirecionador::getParametro('codigo'))) {
            header('Location:index.php?pg=consultaAula&message=sucessoexclusao');
        } else {
            header('Location:index.php?pg=consultaAula&message=erroexclusao');
        }
        $this->processaExibir();
    }

    public function processaExibir() {   
        $oPersistenciaDiscProfTur = new PersistenciaDisciplinaProfessorTurma();        
        $this->ViewCadastroAula->setDiscProfTurmas($oPersistenciaDiscProfTur->listarRegistros());
        if(Redirecionador::getParametro('indice') && Redirecionador::getParametro('valor')){
            $sIndice = Redirecionador::getParametro('indice');
            $sValor = Redirecionador::getParametro('valor'); 
            $this->ViewCadastroAula->setAulas($this->PersistenciaAula->listarComFiltro($sIndice, $sValor));   
        } else {
            $this->ViewCadastroAula->setAulas($this->PersistenciaAula->listarRegistros());
        }
        $this->ViewCadastroAula->imprime();
    }

    public function processaInserir() {
        if(!empty(Redirecionador::getParametro('horarioInicio')) && !empty(Redirecionador::getParametro('horarioFim'))
           && !empty(Redirecionador::getParametro('discproftur'))){
            $this->ModelAula->setHorarioInicio(Redirecionador::getParametro('horarioInicio'));
            $this->ModelAula->setHorarioFim(Redirecionador::getParametro('horarioFim'));
            $this->ModelAula->getDisciplinaProfessorTurma()->setCodigo(Redirecionador::getParametro('discproftur'));

            $this->PersistenciaAula->setModelAula($this->ModelAula);
            
            if($this->PersistenciaAula->inserirRegistro()) {
                header('Location:index.php?pg=consultaAula&message=sucessoinclusao');
            } else {
                header('Location:index.php?pg=consultaAula&message=erroinclusao');
            }
        }
        $this->processaExibir();
    }

}
