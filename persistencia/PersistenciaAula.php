<?php
/**
 * @author Eloisa Bazzanella e Maria Eduarda Buzana
 */
class PersistenciaAula extends PersistenciaPadrao {
    /** @var ModelAula $ModelAula */
    private $ModelAula;
    
    function getModelAula() {
        return $this->ModelAula;
    }

    function setModelAula($ModelAula) {
        $this->ModelAula = $ModelAula;
    }

    public function alterarRegistro() {
        $sUpdate = 'UPDATE SISTEMAESCOLA.TBAULA
                       SET aulhorarioinicio =\''.$this->ModelAula->getHorarioInicio().'\' ,
                           aulhorariofim = \''.$this->ModelAula->getHorarioFim().'\' 
                     WHERE aulcodigo = '.$this->ModelAula->getCodigo().' ';
      
         pg_query($this->conexao, $sUpdate);
    }

    public function excluirRegistro($codigo) {
        $sDelete = 'DELETE FROM SISTEMAESCOLA.TBAULA WHERE AULCODIGO = '.$codigo.'';
        pg_query($this->conexao, $sDelete);
    }

    public function inserirRegistro() {
        $aColunas = [
            'aulhorarioinicio',
            'aulhorariofim'
        ];
        $aValores = [
            $this->ModelAula->getHorarioInicio(),
            $this->ModelAula->getHorarioFim()
        ];
        
        parent::inserir('tbaula', $aColunas, $aValores);
    }

        
    
    public function listarRegistros() {
        $sSelect = 'SELECT * 
                      FROM SISTEMAESCOLA.TBAULA 
                     ORDER BY 1';
        $oResultado = pg_query($this->conexao, $sSelect);
        $aAulas = [];
        
        while ($aLinha = pg_fetch_array($oResultado, null, PGSQL_ASSOC)){
            $oAula = new ModelAula();
            $oAula->setCodigo($aLinha['aulcodigo']);
            $oAula->setHorarioInicio($aLinha['aulhorarioinicio']);
            $oAula->setHorarioFim($aLinha['aulhorariofim']);
            
            $aAulas[] = $oAula;
        }
        return $aAulas;
    }
    public function listarComFiltro($sIndice, $sValor) {
        $sSelect = 'SELECT * 
                      FROM SISTEMAESCOLA.TBAULA  
                     WHERE '.$sIndice.' = \''.$sValor.'\'   
                     ORDER BY 1;';
        
        $oResultado = pg_query($this->conexao, $sSelect);
        $aAulas = [];
        
        while ($aLinha = pg_fetch_array($oResultado, null, PGSQL_ASSOC)){
            $oAula = new ModelAula();
            $oAula->setCodigo($aLinha['aulcodigo']);
            $oAula->setHorarioInicio($aLinha['aulhorarioinicio']);
            $oAula->setHorarioFim($aLinha['aulhorariofim']);
            
            $aAulas[] = $oAula;
        }
        return $aAulas;
    }
    
    public function selecionar($codigo) {
        $sSelect = 'SELECT * FROM SISTEMAESCOLA.TBAULA WHERE AULCODIGO = '.$codigo.'';
        $oResultadoAula = pg_query($this->conexao, $sSelect);
        $oAula = new ModelAula();
        
        while ($aLinha = pg_fetch_array($oResultadoAula, null, PGSQL_ASSOC)){
            $oAula->setCodigo($aLinha['aulcodigo']);
            $oAula->setHorarioInicio($aLinha['aulhorarioinicio']);
            $oAula->setHorarioFim($aLinha['aulhorariofim']);
            
           }
        return $oAula;
    }

}
