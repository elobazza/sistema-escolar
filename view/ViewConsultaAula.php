<?php

/**
 * Description of ViewConsultaAula
 *
 * @author mduda
 */
class ViewConsultaAula extends ViewPadrao {
    
    private $aulas = [];
             
    function getAulas() {
        return $this->aulas;
    }

    function setAulas(array $turmas) {
        $this->aulas = $turmas;
    }
    
    protected function getConteudo() {
        switch($_SESSION['tipo']) {
            case 1 : {
                return '     
                    <b><p class="titulo">CONSULTA DE AULAS</p></b>
                    <div style="background-color:#4a6891; height: 50px; width: 100%; margin-top: 30px; padding-top:10px">
                        <div class="container">
                            <a href="index.php?pg=aula" style="color:white; font-size:18px; margin-right: 20px"> Cadastrar</a>
                            <a href="" onclick="alterar(event, \'aula\')" style="color:white; font-size:18px; margin-right: 20px"> Editar</a>
                            <a href="" onclick="excluir(event, \'aula\')" style="color:white; font-size:18px; margin-right: 20px"> Excluir</a>
                        </div>
                    </div>

                  ' 
                . $this->montaTabela();
            }
            case 2: case 3: {
                return '     
                    <b><p class="titulo">CONSULTA DE AULAS</p></b>
                  ' 
                . $this->montaTabela();
            }
        }
    }
    
    public function montaTabela(){
        return '<form method="get">
                    <table class="table table-striped table-selectable">
                        <tr>
                            <th></th>
                            <th>Horário Inicial</th>
                            <th>Horário Final</th>
                            <th>Disciplina</th>
                            <th>Turma</th>
                            <th>Professor</th>
                            <th>Dia da Semana</th>
                        </tr>
                        <tbody>
                        '.$this->createSelectListagem().'
                        </tbody>
                    </table>
                </form>';
    }
    
    private function createSelectListagem() {
        $sResult = "";
        
        foreach ($this->aulas as $oAula) { 
            $sResult .= ' <tr class="">
                            <td><input type="checkbox" name="linha" value=" '. $oAula->getCodigo() .'"/></td>
                            <td>' . $oAula->getHorarioInicio() . '</td>
                            <td>' . $oAula->getHorarioFim() . '</td>
                            <td>' . $oAula->getDisciplinaProfessorTurma()->getDisciplina()->getNome() . '</td>
                            <td>' . $oAula->getDisciplinaProfessorTurma()->getTurma()->getNome() . '</td>
                            <td>' . $oAula->getDisciplinaProfessorTurma()->getProfessor()->getNome() . '</td>
                            <td>' . $oAula->getDiaSemana() . '</td>
                        </tr>';
        }
        return $sResult;
    }
}