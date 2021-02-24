<?php

/**
 * Classe de Modelo de Aluno.
 * 
 * @author  Eloísa Bazzanella, Maria Eduarda Buzana
 * @package model
 * @since   29/12/2020
 */
class ModelAluno extends ModelPessoa {
        
    /** @var Turma $Turma*/
    private $Turma;
    
    private $matricula;
    
    /**
     * @return ModelTurma
     */
    function getTurma() {
        if(empty($this->Turma)) {
            $this->Turma = new ModelTurma();
        }        
        return $this->Turma;
    }
    
    function getMatricula() {
        return $this->matricula;
    }

    function setTurma(ModelTurma $Turma) {
        $this->Turma = $Turma;
    }

    function setMatricula($matricula) {
        $this->matricula = $matricula;
    }
    
}