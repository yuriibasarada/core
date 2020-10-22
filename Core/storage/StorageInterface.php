<?php

namespace Core\storage;

interface StorageInterface
{
    /**
     * Возвращает данные из хранилища по ключу
     * @param $key
     * @return mixed
     */
    public function get($key);

    /**
     * Добавляет данные в хранилище
     * @param $key
     * @param $value
     */
    public function set($key, $value);
}