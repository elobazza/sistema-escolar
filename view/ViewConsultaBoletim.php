<?php
/**
 * @author Eloísa Bazzanella, Maria Eduarda Sandner Buzana
 */
class ViewConsultaBoletim extends ViewPadrao {

    private $boletins = [];
    private $Aluno;
    private $Escola;
    
    function getEscola() {
        return $this->Escola;
    }

    function setEscola($Escola) {
        $this->Escola = $Escola;
    }
    
    function getBoletins() {
        return $this->boletins;
    }

    function setBoletins($boletins) {
        $this->boletins = $boletins;
    }
    
    function getAluno() {
        return $this->Aluno;
    }

    function setAluno($Aluno) {
        $this->Aluno = $Aluno;
    }
    
    protected function getConteudo() {
        return ' <b><p class="titulo">BOLETIM</p></b>'. $this->montaTabela();
    }
    
    public function montaTabela(){
        return '<div class="container">
                    <table class="table table-striped table-selectable">
                        <tr>
                            <th colspan="2">' . $this->getEscola()->getNome() . '</th>
                            <th colspan="2">
                                ' . $this->getEscola()->getEndereco()->getRua() . '
                                ' . $this->getEscola()->getEndereco()->getNumero() . '
                                ' . $this->getEscola()->getEndereco()->getComplemento() . ', 
                                ' . $this->getEscola()->getEndereco()->getCidade() . ' /
                                ' . $this->getEscola()->getEndereco()->getEstado() . '
                            </th>
                        </tr>
                        <tr>
                            <th>Matrícula: ' . $this->getAluno()->getMatricula() . '</th>
                            <th colspan="2">Aluno: ' . $this->getAluno()->getNome() . '</th>
                            <th>' . $this->getAluno()->getTurma()->getNome() . '</th>
                        </tr>
                        <tr>
                            <th>Disciplina</th>
                            <th>Professor</th>
                            <th>Média Final</th>
                            <th>Presença</th>
                        </tr>
                        <tbody>
                        '.$this->createSelectListagem().'
                        </tbody>
                    </table>
                </div>';
    }
    
    private function createSelectListagem() {
        $sResult = "";
        
        foreach ($this->boletins as $oBoletim) { 
            $sResult .= ' <tr class="">
                            <td>' . $oBoletim->getDiscProfTur()->getDisciplina()->getNome() . '</td>
                            <td>' . $oBoletim->getDiscProfTur()->getProfessor()->getNome() . '</td>
                            <td>' . $oBoletim->getMediaNota() . '</td>
                            <td>' . $oBoletim->getTaxaPresenca() . '%</td>
                        </tr>';
        }
        return $sResult;
    }
    
    
}
