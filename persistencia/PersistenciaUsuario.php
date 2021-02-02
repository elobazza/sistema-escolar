<?php

/**
 * Classe de Persistência de Usuário.
 * 
 * @author  Eloísa Bazzanella, Maria Eduarda Buzana
 * @package persistencia
 * @sinse   29/12/2020
 */
class PersistenciaUsuario extends PersistenciaPadrao {
    
    /** @var ModelUsuario $ModelUsuario */
    private $ModelUsuario;
        
    function getModelUsuario() {
        return $this->ModelUsuario;
    }

    function setModelUsuario($ModelUsuario) {
        $this->ModelUsuario = $ModelUsuario;
    }

    public function inserirRegistro() {
        $aColunas = [
            'login', 
            'senha',
            'tipo'
        ];
        
        $aValores = [
            $this->ModelUsuario->getLogin(),
            md5($this->ModelUsuario->getSenha()),
            $this->ModelUsuario->getTipo()
        ];
        
        parent::inserir('usuario', $aColunas, $aValores);
    }
    
    public function alterarRegistro() {
        $sUpdate = "UPDATE USUARIO
                       SET login = '{$this->ModelAluno->getNome()   }',
                           senha = '{$this->ModelAluno->getCpf()    }',
                           tipo  = '{$this->ModelAluno->getContato()}' 
                     WHERE id_usuario = {$this->ModelAluno->getCodigo()}";
        
         pg_query($this->conexao, $sUpdate); 
    }

    public function excluirRegistro($codigo) {
        $sDeleteFinal = 'DELETE FROM USUARIO WHERE ID_USUARIO = '.$codigo.'';
        pg_query($this->conexao, $sDeleteFinal);
    }
    
    public function listarRegistros() {
        $sSelect           = 'SELECT * FROM USUARIO';
        $oResultadoUsuario = pg_query($this->conexao, $sSelect);
        $aUsuarios         = [];
        
        while ($aLinha = pg_fetch_array($oResultadoUsuario, null, PGSQL_ASSOC)){            
            $oUsuario = new ModelUsuario();
            $oUsuario->setCodigo($aLinha['id_usuario']);
            $oUsuario->setLogin($aLinha['login']);
            $oUsuario->setSenha($aLinha['senha']);
            $oUsuario->setTipo($aLinha['tipo']);
            
            $aUsuarios[] = $oUsuario;
        }
        return $aUsuarios;
    }
    
    public function selecionar($codigo) {
        $sSelect           = 'SELECT * FROM USUARIO WHERE ID_USUARIO = '.$codigo.'';
        $oResultadoUsuario = pg_query($this->conexao, $sSelect);
        $oUsuario          = new ModelUsuario();
        
        while ($aLinha = pg_fetch_array($oResultadoUsuario, null, PGSQL_ASSOC)){
            $oUsuario->setCodigo($aLinha['id_usuario']);
            $oUsuario->setLogin($aLinha['login']);
            $oUsuario->setSenha($aLinha['senha']);
            $oUsuario->setTipo($aLinha['tipo']);
        }
        return $oUsuario;
    }
    
    public function listarComFiltro($sIndice, $sValor) {
        $sSelect = 'SELECT *
                      FROM usuario
                     WHERE '.$sIndice.' = \''.$sValor.'\';' ;

        $oResultado = pg_query($this->conexao, $sSelect);
        $aUsuarios  = [];
        
        while ($aLinha = pg_fetch_array($oResultado, null, PGSQL_ASSOC)){
            $oUsuario = new ModelUsuario();
            $oUsuario->setCodigo($aLinha['id_usuario']);
            $oUsuario->setLogin($aLinha['login']);
            $oUsuario->setSenha($aLinha['senha']);
            $oUsuario->setTipo($aLinha['tipo']);
            
            $aUsuarios[] = $oUsuario;
        }
        return $aUsuarios;
    }
    
    public function listarTudo() {
        $sSelect    = 'SELECT * FROM usuario ORDER BY 1;' ;
        $oResultado = pg_query($this->conexao, $sSelect);
        $aUsuarios  = [];
        
        while ($aLinha = pg_fetch_array($oResultado, null, PGSQL_ASSOC)) {            
            $oUsuario = new ModelUsuario();
            $oUsuario->setCodigo($aLinha['id_usuario']);
            $oUsuario->setLogin($aLinha['login']);
            $oUsuario->setSenha($aLinha['senha']);
            $oUsuario->setTipo($aLinha['tipo']);
            
            array_push($aUsuarios, $oUsuario);
        }        
        return $aUsuarios;
    }
    
    public function selecionarLogin($login, $senha) {  
        $sSelect = 'SELECT * 
                      FROM USUARIO
                     WHERE LOGIN = \''.$login.'\' 
                       AND SENHA = \''.md5($senha).'\' ;';
        
        $oResultado = pg_query($this->conexao, $sSelect);
        $xUsuario   = false;
        
        while ($aLinha = pg_fetch_array($oResultado, null, PGSQL_ASSOC)){            
            $xUsuario = new ModelUsuario();
            $xUsuario->setCodigo($aLinha['id_usuario']);
            $xUsuario->setTipo($aLinha['tipo']);
            $xUsuario->setSenha($aLinha['senha']);
            $xUsuario->setLogin($aLinha['login']);            
        }
        return $xUsuario;
    }
    
}