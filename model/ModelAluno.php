<?php

/**
 * Classe de Modelo de Aluno.
 * 
 * @author  Eloísa Bazzanella, Maria Eduarda Buzana
 * @package model
 * @sinse   29/12/2020
 */
class ModelAluno extends ModelPessoa {
        
    /** @var Turma $turma*/
    private $turma;
    
    private $matricula;
    
    /**
     * @return ModelTurma
     */
    function getTurma() {
        if(empty($this->turma)) {
            $this->turma = new ModelTurma();
        }        
        return $this->turma;
    }
    
    function getMatricula() {
        return $this->matricula;
    }

    function setTurma(ModelTurma $turma) {
        $this->turma = $turma;
    }

    function setMatricula($matricula) {
        $this->matricula = $matricula;
    }
    
}