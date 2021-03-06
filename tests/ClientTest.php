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
        protected function tearDown()
        {
            Stylist::deleteAll();
            Client::deleteAll();
        }

        function test_getClientName()
        {
            //Arrange
            $client_name = "Janice";
            $phone = "9075558989";
            $stylist_id = 1;
            $test_client = new Client($client_name, $phone, $stylist_id);

            //Act
            $result = $test_client->getClientName();

            //Assert
            $this->assertEquals($client_name, $result);

        }

        function test_getPhone()
        {
            //Arrange
            $client_name = "Janice";
            $phone = "9075558989";
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
            $name = "Linda";
            $test_stylist = new Stylist($name);
            $test_stylist->save();

            $client_name = "Janice";
            $phone = "9075558989";
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($client_name, $phone, $stylist_id);

            //Act
            $result = $test_client->getStylistId();

            //Assert
            $this->assertEquals($stylist_id, $result);

        }

        function test_getId()
        {
            //Arrange
            $client_name = "Janice";
            $phone = "9075558989";
            $stylist_id = 1;
            $id = 1;
            $test_client = new Client($client_name, $phone, $stylist_id, $id);

            //Act
            $result = $test_client->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));

        }

        function test_save()
        {
            //Arrange
            $client_name = "Janice";
            $phone = "9075558989";
            $stylist_id = 1;
            $test_client = new Client($client_name, $phone, $stylist_id);
            $test_client->save();

            //Act
            $result = Client::getAll();

            //Assert
            $this->assertEquals([$test_client], $result);

        }

        function test_getAll()
        {
            //Arrange
            $client_name = "Janice";
            $phone = "9075558989";
            $stylist_id = 1;
            $test_client = new Client($client_name, $phone, $stylist_id);
            $test_client->save();

            $client_name2 = "Reynard";
            $phone2 = "5035551212";
            $stylist_id = 1;
            $test_client2 = new Client($client_name2, $phone2, $stylist_id);
            $test_client2->save();

            //Act
            $result = Client::getAll();

            //Assert
            $this->assertEquals([$test_client, $test_client2], $result);

        }

        function test_deleteAll()
        {
            //Arrange
            $client_name = "Janice";
            $phone = "9075558989";
            $stylist_id = 1;
            $test_client = new Client($client_name, $phone, $stylist_id);
            $test_client->save();

            $client_name2 = "Reynard";
            $phone2 = "5035551212";
            $stylist_id = 1;
            $test_client2 = new Client($client_name2, $phone2, $stylist_id);
            $test_client2->save();

            //Act
            Client::deleteAll();
            $result = Client::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_deleteOneClient()
        {
            //Arrange
            $client_name = "Janice";
            $phone = "9075558989";
            $stylist_id = 1;
            $test_client = new Client($client_name, $phone, $stylist_id);
            $test_client->save();

            $client_name2 = "Reynard";
            $phone2 = "5035551212";
            $stylist_id = 1;
            $test_client2 = new Client($client_name2, $phone2, $stylist_id);
            $test_client2->save();

            //Act
            $test_client->deleteOneClient();

            //Assert
            $this->assertEquals([$test_client2], Client::getAll());
        }

        function test_updateClient_name()
        {
            //Arrange
            $client_name = "Janice";
            $phone = "9075558989";
            $stylist_id = 1;
            $test_client = new Client($client_name, $phone, $stylist_id);
            $test_client->save();

            $new_client_name = "Bertha";

            //Act
            $test_client->updateClient($new_client_name, $phone);

            //Assert
            $this->assertEquals("Bertha", $test_client->getClientName());

        }

        function test_updateClient_phone()
        {
            //Arrange
            $client_name = "Janice";
            $phone = "9075558989";
            $stylist_id = 1;
            $test_client = new Client($client_name, $phone, $stylist_id);
            $test_client->save();

            $new_phone = "7778883333";

            //Act
            $test_client->updateClient($client_name, $new_phone);

            //Assert
            $this->assertEquals("7778883333", $test_client->getPhone());

        }

        function test_find()
        {
            //Arrange
            $name = "Linda";
            $test_stylist = new Stylist($name);
            $test_stylist->save();

            $client_name = "Janice";
            $phone = "9075558989";
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($client_name, $phone, $stylist_id);
            $test_client->save();

            $client_name2 = "Reynard";
            $phone2 = "5035551212";
            $stylist_id = $test_stylist->getId();
            $test_client2 = new Client($client_name2, $phone2, $stylist_id);
            $test_client2->save();

            //Act
            $result = Client::find($test_client2->getId());

            //Assert
            $this->assertEquals($test_client2, $result);
        }


    }


?>
