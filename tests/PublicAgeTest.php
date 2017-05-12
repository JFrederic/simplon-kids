<?php

/**
 * Created by PhpStorm.
 * User: Frederic Jouan
 * Date: 11/05/2017
 * Time: 14:26
 */
class PublicAgeTest extends \PHPUnit\Framework\TestCase
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

    public function testFindAll()
    {
        $public_age = new \simplonkids\model\PublicAge();
        $actual = $public_age->findAll(PDO::FETCH_ASSOC);
        $expected = array(
            array('id' => '1','start' => '4','end' => '8'),
            array('id' => '2','start' => '8','end' => '12'),
            array('id' => '3','start' => '12','end' => '16')
        );
        $this->assertEquals($expected, $actual);
    }
}