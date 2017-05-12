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

    public function testInsertKid(){
        $database = $this->getConnection();
        $kids_arguments = [
            'kid_firstname' => "fred",
            'kid_lastname' => "jouan",
            'birthday' => "1995-05-24",
            'classroom' => "CP1",
        ];
        $kid = new \simplonkids\model\Kid();
        $kid->addKid($kids_arguments);
        $lastId = $kid->lastId();
        $expected = [
            'id' => $lastId,
            'firstname' => "fred",
            'lastname' => "jouan",
            'birthday' => "1995-05-24",
            'classroom' => "CP1",
        ];

        $sql = 'SELECT * FROM kid WHERE :id = id';
        $arguments = [
            ':id' => $lastId
        ];
        $query = $database->prepare($sql);
        $query->execute($arguments);
        $results = $query->fetch(PDO::FETCH_ASSOC);
        $this->assertEquals($expected,$results);

        $sql = 'DELETE FROM kid WHERE :id = id';
        $delete = $database->prepare($sql);
        $delete->execute($arguments);
    }


}