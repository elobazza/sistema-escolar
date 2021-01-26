<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControllerSalaAula
 *
 * @author eloba
 */
class ControllerSalaAula extends ControllerPadrao{
    /** @var ModelSalaAula $ModelSalaAula */
    private $ModelSalaAula;
    
    /** @var PersistenciaSalaAula $PersistenciaSalaAula */
    private $PersistenciaSalaAula;
    
    /** @var ViewCadastroSalaAula $ViewCadastroSalaAula */
    private $ViewCadastroSalaAula;
    
    function __construct() {
        $this->ModelSalaAula        = new ModelSalaAula();
        $this->PersistenciaSalaAula = new PersistenciaSalaAula();
        $this->ViewCadastroSalaAula = new ViewCadastroSalaAula();
    } 
    
    public function processaAlterar() {
        if(Redirecionador::getParametro('efetiva')) {
            if(!empty(Redirecionador::getParametro('sala')) && !empty(Redirecionador::getParametro('aula')) 
            && !empty(Redirecionador::getParametro('turma')) && !empty(Redirecionador::getParametro('prodis'))){
                $this->ModelSalaAula->setCodigo(Redirecionador::getParametro('codigo'));

                $this->ModelSalaAula->getSala()->setCodigo(Redirecionador::getParametro('sala'));
                $this->ModelSalaAula->getAula()->setCodigo(Redirecionador::getParametro('aula'));
                $this->ModelSalaAula->getProdis()->setCodigo(Redirecionador::getParametro('prodis'));
                $this->ModelSalaAula->getTurma()->setCodigo(Redirecionador::getParametro('turma'));

                $this->PersistenciaSalaAula->setModelSalaAula($this->ModelSalaAula);
                $this->PersistenciaSalaAula->alterarRegistro();
                header('Location:index.php?pg=salaAula');
            }
            $this->processaExibir();
        }
        else {
           $oSalaAula = $this->PersistenciaSalaAula->selecionar(Redirecionador::getParametro('codigo'));
           $this->ViewCadastroSalaAula->setSalaaula($oSalaAula);
           $this->ViewCadastroSalaAula->setAlterar(1);
           $this->processaExibir();
        }
    }

    public function processaExcluir() {
        $this->PersistenciaSalaAula->excluirRegistro(Redirecionador::getParametro('codigo'));
        header('Location:index.php?pg=salaAula');
        $this->processaExibir();
    }

    public function processaExibir() {
        $oPersistenciaTurma = new PersistenciaTurma();
        $oPersistenciaSala = new PersistenciaSala();
        $oPersistenciaAula = new PersistenciaAula();
        
        
        $this->ViewCadastroSalaAula->setTurmas($oPersistenciaTurma->listarRegistros());
        $this->ViewCadastroSalaAula->setSalas($oPersistenciaSala->listarTudo());
        $this->ViewCadastroSalaAula->setAulas($oPersistenciaAula->listarRegistros());
        $this->ViewCadastroSalaAula->setProdis($this->PersistenciaSalaAula->listarDisciplinasComProfessor());
        
        if(Redirecionador::getParametro('indice') && Redirecionador::getParametro('valor')){
            $sIndice = Redirecionador::getParametro('indice');
            $sValor = Redirecionador::getParametro('valor'); 
            $this->ViewCadastroSalaAula->setSalasaula($this->PersistenciaSalaAula->listarComFiltro($sIndice, $sValor));   
        } else {
            $this->ViewCadastroSalaAula->setSalasaula($this->PersistenciaSalaAula->listarTudo());
        }
        $this->ViewCadastroSalaAula->imprime();
    }

    public function processaInserir() {

        if(!empty(Redirecionador::getParametro('sala')) && !empty(Redirecionador::getParametro('aula')) 
        && !empty(Redirecionador::getParametro('turma')) && !empty(Redirecionador::getParametro('prodis'))){
            $this->ModelSalaAula->getSala()->setCodigo(Redirecionador::getParametro('sala'));
            $this->ModelSalaAula->getAula()->setCodigo(Redirecionador::getParametro('aula'));
            $this->ModelSalaAula->getTurma()->setCodigo(Redirecionador::getParametro('turma'));
            $this->ModelSalaAula->getProDis()->setCodigo(Redirecionador::getParametro('prodis'));

            $this->PersistenciaSalaAula->setModelSalaAula($this->ModelSalaAula);


            $this->PersistenciaSalaAula->inserirRegistro();
            header('Location:index.php?pg=salaAula');
        }
        $this->processaExibir();
    }

}
