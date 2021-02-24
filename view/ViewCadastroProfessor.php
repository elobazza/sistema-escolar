<?php
/**
 * @author Eloisa Bazzanella e Maria Eduarda Buzana
 */
class ViewCadastroProfessor extends ViewPadrao {
    
    private $professores;
    private $professor;
    
    function getProfessor() {
        return $this->professor;
    }

    function setProfessor($professor) {
        $this->professor = $professor;
    }

        
    function getProfessores() {
        return $this->professores;
    }

    function setProfessores($professores) {
        $this->professores = $professores;
    }

    function getConteudoCadastrar(){
        return '<div id="cadastro">
            <form id="form" action="index.php?pg=professor&acao=insere" method="POST">
                    <div class="container">
                        <label class="titulo-formulario">CADASTRO DE PROFESSOR</label>
                        <input class="campo" type="text" name="nome" placeholder="Nome" id="nome" maxlength="50">
                        <input class="campo" type="text" name="cpf" placeholder="CPF" id="cpf" maxlength="14">
                        <input class="campo" type="text" name="data_nascimento" placeholder="Data de Nascimento" id="data_nascimento" maxlength="10">
                        <input class="campo" type="text" name="contato" placeholder="Contato" id="contato" maxlength="30">
                        <input class="campo" type="text" name="especialidade" placeholder="Especialidade" id="especialidade" maxlength="30">
                        <input class="campo" type="text" name="salario" placeholder="Salario" id="salario" maxlength="30">
                        <input class="campo" type="text" name="login" placeholder="Login" id="login" maxlength="30">
                        <input class="campo" type="password" name="senha" placeholder="Senha" id="senha" maxlength="30">
                    
                        <div id="limpar" onclick="limpar()">Limpar</div>
                        <input type="submit" class="cadastrar" id="cadastrar-professor" value="Cadastrar">                    
                        <input type="submit" class="cadastrar-peq" id="cadastrar-professor" value="Cadastrar">
                    </div>
                </form>
             </div>'
         ;
    } 
    
    protected function getConteudoAlterar() {
        return '<div id="cadastro">
            <form id="form" action="index.php?pg=professor&acao=altera&efetiva=1" method="POST">
                    <div class="container"> 
                        <label class="titulo-formulario">ALTERAR PROFESSOR</label> 
                    
                        <input class="campo" name="codigo" type="hidden" id="codigo" value="'.$this->professor->getUsuario()->getCodigo() .'">
                        <input class="campo" name="nome" type="text" id="nome" maxlength="50" value="'.$this->professor->getNome().'" >
                        <input class="campo" name="cpf" type="text" id="cpf" maxlength="14" value="'.$this->professor->getCpf().'">
                        <input class="campo" name="contato" type="text" id="contato"  maxlength="30" value="'.$this->professor->getContato().'">
                        <input class="campo" name="data_nascimento" type="text" id="data_nascimento"  maxlength="30" value="'.$this->professor->getDataNascimento().'">
                        <input class="campo" type="text" name="especialidade" id="especialidade" maxlength="30" value="'.$this->professor->getEspecialidade().'">
                        <input class="campo" type="text" name="salario" id="salario" maxlength="30" value="'.$this->professor->getSalario().'">

                        <div id="limpar" onclick="limpar()">Limpar</div>
                        <input type="submit" class="cadastrar" id="alterar-professor" value="Alterar">                    
                        <input type="submit" class="cadastrar-peq" id="alterar-professor" value="Alterar">
                    </div>
                </form>
             </div>';
    }
}
