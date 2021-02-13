<?php
/**
 * @author Eloisa Bazzanella e Maria Eduarda Buzana
 */
class ControllerAluno extends ControllerPadrao {
    
    /** @var ModelAluno $ModelAluno */
    private $ModelAluno;
    
    /** @var ModelPessoa $ModelPessoa */
    private $ModelPessoa;
    
    /** @var ModelUsuario $ModelUsuario */
    private $ModelUsuario;
    
    /** @var PersistenciaAluno $PersistenciaAluno */
    private $PersistenciaAluno;
    
    /** @var PersistenciaPessoa $PersistenciaPessoa */
    private $PersistenciaPessoa;
    
    /** @var PersistenciaUsuario $PersistenciaUsuario */
    private $PersistenciaUsuario;
    
    /** @var ViewCadastroAluno $ViewCadastroAluno */
    private $ViewCadastroAluno;
    
    function __construct() {
        $this->ModelAluno          = new ModelAluno();
        $this->ModelPessoa         = new ModelPessoa();
        $this->ModelUsuario        = new ModelUsuario();
        $this->PersistenciaAluno   = new PersistenciaAluno();
        $this->PersistenciaPessoa  = new PersistenciaPessoa();
        $this->PersistenciaUsuario = new PersistenciaUsuario();
        $this->ViewCadastroAluno   = new ViewCadastroAluno();
    }
    
    public function processaAlterar() {
        if(Redirecionador::getParametro('efetiva') == 1) {
            if(!empty(Redirecionador::getParametro('nome')) && !empty(Redirecionador::getParametro('cpf')) 
            && !empty(Redirecionador::getParametro('contato')) && !empty(Redirecionador::getParametro('turma'))
            && !empty(Redirecionador::getParametro('data_nascimento'))){
                
                $this->ModelPessoa->getUsuario()->setCodigo(Redirecionador::getParametro('codigo'));
                
                $this->ModelPessoa->setContato(Redirecionador::getParametro('contato'));        
                $this->ModelPessoa->setCpf(Redirecionador::getParametro('cpf'));        
                $this->ModelPessoa->setData_nascimento(Redirecionador::getParametro('data_nascimento'));        
                $this->ModelPessoa->setNome(Redirecionador::getParametro('nome'));      

                $this->PersistenciaPessoa->setModelPessoa($this->ModelPessoa);
                $sucessoAlterar = $this->PersistenciaPessoa->alterarRegistro();
                   
                if($sucessoAlterar) {
                    $this->ModelAluno->getTurma()->setCodigo(Redirecionador::getParametro('turma'));
                    $this->ModelAluno->setMatricula(Redirecionador::getParametro('matricula'));
                    $this->ModelAluno->setUsuario($this->ModelPessoa->getUsuario());

                    $this->PersistenciaAluno->setModelAluno($this->ModelAluno);
                    
                    $sucessoAlterar = $this->PersistenciaAluno->alterarRegistro();
                } 
                        
                if($sucessoAlterar) {
                    header('Location:index.php?pg=consultaAluno&message=sucessoalteracao');
                } else {
                    header('Location:index.php?pg=consultaAluno&message=erroalteracao');
                }
                

            }
            $this->processaExibir();
        }
        else {
           $oAluno = $this->PersistenciaAluno->selecionar(Redirecionador::getParametro('codigo'));
           $this->ViewCadastroAluno->setAluno($oAluno);
           $this->ViewCadastroAluno->setAlterar(1);
           $this->processaExibir();
        }
        
    }

    public function processaExcluir() {
        if($this->PersistenciaAluno->excluirRegistro(Redirecionador::getParametro('codigo'))) {
            header('Location:index.php?pg=consultaAluno&message=sucessoexclusao');
        } else {
            header('Location:index.php?pg=consultaAluno&message=erroexclusao');
        }
        $this->processaExibir();
    }

    public function processaExibir() { 
        $oPersistenciaTurma = new PersistenciaTurma();        
        $this->ViewCadastroAluno->setTurmas($oPersistenciaTurma->listarRegistros());
        if(Redirecionador::getParametro('indice') && Redirecionador::getParametro('valor')){
            $sIndice = Redirecionador::getParametro('indice');
            $sValor = Redirecionador::getParametro('valor'); 
            $this->ViewCadastroAluno->setAlunos($this->PersistenciaAluno->listarComFiltro($sIndice, $sValor));   
        } else {
            $this->ViewCadastroAluno->setAlunos($this->PersistenciaAluno->listarTudo());
        }
        $this->ViewCadastroAluno->imprime();
        
        
    }

    public function processaInserir() { 
        if(!empty(Redirecionador::getParametro('nome')) && !empty(Redirecionador::getParametro('cpf')) 
        && !empty(Redirecionador::getParametro('contato')) && !empty(Redirecionador::getParametro('turma'))
        && !empty(Redirecionador::getParametro('senha')) && !empty(Redirecionador::getParametro('matricula'))
        && !empty(Redirecionador::getParametro('data_nascimento')) && !empty(Redirecionador::getParametro('login'))){
            $this->ModelUsuario->setLogin(Redirecionador::getParametro('login'));
            $this->ModelUsuario->setSenha(Redirecionador::getParametro('senha'));
            $this->ModelUsuario->setTipo(1);        

            $this->PersistenciaUsuario->setModelUsuario($this->ModelUsuario);
            $sucessoInserir = $this->PersistenciaUsuario->inserirRegistro();
            
            if($sucessoInserir) {
                $this->ModelPessoa->setUsuario($this->ModelUsuario);
                $this->ModelPessoa->setContato(Redirecionador::getParametro('contato'));        
                $this->ModelPessoa->setCpf(Redirecionador::getParametro('cpf'));        
                $this->ModelPessoa->setData_nascimento(Redirecionador::getParametro('data_nascimento'));        
                $this->ModelPessoa->setNome(Redirecionador::getParametro('nome'));
                $this->ModelPessoa->getEscola()->getUsuario()->setCodigo($_SESSION['id']);        

                $oUsuarioPessoa = $this->PersistenciaUsuario->selecionarLogin($this->ModelUsuario->getLogin(), $this->ModelUsuario->getSenha());
                $this->ModelPessoa->setUsuario($oUsuarioPessoa);

                $this->PersistenciaPessoa->setModelPessoa($this->ModelPessoa);
                $sucessoInserir = $this->PersistenciaPessoa->inserirRegistro();                
            }
            
            if($sucessoInserir) {
                $this->ModelAluno->getTurma()->setCodigo(Redirecionador::getParametro('turma'));
                $this->ModelAluno->setMatricula(Redirecionador::getParametro('matricula'));
                $this->ModelAluno->setUsuario($oUsuarioPessoa);

                $this->PersistenciaAluno->setModelAluno($this->ModelAluno);
                $sucessoInserir = $this->PersistenciaAluno->inserirRegistro();
            }
            
            if($sucessoInserir) {
                header('Location:index.php?pg=consultaAluno&message=sucessoinclusao');
            } else {
                header('Location:index.php?pg=consultaAluno&message=erroinclusao');
            }
            $this->processaExibir();
        }
        header('Location:index.php?pg=aluno&message=erroinclusao');
    }
}