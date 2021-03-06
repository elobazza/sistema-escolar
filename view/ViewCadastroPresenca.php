<?php

class ViewCadastroPresenca extends ViewPadrao {
    
    private $alunos = [];
    private $aula;
    
    function getAula() {
        return $this->aula;
    }

    function setAula($aula) {
        $this->aula = $aula;
    }
 
    function getAlunos() {
        return $this->alunos;
    }

    function setAlunos($alunos) {
        $this->alunos = $alunos;
    }

    function getConteudoCadastrar(){
        return '<b><p class="titulo">REGISTROS DE PRESENÇA DA AULA </p></b>    
            <form id="form" action="index.php?pg=presenca&acao=insere" method="POST">
			
                ' . $this->montaTabela() . '

                <div class="container">
                    <input type="hidden" name="id_aula" value=" '. $this->getAula() .'"/>
                    <input type="date" class="campo" id="data" name="data" value=""/>
                    
                    <div id="limpar" onclick="limpar()">Limpar</div>
                    <input type="submit" class="cadastrar" id="cadastrar-nota" value="Cadastrar">                    
                    <input type="submit" class="cadastrar-peq" id="cadastrar-nota" value="Cadastrar">
		</div>
                
           </form>';
    }
    
    public function montaTabela(){
        return '<table class="table table-striped table-selectable">
                        <tr>    
                            <th></th>
                            <th>Matricula</th>
                            <th>Aluno</th>
                            <th>Presença</th>
                        </tr>
                        <tbody>
                        '.$this->createSelect().'
                        </tbody>
                    </table>';
    }
    
    private function createSelect() {
        $sResult = "";
        
        foreach ($this->alunos as $oAluno) { 
            $sResult .= ' <tr class="">
                            <td></td>
                            <td>' . $oAluno->getMatricula() . '</td>
                            <td>' . $oAluno->getNome() . '</td>
                            <td><input type="checkbox" name="A' . $oAluno->getUsuario()->getCodigo() . '" value="off"/></td>
                        </tr>';
        }
        return $sResult;
    }
    
}