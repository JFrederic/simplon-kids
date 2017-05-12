<?php
/**
 * Created by PhpStorm.
 * User: Frederic Jouan
 * Date: 09/05/2017
 * Time: 15:35
 */

namespace simplonkids\model;


use simplonkids\classes\Model;
use PDO;

class Workshop extends Model
{
    public $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


    public function findAll()
    {
        $sql = 'SELECT * , W.id ,  WC.name AS category , E.name AS establishment FROM `workshop` W
                JOIN timetable T 
                ON  T.workshop_id = W.id
                JOIN public_age P 
                ON W.public_age_id = P.id
                JOIN establishment E 
                ON W.establishment_id = E.id
                JOIN workshop_category WC 
                ON W.workshop_category_id = WC.id
                JOIN address A
                ON E.address_id = A.id
                ';

        $stmt = $this->prepareExecute($sql, []);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }


    public function addWorkshop($workshop)
    {

        $sql = 'INSERT INTO workshop(title,description,price,max_kids,image,visible,public_age_id,establishment_id,workshop_category_id)
                VALUES (:title,:description,:price,:max_kids,:image,:visible,:public_age_id,:establishment_id,:workshop_category_id)';

        $arguments = [
            ':title' => $workshop['title'],
            ':description' => $workshop['description'],
            ':price' => $workshop['price'],
            ':max_kids' => $workshop['max_kids'],
            ':image' => $workshop['image'],
            ':visible' => $workshop['visible'],
            ':public_age_id' => $workshop['public_age_id'],
            ':establishment_id' => $workshop['establishment_id'],
            ':workshop_category_id' => $workshop['workshop_category_id'],

        ];
        $stmt = $this->prepareExecute($sql, $arguments);

        $this->setId($this->lastId());
    }

    public function findWorkshopById($id)
    {
        $sql = 'SELECT * , W.id,  E.name AS establishment FROM workshop W 
                JOIN timetable T 
                ON  T.workshop_id = W.id
                JOIN public_age P 
                ON W.public_age_id = P.id
                JOIN establishment E 
                ON W.establishment_id = E.id
                JOIN workshop_category WC 
                ON W.workshop_category_id = WC.id
                WHERE :id = W.id';
        $arguments = [
            ':id' => $id,
        ];
        $stmt = $this->prepareExecute($sql, $arguments);
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        return $results;
    }

    public function setWorkshop($workshop, $id)
    {

        $sql = 'UPDATE workshop SET 
                title = :title ,
                description = :description,
                price = :price,
                max_kids = :max_kids,
                image = :image,
                visible = :visible,
                public_age_id = :public_age_id,
                establishment_id = :establishment_id,
                workshop_category_id = :workshop_category_id
                WHERE id = :id
                ';
        $arguments = [
            ':title' => $workshop['title'],
            ':description' => $workshop['description'],
            ':price' => $workshop['price'],
            ':max_kids' => $workshop['max_kids'],
            ':image' => $workshop['image'],
            ':visible' => $workshop['visible'],
            ':public_age_id' => $workshop['public_age_id'],
            ':establishment_id' => $workshop['establishment_id'],
            ':workshop_category_id' => $workshop['workshop_category_id'],
            ':id' => $id
        ];
        $stmt = $this->prepareExecute($sql, $arguments);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM workshop
    WHERE id = :id";

        $arguments = [
            ':id' => $id
        ];
        $stmt = $this->prepareExecute($sql, $arguments);
    }


//    public function findWorkshopByPublicAge($age) {
//
//        $sql = 'SELECT * FROM `workshop` W
//                JOIN public_age P
//                ON W.public_age_id = P.id
//                WHERE W.public_age_id = :age_id
//                ';
//
//        $arguments = [
//            ':age_id' => $age,
//        ];
//
//        $stmt = $this->prepareExecute($sql,$arguments);
//        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
//        return $results;
//    }


}