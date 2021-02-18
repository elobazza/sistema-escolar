<?php
/**
 * @author Eloisa Bazzanella e Maria Eduarda Buzana
 */
class PersistenciaTurma extends PersistenciaPadrao {
    
    /** @var ModelTurma $ModelTurma */
    private $ModelTurma;
    
    function getModelTurma() {
        return $this->ModelTurma;
    }

    function setModelTurma($ModelTurma) {
        $this->ModelTurma = $ModelTurma;
    }

    public function inserirRegistro() {
        $aColunas = [
            'nome'
        ];
        $aValores = [
            $this->ModelTurma->getNome()
        ];
        
        return parent::inserir('turma', $aColunas, $aValores);
    }
        
    public function alterarRegistro() {
        $sUpdateFinal = 'UPDATE TURMA
                            SET nome = \''.$this->ModelTurma->getNome().'\' 
                          WHERE id_turma ='.$this->ModelTurma->getCodigo().' ';
        return pg_query($this->conexao, $sUpdateFinal);
                  
    }

    public function excluirRegistro($codigo) {
        $sDeleteFinal = 'DELETE 
                           FROM TURMA
                          WHERE ID_TURMA = '.$codigo.'';
        return pg_query($this->conexao, $sDeleteFinal);
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
            $oTurma->setCodigo($aLinha['id_turma']);
            $oTurma->setNome($aLinha['nome']);
        }
        return $oTurma;
    }
}
