<?php
namespace tests;
use simplonkids\model\Kid;

/**
 * Created by PhpStorm.
 * User: Frederic Jouan
 * Date: 11/05/2017
 * Time: 13:27
 */
class KidTest extends Setup
{

    public $kid;
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        $this->kid = new Kid($this->getConnection());
        parent::__construct($name, $data, $dataName);
    }

    public function testInsertAddress(){

        $sql = 'SELECT * FROM kid';
        $expected = count($this->prepareExecute($sql,[])->fetchAll(\PDO::FETCH_ASSOC))+1;

        $this->kid->setFirstname("Robert");
        $this->kid->setLastname("Darude");
        $this->kid->setBirthday("1995-05-24");
        $this->kid->setClassroom("CE2");
        $this->kid->addKid();

        $actual = count($this->prepareExecute($sql,[])->fetchAll(\PDO::FETCH_ASSOC));
        $this->assertEquals($expected,$actual);

        $sql = 'DELETE FROM kid WHERE :id = id';
        $this->prepareExecute($sql,[':id' => $this->kid->getId()]);
    }


}