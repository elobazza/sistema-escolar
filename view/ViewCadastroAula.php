<?php

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

                   <button class="limpar" id="limpar-aula">
                                   Limpar
                   </button>
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

                   <button class="limpar" id="limpar-aula">
                                   Limpar
                   </button>
                   <input type="submit" value="Alterar" class="cadastrar" id="alterar-aula">

                   <input type="submit" value="Alterar" class="cadastrar-peq" id="alterar-aula">


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
    
     
    public function montaTabela(){
        return '<table class="table_listagem" style="clear:both">
                    <tr>
                        <th>ID</th>
                        <th>Início</th>
                        <th>Fim</th>                     
                        <th>Ações</th>
                    </tr>
                    '.$this->createSelectListagem().'
                </table>';
    }
    
    private function createSelectListagem() {
        $sResult = "";

        foreach ($this->getAulas() as $oAula) { 
            $sResult .= ' <tr>
                            <td>' . $oAula->getCodigo() . '</td>
                            <td>' . $oAula->getHorarioInicio() . '</td>
                            <td>' . $oAula->getHorarioFim() . '</td>
                            <td><a href="index.php?pg=aula&acao=altera&codigo='.$oAula->getCodigo().'&efetiva=0"><img src="../images/edit.png" width="20px"></a>
                            <a href="index.php?pg=aula&acao=exclui&codigo='.$oAula->getCodigo().'"><img src="../images/garbage-2.png"  style="cursor: pointer; width: 20px"></a></td>
                          </tr>';
        }
        return $sResult;
    }
    
    public function buscaIndice() {
        $aFiltros = ['aulcodigo', 'aulhorarioinicio', 'aulhorariofim'];
        $aValores = ['ID', 'Horário Início', 'Horário Fim'];
        $sOpcoes = "";
        for ($i = 0; $i < sizeof($aValores); $i++) {
            $sOpcoes .= '<option value="' . $aFiltros[$i] . '">'. $aValores[$i].'</option>';
        }
        return $sOpcoes;
    }
}
