<?php

class ControllerAula extends ControllerPadrao{
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
            if(!empty(Redirecionador::getParametro('horarioInicio')) && !empty(Redirecionador::getParametro('horarioFim'))){
                $this->ModelAula->setCodigo(Redirecionador::getParametro('codigo'));
                $this->ModelAula->setHorarioInicio(Redirecionador::getParametro('horarioInicio'));
                $this->ModelAula->setHorarioFim(Redirecionador::getParametro('horarioFim'));

                $this->PersistenciaAula->setModelAula($this->ModelAula);
                $this->PersistenciaAula->alterarRegistro();
                header('Location:index.php?pg=aula');
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
        $this->PersistenciaAula->excluirRegistro(Redirecionador::getParametro('codigo'));
        header('Location:index.php?pg=aula');
        $this->processaExibir();
    }

    public function processaExibir() {
        
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
        if(!empty(Redirecionador::getParametro('horarioInicio')) && !empty(Redirecionador::getParametro('horarioFim'))){
            $this->ModelAula->setHorarioInicio(Redirecionador::getParametro('horarioInicio'));
            $this->ModelAula->setHorarioFim(Redirecionador::getParametro('horarioFim'));

            $this->PersistenciaAula->setModelAula($this->ModelAula);
            $this->PersistenciaAula->inserirRegistro();
            header('Location:index.php?pg=aula');
        }
        $this->processaExibir();
    }

}