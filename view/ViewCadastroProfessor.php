<?php


class ViewCadastroProfessor extends ViewPadrao{
    private $escolas = [];
    private $disciplinas = [];
    private $escolasProfessor = [];
    private $disciplinasProfessor = [];
    private $professores;
    private $professor;
    
    function getEscolasProfessor() {
        return $this->escolasProfessor;
    }

    function getDisciplinasProfessor() {
        return $this->disciplinasProfessor;
    }

    function setEscolasProfessor($escolasProfessor) {
        $this->escolasProfessor = $escolasProfessor;
    }

    function setDisciplinasProfessor($disciplinasProfessor) {
        $this->disciplinasProfessor = $disciplinasProfessor;
    }

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

        
    function getEscolas() {
        return $this->escolas;
    }

    function getDisciplinas() {
        return $this->disciplinas;
    }

    function setEscolas(array $escolas) {
        $this->escolas = $escolas;
    }

    function setDisciplinas(array $disciplinas) {
        $this->disciplinas = $disciplinas;
    }

    function getConteudoCadastrar(){
        return '<form action="index.php?pg=professor&acao=insere" method="POST">
                <div class="container">
                    <label class="desc-formulario">Nome do Professor</label>
                    <input class="campo" type="text" name="nome" id="nome-professor" maxlength="50">
                    <label class="desc-formulario">CPF</label>
                    <input class="campo" type="text" name="cpf" id="cpf-professor" maxlength="14">
                    <label class="desc-formulario" >Contato</label>
                    <input class="campo" type="text" name="contato" id="contato-professor" maxlength="30">
                    <label class="desc-formulario">Especialidade</label>
                    <input class="campo" type="text" name="especialidade" id="especialidade-professor" maxlength="50">
                    <label class="desc-formulario" >Salário </label>
                    <input class="campo" type="text" name="salario" id="salario-professor" maxlength="12">
                    <label class="desc-formulario" >Disciplinas </label>
                    <table id="tabela-disciplina" class="tabela-adiciona">
                        <tr>
                            '.$this->createSelectCadastro().'
                        </tr>
                    </table>

                    <label class="desc-formulario" >Escolas</label>
                    <table id="tabela-escola" class="tabela-adiciona">
                        <tr>
                            '.$this->createSelectDoisCadastro().'
                        </tr>
                    </table>


                    <button class="limpar" id="limpar-professor">
                                    Limpar
                    </button>
                    <input type="submit" value="Cadastrar" class="cadastrar" id="cadastrar-professor">

                    <input type="submit" value="Cadastrar" class="cadastrar-peq" id="cadastrar-professor">

                </div>
                </form>
                <div class="container">
                    <form action="index.php?pg=professor" method="POST">
                        <select name="indice" id="indice" class="selecao-filtro">

                        '.$this->buscaIndice().'  
                        </select>
                        <input type="text" name="valor" class="selecao-valor">
                        <input type="submit" value="Filtrar" class="enviar-filtro">
                     </form>
                 </div>

                    '.$this->montaTabela().'';
    }

    function getConteudoAlterar(){
          return '<form action="index.php?pg=professor&acao=altera&efetiva=1" method="POST">
                <div class="container">

                    <label class="desc-formulario">Código</label>
                    <input class="campo" name="codigo" type="text" id="codigo-professor" value="'.$this->professor->getCodigo().'" >
                    <label class="desc-formulario">Nome do Professor</label>
                    <input class="campo" type="text" name="nome" id="nome-professor" maxlength="50"  value="'.$this->professor->getNome().'">
                    <label class="desc-formulario">CPF</label>
                    <input class="campo" type="text" name="cpf" id="cpf-professor" maxlength="14"  value="'.$this->professor->getCpf().'">
                    <label class="desc-formulario" >Contato</label>
                    <input class="campo" type="text" name="contato" id="contato-professor" maxlength="30"  value="'.$this->professor->getContato().'">
                    <label class="desc-formulario">Especialidade</label>
                    <input class="campo" type="text" name="especialidade" id="especialidade-professor" maxlength="50"  value="'.$this->professor->getEspecialidade().'">
                    <label class="desc-formulario" >Salário </label>
                    <input class="campo" type="text" name="salario" id="salario-professor" maxlength="12"  value="'.$this->professor->getSalario().'">


                     <label class="desc-formulario" >Disciplinas </label>


                      <table id="tabela-disciplina" class="tabela-adiciona">

                            '.$this->createSelect().'

                    </table>
                    <label class="desc-formulario" >Escolas</label>
                    <table id="tabela-escola" class="tabela-adiciona">
                        <tr>
                            '.$this->createSelectDoisCadastro().'
                        </tr>
                    </table>

                    <button class="limpar" id="limpar-professor">
                                    Limpar
                    </button>
                    <input type="submit" value="Cadastrar" class="cadastrar" id="cadastrar-professor">

                    <input type="submit" value="Cadastrar" class="cadastrar-peq" id="cadastrar-professor">

            </div>
            </form>
            <div class="container">
                <form action="index.php?pg=professor" method="POST">
                    <select name="indice" id="indice" class="selecao-filtro">

                    '.$this->buscaIndice().'  
                    </select>
                    <input type="text" name="valor" class="selecao-valor">
                    <input type="submit" value="Filtrar" class="enviar-filtro">
                 </form>
             </div>

            '.$this->montaTabela().''
         ;
      }    
    public function montaTabela(){
        return '<table class="table_listagem" style="clear:both">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Contato</th>
                        <th>Especialidade</th>
                        <th>Sálario</th>
                        <th>Disciplinas</th>
                        <th>Escolas</th>
                        <th>Ações</th>
                    </tr>
                    '.$this->createSelectListagem().'
                </table>';
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
