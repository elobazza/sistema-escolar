<?php
/**
 * @author Eloisa Bazzanella e Maria Eduarda Buzana
 */
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
                if($this->PersistenciaTurma->alterarRegistro()) {
                    header('Location:index.php?pg=consultaTurma&message=sucessoalteracao');
                } else {
                    header('Location:index.php?pg=consultaTurma&message=erroalteracao');
                }
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
        if($this->PersistenciaTurma->excluirRegistro(Redirecionador::getParametro('codigo'))) {
            header('Location:index.php?pg=consultaTurma&message=sucessoexclusao');
        } else {
            header('Location:index.php?pg=consultaTurma&message=erroexclusao');
        }
        $this->processaExibir();
    }

    public function processaExibir() {         
        $this->ViewCadastroTurma->setTurmas($this->PersistenciaTurma->listarRegistros());   
        $this->ViewCadastroTurma->imprime();
    }

    public function processaInserir() {
        if(!empty(Redirecionador::getParametro('nome'))){
            $this->ModelTurma->setNome(Redirecionador::getParametro('nome'));

            $this->PersistenciaTurma->setModelTurma($this->ModelTurma);
            if($this->PersistenciaTurma->inserirRegistro()) {
                header('Location:index.php?pg=consultaTurma&message=sucessoinclusao');
            } else {
                header('Location:index.php?pg=consultaTurma&message=erroinclusao');
            }
            
        }
        $this->processaExibir();
    }

}
