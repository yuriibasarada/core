<?php


namespace Core\database\ext;


use Core\database\DatabasePdo;
use Core\database\ResultPdo;
use Core\error\CoreException;

/**
 * Create Read Update Delete + Page Search
 * Этот класс будет работать при условии что наименование колонок (PK) в таблицах
 * организованы по такой схеме: <table_name>_id
 *
 * @package IwCore\database\ext
 */
class Crud implements CrudInterface
{
    /**
     * Ссылка на класс Базы данных
     *
     * @var DatabasePdo $db
     */
    protected $db;

    /**
     * @var string $table имя текущей таблице
     */
    protected $table;

    /**
     * Функция Инициализация баззы данных и таблицы
     *
     * Crud constructor.
     *
     * @param DatabasePdo $database
     * @param $table
     */
    public function __construct(DatabasePdo &$database, $table)
    {
        $this->db = $database;
        $this->setTable($table);
    }

    /**
     * Функция Устанавливает имя текущей таблицы Баззы Данных
     *
     * @param $table
     */
    public function setTable($table)
    {
        $this->table = $table;
    }


    /**
     * @param $data
     * @return array|ResultPdo
     * @throws CoreException
     */
    public function create($data)
    {
        $keys_arr = array_keys($data);
        $keys_str = '`' . implode('`, `', $keys_arr) . '`';
        $values_str = ':' . implode(', :', $keys_arr);
        $query = "INSERT INTO `{$this->table}` ({$keys_str}) VALUES ({$values_str})";
        return $this->db->queryPrepare($query, $data);

    }

    /**
     *
     * Функция Возвращает массив ячейки таблицы по указаному id
     *
     * @param $id
     *
     * @return array
     * @throws CoreException
     */
    public function read($id)
    {
        $query = "SELECT * FROM `{$this->table}` WHERE {$this->table}_id = :_val";
        return $this->db->queryPrepare($query, array(
            '_val' => $id
        ))->fetchAssoc();
    }


    /**
     * @param $id
     * @param $data
     * @return array|ResultPdo
     * @throws CoreException
     */
    public function update($id, $data)
    {
        $set_arr = [];
        foreach ($data as $k => &$v) {
            $set_arr[] = "`{$k}` = :{$k}";
        };
        $set_str = implode(', ', $set_arr);

        $data['_val'] = $id;

        $query = "UPDATE `{$this->table}` SET {$set_str} WHERE {$this->table}_id = :_val";
        return $this->db->queryPrepare($query, $data);
    }

    /**
     * @param $id
     * @return array|ResultPdo
     * @throws CoreException
     */
    public function delete($id)
    {
        $query = "DELETE FROM {$this->table} WHERE {$this->table}_id = :_val";
        return $this->db->queryPrepare($query, array(
            '_val' => $id
        ));
    }


    /**
     * Функция паги нации
     *
     * @param integer $max максимальное число элементов на странице
     * @param integer $off
     *
     * @return ResultPdo
     * @throws CoreException
     */
    public function page($max, $off)
    {

        $query = "SELECT * FROM `{$this->table}` ORDER BY {$this->table}_id DESC LIMIT {$max} OFFSET {$off}";
        return $this->db->query($query);
    }

    /**
     * Функция выполняет поиск по базе данных
     *
     * @param $data
     *
     * @return ResultPdo
     * @throws CoreException
     */
    // СТАРАЯ ФУНКЦЯ //
//    public function search($data)
//    {
//        $arr = [];
//        foreach ($data as $k => &$v) $arr[] = "{$k} LIKE :{$k}";
//        $where_str = implode(' AND ', $arr);
//
//        $query = "SELECT * FROM {$this->table} WHERE $where_str";
//        return $this->db->queryPrepare($query, $data);
//    }
    public function search($data)
    {
        $table_title = $this->table . '_title';
        $data = [
            'title' => '%' . $data . '%',
        ];
        $query = "SELECT * FROM `{$this->table}` WHERE {$table_title} LIKE :title";
        return $this->db->queryPrepare($query, $data);
    }
}