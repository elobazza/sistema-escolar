<?php

class ViewCadastroAluno extends ViewPadrao {
    
    private $turmas;
    private $alunos = [];
    private $aluno;
    
    function getAluno() {
        return $this->aluno;
    }

    function setAluno($aluno) {
        $this->aluno = $aluno;
    }

         
    function getAlunos() {
        return $this->alunos;
    }

    function setAlunos(array $alunos) {
        $this->alunos = $alunos;
    }
                   
    function getTurmas() {
        return $this->turmas;
    }

    function setTurmas($turmas) {
        $this->turmas = $turmas;
    }
   
    protected function getConteudoCadastrar() {
        return '<div id="cadastro">
            <form id="form" action="index.php?pg=aluno&acao=insere" method="POST">
                    <div class="container">
                        <input class="campo" name="codigo" type="hidden" id="codigo-aluno" >
                        <label class="desc-formulario">Nome do Aluno</label>
                        <input class="campo" name="nome" type="text" id="nome-aluno" maxlength="50" >
                        <label class="desc-formulario">CPF</label>
                        <input class="campo" name="cpf" type="text" id="cpf-aluno" maxlength="14">
                        <label class="desc-formulario">Contato</label>
                        <input class="campo" name="contato" type="text" id="contato-aluno"  maxlength="30">
                        <label class="desc-formulario">Turma</label>
                        '.$this->createSelectCadastro().'
                        <button class="limpar" id="limpar-aluno">
                            Limpar
                        </button>
                        <input type="submit" class="cadastrar" id="cadastrar-aluno" value="Cadastrar">                    
                        <input type="submit" class="cadastrar-peq" id="cadastrar-aluno" value="Cadastrar">
                    </div>
                </form>
             </div>
             <div class="container">
            <form action="index.php?pg=aluno" method="POST">
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
    
    protected function getConteudoAlterar() {
        return '<div id="cadastro">
            <form id="form" action="index.php?pg=aluno&acao=altera&efetiva=1" method="POST">
                    <div class="container">
                        <label class="desc-formulario">Código</label>
                        <input class="campo" name="codigo" type="text" id="codigo-aluno" value="'.$this->aluno->getCodigo().'" readonly>
                
                        <label class="desc-formulario">Nome</label>
                        <input class="campo" name="nome" type="text" id="nome-aluno" maxlength="50" value="'.$this->aluno->getNome().'" >
                        <label class="desc-formulario">CPF</label>
                        <input class="campo" name="cpf" type="text" id="cpf-aluno" maxlength="14" value="'.$this->aluno->getCpf().'">
                        <label class="desc-formulario">Contato</label>
                        <input class="campo" name="contato" type="text" id="contato-aluno"  maxlength="30" value="'.$this->aluno->getContato().'">
                        <label class="desc-formulario">Turma</label>
                        '.$this->createSelect().'
                        <button class="limpar" id="limpar-aluno">
                            Limpar
                        </button>
                        <input type="submit" class="cadastrar" id="alterar-aluno" value="Alterar">                    
                        <input type="submit" class="cadastrar-peq" id="alterar-aluno" value="Alterar">
                    </div>
                </form>
             </div>
             
            <div class="container">
                <form action="index.php?pg=aluno" method="POST">
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
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Contato</th>
                        <th>Turma</th>
                        <th>Ações</th>
                    </tr>
                    '.$this->createSelectListagem().'
                </table>';
    }
    
    private function createSelectListagem() {
        $sResult = "";
        
        foreach ($this->alunos as $oAluno) { 
            $sResult .= ' <tr>
                            <td>' . $oAluno->getCodigo() . '</td>
                            <td>' . $oAluno->getNome() . '</td>
                            <td>' . $oAluno->getCpf() . '</td>
                            <td>' . $oAluno->getContato() . '</td>
                            <td>' . $oAluno->getTurma()->getNome() . '</td>
                            <td><a href="index.php?pg=aluno&acao=altera&codigo='.$oAluno->getCodigo().'&efetiva=0"><img src="../images/edit.png" width="20px"></a>
                            <a href="index.php?pg=aluno&acao=exclui&codigo='.$oAluno->getCodigo().'"><img src="../images/garbage-2.png" style="cursor: pointer; width: 20px"></a></td>
                          </tr>';
        }
        return $sResult;
    }
    private function createSelectCadastro() {
        $aSelect = [];
        
        foreach ($this->turmas as $oTurma) {
                $aSelect[] = '<option value="' . $oTurma->getCodigo() . '">' . $oTurma->getNome() . '</option>';
        }
        //PHP_EOL � o </br> do PHP
        return '<select class="selecao" name="turma" id="turma-aluno">
                '. implode(PHP_EOL, $aSelect).'
                </select>';
    }
    
    private function createSelect() {
        $aSelect = [];
        
        foreach ($this->turmas as $oTurma) {
            if($this->aluno->getTurma()->getCodigo() == $oTurma->getCodigo()){
                $aSelect[] = '<option value="' . $oTurma->getCodigo() . '" selected>' . $oTurma->getNome() . '</option>';
            } else {
                $aSelect[] = '<option value="' . $oTurma->getCodigo() . '">' . $oTurma->getNome() . '</option>';
            }
        }
        //PHP_EOL � o </br> do PHP
        return '<select class="selecao" name="turma" id="turma-aluno">
                '. implode(PHP_EOL, $aSelect).'
                </select>';
    }
    
    public function buscaIndice() {
        $aFiltros = ['alucodigo', 'alunome', 'alucpf', 'alucontato', 'turnome'];
        $aValores = ['ID', 'Nome', 'CPF', 'Contato', 'Turma'];
        $sOpcoes = "";
        for ($i = 0; $i < sizeof($aValores); $i++) {
            $sOpcoes .= '<option value="' . $aFiltros[$i] . '">'. $aValores[$i].'</option>';
        }
        return $sOpcoes;
    }
}