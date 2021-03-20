<?php

/**
 * @author Eloísa Bazzanella, Maria Eduarda Buzana
 */
class ViewConsultaAlunosBoletim extends ViewPadrao {

    private $alunos = [];
         
    function getAlunos() {
        return $this->alunos;
    }

    function setAlunos(array $alunos) {
        $this->alunos = $alunos;
    }
    
    protected function getConteudo() {
        return '     
            <b><p class="titulo">CONSULTA DE ALUNOS</p></b>
            <div style="background-color:#4a6891; height: 50px; width: 100%; margin-top: 30px; padding-top:10px">
                <div class="container">
                    <a href="" onClick="verBoletim(event)" style="color:white; font-size:18px; margin-right: 20px"> Ver Boletim</a>
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
                            <th>Matrícula</th>
                            <th>CPF</th>
                            <th>Turma</th>
                        </tr>
                        <tbody>
                        '.$this->createSelectListagem().'
                        </tbody>
                    </table>
                </form>';
    }
    
    private function createSelectListagem() {
        $sResult = "";
        
        foreach ($this->alunos as $oAluno) { 
            $sResult .= ' <tr class="">
                            <td><input type="checkbox" name="linha" value=" '. $oAluno->getUsuario()->getCodigo() .'"/></td>
                            <td>' . $oAluno->getNome() . '</td>
                            <td>' . $oAluno->getMatricula() . '</td>
                            <td>' . $oAluno->getCpf() . '</td>
                            <td>' . $oAluno->getTurma()->getNome() . '</td>
                        </tr>';
        }
        return $sResult;
    }
}
