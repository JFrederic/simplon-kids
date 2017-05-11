<?php

/**
 * Created by PhpStorm.
 * User: Frederic Jouan
 * Date: 11/05/2017
 * Time: 14:26
 */
class EstablishmentTest extends \PHPUnit\Framework\TestCase
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

    public function testFindAll() {

        $database = $this->getConnection();
        $sql = 'SELECT * ,E.id as id FROM establishment E
                JOIN address A
                ON E.address_id = A.id';
        $queryTable = $database->prepare($sql);
        $queryTable->execute();
        $result = $queryTable->fetchAll(PDO::FETCH_ASSOC);

        $expected = array(
            array('id' => '1','name' => 'Simplon Reunion','address_id' => '5','id' => '5','address' => '15 rue pomme','complement' => 'endroit perdus','city' => 'Bras-Panon','zipcode' => '97431','id' => '1')
        );

        $this->assertEquals($expected, $result);

    }
}