<?php

/**
 * Classe de Modelo de Presença.
 * 
 * @author  Eloísa Bazzanella, Maria Eduarda Buzana
 * @package model
 * @sinse   29/12/2020
 */
class ModelPresenca {
    
    /** @var ModelAluno $aluno */
    private $aluno;
    
    /** @var ModelAula $aula */
    private $aula;
    
    private $codigo;
    private $presenca;

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
     * @return ModelAula
     */
    function getAula() {
        if(empty($this->aula)) {
            $this->aula = new ModelAula();
        }
        return $this->aula;
    }
    
    function getCodigo() {
        return $this->codigo;
    }

    function getPresenca() {
        return $this->presenca;
    }
    
    function setAluno(ModelAluno $aluno) {
        $this->aluno = $aluno;
    }

    function setAula(ModelAula $aula) {
        $this->aula = $aula;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setPresenca($presenca) {
        $this->presenca = $presenca;
    }
    
}