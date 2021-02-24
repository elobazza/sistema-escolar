<?php

/**
 * Description of ViewConsultaPresenca
 * 
 * @author Maria Eduarda e Eloísa
 */
class ViewConsultaPresenca extends ViewPadrao {
    
    private $presencas = [];
    
    function getPresencas() {
        return $this->presencas;
    }

    function setPresencas(array $presencas) {
        $this->presencas = $presencas;
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
                            <a href="" onclick="" style="color:white; font-size:18px; margin-right: 20px"> Visualizar Presencas</a>
                            <a href="" onclick="" style="color:white; font-size:18px; margin-right: 20px"> Registrar Presencas</a>
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
        
        foreach ($this->presencas as $oPresenca) { 
            $sResult .= ' <tr class="">
                            <td><input type="checkbox" name="linha" value=" '. $oPresenca->getAula()->getCodigo() .'"/></td>
                            <td>' . $oPresenca->getAula()->getDisciplinaProfessorTurma()->getTurma()->getNome() . '</td>
                            <td>' . $oPresenca->getAula()->getDisciplinaProfessorTurma()->getDisciplina()->getNome() . '</td>
                        </tr>';
        }
        return $sResult;
    }
}