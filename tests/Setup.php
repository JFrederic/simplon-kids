<?php
/**
 * Created by PhpStorm.
 * User: Frederic Jouan
 * Date: 13/05/2017
 * Time: 22:14
 */

namespace tests;


use PHPUnit\Framework\TestCase;
use PDO;

class Setup extends TestCase
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

}