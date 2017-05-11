<?php

/**
 * Created by PhpStorm.
 * User: Frederic Jouan
 * Date: 11/05/2017
 * Time: 14:26
 */
class Workshop_categoryTest extends \PHPUnit\Framework\TestCase
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
        $sql = 'SELECT * FROM workshop_category';
        $queryTable = $database->prepare($sql);
        $queryTable->execute();
        $result = $queryTable->fetchAll(PDO::FETCH_ASSOC);

        $expected = array(
            array('id' => '1','name' => 'Debutant'),
            array('id' => '2','name' => 'Intermediaire'),
            array('id' => '3','name' => 'Difficile'),
            array('id' => '4','name' => 'Insane')
        );


        $this->assertEquals($expected, $result);

    }
}