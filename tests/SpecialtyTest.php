<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Doctor.php";
    require_once "src/Patient.php";
    require_once "src/Specialty.php";

    $server = 'mysql:host=localhost;dbname=doctor_office_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class SpecialtyTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
          Doctor::deleteAll();
          Patient::deleteAll();
          Specialty::deleteAll();
        }

        function test_getName()
        {
            //Arrange
            $name = "Pediatrics";
            $test_specialty = new Specialty($name);

            //Act
            $result = $test_specialty->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function test_getId()
        {
            //Arrange
            $name = "Pediatrics";
            $id = 1;
            $test_specialty = new Specialty($name, $id);

            //Act
            $result = $test_specialty->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_save()
        {
            //Arrange
            $name = "Pediatrics";
            $id = null;
            $test_specialty = new Specialty($name, $id);
            $test_specialty->save();

            //Act
            $result = Specialty::getAll();

            //Assert
            $this->assertEquals($test_specialty, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $name = "Pediatrics";
            $name2 = "Orthopedics";
            $test_specialty = new Specialty($name);
            $test_specialty->save();
            $test_specialty2 = new Specialty($name2);
            $test_specialty2->save();

            //Act
            $result = Specialty::getAll();

            //Assert
            $this->assertEquals([$test_specialty, $test_specialty2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name = "Pediatrics";
            $name2 = "Orthopedics";
            $test_specialty = new Specialty($name);
            $test_specialty->save();
            $test_specialty2 = new Specialty($name2);
            $test_specialty2->save();

            //Act
            Specialty::deleteAll();
            $result = Specialty::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_findById()
        {
            //Arrange
            $name = "Pediatrics";
            $name2 = "Orthopedics";
            $test_specialty = new Specialty($name);
            $test_specialty->save();
            $test_specialty2 = new Specialty($name2);
            $test_specialty2->save();

            //Act
            $result = Specialty::findById($test_specialty->getId());

            //Assert
            $this->assertEquals($test_specialty, $result);
        }

        function testGetDoctors()
        {
            //Arrange
            $name = "Pediatrics";
            $id = null;
            $test_specialty = new Specialty($name, $id);
            $test_specialty->save();

            $test_specialty_id = $test_specialty->getId();

            $name2 = "Dr. Joe";
            $test_doctor = new Doctor($name2, $id, $test_specialty_id);
            $test_doctor->save();

            $name3 = "Dr. Jill";
            $test_doctor2 = new Doctor($name3, $id, $test_specialty_id);
            $test_doctor2->save();

            //Act
            $result = $test_specialty->getDoctors();

            //Assert
            $this->assertEquals([$test_doctor, $test_doctor2], $result);
        }
    }

?>
