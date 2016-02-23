<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Doctor.php";
    require_once "src/Patient.php";

    $server = 'mysql:host=localhost;dbname=doctor_office_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class DoctorTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
          Doctor::deleteAll();
          Patient::deleteAll();
        }

        function test_getName()
        {
            //Arrange
            $name = "Dr. Joe";
            $test_Doctor = new Doctor($name);

            //Act
            $result = $test_Doctor->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function test_getId()
        {
            //Arrange
            $name = "Dr. Joe";
            $id = 1;
            $test_Doctor = new Doctor($name, $id);

            //Act
            $result = $test_Doctor->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_save()
        {
            //Arrange
            $name = "Dr. Joe";
            $test_Doctor = new Doctor($name);
            $test_Doctor->save();

            //Act
            $result = Doctor::getAll();

            //Assert
            $this->assertEquals($test_Doctor, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $name = "Dr. Joe";
            $name2 = "Dr. Jill";
            $test_Doctor = new Doctor($name);
            $test_Doctor->save();
            $test_Doctor2 = new Doctor($name2);
            $test_Doctor2->save();

            //Act
            $result = Doctor::getAll();

            //Assert
            $this->assertEquals([$test_Doctor, $test_Doctor2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name = "Dr. Joe";
            $name2 = "Dr. Jill";
            $test_Doctor = new Doctor($name);
            $test_Doctor->save();
            $test_Doctor2 = new Doctor($name2);
            $test_Doctor2->save();

            //Act
            Doctor::deleteAll();
            $result = Doctor::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_findById()
        {
            //Arrange
            $name = "Dr. Joe";
            $name2 = "Dr. Jill";
            $test_Doctor = new Doctor($name);
            $test_Doctor->save();
            $test_Doctor2 = new Doctor($name2);
            $test_Doctor2->save();

            //Act
            $result = Doctor::findById($test_Doctor->getId());

            //Assert
            $this->assertEquals($test_Doctor, $result);
        }

        function testGetPatients()
        {
            //Arrange
            $name = "Dr. Joe";
            $id = null;
            $test_doctor = new Doctor($name, $id);
            $test_doctor->save();

            $test_doctor_id = $test_doctor->getId();

            $name2 = "Billy";
            $test_patient = new Patient($name2, $id, $test_doctor_id);
            $test_patient->save();

            $name3 = "Bob";
            $test_patient2 = new Patient($name3, $id, $test_doctor_id);
            $test_patient2->save();

            //Act
            $result = $test_doctor->getPatients();

            //Assert
            $this->assertEquals([$test_patient, $test_patient2], $result);
        }
    }

?>
