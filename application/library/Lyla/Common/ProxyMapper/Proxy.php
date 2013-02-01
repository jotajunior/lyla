<?php
namespace Lyla\Common\ProxyMapper;

/**
 * Base class to persistence drivers for Persistence service
 */
abstract class Proxy
{
    /** data handler */
    protected $resource = null;

    /** retrieves data handler */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * Retrieves one instance of mapped class, by its id
     * @param Folio\Lib\ProxyMapper\Mapper $entity
     * @param mixed                                   $id
     */
    abstract public function find(Mapper $entity, $id);

    /**
     * Retrieves a array of mapped class, by one attribute, shortcut for findwhere
     * @param  Folio\Lib\ProxyMapper\Mapper $entity
     * @param  string                                  $attribute
     * @param  mixed                                   $value
     * @return stdClass
     */
    public function findBy(Mapper $entity, $attribute, $value)
    {
        return $this->findWhere($entity, array($attribute => $value));
    }

    /**
     * Retrieves a array of mapped class, by many attributes
     * @param  Folio\Lib\ProxyMapper\Mapper $entity
     * @param  string                                  $attribute
     * @param  mixed                                   $value
     * @return array
     */
    abstract public function findWhere(Mapper $entity, array $parameters);

    /**
     * Retrieves all of mapped class
     * @param  Folio\Lib\ProxyMapper\Mapper $entity
     * @return array
     */
    abstract public function findAll(Mapper $entity);

    /**
     * Persists a object
     * @param Folio\Lib\ProxyMapper\Mapper $entity
     * @param stdClass                                $object
     * @return $object
     */
    abstract public function save(Mapper $entity, ModelInterface $object);

    /**
     * Purges a object
     * @param  Folio\Lib\ProxyMapper\Mapper $entity
     * @param  stdClass                                $object
     * @return boolean
     */
    abstract public function delete(Mapper $entity, ModelInterface $object);

    /**
     * Retrieves a associated child
     */
    abstract public function getAssociated(MapperRelation $relation, $parentId);

    /**
     * Saves a association
     */
    abstract public function saveAssociation(MapperRelation $relation, $parentId, array $children);
}
