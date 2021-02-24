<?php
/**
 * @author Eloisa Bazzanella e Maria Eduarda Buzana
 */
class PersistenciaAula extends PersistenciaPadrao {
    
    /** @var ModelAula $ModelAula */
    private $ModelAula;
    
    function getModelAula() {
        return $this->ModelAula;
    }

    function setModelAula($ModelAula) {
        $this->ModelAula = $ModelAula;
    }

    public function alterarRegistro() {
        $sUpdate = 'UPDATE AULA
                       SET horario_inicio =\''.$this->ModelAula->getHorarioInicio().'\' ,
                           horario_fim = \''.$this->ModelAula->getHorarioFim().'\',
                           dia_semana = '. $this->ModelAula->getDiaSemanaValue() .',
                           id_discproftur = '.$this->ModelAula->getDisciplinaProfessorTurma()->getCodigo().'
                     WHERE id_aula = '.$this->ModelAula->getCodigo().' ';
      
        return pg_query($this->conexao, $sUpdate);
    }

    public function excluirRegistro($codigo) {
        $sDelete = 'DELETE FROM AULA WHERE id_aula = '.$codigo.'';
        return pg_query($this->conexao, $sDelete);
    }

    public function inserirRegistro() {
        $aColunas = [
            'horario_inicio',
            'horario_fim',
            'dia_semana',
            'id_discproftur'
        ];
        $aValores = [
            $this->ModelAula->getHorarioInicio(),
            $this->ModelAula->getHorarioFim(),
            $this->ModelAula->getDiaSemanaValue(),
            $this->ModelAula->getDisciplinaProfessorTurma()->getCodigo()
        ];        
        return parent::inserir('aula', $aColunas, $aValores);
    }

    public function listarRegistros() {
        $sSelect = 'SELECT AULA.*, disciplinaprofessorturma.*, disciplina.nome AS disciplina, turma.nome AS turma, pessoa.nome AS professor
                      FROM AULA
                      JOIN disciplinaprofessorturma
                        ON AULA.id_discproftur = disciplinaprofessorturma.id_discproftur
                      JOIN disciplina
                        ON disciplinaprofessorturma.id_disciplina = disciplina.id_disciplina
                      JOIN professor
                        ON disciplinaprofessorturma.id_professor = professor.id_professor
                      JOIN pessoa
                        ON professor.id_professor = pessoa.id_pessoa
                      JOIN turma
                        ON disciplinaprofessorturma.id_turma = turma.id_turma';
        
        switch ($_SESSION['tipo']) {
            case 2: {
                $sSelect .= ' WHERE PESSOA.ID_PESSOA = '. $_SESSION['id'] .'';
                break;
            }
        }
        
        $oResultado = pg_query($this->conexao, $sSelect);
        $aAulas = [];
        
        while ($aLinha = pg_fetch_array($oResultado, null, PGSQL_ASSOC)){
            $oAula = new ModelAula();
            $oAula->setCodigo($aLinha['id_aula']);
            $oAula->setHorarioInicio($aLinha['horario_inicio']);
            $oAula->setHorarioFim($aLinha['horario_fim']);
            $oAula->setDiaSemana($aLinha['dia_semana']);
            $oAula->getDisciplinaProfessorTurma()->setCodigo($aLinha['id_discproftur']);
            $oAula->getDisciplinaProfessorTurma()->getDisciplina()->setCodigo($aLinha['id_disciplina']);
            $oAula->getDisciplinaProfessorTurma()->getDisciplina()->setNome($aLinha['disciplina']);
            $oAula->getDisciplinaProfessorTurma()->getProfessor()->getUsuario()->setCodigo($aLinha['id_professor']);
            $oAula->getDisciplinaProfessorTurma()->getProfessor()->setNome($aLinha['professor']);
            $oAula->getDisciplinaProfessorTurma()->getTurma()->setCodigo($aLinha['id_turma']);
            $oAula->getDisciplinaProfessorTurma()->getTurma()->setNome($aLinha['turma']);
            
            $aAulas[] = $oAula;
        }
        return $aAulas;
    }

    public function listarComFiltro($sIndice, $sValor) {
        $sSelect = 'SELECT AULA.*, disciplinaprofessorturma.*, disciplina.nome AS disciplina, turma.nome AS turma, pessoa.nome AS professor
                      FROM AULA
                      JOIN disciplinaprofessorturma
                        ON AULA.id_discproftur = disciplinaprofessorturma.id_discproftur
                      JOIN disciplina
                        ON disciplinaprofessorturma.id_disciplina = disciplina.id_disciplina
                      JOIN professor
                        ON disciplinaprofessorturma.id_professor = professor.id_professor
                      JOIN pessoa
                        ON professor.id_professor = pessoa.id_pessoa
                      JOIN turma
                        ON disciplinaprofessorturma.id_turma = turma.id_turma
                     WHERE '.$sIndice.' = \''.$sValor.'\'
                     ORDER BY 1';
                
        $oResultado = pg_query($this->conexao, $sSelect);
        $aAulas = [];        
        while ($aLinha = pg_fetch_array($oResultado, null, PGSQL_ASSOC)){
            $oAula = new ModelAula();
            $oAula->setCodigo($aLinha['id_aula']);
            $oAula->setHorarioInicio($aLinha['horario_inicio']);
            $oAula->setHorarioFim($aLinha['horario_fim']);
            $oAula->getDisciplinaProfessorTurma()->setCodigo($aLinha['id_discproftur']);
            $oAula->getDisciplinaProfessorTurma()->getDisciplina()->setCodigo($aLinha['id_disciplina']);
            $oAula->getDisciplinaProfessorTurma()->getDisciplina()->setNome($aLinha['disciplina']);
            $oAula->getDisciplinaProfessorTurma()->getProfessor()->getUsuario()->setCodigo($aLinha['id_professor']);
            $oAula->getDisciplinaProfessorTurma()->getProfessor()->setNome($aLinha['professor']);
            $oAula->getDisciplinaProfessorTurma()->getTurma()->setCodigo($aLinha['id_turma']);
            $oAula->getDisciplinaProfessorTurma()->getTurma()->setNome($aLinha['turma']);
            
            $aAulas[] = $oAula;
        }
        return $aAulas;
    }
    
    public function selecionar($codigo) {
        $sSelect = 'SELECT AULA.*, disciplinaprofessorturma.*, disciplina.nome AS disciplina, turma.nome AS turma, pessoa.nome AS professor
                      FROM AULA 
                      JOIN disciplinaprofessorturma
                        ON AULA.id_discproftur = disciplinaprofessorturma.id_discproftur
                      JOIN disciplina
                        ON disciplinaprofessorturma.id_disciplina = disciplina.id_disciplina
                      JOIN professor
                        ON disciplinaprofessorturma.id_professor = professor.id_professor
                      JOIN pessoa
                        ON professor.id_professor = pessoa.id_pessoa
                      JOIN turma
                        ON disciplinaprofessorturma.id_turma = turma.id_turma
                     WHERE ID_AULA = '.$codigo.'';
        $oResultadoAula = pg_query($this->conexao, $sSelect);
        $oAula = new ModelAula();
        
        while ($aLinha = pg_fetch_array($oResultadoAula, null, PGSQL_ASSOC)){
            $oAula->setCodigo($aLinha['id_aula']);
            $oAula->setHorarioInicio($aLinha['horario_inicio']);
            $oAula->setHorarioFim($aLinha['horario_fim']);
            $oAula->getDisciplinaProfessorTurma()->setCodigo($aLinha['id_discproftur']);
            $oAula->getDisciplinaProfessorTurma()->getDisciplina()->setCodigo($aLinha['id_disciplina']);
            $oAula->getDisciplinaProfessorTurma()->getDisciplina()->setNome($aLinha['disciplina']);
            $oAula->getDisciplinaProfessorTurma()->getProfessor()->getUsuario()->setCodigo($aLinha['id_professor']);
            $oAula->getDisciplinaProfessorTurma()->getProfessor()->setNome($aLinha['professor']);
            $oAula->getDisciplinaProfessorTurma()->getTurma()->setCodigo($aLinha['id_turma']);
            $oAula->getDisciplinaProfessorTurma()->getTurma()->setNome($aLinha['turma']);
        }
        return $oAula;
    }

}
