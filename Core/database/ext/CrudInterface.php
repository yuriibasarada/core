<?php


namespace Core\database\ext;

use Core\database\ResultPdo;
use Core\error\CoreException;

/**
 * Interface CrudInterface
 *
 * @package IwCore\database\ext
 */
interface CrudInterface
{
    /**
     * Функция Устанавливает имя текущей таблицы Баззы Данных
     *
     * @param $table
     */
    public function setTable($table);

    /**
     *
     * Функция Создает ячейки в таблице Базы Данных
     *
     * @param $data
     *
     * @return ResultPdo
     * @throws CoreException
     */
    public function create($data);

    /**
     *
     * Функция Возвращает массив ячейки таблицы по указаному id
     *
     * @param $id
     *
     * @return array
     * @throws CoreException
     */
    public function read($id);

    /**
     *
     * Функция Обновляет ячейку баззы данных, по id
     *
     * @param $id
     *
     * @param $data
     * @return ResultPdo
     * @throws CoreException
     */
    public function update($id, $data);

    /**
     *
     * Функция Удаляет ячейку базы данных по указаному id
     *
     * @param $id
     *
     * @return ResultPdo
     * @throws CoreException
     */
    public function delete($id);
}