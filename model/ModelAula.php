<?php

class ModelAula {
    private $codigo;
    private $horarioInicio;
    private $horarioFim;
    
    function getCodigo() {
        return $this->codigo;
    }

    function getHorarioInicio() {
        return $this->horarioInicio;
    }

    function getHorarioFim() {
        return $this->horarioFim;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setHorarioInicio($horarioInicio) {
        $this->horarioInicio = $horarioInicio;
    }

    function setHorarioFim($horarioFim) {
        $this->horarioFim = $horarioFim;
    }


}
