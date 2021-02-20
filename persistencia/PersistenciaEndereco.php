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
        $sDelete = 'DELETE FROM ENDERECO WHERE ID_ENDERECO = '.$codigo.'';
        pg_query($this->conexao, $sDelete);
    }

    public function inserirRegistro() {        
        $aColunas = [
            'estado',
            'cidade',
            'bairro',
            'rua',
            'numero',
            'complemento'
        ];
        
        $aValores = [
            $this->ModelEndereco->getEstado(),
            $this->ModelEndereco->getCidade(),
            $this->ModelEndereco->getBairro(),
            $this->ModelEndereco->getRua(),
            $this->ModelEndereco->getNumero(),
            $this->ModelEndereco->getComplemento()
        ];
        
        parent::inserir('endereco', $aColunas, $aValores);
    }
    
    public function selecionar($Endereco) {
         $sSelect = 'SELECT * 
                      FROM ENDERECO
                      WHERE ESTADO = \''. $Endereco->getEstado() .'\'
                        AND CIDADE = \''. $Endereco->getCidade() .'\'
                        AND RUA = \''. $Endereco->getRua() .'\'
                        AND COMPLEMENTO = \''. $Endereco->getComplemento() .'\'
                        AND NUMERO = '. $Endereco->getNumero() .'
                        AND BAIRRO = \''. $Endereco->getBairro() .'\'';
         
        $oResultado = pg_query($this->conexao, $sSelect);
        $oEndereco = new ModelEndereco();
        
        while ($aLinha = pg_fetch_array($oResultado, null, PGSQL_ASSOC)){
            $oEndereco->setBairro($aLinha['bairro']);
            $oEndereco->setCidade($aLinha['cidade']);
            $oEndereco->setCodigo($aLinha['id_endereco']);
            $oEndereco->setComplemento($aLinha['complemento']);
            $oEndereco->setEstado($aLinha['estado']);
            $oEndereco->setNumero($aLinha['numero']);
            $oEndereco->setRua($aLinha['rua']);
        }
        return $oEndereco;
    }

    public function listarRegistros() {}

}