<?php
/**
 * @author Eloisa Bazzanella e Maria Eduarda Buzana
 */
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
            && !empty(Redirecionador::getParametro('salario')) && !empty(Redirecionador::getParametro('data_nascimento'))){
                
                $this->ModelPessoa->getUsuario()->setCodigo(Redirecionador::getParametro('codigo'));
                
                $this->ModelPessoa->setContato(Redirecionador::getParametro('contato'));        
                $this->ModelPessoa->setCpf(Redirecionador::getParametro('cpf'));        
                $this->ModelPessoa->setData_nascimento(Redirecionador::getParametro('data_nascimento'));        
                $this->ModelPessoa->setNome(Redirecionador::getParametro('nome'));      

                $this->PersistenciaPessoa->setModelPessoa($this->ModelPessoa);
                $sucessoAlteracao = $this->PersistenciaPessoa->alterarRegistro();

                if($sucessoAlteracao) {
                    $this->ModelProfessor->setEspecialidade(Redirecionador::getParametro('especialidade'));
                    $this->ModelProfessor->setSalario(Redirecionador::getParametro('salario'));
                    $this->ModelProfessor->setUsuario($this->ModelPessoa->getUsuario());

                    $this->PersistenciaProfessor->setModelProfessor($this->ModelProfessor);
                    $sucessoAlteracao = $this->PersistenciaProfessor->alterarRegistro();
                }
                
                if($sucessoAlteracao) {
                    header('Location:index.php?pg=consultaProfessor&message=sucessoalteracao');
                } else {
                    header('Location:index.php?pg=consultaProfessor&message=erroalteracao'); 
                }
            }
            $this->processaExibir();
        }
        else {
           $oProfessor = $this->PersistenciaProfessor->selecionar(Redirecionador::getParametro('codigo'));
           
           $this->ViewCadastroProfessor->setProfessor($oProfessor);            
           $this->ViewCadastroProfessor->setAlterar(1);
           $this->processaExibir();
        }
    }

    public function processaExcluir() {
        if($this->PersistenciaProfessor->excluirRegistro(Redirecionador::getParametro('codigo'))) {
            header('Location:index.php?pg=consultaProfessor&message=sucessoexclusao');
        } else {
            header('Location:index.php?pg=consultaProfessor&message=erroexclusao');
        }
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
            $sucessoInclusao = $this->PersistenciaUsuario->inserirRegistro();
            
            if($sucessoInclusao) {
                $this->ModelPessoa->setUsuario($this->ModelUsuario);
                $this->ModelPessoa->setContato(Redirecionador::getParametro('contato'));        
                $this->ModelPessoa->setCpf(Redirecionador::getParametro('cpf'));        
                $this->ModelPessoa->setData_nascimento(Redirecionador::getParametro('data_nascimento'));        
                $this->ModelPessoa->setNome(Redirecionador::getParametro('nome'));
                $this->ModelPessoa->getEscola()->getUsuario()->setCodigo($_SESSION['id']);        

                $oUsuarioPessoa = $this->PersistenciaUsuario->selecionarLogin($this->ModelUsuario->getLogin(), $this->ModelUsuario->getSenha());
                $this->ModelPessoa->setUsuario($oUsuarioPessoa);

                $this->PersistenciaPessoa->setModelPessoa($this->ModelPessoa);
                $sucessoInclusao = $this->PersistenciaPessoa->inserirRegistro();
            }
            
            if($sucessoInclusao) {
                $this->ModelProfessor->setEspecialidade(Redirecionador::getParametro('especialidade'));
                $this->ModelProfessor->setSalario(Redirecionador::getParametro('salario'));
                $this->ModelProfessor->setUsuario($oUsuarioPessoa);

                $this->PersistenciaProfessor->setModelProfessor($this->ModelProfessor);
                $sucessoInclusao = $this->PersistenciaProfessor->inserirRegistro();
            }
            if($sucessoInclusao) {
                header('Location:index.php?pg=consultaProfessor&message=sucessoinclusao');
            } else {
                header('Location:index.php?pg=consultaProfessor&message=erroinclusao'); 
            }
        }
        
        $this->processaExibir();
    }

}
