<?php
namespace Leviathan\View;

class View
{
    protected $file = '';
    protected $variables = array();
    protected static $basePath;

    /**
     * @param string $view
     * @throws \InvalidArgumentException
     */
    public function __construct($view)
    {
        $file = self::$basePath . \DIRECTORY_SEPARATOR . $view . '.php';
        if (!file_exists($file)) {
            throw new \InvalidArgumentException(
                'Proposed View ' . $view . ' is invalid'
            );
        }
        $this->file = $file;
    }

    /**
     * Adds a variable to template
     * @param string $name
     * @param mixed  $value
     */
    public function set($name, $value)
    {
        $this->variables[$name] = $value;
    }

    /**
     * Gets a variable from template
     * @param string $name
     * @return mixed
     */
    public function get($name)
    {
        return $this->variables[$name];
    }

    /**
     * @magic
     * @return string
     */
    public function __toString()
    {
        extract($this->variables);
        ob_start();
        require $this->file;
        $stream = ob_get_clean();
        return (string) $stream;
    }

    public static function setBasePath($basePath)
    {
        if (file_exists($basePath)) {
            self::$basePath = realpath($basePath);
        }
    }
}
