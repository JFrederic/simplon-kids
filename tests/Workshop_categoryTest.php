<?php
namespace tests;
use simplonkids\model\WorkshopCategory;

/**
 * Created by PhpStorm.
 * User: Frederic Jouan
 * Date: 11/05/2017
 * Time: 14:26
 */
class Workshop_categoryTest extends Setup
{
    public $workshop_category;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        $this->workshop_category = new WorkshopCategory($this->getConnection());
        parent::__construct($name, $data, $dataName);
    }


    public function testFindAll()
    {

        $actual = $this->workshop_category->findAll();
        $expected = array(
            array('id' => '1','name' => 'Debutant'),
            array('id' => '2','name' => 'Intermediaire'),
            array('id' => '3','name' => 'Difficile'),
            array('id' => '4','name' => 'Insane')
        );
        $this->assertEquals($expected, $actual);
    }
}