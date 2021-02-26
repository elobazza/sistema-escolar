<?php
/**
 * @author Eloisa Bazzanella e Maria Eduarda Buzana
 */
class ViewCadastroNota extends ViewPadrao {
    
    private $alunos = [];
    private $codProfessorDisciplinaTurma;
    
    function getCodProfessorDisciplinaTurma() {
        return $this->codProfessorDisciplinaTurma;
    }

    function setCodProfessorDisciplinaTurma($codProfessorDisciplinaTurma) {
        $this->codProfessorDisciplinaTurma = $codProfessorDisciplinaTurma;
    }
 
    function getAlunos() {
        return $this->alunos;
    }

    function setAlunos($alunos) {
        $this->alunos = $alunos;
    }

    function getConteudoCadastrar(){
        return '<b><p class="titulo">REGISTROS DE NOTAS DA TURMA </p></b>    
            <form action="index.php?pg=nota&acao=insere" method="POST">
			
                ' . $this->montaTabela() . '

                <div class="container">
                    <input type="hidden" name="id_discproftur" value=" '. $this->getCodProfessorDisciplinaTurma() .'"/>
                    <input type="text" class="campo" id="descricao" name="descricao" value="" placeholder="Descrição"/>
                    <input type="date" class="campo" id="data" name="data" value=""/>
                    
                    <div id="limpar" onclick="limpar()">Limpar</div>
                    <input type="submit" class="cadastrar" id="cadastrar-aluno" value="Cadastrar">                    
                    <input type="submit" class="cadastrar-peq" id="cadastrar-aluno" value="Cadastrar">
		</div>
                
           </form>';
    }
    
    public function montaTabela(){
        return '<form method="get">
                    <table class="table table-striped table-selectable">
                        <tr>    
                            <th></th>
                            <th>Matricula</th>
                            <th>Aluno</th>
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
        
        foreach ($this->alunos as $oAluno) { 
            $sResult .= ' <tr class="">
                            <td></td>
                            <td>' . $oAluno->getMatricula() . '</td>
                            <td>' . $oAluno->getNome() . '</td>
                            <td><input type="text" class="campo-nota" name="nota" value=" '. $oAluno->getUsuario()->getCodigo() .'"/></td>
                        </tr>';
        }
        return $sResult;
    }
}
