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
        $sUpdate = 'UPDATE SISTEMAESCOLA.TBNOTA
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

    public function listarRegistros() {
        $sSelect = 'SELECT * FROM SISTEMAESCOLA.TBNOTA';
        $oResultado = pg_query($this->conexao, $sSelect);
        $aNotas = [];
        
        while ($aLinha = pg_fetch_array($oResultado, null, PGSQL_ASSOC)){
            $oNota = new ModelNota();
            $oAluno = new ModelAluno();
            $oDisciplina = new ModelDisciplina();
            
            $oNota->setCodigo($aLinha['notcodigo']);
            $oNota->setNota($aLinha['notnota']);
            
            $oAluno->setCodigo($aLinha['alucodigo']);
            $oNota->setAluno($oAluno);
            
            $oDisciplina->setCodigo($aLinha['discodigo']);
            $oNota->setDisciplina($oDisciplina);
          
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
    
}


