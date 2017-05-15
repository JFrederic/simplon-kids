<?php
namespace tests;
use simplonkids\model\Timetable;

/**
 * Created by PhpStorm.
 * User: Frederic Jouan
 * Date: 11/05/2017
 * Time: 13:52
 */
class TimetableTest extends Setup
{

    public $timetable;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        $this->timetable = new Timetable($this->getConnection());
        parent::__construct($name, $data, $dataName);
    }

    public function testInsertTimeTable(){

        $expected = count($this->timetable->fetchAll())+1;

        $this->timetable->setStartAt("2017-05-15 00:00:00");
        $this->timetable->setEndAt("2017-05-25 00:00:00");
        $this->timetable->setEnable(0);
        $this->timetable->setWorkshopId(1);
        $this->timetable->addTimetable();


        $actual = count($this->timetable->fetchAll());
        $this->assertEquals($expected,$actual);

        $sql = 'DELETE FROM timetable WHERE :id = id';
        $this->prepareExecute($sql,[':id'=> $this->timetable->getId()]);

    }

}