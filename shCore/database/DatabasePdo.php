<?php

namespace shCore\database;

use shCore\error\CoreException;
use PDO;


class DatabasePdo implements DatabaseInterface
{
    protected $connect;

    protected $config;

    /**
     * Инициализация свойств класса
     * DatabasePdo constructor.
     * @param DatabaseConfigPdo $config
     */
    public function __construct(DatabaseConfigPdo &$config)
    {
        $this->config = $config;
        $this->connect = new PDO(
            $config->getDSN(),
            $config->username,
            $config->password,
            $config->options
        );
    }

    /**
     * @param $query
     * @return ResultInterface|ResultPdo
     * @throws CoreException
     */
    public function query($query) {
        $res = $this->connect->query($query);
        if($res === false) {
            throw new CoreException('Database error: ' . var_export($this->error(), true));
        }

        return new ResultPdo($res, $this->insertId());
    }


    /**
     * Выполняет подготовленный запрос
     *
     * @param $query
     * @param array $params
     * @return ResultPdo
     * @throws CoreException
     */
    public function queryPrepare($query, $params = array())
    {
        $res = $this->connect->prepare($query);
        if ($res === false) {
            $error = $this->error();
            throw new CoreException('Database prepare error: ' . var_export($error, true));
        }

        $r = $res->execute($params);
        if ($r === false) {
            $error = $res->errorInfo();
            throw new CoreException('Database execute error: ' . var_export($error, true));
        }

        return new ResultPdo($res, $this->insertId());
    }


    public function error()
    {
        if(!$this->connect->errorCode()) return false;
        return array(
            'message' => $this->connect->errorInfo(),
            'code' => $this->connect->errorCode()
        );
    }

    /**
     * @return string
     */
    public function insertId()
    {
        return $this->connect->lastInsertId();
    }


}