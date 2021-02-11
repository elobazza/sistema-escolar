<?php

class PersistenciaDisciplina extends PersistenciaPadrao{
    /** @var ModelDisciplina $ModelDisciplina */
    private $ModelDisciplina;
    
    function getModelDisciplina() {
        return $this->ModelDisciplina;
    }

    function setModelDisciplina($ModelDisciplina) {
        $this->ModelDisciplina = $ModelDisciplina;
    }

    public function alterarRegistro() {
        $sUpdate = 'UPDATE DISCIPLINA
                       SET nome = \''.$this->ModelDisciplina->getNome().'\' ,
                           carga_horaria = \''.$this->ModelDisciplina->getCargaHoraria().'\' 
                     WHERE id_disciplina ='.$this->ModelDisciplina->getCodigo().' ';
        
         return pg_query($this->conexao, $sUpdate); 
    }

    public function excluirRegistro($codigo) {
        $sDeleteFinal = 'DELETE FROM DISCIPLINA WHERE ID_DISCIPLINA = '.$codigo.'';
        return pg_query($this->conexao, $sDeleteFinal);
    }

    public function inserirRegistro() {
        $aColunas = [
            'nome',
            'carga_horaria'
        ];
        $aValores = [
            $this->ModelDisciplina->getNome(),
            $this->ModelDisciplina->getCargaHoraria()
        ];
        
        return parent::inserir('disciplina', $aColunas, $aValores);
    }

    public function listarRegistros() {
        $sSelect = 'SELECT * FROM DISCIPLINA ORDER BY 1';
        $oResultado = pg_query($this->conexao, $sSelect);
        $aDisciplinas = [];
        
        while ($aLinha = pg_fetch_array($oResultado, null, PGSQL_ASSOC)){
            $oDisciplina = new ModelDisciplina();
            $oDisciplina->setCodigo($aLinha['id_disciplina']);
            $oDisciplina->setNome($aLinha['nome']);
            $oDisciplina->setCargaHoraria($aLinha['carga_horaria']);
            
            $aDisciplinas[] = $oDisciplina;
        }
        return $aDisciplinas;
    }
    public function listarComFiltro($sIndice, $sValor) {
        $sSelect = 'SELECT * 
                      FROM DISCIPLINA 
                     WHERE '.$sIndice.' = \''.$sValor.'\'
                    ORDER BY 1;';
        $oResultado = pg_query($this->conexao, $sSelect);
        $aDisciplinas = [];
        
        while ($aLinha = pg_fetch_array($oResultado, null, PGSQL_ASSOC)){
            $oDisciplina = new ModelDisciplina();
            $oDisciplina->setCodigo($aLinha['id_disciplina']);
            $oDisciplina->setNome($aLinha['nome']);
            $oDisciplina->setCredito($aLinha['carga_horaria']);
            
            $aDisciplinas[] = $oDisciplina;
        }
        return $aDisciplinas;
    }
    
    public function listarDisciplinasPorProfessor($codigo) {
        $sSelect = 'SELECT DISCIPLINA.* 
                      FROM DISCIPLINA 
                      JOIN PROFESSORDISCIPLINA ON
                           TBDISCIPLINA.ID_DISCIPLINA = TBPROFESSORDISCIPLINA.ID_DISCIPLINA
                     WHERE PROFESSORDISCIPLINA.ID_PROFESSOR = '.$codigo;
        $oResultado = pg_query($this->conexao, $sSelect);
        $aDisciplinas = [];
        
        while ($aLinha = pg_fetch_array($oResultado, null, PGSQL_ASSOC)){
            $oDisciplina = new ModelDisciplina();
            $oDisciplina->setCodigo($aLinha['id_disciplina']);
            $oDisciplina->setNome($aLinha['nome']);
            $oDisciplina->setCredito($aLinha['carga_horaria']);
            
            $aDisciplinas[] = $oDisciplina;
        }
       
        return $aDisciplinas;
    }
    
    
    
    public function listarDisciplinasPorTurma($codigo) {
        $sSelect = 'SELECT DISCIPLINA.* 
                      FROM DISCIPLINA 
                      JOIN DISCIPLINATURMA ON
                           DISCIPLINA.ID_DISCIPLINA = DISCIPLINATURMA.ID_DISCIPLINA 
                     WHERE DISCIPLINATURMA.ID_TURMA = '.$codigo.'
                     ORDER BY 1';
        $oResultado = pg_query($this->conexao, $sSelect);
        $aDisciplinas = [];
        
        while ($aLinha = pg_fetch_array($oResultado, null, PGSQL_ASSOC)){
            $oDisciplina = new ModelDisciplina();
            $oDisciplina->setCodigo($aLinha['id_disciplina']);
            $oDisciplina->setNome($aLinha['nome']);
            $oDisciplina->setCredito($aLinha['carga_horaria']);
            
            $aDisciplinas[] = $oDisciplina;
        }
        return $aDisciplinas;
    }

    public function selecionar($codigo) {
        $sSelect = 'SELECT * FROM DISCIPLINA WHERE ID_DISCIPLINA = '.$codigo.'';
        $oResultadoDisciplina = pg_query($this->conexao, $sSelect);
        $oDisciplina = new ModelDisciplina();
        
        while ($aLinha = pg_fetch_array($oResultadoDisciplina, null, PGSQL_ASSOC)){            
            $oDisciplina->setCodigo($aLinha['id_disciplina']);
            $oDisciplina->setNome($aLinha['nome']);
            $oDisciplina->setCargaHoraria($aLinha['carga_horaria']);
        }
        return $oDisciplina;
    }
    
}
