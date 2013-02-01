<?php
namespace Leviathan\Service;

/**
 * Service Locator, DIC and Registry multipurporse class
 * @author Duodraco <mail:o@duodra.co> <twitter:duodraco>
 * @example Locator::get('service:mapper');
 */
class Locator extends \ArrayObject
{

    protected $name;
    protected $id;
    protected $originalArray = array();
    protected static $root;
    protected static $registry = array();

    const PATH_TOKEN = ':';
    const NS_TOKEN = '.';

    /**
     * Constructor
     * @param array $array configuration Array
     * @param string $id [optional] FQN for configuration node
     * @param string $name [optional] name for indexing
     */
    public function __construct(array $array, $id = '', $name = '')
    {
        parent::__construct(array(), self::ARRAY_AS_PROPS);
        $this->id = trim($id, self::PATH_TOKEN);
        $this->name = $name ? : trim(
                        strstr($id, self::PATH_TOKEN), self::PATH_TOKEN
        );
        foreach ($array as $property => $value) {
            $value = $this->hydrateNode($property, $value);
            $this->offsetSet($property, $value);
        }
        if ($this->id == '') {
            $this->originalArray = $array;
            self::$root = $this;
        }
    }

    /**
     * starts configuration to global Locator
     * @param array $array configuration array
     * @return Leviathan\Service\Locator
     */
    public static function load(array $array)
    {
        return new self($array);
    }

    /**
     * Retrieves original array
     * @return array
     */
    public static function asArray()
    {
        return self::$root->asArray();
    }

    /**
     * Returns current node name
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Returns current node ID (FQN)
     * @return string
     */
    public function getId()
    {
        return trim($this->id, self::PATH_TOKEN);
    }

    /**
     * does the hydration of each configuration node
     * @param string $property
     * @param mixed $value
     * @return Leviathan\Service\Locator
     */
    protected function hydrateNode($property, $value)
    {
        if (is_array($value) || $value instanceof \Traversable) {
            $value = new static(
                    $value, $this->id . self::PATH_TOKEN . $property, $property
            );
        }
        return $value;
    }

    /**
     * overrides ArrayObject's one to get right index
     * @param string $index
     * @return Leviathan\Service\Locator
     */
    public function offsetGet($index)
    {
        $value = parent::offsetGet($index);
        if (!(is_string($value) && strpos($value, self::PATH_TOKEN) === 0)) {
            return $value;
        }
        $base = self::parsePath($value);
        return $base ? : $value;
    }

    /**
     * Searches entire tree for a specified path
     * @example "path:to:a:inner:node"
     * @param string $path
     * @return Leviathan\Service\Locator
     */
    protected static function parsePath($path)
    {
        $base = self::$root;
        $nodes = explode(self::PATH_TOKEN, trim($path, self::PATH_TOKEN));
        for ($index = 0, $count = count($nodes); $index < $count && $base; $index++) {
            $base = $base->{$nodes[$index]};
        }
        if (is_object($base) && $base->getName() == end($nodes)) {
            return $base;
        }
    }

    /**
     * Exports current node, if applicable, to a realized object
     * @return object | null
     */
    public function export()
    {
        if (self::exists($this->id)) {
            return self::get($this->id);
        }
        $value = current($this);
        $param = $value instanceof Locator ? $value : $this;
        $obj = $this->getExportedObject($param);
        if ($obj) {
            self::register(trim($this->id, self::PATH_TOKEN), $obj);
            return $obj;
        }
    }

    /**
     * Helper for export method
     * @param Leviathan\Service\Locator $node
     * @return mixed
     */
    protected function getExportedObject(Locator $node)
    {
        $translatedName = str_replace(self::NS_TOKEN, '\\', $node->getName());
        if (!class_exists($translatedName)) {
            return;
        }
        $obj = new \ReflectionClass($translatedName);
        if (!$obj->isInstantiable()) {
            return;
        }
        if (!$obj->getConstructor()) {
            return $obj->newInstance();
        }
        $constructorArgs = array();
        foreach ($node as $name => $value) {
            $constructorArgs[] = $node->$name instanceof Locator ?
                    $node->$name->export() : $value;
        }
        try {
            if ($constructorArgs) {
                $object = $obj->newInstanceArgs($constructorArgs);
                return $object;
            }
            return $obj->newInstanceArgs();
        } catch (\Exception $exception) {
            throw new \Exception(
            'An Exception was thrown on Object creation: ' .
            $exception->getMessage()
            );
            $object = false;
        }
    }

    /**
     * Merges a new configuration array to current root container
     * @param array $newContainer
     * @return array
     */
    public static function merge(array $newContainer)
    {
        self::arrayMerge(self::$originalArray, $newContainer);
    }

    /**
     * Merges 2 arrays into one
     * @param array $array1
     * @param array $array2
     * @return array
     */
    protected static function arrayMerge(array $array1, array $array2)
    {
        foreach ($array2 as $key => $value) {
            if (array_key_exists($key, $array1) && is_array($value)) {
                $array1[$key] = self::arrayMerge($array1[$key], $array2[$key]);
            } else {
                $array1[$key] = $value;
            }
        }
        return $array1;
    }

    /**
     * Register a new value on locator registry
     * @param string $name
     * @param mixed $value
     * @param boolean $force
     * @return mixed
     */
    public static function register($name, $value, $force = false)
    {
        if (!self::exists($name) || $force) {
            $return = self::$registry[$name] = $value;
        }
        return self::$registry[$name];
    }

    /**
     * Checks if a key already exists on Locator Registry
     * @param string $name
     * @return boolean
     */
    public static function exists($name)
    {
        return isset(self::$registry[$name]);
    }

    /**
     * Gets a value stored on Locator Registry
     * If no value passed, returns the Root Node and
      access to configuration nodes
     * @param string $name [optional]
     * @return mixed
     */
    public static function get($name = null)
    {
        if (!$name) {
            return self::$root;
        }
        if (self::exists($name)) {
            return self::$registry[$name];
        }
        return self::discover($name);
    }

    /**
     * Discovery service to gets a "exportable" object on configuration
     * @param string $name
     * @return mixed
     */
    public static function discover($name)
    {
        $obj = self::parsePath($name);
        if ($obj) {
            $transformed = $obj->export();
            $obj = $transformed ? : $obj;
            self::register(trim($name, self::PATH_TOKEN), $obj);
            return $obj;
        }
    }
}
