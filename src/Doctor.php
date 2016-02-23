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
            $tasks = Array();
            $returned_tasks = $GLOBALS['DB']->query("SELECT * FROM tasks WHERE doctor_id = {$this->getId()} ORDER BY due_date;");
            foreach($returned_tasks as $task) {
                $description = $task['description'];
                $due_date = $task['due_date'];
                $id = $task['id'];
                $doctor_id = $task['doctor_id'];
                $new_task = new Patient($description, $due_date, $id, $doctor_id);
                array_push($tasks, $new_task);
            }
            return $tasks;
        }

        static function deleteCategories()
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
