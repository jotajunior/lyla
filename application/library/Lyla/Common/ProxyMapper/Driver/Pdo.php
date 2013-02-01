<?php
namespace Lyla\Common\ProxyMapper\Driver;

use Lyla\Common\ProxyMapper\Proxy;
use Lyla\Common\ProxyMapper\Mapper;
use Lyla\Common\ProxyMapper\MapperRelation;
use Lyla\Common\ProxyMapper\ModelInterface;
use Pdo as PhpPdo;
use ReflectionObject;

/** Pdo Driver for ProxyMapper */
class Pdo extends Proxy
{

    /**
     * Constructor
     * @param PhpPdo $pdo
     */
    public function __construct(PhpPdo $pdo)
    {
        $this->resource = $pdo;
        $this->resource->exec("SET NAMES 'utf8'");
    }

    /**
     *
     * @param  Mapper         $entity
     * @param  int|string     $id
     * @return ModelInterface
     */
    public function find(Mapper $entity, $id)
    {
        $id = is_array($id)? : array($id);
        $binding = array();
        foreach ($entity->getIdentifier() as $key => $identifier) {
            $binding[$identifier] = $id[$key];
        }

        return current($this->findWhere($entity, $binding));
    }

    /**
     *
     * @param  Mapper $entity
     * @param  array  $parameters
     * @return type
     */
    public function findWhere(Mapper $entity, array $parameters)
    {
        $fields = $binding = array();
        foreach ($parameters as $key => $identifier) {
            $fields[] = "$key = :$key";
            $binding[$key] = $identifier;
        }
        $sql = 'SELECT ' . implode(', ', $entity->getProperties()) .
                '  FROM ' . strtolower($entity->getRemoteEntity()) .
                (count($fields) ? ' WHERE ' . implode(' AND ', $fields) : '');

        $stmt = $this->resource->prepare($sql);
        $stmt->setFetchMode(PhpPdo::FETCH_CLASS, $entity->getEntity());
        $stmt->execute($binding);

        return $stmt->fetchAll();
    }

    public function findCondition(Mapper $entity, $condition)
    {
        $sql = 'SELECT ' . implode(', ', $entity->getProperties()) .
                ' FROM ' . strtolower($entity->getRemoteEntity()) .
                ' WHERE ' . $condition;

        $this->resource->exec("SET NAMES 'utf8'");
        $stmt = $this->resource->prepare($sql);
        $stmt->setFetchMode(PhpPdo::FETCH_CLASS, $entity->getEntity());
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function findAll(Mapper $entity)
    {
        return $this->findWhere($entity, array());
    }

    public function save(Mapper $entity, ModelInterface $object)
    {
        if ($object->getId()) {
            return $this->update($entity, $object);
        }

        return $this->insert($entity, $object);
    }

    protected function insert(Mapper $entity, ModelInterface $object)
    {
        $ro = new ReflectionObject($object);
        $binding = $entity->getDataBinding($object, $ro);
        unset($binding['id']);
        $sql = 'INSERT INTO ' . $entity->getRemoteEntity() .
                '(' . implode(',', array_keys($binding)) . ') VALUES ' .
                '(:' . implode(',:', array_keys($binding)) . ')';
        error_log($sql, 3, '/var/log/lyla.log');
        error_log(print_r($binding, 1), 3, '/var/log/lyla.log');
        $stmt = $this->resource->prepare($sql);
        $result = $stmt->execute($binding);
        $rp = $ro->getProperty('id');
        $rp->setAccessible(true);
        $rp->setValue($object, $this->resource->lastInsertId());

        return (bool) $result;
    }

    protected function update(Mapper $entity, ModelInterface $object)
    {
        $ro = new ReflectionObject($object);
        $binding = $entity->getDataBinding($object, $ro);
        $sets = array();
        foreach ($binding as $property => $value) {
            if ($property != 'id') {
                $sets[] = "{$property} = :{$property}";
            }
        }
        $sql = 'UPDATE ' . $entity->getRemoteEntity() .
                ' SET ' . implode(',', $sets) .
                ' WHERE id = :id';

        $stmt = $this->resource->prepare($sql);

        return (bool) $stmt->execute($binding);
    }

    public function delete(Mapper $entity, ModelInterface $object)
    {
        $stmt = $this->resource->prepare(
            "DELETE FROM " . $entity->getRemoteEntity() . " WHERE id = ?"
        );
        $result = $stmt->execute(array($object->getId()));
        unset($object);

        return $result;
    }

    public function getAssociated(MapperRelation $relation, $parentId)
    {
        $stmt = $this->resource->prepare(
            "SELECT {$relation->getChildIdentifier()}
               FROM {$relation->getEntity()}
              WHERE {$relation->getParentIdentifier()} = :identifier"
        );
        $stmt->execute(array('identifier' => $parentId));
        $collection = array();
        foreach ($stmt as $each) {
            $collection[] = $relation->getChildMapper()->find($each[$relation->getChildIdentifier()]);
        }

        return $collection;
    }

    public function saveAssociation(MapperRelation $relation, $parentId, array $children)
    {
        $delstmt = $this->resource->prepare(
            "DELETE FROM {$relation->getEntity()}
              WHERE {$relation->getParentIdentifier()} = :identifier"
        );
        $result = $delstmt->execute(array('identifier' => $parentId));
        if ($result) {
            $insstmt = $this->resource->prepare(
                "INSERT INTO {$relation->getEntity()}
                 ({$relation->getParentIdentifier()},{$relation->getChildIdentifier()})
                 VALUES (:parent,:child)"
            );
            foreach ($children as $child) {
                $insstmt->execute(array('parent' => $parentId, 'child' => $child->getId()));
            }

            return true;
        }

        return false;
    }

    public function deleteAssociation(MapperRelation $relation, $parentId)
    {
        $delstmt = $this->resource->prepare(
            "DELETE FROM {$relation->getEntity()}
              WHERE {$relation->getParentIdentifier()} = :identifier"
        );
        $result = $delstmt->execute(array('identifier' => $parentId));

        return (bool) $result;
    }
}
