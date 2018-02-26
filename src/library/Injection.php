<?php
namespace gospel24\framework\library;

use gospel24\framework\traits\CallStatic;
use gospel24\framework\traits\Instance;

/**
 * Class Injection
 * @package gospel24\framework\library
 */
class Injection
{
    use Instance;
    use CallStatic;

    /**
     * 依赖注入
     * @param $object
     * @param array $injections
     */
    public static function object($object, array $injections = [])
    {
        $reflectionObject = new \ReflectionObject($object);

        foreach ($injections as $key => $value) {
            if ($reflectionObject->hasProperty($key)) {
                $oReflection = $reflectionObject->getProperty($key);
                $oReflection->setAccessible(true);
                $oReflection->setValue($object, $value);
            }
        }
    }
}