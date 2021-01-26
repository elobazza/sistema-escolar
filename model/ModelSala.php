<?php

class ModelSala {
    private $codigo;
    /** @var ModelEscola $escola */
    private $escola;
    private $descricao;
    
    function getCodigo() {
        return $this->codigo;
    }
    /**
     * 
     * @return ModelEscola
     */
    function getEscola() {
        if(empty($this->escola)) {
            $this->escola = new ModelEscola();
        }
        return $this->escola;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setEscola(ModelEscola $escola) {
        $this->escola = $escola;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }


    
}
