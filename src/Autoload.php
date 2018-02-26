<?php
namespace gospel24\framework;

/**
 * Class Autoload
 * @package gospel24\framework
 */
class Autoload
{
    /**
     * @var string
     */
    public $autoloadDir = '';

    /**
     * @var string
     */
    public $nameSpace = '';

    /**
     * @param string $autoloadDir
     * @param string $nameSpace
     */
    public static function register($autoloadDir, $nameSpace = '')
    {
        spl_autoload_register(array(new self($autoloadDir, $nameSpace), 'load'));
    }

    /**
     * Autoload constructor.
     * @param $autoloadDir
     * @param $nameSpace
     */
    public function __construct($autoloadDir, $nameSpace)
    {
        $this->autoloadDir = $autoloadDir . '/';
        $this->nameSpace = $nameSpace;
    }

    /**
     * @param $sClassFullName
     */
    public function load($sClassFullName)
    {
        if (strlen($this->nameSpace) > 0) {
            if (strpos($sClassFullName, $this->nameSpace . '\\') !== 0) return;
            $sClassFullName = substr($sClassFullName, strlen($this->nameSpace . '\\'));
        }

        $sClassFullPath = $this->autoloadDir . str_replace('\\', '/', $sClassFullName) . '.php';

        if (is_file($sClassFullPath) === true) {
            include $sClassFullPath;
        }
    }
}