<?php
/**
 * @author Eloisa Bazzanella e Maria Eduarda Buzana
 */
class ViewCadastroNota extends ViewPadrao {
    private $disciplinas;
    private $alunos;
 
    private $nota;
    private $notas;
    
    function getNotas() {
        return $this->notas;
    }

    function setNotas($notas) {
        $this->notas = $notas;
    }

    function getNota() {
        return $this->nota;
    }

    function setNota($nota) {
        $this->nota = $nota;
    }
            
    function getDisciplinas() {
        return $this->disciplinas;
    }

    function getAlunos() {
        return $this->alunos;
    }

    function setDisciplinas($disciplinas) {
        $this->disciplinas = $disciplinas;
    }

    function setAlunos($alunos) {
        $this->alunos = $alunos;
    }

    function getConteudoCadastrar(){
        return '<form action="index.php?pg=nota&acao=insere" method="POST">
                    <div class="container">
			<label class="desc-formulario">Disciplina</label>
			'.$this->createSelectCadastro().'
                        <label class="desc-formulario">Aluno</label>
                        
                            '.$this->createSelectDoisCadastro().'
                        <label class="desc-formulario">Nota</label>
                        <input class="campo" type="text" name="nota" id="nota" maxlength="3">
                        

                        <div id="limpar" onclick="limpar()">Limpar</div>
                        <input type="submit" class="cadastrar" id="cadastrar-aluno" value="Cadastrar">                    
                        <input type="submit" class="cadastrar-peq" id="cadastrar-aluno" value="Cadastrar">
		</div>
                
           </form>';
    }
    function getConteudoAlterar(){
        return '<form action="index.php?pg=nota&acao=altera&efetiva=1" method="POST">
                    <div class="container">
                        <label class="desc-formulario">Código</label>
                        <input class="campo" name="codigo" type="text" id="codigo-nota" value="'.$this->nota->getCodigo().'" readonly>
                
			<label class="desc-formulario">Disciplina</label>
			'.$this->createSelect().'
                        <label class="desc-formulario">Aluno</label>
                        
                            '.$this->createSelectDois().'
                        <label class="desc-formulario"   >Nota</label>
                        <input class="campo" type="text" name="nota" id="nota" maxlength="3" value="'.$this->nota->getNota().'">
                        

                        <div id="limpar" onclick="limpar()">Limpar</div>
                        <input type="submit" class="cadastrar" id="cadastrar-aluno" value="Alterar">                    
                        <input type="submit" class="cadastrar-peq" id="cadastrar-aluno" value="Alterar">
		</div>
                
           </form>';
    }
        
    private function createSelect() {
        $aSelect = [];
        
        foreach ($this->disciplinas as $oDisciplina) {
            if($this->nota->getDisciplina()->getCodigo() == $oDisciplina->getCodigo()){
                $aSelect[] = '<option value="' . $oDisciplina->getCodigo() . '" selected>' . $oDisciplina->getNome() . '</option>';
            } else {
                $aSelect[] = '<option value="' . $oDisciplina->getCodigo() . '">' . $oDisciplina->getNome() . '</option>';
            }
        }
        //PHP_EOL � o </br> do PHP
        return '<select class="selecao" name="disciplina" id="disciplina-nota">
                '. implode(PHP_EOL, $aSelect).'
                </select>';
    }
    
    private function createSelectDois() {
        $aSelect = [];
        
        foreach ($this->alunos as $oAluno) {
             if($this->nota->getAluno()->getCodigo() == $oAluno->getCodigo()){
                $aSelect[] = '<option value="' . $oAluno->getCodigo() . '" selected>' . $oAluno->getNome() . '</option>';
             } else {
                 $aSelect[] = '<option value="' . $oAluno->getCodigo() . '">' . $oAluno->getNome() . '</option>';
             }
        }
        //PHP_EOL � o </br> do PHP
        return '<select id="Aluno" class="selecao" name="aluno" id="aluno-nota">
                '. implode(PHP_EOL, $aSelect).'
                </select>
                
                ' ;
    }
    private function createSelectCadastro() {
        $aSelect = [];
        
        foreach ($this->disciplinas as $oDisciplina) {
            $aSelect[] = '<option value="' . $oDisciplina->getCodigo() . '">' . $oDisciplina->getNome() . '</option>';
        }
        //PHP_EOL � o </br> do PHP
        return '<select class="selecao" name="disciplina" id="disciplina-nota">
                '. implode(PHP_EOL, $aSelect).'
                </select>';
    }
    
    private function createSelectDoisCadastro() {
        $aSelect = [];
        
        foreach ($this->alunos as $oAluno) {
            $aSelect[] = '<option value="' . $oAluno->getCodigo() . '">' . $oAluno->getNome() . '</option>';
        }
        //PHP_EOL � o </br> do PHP
        return '<select id="Aluno" class="selecao" name="aluno" id="aluno-nota">
                '. implode(PHP_EOL, $aSelect).'
                </select>
                
                ' ;
    }
}
