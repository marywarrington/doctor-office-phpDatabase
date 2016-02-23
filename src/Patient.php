<?php
class Patient
{
    private $name;
    private $id;
    private $doctor_id;


    function __construct($patient_name, $patient_id = null, $patient_doctor_id)
    {
        $this->name = $patient_name;
        $this->id = $patient_id;
        $this->doctor_id = $patient_doctor_id;
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

    function getDoctorId()
    {
        return $this->doctor_id;
    }

    function save()
    {
        $GLOBALS['DB']->exec("INSERT INTO patients (name, doctor_id) VALUES ('{$this->getName()}', {$this->getDoctorId()});");
        $this->id = $GLOBALS['DB']->lastInsertId();
    }

    static function getAll()
    {
        $returned_patients = $GLOBALS['DB']->query("SELECT * FROM patients;");
        $patients = array();

        foreach($returned_patients as $patient) {
            $name = $patient['name'];
            $id = $patient['id'];
            $doctor_id = $patient['doctor_id'];
            $new_patient = new Patient($name, $id, $doctor_id);
            array_push($patients, $new_patient);
    }
        return $patients;
    }

    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM patients;");
    }

    static function deleteFromDoctor($doctor_id)
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

    // static function findByDate($search_date)
    // {
        // $found_patient = null;
        // $patients = Patient::getAll();
        // foreach($patients as $patient) {
        //     $patient_due_date = $patient->getDueDate();
        //     if ($patient_due_date == $search_date) {
        //         $found_patient = $patient;
        //     }
        // }
        // return $found_patient;
        // $GLOBALS['DB']->exec("SELECT * FROM patients WHERE ");
// 
    // }


}
?>
