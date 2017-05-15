<?php
namespace tests;
use simplonkids\model\Establishment;

/**
 * Created by PhpStorm.
 * User: Frederic Jouan
 * Date: 11/05/2017
 * Time: 14:26
 */
class EstablishmentTest extends Setup
{
    public $establishment;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        $this->establishment = new Establishment($this->getConnection());
        parent::__construct($name, $data, $dataName);
    }


    public function testFindAll()
    {

        $actual = $this->establishment->findAll();
        $expected = array(
            array('id' => '1','name' => 'Simplon Reunion','address_id' => '5','id' => '5','address' => '15 rue pomme','complement' => 'endroit perdus','city' => 'Bras-Panon','zipcode' => '97431','id' => '1')
        );
        $this->assertEquals($expected, $actual);
    }

}