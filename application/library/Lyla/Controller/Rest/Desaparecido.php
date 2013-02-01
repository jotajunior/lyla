<?php
namespace Lyla\Controller\Rest;
use Respect\Rest\Routable;
use Leviathan\Service\Locator;
use Lyla\Data\Desaparecido as data;

class Desaparecido implements Routable
{
    protected $mapper;
    public function __construct()
    {
        $this->mapper = Locator::get('mapper:desaparecido');
    }
    public function get($id = null)
    {
        if($id){
            return $this->mapper->find($id);
        }
        return $this->mapper->findAll();
    }
    public function post()
    {
        $obj = new Data;
        $obj->setNome($_POST['nome']);
        $obj->setDataNasc($_POST['dataNasc']);
        $obj->setCor($_POST['cor']);
        $obj->setCorOlhos($_POST['corOlhos']);
        $obj->setAltura($_POST['altura']);
        $obj->setTipoFisico($_POST['tipoFisico']);
        $obj->setCidadeOrigem($_POST['cidadeOrigem']);
        $obj->setUfOrigem($_POST['ufOrigem']);
        $obj->setContato($_POST['contato']);
        $obj->setObservacoes($_POST['observacoes']);
        $obj->setAtivo(0);
        $obj->setFoto('');
        return $this->mapper->save($obj);
    }
}