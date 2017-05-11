<?php
/**
 * Created by PhpStorm.
 * User: jouan
 * Date: 18/04/17
 * Time: 18:24
 */

namespace simplonkids\classes;
use PDO;
use PDOException;


abstract class Sql
{
    public $hostname = 'localhost';
    public $db_username = 'root';
    public $db_password = '';
    public $db_name = 'simplonkids';
    public $connection;

    /**
     * @return mixed
     */
    public function getConnection()
    {
        try {
            $this->connection = new PDO("mysql:host=$this->hostname;dbname=$this->db_name",
                $this->db_username,
                $this->db_password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        return $this->connection;
    }

    public function prepareExecute($sql,$arguments){

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($arguments);

        return $stmt;
    }

    public function lastId()
    {
        return $this->connection->lastInsertId();
    }



}