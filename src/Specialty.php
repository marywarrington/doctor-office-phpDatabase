<?php
class Specialty
{
    private $name;
    private $id;


    function __construct($specialty_name, $specialty_id = null)
    {
        $this->name = $specialty_name;
        $this->id = $specialty_id;
    }

    function setName($new_name)
    {
        $this->name = (string) $new_name;
    }

    function getName()
    {
        return $this->name;
    }

    function getId()
    {
        return $this->id;
    }

    function save()
    {
        $GLOBALS['DB']->exec("INSERT INTO specialities (name) VALUES ('{$this->getName()}')");
        $this->id= $GLOBALS['DB']->lastInsertId();
    }

    static function getAll()
    {
        $returned_specialities = $GLOBALS['DB']->query("SELECT * FROM specialities;");
        $specialities = array();
        foreach($returned_specialities as $specialty) {
            $name = $specialty['name'];
            $id = $specialty['id'];
            // $specialty_id = $specialty['specialty_id'];
            $new_specialty = new Specialty($name, $id);
            array_push($specialities, $new_specialty);
        }
        return $specialities;
    }

    static function findById($search_id)
    {
        $found_specialty = null;
        $specialties = Specialty::getAll();
        foreach($specialties as $specialty) {
            $specialty_id = $specialty->getId();
            if ($specialty_id == $search_id) {
              $found_specialty = $specialty;
            }
        }
        return $found_specialty;
    }

    function getDoctors()
    {
        $doctors = Array();
        $returned_doctors = $GLOBALS['DB']->query("SELECT * FROM doctors WHERE specialty_id = {$this->getId()} ORDER BY specialty_id;");
        foreach($returned_doctors as $doctor) {
            $name = $doctor['name'];
            $id = $doctor['id'];
            $specialty_id = $doctor['specialty_id'];
            $new_doctor = new Doctor($name, $id, $specialty_id);
            array_push($doctors, $new_doctor);
        }
        return $doctors;
    }

    static function deleteSpecialties()
        {
          $GLOBALS['DB']->exec("DELETE FROM specialities;");
        }

    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM specialities;");
    }
}

?>
