<?php

/**
 * Description of ViewConsultaNota
 * 
 * @author Maria Eduarda e Eloísa
 */
class ViewConsultaNota extends ViewPadrao {
    
    private $notas = [];
    
    function getNotas() {
        return $this->notas;
    }

    function setNotas(array $notas) {
        $this->notas = $notas;
    }
    
    protected function getConteudo() {        
        switch($_SESSION['tipo']) {
            case 1: {
                return '     
                    <b><p class="titulo">CONSULTA DE NOTAS</p></b>
                    <div style="background-color:#4a6891; height: 50px; width: 100%; margin-top: 30px; padding-top:10px">
                        <div class="container">
                            <a href="" onclick="consultarNotaAluno(event)" style="color:white; font-size:18px; margin-right: 20px"> Visualizar Notas</a>
                        </div>
                    </div>
                  ' 
                . $this->montaTabelaEscola();
            }
            case 2: {
                return '     
                    <b><p class="titulo">REGISTRAR NOTAS</p></b>
                    <div style="background-color:#4a6891; height: 50px; width: 100%; margin-top: 30px; padding-top:10px">
                        <div class="container">
                            <a href="" onclick="" style="color:white; font-size:18px; margin-right: 20px"> Visualizar Notas</a>
                            <a href="" onclick="" style="color:white; font-size:18px; margin-right: 20px"> Registrar Notas</a>
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
    
    public function montaTabelaEscola(){
        return '<form method="get">
                    <table class="table table-striped table-selectable">
                        <tr>
                            <th></th>
                            <th>Disciplina</th>
                            <th>Professor</th>
                            <th>Aluno</th>
                            <th>Média</th>
                        </tr>
                        <tbody>
                        '.$this->createSelectListagemEscola().'
                        </tbody>
                    </table>
                </form>';
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
    
    private function createSelectListagemEscola() {
        $sResult = "";
        
        foreach ($this->notas as $oNota) { 
            $sResult .= ' <tr class="">
                            <td><input type="checkbox" name="linha" value=" '. $oNota->getAluno()->getUsuario()->getCodigo() .'"/></td>
                            <td>' . $oNota->getDisciplinaProfessorTurma()->getDisciplina()->getNome() . '</td>
                            <td>' . $oNota->getDisciplinaProfessorTurma()->getProfessor()->getNome() . '</td>
                            <td>' . $oNota->getAluno()->getNome() . '</td>
                            <td>' . round($oNota->getMedia(), 3) . '</td>
                        </tr>';
        }
        return $sResult;
    }
    
    private function createSelectListagemProfessor() {
        $sResult = "";
        
        foreach ($this->notas as $oNota) { 
            $sResult .= ' <tr class="">
                            <td><input type="checkbox" name="linha" value=" '. $oNota->getDisciplinaProfessorTurma()->getCodigo() .'"/></td>
                            <td>' . $oNota->getDisciplinaProfessorTurma()->getTurma()->getNome() . '</td>
                            <td>' . $oNota->getDisciplinaProfessorTurma()->getDisciplina()->getNome() . '</td>
                        </tr>';
        }
        return $sResult;
    }
}