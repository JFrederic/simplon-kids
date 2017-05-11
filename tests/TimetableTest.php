<?php

/**
 * Created by PhpStorm.
 * User: Frederic Jouan
 * Date: 11/05/2017
 * Time: 13:52
 */
class TimetableTest extends \PHPUnit\Framework\TestCase
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

    public function testInsertTimeTable(){

        $database = $this->getConnection();
        $sql = 'INSERT INTO timetable(startAt, endAt, enable, workshop_id) 
                VALUES ( :startAt , :endAt , :enable ,:workshop_id)';
        $timetable_arguments = [
            ':startAt' => "2017-05-15 00:00:00",
            ':endAt' => "2017-05-25 00:00:00",
            ':enable' => 0,
            ':workshop_id' => 1,
        ];

        $queryTable = $database->prepare($sql);
        $queryTable->execute($timetable_arguments);
        $lastId = $database->lastInsertId();
        $expected = [
            'id'=> $lastId,
            'startAt' => "2017-05-15 00:00:00",
            'endAt' => "2017-05-25 00:00:00",
            'enable' => 0,
            'workshop_id' => 1,
        ];

        $sql2 = 'SELECT * FROM timetable WHERE :id = id';
        $arguments = [
            ':id' => $lastId
        ];
        $query = $database->prepare($sql2);
        $query->execute($arguments);
        $results = $query->fetch(PDO::FETCH_ASSOC);
        $this->assertEquals($expected,$results);

        $sql3 = 'DELETE FROM timetable WHERE :id = id';
        $delete = $database->prepare($sql3);
        $delete->execute($arguments);
    }

}