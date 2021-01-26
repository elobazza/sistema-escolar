<?php

class PersistenciaSala extends PersistenciaPadrao{
    /** @var ModelSala $ModelSala */
    private $ModelSala;
    
    function getModelSala() {
        return $this->ModelSala;
    }

    function setModelSala($ModelSala) {
        $this->ModelSala = $ModelSala;
    }

    public function alterarRegistro() {
        $sUpdate = 'UPDATE SISTEMAESCOLA.TBSALA
                       SET saldescricao = \''.$this->ModelSala->getDescricao().'\' ,
                           esccodigo = \''.$this->ModelSala->getEscola()->getCodigo().'\' 
                     WHERE salcodigo ='.$this->ModelSala->getCodigo().' ';
        
         pg_query($this->conexao, $sUpdate); 
    }

    public function excluirRegistro($codigo) {
        $sDelete = 'DELETE FROM SISTEMAESCOLA.TBSALAAULA WHERE SALCODIGO = '.$codigo.'';
        pg_query($this->conexao, $sDelete);
        $sDeleteFinal = 'DELETE FROM SISTEMAESCOLA.TBSALA WHERE SALCODIGO = '.$codigo.'';
        pg_query($this->conexao, $sDeleteFinal);
    }

    public function inserirRegistro() {
        $aColunas = [
            'saldescricao',
            'esccodigo'
        ];
        $aValores = [
            $this->ModelSala->getDescricao(),
            $this->ModelSala->getEscola()->getCodigo()
        ];
        
        parent::inserir('tbsala', $aColunas, $aValores);
    }

    public function listarRegistros() {
        $sSelect = 'SELECT * FROM SISTEMAESCOLA.TBSALA';
        $oResultado = pg_query($this->conexao, $sSelect);
        $aSalas = [];
        
        while ($aLinha = pg_fetch_array($oResultado, null, PGSQL_ASSOC)){
            
            $oSala = new ModelSala();
            $oEscola = new ModelEscola();
            $oSala->setCodigo($aLinha['salcodigo']);
            $oSala->setDescricao($aLinha['saldescricao']);
            
            $oEscola->setCodigo($aLinha['esccodigo']);
            $oSala->setEscola($oEscola);

            $aSalas[] = $oSala;
        }
        return $aSalas;
    }

    
    public function selecionar($codigo) {
        $sSelect = 'SELECT * FROM SISTEMAESCOLA.TBSALA WHERE SALCODIGO = '.$codigo.'';
        $oResultadoSala = pg_query($this->conexao, $sSelect);
        $oSala = new ModelSala();
        
        while ($aLinha = pg_fetch_array($oResultadoSala, null, PGSQL_ASSOC)){
            $oEscola = new ModelEscola();
            $oSala->setCodigo($aLinha['salcodigo']);
            $oSala->setDescricao($aLinha['saldescricao']);
            
            $oEscola->setCodigo($aLinha['esccodigo']);
            $oSala->setEscola($oEscola);
           }
        return $oSala;
    }
    
    public function listarTudo() {
        $sSelect = 'SELECT TBSALA.SALCODIGO,
                           TBSALA.SALDESCRICAO,
                           TBESCOLA.ESCNOME                           
                      FROM SISTEMAESCOLA.TBSALA
                      JOIN SISTEMAESCOLA.TBESCOLA ON
                           TBESCOLA.ESCCODIGO = TBSALA.ESCCODIGO
                     WHERE TBESCOLA.ESCCODIGO = '.$_SESSION['id'].';';
        $oResultado = pg_query($this->conexao, $sSelect);
        $aSalas = [];
        
        while ($aLinha = pg_fetch_array($oResultado, null, PGSQL_ASSOC)){
            $oSala = new ModelSala();
            $oEscola = new ModelEscola();
            $oSala->setCodigo($aLinha['salcodigo']);
            $oSala->setDescricao($aLinha['saldescricao']);
            $oEscola->setNome($aLinha['escnome']);
            $oSala->setEscola($oEscola);
            $aSalas[] = $oSala;
        }
        return $aSalas;
    }
    
    public function listarComFiltro($sIndice, $sValor) {
        $sSelect = 'SELECT TBSALA.SALCODIGO,
                           TBSALA.SALDESCRICAO,
                           TBESCOLA.ESCNOME                           
                      FROM SISTEMAESCOLA.TBSALA
                      JOIN SISTEMAESCOLA.TBESCOLA ON
                           TBESCOLA.ESCCODIGO = TBSALA.ESCCODIGO
                      WHERE '.$sIndice.' = \''.$sValor.'\'
                        AND TBESCOLA.ESCCODIGO = '.$_SESSION['id'].' ;' ;
        $oResultado = pg_query($this->conexao, $sSelect);
        $aSalas = [];
        
        while ($aLinha = pg_fetch_array($oResultado, null, PGSQL_ASSOC)){
            $oSala = new ModelSala();
            $oEscola = new ModelEscola();
            $oSala->setCodigo($aLinha['salcodigo']);
            $oSala->setDescricao($aLinha['saldescricao']);
            $oEscola->setNome($aLinha['escnome']);
            $oSala->setEscola($oEscola);
            $aSalas[] = $oSala;
        }
        return $aSalas;
    }
}
