<?php
/**
 * @author Eloisa Bazzanella e Maria Eduarda Buzana
 */
class ViewCadastroDisciplina extends ViewPadrao{
    private $disciplinas = [];
    private $disciplina;
    
    function getDisciplina() {
        return $this->disciplina;
    }

    function setDisciplina($disciplina) {
        $this->disciplina = $disciplina;
    }

    function getDisciplinas() {
        return $this->disciplinas;
    }

    function setDisciplinas($disciplinas) {
        $this->disciplinas = $disciplinas;
    }        
    
    protected function getConteudoCadastrar(){
//       if(!isset($_SESSION['id'])){
            return 
            '<form action="index.php?pg=disciplina&acao=insere" method="POST">
                <div class="container" style="height: 455px; margin-top:25px">
                    <label class="titulo-formulario">CADASTRO DE DISCIPLINAS</label>
                    <input class="campo" type="text" name="nome" placeholder="Nome" id="nome" maxlength="50">
                    <input class="campo" type="text" name="carga_horaria" placeholder="Carga Horária" id="carga_horaria" maxlength="32">
                    
                    <div id="limpar" onclick="limpar()">Limpar</div>
                    <input type="submit" value="Cadastrar" class="cadastrar" id="cadastrar-disciplina">
                    <input type="submit" value="Cadastrar" class="cadastrar-peq" id="cadastrar-disciplina">
                </div>
            </form>';
//        } else {
//            return $this->getConteudoAlterar();
//        }
    }
    
    protected function getConteudoAlterar() {
        return '<form action="index.php?pg=disciplina&acao=altera&efetiva=1" method="POST">
            <div class="container">
                <label class="titulo-formulario">ALTERAR DISCIPLINA</label>
                <input class="campo" name="codigo" type="hidden" id="codigo" value="'.$this->disciplina->getCodigo() .'">
                <input class="campo" name="nome" type="text" id="nome" maxlength="50" value="'.$this->disciplina->getNome().'">
                <input class="campo"  name="carga_horaria" type="number" id="carga_horaria" value="'.$this->disciplina->getCargaHoraria().'">

                <div id="limpar" onclick="limpar()">Limpar</div>
                <input type="submit" class="cadastrar" id="alterar-disciplina" value="Alterar">
                <input type="submit" class="cadastrar-peq" id="alterar-disciplina" value="Alterar">

            </div></form> ';
    }
}
