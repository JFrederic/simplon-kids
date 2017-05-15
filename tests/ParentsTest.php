<?php
namespace tests;
use simplonkids\model\Parents;

/**
 * Created by PhpStorm.
 * User: Frederic Jouan
 * Date: 11/05/2017
 * Time: 13:52
 */
class ParentsTest extends Setup
{
    public $parent;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        $this->parent = new Parents($this->getConnection());
        parent::__construct($name, $data, $dataName);
    }

    public function testInsertParent(){

        $sql = 'SELECT * FROM parent';
        $expected =  count($this->prepareExecute($sql,[])->fetchAll(\PDO::FETCH_ASSOC)) + 1;

        $this->parent->setFirstname("fred");
        $this->parent->setLastname("jouan");
        $this->parent->setEmail("fredjouan@gmail.fr");
        $this->parent->setTelephone("0692325840");
        $this->parent->setAddressId(1);
        $this->parent->addParent();

        $actual = count($this->prepareExecute($sql,[])->fetchAll(\PDO::FETCH_ASSOC));

        $this->assertEquals($expected,$actual);

        $sql = 'DELETE FROM parent WHERE :id = id';
        $this->prepareExecute($sql,[":id" => $this->parent->getId()]);
    }

}