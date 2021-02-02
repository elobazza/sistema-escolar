<?php

/**
 * Classe de Persistência de Endereço.
 * 
 * @author  Eloísa Bazzanella, Maria Eduarda Buzana
 * @package persistencia
 * @sinse   29/12/2020
 */
class PersistenciaEndereco extends PersistenciaPadrao{
    
    /** @var ModelEndereco $ModelEndereco */
    private $ModelEndereco;
    
    function getModelEndereco() {
        return $this->ModelEndereco;
    }

    function setModelEndereco($ModelEndereco) {
        $this->ModelEndereco = $ModelEndereco;
    }

    public function alterarRegistro() {
        $sUpdate = 'UPDATE ESCOLA
                       SET nome      = \''.$this->ModelEndereco->getNome().'\' ,
                           contato   = \''.$this->ModelEndereco->getContato().'\' 
                     WHERE id_escola ='.$this->ModelEndereco->getUsuario()->getCodigo().' ';
        
         pg_query($this->conexao, $sUpdate); 
    }

    public function excluirRegistro($codigo) {
        $sDelete = 'DELETE FROM ESCOLA WHERE ID_ESCOLA = '.$codigo.'';
        pg_query($this->conexao, $sDelete);
    }

    public function inserirRegistro() {        
        $aColunas = [
            'id_escola',
            'estado',
            'cidade',
            'bairro',
            'rua',
            'numero',
            'complemento'
        ];
        
        $aValores = [
            $this->ModelEndereco->getEscola()->getUsuario()->getCodigo(),
            $this->ModelEndereco->getEstado(),
            $this->ModelEndereco->getCidade(),
            $this->ModelEndereco->getBairro(),
            $this->ModelEndereco->getRua(),
            $this->ModelEndereco->getNumero(),
            $this->ModelEndereco->getComplemento(),
        ];
        
        parent::inserir('endereco', $aColunas, $aValores);
    }

    public function listarRegistros() {
        $sSelect = 'SELECT *  
                      FROM ESCOLA
                      JOIN USUARIO
                        ON id_escola = id_usuario';
        $oResultado = pg_query($this->conexao, $sSelect);
        $aEnderecos = [];
        
        while ($aLinha = pg_fetch_array($oResultado, null, PGSQL_ASSOC)){
            $oEndereco  = new ModelEndereco();
            $oUsuario = new ModelUsuario();
            
            $oEndereco->setContato($aLinha['contato']);
            $oEndereco->setNome($aLinha['nome']);
            
            $oUsuario->setCodigo($aLinha['id_escola']);
            $oUsuario->setLogin($aLinha['login']);
            $oUsuario->setSenha($aLinha['senha']);
            $oUsuario->setTipo($aLinha['tipo']);
            
            $oEndereco->setUsuario($oUsuario);
            
            $aEnderecos[] = $oEndereco;
        }
        return $aEnderecos;
    }
    
    public function listarComFiltro($sIndice, $sValor) {
        $sSelect = 'SELECT *
                      FROM ESCOLA 
                      JOIN USUARIO
                        ON id_usuario = id_escola
                     WHERE '.$sIndice.' = \''.$sValor.'\';' ;
        $oResultado = pg_query($this->conexao, $sSelect);
        $aEnderecos = [];
        
        while ($aLinha = pg_fetch_array($oResultado, null, PGSQL_ASSOC)){
            $oEndereco  = new ModelEndereco();
            $oUsuario = new ModelUsuario();
            
            $oEndereco->setContato($aLinha['contato']);
            $oEndereco->setNome($aLinha['nome']);
            
            $oUsuario->setCodigo($aLinha['id_escola']);
            $oUsuario->setLogin($aLinha['login']);
            $oUsuario->setSenha($aLinha['senha']);
            $oUsuario->setTipo($aLinha['tipo']);
            
            $oEndereco->setUsuario($oUsuario);
            
            $aEnderecos[] = $oEndereco;
        }        
        return $aEnderecos;
    }
    
    public function selecionar($codigo) {
        $sSelect = 'SELECT * 
                      FROM ESCOLA 
                     WHERE id_escola = '.$codigo.'';
        
        $oResultadoEndereco = pg_query($this->conexao, $sSelect);
        $oEndereco          = new ModelEndereco();
        $oUsuario         = new ModelUsuario();
        
        while ($aLinha = pg_fetch_array($oResultadoEndereco, null, PGSQL_ASSOC)){
            $oEndereco->setContato($aLinha['contato']);
            $oEndereco->setNome($aLinha['nome']);
            
            $oUsuario->setCodigo($aLinha['id_escola']);
            $oUsuario->setLogin($aLinha['login']);
            $oUsuario->setSenha($aLinha['senha']);
            $oUsuario->setTipo($aLinha['tipo']);
            
            $oEndereco->setUsuario($oUsuario);
        }
        return $oEndereco;
    }
    
    //FALTANTES
    
    public function listarEnderecosPorProfessor($codigo) {
        $sSelect = 'SELECT TBESCOLA.*
                      FROM SISTEMAESCOLA.TBESCOLA 
                      JOIN SISTEMAESCOLA.TBPROFESSORESCOLA ON
                           TBESCOLA.ESCCODIGO = TBPROFESSORESCOLA.ESCCODIGO
                     WHERE TBPROFESSORESCOLA.PROCODIGO = '.$codigo.';';
        $oResultado = pg_query($this->conexao, $sSelect);
        $aEnderecos = [];
        
        while ($aLinha = pg_fetch_array($oResultado, null, PGSQL_ASSOC)){
            $oEndereco = new ModelEndereco();
            $oCidade = new ModelCidade();
            $oEndereco->setCodigo($aLinha['esccodigo']);
            $oEndereco->setNome($aLinha['escnome']);
            $oEndereco->setEndereco($aLinha['escendereco']);
            $oEndereco->setContato($aLinha['esccontato']);
            $oEndereco->setLogin($aLinha['esclogin']);
            
            $oCidade->setCodigo($aLinha['cidcodigo']);
            $oEndereco->setCidade($oCidade);
            
            $aEnderecos[] = $oEndereco;
        }
        
        return $aEnderecos;
    }
    
}