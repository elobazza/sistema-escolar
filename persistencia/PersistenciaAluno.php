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
            'matricula',
            'id_turma'
        ];
        
        $aValores = [
            $this->ModelAluno->getMatricula(),
            $this->ModelAluno->getTurma()->getCodigo()
        ];
        
        parent::inserir('aluno', $aColunas, $aValores);
    }
    
    public function alterarRegistro() {
        $sUpdate = 'UPDATE ALUNO
                       SET matricula = \''.$this->ModelAluno->getMatricula().'\' ,
                           id_turma = '.$this->ModelAluno->getTurma()->getCodigo().'
                     WHERE id_aluno ='.$this->ModelAluno->getCodigo().' ';
        
         pg_query($this->conexao, $sUpdate); 
    }

    public function excluirRegistro($codigo) {
        $sDelete = 'DELETE FROM NOTA WHERE ID_ALUNO = '.$codigo.'';
        pg_query($this->conexao, $sDelete);
        $sDeleteFinal = 'DELETE FROM ALUNO WHERE ID_ALUNO = '.$codigo.'';
        pg_query($this->conexao, $sDeleteFinal);
    }
    
    public function listarRegistros() {
        $sSelect = 'SELECT * FROM ALUNO JOIN PESSOA ON id_aluno = id_pessoa';
        $oResultadoAluno = pg_query($this->conexao, $sSelect);
        $aAlunos = [];
        
        while ($aLinha = pg_fetch_array($oResultadoAluno, null, PGSQL_ASSOC)){
            
            $oAluno = new ModelAluno();
            $oTurma = new ModelTurma();
            $oAluno->getUsuario()->setCodigo($aLinha['id_aluno']);
            $oAluno->setMatricula($aLinha['matricula']);
            $oAluno->setCpf($aLinha['cpf']);
            $oAluno->setContato($aLinha['contato']);
            $oAluno->setNome($aLinha['nome']);
            $oAluno->setData_nascimento($aLinha['data_nascimento']);
            $oTurma->setCodigo($aLinha['id_turma']);
            $oAluno->setTurma($oTurma);
            
            $aAlunos[] = $oAluno;
        }
        return $aAlunos;
    }
    
    public function selecionar($codigo) {
        $sSelect = 'SELECT * FROM ALUNO WHERE ID_ALUNO = '.$codigo.'';
        $oResultadoAluno = pg_query($this->conexao, $sSelect);
        $oAluno = new ModelAluno();
        
        while ($aLinha = pg_fetch_array($oResultadoAluno, null, PGSQL_ASSOC)){
            $oTurma = new ModelTurma();
            $oAluno->getUsuario()->setCodigo($aLinha['id_aluno']);
            $oAluno->setMatricula($aLinha['matricula']);
            $oAluno->setCpf($aLinha['cpf']);
            $oAluno->setContato($aLinha['contato']);
            $oAluno->setNome($aLinha['nome']);
            $oAluno->setData_nascimento($aLinha['data_nascimento']);
            $oTurma->setCodigo($aLinha['turma']);
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
            $oAluno->getUsuario()->setCodigo($aLinha['alucodigo']);
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
        $sSelect = 'SELECT id_aluno,
                           pessoa.nome,  
                           cpf,
                           data_nascimento,
                           matricula,
                           contato,
                           turma.nome,
                           turma.id_turma
                      FROM aluno 
                      JOIN pessoa
                        ON id_aluno = id_pessoa
                      JOIN turma 
                        ON turma.id_turma = aluno.id_turma
                     ORDER BY 1;';
        
        $oResultadoAluno = pg_query($this->conexao, $sSelect);
        
        $aAlunos = [];
        
        while ($aLinha = pg_fetch_array($oResultadoAluno, null, PGSQL_ASSOC)) {
            $oTurma = new ModelTurma();
            $oTurma->setNome($aLinha['nome']);
            $oTurma->setCodigo($aLinha['id_turma']);
            
            $oAluno = new ModelAluno();
            $oAluno->getUsuario()->setCodigo($aLinha['id_aluno']);
            $oAluno->setNome($aLinha['nome']);
            $oAluno->setCpf($aLinha['cpf']);
            $oAluno->setContato($aLinha['contato']);
            $oAluno->setData_nascimento($aLinha['data_nascimento']);
            $oAluno->setMatricula($aLinha['matricula']);
            $oAluno->setTurma($oTurma);
            
            array_push($aAlunos, $oAluno);
        }
        
        return $aAlunos;
    }
    
    
}