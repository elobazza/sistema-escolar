<?php
/**
 * @author Eloísa Bazzanella, Maria Eduarda Buzana
 */
class ViewConsultaDesempenho extends ViewPadrao {
    
    private $Professores = [];
    
    function getProfessores() {
        return $this->Professores;
    }

    function setProfessores($Professores) {
        $this->Professores = $Professores;
    }

    protected function getConteudo() {
        return ' <b><p class="titulo">DESEMPENHO</p></b>
                   <div style="background-color:#4a6891; height: 50px; width: 100%; margin-top: 30px; padding-top:10px">
                        <div class="container">
                            <a href="" onclick="visualizarDesempenho(event)" style="color:white; font-size:18px; margin-right: 20px"> Visualizar Desempenho</a>
                         </div>
                    </div>
         '. $this->montaTabela();
    }
    
    public function montaTabela(){
        return '<table class="table table-striped table-selectable">

                    <tr>
                        <th></th>
                        <th>Professor</th>
                    </tr>
                    <tbody>
                    '.$this->createSelectListagem().'
                    </tbody>
                </table>';
    }
    
    private function createSelectListagem() {
        $sResult = "";
        
        foreach ($this->Professores as $oProfessor) { 
            $sResult .= ' <tr class="">
                            <td><input type="checkbox" name="linha" value=" '. $oProfessor->getUsuario()->getCodigo() .'"/></td>
                            <td>' . $oProfessor->getNome() . '</td>
                        </tr>';
        }
        return $sResult;
    }
}
