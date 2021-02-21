<?php
/**
 * 
 * @author mduda
 */
class ViewCadastroDisciplinaProfessorTurma extends ViewPadrao {
    
    private $disciplinas;
    private $turmas;
    private $professores;
    private $discProfTurmas = [];
    private $discProfTurma;
    
    function getDiscProfTurmas() {
        return $this->discProfTurmas;
    }

    function getDiscProfTurma() {
        return $this->discProfTurma;
    }

    function setDiscProfTurmas($discProfTurmas) {
        $this->discProfTurmas = $discProfTurmas;
    }

    function setDiscProfTurma($discProfTurma) {
        $this->discProfTurma = $discProfTurma;
    }

        
    function getDisciplinas() {
        return $this->disciplinas;
    }

    function getProfessores() {
        return $this->professores;
    }

    function setDisciplinas($disciplinas) {
        $this->disciplinas = $disciplinas;
    }

    function setProfessores($professores) {
        $this->professores = $professores;
    }
                   
    function getTurmas() {
        return $this->turmas;
    }

    function setTurmas($turmas) {
        $this->turmas = $turmas;
    }
   
    protected function getConteudoCadastrar() {
        return '<div id="cadastro">
            <form id="form" action="index.php?pg=disciplinaProfessorTurma&acao=insere" method="POST">
                    <div class="container">
                        <label class="titulo-formulario">CADASTRO DISCIPLINA/PROFESSOR/TURMA</label>
                        <input class="campo" name="codigo" type="hidden" id="codigo-discProfTurma" >                    
                        <label class="label-select">Disciplina</label>
                        '.$this->createSelectDisciplina().'
                        <label class="label-select">Professor</label>
                        '.$this->createSelectProfessor().'
                        <label class="label-select">Turma</label>
                        '.$this->createSelectTurma().'
                            
                        <div id="limpar" onclick="limpar()">Limpar</div>
                        <input type="submit" class="cadastrar" id="cadastrar-discProfTurma" value="Cadastrar">                    
                        <input type="submit" class="cadastrar-peq" id="cadastrar-discProfTurma" value="Cadastrar">
                    </div>
                </form>
             </div>';
    }
    
    protected function getConteudoAlterar() {
        return '<div id="cadastro">
            <form id="form" action="index.php?pg=disciplinaProfessorTurma&acao=altera&efetiva=1" method="POST">
                    <div class="container">
                        <label class="titulo-formulario">ALTERAR DISCIPLINA/PROFESSOR/TURMA</label>
                        <input class="campo" name="codigo" type="hidden" id="codigo-discProfTurma" value="'.$this->discProfTurma->getCodigo() .'">
                        <label class="label-select">Disciplina</label>
                        '.$this->createSelectAlteracaoDisciplina().'                            
                        <label class="label-select">Professor</label>
                        '.$this->createSelectAlteracaoProfessor().'                            
                        <label class="label-select">Turma</label>
                        '.$this->createSelectAlteracaoTurma().'                            
                        <div id="limpar" onclick="limpar()">Limpar</div>
                        <input type="submit" class="cadastrar" id="alterar-discProfTurma" value="Alterar">                    
                        <input type="submit" class="cadastrar-peq" id="alterar-discProfTurma" value="Alterar">
                    </div>
                </form>
             </div>';
    }
    
    private function createSelectTurma() {
        $aSelect = [];        
        foreach ($this->turmas as $oTurma) {
                $aSelect[] = '<option value="' . $oTurma->getCodigo() . '">' . $oTurma->getNome() . '</option>';
        }
        return '<select class="selecao" name="turma" id="turma">
                '. implode(PHP_EOL, $aSelect).'
                </select>';
    }
    
    private function createSelectDisciplina() {
        $aSelect = [];        
        foreach ($this->disciplinas as $oDisciplina) {
                $aSelect[] = '<option value="' . $oDisciplina->getCodigo() . '">' . $oDisciplina->getNome() . '</option>';
        }
        return '<select class="selecao" name="disciplina" id="disciplina">
                '. implode(PHP_EOL, $aSelect).'
                </select>';
    }
    
    private function createSelectProfessor() {
        $aSelect = [];        
        foreach ($this->professores as $oProfessor) {
                $aSelect[] = '<option value="' . $oProfessor->getUsuario()->getCodigo() . '">' . $oProfessor->getNome() . '</option>';
        }
        return '<select class="selecao" name="professor" id="professor">
                '. implode(PHP_EOL, $aSelect).'
                </select>';
    }
    
    private function createSelectAlteracaoTurma() {
        $aSelect = [];
        
        foreach ($this->turmas as $oTurma) {
            if($this->discProfTurma->getTurma()->getCodigo() == $oTurma->getCodigo()){
                $aSelect[] = '<option value="' . $oTurma->getCodigo() . '" selected>' . $oTurma->getNome() . '</option>';
            } else {
                $aSelect[] = '<option value="' . $oTurma->getCodigo() . '">' . $oTurma->getNome() . '</option>';
            }
        }
        return '<select class="selecao" name="turma" id="turma">
                '. implode(PHP_EOL, $aSelect).'
                </select>';
    }
        
    private function createSelectAlteracaoDisciplina() {
        $aSelect = [];
        
        foreach ($this->disciplinas as $oDisciplina) {
            if($this->discProfTurma->getDisciplina()->getCodigo() == $oDisciplina->getCodigo()){
                $aSelect[] = '<option value="' . $oDisciplina->getCodigo() . '" selected>' . $oDisciplina->getNome() . '</option>';
            } else {
                $aSelect[] = '<option value="' . $oDisciplina->getCodigo() . '">' . $oDisciplina->getNome() . '</option>';
            }
        }
        return '<select class="selecao" name="disciplina" id="disciplina">
                '. implode(PHP_EOL, $aSelect).'
                </select>';
    }
    
    private function createSelectAlteracaoProfessor() {
        $aSelect = [];
        
        foreach ($this->professores as $oProfessor) {
            if($this->discProfTurma->getProfessor()->getUsuario()->getCodigo() == $oProfessor->getUsuario()->getCodigo()){
                $aSelect[] = '<option value="' . $oProfessor->getUsuario()->getCodigo() . '" selected>' . $oProfessor->getNome() . '</option>';
            } else {
                $aSelect[] = '<option value="' . $oProfessor->getUsuario()->getCodigo() . '">' . $oProfessor->getNome() . '</option>';
            }
        }
        return '<select class="selecao" name="professor" id="professor">
                '. implode(PHP_EOL, $aSelect).'
                </select>';
    }
    
}