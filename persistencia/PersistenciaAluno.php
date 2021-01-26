<?php

class PersistenciaAluno extends PersistenciaPadrao{
    /** @var ModelAluno $ModelAluno */
    private $ModelAluno;
        
    function getModelAluno() {
        return $this->ModelAluno;
    }

    function setModelAluno($ModelAluno) {
        $this->ModelAluno = $ModelAluno;
    }

    public function inserirRegistro() {
        $aColunas = [
            'alunome',
            'alucpf', 
            'alucontato',
            'turcodigo'
        ];
        
        $aValores = [
            $this->ModelAluno->getNome(),
            $this->ModelAluno->getCpf(),
            $this->ModelAluno->getContato(),
            $this->ModelAluno->getTurma()->getCodigo()
        ];
        
        parent::inserir('tbaluno', $aColunas, $aValores);
    }
    
    public function alterarRegistro() {
        $sUpdate = 'UPDATE SISTEMAESCOLA.TBALUNO
                       SET alunome = \''.$this->ModelAluno->getNome().'\' ,
                           alucpf = \''.$this->ModelAluno->getCpf().'\' ,
                           alucontato = \''.$this->ModelAluno->getContato().'\' ,
                           turcodigo = '.$this->ModelAluno->getTurma()->getCodigo().'
                     WHERE alucodigo ='.$this->ModelAluno->getCodigo().' ';
        
         pg_query($this->conexao, $sUpdate); 
    }

    public function excluirRegistro($codigo) {
        $sDelete = 'DELETE FROM SISTEMAESCOLA.TBNOTA WHERE ALUCODIGO = '.$codigo.'';
        pg_query($this->conexao, $sDelete);
        $sDeleteFinal = 'DELETE FROM SISTEMAESCOLA.TBALUNO WHERE ALUCODIGO = '.$codigo.'';
        pg_query($this->conexao, $sDeleteFinal);
    }
    
    public function listarRegistros() {
        $sSelect = 'SELECT * FROM SISTEMAESCOLA.TBALUNO';
        $oResultadoAluno = pg_query($this->conexao, $sSelect);
        $aAlunos = [];
        
        while ($aLinha = pg_fetch_array($oResultadoAluno, null, PGSQL_ASSOC)){
            
            $oAluno = new ModelAluno();
            $oTurma = new ModelTurma();
            $oAluno->setCodigo($aLinha['alucodigo']);
            $oAluno->setNome($aLinha['alunome']);
            $oAluno->setCpf($aLinha['alucpf']);
            $oAluno->setContato($aLinha['alucontato']);
            $oTurma->setCodigo($aLinha['turcodigo']);
            $oAluno->setTurma($oTurma);
            
            $aAlunos[] = $oAluno;
        }
        return $aAlunos;
    }
    
    public function selecionar($codigo) {
        $sSelect = 'SELECT * FROM SISTEMAESCOLA.TBALUNO WHERE ALUCODIGO = '.$codigo.'';
        $oResultadoAluno = pg_query($this->conexao, $sSelect);
        $oAluno = new ModelAluno();
        
        while ($aLinha = pg_fetch_array($oResultadoAluno, null, PGSQL_ASSOC)){
            $oTurma = new ModelTurma();
            $oAluno->setCodigo($aLinha['alucodigo']);
            $oAluno->setNome($aLinha['alunome']);
            $oAluno->setCpf($aLinha['alucpf']);
            $oAluno->setContato($aLinha['alucontato']);
            $oTurma->setCodigo($aLinha['turcodigo']);
            $oAluno->setTurma($oTurma);
           }
        return $oAluno;
    }
    
    public function listarComFiltro($sIndice, $sValor) {
        $sSelect = 'SELECT TBALUNO.*,
                           TBTURMA.TURNOME
                      FROM SISTEMAESCOLA.TBALUNO
                      JOIN SISTEMAESCOLA.TBTURMA ON
                           TBTURMA.TURCODIGO = TBALUNO.TURCODIGO
                     WHERE '.$sIndice.' = \''.$sValor.'\';' ;

        $oResultado = pg_query($this->conexao, $sSelect);
        $aAlunos = [];
        while ($aLinha = pg_fetch_array($oResultado, null, PGSQL_ASSOC)){
            $oAluno = new ModelAluno();
            $oTurma = new ModelTurma();
            $oAluno->setCodigo($aLinha['alucodigo']);
            $oAluno->setNome($aLinha['alunome']);
            $oAluno->setCpf($aLinha['alucpf']);
            $oAluno->setContato($aLinha['alucontato']);
            $oTurma->setCodigo($aLinha['turcodigo']);
            $oTurma->setNome($aLinha['turnome']);
            $oAluno->setTurma($oTurma);
            
            $aAlunos[] = $oAluno;
        }
        return $aAlunos;
    }
    
    public function listarTudo() {
        $sSelect = 'SELECT alucodigo, alunome, alucpf, alucontato, turnome FROM sistemaescola.tbaluno JOIN sistemaescola.tbturma ON tbturma.turcodigo = tbaluno.turcodigo ORDER BY 1;' ;
        
        $oResultadoAluno = pg_query($this->conexao, $sSelect);
        
        $aAlunos = [];
        
        while ($aLinha = pg_fetch_array($oResultadoAluno, null, PGSQL_ASSOC)) {
            $oTurma = new ModelTurma();
            $oTurma->setNome($aLinha['turnome']);
            
            $oAluno = new ModelAluno();
            $oAluno->setCodigo($aLinha['alucodigo']);
            $oAluno->setNome($aLinha['alunome']);
            $oAluno->setCpf($aLinha['alucpf']);
            $oAluno->setContato($aLinha['alucontato']);
            $oAluno->setTurma($oTurma);
            
            array_push($aAlunos, $oAluno);
        }
        
        return $aAlunos;
    }
    
    
}