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
        $sUpdate = 'UPDATE AULA
                       SET horario_inicio =\''.$this->ModelAula->getHorarioInicio().'\' ,
                           horario_fim = \''.$this->ModelAula->getHorarioFim().'\' 
                     WHERE id_aula = '.$this->ModelAula->getCodigo().' ';
      
        return pg_query($this->conexao, $sUpdate);
    }

    public function excluirRegistro($codigo) {
        $sDelete = 'DELETE FROM AULA WHERE id_aula = '.$codigo.'';
        return pg_query($this->conexao, $sDelete);
    }

    public function inserirRegistro() {
        $aColunas = [
            'horario_inicio',
            'horario_fim',
            'id_discproftur'
        ];
        $aValores = [
            $this->ModelAula->getHorarioInicio(),
            $this->ModelAula->getHorarioFim(),
            $this->ModelAula->getDisciplinaProfessorTurma()->getCodigo()
        ];        
        return parent::inserir('aula', $aColunas, $aValores);
    }

        
    
    public function listarRegistros() {
        $sSelect = 'SELECT * 
                      FROM AULA';
        $oResultado = pg_query($this->conexao, $sSelect);
        $aAulas = [];
        
        while ($aLinha = pg_fetch_array($oResultado, null, PGSQL_ASSOC)){
            $oAula = new ModelAula();
            $oAula->setCodigo($aLinha['id_aula']);
            $oAula->setHorarioInicio($aLinha['horario_inicio']);
            $oAula->setHorarioFim($aLinha['horario_fim']);
            
            $aAulas[] = $oAula;
        }
        return $aAulas;
    }
    public function listarComFiltro($sIndice, $sValor) {
        $sSelect = 'SELECT * 
                      FROM AULA  
                     WHERE '.$sIndice.' = \''.$sValor.'\'   
                     ORDER BY 1;';
        
        $oResultado = pg_query($this->conexao, $sSelect);
        $aAulas = [];
        
        while ($aLinha = pg_fetch_array($oResultado, null, PGSQL_ASSOC)){
            $oAula = new ModelAula();
            $oAula->setCodigo($aLinha['id_aula']);
            $oAula->setHorarioInicio($aLinha['horario_inicio']);
            $oAula->setHorarioFim($aLinha['horario_fim']);
            
            $aAulas[] = $oAula;
        }
        return $aAulas;
    }
    
    public function selecionar($codigo) {
        $sSelect = 'SELECT * FROM AULA WHERE ID_AULA = '.$codigo.'';
        $oResultadoAula = pg_query($this->conexao, $sSelect);
        $oAula = new ModelAula();
        
        while ($aLinha = pg_fetch_array($oResultadoAula, null, PGSQL_ASSOC)){
            $oAula->setCodigo($aLinha['id_aula']);
            $oAula->setHorarioInicio($aLinha['horario_inicio']);
            $oAula->setHorarioFim($aLinha['horario_fim']);
            
           }
        return $oAula;
    }

}
