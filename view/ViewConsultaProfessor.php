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
                    <a href="index.php?pg=professor" style="color:white; font-size:18px; margin-right: 20px"> Editar</a>
                    <a href="index.php?pg=professor" style="color:white; font-size:18px; margin-right: 20px"> Excluir</a>
                </div>
            </div>
            
          ' 
        . $this->montaTabela();
    }
    
    
    public function montaTabela(){
        return '<table class="table_listagem" style="clear:both">
                    <tr>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Data de Nascimento</th>
                        <th>Contato</th>
                        <th>Salário</th>
                    </tr>
                    
                    '.$this->createSelectListagem().'
                </table>';
    }
    
    private function createSelectListagem() {
        $sResult = "";
        
        foreach ($this->professores as $oProfessor) { 
            $sResult .= ' <tr>
                            <td>' . $oProfessor->getNome() . '</td>
                            <td>' . $oProfessor->getCpf() . '</td>
                            <td>' . $oProfessor->getData_nascimento() . '</td>
                            <td>' . $oProfessor->getContato() . '</td>
                            <td>' . $oProfessor->getSalario() . '</td>
                        </tr>';
        }
        return $sResult;
    }
}