<?php

namespace App\Model;

use App\System\DatabaseConnector;

class BaseModel
{
    protected $dbConnection;

    public function __construct()
    {
        $this->dbConnection = (new DatabaseConnector())->getConnection();
    }

    /**
     * @param $sql
     * @return mixed
     */
    public function query($sql)
    {
        try {
            return $this->dbConnection->query($sql);
        } catch (\PDOException $e) {
            trigger_error('Error: ' . $e->getMessage() . ' Error Code : ' . $e->getCode() . ' <br />' . $sql);
            exit();
        }
    }

    /**
     * @param $value
     * @return mixed
     */
    public function escape($value)
    {
        return $this->dbConnection->quote($value);
    }
}