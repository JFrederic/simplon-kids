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
        $sql = 'INSERT INTO parent(firstname, lastname, email, telephone, address_id) VALUES(:firstname,:lastname,:email,:telephone,:address_id)';
        $parent_arguments = [
            ':firstname' => "fred",
            ':lastname' => "jouan",
            ':email' => "fredjouan@gmail.fr",
            ':telephone' => "0692325840",
            ':address_id' => 3,
        ];

        $queryTable = $database->prepare($sql);
        $queryTable->execute($parent_arguments);
        $lastId = $database->lastInsertId();
        $expected = [
            'id' => $lastId,
            'firstname' => "fred",
            'lastname' => "jouan",
            'email' => "fredjouan@gmail.fr",
            'telephone' => "0692325840",
            'address_id' => 3,
        ];

        $sql2 = 'SELECT * FROM parent WHERE :id = id';
        $arguments = [
            ':id' => $lastId
        ];
        $query = $database->prepare($sql2);
        $query->execute($arguments);
        $results = $query->fetch(PDO::FETCH_ASSOC);
        $this->assertEquals($expected,$results);

        $sql3 = 'DELETE FROM parent WHERE :id = id';
        $delete = $database->prepare($sql3);
        $delete->execute($arguments);
    }

}