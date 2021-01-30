<?php

/**
 * Classe de Modelo de Endereço.
 * 
 * @author  Eloísa Bazzanella, Maria Eduarda Buzana
 * @package model
 * @sinse   29/12/2020
 */
class ModelEndereco {
    
    /** @var ModelEscola $escola */
    private $escola;
    
    private $codigo;
    private $estado;
    private $cidade;
    private $bairro;
    private $rua;
    private $numero;
    private $complemento;
    
    /**
     * @return ModelEscola
     */
    function getEscola() {
        if(empty($this->escola)) {
            $this->escola = new ModelEscola();
        }
        return $this->escola;
    }

    function getCodigo() {
        return $this->codigo;
    }

    function getEstado() {
        return $this->estado;
    }

    function getCidade() {
        return $this->cidade;
    }

    function getBairro() {
        return $this->bairro;
    }

    function getRua() {
        return $this->rua;
    }

    function getNumero() {
        return $this->numero;
    }

    function getComplemento() {
        return $this->complemento;
    }

    function setEscola(ModelEscola $escola) {
        $this->escola = $escola;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    function setRua($rua) {
        $this->rua = $rua;
    }

    function setNumero($numero) {
        $this->numero = $numero;
    }

    function setComplemento($complemento) {
        $this->complemento = $complemento;
    }
    
}