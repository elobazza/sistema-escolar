<?php

/**
 * Classe de Modelo de Nota.
 * 
 * @author  Eloísa Bazzanella, Maria Eduarda Buzana
 * @package model
 * @since   24/02/2020
 */
class ModelNota {
    
    /** @var ModelAluno $Aluno */
    private $Aluno;
    
    /** @var ModelDisciplinaProfessorTurma $DisciplinaProfessorTurma */
    private $DisciplinaProfessorTurma;
    
    private $codigo;
    private $nota;
    private $data;
    private $descricao;

    /**
     * @return ModelAluno
     */
    function getAluno() {
        if(empty($this->Aluno)) {
            $this->Aluno = new ModelAluno();
        }
        return $this->Aluno;
    }
    
    /**
     * @return ModelDisciplinaProfessorTurma
     */
    function getDisciplinaProfessorTurma() {
        if(empty($this->DisciplinaProfessorTurma)) {
            $this->DisciplinaProfessorTurma = new ModelDisciplinaProfessorTurma();
        }
        return $this->DisciplinaProfessorTurma;
    }
    
    function getCodigo() {
        return $this->codigo;
    }

    function getNota() {
        return $this->nota;
    }
    
    function setAluno(ModelAluno $aluno) {
        $this->Aluno = $aluno;
    }

    function setDisciplinaProfessorTurma(ModelDisciplinaProfessorTurma $DisciplinaProfessorTurma) {
        $this->DisciplinaProfessorTurma = $DisciplinaProfessorTurma;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setNota($nota) {
        $this->nota = $nota;
    }
    
    function getData() {
        return $this->data;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function setData($data) {
        $this->data = $data;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }
}