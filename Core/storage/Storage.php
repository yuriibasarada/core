<?php

namespace Core\storage;

class Storage implements StorageInterface
{
    /**
     * Массив для хранения данных
     * @var array $storage
     */
    protected $storage;

    /**
     * Storage constructor.
     * @param $config
     */
    public function __construct($config)
    {
        $this->storage = $config;
    }

    /**
     * @param $key
     * @return mixed|null
     */
    public function get($key) {
        $r = &$this->storage[$key];
        return isset($r) ? $r : null;
    }

    /**
     * @param $key
     * @param $value
     */
    public function set($key, $value) {
        $this->storage[$key] = $value;
    }
}