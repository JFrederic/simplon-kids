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

}