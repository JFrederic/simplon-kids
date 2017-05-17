<?php
namespace tests;
/**
 * Created by PhpStorm.
 * User: Frederic Jouan
 * Date: 10/05/2017
 * Time: 08:40
 */

use PHPUnit\Framework\TestCase;
use simplonkids\model\Workshop;
use PDO;

class WorkshopTest extends Setup
{
    public $workshop;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        $this->workshop = new Workshop($this->getConnection());
        parent::__construct($name, $data, $dataName);
    }

    public function testFindAll()
    {
        $actual = $this->workshop->findAll();
        $expected = array(
            array('id' => '1','title' => 'Code combat','description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ','price' => '9.99','max_kids' => '30','image' => 'Workshop1.jpg','visible' => '0','public_age_id' => '2','establishment_id' => '1','workshop_category_id' => '3','id' => '1','startAt' => '2017-05-15 00:00:00','endAt' => '2017-05-25 00:00:00','enable' => '0','workshop_id' => '1','id' => '2','start' => '8','end' => '12','id' => '1','name' => 'Simplon Reunion','address_id' => '5','id' => '3','name' => 'Difficile','id' => '5','address' => '15 rue pomme','complement' => 'endroit perdus','city' => 'Bras-Panon','zipcode' => '97431','id' => '1','category' => 'Difficile','establishment' => 'Simplon Reunion'),
            array('id' => '2','title' => 'Scratch','description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ','price' => '20.00','max_kids' => '15','image' => 'Workshop1.jpg','visible' => '0','public_age_id' => '1','establishment_id' => '1','workshop_category_id' => '1','id' => '2','startAt' => '2017-06-15 00:00:00','endAt' => '2017-06-25 00:00:00','enable' => '0','workshop_id' => '2','id' => '1','start' => '4','end' => '8','id' => '1','name' => 'Simplon Reunion','address_id' => '5','id' => '1','name' => 'Debutant','id' => '5','address' => '15 rue pomme','complement' => 'endroit perdus','city' => 'Bras-Panon','zipcode' => '97431','id' => '2','category' => 'Debutant','establishment' => 'Simplon Reunion'),
            array('id' => '3','title' => 'Algo','description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ','price' => '20.00','max_kids' => '10','image' => 'Workshop1.jpg','visible' => '0','public_age_id' => '1','establishment_id' => '1','workshop_category_id' => '4','id' => '3','startAt' => '2017-07-15 00:00:00','endAt' => '2017-07-25 00:00:00','enable' => '0','workshop_id' => '3','id' => '1','start' => '4','end' => '8','id' => '1','name' => 'Simplon Reunion','address_id' => '5','id' => '4','name' => 'Insane','id' => '5','address' => '15 rue pomme','complement' => 'endroit perdus','city' => 'Bras-Panon','zipcode' => '97431','id' => '3','category' => 'Insane','establishment' => 'Simplon Reunion')
        );
        $this->assertEquals($expected, $actual);
    }

    public function testAddWorkshop() {

        $expected = count($this->workshop->fetchAll())+1;

        $this->workshop->setTitle("Initiation à la robotique");
        $this->workshop->setDescription("Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.");
        $this->workshop->setPrice(19.50);
        $this->workshop->setMaxKids(20);
        $this->workshop->setImage("Workshop.jpg");
        $this->workshop->setVisible(0);
        $this->workshop->setPublicAgeId(1);
        $this->workshop->setEstablishmentId(1);
        $this->workshop->setWorkshopCategoryId(1);
        $this->workshop->addWorkshop();

        $actual = count($this->workshop->fetchAll());
        $this->assertEquals($expected,$actual);
        $this->workshop->delete($this->workshop->getId());
    }

    public function testFindWorkshopById() {

        $result = $this->workshop->findWorkshopById(1);
        $expected =
            array('id' => '1','title' => 'Code combat','description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ','price' => '9.99','max_kids' => '30','image' => 'Workshop1.jpg','visible' => '0','public_age_id' => '2','establishment_id' => '1','workshop_category_id' => '3','id' => '1','startAt' => '2017-05-15 00:00:00','endAt' => '2017-05-25 00:00:00','enable' => '0','workshop_id' => '1','id' => '2','start' => '8','end' => '12','id' => '1','name' => 'Simplon Reunion','address_id' => '5','id' => '3','name' => 'Difficile','id' => '1','establishment' => 'Simplon Reunion')
        ;

        $this->assertEquals($expected, $result);


    }

    public function testDeleteWorkshop() {

        $this->workshop->setTitle("Initiation à la robotique");
        $this->workshop->setDescription("Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.");
        $this->workshop->setPrice(19.50);
        $this->workshop->setMaxKids(20);
        $this->workshop->setImage("Workshop.jpg");
        $this->workshop->setVisible(0);
        $this->workshop->setPublicAgeId(1);
        $this->workshop->setEstablishmentId(1);
        $this->workshop->setWorkshopCategoryId(1);
        $this->workshop->addWorkshop();

        $expected = count($this->workshop->fetchAll()) - 1;
        $this->workshop->delete($this->workshop->getId());
        $actual = count($this->workshop->fetchAll());
        $this->assertEquals($expected,$actual);


    }




}

