<?php

/**
 * Created by PhpStorm.
 * User: Frederic Jouan
 * Date: 11/05/2017
 * Time: 13:27
 */
class KidTest extends \PHPUnit\Framework\TestCase
{

    private $connection;

    public function testGetConnection()
    {
        try {
            $this->connection = new PDO('mysql:host=localhost;dbname=simplonkids', 'root', '');
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
        $this->assertNotNull($this->connection);
        return $this->connection;
    }

    public function testInsertKid(){
        $database = $this->testGetConnection();
        $sql = 'INSERT INTO kid(firstname, lastname, birthday, classroom) VALUES(:firstname,:lastname,:birthday,:classroom)';
        $kids_arguments = [
            ':firstname' => "fred",
            ':lastname' => "jouan",
            ':birthday' => "1995-05-24",
            ':classroom' => "CP1",
        ];

        $queryTable = $database->prepare($sql);
        $queryTable->execute($kids_arguments);
        $lastId = $database->lastInsertId();
        $expected = [
            'id' => $lastId,
            'firstname' => "fred",
            'lastname' => "jouan",
            'birthday' => "1995-05-24",
            'classroom' => "CP1",
        ];

        $sql2 = 'SELECT * FROM kid WHERE :id = id';
        $arguments = [
            ':id' => $lastId
        ];
        $query = $database->prepare($sql2);
        $query->execute($arguments);
        $results = $query->fetch(PDO::FETCH_ASSOC);
        $this->assertEquals($expected,$results);

        $sql3 = 'DELETE FROM kid WHERE :id = id';
        $delete = $database->prepare($sql3);
        $delete->execute($arguments);
    }


}