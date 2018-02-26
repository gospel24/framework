<?php
namespace gospel24\framework\traits;

/**
 * Trait Instance
 * @package gospel24\framework\traits
 */
trait Instance
{
    protected static $instance = null;

    /**
     * @param array $options
     * @return Instance|null
     */
    public static function instance($options = [])
    {
        if (is_null(self::$instance)) {
            self::$instance = new self($options);
        }
        return self::$instance;
    }
}
