<?php

/**
 * @author Eloísa Bazzanella e Maria Eduarda Buzana
 */
class ControllerConsultaAlunoTurma extends ControllerPadrao {
    
    /** @var ModelAluno $ModelAluno */
    private $ModelAluno;
    
    /** @var PersistenciaAluno $PersistenciaAluno */
    private $PersistenciaAluno;
    
    /** @var ViewConsultaAlunoTurma $ViewConsultaAlunoTurma */
    private $ViewConsultaAlunoTurma;
    
    function __construct() {
        $this->ModelAluno        = new ModelAluno();
        $this->PersistenciaAluno = new PersistenciaAluno();
        $this->ViewConsultaAlunoTurma = new ViewConsultaAlunoTurma();
    }
    
    public function processaExibir() {
        $sIndice = 'turma.id_turma';
        $sValor = Redirecionador::getParametro('codigo'); 
        $this->ViewConsultaAlunoTurma->setAlunos($this->PersistenciaAluno->listarComFiltro($sIndice, $sValor));
        $this->ViewConsultaAlunoTurma->imprime();
    }

    public function processaAlterar() {}
    public function processaExcluir() {}
    public function processaInserir() {}

}
