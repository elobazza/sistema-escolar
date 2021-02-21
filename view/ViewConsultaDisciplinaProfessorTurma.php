<?php

/**
 * 
 * @author mduda
 */
class ViewConsultaDisciplinaProfessorTurma extends ViewPadrao {
    
    private $DiscProfTurmas = [];
             
    function getDiscProfTurmas() {
        return $this->DiscProfTurmas;
    }

    function setDiscProfTurmas(array $DiscProfTurmas) {
        $this->DiscProfTurmas = $DiscProfTurmas;
    }
    
    protected function getConteudo() {
        return '     
            <b><p class="titulo">CONSULTA DE DISCIPLINA/PROFESSOR/TURMA</p></b>
            <div style="background-color:#4a6891; height: 50px; width: 100%; margin-top: 30px; padding-top:10px">
                <div class="container">
                    <a href="index.php?pg=disciplinaProfessorTurma" style="color:white; font-size:18px; margin-right: 20px"> Cadastrar</a>
                    <a href="" onclick="alterar(event, \'disciplinaProfessorTurma\')" style="color:white; font-size:18px; margin-right: 20px"> Editar</a>
                    <a href="" onclick="excluir(event, \'disciplinaProfessorTurma\')" style="color:white; font-size:18px; margin-right: 20px"> Excluir</a>
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
                            <th>Disciplina</th>
                            <th>Turma</th>
                            <th>Professor - Nome</th>
                            <th>Professor - CPF</th>
                        </tr>
                        <tbody>
                        '.$this->createSelectListagem().'
                        </tbody>
                    </table>
                </form>';
    }
    
    private function createSelectListagem() {
        $sResult = "";
        
        foreach ($this->DiscProfTurmas as $oDiscProfTurma) { 
            $sResult .= ' <tr class="">
                            <td><input type="checkbox" name="linha" value=" '. $oDiscProfTurma->getCodigo() .'"/></td>
                            <td>' . $oDiscProfTurma->getDisciplina()->getNome() . '</td>
                            <td>' . $oDiscProfTurma->getTurma()->getNome() . '</td>
                            <td>' . $oDiscProfTurma->getProfessor()->getNome() . '</td>
                            <td>' . $oDiscProfTurma->getProfessor()->getCpf() . '</td>
                        </tr>';
        }
        return $sResult;
    }
}