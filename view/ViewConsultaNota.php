<?php

/**
 * @author Maria Eduarda e Eloísa
 */
class ViewConsultaNota extends ViewPadrao {
    
    private $disciplinaProfessorTurmas = [];
    private $medias = [];
    
    function getDisciplinaProfessorTurmas() {
        return $this->disciplinaProfessorTurmas;
    }

    function getMedias() {
        return $this->medias;
    }

    function setDisciplinaProfessorTurmas($disciplinaProfessorTurmas) {
        $this->disciplinaProfessorTurmas = $disciplinaProfessorTurmas;
    }

    function setMedias($medias) {
        $this->medias = $medias;
    }
    
    protected function getConteudo() {        
        switch($_SESSION['tipo']) {
            case 1: {
                return '     
                    <b><p class="titulo">CONSULTA DE NOTAS</p></b>
                    <div style="background-color:#4a6891; height: 50px; width: 100%; margin-top: 30px; padding-top:10px">
                        <div class="container">
                            <a href="" onclick="consultarNotaTurma(event)" style="color:white; font-size:18px; margin-right: 20px"> Visualizar Notas</a>
                        </div>
                    </div>
                  ' 
                . $this->montaTabela();
                break;
            }
            case 2: {
                return '     
                    <b><p class="titulo">CONSULTA DE NOTAS</p></b>
                    <div style="background-color:#4a6891; height: 50px; width: 100%; margin-top: 30px; padding-top:10px">
                        <div class="container">
                            <a href="" onclick="consultarNotaTurma(event)" style="color:white; font-size:18px; margin-right: 20px"> Visualizar Notas</a>
                            <a href="" onclick="registrarNota(event)" style="color:white; font-size:18px; margin-right: 20px"> Registrar Notas</a>
                        </div>
                    </div>
                  ' 
                . $this->montaTabela();
                break;
            }
            case 3: {
             
                break;
            }
        }
    }
    
    public function montaTabela(){
        return '<form method="get">
                    <table class="table table-striped table-selectable">
                        <tr>
                            <th></th>
                            <th>Turma</th>
                            <th>Disciplina</th>
                            <th>Professor</th>
                            <th>Média da Turma</th>
                        </tr>
                        <tbody>
                        '.$this->createSelect().'
                        </tbody>
                    </table>
                </form>';
    }
    
    private function createSelect() {
        $sResult = "";
        
        foreach ($this->disciplinaProfessorTurmas as $oDiscProfTur) { 
            $sResult .= ' <tr class="">
                            <td><input type="checkbox" name="linha" value=" '. $oDiscProfTur->getCodigo() .'"/></td>
                            <td>' . $oDiscProfTur->getTurma()->getNome() . '</td>
                            <td>' . $oDiscProfTur->getDisciplina()->getNome() . '</td>
                            <td>' . $oDiscProfTur->getProfessor()->getNome() . '</td>
                            <td> 10 </td>
                        </tr>';
        }
        return $sResult;
    }
    
}