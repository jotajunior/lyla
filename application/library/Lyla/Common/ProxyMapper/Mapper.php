<?php
namespace Lyla\Common\ProxyMapper;

use ReflectionObject;

/**
 * Base class to Map objects to Persistence service
 */
abstract class Mapper
{
    /** @var Proxy */
    protected $proxy;
    protected $entity;
    protected $remoteEntity;

    public function __construct(Proxy $proxy)
    {
        $this->proxy = $proxy;
        $this->entity = str_replace('\Mapper', '\Data', get_called_class());
        $entityParts = explode('\\', $this->entity);
        $this->remoteEntity = end($entityParts);
    }

    abstract public function getIdentifier();

    public function getProperties()
    {
        $reflected = new \ReflectionClass($this->entity);
        $properties = array();
        foreach ($reflected->getProperties() as $property) {
            $property->setAccessible(true);
            $properties[] = $property->getName();
        }

        return $properties;
    }

    public function find($id)
    {
        return $this->proxy->find($this, $id);
    }

    public function findBy($attribute, $value)
    {
        return $this->findWhere(array($attribute => $value));
    }

    public function findWhere(array $parameters)
    {
        return $this->proxy->findWhere($this, $parameters);
    }

    /**
     * @deprecated since version 12.0
     */
    public function findCondition($condition)
    {
        return $this->proxy->findCondition($this, $condition);
    }

    public function findAll()
    {
        return $this->proxy->findAll($this);
    }

    public function save(ModelInterface $object)
    {
        return $this->proxy->save($this, $object);
    }

    public function delete(ModelInterface $object)
    {
        return $this->proxy->delete($this, $object);
    }

    public function getDriver()
    {
        return $this->proxy;
    }

    public function getEntity()
    {
        return $this->entity;
    }

    public function getRemoteEntity()
    {
        return $this->remoteEntity;
    }

    public function getDataBinding(ModelInterface $object, ReflectionObject $ro)
    {
        $binding = array();
        foreach ($this->getProperties() as $key => $property) {
            $rp = $ro->getProperty($key);
            $rp->setAccessible(true);
            $binding[$property] = $rp->getValue($object);
        }

        return $binding;
    }

}
