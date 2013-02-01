<?php
namespace Lyla\Data;

class Usuario
{

    protected $id;
    protected $nome;
    protected $email;
    protected $password;
    protected $ativo;
    protected $tipo;

    function __construct($id, $nome, $email, $password, $ativo, $tipo)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
        $this->password = $password;
        $this->ativo = $ativo;
        $this->tipo = $tipo;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = (int) $id;
        return $this;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    public function getAtivo()
    {
        return $this->ativo;
    }

    public function setAtivo($ativo)
    {
        $this->ativo = (bool) $ativo;
        return $this;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
        return $this;
    }
}