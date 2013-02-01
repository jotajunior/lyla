<?php
namespace Lyla\Common\ProxyMapper;

/** Maps object relationship to Persistence service */
class MapperRelation
{
    /** Remote relational entity */
    protected $entity;

    /** Remote relational attribute, refering to parent object */
    protected $parentIdentifier;

    /** Remote relational attribute, refering to child object */
    protected $childIdentifier;

    /** Mapper for child object */
    protected $childMapper;

    public function __construct($entity, $parentIdentifier, $childIdentifier, Mapper $childMapper)
    {
        $this->entity = $entity;
        $this->parentIdentifier = $parentIdentifier;
        $this->childIdentifier = $childIdentifier;
        $this->childMapper = $childMapper;
    }

    public function getEntity()
    {
        return $this->entity;
    }

    public function getParentIdentifier()
    {
        return $this->parentIdentifier;
    }

    public function getChildIdentifier()
    {
        return $this->childIdentifier;
    }

    public function getChildMapper()
    {
        return $this->childMapper;
    }

}
