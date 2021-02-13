<?php
/**
 * @author Eloisa Bazzanella e Maria Eduarda Buzana
 */
class ViewCadastroAula extends ViewPadrao{
    private $aulas = [];
    private $aula;
    
    function getAula() {
        return $this->aula;
    }

    function setAula($aula) {
        $this->aula = $aula;
    }

    function getAulas() {
        return $this->aulas;
    }

    function setAulas(array $aulas) {
        $this->aulas = $aulas;
    }
    
    protected function getConteudoCadastrar() {
         return '<form action="index.php?pg=aula&acao=insere" method="POST">
                <div class="container">
                   <label class="desc-formulario">Hora de Início</label>
                   <input class="campo" type="time" name="horarioInicio" id="horarioInicio" >
                   <label class="desc-formulario">Hora de Término</label>
                   <input class="campo" type="time" name="horarioFim" id="horarioFim" >

                   <div id="limpar" onclick="limpar()">Limpar</div>
                   <input type="submit" value="Cadastrar" class="cadastrar" id="cadastrar-aula">
                   <input type="submit" value="Cadastrar" class="cadastrar-peq" id="cadastrar-aula">
               </div>
               </form>
               <div class="container">
               <form action="index.php?pg=aula" method="POST">
                <select name="indice" id="indice" class="selecao-filtro">

                '.$this->buscaIndice().'  

                </select>
                <input type="text" name="valor" class="selecao-valor">
                <input type="submit" value="Filtrar" class="enviar-filtro">
             </form>
             </div>
               '.$this->montaTabela().'
         
        ';
         
     }
        
    protected function getConteudoAlterar(){
        return '<form action="index.php?pg=aula&acao=altera&efetiva=1" method="POST">
                <div class="container">
                  <label class="desc-formulario">Código</label>
                   <input class="campo" name="codigo" type="text" id="codigo-aula" value="'.$this->aula->getCodigo().'" readonly>
                   <label class="desc-formulario">Hora de Início</label>
                   <input class="campo" type="time" name="horarioInicio" id="horarioInicio" value="'.$this->aula->getHorarioInicio().'">
                   <label class="desc-formulario">Hora de Tírmino</label>
                   <input class="campo" type="time" name="horarioFim" id="horarioFim" value="'.$this->aula->getHorarioFim().'">

                   <div id="limpar" onclick="limpar()">Limpar</div>
                   <input type="submit" value="Alterar" class="cadastrar" id="alterar-aula">
                   <input type="submit" value="Alterar" class="cadastrar-peq" id="alterar-aula">

               </div>
                </form> ';
    }
}
