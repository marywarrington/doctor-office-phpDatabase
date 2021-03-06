<?php
    class Doctor
    {
        private $name;
        private $id;
        private $specialty_id;

        function __construct($doctor_name, $doctor_id = null, $doctor_specialty_id)
        {
            $this->name = $doctor_name;
            $this->id = $doctor_id;
            $this->specialty_id = $doctor_specialty_id;
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

        function getSpecialtyId()
        {
            return $this->specialty_id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO doctors (name, specialty_id) VALUES ('{$this->getName()}', {$this->getSpecialtyId()})");
            $this->id= $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_doctors = $GLOBALS['DB']->query("SELECT * FROM doctors;");
            $doctors = array();
            foreach($returned_doctors as $doctor) {
                $name = $doctor['name'];
                $id = $doctor['id'];
                $specialty_id = $doctor['specialty_id'];
                $new_doctor = new Doctor($name, $id, $specialty_id);
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

        static function deleteFromSpecialty($doctor_id)
        {
            $GLOBALS['DB']->exec("DELETE FROM doctors WHERE specialty_id = {$specialty_id};");
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
