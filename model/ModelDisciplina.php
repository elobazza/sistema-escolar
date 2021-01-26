<?php


class ModelDisciplina {
    private $codigo;
    private $nome;
    private $credito;
    
    function getCodigo() {
        return $this->codigo;
    }

    function getNome() {
        return $this->nome;
    }

    function getCredito() {
        return $this->credito;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setCredito($credito) {
        $this->credito = $credito;
    }


}
