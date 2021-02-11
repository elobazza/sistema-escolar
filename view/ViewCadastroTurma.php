<?php
/**
 * @author Eloisa Bazzanella e Maria Eduarda Buzana
 */
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
        return '<div id="cadastro">
            <form id="form" action="index.php?pg=turma&acao=insere" method="POST">
                    <div class="container">
                        <label class="titulo-formulario">CADASTRO DE TURMA</label>
                        <input class="campo" type="text" name="nome" placeholder="Nome" id="nome" maxlength="50">
                    
                        <input type="submit" class="cadastrar" id="cadastrar-turma" value="Cadastrar">                    
                        <input type="submit" class="cadastrar-peq" id="cadastrar-turma" value="Cadastrar">
                    </div>
                </form>
             </div>';
    }
    
    
    function getConteudoAlterar(){
        return '<div id="cadastro">
            <form id="form" action="index.php?pg=turma&acao=insere" method="POST">
                    <div class="container">
                        <label class="titulo-formulario">ALTERAR TURMA</label>
                        <input class="campo" name="codigo" type="hidden" id="codigo" value="'.$this->turma->getCodigo() .'">
                        <input class="campo" name="nome" type="text" id="nome" maxlength="50" value="'.$this->turma->getNome().'" >
                    
                        <input type="submit" class="cadastrar" id="alterar-turma" value="Alterar">                    
                        <input type="submit" class="cadastrar-peq" id="alterar-turma" value="Alterar">
                    </div>
                </form>
             </div>';
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
