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
                    <a href="index.php?pg=aluno" style="color:white; font-size:18px; margin-right: 20px"> Editar</a>
                    <a href="index.php?pg=aluno" style="color:white; font-size:18px; margin-right: 20px"> Excluir</a>
                    <a href="index.php?pg=aluno" style="color:white; font-size:18px; margin-right: 20px"> Visualizar</a>
                </div>
            </div>
            
          ' 
        . $this->montaTabela();
    }
    
    
    public function montaTabela(){
        return '<table class="table_listagem" style="clear:both">
                    <tr>
                        <th>Nome</th>
                        <th>Matrícula</th>
                        <th>CPF</th>
                        <th>Data de Nascimento</th>
                        <th>Contato</th>
                        <th>Turma</th>
                    </tr>
                    
                    '.$this->createSelectListagem().'
                </table>';
    }
    
    private function createSelectListagem() {
        $sResult = "";
        
        foreach ($this->alunos as $oAluno) { 
            $sResult .= ' <tr>
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
