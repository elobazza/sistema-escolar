<?php
/**
 * @author Eloísa Bazzanella, Maria Eduarda Sandner Buzana
 */
class ViewConsultaBoletim extends ViewPadrao {

    private $boletins = [];
    
    function getBoletins() {
        return $this->boletins;
    }

    function setBoletins($boletins) {
        $this->boletins = $boletins;
    }

    protected function getConteudo() {
        return ' <b><p class="titulo">BOLETIM</p></b>'. $this->montaTabela();
    }
    
    
    public function montaTabela(){
        return '<div class="container">
                    <table class="table table-striped table-selectable">
                        <tr>
                            <th colspan="2">Escola Básica Municipal Victória Cerutti Petters</th>
                            <th colspan="2">Endereço: Rua Doutor Getúlio Vargas</th>
                        </tr>
                        <tr>
                            <th>Matrícula: 10093155956</th>
                            <th colspan="2">Aluno: Eloísa Bazzanella</th>
                            <th>Turma: 1° ano B</th>
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
                            <td>' . $oBoletim->getTaxaPresenca() . '</td>
                        </tr>';
        }
        return $sResult;
    }
    
    
}
