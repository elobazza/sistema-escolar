<?php

/**
 * @author Eloísa Bazzanella e Maria Eduarda Buzana.
 */
class ModelBoletim {
    
    private $Aluno;
    private $DiscProfTur;
    private $taxaPresenca;
    private $mediaNota;
    
    function getAluno() {
        if(empty($this->Aluno)) {
            $this->Aluno = new ModelAluno();
        }
        return $this->Aluno;
    }

    function getDiscProfTur() {
        if(empty($this->DiscProfTur)) {
            $this->DiscProfTur = new ModelDisciplinaProfessorTurma();
        }
        return $this->DiscProfTur;
    }

    function getTaxaPresenca() {
        return $this->taxaPresenca;
    }

    function getMediaNota() {
        return $this->mediaNota;
    }

    function setAluno($Aluno) {
        $this->Aluno = $Aluno;
    }

    function setDiscProfTur($DiscProfTur) {
        $this->DiscProfTur = $DiscProfTur;
    }

    function setTaxaPresenca($taxaPresenca) {
        $this->taxaPresenca = $taxaPresenca;
    }

    function setMediaNota($mediaNota) {
        $this->mediaNota = $mediaNota;
    }

}
