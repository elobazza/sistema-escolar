<?php
/**
 * @author Eloísa Bazzanella, Maria Eduarda Sandner Buzana
 */
class ControllerBoletim extends ControllerPadrao {
    
    /** @var PersistenciaPresenca $PersistenciaPresenca */
    private $PersistenciaBoletim;
    
    /** @var ViewConsultaBoletim $ViewConsultaBoletim */
    private $ViewConsultaBoletim;
    
    function __construct() {
        $this->PersistenciaBoletim  = new PersistenciaBoletim();
        $this->ViewConsultaBoletim  = new ViewConsultaBoletim();
    }

    public function processaExibir() {
        //SE FOR ALUNO IMPRIME DIRETO, SE FOR OUTRO TEM QUE VER TODOS OS ALUNOS PRIMEIRO
        if($_SESSION['tipo'] == 3) {
            $this->ViewConsultaBoletim->imprime();
        } else {
            
        }        
    }

    public function processaInserir() {}
    public function processaAlterar() {}
    public function processaExcluir() {}
}
