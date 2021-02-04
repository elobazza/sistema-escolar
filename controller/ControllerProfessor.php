<?php


class ControllerProfessor extends ControllerPadrao{
    
    /** @var ModelProfessor */
    private $ModelProfessor;
    
    /** @var ModelUsuario */
    private $ModelUsuario;
    
    /** @var ModelPessoa */
    private $ModelPessoa;
    
    /** @var PersistenciaProfessor */
    private $PersistenciaProfessor;
    
    /** @var PersistenciaUsuario */
    private $PersistenciaUsuario;
    
    /** @var PersistenciaPessoa */
    private $PersistenciaPessoa;
    
    /** @var ViewCadastroProfessor */
    private $ViewCadastroProfessor;
    
    function __construct() {
        $this->ModelProfessor        = new ModelProfessor();
        $this->ModelUsuario          = new ModelUsuario();
        $this->ModelPessoa           = new ModelPessoa();
        $this->PersistenciaProfessor = new PersistenciaProfessor();
        $this->PersistenciaUsuario   = new PersistenciaUsuario();
        $this->PersistenciaPessoa    = new PersistenciaPessoa();
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
//        $oPersistenciaEscola = new PersistenciaEscola(); 
//        $this->ViewCadastroProfessor->setEscolas($oPersistenciaEscola->listarRegistros());
        if(Redirecionador::getParametro('indice') && Redirecionador::getParametro('valor')){
            $sIndice = Redirecionador::getParametro('indice');
            $sValor = Redirecionador::getParametro('valor'); 
            $this->ViewCadastroProfessor->setProfessores($this->PersistenciaProfessor->listarComFiltro($sIndice, $sValor));   
        } 
//        else {
//            $this->ViewCadastroProfessor->setProfessores($this->PersistenciaProfessor->listarTudo());
//        }
        $this->ViewCadastroProfessor->imprime();
    }

    public function processaInserir() {
        if(!empty(Redirecionador::getParametro('nome')) && !empty(Redirecionador::getParametro('cpf')) 
        && !empty(Redirecionador::getParametro('contato')) && !empty(Redirecionador::getParametro('especialidade'))
        && !empty(Redirecionador::getParametro('senha')) && !empty(Redirecionador::getParametro('salario'))
        && !empty(Redirecionador::getParametro('data_nascimento')) && !empty(Redirecionador::getParametro('login'))){
            $this->ModelUsuario->setLogin(Redirecionador::getParametro('login'));
            $this->ModelUsuario->setSenha(Redirecionador::getParametro('senha'));
            $this->ModelUsuario->setTipo(1);        

            $this->PersistenciaUsuario->setModelUsuario($this->ModelUsuario);
            $this->PersistenciaUsuario->inserirRegistro();
            
            $this->ModelPessoa->setUsuario($this->ModelUsuario);
            $this->ModelPessoa->setContato(Redirecionador::getParametro('contato'));        
            $this->ModelPessoa->setCpf(Redirecionador::getParametro('cpf'));        
            $this->ModelPessoa->setData_nascimento(Redirecionador::getParametro('data_nascimento'));        
            $this->ModelPessoa->setNome(Redirecionador::getParametro('nome'));
            $this->ModelPessoa->getEscola()->getUsuario()->setCodigo($_SESSION['id']);        
            
            $oUsuarioPessoa = $this->PersistenciaUsuario->selecionarLogin($this->ModelUsuario->getLogin(), $this->ModelUsuario->getSenha());
            $this->ModelPessoa->setUsuario($oUsuarioPessoa);
            
            $this->PersistenciaPessoa->setModelPessoa($this->ModelPessoa);
            $this->PersistenciaPessoa->inserirRegistro();
            
            $this->ModelProfessor->setEspecialidade(Redirecionador::getParametro('especialidade'));
            $this->ModelProfessor->setSalario(Redirecionador::getParametro('salario'));
            $this->ModelProfessor->setUsuario($oUsuarioPessoa);

            $this->PersistenciaProfessor->setModelProfessor($this->ModelProfessor);
            $this->PersistenciaProfessor->inserirRegistro();
            header('Location:index.php?pg=consultaProfessor');
        }
        
        $this->processaExibir();
    }

}
