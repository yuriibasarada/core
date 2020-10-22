<?php

namespace Core\database;

interface DatabaseInterface
{
    /**
     * Выполняет запрос
     *
     * @param $query
     * @return ResultInterface
     */
    public function query($query);

    /**
     * Выполняет подготовленный запрос
     *
     * @param $query
     * @param array $params
     * @return ResultInterface
     */
    public function queryPrepare($query, $params = array());

    /**
     * Возвращает id после insert
     * @return mixed
     */
    public function insertId();
    /**
     * Возвращает ошибку
     *
     * @return array | bool
     */
    public function error();

}