<?php

abstract class PersistenciaPadrao {
    protected $conexao;
    
    function __construct() {
        $this->conexao = pg_connect('host=localhost port=5432 dbname=sistemaescola user=postgres password=admin');
    }
    
    protected function inserir($nomeTabela, $colunas, $valores) {
        
        $sInsert = 'INSERT INTO sistemaescola.'.$nomeTabela.' ('. implode(',', $colunas).') VALUES (\''. implode('\',\'', $valores).'\');';
        
        pg_query($this->conexao, $sInsert);
//        var_dump($sInsert);
    }

    
    abstract public function inserirRegistro();
    
    abstract public function excluirRegistro($codigo);
    
    abstract public function alterarRegistro();
    
    abstract public function listarRegistros();
}