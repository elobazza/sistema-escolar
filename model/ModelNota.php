<?php

class ModelNota {
    /** @var ModelAluno $aluno */
    private $aluno;
    /** @var ModelDisciplina $disciplina */
    private $disciplina;
    private $nota;
    private $codigo;
    /**
     * 
     * @return ModelAluno
     */
    
    function getCodigo() {
        return $this->codigo;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

        function getAluno() {
        if(empty($this->aluno)) {
            $this->aluno = new ModelAluno();
        }
        return $this->aluno;
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

    function getNota() {
        return $this->nota;
    }

    function setAluno(ModelAluno $aluno) {
        $this->aluno = $aluno;
    }

    function setDisciplina(ModelDisciplina $disciplina) {
        $this->disciplina = $disciplina;
    }

    function setNota($nota) {
        $this->nota = $nota;
    }


}
