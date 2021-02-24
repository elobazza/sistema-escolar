<?php
/**
 * Persistência da Pessoa
 *
 * @author Eloísa Bazzanella e Maria Eduarda Buzana
 */
class PersistenciaPessoa extends PersistenciaPadrao {
    
    /** @var ModelPessoa $ModelPessoa */
    private $ModelPessoa;
    
    function getModelPessoa() {
        return $this->ModelPessoa;
    }

    function setModelPessoa($ModelPessoa) {
        $this->ModelPessoa = $ModelPessoa;
    }

        
    public function alterarRegistro() {
        $sUpdate = 'UPDATE PESSOA
                       SET nome = \''.$this->ModelPessoa->getNome().'\',
                           cpf = \''.$this->ModelPessoa->getCpf().'\',
                           data_nascimento = \''.$this->ModelPessoa->getDataNascimento().'\',
                           contato = \''.$this->ModelPessoa->getContato().'\'
                     WHERE id_pessoa ='.$this->ModelPessoa->getUsuario()->getCodigo().' ';
        
         return pg_query($this->conexao, $sUpdate);
        
    }

    public function excluirRegistro() {}

    public function inserirRegistro() {
        $aColunas = [
            'id_pessoa',
            'nome',
            'cpf',
            'contato',
            'data_nascimento',
            'id_escola'
        ];
        
        $aValores = [
            $this->ModelPessoa->getUsuario()->getCodigo(),
            $this->ModelPessoa->getNome(),
            $this->ModelPessoa->getCpf(),
            $this->ModelPessoa->getContato(),
            $this->ModelPessoa->getDataNascimento(),
            $_SESSION['id']
        ];
        
        
        return parent::inserir('pessoa', $aColunas, $aValores);
    }

    public function listarRegistros() {
        
    }

}
