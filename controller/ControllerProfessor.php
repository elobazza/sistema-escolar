<?php


class ControllerProfessor extends ControllerPadrao{
    /** @var ModelProfessor */
    private $ModelProfessor;
    
    /** @var PersistenciaProfessor */
    private $PersistenciaProfessor;
    
    
    
    /** @var ViewCadastroProfessor */
    private $ViewCadastroProfessor;
    
    function __construct() {
        $this->ModelProfessor        = new ModelProfessor();
        $this->PersistenciaProfessor = new PersistenciaProfessor();
        $this->ViewCadastroProfessor = new ViewCadastroProfessor();
    }
    
    public function processaAlterar() {
        if(Redirecionador::getParametro('efetiva') == 1) {
            if(!empty(Redirecionador::getParametro('nome')) && !empty(Redirecionador::getParametro('cpf')) 
            && !empty(Redirecionador::getParametro('contato')) && !empty(Redirecionador::getParametro('especialidade'))
            && !empty(Redirecionador::getParametro('salario'))){
         
                $aDisciplina = [];
                $aEscola = [];

                foreach (Redirecionador::getParametro('disciplinas') as $iCodigoDisciplina) {
                    $oDisciplina = new ModelDisciplina();
                    $oDisciplina->setCodigo($iCodigoDisciplina);

                    $aDisciplina[] = $oDisciplina;
                }

                foreach (Redirecionador::getParametro('escolas') as $iCodigoEscola) {
                    $oEscola = new ModelEscola();
                    $oEscola->setCodigo($iCodigoEscola);

                    $aEscola[] = $oEscola;
                }

                $this->ModelProfessor->setCodigo(Redirecionador::getParametro('codigo'));
                $this->ModelProfessor->setNome(Redirecionador::getParametro('nome'));
                $this->ModelProfessor->setCpf(Redirecionador::getParametro('cpf'));
                $this->ModelProfessor->setContato(Redirecionador::getParametro('contato'));
                $this->ModelProfessor->setEspecialidade(Redirecionador::getParametro('especialidade'));
                $this->ModelProfessor->setSalario(Redirecionador::getParametro('salario'));
                $this->ModelProfessor->setDisciplina($aDisciplina);
                $this->ModelProfessor->setEscola($aEscola);

                $this->PersistenciaProfessor->setModelProfessor($this->ModelProfessor);
                $this->PersistenciaProfessor->alterarRegistro();

                $oPersistenciaDisciplina = new PersistenciaDisciplina();
                $oPersistenciaEscola = new PersistenciaEscola();

                $this->ViewCadastroProfessor->setDisciplinas($oPersistenciaDisciplina->listarDisciplinasPorProfessor($this->ModelProfessor->getCodigo()));
                $this->ViewCadastroProfessor->setEscolas($oPersistenciaEscola->listarEscolasPorProfessor($this->ModelProfessor->getCodigo()));
                header('Location:index.php?pg=professor');
            }
            $this->processaExibir();
        }
        else {
           $oProfessor = $this->PersistenciaProfessor->selecionar(Redirecionador::getParametro('codigo'));
           
           $oPersistenciaDisciplina = new PersistenciaDisciplina();
           $oPersistenciaEscola = new PersistenciaEscola();
            
           
           $this->ViewCadastroProfessor->setProfessor($oProfessor);
           $this->ViewCadastroProfessor->setDisciplinasProfessor($oPersistenciaDisciplina->listarDisciplinasPorProfessor($oProfessor->getCodigo()));
           $this->ViewCadastroProfessor->setEscolasProfessor($oPersistenciaEscola->listarEscolasPorProfessor($oProfessor->getCodigo()));
            
           $this->ViewCadastroProfessor->setAlterar(1);
           $this->processaExibir();
        }
    }

    public function processaExcluir() {
        $this->PersistenciaProfessor->excluirRegistro(Redirecionador::getParametro('codigo'));
        header('Location:index.php?pg=professor');
        $this->processaExibir();
    }

    public function processaExibir() {
        $oPersistenciaDisciplina = new PersistenciaDisciplina(); 
        $this->ViewCadastroProfessor->setDisciplinas($oPersistenciaDisciplina->listarRegistros());
        $oPersistenciaEscola = new PersistenciaEscola(); 
        $this->ViewCadastroProfessor->setEscolas($oPersistenciaEscola->listarRegistros());
        if(Redirecionador::getParametro('indice') && Redirecionador::getParametro('valor')){
            $sIndice = Redirecionador::getParametro('indice');
            $sValor = Redirecionador::getParametro('valor'); 
            $this->ViewCadastroProfessor->setProfessores($this->PersistenciaProfessor->listarComFiltro($sIndice, $sValor));   
        } else {
            $this->ViewCadastroProfessor->setProfessores($this->PersistenciaProfessor->listarTudo());
        }
        $this->ViewCadastroProfessor->imprime();
    }

    public function processaInserir() {
       
        if(!empty(Redirecionador::getParametro('nome')) && !empty(Redirecionador::getParametro('cpf')) 
        && !empty(Redirecionador::getParametro('contato')) && !empty(Redirecionador::getParametro('especialidade'))
        && !empty(Redirecionador::getParametro('salario'))){
            
             $aDisciplina = [];
            $aEscola = [];

            foreach (Redirecionador::getParametro('disciplinas') as $iCodigoDisciplina) {
                $oDisciplina = new ModelDisciplina();
                $oDisciplina->setCodigo($iCodigoDisciplina);

                $aDisciplina[] = $oDisciplina;
            }

            foreach (Redirecionador::getParametro('escolas') as $iCodigoEscola) {
                $oEscola = new ModelEscola();
                $oEscola->setCodigo($iCodigoEscola);
                $aEscola[] = $oEscola;
             }   
        
        
            $this->ModelProfessor->setNome(Redirecionador::getParametro('nome'));
            $this->ModelProfessor->setCpf(Redirecionador::getParametro('cpf'));
            $this->ModelProfessor->setContato(Redirecionador::getParametro('contato'));
            $this->ModelProfessor->setEspecialidade(Redirecionador::getParametro('especialidade'));
            $this->ModelProfessor->setSalario(Redirecionador::getParametro('salario'));
            $this->ModelProfessor->setDisciplina($aDisciplina);
            $this->ModelProfessor->setEscola($aEscola);


            $this->PersistenciaProfessor->setModelProfessor($this->ModelProfessor);
            $this->PersistenciaProfessor->inserirRegistro();

            header('Location:index.php?pg=professor');
        }
        
        $this->processaExibir();
    }

}
