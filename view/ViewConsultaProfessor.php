<?php

/**
 * Description of ViewConsultaProfessor
 *
 * @author mduda
 */
class ViewConsultaProfessor extends ViewPadrao {
    
    private $professores = [];
    private $professor;
    
     function getProfessor() {
        return $this->professor;
    }

    function setProfessor($professor) {
        $this->professor = $professor;
    }
         
    function getProfessores() {
        return $this->professores;
    }

    function setProfessores(array $professores) {
        $this->professores = $professores;
    }
    
    protected function getConteudo() {
        return '     
            <b><p class="titulo">CONSULTA DE PROFESSORES</p></b>
            <div style="background-color:#4a6891; height: 50px; width: 100%; margin-top: 30px; padding-top:10px">
                <div class="container">
                    <a href="index.php?pg=professor" style="color:white; font-size:18px; margin-right: 20px"> Cadastrar</a>
                    <a href="" onclick="alterar(event, \'professor\');" style="color:white; font-size:18px; margin-right: 20px"> Editar</a>
                    <a href="" onclick="excluir(event, \'professor\')" style="color:white; font-size:18px; margin-right: 20px"> Excluir</a>
                    <a href="" onclick="consultarDisciplinaProfessor(event)" style="color:white; font-size:18px; margin-right: 20px"> Disciplinas</a>
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
                            <th>CPF</th>
                            <th>Data de Nascimento</th>
                            <th>Contato</th>
                            <th>Salário</th>
                        </tr>
                        <tbody>
                        '.$this->createSelectListagem().'
                        </tbody>
                    </table>
                </form>';
    }
    
    private function createSelectListagem() {
        $sResult = "";
        
        foreach ($this->professores as $oProfessor) { 
            $sResult .= ' <tr class="">
                            <td><input type="checkbox" name="linha" value=" '. $oProfessor->getUsuario()->getCodigo() .'"/></td>
                            <td>' . $oProfessor->getNome() . '</td>
                            <td>' . $oProfessor->getCpf() . '</td>
                            <td>' . $oProfessor->getDataNascimento() . '</td>
                            <td>' . $oProfessor->getContato() . '</td>
                            <td>' . $oProfessor->getSalario() . '</td>
                        </tr>';
        }
        return $sResult;
    }
}