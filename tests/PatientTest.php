<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Patient.php";
    require_once "src/Doctor.php";
    require_once "src/Specialty.php";

    $server = 'mysql:host=localhost;dbname=doctor_office_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class PatientTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Patient::deleteAll();
            Doctor::deleteAll();
            Specialty::deleteAll();
        }

        function test_getId()
        {
            //Arrange
            $name = "Dr. Joe";
            $id = null;
            $specialty_id = null;
            $test_doctor = new Doctor($name, $id, $specialty_id);
            $test_doctor->save();

            $name1 = "Billy";
            $doctor_id = $test_doctor->getId();
            $test_patient = new Patient($name1, $id, $doctor_id);
            $test_patient->save();

            //Act
            $result = $test_patient->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_getDoctorId()
        {
            //Arrange
            $name = "Dr. Joe";
            $id = null;
            $specialty_id = null;
            $test_doctor = new Doctor($name, $id, $specialty_id);
            $test_doctor->save();

            $name1 = "Billy";
            $doctor_id = $test_doctor->getId();
            $test_patient = new Patient($name1, $id, $doctor_id);
            $test_patient->save();

            //Act
            $result = $test_patient->getDoctorId();
            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_save()
        {
            //Arrange
            $name = "Dr. Joe";
            $id = null;
            $specialty_id = null;
            $test_doctor = new Doctor($name, $id, $specialty_id);
            $test_doctor->save();

            $name1 = "Billy";
            $doctor_id = $test_doctor->getId();
            $test_patient = new Patient($name1, $id, $doctor_id);

            //Act
            $test_patient->save();

            //Assert
            $result = Patient::getAll();
            $this->assertEquals($test_patient, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $name = "Dr. Joe";
            $id = null;
            $specialty_id = null;
            $test_doctor = new Doctor($name, $id, $specialty_id);
            $test_doctor->save();

            $name1 = "Billy";
            $doctor_id = $test_doctor->getId();
            $test_patient = new Patient($name1, $id, $doctor_id);
            $test_patient->save();

            $name2 = "Bob";
            $test_patient2 = new Patient($name2, $id, $doctor_id);
            $test_patient2->save();
            //Act
            $result = Patient::getAll();

            //Assert
            $this->assertEquals([$test_patient, $test_patient2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name = "Dr. Joe";
            $id = null;
            $specialty_id = null;
            $test_doctor = new Doctor($name, $id, $specialty_id);
            $test_doctor->save();

            $name1 = "Billy";
            $doctor_id = $test_doctor->getId();
            $test_patient = new Patient($name1, $id, $doctor_id);
            $test_patient->save();

            $name2 = "Bob";
            $test_patient2 = new Patient($name2, $id, $doctor_id);
            $test_patient2->save();

            //Act
            Patient::deleteAll();

            //Assert
            $result = Patient::getAll();
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $name = "Dr. Joe";
            $id = null;
            $specialty_id = null;
            $test_doctor = new Doctor($name, $id, $specialty_id);
            $test_doctor->save();

            $name1 = "Billy";
            $doctor_id = $test_doctor->getId();
            $test_patient = new Patient($name1, $id, $doctor_id);
            $test_patient->save();

            $name2 = "Bob";
            $test_patient2 = new Patient($name1, $id, $doctor_id);
            $test_patient2->save();

            //Act
            $result = Patient::findById($test_patient->getId());

            //Assert
            $this->assertEquals($test_patient, $result);
        }
    }
?>
