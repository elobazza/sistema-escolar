<?php
/**
 * @author Eloisa Bazzanella e Maria Eduarda Buzana
 */
class ViewCadastroAula extends ViewPadrao{
    
    private $aulas = [];
    private $aula;
    private $discProfTurmas;
    
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
    
    function getDiscProfTurmas() {
        return $this->discProfTurmas;
    }

    function setDiscProfTurmas($discProfTurmas) {
        $this->discProfTurmas = $discProfTurmas;
    }
    
    protected function getConteudoCadastrar() {
        return '<div id="cadastro">
            <form id="form" action="index.php?pg=aula&acao=insere" method="POST">
                    <div class="container">
                        <label class="titulo-formulario">CADASTRO DE AULA</label>
                        <input class="campo" type="time" name="horarioInicio" placeholder="Horário de Início" id="horarioInicio" >
                        <input class="campo" type="time" name="horarioFim" placeholder="Horário de Término" id="horarioFim" >
                        <label class="label-select">Disciplina/Professor/Turma</label>
                        '.$this->createSelect().'
                        <div id="limpar" onclick="limpar()">Limpar</div>
                        <input type="submit" class="cadastrar" id="cadastrar-aula" value="Cadastrar">                    
                        <input type="submit" class="cadastrar-peq" id="cadastrar-aula" value="Cadastrar">
                    </div>
                </form>
             </div>';         
     }
        
    protected function getConteudoAlterar(){
        return '<div id="cadastro">
            <form id="form" action="index.php?pg=aula&acao=altera&efetiva=1" method="POST">
                    <div class="container">
                        <label class="titulo-formulario">ALTERAR AULA</label>
                        <input class="campo" name="codigo" type="hidden" id="codigo" value="'.$this->aula->getCodigo() .'">
                        <input class="campo" type="time" name="horarioInicio" id="horarioInicio" value="'.$this->aula->getHorarioInicio().'">
                        <input class="campo" type="time" name="horarioFim" id="horarioFim" value="'.$this->aula->getHorarioFim().'">
                        <label class="label-select">Turma</label>
                        '.$this->createSelectAlteracao().'     
                        <div id="limpar" onclick="limpar()">Limpar</div>
                        <input type="submit" class="cadastrar" id="alterar-aula" value="Alterar">                    
                        <input type="submit" class="cadastrar-peq" id="alterar-aula" value="Alterar">
                    </div>
                </form>
             </div>';
    }
    
    private function createSelect() {
        $aSelect = [];        
        foreach ($this->getDiscProfTurmas() as $oDiscProfTur) {
            $aSelect[] = '<option value="' . $oDiscProfTur->getCodigo() . '">' . $oDiscProfTur->getDisciplina()->getNome() .' / '. $oDiscProfTur->getProfessor()->getNome() . ' / ' . $oDiscProfTur->getTurma()->getNome() . '</option>';
        }
        return '<select class="selecao" name="discproftur" id="discproftur">
                '. implode(PHP_EOL, $aSelect).'
                </select>';
    }
    
    private function createSelectAlteracao() {
        $aSelect = [];
        
        foreach ($this->getDiscProfTurmas() as $oDiscProfTur) {
            if($this->aula->getDisciplinaProfessorTurma()->getCodigo() == $oDiscProfTur->getCodigo()){
                $aSelect[] = '<option value="' . $oDiscProfTur->getCodigo() . '" selected>' . $oDiscProfTur->getDisciplina()->getNome() .' / '. $oDiscProfTur->getProfessor()->getNome() . ' / ' . $oDiscProfTur->getTurma()->getNome() . '</option>';
            } else {
                $aSelect[] = '<option value="' . $oDiscProfTur->getCodigo() . '">' . $oDiscProfTur->getDisciplina()->getNome() .' / '. $oDiscProfTur->getProfessor()->getNome() . ' / ' . $oDiscProfTur->getTurma()->getNome() . '</option>';
            }
        }
        return '<select class="selecao" name="discproftur" id="discproftur">
                '. implode(PHP_EOL, $aSelect).'
                </select>';
    }
    
}
