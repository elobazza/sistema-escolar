<?php
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
    
    public function imprime(){
         
        echo '<!DOCTYPE html>
            <html>
                <head>
                    <meta charset="windows-1252">
                    <title>Página Inicial</title>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                    <link href="../estilo/estilo.css" rel="stylesheet" type="text/css"/>
                    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
                    <script src="../script/script.js" type="text/javascript"></script> 
                    <script src="../script/limparCampos.js" type="text/javascript"></script>
                    <script src="../script/verificacaoPreCadastro.js" type="text/javascript"></script>
                    <script src="../script/verificacaoPosCadastro.js" type="text/javascript"></script>
                    
                </head>
                <body>
                
                    '.$this->criarCabecalho().'
                    <content>
                        '.$this->getConteudo().'
                    </content>
                    '.$this->criarRodape().'
                </body>
            </html>';
    }    

    public function criarCabecalho(){
        if(isset($_SESSION['id'])){
            return '<div class="cabecalho">
                    <div class="container">
                            <div class="dropdown" id="menuzao">                             
                                <button class="drop-botao" id="botao-desce">Registros
                                <i class="fa fa-caret-down"></i>
                                </button>
                                <div class="dropdown-content" id="dropdown-content" id="dropdown">
                                    <a class="link-cabecalho" href="index.php?pg=aluno">Aluno</a>
                                    <a class="link-cabecalho" href="index.php?pg=aula">Aula</a>
                                    <a class="link-cabecalho" href="index.php?pg=cidade">Cidade</a>
                                    <a class="link-cabecalho" href="index.php?pg=disciplina">Disciplina</a>
                                    <a class="link-cabecalho" href="index.php?pg=professor">Professor</a>
                                    <a class="link-cabecalho" href="index.php?pg=sala">Sala</a>
                                    <a class="link-cabecalho" href="index.php?pg=turma">Turma</a>
                                </div>  
                            </div>
                            
                            <div class="dropdown" id="menuzinho">                             
                                <button class="drop-botao" id="botao-desce-dois">Registros
                                <i class="fa fa-caret-down"></i>
                                </button>
                                <div class="dropdown-content" id="dropdown-content" id="dropdown">
                                    <a class="link-cabecalho" href="index.php?pg=aluno">Aluno</a>
                                    <a class="link-cabecalho" href="index.php?pg=aula">Aula</a>
                                    <a class="link-cabecalho" href="index.php?pg=cidade">Cidade</a>
                                    <a class="link-cabecalho" href="index.php?pg=disciplina">Disciplina</a>
                                    <a class="link-cabecalho" href="index.php?pg=professor">Professor</a>
                                    <a class="link-cabecalho" href="index.php?pg=sala">Sala</a>
                                    <a class="link-cabecalho" href="index.php?pg=turma">Turma</a>
                                    <a class="link-cabecalho" href="index.php?pg=salaAula">Sala/Aula</a>
                                    <a class="link-cabecalho" href="index.php?pg=nota">Nota</a>
                                    
                                </div>  
                            </div>
                            

                        <div id="menuzao" class="dropdown">
                            <a href="index.php?pg=salaAula"><button class="drop-botao">Salas/Aula
                            </button></a>
                        </div>
                        <div id="menuzao" class="dropdown">
                            <a href="index.php?pg=nota"><button class="drop-botao">Notas
                            </button></a>
                        </div>
                        <div class="dropdown">
                            <a href="index.php?pg=escola"><button class="drop-botao">Perfil
                            </button></a>
                        </div>
                        <div class="dropdown">
                            <a href="index.php?pg=logout"><button class="drop-botao">Logout
                            </button></a>
                        </div>
                    </div>
                </div>';
        
        } 
        else {
            return '<div class="cabecalho">
                    <div class="container">
                            
                        <div class="dropdown">
                            <a href="index.php?pg=login"><button class="drop-botao">Login
                            </button></a>
                        </div>
                        <div class="dropdown">
                            <a href="index.php?pg=escola"><button class="drop-botao">Cadastro
                            </button></a>
                        </div>
                        
                        </div>
                    </div>
                </div>';
        }
        
    }
    public function criarRodape(){
        
        if(isset($_SESSION['id'])){
            return '<div id="footer">
                    <div class="container">
                        <table class="tabela-rodape">
                            <tr>
                                <th class="titulo-footer" colspan="2">Registros</th>
                            </tr>
                            <tr>
                                <td class="coluna"><a href="index.php?pg=aluno">Alunos</a></td>
                                <td class="coluna"><a href="index.php?pg=nota">Notas</a></td>
                            </tr>
                            <tr>
                                <td class="coluna"><a href="index.php?pg=aula">Aulas</a></td>
                                <td class="coluna"><a href="index.php?pg=professor">Professores</a></td>
                            </tr>
                            <tr>
                                <td class="coluna"><a href="index.php?pg=cidade">Cidades</a></td>
                                <td class="coluna"><a href="index.php?pg=turma">Turmas</a></td>

                            </tr>
                            <tr>
                                <td class="coluna"><a href="index.php?pg=disciplina">Disciplinas</a></td>
                                <td class="coluna"><a href="index.php?pg=aluno">Salas</a></td>
                            </tr>
                           
                            <tr>
                                <td class="coluna"><a href="index.php?pg=escola">Escolas</a></td>
                                <td class="coluna"><a href="index.php?pg=salaAula">Sala/Aula</a></td>
                            </tr>

                        </table>
                        <table class="tabela-rodape">
                            <tr>
                                <th class="titulo-footer" >Sobre</th>
                            </tr>
                            <tr>
                                <td class="coluna" style="font-family: Calibri; font-size: 15px;" >Eloísa Bazzanella</td> 
                            </tr>
                            <tr>
                                <td class="coluna" style="font-family: Calibri; font-size: 15px;" >elobazzanella@gmail.com</td> 
                            </tr>
                            <tr>
                                <td class="coluna" style="font-family: Calibri; font-size: 15px;" >Estagiária - <a target="_blank" href="https://www.ipm.com.br/">IPM Sistemas</a></td> 
                            </tr>
                            <tr>
                                <td class="coluna" style="font-family: Calibri; font-size: 15px;" >Programa Jovens Talentos</td> 
                            </tr>
                        </table>
                        
                        
                    </div>
                </div>';
        } else {
            return '<div id="footer">
                    <div class="container">
                        
                        <table class="tabela-rodape">
                            <tr>
                                <th class="titulo-footer" >Sobre</th>
                            </tr>
                            <tr>
                                <td class="coluna" style="font-family: Calibri; font-size: 15px;" >Eloísa Bazzanella</td> 
                            </tr>
                            <tr>
                                <td class="coluna" style="font-family: Calibri; font-size: 15px;" >elobazzanella@gmail.com</td> 
                            </tr>
                            <tr>
                                <td class="coluna" style="font-family: Calibri; font-size: 15px;" >Estagiária - <a target="_blank" href="https://www.ipm.com.br/">IPM Sistemas</a></td> 
                            </tr>
                            <tr>
                                <td class="coluna" style="font-family: Calibri; font-size: 15px;" >Programa Jovens Talentos</td> 
                            </tr>
                        </table>
                        
                        
                    </div>
                </div>';
        }
    }
}