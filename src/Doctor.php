<?php
    class Doctor
    {
        private $name;
        private $id;

        function __construct($doctor_name, $doctor_id = null)
        {
            $this->name = $doctor_name;
            $this->id = $doctor_id;
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
            $GLOBALS['DB']->exec("INSERT INTO doctors (name) VALUES ('{$this->getName()}')");
            $this->id= $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_doctors = $GLOBALS['DB']->query("SELECT * FROM doctors;");
            $doctors = array();
            foreach($returned_doctors as $doctor) {
                $name = $doctor['name'];
                $id = $doctor['id'];
                $new_doctor = new Doctor($name, $id);
                array_push($doctors, $new_doctor);
            }
            return $doctors;
        }

        function getPatients()
        {
            $patients = Array();
            $returned_patients = $GLOBALS['DB']->query("SELECT * FROM patients WHERE doctor_id = {$this->getId()} ORDER BY doctor_id;");
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
          $GLOBALS['DB']->exec("DELETE FROM doctors;");
        }

        static function findById($search_id)
        {
            $found_doctor = null;
            $doctors = Doctor::getAll();
            foreach($doctors as $doctor) {
                $doctor_id = $doctor->getId();
                if ($doctor_id == $search_id) {
                  $found_doctor = $doctor;
                }
            }
            return $found_doctor;
        }
    }
?>
