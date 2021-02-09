<?php

/**
 * @author Eloisa Bazzanella e Maria Eduarda Buzana
 */
class ViewConsultaDisciplina extends ViewPadrao {
    private $disciplinas = [];
    private $disciplina;
    
    function getDisciplinas() {
        return $this->disciplinas;
    }

    function getDisciplina() {
        return $this->disciplina;
    }

    function setDisciplinas($disciplinas) {
        $this->disciplinas = $disciplinas;
    }

    function setDisciplina($disciplina) {
        $this->disciplina = $disciplina;
    }

    
    protected function getConteudo() {
        return '     
            <b><p class="titulo">CONSULTA DE DISCIPLINAS</p></b>
            <div style="background-color:#4a6891; height: 50px; width: 100%; margin-top: 30px; padding-top:10px">
                <div class="container">
                    <a href="index.php?pg=disciplina" style="color:white; font-size:18px; margin-right: 20px"> Cadastrar</a>
                    <a href="" onclick="alterar(\'disciplina\')" style="color:white; font-size:18px; margin-right: 20px"> Editar</a>
                    <a href="" onclick="excluir(\'disciplina\')" style="color:white; font-size:18px; margin-right: 20px"> Excluir</a>
                    <a href="index.php?pg=disciplina" style="color:white; font-size:18px; margin-right: 20px"> Professores</a>
                </div>
            </div>
            
          ' 
        . $this->montaTabela();
    }
    
    
    public function montaTabela(){
        return '<form method="get">
                    <table class="table table-striped table-selectable">
                        <tr>
                            <th></th>
                            <th>Nome</th>
                            <th>Carga Horária</th>
                        </tr>
                            <tbody>
                            '.$this->createSelectListagem().'
                            </tbody>
                    </table>
                </form>';
    }
    
    private function createSelectListagem() {
        $sResult = "";        
        foreach ($this->disciplinas as $oDisciplina) { 
            $sResult .= ' <tr class="">
                            <td><input type="checkbox" name="linha" value=" '. $oDisciplina->getCodigo() .'"/></td>
                            <td>' . $oDisciplina->getNome() . '</td>
                            <td>' . $oDisciplina->getCargaHoraria() . '</td>
                        </tr>';
        }
        return $sResult;
    }
}
