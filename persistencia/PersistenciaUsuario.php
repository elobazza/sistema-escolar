<?php

/**
 * Classe de Persistência de Usuário.
 * 
 * @author  Eloísa Bazzanella, Maria Eduarda Buzana
 * @package persistencia
 * @since   29/12/2020
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
        
        return parent::inserir('usuario', $aColunas, $aValores);
    }
    
    public function alterarRegistro() {
        $sUpdate = 'UPDATE USUARIO
                       SET login = \''. $this->ModelUsuario->getLogin()   .'\',
                           senha = \''. md5($this->ModelUsuario->getSenha()) .'\' 
                     WHERE id_usuario = '. $_SESSION['id'] .'';
        
        return pg_query($this->conexao, $sUpdate); 
    }

    public function excluirRegistro($codigo) {
        $sDeleteFinal = 'DELETE FROM USUARIO WHERE ID_USUARIO = '.$codigo.'';
        return pg_query($this->conexao, $sDeleteFinal);
    }
    
    public function selecionarLogin($login, $senha) {  
        $sSelect = 'SELECT * 
                      FROM USUARIO
                     WHERE LOGIN = \''.$login.'\' 
                       AND SENHA = \''.md5($senha).'\' ;';
        
        $oResultado = pg_query($this->conexao, $sSelect);
        $oUsuario   = new ModelUsuario();
        
        while ($aLinha = pg_fetch_array($oResultado, null, PGSQL_ASSOC)){            
            $oUsuario = new ModelUsuario();
            $oUsuario->setCodigo($aLinha['id_usuario']);
            $oUsuario->setTipo($aLinha['tipo']);
            $oUsuario->setSenha($aLinha['senha']);
            $oUsuario->setLogin($aLinha['login']);            
        }
        return $oUsuario;
    }

    public function listarRegistros() {}

}