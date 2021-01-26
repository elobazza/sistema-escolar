<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ViewCadastroSalaAula
 *
 * @author eloba
 */
class ViewCadastroSalaAula extends ViewPadrao {
    private $salasaula;
    private $salaaula;
    private $salas;
    private $turmas;
    private $aulas;
    private $professores;
    private $disciplinas;
    private $prodis;
    
    
    function getProdis() {
        return $this->prodis;
    }

    function setProdis($prodis) {
        $this->prodis = $prodis;
    }

        function getSalasaula() {
        return $this->salasaula;
    }

    function getSalaaula() {
        return $this->salaaula;
    }

    function getSalas() {
        return $this->salas;
    }

    function getTurmas() {
        return $this->turmas;
    }

    function getAulas() {
        return $this->aulas;
    }

    function getProfessores() {
        return $this->professores;
    }

    function getDisciplinas() {
        return $this->disciplinas;
    }

    function setSalasaula($salasaula) {
        $this->salasaula = $salasaula;
    }

    function setSalaaula($salaaula) {
        $this->salaaula = $salaaula;
    }

    function setSalas($salas) {
        $this->salas = $salas;
    }

    function setTurmas($turmas) {
        $this->turmas = $turmas;
    }

    function setAulas($aulas) {
        $this->aulas = $aulas;
    }

    function setProfessores($professores) {
        $this->professores = $professores;
    }

    function setDisciplinas($disciplinas) {
        $this->disciplinas = $disciplinas;
    }

    protected function getConteudoCadastrar() {
        return '<div id="cadastro">
            <form id="form" action="index.php?pg=salaAula&acao=insere" method="POST">
                    <div class="container">
                        <input class="campo" name="codigo" type="hidden" id="codigo-salaAula" >
                        <label class="desc-formulario">Sala</label>
                        '.$this->createSelectCadastroSala().'
                            <label class="desc-formulario">Aula</label>
                        '.$this->createSelectCadastroAula().'
                            <label class="desc-formulario">Turma</label>
                        '.$this->createSelectCadastroTurma().'
                            <label class="desc-formulario">Professor - Disciplina</label>
                        '.$this->createSelectCadastroProfessorDisciplina().'
                           
                        <button class="limpar" id="limpar-salaaula">
                            Limpar
                        </button>
                        <input type="submit" class="cadastrar" id="cadastrar-salaaula" value="Cadastrar">                    
                        <input type="submit" class="cadastrar-peq" id="cadastrar-salaaula" value="Cadastrar">
                    </div>
                </form>
             </div>
             <div class="container">
                <form action="index.php?pg=salaAula" method="POST">
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
            <form id="form" action="index.php?pg=salaAula&acao=altera&efetiva=1" method="POST">
                    <div class="container">
                        <label class="desc-formulario">Código</label>
                        <input class="campo" name="codigo" type="text" id="codigo-salaAula" value="'.$this->salaaula->getCodigo().'" readonly>
                
                        <label class="desc-formulario">Sala</label>
                        '.$this->createSelectSala().'
                            <label class="desc-formulario">Aula</label>
                        '.$this->createSelectAula().'
                            <label class="desc-formulario">Turma</label>
                        '.$this->createSelectTurma().'
                            <label class="desc-formulario">Professor - Disciplina</label>
                        '.$this->createSelectProfessorDisciplina().'
                        <button class="limpar" id="limpar-salaaula">
                            Limpar
                        </button>
                        <input type="submit" class="cadastrar" id="cadastrar-salaaula" value="Alterar">                    
                        <input type="submit" class="cadastrar-peq" id="cadastrar-salaaula" value="Alterar">
                    </div>
                </form>
             </div>
             <div class="container">
                <form action="index.php?pg=salaAula" method="POST">
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
                        <th>Sala</th>
                        <th>Aula</th>
                        <th>Turma</th>
                        <th>Professor</th>
                        <th>Disciplina</th>
                        <th>Ações</th>
                    </tr>
                    '.$this->createSelectListagem().'
                </table>';
    }
    
    private function createSelectListagem() {
        $sResult = "";
        
        foreach ($this->salasaula as $oSalaaula) { 
            $sResult .= ' <tr>
                            <td>' . $oSalaaula->getCodigo() . '</td>
                            <td>' . $oSalaaula->getSala()->getDescricao() . '</td>
                            <td>' . $oSalaaula->getAula()->getHorarioInicio()  . '</td>
                            <td>' . $oSalaaula->getTurma()->getNome()  . '</td>
                            <td>' . $oSalaaula->getProfessor()->getNome()  . '</td>
                            <td>' . $oSalaaula->getDisciplina()->getNome()  . '</td>
                            <td><a href="index.php?pg=salaAula&acao=altera&codigo='.$oSalaaula->getCodigo().'&efetiva=0"><img src="../images/edit.png" width="20px"></a>
                            <a href="index.php?pg=salaAula&acao=exclui&codigo='.$oSalaaula->getCodigo().'"><img src="../images/garbage-2.png" width="20px"></a></td>
                          </tr>';
        }
        return $sResult;
    }
    
    private function createSelectCadastroSala() {
        $aSelect = [];
        
        foreach ($this->salas as $oSala) {
                $aSelect[] = '<option value="' . $oSala->getCodigo() . '">' . $oSala->getDescricao() . '</option>';
        }
        //PHP_EOL � o </br> do PHP
        return '<select class="selecao" name="sala" id="salaaula-sala">
                '. implode(PHP_EOL, $aSelect).'
                </select>';
    }
    private function createSelectCadastroAula() {
        $aSelect = [];
        
        foreach ($this->aulas as $oAula) {
                $aSelect[] = '<option value="' . $oAula->getCodigo() . '">' . $oAula->getHorarioInicio() . '</option>';
        }
        //PHP_EOL � o </br> do PHP
        return '<select class="selecao" name="aula" id="salaaula-aula">
                '. implode(PHP_EOL, $aSelect).'
                </select>';
    }
    private function createSelectCadastroTurma() {
        $aSelect = [];
        
        foreach ($this->turmas as $oTurma) {
                $aSelect[] = '<option value="' . $oTurma->getCodigo() . '">' . $oTurma->getNome() . '</option>';
        }
        //PHP_EOL � o </br> do PHP
        return '<select class="selecao" name="turma" id="salaaula-turma">
                '. implode(PHP_EOL, $aSelect).'
                </select>';
    }
    private function createSelectCadastroProfessorDisciplina() {
        $aSelect = [];
        
        foreach ($this->prodis as $oProfDis) {
                $aSelect[] = '<option value="' . $oProfDis->getCodigo() . '">' . $oProfDis->getProfessor()->getNome() .' - '. $oProfDis->getDisciplina()->getNome(). '</option>';
        }
        //PHP_EOL � o </br> do PHP
        return '<select class="selecao" name="prodis" id="salaaula-professor">
                '. implode(PHP_EOL, $aSelect).'
                </select>';
    }
    
    
    
    ///////ALTERAR
    
     private function createSelectSala() {
        $aSelect = [];
       
        foreach ($this->salas as $oSala) {
            if($this->salaaula->getSala()->getCodigo() == $oSala->getCodigo()){
                $aSelect[] = '<option value="' . $oSala->getCodigo() . '" selected>' . $oSala->getDescricao() . '</option>';
            } else {    
                $aSelect[] = '<option value="' . $oSala->getCodigo() . '" >' . $oSala->getDescricao() . '</option>';
            }
        }
        //PHP_EOL � o </br> do PHP
        return '<select class="selecao" name="sala" id="salaaula-sala">
                '. implode(PHP_EOL, $aSelect).'
                </select>';
    }
    private function createSelectAula() {
        $aSelect = [];
        
        foreach ($this->aulas as $oAula) {
            if($this->salaaula->getAula()->getCodigo() == $oAula->getCodigo()){
                $aSelect[] = '<option value="' . $oAula->getCodigo() . '" selected>' . $oAula->getHorarioInicio() . '</option>';
            } else {
                $aSelect[] = '<option value="' . $oAula->getCodigo() . '">' . $oAula->getHorarioInicio() . '</option>';
            }
        }
        //PHP_EOL � o </br> do PHP
        return '<select class="selecao" name="aula" id="salaaula-aula">
                '. implode(PHP_EOL, $aSelect).'
                </select>';
    }
    private function createSelectTurma() {
        $aSelect = [];
        
        foreach ($this->turmas as $oTurma) {
            if($this->salaaula->getAula()->getCodigo() == $oTurma->getCodigo()){
                $aSelect[] = '<option value="' . $oTurma->getCodigo() . '" selected>' . $oTurma->getNome() . '</option>';
            } else {
                $aSelect[] = '<option value="' . $oTurma->getCodigo() . '">' . $oTurma->getNome() . '</option>';
            }
        }
        //PHP_EOL � o </br> do PHP
        return '<select class="selecao" name="turma" id="salaaula-turma">
                '. implode(PHP_EOL, $aSelect).'
                </select>';
    }
    private function createSelectProfessorDisciplina() {
        $aSelect = [];
        
        foreach ($this->prodis as $oProfDis) {
            if($this->salaaula->getProdis()->getCodigo() == $oProfDis->getCodigo()){
                $aSelect[] = '<option value="' . $oProfDis->getCodigo() . '" selected>' . $oProfDis->getProfessor()->getNome() .' - '. $oProfDis->getDisciplina()->getNome(). '</option>';
            } else {
                $aSelect[] = '<option value="' . $oProfDis->getCodigo() . '">' . $oProfDis->getProfessor()->getNome() .' - '. $oProfDis->getDisciplina()->getNome(). '</option>';
            }
        }
        //PHP_EOL � o </br> do PHP
        return '<select class="selecao" name="prodis" id="salaaula-professor">
                '. implode(PHP_EOL, $aSelect).'
                </select>';
    }
    
     public function buscaIndice() {
        $aFiltros = ['sacodigo', 'saldescricao', 'aulhorarioinicio', 'pronome', 'disnome', 'turnome'];
        $aValores = ['ID', 'Sala', 'Aula', 'Professor', 'Disciplina', 'Turma'];
        $sOpcoes = "";
        for ($i = 0; $i < sizeof($aValores); $i++) {
            $sOpcoes .= '<option value="' . $aFiltros[$i] . '">'. $aValores[$i].'</option>';
        }
        return $sOpcoes;
    }
    
}
