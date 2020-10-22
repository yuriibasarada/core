<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 01.10.2019
 * Time: 10:46
 */

namespace Core\database;

interface ResultInterface
{

    /**
     * Возвращает результат в виде ассоциативного массива
     * @return array();
     */
    public function fetchAssoc();

    /**
     * Возвращает все результаты в виде ассоциативного массива
     * @return array();
     */
    public function fetchAssocAll();

    /**
     * Возвращает результат в виде массива с числовым индексом
     * @return array
     */
    public function fetchNum();

    /**
     * Возвращает все результаты в виде массива с числовым индексом
     * @return array[]
     */
    public function fetchNumAll();

    /**
     * Возвращает результат колонки в виде массива с числовым индексом
     * @param int $column
     * @return mixed
     */
    public function fetchColumn($column = 0);

    /**
     * Вернуть реальный результат в виде абстрации
     * @return mixed
     */
    public function getNative();

    /**
     * Возвращает ошибки
     *
     * @return mixed
     */
    public function getError();

    /**
     * Возвращает количество затронутых строк
     * @return mixed
     */
    public function rowCount();

    /**
     * Возвращает идентификатор созданой записи
     * @return mixed
     */
    public function newId();
}