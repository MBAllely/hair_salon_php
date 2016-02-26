<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once __DIR__ . '/../src/Stylist.php';

    $server = 'mysql:host=localhost;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $passoword);

    class ClassStylist extends PHPUnit_Framework_TestCase
    {
        function test_methodToTest_inputDescription()
        {
            // Arrange

            // Act

            // Assert
        }
    }
 ?>
