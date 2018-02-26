<?php

if (!function_exists('mpe_global')) {

    /**
     * @param $key
     * @param null $value
     * @param string $default
     * @return bool|mixed|string
     */
    function mpe_global($key, $value = null, $default = '')
    {
        global $data;

        if (is_array($data) === false) $data = array();

        if (is_null($value) === false) {
            $data[$key] = $value;
            return true;
        }

        if (array_key_exists($key, $data) === true) {
            return $data[$key];
        }

        return $default;
    }
}