<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelSalaAula
 *
 * @author eloba
 */
class ModelSalaAula {
    
    private $codigo;
    /* @var ModelSala $sala */
    private $sala;
    /* @var ModelAula $aula */
    private $aula;
    /* @var ModelTurma $turma */
    private $turma;
    /* @var ModelProfessor $professor */
    private $professor;
    /* @var ModelDisciplina $disciplina */
    private $disciplina;
    /* @var ModelProfessorDisciplina $prodis */
    private $prodis;
    
     /**
     * 
     * @return ModelProfessorDisciplina
     */
    function getProdis() {
         if(empty($this->prodis)) {
             $this->prodis = new ModelProfessorDisciplina();
         }
            return $this->prodis;
    }

    function setProdis($prodis) {
        $this->prodis = $prodis;
    }

        
    function getCodigo() {
        return $this->codigo;
    }

    /**
     * 
     * @return ModelSala
     */
    function getSala() {
        if(empty($this->sala)) {
            $this->sala = new ModelSala();
        }
        return $this->sala;
    }
    /**
     * 
     * @return ModelAula
     */
    function getAula() {
        if(empty($this->aula)) {
            $this->aula = new ModelAula();
        }
        return $this->aula;
    }

    /**
     * 
     * @return ModelTurma
     */
    function getTurma() {
        if(empty($this->turma)) {
            $this->turma = new ModelTurma();
        }
        return $this->turma;
    }

    /**
     * 
     * @return ModelProfessor
     */
    function getProfessor() {
        if(empty($this->professor)) {
            $this->professor = new ModelProfessor();
        }
        return $this->professor;
    }

    /**
     * 
     * @return ModelDisciplina
     */
    function getDisciplina() {
        if(empty($this->disciplina)) {
            $this->disciplina = new ModelDisciplina();
        }
        return $this->disciplina;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setSala(ModelSala $sala) {
        $this->sala = $sala;
    }

    function setAula(ModelAula $aula) {
        $this->aula = $aula;
    }

    function setTurma(ModelTurma $turma) {
        $this->turma = $turma;
    }

    function setProfessor(ModelProfessor $professor) {
        $this->professor = $professor;
    }

    function setDisciplina(ModelDisciplina $disciplina) {
        $this->disciplina = $disciplina;
    }



    
}
