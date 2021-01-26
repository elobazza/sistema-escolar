<?php


class ViewLogin extends ViewPadrao {
    function getConteudo() {
         
        return '
        <form action="index.php?pg=login&acao=logar" method="POST">
            <div class="container">
                <label class="desc-formulario">Login</label>
                <input class="campo" name="nome" type="text" id="nome-login" maxlength="50">
                <label class="desc-formulario">Senha</label>
                <input class="campo" name="senha" type="password" id="senha-login" maxlength="50">
                <button class="limpar" id="limpar-turma">
                                Limpar
                </button>
                <input type="submit" value="Login" class="cadastrar" id="login">
                <input type="submit" value="Login" class="cadastrar-peq" id="login">

           </div>
         </form>';
    }
}