<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once __DIR__ . '/../src/Stylist.php';

    $server = 'mysql:host=localhost;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class ClassStylist extends PHPUnit_Framework_TestCase
    {
        function test_getName()
        {
            // Arrange
            $name = "Linda";
            $phone = 9075553838;
            $id = null;
            $test_stylist = new Stylist($name, $phone, $id);

            // Act
            $result = $test_stylist->getName();

            // Assert
            $this->assertEquals($name, $result);
        }

        function test_getPhone()
        {
            // Arrange
            $name = "Linda";
            $phone = 9075553838;
            $id = null;
            $test_stylist = new Stylist($name, $phone, $id);

            // Act
            $result = $test_stylist->getPhone();

            // Assert
            $this->assertEquals($phone, $result);
        }
















    }
 ?>
