<?php
/**
 * @author Eloisa Bazzanella e Maria Eduarda Buzana
 */
class ViewCadastroTurma extends ViewPadrao{
    
    private $disciplinas;
    private $disciplinasTurma;
    private $turmas;
    private $turma;
    
    function getDisciplinasTurma() {
        return $this->disciplinasTurma;
    }

    function setDisciplinasTurma($disciplinasTurma) {
        $this->disciplinasTurma = $disciplinasTurma;
    }

        function getTurmas() {
        return $this->turmas;
    }

    function getTurma() {
        return $this->turma;
    }

    function setTurmas($turmas) {
        $this->turmas = $turmas;
    }

    function setTurma($turma) {
        $this->turma = $turma;
    }

        function getDisciplinas() {
        return $this->disciplinas;
    }

    function setDisciplinas($disciplinas) {
        $this->disciplinas = $disciplinas;
    }

    function getConteudoCadastrar(){
        return '<div id="cadastro">
            <form id="form" action="index.php?pg=turma&acao=insere" method="POST">
                    <div class="container">
                        <label class="titulo-formulario">CADASTRO DE TURMA</label>
                        <input class="campo" type="text" name="nome" placeholder="Nome" id="nome" maxlength="50">
                    
                        <div id="limpar" onclick="limpar()">Limpar</div>
                        <input type="submit" class="cadastrar" id="cadastrar-turma" value="Cadastrar">                    
                        <input type="submit" class="cadastrar-peq" id="cadastrar-turma" value="Cadastrar">
                    </div>
                </form>
             </div>';
    }
    
    
    function getConteudoAlterar(){
        return '<div id="cadastro">
            <form id="form" action="index.php?pg=turma&acao=altera&efetiva=1" method="POST">
                    <div class="container">
                        <label class="titulo-formulario">ALTERAR TURMA</label>
                        <input class="campo" name="codigo" type="hidden" id="codigo" value="'.$this->turma->getCodigo() .'">
                        <input class="campo" name="nome" type="text" id="nome" maxlength="50" value="'.$this->turma->getNome().'" >
                    
                        <div id="limpar" onclick="limpar()">Limpar</div>
                        <input type="submit" class="cadastrar" id="alterar-turma" value="Alterar">                    
                        <input type="submit" class="cadastrar-peq" id="alterar-turma" value="Alterar">
                    </div>
                </form>
             </div>';
    }
}
