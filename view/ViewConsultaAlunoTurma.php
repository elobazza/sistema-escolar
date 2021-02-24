<?php
/**
 * @author Eloisa Bazzanella e Maria Eduarda Buzana
 */
class ViewConsultaAlunoTurma extends ViewPadrao {
    
    private $alunos = [];
    private $aluno;
    
     function getAluno() {
        return $this->aluno;
    }

    function setAluno($aluno) {
        $this->aluno = $aluno;
    }
         
    function getAlunos() {
        return $this->alunos;
    }

    function setAlunos(array $alunos) {
        $this->alunos = $alunos;
    }
    
    protected function getConteudo() {
        return '<b><p class="titulo">ALUNOS DA TURMA</p></b>' 
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
                            <th>Data de Nascimento</th>
                            <th>Contato</th>
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
                            <td>' . $oAluno->getDataNascimento() . '</td>
                            <td>' . $oAluno->getContato() . '</td>
                        </tr>';
        }
        return $sResult;
    }
}
 