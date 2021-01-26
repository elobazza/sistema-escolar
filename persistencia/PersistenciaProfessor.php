<?php


class PersistenciaProfessor extends PersistenciaPadrao{
    /** @var ModelProfessor $ModelProfessor */
    private $ModelProfessor;
    /** @var ModelDisciplina $ModelDisciplina */
    private $ModelDisciplina;
    /** @var ModelEscola $ModelEscola */
    private $ModelEscola;
    
    function getModelProfessor() {
        return $this->ModelProfessor;
    }

    function setModelProfessor($ModelProfessor) {
        $this->ModelProfessor = $ModelProfessor;
    }
    public function inserirRegistro() {
        $aColunas = [
            'pronome', 
            'procpf',
            'procontato',
            'proespecialidade',
            'prosalario',
        ];
        
        $aValores = [
            $this->ModelProfessor->getNome(),
            $this->ModelProfessor->getCpf(),
            $this->ModelProfessor->getContato(),
            $this->ModelProfessor->getEspecialidade(),
            $this->ModelProfessor->getSalario()
            
        ];
            
        parent::inserir('tbprofessor', $aColunas, $aValores);
        
        $oResource = pg_query($this->conexao, 'SELECT MAX(procodigo) as procodigo FROM SISTEMAESCOLA.TBPROFESSOR');
        
        if($aDadosProfessor = pg_fetch_array($oResource)) {
            $this->ModelProfessor->setCodigo($aDadosProfessor['procodigo']);
        }
        
        $this->inserirDisciplinasRelacionadas();
        $this->inserirEscolasRelacionadas();
    }
    
    private function inserirDisciplinasRelacionadas() {
        foreach ($this->getModelProfessor()->getDisciplina() as $oModelDisciplina) {
            $aColunas = [
                'procodigo',
                'discodigo',
            ];
            
            $aValores = [
                $this->ModelProfessor->getCodigo(),
                $oModelDisciplina->getCodigo(),
            ];
            
            parent::inserir('tbprofessordisciplina', $aColunas, $aValores);
        }
    }
    
    private function inserirEscolasRelacionadas() {
        foreach ($this->getModelProfessor()->getEscola() as $oModelEscola) {
            
            $aColunas = [
                'procodigo',
                'esccodigo',
            ];
            
            $aValores = [
                $this->ModelProfessor->getCodigo(),
                $oModelEscola->getCodigo(),
            ];
            
            parent::inserir('tbprofessorescola', $aColunas, $aValores);
        }
    }
    
  
    public function alterarRegistro() {
        $sDeleteUm = 'DELETE 
                      FROM SISTEMAESCOLA.TBSALAAULA
                     WHERE EXISTS (SELECT 1
                                    FROM SISTEMAESCOLA.TBPROFESSORDISCIPLINA
                                   WHERE PROCODIGO = '.$this->ModelProfessor->getCodigo().');';
        pg_query($this->conexao, $sDeleteUm);
        
        $sDelete = 'DELETE 
                          FROM SISTEMAESCOLA.TBPROFESSORDISCIPLINA 
                         WHERE PROCODIGO = '.$this->ModelProfessor->getCodigo().'';
        pg_query($this->conexao, $sDelete);
        
//        $sDeleteFinal = 'DELETE 
//                           FROM SISTEMAESCOLA.TBPROFESSORESCOLA
//                          WHERE PROCODIGO = '.$this->ModelProfessor->getCodigo().'';
//        pg_query($this->conexao, $sDeleteFinal);
        
        $sUpdate = 'UPDATE SISTEMAESCOLA.TBPROFESSOR
                       SET pronome = \''.$this->ModelProfessor->getNome().'\' ,
                           procpf = \''.$this->ModelProfessor->getCpf().'\' ,
                           procontato = \''.$this->ModelProfessor->getContato().'\' ,
                           proespecialidade = \''.$this->ModelProfessor->getEspecialidade().'\',
                           prosalario = '.$this->ModelProfessor->getSalario().'
                     WHERE procodigo ='.$this->ModelProfessor->getCodigo().' ';
        pg_query($this->conexao, $sUpdate);

        
        $this->inserirDisciplinasRelacionadas();
        $this->inserirEscolasRelacionadas();
             
        
    }

    public function excluirRegistro($codigo) {
//        $sDeleteUm = 'DELETE  
//                        FROM SISTEMAESCOLA.TBSALAAULA 
//                     WHERE TBSALAAULA.PDCODIGO IN(SELECT TBPROFESSORDISCIPLINA.PDCODIGO 
//                                         FROM SISTEMAESCOLA.TBPROFESSORDISCIPLINA
//                                        WHERE PROCODIGO = '.$codigo.');';
//        pg_query($this->conexao, $sDeleteUm);
//        
        $sDelete = 'DELETE  
                      FROM SISTEMAESCOLA.TBPROFESSORESCOLA 
                     WHERE PROCODIGO = '.$codigo.'
                       AND ESCCODIGO = '.$_SESSION['id'].'   ';
        pg_query($this->conexao, $sDelete);
//        
//        $sDeleteDois = 'DELETE 
//                          FROM SISTEMAESCOLA.TBPROFESSORDISCIPLINA 
//                         WHERE PROCODIGO = '.$codigo.'';
//        pg_query($this->conexao, $sDeleteDois);
//        $sDeleteFinal = 'DELETE 
//                           FROM SISTEMAESCOLA.TBPROFESSOR
//                          WHERE PROCODIGO = '.$codigo.'';
//        pg_query($this->conexao, $sDeleteFinal);
    }

    public function listarRegistros() {
        $sSelect = 'SELECT * 
                      FROM SISTEMAESCOLA.TBPROFESSOR
                      ';
        $oResultado = pg_query($this->conexao, $sSelect);
        $aProfessores = [];
        
        while ($aLinha = pg_fetch_array($oResultado, null, PGSQL_ASSOC)){
            $oProfessor = new ModelProfessor();
            $oProfessor->setCodigo($aLinha['procodigo']);
            $oProfessor->setNome($aLinha['pronome']);
            $oProfessor->setCpf($aLinha['procpf']);
            $oProfessor->setContato($aLinha['procontato']);
            $oProfessor->setEspecialidade($aLinha['proespecialidade']);
            $oProfessor->setSalario($aLinha['prosalario']);
            
            $aProfessores[] = $oProfessor;
        }
        return $aProfessores;
    }

    public function listarTudo() {
        $sSelect = 'SELECT tbprofessor.procodigo,
                           pronome, 
                           procpf, 
                           procontato, 
                           proespecialidade, 
                           prosalario
                      FROM SISTEMAESCOLA.TBPROFESSOR
                     ORDER BY 1';
        $oResultado = pg_query($this->conexao, $sSelect);
        $aProfessores = [];
        
        while ($aLinha = pg_fetch_array($oResultado, null, PGSQL_ASSOC)){
            $oProfessor = new ModelProfessor();
            $oPersistenciaDisciplina = new PersistenciaDisciplina();
            $oPersistenciaEscola = new PersistenciaEscola();
            
            
            $oProfessor->setCodigo($aLinha['procodigo']);
            $oProfessor->setNome($aLinha['pronome']);
            $oProfessor->setCpf($aLinha['procpf']);
            $oProfessor->setContato($aLinha['procontato']);
            $oProfessor->setEspecialidade($aLinha['proespecialidade']);
            $oProfessor->setSalario($aLinha['prosalario']);
            
            $oProfessor->setDisciplina($oPersistenciaDisciplina->listarDisciplinasPorProfessor($oProfessor->getCodigo()));
            $oProfessor->setEscola($oPersistenciaEscola->listarEscolasPorProfessor($oProfessor->getCodigo()));
            $aProfessores[] = $oProfessor;
            
        }
        return $aProfessores;
    }
    
    public function listarComFiltro($sIndice, $sValor) {
        $sSelect = 'SELECT tbprofessor.procodigo,
                           pronome, 
                           procpf, 
                           procontato, 
                           proespecialidade, 
                           prosalario
                      FROM SISTEMAESCOLA.TBPROFESSOR
                     WHERE '.$sIndice.' = \''.$sValor.'\'
                     ORDER BY 1';
        $oResultado = pg_query($this->conexao, $sSelect);
        $aProfessores = [];
        
        while ($aLinha = pg_fetch_array($oResultado, null, PGSQL_ASSOC)){
            $oProfessor = new ModelProfessor();
            $oPersistenciaDisciplina = new PersistenciaDisciplina();
            $oPersistenciaEscola = new PersistenciaEscola();
            
            
            $oProfessor->setCodigo($aLinha['procodigo']);
            $oProfessor->setNome($aLinha['pronome']);
            $oProfessor->setCpf($aLinha['procpf']);
            $oProfessor->setContato($aLinha['procontato']);
            $oProfessor->setEspecialidade($aLinha['proespecialidade']);
            $oProfessor->setSalario($aLinha['prosalario']);
            
            $oProfessor->setDisciplina($oPersistenciaDisciplina->listarDisciplinasPorProfessor($oProfessor->getCodigo()));
            $oProfessor->setEscola($oPersistenciaEscola->listarEscolasPorProfessor($oProfessor->getCodigo()));
            $aProfessores[] = $oProfessor;
            
        }
        return $aProfessores;
    }
    
    
    public function selecionar($codigo) {
        $sSelect = 'SELECT * 
                      FROM SISTEMAESCOLA.TBPROFESSOR
                      JOIN SISTEMAESCOLA.TBPROFESSORDISCIPLINA ON
                           TBPROFESSOR.PROCODIGO = TBPROFESSORDISCIPLINA.PROCODIGO
                      JOIN SISTEMAESCOLA.TBPROFESSORESCOLA ON
                           TBPROFESSOR.PROCODIGO = TBPROFESSORESCOLA.PROCODIGO
                     WHERE TBPROFESSOR.PROCODIGO = '.$codigo.'';
        $oResultadoProfessor = pg_query($this->conexao, $sSelect);
        $oProfessor = new ModelProfessor();
        
        while ($aLinha = pg_fetch_array($oResultadoProfessor, null, PGSQL_ASSOC)){
           
            $oPersistenciaDisciplina = new PersistenciaDisciplina();
            $oPersistenciaEscola = new PersistenciaEscola();
            
            
            $oProfessor->setCodigo($aLinha['procodigo']);
            $oProfessor->setNome($aLinha['pronome']);
            $oProfessor->setCpf($aLinha['procpf']);
            $oProfessor->setContato($aLinha['procontato']);
            $oProfessor->setSalario($aLinha['prosalario']);
            $oProfessor->setEspecialidade($aLinha['proespecialidade']);
            
            $oProfessor->setDisciplina($oPersistenciaDisciplina->listarDisciplinasPorProfessor($oProfessor->getCodigo()));
            $oProfessor->setEscola($oPersistenciaEscola->listarEscolasPorProfessor($oProfessor->getCodigo()));
           
            
           }
        return $oProfessor;
    }
    
}