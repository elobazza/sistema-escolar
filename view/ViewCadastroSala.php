<?php


class ViewCadastroSala extends ViewPadrao{
    private $escolas;
    private $sala;
    private $salas;
    
    function getSalas() {
        return $this->salas;
    }

    function setSalas($salas) {
        $this->salas = $salas;
    }

        
    function getSala() {
        return $this->sala;
    }

    function setSala($sala) {
        $this->sala = $sala;
    }

        function getEscolas() {
        return $this->escolas;
    }

    function setEscolas($escolas) {
        $this->escolas = $escolas;
    }


    protected function getConteudoCadastrar(){
        return '<form action="index.php?pg=sala&acao=insere" method="POST">
            <div class="container">
                <label class="desc-formulario">Descrição da Sala</label>
                <input class="campo" type="text" name="descricao" id="descricao-sala" maxlength="10">

                <label class="desc-formulario">Escola</label>
                
                '.$this->createSelectCadastro().'
               

                <button class="limpar" id="limpar-sala">
                                Limpar
                </button>
                <input type="submit" value="Cadastrar" class="cadastrar" id="cadastrar-sala">

                <input type="submit" value="Cadastrar" class="cadastrar-peq" id="cadastrar-sala">


            </div>
        </form>
            <div class="container">
            <form action="index.php?pg=sala" method="POST">
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
        return '<form action="index.php?pg=sala&acao=altera&efetiva=1" method="POST">
            <div class="container">
                <label class="desc-formulario">Código</label>
                <input class="campo" name="codigo" type="text" id="codigo-aluno" value="'.$this->sala->getCodigo().'" readonly >
                        
                <label class="desc-formulario">Descrição da Sala</label>
                <input class="campo" type="text" name="descricao" id="descricao-sala" maxlength="10" value="'.$this->sala->getDescricao().'">

                <label class="desc-formulario">Escola</label>
                
                '.$this->createSelect().'
               

                <button class="limpar" id="limpar-sala">
                                Limpar
                </button>
                <input type="submit" value="Cadastrar" class="cadastrar" id="cadastrar-sala">

                <input type="submit" value="Cadastrar" class="cadastrar-peq" id="cadastrar-sala">


            </div>
        </form>
            <div class="container">
            <form action="index.php?pg=sala" method="POST">
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
                        <th>Descrição</th>
                        <th>Escola</th>
                        <th>Ações</th>
                    </tr>
                    '.$this->createSelectListagem().'
                </table>';
    }
    
    private function createSelectListagem() {
        $sResult = "";
        
        foreach ($this->getSalas() as $oSala) { 
            $sResult .= ' <tr>
                            <td>' . $oSala->getCodigo() . '</td>
                            <td>' . $oSala->getDescricao() . '</td>
                            
                            <td>' . $oSala->getEscola()->getNome() . '</td>
                            <td><a href="index.php?pg=sala&acao=altera&codigo='.$oSala->getCodigo().'&efetiva=0"><img src="../images/edit.png" width="20px"></a>
                            <a href="index.php?pg=sala&acao=exclui&codigo='.$oSala->getCodigo().'"><img src="../images/garbage-2.png" width="20px"></a></td>
                          </tr>';
        }
        return $sResult;
    }
    
    private function createSelectCadastro() {
        $aSelect = [];
        
        foreach ($this->escolas as $oEscola) {
            if($oEscola->getCodigo() == $_SESSION['id']){
                $aSelect[] = '<option value="' . $oEscola->getCodigo() . '" selected >' . $oEscola->getNome() . '</option>';
            } else {
          
            }
        }
        //PHP_EOL � o </br> do PHP
        return '<select class="selecao" name="escola" id="escola-sala">
                '. implode(PHP_EOL, $aSelect).'
                </select>';
    }
    
    private function createSelect() {
        $aSelect = [];
        
        foreach ($this->escolas as $oEscola) {
            if($oEscola->getCodigo() == $_SESSION['id']){
                $aSelect[] = '<option value="' . $oEscola->getCodigo() . '" selected>' . $oEscola->getNome() . '</option>';
            } else {
          
            }
            
       }
        //PHP_EOL � o </br> do PHP
        return '<select class="selecao" name="escola" id="escola-sala">
                '. implode(PHP_EOL, $aSelect).'
                </select>';
    }
    
    public function buscaIndice() {
        $aFiltros = ['salcodigo', 'saldescricao', 'escnome'];
        $aValores = ['ID', 'Descrição', 'Escola'];
        $sOpcoes = "";
        for ($i = 0; $i < sizeof($aValores); $i++) {
            $sOpcoes .= '<option value="' . $aFiltros[$i] . '">'. $aValores[$i].'</option>';
        }
        return $sOpcoes;
    }
}
