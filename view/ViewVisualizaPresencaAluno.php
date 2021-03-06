<?php

class ViewVisualizaPresencaAluno extends ViewPadrao {
    
    private $presencas = [];
    
    function getPresencas() {
        return $this->presencas;
    }

    function setPresencas($presencas) {
        $this->presencas = $presencas;
    }

    protected function getConteudo() {        
        switch($_SESSION['tipo']) {
            case 1: case 2: case 3: {
                return '<b><p class="titulo">CONSULTA DE PRESENÇAS DO ALUNO</p></b>'. $this->montaTabela();
                break;
            }
        }
    }
    
    public function montaTabela(){
        return '<form method="get">
                    <table class="table table-striped table-selectable">
                        <tr>
                            <th></th>
                            <th>Aluno</th>
                            <th>Data</th>
                            <th>Presença</th>
                        </tr>
                        <tbody>
                        '.$this->createSelect().'
                        </tbody>
                    </table>
                </form>';
    }
    
    private function createSelect() {
        $sResult = "";
        
        foreach ($this->presencas as $oPresenca) { 
            $sResult .= ' <tr class="">
                            <td><input type="hidden" name="linha" value=" '. $oPresenca->getCodigo() .'"/></td>
                            <td>' . $oPresenca->getAluno()->getNome() . '</td>
                            <td>' . $oPresenca->getData() . '</td>';
                                
            if($oPresenca->getPresenca() == 't') {
                $sResult .= '<td>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                                </svg>
                            </td>';
                
            } else {
                $sResult .= '<td>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                </svg>
                            </td>';
            }     
            $sResult .= '</tr>';
        }
        return $sResult;
    }
}