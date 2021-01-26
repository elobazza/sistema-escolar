<?php
class Redirecionador {
    
    public static $parametros;
    
    public function __construct(){
        $this->setParametros();
        if(isset($_SESSION['id'])){
            $this->buscaDestino();
        } 
        else {
            if (self::getParametro('pg') == 'escola'){
                $oController = new ControllerEscola();
                $oController->processa();
            }
            $oController = new ControllerLogin();
            $oController->processa();
        }
    }
    
    private function setParametros(){
        self::$parametros = array_merge($_GET, $_POST);
    }
    
    public static function getParametro($name){
        if (!empty(self::$parametros[$name])){
            return self::$parametros[$name];
        }
        return false;
    }
    
    private function buscaDestino(){ 
     
          if (self::getParametro('pg')){
            //ucfirst = Deixa a primeira letra da palavra maisucula
            $sController = 'Controller'.ucfirst(self::getParametro('pg'));
            if (file_exists('./controller/'.$sController.'.php')){
                $oController = new $sController();
                $oController->processa();
            }
            else {
                throw new Exception('P�gina solicitada não encontrada! '.$sController);
            }
        }
      
        
    }
    
     
}