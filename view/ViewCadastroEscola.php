<?php
/**
 * @author Eloisa Bazzanella e Maria Eduarda Buzana
 */
class ViewCadastroEscola extends ViewPadrao {
    private $escola;
    
    function getEscola() {
        return $this->escola;
    }

    function setEscola($escola) {
        $this->escola = $escola;
    }
    
    function getConteudoCadastrar(){        
        if(!isset($_SESSION['id'])){
            return 
            '<form action="index.php?pg=escola&acao=insere" method="POST">
                <div class="container" style="height: 455px; margin-top:25px">
                    <label class="titulo-formulario">CADASTRE-SE</label>
                    <input class="campo" type="text" name="login" placeholder="Login" id="login" maxlength="50">
                    <input class="campo" type="password" name="senha" placeholder="Senha" id="senha" maxlength="32">
                    <input class="campo" type="text" name="nome" placeholder="Nome da Escola" id="nome" maxlength="50">
                    <input class="campo" type="text" name="contato" placeholder="Contato" id="contato" maxlength="30">
                    <input class="campo" type="text" name="cidade" placeholder="Cidade" id="cidade" maxlength="100">
                    <input class="campo" type="text" name="estado" placeholder="Estado" id="estado" maxlength="2">
                    <input class="campo" type="text" name="bairro" placeholder="Bairro" id="bairro" maxlength="255">
                    <input class="campo" type="text" name="rua" placeholder="Logradouro" id="rua" maxlength="255">
                    <input class="campo" type="number" name="numero" placeholder="Número" id="numero" maxlength="7">
                    <input class="campo" type="text" name="complemento" placeholder="Complemento" id="complemento" maxlength="255">
                    
                    <div id="limpar" onclick="limpar()">Limpar</div>
                    <input type="submit" value="Cadastrar" class="cadastrar" id="cadastrar-escola">
                    <input type="submit" value="Cadastrar" class="cadastrar-peq" id="cadastrar-escola">
                </div>
            </form>';
        } else {
            return $this->getConteudoAlterar();
        }
    }
    
    function getConteudoAlterar(){
        return '<form action="index.php?pg=escola&acao=altera&efetiva=1" method="POST">
                    <div class="container">
                        <label class="titulo-formulario">PERFIL</label>
                        <input class="campo" type="text" name="login" placeholder="Login" id="login" maxlength="50" value="' . $this->getEscola()->getNome() . '">
                        <input class="campo" type="password" name="senha" placeholder="Senha" id="senha" maxlength="32">
                        <input class="campo" type="text" name="nome" placeholder="Nome da Escola" id="nome" maxlength="50">
                        <input class="campo" type="text" name="contato" placeholder="Contato" id="contato" maxlength="30">
                        <input class="campo" type="text" name="cidade" placeholder="Cidade" id="cidade" maxlength="100">
                        <input class="campo" type="text" name="estado" placeholder="Estado" id="estado" maxlength="2">
                        <input class="campo" type="text" name="bairro" placeholder="Bairro" id="bairro" maxlength="255">
                        <input class="campo" type="text" name="rua" placeholder="Logradouro" id="rua" maxlength="255">
                        <input class="campo" type="number" name="numero" placeholder="Número" id="numero" maxlength="7">
                        <input class="campo" type="text" name="complemento" placeholder="Complemento" id="complemento" maxlength="255">

                        <div id="limpar" onclick="limpar()">Limpar</div>
                        <input type="submit" value="Alterar" class="cadastrar" id="cadastrar-escola">
                        <input type="submit" value="Alterar" class="cadastrar-peq" id="cadastrar-escola">

                    </div>
                 </form>';
            
    }
}    