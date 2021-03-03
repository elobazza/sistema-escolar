<?php
/**
 * @author Eloísa Bazzanella, Maria Eduarda Buzana
 */
class ViewConsultaNotaAluno extends ViewPadrao {
    
    private $notas = [];
    
    function getNotas() {
        return $this->notas;
    }

    function setNotas($notas) {
        $this->notas = $notas;
    }

    protected function getConteudo() {        
        switch($_SESSION['tipo']) {
            case 1: case 2: case 3: {
                return '<b><p class="titulo">CONSULTA DE NOTAS DO ALUNO</p></b>'. $this->montaTabela();
                break;
            }
        }
    }
    
    public function montaTabela(){
        return '<form method="get">
                    <table class="table table-striped table-selectable">
                        <tr>
                            <th></th>
                            <th>Descrição</th>
                            <th>Data</th>
                            <th>Nota</th>
                        </tr>
                        <tbody>
                        '.$this->createSelect().'
                        </tbody>
                    </table>
                </form>';
    }
    
    private function createSelect() {
        $sResult = "";
        
        foreach ($this->notas as $oNota) { 
            $sResult .= ' <tr class="">
                            <td><input type="checkbox" name="linha" value=" '. $oNota->getCodigo() .'"/></td>
                            <td>' . $oNota->getDescricao() . '</td>
                            <td>' . $oNota->getData() . '</td>
                            <td>' . $oNota->getNota() . '</td>
                        </tr>';
        }
        return $sResult;
    }
}
