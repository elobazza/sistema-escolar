<?php
/**
 * @author Eloisa Bazzanella e Maria Eduarda Buzana
 */
class PersistenciaNota extends PersistenciaPadrao{
    /** @var ModelNota $ModelNota */
    private $ModelNota;
    
    function getModelNota() {
        return $this->ModelNota;
    }

    function setModelNota($ModelNota) {
        $this->ModelNota = $ModelNota;
    }
    
    public function alterarRegistro() {
        $sUpdate = 'UPDATE NOTA
                       SET notnota   = '.$this->ModelNota->getNota().' ,
                           alucodigo = '.$this->ModelNota->getAluno()->getCodigo().' ,
                           discodigo = '.$this->ModelNota->getDisciplina()->getCodigo().' 
                     WHERE notcodigo ='.$this->ModelNota->getCodigo().' ';
        
         pg_query($this->conexao, $sUpdate); 
    }

    public function excluirRegistro($codigo) {
        $sDelete = 'DELETE FROM SISTEMAESCOLA.TBNOTA WHERE NOTCODIGO = '.$codigo.'';
        pg_query($this->conexao, $sDelete);
        
    }

    public function inserirRegistro() {
        $aColunas = [
            'alucodigo',
            'discodigo',
            'notnota'
        ];
        $aValores = [
            $this->ModelNota->getAluno()->getCodigo(),
            $this->ModelNota->getDisciplina()->getCodigo(),
            $this->ModelNota->getNota()
        ];
        
        parent::inserir('tbnota', $aColunas, $aValores);
    }

    public function listarRegistrosEscola() {
        $sSelect = 'select p2.id_pessoa, disciplina.nome AS disciplina, p1.nome AS professor, p2.nome AS aluno, SUM(nota)/COUNT(id_nota) AS media
                      from nota
                      join disciplinaprofessorturma
                        on nota.id_discproftur = disciplinaprofessorturma.id_discproftur
                      join disciplina
                        on disciplinaprofessorturma.id_disciplina = disciplina.id_disciplina
                      join professor 
                        on disciplinaprofessorturma.id_professor = professor.id_professor
                      join pessoa p1
                        on professor.id_professor = p1.id_pessoa
                      join aluno
                        on nota.id_aluno = aluno.id_aluno
                      join pessoa p2
                        on aluno.id_aluno = p2.id_pessoa
                     group by p2.id_pessoa, disciplina.id_disciplina, p1.id_pessoa
                     order by disciplina.id_disciplina, p1.id_pessoa';
        
        $oResultado = pg_query($this->conexao, $sSelect);
        $aNotas = [];        
        while ($aLinha = pg_fetch_array($oResultado, null, PGSQL_ASSOC)){
            $oNota = new ModelNota();
            $oNota->getDisciplinaProfessorTurma()->getDisciplina()->setNome($aLinha['disciplina']);
            $oNota->getDisciplinaProfessorTurma()->getProfessor()->setNome($aLinha['professor']);
            $oNota->getAluno()->getUsuario()->setCodigo($aLinha['id_pessoa']);
            $oNota->getAluno()->setNome($aLinha['aluno']);
            $oNota->setMedia($aLinha['media']);
          
            $aNotas[] = $oNota;
        }
        return $aNotas;
    }
    
    public function listarRegistrosProfessor() {
        $sSelect = 'select disciplinaprofessorturma.id_discproftur, disciplina.nome AS disciplina, turma.nome AS turma
                      from nota
                      join disciplinaprofessorturma
                            on nota.id_discproftur = disciplinaprofessorturma.id_discproftur
                      join disciplina
                            on disciplinaprofessorturma.id_disciplina = disciplina.id_disciplina
                      join turma
                            on disciplinaprofessorturma.id_turma = turma.id_turma
                     group by disciplinaprofessorturma.id_discproftur, disciplina.id_disciplina, turma.id_turma';
        
        $oResultado = pg_query($this->conexao, $sSelect);
        $aNotas = [];        
        while ($aLinha = pg_fetch_array($oResultado, null, PGSQL_ASSOC)){
            $oNota = new ModelNota();
            $oNota->getDisciplinaProfessorTurma()->setCodigo($aLinha['id_discproftur']);
            $oNota->getDisciplinaProfessorTurma()->getDisciplina()->setNome($aLinha['disciplina']);
            $oNota->getDisciplinaProfessorTurma()->getTurma()->setNome($aLinha['turma']);
          
            $aNotas[] = $oNota;
        }
        return $aNotas;        
    }
    
    public function listarTudo() {
        $sSelect = 'SELECT notcodigo, notnota, alunome, disnome FROM SISTEMAESCOLA.TBNOTA JOIN SISTEMAESCOLA.TBALUNO ON tbaluno.alucodigo = tbnota.alucodigo JOIN SISTEMAESCOLA.TBDISCIPLINA ON tbdisciplina.discodigo = tbnota.discodigo';
        $oResultado = pg_query($this->conexao, $sSelect);
        $aNotas = [];
        
        while ($aLinha = pg_fetch_array($oResultado, null, PGSQL_ASSOC)){
            $oNota = new ModelNota();
            $oAluno = new ModelAluno();
            $oDisciplina = new ModelDisciplina();
            $oNota->setCodigo($aLinha['notcodigo']);
            $oNota->setNota($aLinha['notnota']);
            
            $oAluno->setNome($aLinha['alunome']);
            $oNota->setAluno($oAluno);
            
            $oDisciplina->setNome($aLinha['disnome']);
            $oNota->setDisciplina($oDisciplina);
          
            $aNotas[] = $oNota;
        }
        return $aNotas;
    }
    public function listarComFiltro($sIndice, $sValor) {
        $sSelect = 'SELECT notcodigo, 
                           notnota, 
                           alunome, 
                           disnome 
                      FROM SISTEMAESCOLA.TBNOTA 
                      JOIN SISTEMAESCOLA.TBALUNO ON 
                           tbaluno.alucodigo = tbnota.alucodigo 
                      JOIN SISTEMAESCOLA.TBDISCIPLINA ON 
                           tbdisciplina.discodigo = tbnota.discodigo
                     WHERE '.$sIndice.' = \''.$sValor.'\';' ;
        $oResultado = pg_query($this->conexao, $sSelect);
        $aNotas = [];
        
        while ($aLinha = pg_fetch_array($oResultado, null, PGSQL_ASSOC)){
            $oNota = new ModelNota();
            $oAluno = new ModelAluno();
            $oDisciplina = new ModelDisciplina();
            $oNota->setCodigo($aLinha['notcodigo']);
            $oNota->setNota($aLinha['notnota']);
            
            $oAluno->setNome($aLinha['alunome']);
            $oNota->setAluno($oAluno);
            
            $oDisciplina->setNome($aLinha['disnome']);
            $oNota->setDisciplina($oDisciplina);
          
            $aNotas[] = $oNota;
        }
        return $aNotas;
    }
    
    public function selecionar($codigo) {
        $sSelect = 'SELECT * FROM SISTEMAESCOLA.TBNOTA WHERE NOTCODIGO = '.$codigo.'';
        $oResultadoNota = pg_query($this->conexao, $sSelect);
        $oNota = new ModelNota();
        
        while ($aLinha = pg_fetch_array($oResultadoNota, null, PGSQL_ASSOC)){
            $oAluno = new ModelAluno();
            $oDisciplina = new ModelDisciplina();
            
            $oNota->setCodigo($aLinha['notcodigo']);
            $oNota->setNota($aLinha['notnota']);
            
            $oAluno->setCodigo($aLinha['alucodigo']);
            $oDisciplina->setCodigo($aLinha['discodigo']);
            
            $oNota->setAluno($oAluno);
            $oNota->setDisciplina($oDisciplina);
           }
        return $oNota;
    }

    public function listarRegistros() {
        
    }

}


