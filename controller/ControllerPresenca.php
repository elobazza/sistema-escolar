<?php

class ControllerPresenca extends ControllerPadrao {
    
    /** @var ModelPresenca $ModelPresenca */
    private $ModelPresenca;
    
    /** @var PersistenciaPresenca $PersistenciaPresenca */
    private $PersistenciaPresenca;
    
    /** @var PersistenciaAula $PersistenciaAula */
    private $PersistenciaAula;
    
    /** @var PersistenciaAluno $PersistenciaAluno */
    private $PersistenciaAluno;
    
    /** @var ViewCadastroPresenca $ViewPresenca */
    private $ViewPresenca;
    
    function __construct() {
        $this->ModelPresenca        = new ModelPresenca();
        $this->PersistenciaPresenca = new PersistenciaPresenca();
        $this->PersistenciaAluno    = new PersistenciaAluno();
        $this->PersistenciaAula     = new PersistenciaAula();
        $this->ViewPresenca         = new ViewCadastroPresenca();
    }

    public function processaAlterar() {
        
    }

    public function processaExcluir() {
        
    }

    public function processaExibir() {
        $aAulas = $this->PersistenciaAula->listarComFiltro('AULA.id_discproftur', Redirecionador::getParametro('codigo'));
        
        if(count($aAulas) > 0) {
            $this->ViewPresenca->setAlunos($this->PersistenciaAluno->listarRegistros());
            $this->ViewPresenca->setAula($aAulas[0]->getCodigo());

            $this->ViewPresenca->imprime();
        }
    }

    public function processaInserir() {
        if(!empty(Redirecionador::getParametro('data'))){
            $aAlunos         = $this->PersistenciaAluno->listarRegistros();
            $oModelPresenca  = new ModelPresenca();
            $bSucessoInserir = true;
            
            $oModelPresenca->getAula()->setCodigo(Redirecionador::getParametro('id_aula'));
            $oModelPresenca->setData(Redirecionador::getParametro('data'));
            
            $bSucessoInserirTudo = true;
            foreach ($aAlunos as $oAluno) {
                if(Redirecionador::getParametro('A' . $oAluno->getUsuario()->getCodigo()) == 'on') {
                    $bPresenca = 1;                    
                } else {
                    $bPresenca = 0;                    
                }
                $oModelPresenca->setPresenca($bPresenca);
                $oModelPresenca->setAluno($oAluno);
                
                $this->PersistenciaPresenca->setModelPresenca($oModelPresenca);
                $bSucesso = $this->PersistenciaPresenca->inserirRegistro();
                $bSucessoInserirTudo = $bSucesso && $bSucessoInserir;
            }            
            if($bSucessoInserirTudo) {
                header('Location:index.php?pg=consultaPresenca&message=sucessoinclusao');
            } else {
                header('Location:index.php?pg=consultaPresenca&message=erroinclusao');
            }
            $this->processaExibir();
        } 
        else {
            header('Location:index.php?pg=consultaPresenca&message=erroinclusao');            
        }
    }

}
