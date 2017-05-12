<?php

/**
 * Created by PhpStorm.
 * User: Frederic Jouan
 * Date: 11/05/2017
 * Time: 13:52
 */
class ParentsTest extends \PHPUnit\Framework\TestCase
{
    private $connection;

    public function getConnection()
    {
        try {
            $this->connection = new PDO('mysql:host=localhost;dbname=simplonkids', 'root', '');
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }

        return $this->connection;
    }

    public function testInsertParent(){

        $database = $this->getConnection();
        $parent_arguments = [
            'parent_firstname' => "fred",
            'parent_lastname' => "jouan",
            'email' => "fredjouan@gmail.fr",
            'telephone' => "0692325840",
            'address_id' => 3,
        ];
        $parent = new \simplonkids\model\Parents();
        $parent->addParent($parent_arguments);
        $lastId = $parent->lastId();

        $expected = [
            'id' => $lastId,
            'firstname' => "jouan",
            'lastname' => "jouan",
            'email' => "fredjouan@gmail.fr",
            'telephone' => "0692325840",
            'address_id' => 3,
        ];

        $sql = 'SELECT * FROM parent WHERE :id = id';
        $arguments = [
            ':id' => $lastId
        ];
        $query = $database->prepare($sql);
        $query->execute($arguments);
        $results = $query->fetch(PDO::FETCH_ASSOC);
        $this->assertEquals($expected,$results);

        $sql = 'DELETE FROM parent WHERE :id = id';
        $delete = $database->prepare($sql);
        $delete->execute($arguments);
    }

}