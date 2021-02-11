<?php


class ViewCadastroProfessor extends ViewPadrao {
    
    private $professores;
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

    function setProfessores($professores) {
        $this->professores = $professores;
    }

    function getConteudoCadastrar(){
        return '<div id="cadastro">
            <form id="form" action="index.php?pg=professor&acao=insere" method="POST">
                    <div class="container">
                        <label class="titulo-formulario">CADASTRO DE PROFESSOR</label>
                        <input class="campo" type="text" name="nome" placeholder="Nome" id="nome" maxlength="50">
                        <input class="campo" type="text" name="cpf" placeholder="CPF" id="cpf" maxlength="14">
                        <input class="campo" type="text" name="data_nascimento" placeholder="Data de Nascimento" id="data_nascimento" maxlength="10">
                        <input class="campo" type="text" name="contato" placeholder="Contato" id="contato" maxlength="30">
                        <input class="campo" type="text" name="especialidade" placeholder="Especialidade" id="especialidade" maxlength="30">
                        <input class="campo" type="text" name="salario" placeholder="Salario" id="salario" maxlength="30">
                        <input class="campo" type="text" name="login" placeholder="Login" id="login" maxlength="30">
                        <input class="campo" type="password" name="senha" placeholder="Senha" id="senha" maxlength="30">
                    
                        <button class="limpar" id="limpar-professor">
                            Limpar
                        </button>
                        <input type="submit" class="cadastrar" id="cadastrar-professor" value="Cadastrar">                    
                        <input type="submit" class="cadastrar-peq" id="cadastrar-professor" value="Cadastrar">
                    </div>
                </form>
             </div>'
         ;
    } 
    
    protected function getConteudoAlterar() {
        return '<div id="cadastro">
            <form id="form" action="index.php?pg=professor&acao=altera&efetiva=1" method="POST">
                    <div class="container">
                        <label class="titulo-formulario">ALTERAR PROFESSOR</label>
                        <input class="campo" name="codigo" type="hidden" id="codigo" value="'.$this->professor->getUsuario()->getCodigo() .'">
                        <input class="campo" name="nome" type="text" id="nome" maxlength="50" value="'.$this->professor->getNome().'" >
                        <input class="campo" name="cpf" type="text" id="cpf" maxlength="14" value="'.$this->professor->getCpf().'">
                        <input class="campo" name="contato" type="text" id="contato"  maxlength="30" value="'.$this->professor->getContato().'">
                        <input class="campo" name="data_nascimento" type="text" id="data_nascimento"  maxlength="30" value="'.$this->professor->getData_nascimento().'">
                        <input class="campo" type="text" name="especialidade" id="especialidade" maxlength="30" value="'.$this->professor->getEspecialidade().'">
                        <input class="campo" type="text" name="salario" id="salario" maxlength="30" value="'.$this->professor->getSalario().'">

                        <button class="limpar" id="limpar-professor">Limpar</button>
                        <input type="submit" class="cadastrar" id="alterar-professor" value="Alterar">                    
                        <input type="submit" class="cadastrar-peq" id="alterar-professor" value="Alterar">
                    </div>
                </form>
             </div>';
    }
    
    
    
    
    
    
    
    
    
    
    private function createSelectListagem() {
        $sResult = "";

        foreach ($this->getProfessores() as $oProfessor) { 
            $sResult .= ' <tr>
                            <td>' . $oProfessor->getCodigo() . '</td>
                            <td>' . $oProfessor->getNome() . '</td>
                            <td>' . $oProfessor->getCpf() . '</td>
                            <td>' . $oProfessor->getContato() . '</td>
                            <td>' . $oProfessor->getEspecialidade() . '</td>
                            <td>' . $oProfessor->getSalario() . '</td>
                            <td>
                            <table class="table_muitos" id="tabela">
                            ' . $this->montaTabelaDisciplinas($oProfessor) . '
                            </table>
                            </td>
                            <td>
                            <table class="table_muitos" id="tabela-dois">
                            ' . $this->montaTabelaEscolas($oProfessor) . '
                            </table>
                            </td>
                            <td><a href="index.php?pg=professor&acao=altera&codigo='.$oProfessor->getCodigo().'&efetiva=0"><img src="../images/edit.png" width="20px"></a>
                             <a href="index.php?pg=professor&acao=exclui&codigo='.$oProfessor->getCodigo().'"><img src="../images/garbage-2.png" width="20px"></a></td>
                           </tr>';
        }
        return $sResult;
    }
    
    private function montaTabelaDisciplinas($oProfessor) {
        $aSelect = [];
        
        foreach ($oProfessor->getDisciplina() as $oDisciplina) {
            $aSelect[] = '<tr>'.$oDisciplina->getNome().'</tr><br>';
        }
        
        return implode(PHP_EOL, $aSelect);
    }
    
    private function montaTabelaEscolas($oProfessor) {
        $aSelect = [];
        
        foreach ($oProfessor->getEscola() as $oEscola) {
            $aSelect[] = '<tr>'.$oEscola->getNome().'</tr><br>';
        }
        
        return implode(PHP_EOL, $aSelect);
    }
    
    private function createSelectCadastro() {
        $aSelect = [];
        
        foreach ($this->disciplinas as $oDisciplina) {
            $aSelect[] = '<option value="' . $oDisciplina->getCodigo() . '">' . $oDisciplina->getNome() . '</option>';
        }
        //PHP_EOL é o </br> do PHP
        return '<td colspan="2"><select id="Disciplina" class="selecao-adiciona" >
                '. implode(PHP_EOL, $aSelect).'
                </select></td>
                <td><center><br><img src="./images/add-1.png"  class="imagem-add" onclick="adicionarDisciplina()"></center></td>';
    }
    
    private function createSelect() {
        $aSelect = [];
        $sSelecionado = " ";
        foreach ($this->disciplinas as $oDisciplina) {
            $aSelect[] = '<option value="' . $oDisciplina->getCodigo() . '">' . $oDisciplina->getNome() . '</option>';
        }
        foreach ($this->disciplinasProfessor as $oDisciplina) {
            $sSelecionado .= '<tr>
                    <td><input type="text" name="disciplinas[]" class="input-especial" readonly value="'.$oDisciplina->getCodigo().'"></td>
                    <td class="input-especial-nome" > '.$oDisciplina->getNome().'</td>
                    <td><img src="./images/garbage-2.png" width="20px" style="cursor:pointer" id="lixeira" onclick="limparCampoDisciplina(this)"></td>
               </tr>';
        }
        //PHP_EOL é o </br> do PHP
        return '<tr>
                    <td colspan="2"><select id="Disciplina" class="selecao-adiciona">
                    '. implode(PHP_EOL, $aSelect).'
                    </select></td>
                    <td ><center><br><img src="./images/add-1.png"  class="imagem-add" onclick="adicionarDisciplina()"></center></td>
                </tr>
                '. $sSelecionado.' ';
    }
    
    private function createSelectDoisCadastro() {
        $aSelect = [];
        
        foreach ($this->escolas as $oEscola) {
            if($oEscola->getCodigo() == $_SESSION['id']){
                $aSelect[] = '<option value="' . $oEscola->getCodigo() . '" selected >' . $oEscola->getNome() . '</option>';
            } else {
          
            }
        }
        //PHP_EOL é o </br> do PHP
        return '<td><select id="Escola" class="selecao-escola" name="escolas[]">
                '. implode(PHP_EOL, $aSelect).'
                </select></td>
                ';
    }
    private function createSelectDois() {
        $aSelect = [];
        $sSelecionado = "";
        foreach ($this->escolas as $oEscola) {
            if($oEscola->getCodigo() == $_SESSION['id']){
                $aSelect[] = '<option value="' . $oEscola->getCodigo() . '" selected >' . $oEscola->getNome() . '</option>';
            } else {
          
            }
          
        }
       foreach ($this->escolasProfessor as $oEscola) {
          
            $sSelecionado .= '<tr>
                    <td><input type="text" name="escolas[]" class="input-especial" readonly value="'.$oEscola->getCodigo().'"></td>
                    <td>'.$oEscola->getNome().'</td>
                    <td><img src="./images/garbage-2.png" width="20px" style="cursor:pointer" id="lixeira" onclick="limparCampoEscola(this)"></td>
               </tr>';
        }
        //PHP_EOL é o </br> do PHP
        return '<tr>
                    <td><select id="Escola" class="selecao-adiciona" id="professor-escola">
                    '. implode(PHP_EOL, $aSelect).'
                    </select></td>
                    <td><center><br><img src="./images/add-1.png"  class="imagem-add" onclick="adicionarEscola()"></center></td>
                </tr>
                '. $sSelecionado.' ';
    }
    
    public function buscaIndice() {
        $aFiltros = ['procodigo', 'pronome', 'procpf', 'procontato', 'proespecialidade'];
        $aValores = ['ID', 'Nome', 'CPF', 'Contato', 'Especialidade'];
        $sOpcoes = "";
        for ($i = 0; $i < sizeof($aValores); $i++) {
            $sOpcoes .= '<option value="' . $aFiltros[$i] . '">'. $aValores[$i].'</option>';
        }
        return $sOpcoes;
    }
}
