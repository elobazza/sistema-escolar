<?php
/**
 * @author Eloisa Bazzanella e Maria Eduarda Buzana
 */
abstract class ViewPadrao {

    private $alterar;
    
    function getAlterar() {
        return $this->alterar;
    }

    function setAlterar($alterar) {
        $this->alterar = $alterar;
    }
        
    protected function getConteudo() {
        return $this->alterar ? $this->getConteudoAlterar() : $this->getConteudoCadastrar();
    }

    protected function getConteudoCadastrar() {}

    protected function getConteudoAlterar() {}

    public function imprime() {

        echo '<!DOCTYPE html>
            <html>
                <head>
                    <meta charset="windows-1252">
                    <title>Página Inicial</title>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                    
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
                    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
                    <link rel="stylesheet" href="../estilo/Estilo.css" type="text/css"/>
                    
                    
                    <script src="../script/ScriptsGerais.js" type="text/javascript"></script> 
                    <script src="../script/ChecaCampos.js" type="text/javascript"></script>
                    <script src="../script/verificacaoPosCadastro.js" type="text/javascript"></script>
                    <script src="https://cdn.jsdelivr.net/npm/toastify-js" type="text/javascript"></script>
                    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
                    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
                </head>
                <body>
                
                    ' . $this->criarCabecalho() . '
                    <content>
                        ' . $this->getConteudo() . '
                    </content>
                    ' . $this->criarRodape() . '
                    ' . $this->criarMensagens() . '
                </body>
            </html>';
    }

    public function criarCabecalho() {
        if (isset($_SESSION['id'])) {
            return '<nav class="navbar navbar-dark navbar-expand-lg">
                        <div class="container">
                            <a class="navbar-brand" href="index.php?pg=telaPrincipal">
                            <img src="../images/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
                                Newton
                            </a>
                            <ul class="navbar-nav ml-auto">
                                <a href="index.php?pg=escola&acao=alterar&efetiva=0" class="nav-link active">
                                    Perfil
                                </a>
                            </ul>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav mr-auto">
                                  <li class="nav-item active mr-2 dropdown">
                                      <a class="nav-link dropdown-toggle" href="#" id="dropdownMenuRegistersButton" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          Registros
                                      </a>
                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuRegistersButton">
                                        <a class="dropdown-item" href="index.php?pg=consultaAluno">Alunos</a>
                                        <a class="dropdown-item" href="index.php?pg=consultaProfessor">Professores</a>
                                        <a class="dropdown-item" href="index.php?pg=consultaDisciplina">Disciplinas</a>
                                        <a class="dropdown-item" href="index.php?pg=consultaTurma">Turmas</a>
                                        <a class="dropdown-item" href="index.php?pg=consultaAula">Aulas</a>
                                      </div>
                                  </li>
                                  <li class="nav-item active mr-2 dropdown">
                                      <a class="nav-link dropdown-toggle" href="#" id="dropdownMenuReportButton" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          Relatórios
                                      </a>
                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuReportButton">
                                        <a class="dropdown-item" href="#">Boletins</a>
                                      </div>
                                  </li>
                                </ul>
                                <ul class="navbar-nav ml-auto">
                                    <a href="index.php?pg=logout" class="nav-link active">
                                        Sair
                                    </a>
                                </ul>
                            </div>
                        </div>
                    </nav>';
        } else {
            return '<div class="cabecalho">
                        <div class="container">
                            <div class="dropdown">
                                <a href="index.php?pg=login"><img src="../images/logo-titulo.png" style="width: 200px; margin-top:5px; margin-bottom: 5px"></a>
                            </div>
                        </div>
                    </div>';
        }
    }

    public function criarRodape() {
        return '<div id="footer">
                    <div class="container">                        
                        <p style="font-family: Calibri; text-align: center; font-size: 15px; padding-top: 25px">Copyright ® Eloísa Bazzanella e Maria Eduarda Sandner Buzana, 2021</p>
                    </div>
                </div>';
    }
    
    public function criarMensagens() {
        $message = Redirecionador::getParametro("message");
        
        $messageText = '';
        $messagType = '';
        
        if($message) {
            switch($message) {
                case 'sucessoinclusao':
                    $messageText = 'Registro inserido com sucesso';
                    $messagType = 'Success';
                    break;
                case 'sucessoalteracao':
                    $messageText = 'Registro alterado com sucesso';
                    $messagType = 'Success';
                    break;
                case 'sucessoexclusao':
                    $messageText = 'Registro excluído com sucesso';
                    $messagType = 'Success';
                    break;
                case 'erroinclusao':
                    $messageText = 'Erro ao inserir registro';
                    $messagType = 'Error';
                    break;
                case 'erroalteracao':
                    $messageText = 'Erro ao alterar registro';
                    $messagType = 'Error';
                    break;
                case 'erroexclusao':
                    $messageText = 'Erro ao inserir registro';
                    $messagType = 'Error';
                    break;
            }
            
            return '
                <script>
                    Toastify({
                        text: "' . $messageText . '",
                        className: "'. $messagType .'",
                        position: "center",
                        duration: 3000,
                    }).showToast() 
                </script>';
        }
    }
}
