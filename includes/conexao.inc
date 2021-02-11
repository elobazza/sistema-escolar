<?php

function conexao() {
    
    $sHost = 'localhost';
    $sPort = '5432';
    $sDbName = 'sistemaescola';
    $sUser = 'postgres';
    $sPassword = 'admin';


    $sConexao = 'host=' . $sHost . ' port=' . $sPort . ' dbname=' . $sDbName . ' user=' . $sUser . ' password=' . $sPassword;
    
    $oConexao = pg_connect($sConexao);
    return $oConexao;
    
}
