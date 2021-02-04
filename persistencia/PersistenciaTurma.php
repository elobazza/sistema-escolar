<?php

class PersistenciaTurma extends PersistenciaPadrao {
    
    /** @var ModelTurma $ModelTurma */
    private $ModelTurma;
    
    /** @var ModelDisciplina $ModelDisciplina */
    private $ModelDisciplina;
    
    function getModelTurma() {
        return $this->ModelTurma;
    }

    function setModelTurma($ModelTurma) {
        $this->ModelTurma = $ModelTurma;
    }

    public function inserirRegistro() {
        $aColunas = [
            'turnome'
        ];
        $aValores = [
            $this->ModelTurma->getNome()
        ];
        
        parent::inserir('tbturma', $aColunas, $aValores);
        
        $oResource = pg_query($this->conexao, 'SELECT MAX(turcodigo) as turcodigo FROM SISTEMAESCOLA.TBTURMA');
        
        if($aDadosTurma = pg_fetch_array($oResource)) {
            $this->ModelTurma->setCodigo($aDadosTurma['turcodigo']);
        }
        
        $this->inserirDisciplinasRelacionadas();
    }
    
    private function inserirDisciplinasRelacionadas() {
        foreach ($this->getModelTurma()->getDisciplina() as $oModelDisciplina) {
            $aColunas = [
                'turcodigo',
                'discodigo',
            ];
            
            $aValores = [
                $this->ModelTurma->getCodigo(),
                $oModelDisciplina->getCodigo(),
            ];
            
            parent::inserir('tbdisciplinaturma', $aColunas, $aValores);
        }
    }
    
    public function alterarRegistro() {
         $sUpdate = 'DELETE 
                       FROM SISTEMAESCOLA.TBDISCIPLINATURMA
                      WHERE turcodigo ='.$this->ModelTurma->getCodigo().' ';
         pg_query($this->conexao, $sUpdate);
         
         $this->inserirDisciplinasRelacionadas();
         
        $sUpdateFinal = 'UPDATE SISTEMAESCOLA.TBTURMA
                        SET turnome = \''.$this->ModelTurma->getNome().'\' 
                      WHERE turcodigo ='.$this->ModelTurma->getCodigo().' ';
         pg_query($this->conexao, $sUpdateFinal);
                  
    }

    public function excluirRegistro($codigo) {
        $sDelete = 'DELETE  
                      FROM SISTEMAESCOLA.TBDISCIPLINATURMA
                     WHERE TURCODIGO = '.$codigo.'';
        pg_query($this->conexao, $sDelete);

        $sDelete = 'DELETE  
                      FROM SISTEMAESCOLA.TBNOTA
                     WHERE  EXISTS (SELECT 1
                                     FROM SISTEMAESCOLA.TBALUNO
                                    WHERE TURCODIGO = '.$codigo.');';
        pg_query($this->conexao, $sDelete);
        
        $sDeleteDois = 'DELETE  
                      FROM SISTEMAESCOLA.TBALUNO
                     WHERE TURCODIGO = '.$codigo.'';
        pg_query($this->conexao, $sDeleteDois);
        
        $sDeleteTres = 'DELETE  
                      FROM SISTEMAESCOLA.TBSALAAULA
                     WHERE TURCODIGO = '.$codigo.'';
        pg_query($this->conexao, $sDeleteTres);
        
        $sDeleteFinal = 'DELETE 
                           FROM TURMA
                          WHERE ID_TURMA = '.$codigo.'';
        pg_query($this->conexao, $sDeleteFinal);
    }

    public function listarRegistros() {
    $sSelect = 'SELECT * 
                  FROM TURMA';
        $oResultado = pg_query($this->conexao, $sSelect);
        $aTurmas = [];
        
        while ($aLinha = pg_fetch_array($oResultado, null, PGSQL_ASSOC)){
            $oTurma = new ModelTurma();
            $oTurma->setCodigo($aLinha['id_turma']);
            $oTurma->setNome($aLinha['nome']);
            
            $aTurmas[] = $oTurma;
        }
        return $aTurmas;
    }
    
    public function listarTudo() {
    $sSelect = 'SELECT TURMA.*,
                       NOME
                  FROM TURMA
                 ';
        $oResultado = pg_query($this->conexao, $sSelect);
        $aTurmas = [];
        
        while ($aLinha = pg_fetch_array($oResultado, null, PGSQL_ASSOC)){
            $oTurma = new ModelTurma();
            $oPersistenciaDisciplina = new PersistenciaDisciplina();
            $oTurma->setCodigo($aLinha['id_turma']);
            $oTurma->setNome($aLinha['nome']);
            $oTurma->setDisciplina($oPersistenciaDisciplina->listarDisciplinasPorTurma($oTurma->getCodigo()));
            $aTurmas[] = $oTurma;
        }
        return $aTurmas;
    }
    
    public function listarComFiltro($sIndice, $sValor) {
    $sSelect = 'SELECT TURMA.*,
                       NOME
                  FROM TURMA
                 WHERE '.$sIndice.' = \''.$sValor.'\';' ;
        $oResultado = pg_query($this->conexao, $sSelect);
        $aTurmas = [];
        
        while ($aLinha = pg_fetch_array($oResultado, null, PGSQL_ASSOC)){
            $oTurma = new ModelTurma();
            $oPersistenciaDisciplina = new PersistenciaDisciplina();
            $oTurma->setCodigo($aLinha['id_turma']);
            $oTurma->setNome($aLinha['nome']);
            $oTurma->setDisciplina($oPersistenciaDisciplina->listarDisciplinasPorTurma($oTurma->getCodigo()));
            $aTurmas[] = $oTurma;
        }
        return $aTurmas;
    }
    
    public function selecionar($codigo) {
    $sSelect = 'SELECT TURMA.*,
                       NOME
                  FROM TURMA
                  WHERE ID_TURMA = '.$codigo.'';
        $oResultado = pg_query($this->conexao, $sSelect);
        $oTurma = new ModelTurma();
        
        while ($aLinha = pg_fetch_array($oResultado, null, PGSQL_ASSOC)){
            
            $oPersistenciaDisciplina = new PersistenciaDisciplina();
            $oTurma->setCodigo($aLinha['id_turma']);
            $oTurma->setNome($aLinha['nome']);
            $oTurma->setDisciplina($oPersistenciaDisciplina->listarDisciplinasPorTurma($oTurma->getCodigo()));
            }
        return $oTurma;
    }
}
