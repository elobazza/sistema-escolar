<?php

/**
 * Classe de Modelo de Presença.
 * 
 * @author  Eloísa Bazzanella, Maria Eduarda Buzana
 * @package model
 * @since   24/02/2020
 */
class ModelPresenca {
    
    /** @var ModelAluno $Aluno */
    private $Aluno;
    
    /** @var ModelAula $Aula */
    private $Aula;
    
    private $codigo;
    private $presenca;
    private $data;

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
     * @return ModelAula
     */
    function getAula() {
        if(empty($this->Aula)) {
            $this->Aula = new ModelAula();
        }
        return $this->Aula;
    }
    
    function getCodigo() {
        return $this->codigo;
    }

    function getPresenca() {
        return $this->presenca;
    }
    
    function getData() {
        return $this->data;
    }
    
    function setAluno(ModelAluno $Aluno) {
        $this->Aluno = $Aluno;
    }

    function setAula(ModelAula $Aula) {
        $this->Aula = $Aula;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setPresenca($presenca) {
        $this->presenca = $presenca;
    }
    
    function setData($data) {
        $this->data = $data;
    }
    
}