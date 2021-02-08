<?php


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
                <label class="desc-formulario">Código</label>
                <input class="campo" name="codigo" type="text" id="codigo-disciplina" value="'.$this->disciplina->getCodigo().'" readonly>
                <label class="desc-formulario">Nome da Disciplina</label>
                <input class="campo" name="nome" type="text" id="nome-disciplina" maxlength="50" value="'.$this->disciplina->getNome().'">

                <label class="desc-formulario">Créditos</label>
                <input class="campo"  name="credito" type="number" id="credito-disciplina" max="20" value="'.$this->disciplina->getCredito().'">

                <button class="limpar" id="limpar-disciplina">
                    Limpar
                </button>
                <input type="submit" class="cadastrar" id="alterar-disciplina" value="Alterar">

                <input type="submit" class="cadastrar-peq" id="alterar-disciplina" value="Alterar">

            </div></form> ';
    }
}
