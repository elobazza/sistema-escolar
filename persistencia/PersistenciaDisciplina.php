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
        $sUpdate = 'UPDATE SISTEMAESCOLA.TBDISCIPLINA
                       SET disnome = \''.$this->ModelDisciplina->getNome().'\' ,
                           discredito = \''.$this->ModelDisciplina->getCredito().'\' 
                     WHERE discodigo ='.$this->ModelDisciplina->getCodigo().' ';
        
         pg_query($this->conexao, $sUpdate); 
    }

    public function excluirRegistro($codigo) {
        $sDelete = 'DELETE FROM SISTEMAESCOLA.TBPROFESSORDISCIPLINA WHERE DISCODIGO = '.$codigo.'';
        pg_query($this->conexao, $sDelete);
        $sDeleteDois = 'DELETE FROM SISTEMAESCOLA.TBDISCIPLINATURMA WHERE DISCODIGO = '.$codigo.'';
        pg_query($this->conexao, $sDeleteDois);
        $sDeleteTres = 'DELETE FROM SISTEMAESCOLA.TBNOTA WHERE DISCODIGO = '.$codigo.'';
        pg_query($this->conexao, $sDeleteTres);
        $sDeleteFinal = 'DELETE FROM SISTEMAESCOLA.TBDISCIPLINA WHERE DISCODIGO = '.$codigo.'';
        pg_query($this->conexao, $sDeleteFinal);
    }

    public function inserirRegistro() {
        $aColunas = [
            'disnome',
            'discredito'
        ];
        $aValores = [
            $this->ModelDisciplina->getNome(),
            $this->ModelDisciplina->getCredito()
        ];
        
        parent::inserir('tbdisciplina', $aColunas, $aValores);
    }

    public function listarRegistros() {
        $sSelect = 'SELECT * FROM SISTEMAESCOLA.TBDISCIPLINA ORDER BY 1';
        $oResultado = pg_query($this->conexao, $sSelect);
        $aDisciplinas = [];
        
        while ($aLinha = pg_fetch_array($oResultado, null, PGSQL_ASSOC)){
            $oDisciplina = new ModelDisciplina();
            $oDisciplina->setCodigo($aLinha['discodigo']);
            $oDisciplina->setNome($aLinha['disnome']);
            $oDisciplina->setCredito($aLinha['discredito']);
            
            $aDisciplinas[] = $oDisciplina;
        }
        return $aDisciplinas;
    }
    public function listarComFiltro($sIndice, $sValor) {
        $sSelect = 'SELECT * 
                      FROM SISTEMAESCOLA.TBDISCIPLINA 
                     WHERE '.$sIndice.' = \''.$sValor.'\'
                    ORDER BY 1;';
        $oResultado = pg_query($this->conexao, $sSelect);
        $aDisciplinas = [];
        
        while ($aLinha = pg_fetch_array($oResultado, null, PGSQL_ASSOC)){
            $oDisciplina = new ModelDisciplina();
            $oDisciplina->setCodigo($aLinha['discodigo']);
            $oDisciplina->setNome($aLinha['disnome']);
            $oDisciplina->setCredito($aLinha['discredito']);
            
            $aDisciplinas[] = $oDisciplina;
        }
        return $aDisciplinas;
    }
    
    public function listarDisciplinasPorProfessor($codigo) {
        $sSelect = 'SELECT TBDISCIPLINA.* 
                      FROM SISTEMAESCOLA.TBDISCIPLINA 
                      JOIN SISTEMAESCOLA.TBPROFESSORDISCIPLINA ON
                           TBDISCIPLINA.DISCODIGO = TBPROFESSORDISCIPLINA.DISCODIGO
                     WHERE TBPROFESSORDISCIPLINA.PROCODIGO = '.$codigo;
        $oResultado = pg_query($this->conexao, $sSelect);
        $aDisciplinas = [];
        
        while ($aLinha = pg_fetch_array($oResultado, null, PGSQL_ASSOC)){
            $oDisciplina = new ModelDisciplina();
            $oDisciplina->setCodigo($aLinha['discodigo']);
            $oDisciplina->setNome($aLinha['disnome']);
            $oDisciplina->setCredito($aLinha['discredito']);
            
            $aDisciplinas[] = $oDisciplina;
        }
       
        return $aDisciplinas;
    }
    
    
    
    public function listarDisciplinasPorTurma($codigo) {
        $sSelect = 'SELECT TBDISCIPLINA.* 
                      FROM SISTEMAESCOLA.TBDISCIPLINA 
                      JOIN SISTEMAESCOLA.TBDISCIPLINATURMA ON
                           TBDISCIPLINA.DISCODIGO = TBDISCIPLINATURMA.DISCODIGO
                     WHERE TBDISCIPLINATURMA.TURCODIGO = '.$codigo.'
                     ORDER BY 1';
        $oResultado = pg_query($this->conexao, $sSelect);
        $aDisciplinas = [];
        
        while ($aLinha = pg_fetch_array($oResultado, null, PGSQL_ASSOC)){
            $oDisciplina = new ModelDisciplina();
            $oDisciplina->setCodigo($aLinha['discodigo']);
            $oDisciplina->setNome($aLinha['disnome']);
            $oDisciplina->setCredito($aLinha['discredito']);
            
            $aDisciplinas[] = $oDisciplina;
        }
        return $aDisciplinas;
    }

    public function selecionar($codigo) {
        $sSelect = 'SELECT * FROM SISTEMAESCOLA.TBDISCIPLINA WHERE DISCODIGO = '.$codigo.'';
        $oResultadoDisciplina = pg_query($this->conexao, $sSelect);
        $oDisciplina = new ModelDisciplina();
        
        while ($aLinha = pg_fetch_array($oResultadoDisciplina, null, PGSQL_ASSOC)){
            
            $oDisciplina->setCodigo($aLinha['discodigo']);
            $oDisciplina->setNome($aLinha['disnome']);
            $oDisciplina->setCredito($aLinha['discredito']);
           }
        return $oDisciplina;
    }
    
}
