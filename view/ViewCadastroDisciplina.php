<?php


class ViewCadastroDisciplina extends ViewPadrao{
    private $disciplinas = [];
    private $disciplina;
    
    
    function getDisciplina() {
        return $this->disciplina;
    }

    function setDisciplina($disciplina) {
        $this->disciplina = $disciplina;
    }

    function getDisciplinas() {
        return $this->disciplinas;
    }

    function setDisciplinas($disciplinas) {
        $this->disciplinas = $disciplinas;
    }

        
    
    protected function getConteudoCadastrar(){
        return '<form action="index.php?pg=disciplina&acao=insere" method="POST">
            <div class="container">
                <label class="desc-formulario">Nome da Disciplina</label>
                <input class="campo" name="nome" type="text" id="nome-disciplina" maxlength="50">

                <label class="desc-formulario">Créditos</label>
                <input class="campo"  name="credito" type="number" id="credito-disciplina" max="20">

                <button class="limpar" id="limpar-disciplina">
                    Limpar
                </button>
                <input type="submit" class="cadastrar" id="cadastrar-disciplina" value="Cadastrar">

                <input type="submit" class="cadastrar-peq" id="cadastrar-disciplina" value="Cadastrar">

            </div></form> 
            <div class="container">
                <form action="index.php?pg=disciplina" method="POST">
                    <select name="indice" id="indice" class="selecao-filtro">

                    '.$this->buscaIndice().'  
                    </select>
                    <input type="text" name="valor" class="selecao-valor">
                    <input type="submit" value="Filtrar" class="enviar-filtro">
                 </form>
             </div>

            '.$this->montaTabela().'';
    }
    
    protected function getConteudoAlterar() {
        return '<form action="index.php?pg=disciplina&acao=altera&efetiva=1" method="POST">
            <div class="container">
                <label class="desc-formulario">Código</label>
                <input class="campo" name="codigo" type="text" id="codigo-disciplina" value="'.$this->disciplina->getCodigo().'" readonly>
                <label class="desc-formulario">Nome da Disciplina</label>
                <input class="campo" name="nome" type="text" id="nome-disciplina" maxlength="50" value="'.$this->disciplina->getNome().'">

                <label class="desc-formulario">Créditos</label>
                <input class="campo"  name="credito" type="number" id="credito-disciplina" max="20" value="'.$this->disciplina->getCredito().'">

                <button class="limpar" id="limpar-disciplina">
                    Limpar
                </button>
                <input type="submit" class="cadastrar" id="alterar-disciplina" value="Alterar">

                <input type="submit" class="cadastrar-peq" id="alterar-disciplina" value="Alterar">

            </div></form> 
            <div class="container">
                <form action="index.php?pg=disciplina" method="POST">
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
                        <th>Créditos</th>
                        <th>Ações</th>
                    </tr>
                    '.$this->createSelectListagem().'
                </table>';
    }
    
    private function createSelectListagem() {
        $sResult = "";

        foreach ($this->getDisciplinas() as $oDisciplina) { 
            $sResult .= ' <tr>
                            <td>' . $oDisciplina->getCodigo() . '</td>
                            <td>' . $oDisciplina->getNome() . '</td>
                            <td>' . $oDisciplina->getCredito() . '</td>
                            <td><a href="index.php?pg=disciplina&acao=altera&codigo='.$oDisciplina->getCodigo().'&efetiva=0"><img src="../images/edit.png" width="20px"></a>
                            <a href="index.php?pg=disciplina&acao=exclui&codigo='.$oDisciplina->getCodigo().'"><img src="../images/garbage-2.png" width="20px"></a></td>
                          </tr>';
        }
        return $sResult;
    }
    
    public function buscaIndice() {
        $aFiltros = ['discodigo', 'disnome', 'discredito'];
        $aValores = ['ID', 'Nome', 'Crédito'];
        $sOpcoes = "";
        for ($i = 0; $i < sizeof($aValores); $i++) {
            $sOpcoes .= '<option value="' . $aFiltros[$i] . '">'. $aValores[$i].'</option>';
        }
        return $sOpcoes;
    }
}
