<?php
namespace tests;
use simplonkids\model\PublicAge;

/**
 * Created by PhpStorm.
 * User: Frederic Jouan
 * Date: 11/05/2017
 * Time: 14:26
 */
class PublicAgeTest extends Setup
{
    public $public_age;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        $this->public_age = new PublicAge($this->getConnection());
        parent::__construct($name, $data, $dataName);
    }


    public function testFindAll()
    {

        $actual = $this->public_age->findAll();
        $expected = array(
            array('id' => '1','start' => '4','end' => '8'),
            array('id' => '2','start' => '8','end' => '12'),
            array('id' => '3','start' => '12','end' => '16')
        );
        $this->assertEquals($expected, $actual);
    }
}