<?php


class ViewCadastroCidade extends ViewPadrao{
    private $cidades = [];
    private $cidade;
    
    function getCidade() {
        return $this->cidade;
    }

    function setCidade($cidade) {
        $this->cidade = $cidade;
    }

        function getCidades() {
        return $this->cidades;
    }

    function setCidades(array $cidades) {
        $this->cidades = $cidades;
    }

    protected function getConteudoCadastrar(){
        return '<form action="index.php?pg=cidade&acao=insere" method="POST">
            <div class="container">
                <label class="desc-formulario">Nome da Cidade</label>
                <input class="campo" name="nome" type="text" id="nome-cidade" maxlength="50">

                <button class="limpar" id="limpar-cidade" >
                Limpar
                </button>

                <input type="submit" class="cadastrar" id="cadastrar-cidade" value="Cadastrar">
                <input type="submit" class="cadastrar-peq" id="cadastrar-cidade" value="Cadastrar">

            </div>
        </form>
        <div class="container">
            <form action="index.php?pg=cidade" method="POST">
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
        return '<form action="index.php?pg=cidade&acao=altera&efetiva=1" method="POST">
            <div class="container">
                <label class="desc-formulario">Código</label>
                <input class="campo" name="codigo" type="text" id="codigo-cidade" value="'.$this->cidade->getCodigo().'" readonly>
                <label class="desc-formulario">Nome da Cidade</label>
                <input class="campo" name="nome" type="text" id="nome-cidade" maxlength="50" value="'.$this->cidade->getNome().'">

                <button class="limpar" id="limpar-cidade" >
                Limpar
                </button>

                <input type="submit" class="cadastrar" id="alterar-cidade" value="Alterar">
                <input type="submit" class="cadastrar-peq" id="alterar-cidade" value="Alterar">

            </div>
        </form>
        <div class="container">
            <form action="index.php?pg=cidade" method="POST">
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
                        <th>Código</th>
                        <th>Nome</th>
                    </tr>
                    '.$this->createSelectListagem().'
                </table>';
    }
    
    private function createSelectListagem() {
        $sResult = "";

        foreach ($this->getCidades() as $oCidade) { 
            $sResult .= ' <tr>
                            <td>' . $oCidade->getCodigo() . '</td>
                            <td>' . $oCidade->getNome() . '</td>
                             </tr>';
        }
        return $sResult;
    }
    
    public function buscaIndice() {
        $aFiltros = ['cidcodigo', 'cidnome'];
        $aValores = ['ID', 'Nome'];
        $sOpcoes = "";
        for ($i = 0; $i < sizeof($aValores); $i++) {
            $sOpcoes .= '<option value="' . $aFiltros[$i] . '">'. $aValores[$i].'</option>';
        }
        return $sOpcoes;
    }
}
