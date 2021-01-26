<?php

class ModelEscola {
    private $codigo;
    /** @var ModelCidade $cidade */
    private $cidade;
    private $nome;
    private $endereco;
    private $contato;
    private $login;
    private $senha;
    
    function getCodigo() {
        return $this->codigo;
    }

    /**
     * 
     * @return ModelCidade
     */
    function getCidade() {
        if(empty($this->cidade)) {
            $this->cidade = new ModelCidade();
        }
        return $this->cidade;
    }

    function getNome() {
        return $this->nome;
    }

    function getEndereco() {
        return $this->endereco;
    }

    function getContato() {
        return $this->contato;
    }

    function getLogin() {
        return $this->login;
    }

    function getSenha() {
        return $this->senha;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setCidade(ModelCidade $cidade) {
        $this->cidade = $cidade;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    function setContato($contato) {
        $this->contato = $contato;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }


}
