<?php
/**
 * @author Eloísa Bazzanella, Maria Eduarda Buzana
 */
class ViewConsultaDesempenhoProfessor extends ViewPadrao {
    
    private $Boletins = [];
    private $Professor;
    
    function getBoletins() {
        return $this->Boletins;
    }

    function setBoletins($Boletins) {
        $this->Boletins = $Boletins;
    }
    
    function getProfessor() {
        return $this->Professor;
    }

    function setProfessor($Professor) {
        $this->Professor = $Professor;
    }


    protected function getConteudo() {
        return ' <b><p class="titulo">Desempenho: ' . $this->getProfessor()->getNome() . '</p></b>
         '. $this->montaTabela();
    }
    
    public function montaTabela(){
        return '<div class="container">
                    <table class="table table-striped table-selectable">
                       
                        <tr>
                            <th>Aluno</th>
                            <th>Presença</th>
                            <th>Média</th>
                        </tr>
                        <tbody>
                        '.$this->createSelectListagem().'
                        </tbody>
                    </table>
                </div>';
    }
    
    private function createSelectListagem() {
        $sResult = "";
        
        foreach ($this->Boletins as $oBoletim) { 
            $sResult .= ' <tr class="">
                            <td>' . $oBoletim->getAluno()->getNome() . '</td>
                            <td>' . $oBoletim->getTaxaPresenca() . '%</td>
                            <td>' . $oBoletim->getMediaNota() . '</td>
                        </tr>';
        }
        return $sResult;
    }
    


}
