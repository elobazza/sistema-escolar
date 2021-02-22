<?php

/**
 * 
 * @author mduda
 */
class PersistenciaDisciplinaProfessorTurma extends PersistenciaPadrao {
    
    /** @var ModelDisciplinaProfessorTurma $ModelDiscProfTurma */
    private $ModelDiscProfTurma;
    
    function getModelDiscProfTurma() {
        return $this->ModelDiscProfTurma;
    }

    function setModelDiscProfTurma($ModelDiscProfTurma) {
        $this->ModelDiscProfTurma = $ModelDiscProfTurma;
    }

    public function alterarRegistro() {
        $sUpdate = 'UPDATE disciplinaprofessorturma
                       SET id_disciplina = '.$this->ModelDiscProfTurma->getDisciplina()->getCodigo().' ,
                           id_turma = '.$this->ModelDiscProfTurma->getTurma()->getCodigo().' ,
                           id_professor = '.$this->ModelDiscProfTurma->getProfessor()->getUsuario()->getCodigo().' 
                     WHERE id_discproftur = '.$this->ModelDiscProfTurma->getCodigo().' ';
      
        return pg_query($this->conexao, $sUpdate);
    }

    public function excluirRegistro($codigo) {
        $sDelete = 'DELETE FROM disciplinaprofessorturma WHERE id_discproftur = '.$codigo.'';
        return pg_query($this->conexao, $sDelete);
    }

    public function inserirRegistro() {
        $aColunas = [
            'id_disciplina',
            'id_professor',
            'id_turma'
        ];
        $aValores = [
            $this->ModelDiscProfTurma->getDisciplina()->getCodigo(),
            $this->ModelDiscProfTurma->getProfessor()->getUsuario()->getCodigo(),
            $this->ModelDiscProfTurma->getTurma()->getCodigo()
        ];        
        return parent::inserir('disciplinaprofessorturma', $aColunas, $aValores);
    }
    
    public function listarRegistros() {
        $sSelect = 'SELECT disciplinaprofessorturma.*, disciplina.nome AS disciplina, turma.nome AS turma, pessoa.nome AS professor, pessoa.cpf 
                      FROM disciplinaprofessorturma
                      JOIN disciplina
                        ON disciplinaprofessorturma.id_disciplina = disciplina.id_disciplina
                      JOIN professor
                        ON disciplinaprofessorturma.id_professor = professor.id_professor
                      JOIN pessoa
                        ON professor.id_professor = pessoa.id_pessoa
                      JOIN turma
                        ON disciplinaprofessorturma.id_turma = turma.id_turma ';
        
        switch ($_SESSION['tipo']) {
            case 2: {
                $sSelect .= 'WHERE professor.id_professor = '. $_SESSION['id'] .' ';
                break;
            }
        }
        $sSelect .= 'ORDER BY id_discproftur ';
        
        $oResultado      = pg_query($this->conexao, $sSelect);
        $aDiscProfTurmas = [];
        
        while ($aLinha = pg_fetch_array($oResultado, null, PGSQL_ASSOC)){
            $oDiscProfTurma = new ModelDisciplinaProfessorTurma();
            $oDiscProfTurma->setCodigo($aLinha['id_discproftur']);
            $oDiscProfTurma->getDisciplina()->setCodigo($aLinha['id_disciplina']);
            $oDiscProfTurma->getDisciplina()->setNome($aLinha['disciplina']);
            $oDiscProfTurma->getProfessor()->getUsuario()->setCodigo($aLinha['id_professor']);
            $oDiscProfTurma->getProfessor()->setNome($aLinha['professor']);
            $oDiscProfTurma->getProfessor()->setCpf($aLinha['cpf']);
            $oDiscProfTurma->getTurma()->setCodigo($aLinha['id_turma']);
            $oDiscProfTurma->getTurma()->setNome($aLinha['turma']);
            
            $aDiscProfTurmas[] = $oDiscProfTurma;
        }
        return $aDiscProfTurmas;
    }
    
    public function listarComFiltro($sIndice, $sValor) {
        $sSelect = 'SELECT disciplinaprofessorturma.*, disciplina.nome AS disciplina, turma.nome AS turma, pessoa.nome AS professor, pessoa.cpf 
                      FROM disciplinaprofessorturma
                      JOIN disciplina
                        ON disciplinaprofessorturma.id_disciplina = disciplina.id_disciplina
                      JOIN professor
                        ON disciplinaprofessorturma.id_professor = professor.id_professor
                      JOIN pessoa
                        ON professor.id_professor = pessoa.id_pessoa
                      JOIN turma
                        ON disciplinaprofessorturma.id_turma = turma.id_turma
                     WHERE '.$sIndice.' = \''.$sValor.'\';' ;
        
        $oResultado      = pg_query($this->conexao, $sSelect);
        $aDiscProfTurmas = [];
        
        while ($aLinha = pg_fetch_array($oResultado, null, PGSQL_ASSOC)){
            $oDiscProfTurma = new ModelDisciplinaProfessorTurma();
            $oDiscProfTurma->setCodigo($aLinha['id_discproftur']);
            $oDiscProfTurma->getDisciplina()->setCodigo($aLinha['id_disciplina']);
            $oDiscProfTurma->getDisciplina()->setNome($aLinha['disciplina']);
            $oDiscProfTurma->getProfessor()->getUsuario()->setCodigo($aLinha['id_professor']);
            $oDiscProfTurma->getProfessor()->setNome($aLinha['professor']);
            $oDiscProfTurma->getProfessor()->setCpf($aLinha['cpf']);
            $oDiscProfTurma->getTurma()->setCodigo($aLinha['id_turma']);
            $oDiscProfTurma->getTurma()->setNome($aLinha['turma']);
            
            $aDiscProfTurmas[] = $oDiscProfTurma;
        }
        return $aDiscProfTurmas;
    }
    
}