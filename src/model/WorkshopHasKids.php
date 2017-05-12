<?php
/**
 * Created by PhpStorm.
 * User: Frederic Jouan
 * Date: 11/05/2017
 * Time: 15:09
 */

namespace simplonkids\model;


use simplonkids\classes\Model;

class WorkshopHasKids extends Model
{
    private $workshop_id;
    private $kid_id;


    public function setKidsOnWorkshop() {
        $sql = 'INSERT INTO workshop_has_kid(workshop_id, kid_id, has_participated, validated) VALUES 
                (:workshop_id,:kid_id,:has_participated,:validated)
              ';
        $arguments = [
            ':workshop_id' => $this->getWorkshopId(),
            ':kid_id' => $this->getKidId(),
            ':has_participated' => 1,
            ':validated' => 0,
        ];

        $stmt = $this->prepareExecute($sql,$arguments);
    }

    public function getWorkshopId(){
        return $this->workshop_id;
    }
    public function setWorkshopId($workshop_id){
        $this->workshop_id = $workshop_id;
    }

    /**
     * @param mixed $kid_id
     */
    public function setKidId($kid_id)
    {
        $this->kid_id = $kid_id;
    }
    /**
     * @return mixed
     */
    public function getKidId()
    {
        return $this->kid_id;
    }

}