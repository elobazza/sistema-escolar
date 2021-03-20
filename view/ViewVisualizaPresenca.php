<?php

/**
 * @author Maria Eduarda e Eloísa
 */
class ViewVisualizaPresenca extends ViewPadrao {
    
    private $alunos = [];
    private $taxaPresencas = [];
    
    function getAlunos() {
        return $this->alunos;
    }

    function setAlunos($alunos) {
        $this->alunos = $alunos;
    }
    
    function getTaxaPresencas() {
        return $this->taxaPresencas;
    }

    function setTaxaPresencas($taxaPresencas) {
        $this->taxaPresencas = $taxaPresencas;
    }
    
    protected function getConteudo() {        
        switch($_SESSION['tipo']) {
            case 2: case 1: {
                return '     
                    <b><p class="titulo">LISTA DE PRESENÇA</p></b>
                    <div style="background-color:#4a6891; height: 50px; width: 100%; margin-top: 30px; padding-top:10px">
                        <div class="container">
                            <a href="" onclick="consultarPresencaIndividual(event, \'' . Redirecionador::getParametro('codigo') .'\')" style="color:white; font-size:18px; margin-right: 20px"> Visualizar Presença Individual</a>
                            </div>
                    </div>
                  ' 
                . $this->montaTabela();
            }
            case 3: {
             
            }
        }
    }
    
    public function montaTabela(){
        return '<form method="get">
                    <table class="table table-striped table-selectable">
                        <tr>
                            <th></th>
                            <th>Nome Aluno</th>
                            <th>Taxa de Presença</th>
                        </tr>
                        <tbody>
                        '.$this->createSelectListagemProfessor().'
                        </tbody>
                    </table>
                </form>';
    }
    
    private function createSelectListagemProfessor() {
        $sResult = "";
        $contador = 0;
        foreach ($this->alunos as $oAluno) { 
            $sResult .= ' <tr class="">
                            <td><input type="checkbox" name="linha" value="'. $oAluno->getUsuario()->getCodigo() .'"/></td>
                            <td>' . $oAluno->getNome() . '</td>
                            <td>' . floatval($this->taxaPresencas[$contador]) .  '% </td>
                        </tr>';
            $contador++;
        }
        return $sResult;
    }
}