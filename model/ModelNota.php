<?php

/**
 * Classe de Modelo de Nota.
 * 
 * @author  Eloísa Bazzanella, Maria Eduarda Buzana
 * @package model
 * @sinse   29/12/2020
 */
class ModelNota {
    
    /** @var ModelAluno $aluno */
    private $aluno;
    
    /** @var ModelDisciplinaProfessorTurma $disciplina */
    private $disciplinaProfessorTurma;
    
    private $codigo;
    private $nota;
    
    private $media;

    /**
     * @return ModelAluno
     */
    function getAluno() {
        if(empty($this->aluno)) {
            $this->aluno = new ModelAluno();
        }
        return $this->aluno;
    }
    
    /**
     * @return ModelDisciplinaProfessorTurma
     */
    function getDisciplinaProfessorTurma() {
        if(empty($this->disciplinaProfessorTurma)) {
            $this->disciplinaProfessorTurma = new ModelDisciplinaProfessorTurma();
        }
        return $this->disciplinaProfessorTurma;
    }
    
    function getCodigo() {
        return $this->codigo;
    }

    function getNota() {
        return $this->nota;
    }
    
    function getMedia() {
        return $this->media;
    }

    function setAluno(ModelAluno $aluno) {
        $this->aluno = $aluno;
    }

    function setDisciplinaProfessorTurma(ModelDisciplinaProfessorTurma $disciplinaProfessorTurma) {
        $this->disciplinaProfessorTurma = $disciplinaProfessorTurma;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setNota($nota) {
        $this->nota = $nota;
    }
    
    function setMedia($media) {
        $this->media = $media;
    }
    
}