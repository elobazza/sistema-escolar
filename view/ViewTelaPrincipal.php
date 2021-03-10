<?php

/**
 * View da Tela Principal
 *
 * @author Eloísa Bazzanella e Maria Eduarda Buzana
 */
class ViewTelaPrincipal extends ViewPadrao {
    
    protected function getConteudo() {
        switch ($_SESSION['tipo']) {
            case 1: {
                return '
                    <div class="container">
                        <div class="caixa-tela-principal">
                            <div class="caixinha">
                                <a class="texto-caixinha" href="index.php?pg=consultaAluno">
                                    <img src="../images/aluno.png" height="70px"><br>
                                    Consultar Alunos
                                </a>
                            </div>
                            <div class="caixinha">
                                <a class="texto-caixinha" href="index.php?pg=consultaProfessor">
                                    <img src="../images/professor.png" height="70px"><br>
                                    Consultar Professores
                                </a>
                            </div>
                            <div class="caixinha">
                                <a class="texto-caixinha" href="index.php?pg=consultaTurma">
                                    <img src="../images/turma.png" height="70px"><br>
                                    Consultar Turmas
                                </a>
                            </div>
                            <div class="caixinha"></div>
                        </div>
                        <div class="caixa-tela-principal">
                            <div class="caixinha">
                                <a class="texto-caixinha" href="index.php?pg=consultaAviso">
                                    <img src="../images/aviso.png" height="70px"><br>
                                    Mural de Avisos
                                </a>
                            </div>
                            <div class="caixinha"></div>
                            <div class="caixinha"></div>                
                            <div class="caixinha"></div>                
                        </div>
                    </div>
                  ';
            }
            
            case 2: {
                return '
                    <div class="container">
                        <div class="caixa-tela-principal">
                            <div class="caixinha">
                                <a class="texto-caixinha" href="index.php?pg=consultaPresenca">
                                    <img src="../images/presenca.png" height="70px"><br>
                                    Registro Presença
                                </a>
                            </div>
                            <div class="caixinha">
                                <a class="texto-caixinha" href="index.php?pg=consultaNota">
                                    <img src="../images/nota.png" height="70px"><br>
                                    Notas
                                </a>
                            </div>
                            <div class="caixinha">
                                <a class="texto-caixinha" href="index.php?pg=consultaTurma">
                                    <img src="../images/disciplinaturma.png" height="70px"><br>
                                    Turmas x Disciplinas
                                </a>
                            </div>
                            <div class="caixinha">
                                <a class="texto-caixinha" href="index.php?pg=consultaAula">
                                    <img src="../images/aula.png" height="70px"><br>
                                    Consultar Aulas
                                </a>
                            </div>
                        </div>
                        <div class="caixa-tela-principal">
                            <div class="caixinha">
                                <a class="texto-caixinha" href="index.php?pg=consultaTurma">
                                    <img src="../images/turma.png" height="70px"><br>
                                    Consultar Turmas
                                </a>
                            </div>
                            <div class="caixinha">
                                <a class="texto-caixinha" href="index.php?pg=consultaAviso">
                                    <img src="../images/aviso.png" height="70px"><br>
                                    Mural de Avisos
                                </a>
                            </div>
                            <div class="caixinha"></div>                
                            <div class="caixinha"></div>                
                        </div>
                    </div>
                  ';
             
            }
            
            case 3: {
                return '
                    <div class="container">
                        <div class="caixa-tela-principal">
                            <div class="caixinha">
                                <a class="texto-caixinha" href="index.php?pg=consultaAviso">
                                    <img src="../images/aviso.png" height="70px"><br>
                                    Mural de Avisos
                                </a>
                            </div>
                            <div class="caixinha">
                                <a class="texto-caixinha" href="index.php?pg=consultaNota">
                                    <img src="../images/nota.png" height="70px"><br>
                                    Notas
                                </a>
                            </div>
                            <div class="caixinha">
                                <a class="texto-caixinha" href="index.php?pg=consultaPresenca">
                                    <img src="../images/presenca.png" height="70px"><br>
                                    Presenças
                                </a>
                            </div>
                            <div class="caixinha">
                                <a class="texto-caixinha" href="index.php?pg=consultaAula">
                                    <img src="../images/aula.png" height="70px"><br>
                                    Consultar Aulas
                                </a>
                            </div>
                        </div>
                        <div class="caixa-tela-principal">
                            <div class="caixinha"></div>
                            <div class="caixinha"></div>
                            <div class="caixinha"></div>                
                            <div class="caixinha"></div>                
                        </div>
                    </div>
                  ';
            }
        }
        
    }
    
}
