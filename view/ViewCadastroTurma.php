<?php


class ViewCadastroTurma extends ViewPadrao{
    private $disciplinas;
    private $disciplinasTurma;
    private $turmas;
    private $turma;
    
    function getDisciplinasTurma() {
        return $this->disciplinasTurma;
    }

    function setDisciplinasTurma($disciplinasTurma) {
        $this->disciplinasTurma = $disciplinasTurma;
    }

        function getTurmas() {
        return $this->turmas;
    }

    function getTurma() {
        return $this->turma;
    }

    function setTurmas($turmas) {
        $this->turmas = $turmas;
    }

    function setTurma($turma) {
        $this->turma = $turma;
    }

        function getDisciplinas() {
        return $this->disciplinas;
    }

    function setDisciplinas($disciplinas) {
        $this->disciplinas = $disciplinas;
    }

    function getConteudoCadastrar(){
        return '<form action="index.php?pg=turma&acao=insere" method="POST">
            <div class="container">
                <label class="desc-formulario">Nome da Turma</label>
                <input class="campo" name="nome" type="text" id="nome-turma" maxlength="50">
                <label class="desc-formulario">Disciplinas</label>
                <table id="tabela-disciplina" class="tabela-adiciona">
                <tr>
                '.$this->createSelectCadastro().'
                </tr>
                </table>
               
                <button class="limpar" id="limpar-turma">
                                Limpar
                </button>
                <input type="submit" value="Cadastrar" class="cadastrar" id="cadastrar-turma">

                <input type="submit" value="Cadastrar" class="cadastrar-peq" id="cadastrar-turma">

           </div>
         </form>
        <div class="container">
                <form action="index.php?pg=turma" method="POST">
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
        return '<form action="index.php?pg=turma&acao=altera&efetiva=1" method="POST">
            <div class="container">
                <label class="desc-formulario">Código</label>
                <input class="campo" name="codigo" type="text" id="codigo-turma" value="'.$this->turma->getCodigo().'" readonly>
          
                <label class="desc-formulario">Nome da Turma</label>
                <input class="campo" name="nome" type="text" id="nome-turma" maxlength="50" value="'.$this->turma->getNome().'">
                <label class="desc-formulario">Disciplinas</label>
                <table id="tabela-disciplina" class="tabela-adiciona">
                <tr>
                '.$this->createSelect().'
                </tr>
                </table>
               
                <button class="limpar" id="limpar-turma">
                                Limpar
                </button>
                <input type="submit" value="Alterar" class="cadastrar" id="alterar-turma">

                <input type="submit" value="Alterar" class="cadastrar-peq" id="alterar-turma">

           </div>
         </form>
        <div class="container">
                <form action="index.php?pg=turma" method="POST">
                    <select name="indice" id="indice" class="selecao-filtro">

                    '.$this->buscaIndice().'  
                    </select>
                    <input type="text" name="valor" class="selecao-valor">
                    <input type="submit" value="Filtrar" class="enviar-filtro">
                 </form>
             </div> 

        '.$this->montaTabela().'';
    }
    
    
    public function montaTabela(){
        return '<table class="table_listagem" style="clear:both">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>  
                        <th>Disciplinas</th>
                        <th>Ações</th>
                    </tr>
                    '.$this->createSelectListagem().'
                </table>';
    }
    
    private function montaTabelaDisciplinas($oTurma) {
        $aSelect = [];
        
        foreach ($oTurma->getDisciplina() as $oDisciplina) {
            $aSelect[] = '<tr>'.$oDisciplina->getNome().'</tr><br>';
        }
        
        return implode(PHP_EOL, $aSelect);
    }
    
    private function createSelectListagem() {
        $sResult = "";

        foreach ($this->getTurmas() as $oTurma) { 
            $sResult .= '
                <tr>
                    <td>' . $oTurma->getCodigo() . '</td>
                    <td>' . $oTurma->getNome() . '</td>

                    <td>
                    <table class="table_muitos">
                    ' . $this->montaTabelaDisciplinas($oTurma) . '
                    </table>
                    </td>

                    <td><a href="index.php?pg=turma&acao=altera&codigo='.$oTurma->getCodigo().'&efetiva=0"><img src="../images/edit.png" width="20px"></a>
                     <a href="index.php?pg=turma&acao=exclui&codigo='.$oTurma->getCodigo().'"><img src="../images/garbage-2.png" width="20px"></a></td>
                </tr>';
        }
        return $sResult;
    }
    
    private function createSelectCadastro() {
        $aSelect = [];
        
        foreach ($this->disciplinas as $oDisciplina) {
            $aSelect[] = '<option value="' . $oDisciplina->getCodigo() . '">' . $oDisciplina->getNome() . '</option>';
        }
        //PHP_EOL � o </br> do PHP
        return '<td colspan="2"><select id="Disciplina" class="selecao-adiciona" id="disciplina-turma">
                '. implode(PHP_EOL, $aSelect).'
                </select></td>
                <td><br><img class="img-add" src="./images/add-1.png" style="width: 20px; cursor:pointer;" onclick="adicionarDisciplina()"></td>';
    }
    
    private function createSelect() {
        $aSelect = [];
        $sSelecionado = "";
        foreach ($this->disciplinas as $oDisciplina) {
            $aSelect[] = '<option value="' . $oDisciplina->getCodigo() . '">' . $oDisciplina->getNome() . '</option>';
        }
        foreach ($this->disciplinasTurma as $oDisciplina) {
            $sSelecionado .= '<tr>
                    <td><input type="text" name="disciplinas[]" class="input-especial" readonly value="'.$oDisciplina->getCodigo().'"></td>
                    <td class="input-especial-nome">'.$oDisciplina->getNome().'</td>
                    <td><img src="./images/garbage-2.png" width="20px" style="cursor:pointer" id="lixeira" onclick="limparCampoDisciplina(this)"></td>
               </tr>';
        }
        //PHP_EOL � o </br> do PHP
        return '<tr>
                    <td colspan="2"><select id="Disciplina" class="selecao-adiciona"id="disciplina-turma">
                    '. implode(PHP_EOL, $aSelect).'
                    </select></td>
                    <td><br><img class="img-add" src="./images/add-1.png" style="width: 20px; cursor:pointer;" onclick="adicionarDisciplina()"></td>
                </tr>
                 '. $sSelecionado.' ';
    
        
        }
        
    public function buscaIndice() {
        $aFiltros = ['turcodigo', 'turnome'];
        $aValores = ['ID', 'Nome'];
        $sOpcoes = "";
        for ($i = 0; $i < sizeof($aValores); $i++) {
            $sOpcoes .= '<option value="' . $aFiltros[$i] . '">'. $aValores[$i].'</option>';
        }
        return $sOpcoes;
    }
}
