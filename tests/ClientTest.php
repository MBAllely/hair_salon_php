<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once __DIR__ . '/../src/Stylist.php';
    require_once __DIR__ . '/../src/Client.php';

    $server = 'mysql:host=localhost;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class ClientTest extends PHPUnit_Framework_TestCase
    {

        function test_getName()
        {
            //Arrange
            $client_name = "Janice";
            $phone = 9075558989;
            $stylist_id = 1;
            $test_client = new Client($client_name, $phone, $stylist_id);

            //Act
            $result = $test_client->getName();

            //Assert
            $this->assertEquals($client_name, $result);

        }

        function test_getPhone()
        {
            //Arrange
            $client_name = "Janice";
            $phone = 9075558989;
            $stylist_id = 1;
            $test_client = new Client($client_name, $phone, $stylist_id);

            //Act
            $result = $test_client->getPhone();

            //Assert
            $this->assertEquals($phone, $result);

        }

        function test_getStylistId()
        {
            //Arrange
            $client_name = "Janice";
            $phone = 9075558989;
            $stylist_id = 1;
            $test_client = new Client($client_name, $phone, $stylist_id);

            //Act
            $result = $test_client->getStylistId();

            //Assert
            $this->assertEquals($stylist_id, $result);

        }


    }


?>
