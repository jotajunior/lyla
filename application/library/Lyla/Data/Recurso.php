<?php
namespace Lyla\Data;

class Recurso
{

    protected $id;
    protected $nome;

    function __construct($id, $name)
    {
        $this->id = $id;
        $this->nome = $name;
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
}