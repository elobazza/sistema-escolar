<?php

class PersistenciaCidade extends PersistenciaPadrao{
    /** @var ModelCidade $ModelCidade */
    private $ModelCidade;
    
    function getModelCidade() {
        return $this->ModelCidade;
    }

    function setModelCidade($ModelCidade) {
        $this->ModelCidade = $ModelCidade;
    }

    public function alterarRegistro() {
        $sUpdate = 'UPDATE SISTEMAESCOLA.TBCIDADE
                       SET cidnome = \''.$this->ModelCidade->getNome().'\'
                     WHERE cidcodigo ='.$this->ModelCidade->getCodigo().' ';
        
         pg_query($this->conexao, $sUpdate); 
    }

    public function excluirRegistro($codigo) {
        $sDelete = 'DELETE FROM SISTEMAESCOLA.TBESCOLA WHERE CIDCODIGO = '.$codigo.'';
        pg_query($this->conexao, $sDelete);
        $sDeleteFinal = 'DELETE FROM SISTEMAESCOLA.TBCIDADE WHERE CIDCODIGO = '.$codigo.'';
        pg_query($this->conexao, $sDeleteFinal);
    }

    public function inserirRegistro() {
         $aColunas = [
            'cidnome'
        ];
        $aValores = [
            $this->ModelCidade->getNome()
        ];
        
        parent::inserir('tbcidade', $aColunas, $aValores);
    }

    public function listarRegistros() {
        $sSelect = 'SELECT * FROM SISTEMAESCOLA.TBCIDADE ORDER BY 1';
        $oResultado = pg_query($this->conexao, $sSelect);
        $aCidades = [];
        
        while ($aLinha = pg_fetch_array($oResultado, null, PGSQL_ASSOC)){
            $oCidade = new ModelCidade();
            $oCidade->setCodigo($aLinha['cidcodigo']);
            $oCidade->setNome($aLinha['cidnome']);
            
            $aCidades[] = $oCidade;
        }
        return $aCidades;
    }
    public function listarComFiltro($sIndice, $sValor) {
        $sSelect = 'SELECT * 
                      FROM SISTEMAESCOLA.TBCIDADE 
                     WHERE '.$sIndice.' = \''.$sValor.'\'
                     ORDER BY 1';
        $oResultado = pg_query($this->conexao, $sSelect);
        $aCidades = [];
        
        while ($aLinha = pg_fetch_array($oResultado, null, PGSQL_ASSOC)){
            $oCidade = new ModelCidade();
            $oCidade->setCodigo($aLinha['cidcodigo']);
            $oCidade->setNome($aLinha['cidnome']);
            
            $aCidades[] = $oCidade;
        }
        return $aCidades;
    }
    
    public function selecionar($codigo) {
        $sSelect = 'SELECT * FROM SISTEMAESCOLA.TBCIDADE WHERE CIDCODIGO = '.$codigo.'';
        $oResultadoCidade = pg_query($this->conexao, $sSelect);
        $oCidade = new ModelCidade();
        
        while ($aLinha = pg_fetch_array($oResultadoCidade, null, PGSQL_ASSOC)){
            $oCidade->setNome($aLinha['cidnome']);
            $oCidade->setCodigo($aLinha['cidcodigo']);
           }
        return $oCidade;
    }

}
