<?php
class Patient
{
    private $name;
    private $id;
    private $doctor_id;


    function __construct($patient_name, $patient_id = null, $patient_doctor_id)
    {
        $this->description = $patient_name;
        $this->id = $patient_id;
        $this->doctor_id = $patient_doctor_id;
    }

    function setDescription($new_description)
    {
        $this->description = (string) $new_description;
    }

    function getDescription()
    {
        return $this->description;
    }

    function getDueDate()
    {
        return $this->due_date;
    }

    function getId()
    {
        return $this->id;
    }

    function getCategoryId()
    {
        return $this->doctor_id;
    }

    function save()
    {
        $GLOBALS['DB']->exec("INSERT INTO patients (description, due_date, doctor_id) VALUES ('{$this->getDescription()}', '{$this->getDueDate()}', {$this->getCategoryId()});");
        $this->id = $GLOBALS['DB']->lastInsertId();
    }

    static function getAll()
    {
        $returned_patients = $GLOBALS['DB']->query("SELECT * FROM patients ORDER BY due_date;");
        $patients = array();

        foreach($returned_patients as $patient) {
            $description = $patient['description'];
            $due_date = $patient['due_date'];
            $id = $patient['id'];
            $doctor_id = $patient['doctor_id'];
            $new_patient = new Patient($description, $due_date, $id, $doctor_id);
            array_push($patients, $new_patient);
    }
        return $patients;
    }

    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM patients;");
    }

    static function deleteFromCategory($doctor_id)
    {
        $GLOBALS['DB']->exec("DELETE FROM patients WHERE doctor_id = {$doctor_id};");
    }

    static function findById($search_id)
    {
        $found_patient = null;
        $patients = Patient::getAll();
        foreach($patients as $patient) {
            $patient_id = $patient->getId();
            if ($patient_id == $search_id) {
                $found_patient = $patient;
            }
        }
        return $found_patient;
    }

    static function findByDate($search_date)
    {
        // $found_patient = null;
        // $patients = Patient::getAll();
        // foreach($patients as $patient) {
        //     $patient_due_date = $patient->getDueDate();
        //     if ($patient_due_date == $search_date) {
        //         $found_patient = $patient;
        //     }
        // }
        // return $found_patient;
        $GLOBALS['DB']->exec("SELECT * FROM patients WHERE search_date = {$due_date};");

    }


}
?>
