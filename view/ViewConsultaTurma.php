<?php

/**
 * Description of ViewConsultaTurma
 *
 * @author mduda
 */
class ViewConsultaTurma extends ViewPadrao {
    
    private $turmas = [];
    private $professor;
    
     function getTurma() {
        return $this->professor;
    }

    function setTurma($professor) {
        $this->professor = $professor;
    }
         
    function getTurmas() {
        return $this->turmas;
    }

    function setTurmas(array $turmas) {
        $this->turmas = $turmas;
    }
    
    protected function getConteudo() {
        return '     
            <b><p class="titulo">CONSULTA DE TURMAS</p></b>
            <div style="background-color:#4a6891; height: 50px; width: 100%; margin-top: 30px; padding-top:10px">
                <div class="container">
                    <a href="index.php?pg=turma" style="color:white; font-size:18px; margin-right: 20px"> Cadastrar</a>
                    <a href="" onclick="alterar(\'turma\')" style="color:white; font-size:18px; margin-right: 20px"> Editar</a>
                    <a href="" onclick="excluir(\'turma\')" style="color:white; font-size:18px; margin-right: 20px"> Excluir</a>
                    <a href="" onclick="" style="color:white; font-size:18px; margin-right: 20px"> Professores/Disciplinas</a>
                    <a href="#" style="color:white; font-size:18px; margin-right: 20px"> Aulas</a>
                    <a href="" onclick="consultarAlunoTurma()" style="color:white; font-size:18px; margin-right: 20px"> Alunos</a>
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
                        </tr>
                        <tbody>
                        '.$this->createSelectListagem().'
                        </tbody>
                    </table>
                </form>';
    }
    
    private function createSelectListagem() {
        $sResult = "";
        
        foreach ($this->turmas as $oTurma) { 
            $sResult .= ' <tr class="">
                            <td><input type="checkbox" name="linha" value=" '. $oTurma->getCodigo() .'"/></td>
                            <td>' . $oTurma->getNome() . '</td>
                        </tr>';
        }
        return $sResult;
    }
}