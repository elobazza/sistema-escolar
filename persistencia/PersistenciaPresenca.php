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
        $aColunas = [
            'id_aluno',
            'id_aula',
            'data',
            'presenca'
        ];
        $aValores = [
            $this->ModelPresenca->getAluno()->getUsuario()->getCodigo(),
            $this->ModelPresenca->getAula()->getCodigo(),
            $this->ModelPresenca->getData(),
            $this->ModelPresenca->getPresenca()
        ];
        
        return parent::inserir('presenca', $aColunas, $aValores);
    }
    
    public function listarRegistrosProfessor($codigo) {
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
    
    public function listarPresencaAluno($id_aula, $id_aluno) {
        $sSelect = 'SELECT pessoa.nome AS aluno, presenca.*
                      from presenca
                      join aluno
                        on presenca.id_aluno = aluno.id_aluno
                      join pessoa 
                        on aluno.id_aluno = pessoa.id_pessoa
                     where presenca.id_aula = ' .$id_aula . '
                       and presenca.id_aluno = ' . $id_aluno . ';';
        
        $oResultado = pg_query($this->conexao, $sSelect);
        $aPresencas = [];        
        while ($aLinha = pg_fetch_array($oResultado, null, PGSQL_ASSOC)){
            $oPresenca = new ModelPresenca();
            $oPresenca->getAula()->setCodigo($aLinha['id_aula']);
            $oPresenca->getAluno()->setNome($aLinha['aluno']);
            $oPresenca->setData($aLinha['data']);
            $oPresenca->setPresenca($aLinha['presenca']);
            $oPresenca->setCodigo($aLinha['id_presenca']);
          
            $aPresencas[] = $oPresenca;
        }
        return $aPresencas;
    }    
    
    public function listarRegistros() {
        
    }

}