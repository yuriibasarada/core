<?php

namespace shCore\database;

class DatabaseConfigPdo
{
    /**
     * Тип базы данных
     * @var $driver
     */
    public $driver = 'mysql';

    /**
     * Имя хоста
     * @var $host
     */
    public $host;

    /**
     * Название порта
     * @var $port
     */
    public $port;

    /**
     * Название базы данных
     * @var $db_name
     */
    public $db_name;

    /**
     * Имя пользователя
     * @var $username
     */
    public $username;

    /**
     * Пароль
     * @var $password
     */
    public $password;

    /**
     * Кодировка обращения
     * @var $charset
     */
    public $charset;

    /**
     * Опции подключения
     * @var $option
     */
    public $options = array();


    /**
     * Инициализация свойств класса
     * DatabaseConfigPdo constructor.
     * @param array $arr
     */
    public function __construct($arr = array())
    {
        foreach ($arr as $key => &$item) {
            if(isset($this->$key)) $this->$key = $item;
        }
    }

    public function getDSN()
    {
        return $this->driver . ':'
        . 'host=' . $this->host . ';'
        . 'dbname=' . $this->db_name
        . (($this->port) ? ';port=' . $this->port : '')
        . (($this->charset) ? ';charset=' . $this->charset : '');
    }
}