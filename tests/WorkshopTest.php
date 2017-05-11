<?php

/**
 * Created by PhpStorm.
 * User: Frederic Jouan
 * Date: 10/05/2017
 * Time: 08:40
 */

use PHPUnit\DbUnit\TestCaseTrait;

class WorkshopTest extends \PHPUnit\Framework\TestCase
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



    public function testFindAll()
    {

        $database = $this->testGetConnection();
        $sql = 'SELECT * , W.id,  E.name AS "establishment" FROM `workshop` W
                INNER JOIN timetable T
                ON  T.workshop_id = W.id
                INNER JOIN public_age P
                ON W.public_age_id = P.id
                INNER JOIN establishment E
                ON W.establishment_id = E.id
                INNER JOIN address A
                ON E.address_id = A.id
                INNER JOIN workshop_category WC
                ON W.workshop_category_id = WC.id
                
                ';
        $queryTable = $database->prepare($sql);
        $queryTable->execute();
        $result = $queryTable->fetchAll(PDO::FETCH_ASSOC);
        $expectedTable = [
            [
                'id' => '1',
                'title' => 'Code combat',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ',
                'price' => '9.99',
                'max_kids' => '30',
                'image' => 'Workshop1.jpg',
                'visible' => '0',
                'public_age_id' => '2',
                'establishment_id' => '1',
                'workshop_category_id' => '3',
                'startAt' => '2017-05-15 00:00:00',
                'endAt' => '2017-05-25 00:00:00',
                'enable' => '0',
                'workshop_id' => '1',
                'start' => '8',
                'end' => '12',
                'address_id' => '5',
                'address' => '15 rue pomme',
                'complement' => 'endroit perdus',
                'city' => 'Bras-Panon',
                'zipcode' => '97431',
                'establishment' => 'Simplon Reunion',
                'name' => 'Difficile',
            ],
            [
                'id' => '2',
                'title' => 'Scratch',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ',
                'price' => '20',
                'max_kids' => '15',
                'image' => 'Workshop1.jpg',
                'visible' => '0',
                'public_age_id' => '1',
                'establishment_id' => '1',
                'workshop_category_id' => '1',
                'startAt' => '2017-06-15 00:00:00',
                'endAt' => '2017-06-25 00:00:00',
                'enable' => '0',
                'workshop_id' => '2',
                'start' => '4',
                'end' => '8',
                'address_id' => '5',
                'address' => '15 rue pomme',
                'complement' => 'endroit perdus',
                'city' => 'Bras-Panon',
                'zipcode' => '97431',
                'establishment' => 'Simplon Reunion',
                'name' => 'Debutant',
            ],
            [
                'id' => '3',
                'title' => 'Algo',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ',
                'price' => '20',
                'max_kids' => '10',
                'image' => 'Workshop1.jpg',
                'visible' => '0',
                'public_age_id' => '1',
                'establishment_id' => '1',
                'workshop_category_id' => '4',
                'startAt' => '2017-07-15 00:00:00',
                'endAt' => '2017-07-25 00:00:00',
                'enable' => '0',
                'workshop_id' => '3',
                'start' => '4',
                'end' => '8',
                'address_id' => '5',
                'address' => '15 rue pomme',
                'complement' => 'endroit perdus',
                'city' => 'Bras-Panon',
                'zipcode' => '97431',
                'establishment' => 'Simplon Reunion',
                'name' => 'Insane',
            ],
        ];
        $this->assertEquals($expectedTable, $result);

    }

    public function testAddWorkshop() {
        $database = $this->testGetConnection();
        $sql = 'INSERT INTO workshop(title,description,price,max_kids,image,visible,public_age_id,establishment_id,workshop_category_id)
                VALUES (:title,:description,:price,:max_kids,:image,:visible,:public_age_id,:establishment_id,:workshop_category_id)';
        $workshop_param = [
            ':title' => "Initiation a la robotique",
            ':description' => "Salut ceci est une description",
            ':price' =>19.50,
            ':max_kids' => 20,
            ':image' => "Workshop1,jpg",
            ':visible' => 0,
            ':public_age_id' => 1,
            ':establishment_id' => 1,
            ':workshop_category_id' => 1,
        ];

        $queryTable = $database->prepare($sql);
        $queryTable->execute($workshop_param);
        $lastId = $database->lastInsertId();
        $expected = [
            'id' => $lastId,
            'title' => "Initiation a la robotique",
            'description' => "Salut ceci est une description",
            'price' => 19.50,
            'max_kids' => 20,
            'image' => "Workshop1,jpg",
            'visible' => 0,
            'public_age_id' => 1,
            'establishment_id' => 1,
            'workshop_category_id' => 1,
        ];

        $sql2 = 'SELECT *  FROM workshop WHERE :id = id';
        $arguments = [
            ':id' => $lastId
        ];
        $query = $database->prepare($sql2);
        $query->execute($arguments);
        $results = $query->fetch(PDO::FETCH_ASSOC);
        $this->assertEquals($expected,$results);

        $sql3 = 'DELETE FROM workshop WHERE :id = id';
        $delete = $database->prepare($sql3);
        $delete->execute($arguments);


    }

    public function testFindWorkshopById() {

        $database = $this->testGetConnection();
        $sql = 'SELECT * , W.id,  E.name as establishment FROM workshop W 
                JOIN timetable T 
                ON  T.workshop_id = W.id
                JOIN public_age P 
                ON W.public_age_id = P.id
                JOIN establishment E 
                ON W.establishment_id = E.id
                JOIN workshop_category WC 
                ON W.workshop_category_id = WC.id
                WHERE :id = W.id';

        $queryTable = $database->prepare($sql);
        $arguments = [
            ':id' => 1
        ];
        $queryTable->execute($arguments);
        $result = $queryTable->fetchAll(PDO::FETCH_ASSOC);
        $expected = array(
            array('id' => '1','title' => 'Code combat','description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ','price' => '9.99','max_kids' => '30','image' => 'Workshop1.jpg','visible' => '0','public_age_id' => '2','establishment_id' => '1','workshop_category_id' => '3','id' => '1','startAt' => '2017-05-15 00:00:00','endAt' => '2017-05-25 00:00:00','enable' => '0','workshop_id' => '1','id' => '2','start' => '8','end' => '12','id' => '1','name' => 'Simplon Reunion','address_id' => '5','id' => '3','name' => 'Difficile','id' => '1','establishment' => 'Simplon Reunion')
        );

        $this->assertEquals($expected, $result);


    }


}

