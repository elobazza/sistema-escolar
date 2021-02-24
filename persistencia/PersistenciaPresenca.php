<?php
/**
 * @author Eloisa Bazzanella e Maria Eduarda Buzana
 */
class PersistenciaPresenca extends PersistenciaPadrao{
    
    /** @var ModelPresenca $ModelPresenca */
    private $ModelPresenca;
    
    function getModelPresenca() {
        return $this->ModelPresenca;
    }

    function setModelPresenca($ModelPresenca) {
        $this->ModelPresenca = $ModelPresenca;
    }
    
    public function alterarRegistro() {
        
    }

    public function excluirRegistro($codigo) {
        
    }

    public function inserirRegistro() {
        
    }
    
    public function listarRegistrosProfessor() {
        $sSelect = 'select aula.id_aula, disciplina.nome AS disciplina, turma.nome AS turma
                      from presenca
                      join aula
                        on presenca.id_aula = aula.id_aula
                      join disciplinaprofessorturma
                            on aula.id_discproftur = disciplinaprofessorturma.id_discproftur
                      join disciplina
                            on disciplinaprofessorturma.id_disciplina = disciplina.id_disciplina
                      join turma
                            on disciplinaprofessorturma.id_turma = turma.id_turma
                     group by aula.id_aula, disciplina.id_disciplina, turma.id_turma';
        
        $oResultado = pg_query($this->conexao, $sSelect);
        $aPresencas = [];        
        while ($aLinha = pg_fetch_array($oResultado, null, PGSQL_ASSOC)){
            $oPresenca = new ModelPresenca();
            $oPresenca->getAula()->setCodigo($aLinha['id_aula']);
            $oPresenca->getAula()->getDisciplinaProfessorTurma()->getDisciplina()->setNome($aLinha['disciplina']);
            $oPresenca->getAula()->getDisciplinaProfessorTurma()->getTurma()->setNome($aLinha['turma']);
          
            $aPresencas[] = $oPresenca;
        }
        return $aPresencas;        
    }
    
    
    public function listarRegistros() {
        
    }

}