<?php


namespace shCore\database;

/**
 * Класс для хранения данных для подключения к БД
 * Class DatabaseConfigPDO
 * @package IwCore\database
 */
class DatabaseConfigPDO
{
    /**
     * @var string MYSQL константа содержит тип базы данных
     */
    const MYSQL = 'mysql';
    /**
     * @var string $driver переменная содержит тип базы данных
     */
    public $driver = self::MYSQL;

    /**
     * @var string $host переменная содержит имя хоста
     */
    public $host = '';

    /**
     * @var string $port переменная сожержит названия порта
     */
    public $port = '';

    /**
     * @var string $db_name переменная содержит имя базы данных
     */
    public $db_name = '';

    /**
     * @var string $username переменная содержит имя пользователя
     */
    public $username = '';

    /**
     * @var string $password переменная содержит пароль к базе данных
     */
    public $password = '';

    /**
     * @var string $charset переменная содержит кодировку обращения к базе данных
     */
    public $charset = '';

    /**
     * @var array $options переменная содержит опции подключения к базе данных
     */
    public $options = array();

    /**
     * Инициализация свойств класса
     *
     * DatabaseConfigPDO constructor.
     *
     * @param array $arr
     */
    public function __construct($arr = array())
    {
        foreach ($arr as $key => &$item) {
            if (isset($this->$key)) $this->$key = $item;
        }
    }

    /**
     * Функция Возвращает DNS строку
     *
     * @return string
     */
    public function getDSN()
    {
        return $this->driver . ':'
            . 'host=' . $this->host . ';'
            . 'dbname=' . $this->db_name
            . (($this->port) ? ';port=' . $this->port : '')
            . (($this->charset) ? ';charset=' . $this->charset : '');
    }

}