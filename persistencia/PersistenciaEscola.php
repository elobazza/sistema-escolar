<?php

class PersistenciaEscola extends PersistenciaPadrao{
    /** @var ModelEscola $ModelEscola */
    private $ModelEscola;
    
    function getModelEscola() {
        return $this->ModelEscola;
    }

    function setModelEscola($ModelEscola) {
        $this->ModelEscola = $ModelEscola;
    }

    public function alterarRegistro() {
        $sUpdate = 'UPDATE SISTEMAESCOLA.TBESCOLA
                       SET escnome = \''.$this->ModelEscola->getNome().'\' ,
                           escendereco = \''.$this->ModelEscola->getEndereco().'\' ,
                           esccontato = \''.$this->ModelEscola->getContato().'\' ,
                           esclogin = '.$this->ModelEscola->getLogin().',
                           escsenha = '.md5($this->ModelEscola->getSenha()).',
                           cidcodigo = '.$this->ModelEscola->getCidade()->getCodigo().'
                     WHERE esccodigo ='.$this->ModelEscola->getCodigo().' ';
        
         pg_query($this->conexao, $sUpdate); 
    }

    public function excluirRegistro($codigo) {
        $sDelete = 'DELETE FROM SISTEMAESCOLA.TBPROFESSORESCOLA WHERE ESCCODIGO = '.$codigo.'';
        pg_query($this->conexao, $sDelete);
        $sDeleteDois = 'DELETE FROM SISTEMAESCOLA.TBSALA WHERE ESCCODIGO = '.$codigo.'';
        pg_query($this->conexao, $sDeleteDois);
        $sDeleteFinal = 'DELETE FROM SISTEMAESCOLA.TBESCOLA WHERE ESCCODIGO = '.$codigo.'';
        pg_query($this->conexao, $sDeleteFinal);
    }

    public function inserirRegistro() {
        
        $aColunas = [
            'escnome',
            'escendereco',
            'esccontato',
            'esclogin',
            'escsenha',
            'cidcodigo'
        ];
        
        $aValores = [
            $this->ModelEscola->getNome(),
            $this->ModelEscola->getEndereco(),
            $this->ModelEscola->getContato(),
            $this->ModelEscola->getLogin(),
            md5($this->ModelEscola->getSenha()),
            $this->ModelEscola->getCidade()->getCodigo()
        ];
        
        parent::inserir('tbescola', $aColunas, $aValores);
    }

    public function listarRegistros() {
        $sSelect = 'SELECT *  
                      FROM SISTEMAESCOLA.TBESCOLA';
        $oResultado = pg_query($this->conexao, $sSelect);
        $aEscolas = [];
        
        while ($aLinha = pg_fetch_array($oResultado, null, PGSQL_ASSOC)){
            $oEscola = new ModelEscola();
            $oCidade = new ModelCidade();
            $oEscola->setCodigo($aLinha['esccodigo']);
            $oEscola->setNome($aLinha['escnome']);
            $oEscola->setEndereco($aLinha['escendereco']);
            $oEscola->setContato($aLinha['esccontato']);
            $oEscola->setLogin($aLinha['esclogin']);
            $oEscola->setSenha($aLinha['escsenha']);
            
            $oCidade->setCodigo($aLinha['cidcodigo']);
            $oEscola->setCidade($oCidade);
            
            $aEscolas[] = $oEscola;
        }
        return $aEscolas;
    }
    
    public function listarTudo() {
        $sSelect = 'SELECT esccodigo, 
                           escnome, 
                           escendereco, 
                           esccontato, 
                           cidnome, 
                           esclogin 
                      FROM SISTEMAESCOLA.TBESCOLA 
                      JOIN SISTEMAESCOLA.TBCIDADE ON 
                           tbcidade.cidcodigo = tbescola.cidcodigo;';
        $oResultado = pg_query($this->conexao, $sSelect);
        $aEscolas = [];
        
        while ($aLinha = pg_fetch_array($oResultado, null, PGSQL_ASSOC)){
            $oEscola = new ModelEscola();
            $oCidade = new ModelCidade();
            $oEscola->setCodigo($aLinha['esccodigo']);
            $oEscola->setNome($aLinha['escnome']);
            $oEscola->setEndereco($aLinha['escendereco']);
            $oEscola->setContato($aLinha['esccontato']);
            $oEscola->setLogin($aLinha['esclogin']);
            
            $oCidade->setNome($aLinha['cidnome']);
            $oEscola->setCidade($oCidade);
            
            $aEscolas[] = $oEscola;
        }
        
        return $aEscolas;
    }
    public function listarComFiltro($sIndice, $sValor) {
        $sSelect = 'SELECT esccodigo, 
                           escnome, 
                           escendereco, 
                           esccontato, 
                           cidnome, 
                           esclogin 
                      FROM SISTEMAESCOLA.TBESCOLA 
                      JOIN SISTEMAESCOLA.TBCIDADE ON 
                           tbcidade.cidcodigo = tbescola.cidcodigo
                      WHERE '.$sIndice.' = \''.$sValor.'\';' ;
        $oResultado = pg_query($this->conexao, $sSelect);
        $aEscolas = [];
        
        while ($aLinha = pg_fetch_array($oResultado, null, PGSQL_ASSOC)){
            $oEscola = new ModelEscola();
            $oCidade = new ModelCidade();
            $oEscola->setCodigo($aLinha['esccodigo']);
            $oEscola->setNome($aLinha['escnome']);
            $oEscola->setEndereco($aLinha['escendereco']);
            $oEscola->setContato($aLinha['esccontato']);
            $oEscola->setLogin($aLinha['esclogin']);
            
            $oCidade->setNome($aLinha['cidnome']);
            $oEscola->setCidade($oCidade);
            
            $aEscolas[] = $oEscola;
        }
        
        return $aEscolas;
    }
    
    public function listarEscolasPorProfessor($codigo) {
        $sSelect = 'SELECT TBESCOLA.*
                      FROM SISTEMAESCOLA.TBESCOLA 
                      JOIN SISTEMAESCOLA.TBPROFESSORESCOLA ON
                           TBESCOLA.ESCCODIGO = TBPROFESSORESCOLA.ESCCODIGO
                     WHERE TBPROFESSORESCOLA.PROCODIGO = '.$codigo.';';
        $oResultado = pg_query($this->conexao, $sSelect);
        $aEscolas = [];
        
        while ($aLinha = pg_fetch_array($oResultado, null, PGSQL_ASSOC)){
            $oEscola = new ModelEscola();
            $oCidade = new ModelCidade();
            $oEscola->setCodigo($aLinha['esccodigo']);
            $oEscola->setNome($aLinha['escnome']);
            $oEscola->setEndereco($aLinha['escendereco']);
            $oEscola->setContato($aLinha['esccontato']);
            $oEscola->setLogin($aLinha['esclogin']);
            
            $oCidade->setCodigo($aLinha['cidcodigo']);
            $oEscola->setCidade($oCidade);
            
            $aEscolas[] = $oEscola;
        }
        
        return $aEscolas;
    }
    
    public function selecionarLogin($login, $senha) {
       
        $sSelect = 'SELECT * 
                      FROM SISTEMAESCOLA.TBESCOLA 
                     WHERE ESCLOGIN = \''.$login.'\' 
                       AND ESCSENHA = \''.md5($senha).'\' ;';
        
        $oResultado = pg_query($this->conexao, $sSelect);
        $xEscola = false;
        
        while ($aLinha = pg_fetch_array($oResultado, null, PGSQL_ASSOC)){
            
            $xEscola = new ModelEscola();
            $xEscola->setCodigo($aLinha['esccodigo']);
            $xEscola->setNome($aLinha['escnome']);
            $xEscola->setEndereco($aLinha['escendereco']);
            $xEscola->setContato($aLinha['esccontato']);
            $xEscola->setLogin($aLinha['esclogin']);
            
        }
        
        return $xEscola;
    }

    public function selecionar($codigo) {
        $sSelect = 'SELECT * 
                      FROM SISTEMAESCOLA.TBESCOLA 
                     WHERE ESCCODIGO = '.$codigo.'';
        $oResultadoEscola = pg_query($this->conexao, $sSelect);
        $oEscola = new ModelEscola();
        
        while ($aLinha = pg_fetch_array($oResultadoEscola, null, PGSQL_ASSOC)){
            $oCidade = new ModelCidade();
            $oEscola->setCodigo($aLinha['esccodigo']);
            $oEscola->setNome($aLinha['escnome']);
            $oEscola->setEndereco($aLinha['escendereco']);
            $oEscola->setContato($aLinha['esccontato']);
            $oEscola->setLogin($aLinha['esclogin']);
            $oEscola->setSenha($aLinha['escsenha']);
            $oCidade->setCodigo($aLinha['cidcodigo']);
            $oEscola->setCidade($oCidade);
           }
        return $oEscola;
    }
}
