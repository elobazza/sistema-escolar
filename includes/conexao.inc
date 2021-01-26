<?php

function conexao() {
//    include_once 'estrutura.inc';
//    $sHost = 'localhost';
//    $sPort = '5432';
//    $sDbName = 'sistemaescola';
//    $sUser = 'postgres';
//    $sPassword = 'IPM@1234567';
    
    $sHost = 'localhost';
    $sPort = '5432';
    $sDbName = 'sistemaescola';
    $sUser = 'postgres';
    $sPassword = 'admin';


    $sConexao = 'host=' . $sHost . ' port=' . $sPort . ' dbname=' . $sDbName . ' user=' . $sUser . ' password=' . $sPassword;
    
    $oConexao = pg_connect($sConexao);
    return $oConexao;
    
}
