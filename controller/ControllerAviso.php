<?php
/**
 * @author Eloísa Bazzanella e Maria Eduarda Buzana
 */
class ControllerAviso extends ControllerPadrao {
   
    /** @var ModelAviso $ModelAviso */
    private $ModelAviso;
    
    /** @var PersistenciaAviso $PersistenciaAviso */
    private $PersistenciaAviso;
    
    /** @var ViewCadastroAviso $ViewCadastroAviso */
    private $ViewCadastroAviso;
    
    function __construct() {
        $this->ModelAviso          = new ModelAviso();
        $this->PersistenciaAviso   = new PersistenciaAviso();
        $this->ViewCadastroAviso   = new ViewCadastroAviso();
    }
    
    public function processaExibir() {
        $this->ViewCadastroAviso->imprime();
    }

    public function processaInserir() {
        if(!empty(Redirecionador::getParametro('titulo')) && !empty(Redirecionador::getParametro('mensagem'))){
            date_default_timezone_set('America/Sao_Paulo');
            $this->ModelAviso->setData(date("d/m/y"));
            $this->ModelAviso->setHora(date("H:i:s"));
            $this->ModelAviso->setMensagem(Redirecionador::getParametro('mensagem'));        
            $this->ModelAviso->setTitulo(Redirecionador::getParametro('titulo'));        

            $this->PersistenciaAviso->setModelAviso($this->ModelAviso);
            $sucessoInserir = $this->PersistenciaAviso->inserirRegistro();
            
            if($sucessoInserir) {
                header('Location:index.php?pg=consultaAviso&message=sucessoinclusao');
            } else {
                header('Location:index.php?pg=consultaAviso&message=erroinclusao');
            }
            $this->processaExibir();
        }
        header('Location:index.php?pg=aviso&message=erroinclusao');
    }
    
    public function processaAlterar() {}
    public function processaExcluir() {}

}
