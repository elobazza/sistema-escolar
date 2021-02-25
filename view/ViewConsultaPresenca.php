<?php

/**
 * Description of ViewConsultaPresenca
 * 
 * @author Maria Eduarda e Eloísa
 */
class ViewConsultaPresenca extends ViewPadrao {
    
    private $disciplinaProfessorTurmas = [];
    
    function getDisciplinaProfessorTurmas() {
        return $this->disciplinaProfessorTurmas;
    }

    function setDisciplinaProfessorTurmas(array $disciplinaProfessorTurmas) {
        $this->disciplinaProfessorTurmas = $disciplinaProfessorTurmas;
    }
    
    protected function getConteudo() {        
        switch($_SESSION['tipo']) {
            case 1: {
                break;
            }
            case 2: {
                return '     
                    <b><p class="titulo">REGISTRAR PRESENÇA</p></b>
                    <div style="background-color:#4a6891; height: 50px; width: 100%; margin-top: 30px; padding-top:10px">
                        <div class="container">
                            <a href="" onclick="visualizar(event, \'consultaPresenca\')" style="color:white; font-size:18px; margin-right: 20px"> Visualizar Presenças</a>
                            <a href="" onclick="registrar(event, \'presenca\')" style="color:white; font-size:18px; margin-right: 20px"> Registrar Presenças</a>
                        </div>
                    </div>
                  ' 
                . $this->montaTabelaProfessor();
            }
            case 3: {
             
                break;
            }
        }
    }
    
    public function montaTabelaProfessor(){
        return '<form method="get">
                    <table class="table table-striped table-selectable">
                        <tr>
                            <th></th>
                            <th>Turma</th>
                            <th>Disciplina</th>
                        </tr>
                        <tbody>
                        '.$this->createSelectListagemProfessor().'
                        </tbody>
                    </table>
                </form>';
    }
    
    private function createSelectListagemProfessor() {
        $sResult = "";
        
        foreach ($this->disciplinaProfessorTurmas as $oDiscProfTur) { 
            $sResult .= ' <tr class="">
                            <td><input type="checkbox" name="linha" value="'. $oDiscProfTur->getCodigo() .'"/></td>
                            <td>' . $oDiscProfTur->getTurma()->getNome() . '</td>
                            <td>' . $oDiscProfTur->getDisciplina()->getNome() . '</td>
                        </tr>';
        }
        return $sResult;
    }
}