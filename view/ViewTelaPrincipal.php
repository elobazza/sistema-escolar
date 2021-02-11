<?php

/**
 * View da Tela Principal
 *
 * @author Eloísa Bazzanella e Maria Eduarda Buzana
 */
class ViewTelaPrincipal extends ViewPadrao {
    
    protected function getConteudo() {
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
                            <img src="../images/aluno.png" height="70px"><br>
                            Consultar Professores
                        </a>
                    </div>
                    <div class="caixinha"></div>
                    <div class="caixinha"></div>
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
