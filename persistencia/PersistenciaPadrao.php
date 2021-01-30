<?php

/**
 * Classe de Persistência Padrão.
 * 
 * @author  Eloísa Bazzanella, Maria Eduarda Buzana
 * @package persistencia
 * @sinse   29/12/2020
 */
abstract class PersistenciaPadrao {
    
    protected $conexao;
    
    /**
     * Construtor da Persistência - Realiza a conexão com o Banco de Dados.
     */
    function __construct() {
        $this->conexao = pg_connect('host=localhost port=5432 dbname=escola user=postgres password=0000');
    }
    
    /**
     * Método responsável por realizar a inclusão dos registros fornecidos na devida tabela.
     * 
     * @param String $nomeTabela
     * @param Array  $colunas
     * @param Array  $valores
     */
    protected function inserir($nomeTabela, $colunas, $valores) {        
        $sInsert = 'INSERT INTO escola.'.$nomeTabela.' ('. implode(',', $colunas).') VALUES (\''. implode('\',\'', $valores).'\');';
        
        pg_query($this->conexao, $sInsert);
    }

    /**
     * Método responsável por realizar a inclusão de um determinado registro na tabela. 
     */
    abstract public function inserirRegistro();
    
    /**
     * Método responsável por realizar a exclusão de um determinado registro na tabela. 
     */
    abstract public function excluirRegistro($codigo);
    
    /**
     * Método responsável por realizar a alteração de um determinado registro na tabela. 
     */
    abstract public function alterarRegistro();
    
    /**
     * Método responsável por realizar a listagem dos registros da tabela. 
     */
    abstract public function listarRegistros();
    
}