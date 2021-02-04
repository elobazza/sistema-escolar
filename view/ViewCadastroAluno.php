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
                        <label class="titulo-formulario">CADASTRO DE ALUNO</label>
                        <input class="campo" name="codigo" type="hidden" id="codigo-aluno" >
                        <input class="campo" type="text" name="nome" placeholder="Nome" id="nome" maxlength="50">
                        <input class="campo" type="text" name="matricula" placeholder="Matrícula" id="matricula" maxlength="50">
                        <input class="campo" type="text" name="cpf" placeholder="CPF" id="cpf" maxlength="14">
                        <input class="campo" type="text" name="contato" placeholder="Contato" id="contato" maxlength="30">
                        <input class="campo" type="text" name="data_nascimento" placeholder="Data de Nascimento" id="data_nascimento" maxlength="10">
                        <input class="campo" type="text" name="login" placeholder="Login" id="login" maxlength="30">
                        <input class="campo" type="password" name="senha" placeholder="Senha" id="senha" maxlength="30">
                    
                        <label class="label-select">Turma</label>
                        '.$this->createSelectCadastro().'
                        <button class="limpar" id="limpar-aluno">
                            Limpar
                        </button>
                        <input type="submit" class="cadastrar" id="cadastrar-aluno" value="Cadastrar">                    
                        <input type="submit" class="cadastrar-peq" id="cadastrar-aluno" value="Cadastrar">
                    </div>
                </form>
             </div>';
    }
    
    protected function getConteudoAlterar() {
        return '<div id="cadastro">
            <form id="form" action="index.php?pg=aluno&acao=altera&efetiva=1" method="POST">
                    <div class="container">
                        <label class="desc-formulario">Código</label>
                        <input class="campo" name="id_pessoa" type="text" id="codigo-aluno" value="'.$this->aluno->getCodigo().'" readonly>
                
                        <label class="desc-formulario">Nome</label>
                        <input class="campo" name="nome" type="text" id="nome-aluno" maxlength="50" value="'.$this->aluno->getNome().'" >
                        <label class="desc-formulario">CPF</label>
                        <input class="campo" name="cpf" type="text" id="cpf-aluno" maxlength="14" value="'.$this->aluno->getCpf().'">
                        <label class="desc-formulario">Contato</label>
                        <input class="campo" name="contato" type="text" id="contato-aluno"  maxlength="30" value="'.$this->aluno->getContato().'">
                        <label class="desc-formulario">Data de Nascimento</label>
                        <input class="campo" name="data_nascimento" type="text" id="data-nascimento-aluno"  maxlength="30" value="'.$this->aluno->getData_nascimento().'">
                        <label class="desc-formulario">Login</label>
                        <input class="campo" name="login" type="text" id="login-aluno"  maxlength="30" value="'.$this->aluno->getUsuario()->getLogin().'">
                        <label class="desc-formulario">Senha</label>
                        <input class="campo" name="senha" type="text" id="senha-aluno"  maxlength="30" value="'.$this->aluno->getUsuario()->getSenha().'">
                        <label class="desc-formulario">Turma</label>
                        '.$this->createSelect().'
                        <button class="limpar" id="limpar-aluno">
                            Limpar
                        </button>
                        <input type="submit" class="cadastrar" id="alterar-aluno" value="Alterar">                    
                        <input type="submit" class="cadastrar-peq" id="alterar-aluno" value="Alterar">
                    </div>
                </form>
             </div>';
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
    
}