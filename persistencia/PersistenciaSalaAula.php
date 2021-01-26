<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PersistenciaSalaAula
 *
 * @author eloba
 */
class PersistenciaSalaAula extends PersistenciaPadrao{
     /** @var ModelSalaAula $ModelSalaAula */
    private $ModelSalaAula;
    
    function getModelSalaAula() {
        return $this->ModelSalaAula;
    }

    function setModelSalaAula($ModelSalaAula) {
        $this->ModelSalaAula = $ModelSalaAula;
    }

            
    public function alterarRegistro() {
         $sUpdate = 'UPDATE SISTEMAESCOLA.TBSALAAULA
                       SET salcodigo = '.$this->ModelSalaAula->getSala()->getCodigo().' ,
                           aulcodigo = '.$this->ModelSalaAula->getAula()->getCodigo().' ,
                           turcodigo = '.$this->ModelSalaAula->getTurma()->getCodigo().' ,
                           pdcodigo  = '.$this->ModelSalaAula->getProdis()->getCodigo().'
                     WHERE sacodigo  = '.$this->ModelSalaAula->getCodigo().' ';
        
         pg_query($this->conexao, $sUpdate);
    }

    public function excluirRegistro($codigo) {
        $sDeleteFinal = 'DELETE FROM SISTEMAESCOLA.TBSALAAULA WHERE SACODIGO = '.$codigo.'';
        pg_query($this->conexao, $sDeleteFinal);
    }

    public function inserirRegistro() {
        
        $aColunas = [
            'salcodigo', 
            'aulcodigo',
            'turcodigo',
            'pdcodigo'
        ];
        
        $aValores = [
            $this->ModelSalaAula->getSala()->getCodigo(),
            $this->ModelSalaAula->getAula()->getCodigo(),
            $this->ModelSalaAula->getTurma()->getCodigo(), 
            $this->ModelSalaAula->getProdis()->getCodigo() 
        ];
        
        parent::inserir('tbsalaaula', $aColunas, $aValores);
    }

    public function listarRegistros() {
        $sSelect = 'SELECT * 
                      FROM SISTEMAESCOLA.TBSALAAULA
                      JOIN SISTEMAESCOLA.TBSALA ON
                           TBSALA.SALCODIGO = TBSALAAULA.SALCODIGO
                      JOIN SISTEMAESCOLA.TBESCOLA ON
                           TBESCOLA.ESCCODIGO = TBSALA.ESCCODIGO
                     WHERE TBESCOLA.ESCCODIGO = '.$_SESSION['id'].';';
        
        $oResultadoSalaAula = pg_query($this->conexao, $sSelect);
        $aSalasAula = [];
        
        while ($aLinha = pg_fetch_array($oResultadoSalaAula, null, PGSQL_ASSOC)){
            
            $oSalaAula = new ModelSalaAula();
            $oSala = new ModelSala();
            $oAula = new ModelAula();
            $oTurma = new ModelTurma();
            $oProfessor = new ModelProfessor();
            $oDisciplina = new ModelDisciplina();
            
            $oSalaAula->setCodigo($aLinha['sacodigo']);
            
            $oSala->setCodigo($aLinha['salcodigo']);
            $oSalaAula->setSala($oSala);
            $oAula->setCodigo($aLinha['aulcodigo']);
            $oSalaAula->setAula($oAula);
            $oTurma->setCodigo($aLinha['turcodigo']);
            $oSalaAula->setTurma($oTurma);
            $oProfessor->setCodigo($aLinha['procodigo']);
            $oSalaAula->setProfessor($oProfessor);
            $oDisciplina->setCodigo($aLinha['discodigo']);
            $oSalaAula->setDisciplina($oDisciplina);
            
            $aSalasAula[] = $oSalaAula;
        }
        return $aSalasAula;
    }
    
    public function listarDisciplinasComProfessor() {
        $sSelect = 'SELECT TBPROFESSORDISCIPLINA.PDCODIGO,
                           TBDISCIPLINA.*,
                           TBPROFESSOR.*
                      FROM SISTEMAESCOLA.TBPROFESSORDISCIPLINA 
                      JOIN SISTEMAESCOLA.TBDISCIPLINA ON
                           TBDISCIPLINA.DISCODIGO = TBPROFESSORDISCIPLINA.DISCODIGO
                      JOIN SISTEMAESCOLA.TBPROFESSOR ON
                           TBPROFESSOR.PROCODIGO = TBPROFESSORDISCIPLINA.PROCODIGO;';
        $oResultado = pg_query($this->conexao, $sSelect);
        $aProfDis = [];
        
        while ($aLinha = pg_fetch_array($oResultado, null, PGSQL_ASSOC)){
            $oProfDis = new ModelProfessorDisciplina();
            $oProfessor = new ModelProfessor();
            $oDisciplina = new ModelDisciplina();
            
            $oProfDis->setCodigo($aLinha['pdcodigo']);
            
            $oDisciplina->setCodigo($aLinha['discodigo']);
            $oDisciplina->setNome($aLinha['disnome']);
            $oDisciplina->setCredito($aLinha['discredito']);
            
            $oProfessor->setCodigo($aLinha['procodigo']);
            $oProfessor->setNome($aLinha['pronome']);
            $oProfessor->setCpf($aLinha['procpf']);
            $oProfessor->setContato($aLinha['procontato']);
            $oProfessor->setEspecialidade($aLinha['proespecialidade']);
            $oProfessor->setSalario($aLinha['prosalario']);
            
            $oProfDis->setDisciplina($oDisciplina);
            $oProfDis->setProfessor($oProfessor);
            
            $aProfDis[] = $oProfDis;
        }
       
        return $aProfDis;
    }
    
    public function listarTudo() {
        $sSelect = ' SELECT TBSALAAULA.SACODIGO,
                            TBSALA.SALDESCRICAO,
                            TBAULA.AULHORARIOINICIO,
                            TBDISCIPLINA.DISNOME,
                            TBPROFESSOR.PRONOME,
                            TBTURMA.TURNOME
                       FROM SISTEMAESCOLA.TBSALA 
                       JOIN SISTEMAESCOLA.TBSALAAULA ON
                            TBSALA.SALCODIGO = TBSALAAULA.SALCODIGO
                       JOIN SISTEMAESCOLA.TBAULA ON
                            TBAULA.AULCODIGO = TBSALAAULA.AULCODIGO
                       JOIN SISTEMAESCOLA.TBTURMA ON
                            TBTURMA.TURCODIGO = TBSALAAULA.TURCODIGO
                       JOIN SISTEMAESCOLA.TBPROFESSORDISCIPLINA ON
                            TBPROFESSORDISCIPLINA.PDCODIGO = TBSALAAULA.PDCODIGO
                       JOIN SISTEMAESCOLA.TBPROFESSOR ON
                            TBPROFESSOR.PROCODIGO = TBPROFESSORDISCIPLINA.PROCODIGO
                       JOIN SISTEMAESCOLA.TBDISCIPLINA ON
                            TBDISCIPLINA.DISCODIGO = TBPROFESSORDISCIPLINA.DISCODIGO;
                    ';
        $oResultadoSalaAula = pg_query($this->conexao, $sSelect);
        $aSalasAula = [];
        
        while ($aLinha = pg_fetch_array($oResultadoSalaAula, null, PGSQL_ASSOC)){
            
            $oSalaAula = new ModelSalaAula();
            $oSala = new ModelSala();
            $oAula = new ModelAula();
            $oTurma = new ModelTurma();
            $oProfessor = new ModelProfessor();
            $oDisciplina = new ModelDisciplina();
            
            $oSalaAula->setCodigo($aLinha['sacodigo']);
            
            $oSala->setDescricao($aLinha['saldescricao']);
            $oSalaAula->setSala($oSala);
            $oAula->setHorarioInicio($aLinha['aulhorarioinicio']);
            $oSalaAula->setAula($oAula);
            $oTurma->setNome($aLinha['turnome']);
            $oSalaAula->setTurma($oTurma);
            $oProfessor->setNome($aLinha['pronome']);
            $oSalaAula->setProfessor($oProfessor);
            $oDisciplina->setNome($aLinha['disnome']);
            $oSalaAula->setDisciplina($oDisciplina);
            
            $aSalasAula[] = $oSalaAula;
        }
        return $aSalasAula;
    }
    
    public function listarComFiltro($sIndice, $sValor) {
        $sSelect = ' SELECT TBSALAAULA.SACODIGO,
                            TBSALA.SALDESCRICAO,
                            TBAULA.AULHORARIOINICIO,
                            TBDISCIPLINA.DISNOME,
                            TBPROFESSOR.PRONOME,
                            TBTURMA.TURNOME
                       FROM SISTEMAESCOLA.TBSALA 
                       JOIN SISTEMAESCOLA.TBSALAAULA ON
                            TBSALA.SALCODIGO = TBSALAAULA.SALCODIGO
                       JOIN SISTEMAESCOLA.TBAULA ON
                            TBAULA.AULCODIGO = TBSALAAULA.AULCODIGO
                       JOIN SISTEMAESCOLA.TBTURMA ON
                            TBTURMA.TURCODIGO = TBSALAAULA.TURCODIGO
                       JOIN SISTEMAESCOLA.TBPROFESSORDISCIPLINA ON
                            TBPROFESSORDISCIPLINA.PDCODIGO = TBSALAAULA.PDCODIGO
                       JOIN SISTEMAESCOLA.TBPROFESSOR ON
                            TBPROFESSOR.PROCODIGO = TBPROFESSORDISCIPLINA.PROCODIGO
                       JOIN SISTEMAESCOLA.TBDISCIPLINA ON
                            TBDISCIPLINA.DISCODIGO = TBPROFESSORDISCIPLINA.DISCODIGO
                       WHERE '.$sIndice.' = \''.$sValor.'\';' ;
        $oResultadoSalaAula = pg_query($this->conexao, $sSelect);
        $aSalasAula = [];
        
        while ($aLinha = pg_fetch_array($oResultadoSalaAula, null, PGSQL_ASSOC)){
            
            $oSalaAula = new ModelSalaAula();
            $oSala = new ModelSala();
            $oAula = new ModelAula();
            $oTurma = new ModelTurma();
            $oProfessor = new ModelProfessor();
            $oDisciplina = new ModelDisciplina();
            
            $oSalaAula->setCodigo($aLinha['sacodigo']);
            
            $oSala->setDescricao($aLinha['saldescricao']);
            $oSalaAula->setSala($oSala);
            $oAula->setHorarioInicio($aLinha['aulhorarioinicio']);
            $oSalaAula->setAula($oAula);
            $oTurma->setNome($aLinha['turnome']);
            $oSalaAula->setTurma($oTurma);
            $oProfessor->setNome($aLinha['pronome']);
            $oSalaAula->setProfessor($oProfessor);
            $oDisciplina->setNome($aLinha['disnome']);
            $oSalaAula->setDisciplina($oDisciplina);
            
            $aSalasAula[] = $oSalaAula;
        }
        return $aSalasAula;
    }

    
    public function selecionar($codigo) {
        $sSelect = 'SELECT * FROM SISTEMAESCOLA.TBSALAAULA WHERE SACODIGO = '.$codigo.'';
        $oResultadoSalaAula = pg_query($this->conexao, $sSelect);
        $oSalaAula = new ModelSalaAula();
        
        while ($aLinha = pg_fetch_array($oResultadoSalaAula, null, PGSQL_ASSOC)){
            $oSalaAula = new ModelSalaAula();
            $oSala = new ModelSala();
            $oAula = new ModelAula();
            $oTurma = new ModelTurma();
            $oProDis = new ModelProfessorDisciplina();
            
            $oSalaAula->setCodigo($aLinha['sacodigo']);
            
            $oSala->setCodigo($aLinha['salcodigo']);
            $oSalaAula->setSala($oSala);
            $oAula->setCodigo($aLinha['aulcodigo']);
            $oSalaAula->setAula($oAula);
            $oTurma->setCodigo($aLinha['turcodigo']);
            $oSalaAula->setTurma($oTurma);
            $oProDis->setCodigo($aLinha['pdcodigo']);
            $oSalaAula->setProdis($oProDis);
           }
        return $oSalaAula;
    }
}
