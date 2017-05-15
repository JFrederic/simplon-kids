<?php
/**
 * Created by PhpStorm.
 * User: Frederic Jouan
 * Date: 14/05/2017
 * Time: 00:46
 */

namespace tests;


use simplonkids\model\KidHasParent;
use simplonkids\model\Kid;
use simplonkids\model\Parents;

class KidHasParentTest extends Setup
{
    public $kid_has_parent;


    public function __construct($name = null, array $data = [], $dataName = '')
    {
        $this->kid_has_parent = new KidHasParent($this->getConnection());
        parent::__construct($name, $data, $dataName);
    }

    public function testKidHasParent() {

        $sql = 'SELECT * FROM kid_has_parent';
        $expected = count($this->prepareExecute($sql,[])->fetchAll())+1;
        $this->kid_has_parent->setKidId(1);
        $this->kid_has_parent->setParentId(1);
        $this->kid_has_parent->setKidHasParent();

        $actual = count($this->prepareExecute($sql,[])->fetchAll());
        $this->assertEquals($expected,$actual);

        $sql = 'DELETE FROM kid_has_parent WHERE kid_id = 1 AND parent_id = 1';
        $stmt = $this->prepareExecute($sql,[]);
    }

}