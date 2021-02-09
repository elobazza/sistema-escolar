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
                    <a href="index.php?pg=disciplina" style="color:white; font-size:18px; margin-right: 20px"> Editar</a>
                    <a href="index.php?pg=disciplina" style="color:white; font-size:18px; margin-right: 20px"> Excluir</a>
                    <a href="index.php?pg=disciplina" style="color:white; font-size:18px; margin-right: 20px"> Professores</a>
                </div>
            </div>
            
          ' 
        . $this->montaTabela();
    }
    
    
    public function montaTabela(){
        return '<table class="table_listagem" style="clear:both">
                    <tr>
                        <th>Nome</th>
                        <th>Carga Horária</th>
                    </tr>
                    
                    '.$this->createSelectListagem().'
                </table>';
    }
    
    private function createSelectListagem() {
        $sResult = "";
        
        foreach ($this->disciplinas as $oDisciplina) { 
            $sResult .= ' <tr>
                            <td>' . $oDisciplina->getNome() . '</td>
                            <td>' . $oDisciplina->getCargaHoraria() . '</td>
                        </tr>';
        }
        return $sResult;
    }
}
