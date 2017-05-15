<?php
namespace tests;
use simplonkids\model\Address;

/**
 * Created by PhpStorm.
 * User: Frederic Jouan
 * Date: 11/05/2017
 * Time: 13:58
 */
class AddressTest extends Setup
{
   public $address;
   public function __construct($name = null, array $data = [], $dataName = '')
   {
       $this->address = new Address($this->getConnection());
       parent::__construct($name, $data, $dataName);
   }

    public function testInsertAddress(){

        $sql = 'SELECT * FROM address';
        $expected = count($this->prepareExecute($sql,[])->fetchAll(\PDO::FETCH_ASSOC))+1;

        $this->address->setAddress("26 rue ajoupa");
        $this->address->setComplement("cressonniere");
        $this->address->setCity("Saint-andre");
        $this->address->setZipcode("97440");
        $this->address->addAddress();

        $actual = count($this->prepareExecute($sql,[])->fetchAll(\PDO::FETCH_ASSOC));
        $this->assertEquals($expected,$actual);

        $sql = 'DELETE FROM address WHERE :id = id';
        $this->prepareExecute($sql,[':id' => $this->address->getId()]);
    }

}