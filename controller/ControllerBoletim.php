<?php
/**
 * @author Eloísa Bazzanella, Maria Eduarda Sandner Buzana
 */
class ControllerBoletim extends ControllerPadrao {
    
    /** @var PersistenciaPresenca $PersistenciaPresenca */
    private $PersistenciaBoletim;
    
    /** @var PersistenciaAluno $PersistenciaAluno */
    private $PersistenciaAluno;
    
    /** @var PersistenciaEscola $PersistenciaEscola */
    private $PersistenciaEscola;
    
    /** @var ViewConsultaBoletim $ViewConsultaBoletim */
    private $ViewConsultaBoletim;
    
    /** @var ViewConsultaAlunosBoletim $ViewConsultaAlunosBoletim */
    private $ViewConsultaAlunosBoletim;
    
    function __construct() {
        $this->PersistenciaBoletim  = new PersistenciaBoletim();
        $this->PersistenciaAluno    = new PersistenciaAluno();
        $this->PersistenciaEscola   = new PersistenciaEscola();
        $this->ViewConsultaBoletim  = new ViewConsultaBoletim();
        $this->ViewConsultaAlunosBoletim  = new ViewConsultaAlunosBoletim();
    }

    public function processaExibir() {
        //SE FOR ALUNO IMPRIME DIRETO, SE FOR OUTRO TEM QUE VER TODOS OS ALUNOS PRIMEIRO
        if($_SESSION['tipo'] == 3) {
            $this->ViewConsultaBoletim->setBoletins($this->PersistenciaBoletim->listar($_SESSION['id']));
            $oModelAluno = $this->PersistenciaAluno->selecionar($_SESSION['id']);
            $this->ViewConsultaBoletim->setAluno($oModelAluno);
            $this->ViewConsultaBoletim->setEscola($this->PersistenciaEscola->selecionar($oModelAluno->getEscola()->getUsuario()->getCodigo()));
            $this->ViewConsultaBoletim->imprime();
        } else {
            if(empty(Redirecionador::getParametro('aluno'))) {
                $this->ViewConsultaAlunosBoletim->setAlunos($this->PersistenciaAluno->listarRegistros());
                $this->ViewConsultaAlunosBoletim->imprime();                
            } else {
                $oModelAluno = $this->PersistenciaAluno->selecionar(Redirecionador::getParametro('aluno'));
                $this->ViewConsultaBoletim->setAluno($oModelAluno);
                $this->ViewConsultaBoletim->setEscola($this->PersistenciaEscola->selecionar($oModelAluno->getEscola()->getUsuario()->getCodigo()));
                $this->ViewConsultaBoletim->imprime();
            }
        }        
    }

    public function processaInserir() {}
    public function processaAlterar() {}
    public function processaExcluir() {}
}
