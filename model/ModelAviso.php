<?php

/**
 * @author Eloísa Bazzanella e Maria Eduarda Buzana
 */
class ModelAviso {
    
    private $codigo;
    private $data;
    private $hora;
    private $titulo;
    private $mensagem;
    
    function getCodigo() {
        return $this->codigo;
    }

    function getData() {
        return $this->data;
    }

    function getHora() {
        return $this->hora;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getMensagem() {
        return $this->mensagem;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setData($data) {
        $this->data = $data;
    }

    function setHora($hora) {
        $this->hora = $hora;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setMensagem($mensagem) {
        $this->mensagem = $mensagem;
    }
}
