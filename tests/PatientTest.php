<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Patient.php";
    require_once "src/Doctor.php";

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
        }
        //
        // function test_getId()
        // {
        //     //Arrange
        //     $name = "Home Stuff";
        //     $id = null;
        //     $test_category = new Doctor ($name, $id);
        //     $test_category->save();
        //
        //     $description = "Wash the dog";
        //     $category_id = $test_category->getId();
        //     $test_task = new Patient($description, $id, $category_id);
        //     $test_task->save();
        //
        //     //Act
        //     $result = $test_task->getId();
        //
        //     //Assert
        //     $this->assertEquals(true, is_numeric($result));
        // }
        //
        // function test_getDoctorId()
        // {
        //     //Arrange
        //     $name = "Home Stuff";
        //     $id = null;
        //     $test_category = new Doctor($name, $id);
        //     $test_category->save();
        //
        //     $description = "Wash the dog";
        //     $category_id = $test_category->getId();
        //     $test_task = new Patient($description, $id, $category_id);
        //     $test_task->save();
        //
        //     //Act
        //     $result = $test_task->getDoctorId();
        //     //Assert
        //     $this->assertEquals(true, is_numeric($result));
        // }
        //
        // function test_save()
        // {
        //     //Arrange
        //     $name = "Home stuff";
        //     $id = null;
        //     $test_category = new Doctor($name, $id);
        //     $test_category->save();
        //
        //     $description = "Wash the dog";
        //     $category_id = $test_category->getId();
        //     $test_task = new Patient($description, $id, $category_id);
        //
        //     //Act
        //     $test_task->save();
        //
        //     //Assert
        //     $result = Patient::getAll();
        //     $this->assertEquals($test_task, $result[0]);
        // }
        //
        // function test_getAll()
        // {
        //     //Arrange
        //     $name = "Home stuff";
        //     $id = null;
        //     $test_category = new Doctor($name, $id);
        //     $test_category->save();
        //
        //     $description = "Wash the dog";
        //     $category_id = $test_category->getId();
        //     $test_task = new Patient($description, $id, $category_id);
        //     $test_task->save();
        //
        //     $description2 = "Water the lawn";
        //     $test_task2 = new Patient($description2, $id, $category_id);
        //     $test_task2->save();
        //     //Act
        //     $result = Patient::getAll();
        //
        //     //Assert
        //     $this->assertEquals([$test_task, $test_task2], $result);
        // }
        //
        // function test_deleteAll()
        // {
        //     //Arrange
        //     $name = "Home stuff";
        //     $id = null;
        //     $test_category = new Doctor($name, $id);
        //     $test_category->save();
        //
        //     $description = "Wash the dog";
        //     $category_id = $test_category->getId();
        //     $test_task = new Patient($description, $id, $category_id);
        //     $test_task->save();
        //
        //     $description2 = "Water the lawn";
        //     $test_task2 = new Patient($description2, $id, $category_id);
        //     $test_task2->save();
        //
        //     //Act
        //     Patient::deleteAll();
        //
        //     //Assert
        //     $result = Patient::getAll();
        //     $this->assertEquals([], $result);
        // }
        //
        //
        // function test_find()
        // {
        //     //Arrange
        //     $name = "Home stuff";
        //     $id = null;
        //     $test_category = new Doctor($name, $id);
        //     $test_category->save();
        //
        //     $description = "Wash the dog";
        //     $category_id = $test_category->getId();
        //     $test_task = new Patient($description, $id, $category_id);
        //     $test_task->save();
        //
        //     $description2 = "Water the lawn";
        //     $test_task2 = new Patient($description, $id, $category_id);
        //     $test_task2->save();
        //
        //     //Act
        //     $result = Patient::find($test_task->getId());
        //
        //     //Assert
        //     $this->assertEquals($test_task, $result);
        // }

    }
?>
