<?php
/**
 * View Consulta de Aluno
 *
 * @author Eloisa Bazzanella e Maria Eduarda Buzana
 */
class ViewConsultaAluno extends ViewPadrao {
    
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
        return '     
            <b><p class="titulo">CONSULTA DE ALUNOS</p></b>
            <div style="background-color:#4a6891; height: 50px; width: 100%; margin-top: 30px; padding-top:10px">
                <div class="container">
                    <a href="index.php?pg=aluno" style="color:white; font-size:18px; margin-right: 20px"> Cadastrar</a>
                    <a href="" onclick="alterar()" style="color:white; font-size:18px; margin-right: 20px"> Editar</a>
                    <a href="" onclick="excluir()" style="color:white; font-size:18px; margin-right: 20px"> Excluir</a>
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
                            <th>Data de Nascimento</th>
                            <th>Contato</th>
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
                            <td>' . $oAluno->getData_nascimento() . '</td>
                            <td>' . $oAluno->getContato() . '</td>
                            <td>' . $oAluno->getTurma()->getNome() . '</td>
                        </tr>';
        }
        return $sResult;
    }
}
