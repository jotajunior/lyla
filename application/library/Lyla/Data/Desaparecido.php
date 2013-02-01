<?php
namespace Lyla\Data;

use Lyla\Common\ProxyMapper\ModelInterface;

class Desaparecido implements ModelInterface
{

    protected $id;
    protected $nome;
    protected $dataNasc;
    protected $cor;
    protected $corOlhos;
    protected $altura;
    protected $tipoFisico;
    protected $cidadeOrigem;
    protected $ufOrigem;
    protected $contato;
    protected $contatoTelefone;
    protected $foto;
    protected $observacoes;
    protected $ativo;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
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

    public function getDataNasc()
    {
        return $this->dataNasc;
    }

    public function setDataNasc($dataNasc)
    {
        $this->dataNasc = $dataNasc;
        return $this;
    }

    public function getCor()
    {
        return $this->cor;
    }

    public function setCor($cor)
    {
        $this->cor = $cor;
        return $this;
    }

    public function getCorOlhos()
    {
        return $this->corOlhos;
    }

    public function setCorOlhos($corOlhos)
    {
        $this->corOlhos = $corOlhos;
        return $this;
    }

    public function getAltura()
    {
        return $this->altura;
    }

    public function setAltura($altura)
    {
        $this->altura = $altura;
        return $this;
    }

    public function getTipoFisico()
    {
        return $this->tipoFisico;
    }

    public function setTipoFisico($tipoFisico)
    {
        $this->tipoFisico = $tipoFisico;
        return $this;
    }

    public function getCidadeOrigem()
    {
        return $this->cidadeOrigem;
    }

    public function setCidadeOrigem($cidadeOrigem)
    {
        $this->cidadeOrigem = $cidadeOrigem;
        return $this;
    }

    public function getUfOrigem()
    {
        return $this->ufOrigem;
    }

    public function setUfOrigem($ufOrigem)
    {
        $this->ufOrigem = $ufOrigem;
        return $this;
    }

    public function getContato()
    {
        return $this->contato;
    }

    public function setContato($contato)
    {
        $this->contato = $contato;
        return $this;
    }

    public function getContatoTelefone()
    {
        return $this->contatoTelefone;
    }

    public function setContatoTelefone($contatoTelefone)
    {
        $this->contatoTelefone = $contatoTelefone;
        return $this;
    }

    public function getFoto()
    {
        return $this->foto;
    }

    public function setFoto($foto)
    {
        $this->foto = $foto;
        return $this;
    }

    public function getObservacoes()
    {
        return $this->observacoes;
    }

    public function setObservacoes($observacoes)
    {
        $this->observacoes = $observacoes;
        return $this;
    }

    public function getAtivo()
    {
        return $this->ativo;
    }

    public function setAtivo($ativo)
    {
        $this->ativo = $ativo;
        return $this;
    }
}