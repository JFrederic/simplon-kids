<?php

/**
 * Created by PhpStorm.
 * User: Frederic Jouan
 * Date: 11/05/2017
 * Time: 13:58
 */
class AddressTest extends \PHPUnit\Framework\TestCase
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

    public function testInsertAddress(){
        $database = $this->testGetConnection();
        $sql = 'INSERT INTO address(address, complement, city, zipcode) VALUES(:address,:complement,:city,:zipcode)';
        $address_arguments = [
            ':address' => "26 rue ajoupa",
            ':complement' => "cressonniere",
            ':city' => "Saint-andre",
            ':zipcode' => "97440",
        ];

        $queryTable = $database->prepare($sql);
        $queryTable->execute($address_arguments);
        $lastId = $database->lastInsertId();
        $expected = [
            'id' => $lastId,
            'address' => "26 rue ajoupa",
            'complement' => "cressonniere",
            'city' => "Saint-andre",
            'zipcode' => "97440",
        ];

        $sql2 = 'SELECT * FROM address WHERE :id = id';
        $arguments = [
            ':id' => $lastId
        ];
        $query = $database->prepare($sql2);
        $query->execute($arguments);
        $results = $query->fetch(PDO::FETCH_ASSOC);
        $this->assertEquals($expected,$results);

        $sql3 = 'DELETE FROM address WHERE :id = id';
        $delete = $database->prepare($sql3);
        $delete->execute($arguments);
    }

}