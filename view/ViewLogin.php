<?php


class ViewLogin extends ViewPadrao {
    
    public function imprime() {
        echo 
        '<!DOCTYPE html>
        <html class="tela_login">
        <head>
            <title>Newtown - Login</title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
            <link href="../estilo/estilo.css" rel="stylesheet" type="text/css"/>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
        </head>
        <body class="tela_login">
            <div class="container h-100">
                <div class="d-flex justify-content-center h-100">
                    <div class="user_card">
                        <div class="d-flex justify-content-center">
                            <div class="brand_logo_container">
                                <img src="../images/logo.png" class="brand_logo" alt="Logo">
                            </div>
                        </div>
                        <div class="d-flex justify-content-center form_container">
                            <form action="index.php?pg=login&acao=logar" method="POST">
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" name="nome" class="form-control input_user" value="" placeholder="Login">
                                </div>
                                <div class="input-group mb-2">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>
                                    <input type="password" name="senha" class="form-control input_pass" value="" placeholder="Senha">
                                </div>
                                <div class="d-flex justify-content-center mt-3 login_container">
                                    <input type="submit" value="Login" class="btn login_btn" id="login">                                    
                                </div>
                                <a href="index.php?pg=escola" class="d-flex justify-content-center mt-3 login_container">
                                    <button type="button" name="button" class="btn login_btn">Cadastrar-se</button>
                                </a>                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </body>
        </html>';
    }
    
//    function getConteudo() {         
//        return '
//        <form action="index.php?pg=login&acao=logar" method="POST">
//            <div class="container">
//                <label class="desc-formulario">Login</label>
//                <input class="campo" name="nome" type="text" id="nome-login" maxlength="50">
//                <label class="desc-formulario">Senha</label>
//                <input class="campo" name="senha" type="password" id="senha-login" maxlength="50">
//                <button class="limpar" id="limpar-turma">
//                                Limpar
//                </button>
//                <input type="submit" value="Login" class="cadastrar" id="login">
//                <input type="submit" value="Login" class="cadastrar-peq" id="login">
//           </div>
//         </form>';
//    }
}