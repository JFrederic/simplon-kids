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
    protected $workshop_id;
    protected $kid_id;
    protected $has_participated;
    protected $validated;


    public function setKidsOnWorkshop() {
        $sql = 'INSERT INTO workshop_has_kid(workshop_id, kid_id, has_participated, validated) VALUES 
                (:workshop_id,:kid_id,:has_participated,:validated)
              ';


        $arguments = [
            ':workshop_id' => $this->getWorkshopId(),
            ':kid_id' => $this->getKidId(),
            ':has_participated' => $this->getHasParticipated(),
            ':validated' => $this->getValidated(),
        ];

        $stmt = $this->prepareExecute($sql,$arguments);
    }

    public function findByNotValidated() {
        $sql = 'SELECT * FROM workshop_has_kid WHERE validated = :validated';
        $arguments = [
            ':validated' => 0,
        ];
        return $this->prepareExecute($sql,$arguments)->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function validation() {
        $sql = 'UPDATE workshop_has_kid SET validated = :validated 
                WHERE kid_id = :kid_id AND workshop_id = :workshop_id
               ';
        $arguments = [
            'validated' => $this->getValidated(),
            'kid_id' => $this->getKidId(),
            'workshop_id' => $this->getWorkshopId(),
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

    /**
     * @return mixed
     */
    public function getValidated()
    {
        return $this->validated;
    }

    /**
     * @param mixed $validated
     */
    public function setValidated($validated)
    {
        $this->validated = $validated;
    }

    /**
     * @return mixed
     */
    public function getHasParticipated()
    {
        return $this->has_participated;
    }

    /**
     * @param mixed $has_participated
     */
    public function setHasParticipated($has_participated)
    {
        $this->has_participated = $has_participated;
    }
}