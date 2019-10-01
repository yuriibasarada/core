<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 01.10.2019
 * Time: 10:53
 */

namespace shCore\database;

use PDO;
use PDOStatement;

class ResultPdo implements ResultInterface
{
    /**
     * @var PDOStatement $result Содержит результат по запросу к базе данных
     */
    protected $result;

    /**
     * @var bool $insert_id содержит генерируемый insert_id;
     */
    protected $insert_id;

    /**
     * Инициализация свойств
     *
     * ResultPdo constructor.
     *
     * @param PDOStatement $result
     * @param bool $insert_id
     */
    public function __construct(PDOStatement &$result, $insert_id = false)
    {
        $this->result = $result;
        $this->insert_id = $insert_id;
    }

    /**
     * Возвращает результат в виде ассоциативного массива
     *
     * @return array
     */
    public function fetchAssoc()
    {
        return $this->result->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Возвращает все результаты в виде ассоциативных массивов
     *
     * @return array[]
     */
    public function fetchAssocAll()
    {
        return $this->result->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Возвращает результат в виде массива с числовыми индексами
     *
     * @return array
     */
    public function fetchNum()
    {
        return $this->result->fetch(PDO::FETCH_NUM);
    }

    /**
     * Возвращает все результаты в виде массивов с числовыми индексами
     *
     * @return array[]
     */
    public function fetchNumAll()
    {
        return $this->result->fetchAll(PDO::FETCH_NUM);
    }

    /**
     * Возвращает результат колонки в виде строки
     *
     * @param int $column
     * @return string
     */
    public function fetchColumn($column = 0)
    {
        return $this->result->fetchColumn($column);
    }

    /**
     * Возвращает результат колонки в виде массива с числовыми индексами
     *
     * @param int $column
     * @return array
     */
    public function fetchColumns($column = 0) {
        return $this->result->fetchAll(PDO::FETCH_COLUMN, $column);
    }

    /**
     * Вернуть реальный результат без абстрации
     *
     * @return mixed
     */
    public function getNative()
    {
        return $this->result;
    }

    /**
     * Возвращает ошибки
     *
     * @return mixed | bool
     */
    public function getError()
    {
        $t = $this->result->errorInfo();
        if ($t[0] === '00000') return false;
        return $t[2];
    }

    /**
     * Возвращает количество затронутых строк
     *
     * @return int
     */
    public function rowCount()
    {
        return $this->result->rowCount();
    }

    /**
     * Возвращает идентификатор созданой записи
     *
     * @return int
     */
    public function newId()
    {
        return $this->insert_id;
    }
}