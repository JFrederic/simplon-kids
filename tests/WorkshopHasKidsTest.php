<?php
/**
 * Created by PhpStorm.
 * User: Frederic Jouan
 * Date: 13/05/2017
 * Time: 22:03
 */

namespace tests;


use PHPUnit\Framework\TestCase;
use simplonkids\model\Kid;
use simplonkids\model\Workshop;
use simplonkids\model\WorkshopHasKids;

class WorkshopHasKidsTest extends Setup
{
    public $workshop_has_kid;


    public function __construct($name = null, array $data = [], $dataName = '')
    {
        $this->workshop_has_kid = new WorkshopHasKids($this->getConnection());
        parent::__construct($name, $data, $dataName);
    }

    public function testSetKidsOnWorkshop() {

        $sql = 'SELECT * FROM workshop_has_kid';
        $expected = count($this->prepareExecute($sql,[])->fetchAll())+1;
        $this->workshop_has_kid->setKidId(1);
        $this->workshop_has_kid->setWorkshopId(1);
        $this->workshop_has_kid->setHasParticipated(1);
        $this->workshop_has_kid->setValidated(0);
        $this->workshop_has_kid->setKidsOnWorkshop();

        $actual = count($this->prepareExecute($sql,[])->fetchAll());
        $this->assertEquals($expected,$actual);

        $sql = 'DELETE FROM workshop_has_kid WHERE workshop_id = 1 AND kid_id = 1';
        $stmt = $this->prepareExecute($sql,[]);
    }

    public function testFindByNotValidated(){

        $actual = $this->workshop_has_kid->findByNotValidated();
        $expected = array(
            array('workshop_id' => '1','kid_id' => '2','has_participated' => '0','validated' => '0'),
            array('workshop_id' => '2','kid_id' => '4','has_participated' => '0','validated' => '0'),
            array('workshop_id' => '3','kid_id' => '1','has_participated' => '0','validated' => '0')
        );
        $this->assertEquals($expected,$actual);

    }

    public function testValidation() {

        $sql = 'SELECT * FROM workshop_has_kid WHERE validated = :validated AND kid_id = :kid_id AND workshop_id = :workshop_id';
        $arguments = [
            ':validated' => 0,
            ':kid_id' => 1,
            ':workshop_id' => 1,
        ];
        $actual = $this->prepareExecute($sql,$arguments)->fetch(\PDO::FETCH_ASSOC);
        $this->workshop_has_kid->setValidated(1);
        $this->workshop_has_kid->setKidId(1);
        $this->workshop_has_kid->setWorkshopId(1);
        $this->workshop_has_kid->validation();

        $expected = $this->prepareExecute($sql,[':validated'=>1,':kid_id'=>1,':workshop_id'=>1])->fetch(\PDO::FETCH_ASSOC);

        $this->assertEquals($expected,$actual);

        $this->workshop_has_kid->setValidated(0);
        $this->workshop_has_kid->setKidId(1);
        $this->workshop_has_kid->setWorkshopId(1);
        $this->workshop_has_kid->validation();

    }

}