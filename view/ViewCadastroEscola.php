<?php

class ViewCadastroEscola extends ViewPadrao{
    private $escolas;
    private $cidades;
    private $escola;
    
    function getEscola() {
        return $this->escola;
    }

    function setEscola($escola) {
        $this->escola = $escola;
    }

        function getEscolas() {
        return $this->escolas;
    }

    function setEscolas($escolas) {
        $this->escolas = $escolas;
    }
   
    function getCidades() {
        return $this->cidades;
    }

    function setCidades($cidades) {
        $this->cidades = $cidades;
    }

        
    function getConteudoCadastrar(){
        
        if(!isset($_SESSION['id'])){
            return '<form action="index.php?pg=escola&acao=insere" method="POST">
                <div class="container">
                    <label class="desc-formulario">Nome da Escola</label>
                    <input class="campo" type="text" name="nome" id="nome" maxlength="50">
                    <label class="desc-formulario">Endereço</label>
                    <input class="campo"  type="text" name="endereco"  id="endereco" maxlength="50">
                    <label class="desc-formulario">Contato</label>
                    <input class="campo" type="text" name="contato"  id="contato" maxlength="30">
                    <label class="desc-formulario">Login </label>
                    <input class="campo" type="text" name="login"  id="login" maxlength="50">
                    <label class="desc-formulario">Senha</label>
                    <input class="campo" type="password" name="senha" id="senha" maxlength="32">
                    
                    <label class="desc-formulario"  >Cidade</label>
                    
                    '.$this->createSelect().'
                    
                    <button class="limpar" id="limpar-escola">
                                    Limpar
                    </button>
                    <input type="submit" value="Cadastrar" class="cadastrar" id="cadastrar-escola">

                    <input type="submit" value="Cadastrar" class="cadastrar-peq" id="cadastrar-escola">

            </div>
            </form>
            '
            ;
        } else {
            return $this->getConteudoAlterar();
        }
    }
    
    function getConteudoAlterar(){
        return '<form action="index.php?pg=escola&acao=altera" method="POST">
                <div class="container">
                
                    <label class="desc-formulario">Nome da Escola</label>
                    <input class="campo" type="text" name="nome" id="nome" maxlength="50" value="'.$_SESSION['nome'].'">
                    <label class="desc-formulario">Endereço</label>
                    <input class="campo"  type="text" name="endereco" value="'.$_SESSION['endereco'].'" id="endereco" maxlength="50">
                    <label class="desc-formulario">Contato</label>
                    <input class="campo" type="text" name="contato" value="'.$_SESSION['contato'].'" id="contato" maxlength="30">
                    <label class="desc-formulario">Login </label>
                    <input class="campo" type="text" name="login"  value="'.$_SESSION['login'].'" id="login" maxlength="50">
                    <label class="desc-formulario">Senha</label>
                    <input class="campo" type="password" name="senha" id="senha" maxlength="20">
                    
                    <label class="desc-formulario"  >Cidade</label>
                    
                    '.$this->createSelect().'
                    
                    <button class="limpar" id="limpar-escola">
                                    Limpar
                    </button>
                    <input type="submit" value="Alterar" class="cadastrar" id="cadastrar-escola">

                    <input type="submit" value="Alterar" class="cadastrar-peq" id="cadastrar-escola">

            </div>
            </form>
            <div class="container">
                <form action="index.php?pg=escola" method="POST">
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
                        <th>Endereço</th>
                        <th>Contato</th>
                        <th>Cidade</th>
                        <th>Login</th>
                        
                    </tr>
                    '.$this->createSelectListagem().'
                </table>';
    }
    
    private function createSelectListagem() {
        $sResult = "";

        foreach ($this->getEscolas() as $oEscola) { 
            $sResult .= ' <tr>
                            <td>' . $oEscola->getCodigo() . '</td>
                            <td>' . $oEscola->getNome() . '</td>
                            <td>' . $oEscola->getEndereco() . '</td>
                            <td>' . $oEscola->getContato() . '</td>
                            <td>' . $oEscola->getCidade()->getNome() . '</td>
                            <td>' . $oEscola->getLogin() . '</td>
                             </tr>';
        }
        return $sResult;
    }
    
    private function createSelect() {
        $aSelect = [];
        
        foreach ($this->cidades as $oCidade) {
//            if($this->escola->getCidade()->getCodigo() == $oCidade->getCodigo()){
//                $aSelect[] = '<option value="' . $oCidade->getCodigo() . '" selected>' . $oCidade->getNome() . '</option>';
//            } else {
                $aSelect[] = '<option value="' . $oCidade->getCodigo() . '">' . $oCidade->getNome() . '</option>';
//            }
        }
        //PHP_EOL � o </br> do PHP
        return '<select class="selecao" name="cidade" id="cidade-escola">
                '. implode(PHP_EOL, $aSelect).'
                </select>';
    }
    
    public function buscaIndice() {
        $aFiltros = ['esccodigo', 'escnome', 'escendereco', 'esccontato', 'cidnome'];
        $aValores = ['ID', 'Nome', 'Endereço', 'Contato', 'Cidade'];
        $sOpcoes = "";
        for ($i = 0; $i < sizeof($aValores); $i++) {
            $sOpcoes .= '<option value="' . $aFiltros[$i] . '">'. $aValores[$i].'</option>';
        }
        return $sOpcoes;
    }
}
