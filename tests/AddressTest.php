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

    public function testInsertAddress(){
        $database = $this->getConnection();
        $values = [
            'address' => "26 rue ajoupa",
            'complement' => "cressonniere",
            'city' => "Saint-andre",
            'zipcode' => "97440",
        ];
        $address = new \simplonkids\model\Address();
        $address->addAddress($values);
        $lastId = $address->lastId();

        $expected = [
            'id' => $lastId,
            'address' => "26 rue ajoupa",
            'complement' => "cressonniere",
            'city' => "Saint-andre",
            'zipcode' => "97440",
        ];

        $sql = 'SELECT * FROM address WHERE :id = id';
        $arguments = [
            ':id' => $lastId
        ];
        $query = $database->prepare($sql);
        $query->execute($arguments);
        $results = $query->fetch(PDO::FETCH_ASSOC);
        $this->assertEquals($expected,$results);

        $sql = 'DELETE FROM address WHERE :id = id';
        $delete = $database->prepare($sql);
        $delete->execute($arguments);
    }

}