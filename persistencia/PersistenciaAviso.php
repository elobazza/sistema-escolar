<?php
/**
 * @author Eloísa Bazzanella e Maria Eduarda Buzana
 */
class PersistenciaAviso extends PersistenciaPadrao {
    
    /** @var ModelAviso $ModelAviso */
    private $ModelAviso;
    
    function getModelAviso() {
        return $this->ModelAviso;
    }

    function setModelAviso($ModelAviso) {
        $this->ModelAviso = $ModelAviso;
    }
   
    public function inserirRegistro() {
        $aColunas = [
            'data',
            'hora',
            'titulo',
            'mensagem'
        ];
        
        $aValores = [
            $this->ModelAviso->getData(),
            $this->ModelAviso->getHora(),
            $this->ModelAviso->getTitulo(),
            $this->ModelAviso->getMensagem()
        ];
        
        return parent::inserir('aviso', $aColunas, $aValores);
    }

    public function listarRegistros() {
        $sSelect = 'SELECT * FROM aviso';
        
        $oResultadoAviso = pg_query($this->conexao, $sSelect);
        $aAvisos = [];
        
        while ($aLinha = pg_fetch_array($oResultadoAviso, null, PGSQL_ASSOC)) {
            $oAviso = new ModelAviso();
            $oAviso->setCodigo($aLinha['id_aviso']);
            $oAviso->setData($aLinha['data']);
            $oAviso->setHora($aLinha['hora']);
            $oAviso->setTitulo($aLinha['titulo']);
            $oAviso->setMensagem($aLinha['mensagem']);
      
            array_push($aAvisos, $oAviso);
        }  
        return $aAvisos;
    }
    
    public function alterarRegistro() {}
    public function excluirRegistro($codigo) {}

}
