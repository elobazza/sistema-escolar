<?php
/**
 * @author Eloisa Bazzanella e Maria Eduarda Buzana
 */
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
            'id_professor', 
            'especialidade',
            'salario'
        ];
        
        $aValores = [
            $this->ModelProfessor->getUsuario()->getCodigo(),
            $this->ModelProfessor->getEspecialidade(),
            $this->ModelProfessor->getSalario()            
        ];
        
        return parent::inserir('professor', $aColunas, $aValores);
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
            
            return parent::inserir('tbprofessordisciplina', $aColunas, $aValores);
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
            
            return parent::inserir('tbprofessorescola', $aColunas, $aValores);
        }
    }
    
  
    public function alterarRegistro() {
        $sUpdate = 'UPDATE PROFESSOR
                       SET especialidade = \''.$this->ModelProfessor->getEspecialidade().'\',
                           salario = '.$this->ModelProfessor->getSalario().'
                     WHERE id_professor ='.$this->ModelProfessor->getUsuario()->getCodigo().' ';
        return pg_query($this->conexao, $sUpdate);
    }

    public function excluirRegistro($codigo) {
        $sDeleteFinal = 'DELETE FROM PROFESSOR
                          WHERE ID_PROFESSOR = '.$codigo.'';
        return pg_query($this->conexao, $sDeleteFinal);
    }

    public function listarRegistros() {
        $sSelect = 'SELECT * 
                      FROM PROFESSOR
                      JOIN PESSOA ON id_professor = id_pessoa 
                      ';
        $oResultado = pg_query($this->conexao, $sSelect);
        $aProfessores = [];
        
        while ($aLinha = pg_fetch_array($oResultado, null, PGSQL_ASSOC)){
            $oProfessor = new ModelProfessor();
            $oProfessor->getUsuario()->setCodigo($aLinha['id_professor']);
            $oProfessor->setNome($aLinha['nome']);
            $oProfessor->setCpf($aLinha['cpf']);
            $oProfessor->setContato($aLinha['contato']);
            $oProfessor->setEspecialidade($aLinha['especialidade']);
            $oProfessor->setSalario($aLinha['salario']);
            $oProfessor->setData_nascimento($aLinha['data_nascimento']);
            
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
                      FROM PROFESSOR 
                      JOIN PESSOA 
                        ON id_professor = id_pessoa 
                      JOIN USUARIO
                        ON id_pessoa = id_usuario 
                     WHERE ID_PROFESSOR = '.$codigo.'';
        $oResultadoProfessor = pg_query($this->conexao, $sSelect);
        $oProfessor = new ModelProfessor();
        
        while ($aLinha = pg_fetch_array($oResultadoProfessor, null, PGSQL_ASSOC)){
            $oProfessor->getUsuario()->setCodigo($aLinha['id_professor']);
            $oProfessor->setEspecialidade($aLinha['especialidade']);
            $oProfessor->setCpf($aLinha['cpf']);
            $oProfessor->setContato($aLinha['contato']);
            $oProfessor->setNome($aLinha['nome']);
            $oProfessor->setData_nascimento($aLinha['data_nascimento']);
            $oProfessor->setSalario($aLinha['salario']);
           }
        return $oProfessor;
    }
    
    
}