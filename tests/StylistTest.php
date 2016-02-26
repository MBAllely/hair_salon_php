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

    class StylistTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Stylist::deleteAll();
        }
        function test_getName()
        {
            // Arrange
            $name = "Linda";
            $id = null;
            $test_stylist = new Stylist($name, $id);

            // Act
            $result = $test_stylist->getName();

            // Assert
            $this->assertEquals($name, $result);
        }


        function test_getId()
        {
            // Arrange
            $name = "Linda";
            $id = 1;
            $test_stylist = new Stylist($name, $id);

            // Act
            $result = $test_stylist->getId();

            // Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_save()
        {
            // Arrange
            $name = "Linda";
            $test_stylist = new Stylist($name);
            $test_stylist->save();

            // Act
            $result = Stylist::getAll();

            // Assert
            $this->assertEquals([$test_stylist], $result);
        }

        function test_getAll()
        {
            // Arrange
            $name = "Linda";
            $test_stylist = new Stylist($name);
            $test_stylist->save();

            $name2 = "Rodrigo";
            $test_stylist2 = new Stylist($name2);
            $test_stylist2->save();

            // Act
            $result = Stylist::getAll();
            // var_dump($result);

            // Assert
            $this->assertEquals([$test_stylist, $test_stylist2], $result);
        }

        function test_deleteAll()
        {
            // Arrange
            $name = "Linda";
            $test_stylist = new Stylist($name);
            $test_stylist->save();

            $name2 = "Rodrigo";
            $test_stylist2 = new Stylist($name2);
            $test_stylist2->save();

            // Act
            Stylist::deleteAll();
            $result = Stylist::getAll();
            // var_dump($result);

            // Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            // Arrange
            $name = "Linda";
            $test_stylist = new Stylist($name);
            $test_stylist->save();

            $name2 = "Rodrigo";
            $test_stylist2 = new Stylist($name2);
            $test_stylist2->save();

            // Act
            $result = Stylist::find($test_stylist2->getId());

            // Assert
            $this->assertEquals($test_stylist2, $result);
        }

        function test_update()
        {
            // Arrange
            $name = "Linda";
            $test_stylist = new Stylist($name);
            $test_stylist->save();

            $new_name = "Belva";

            // Act
            $test_stylist->update($new_name);

            // Assert
            $this->assertEquals("Belva", $test_stylist->getName());
        }

        function test_deleteStylist()
        {
            // Arrange
            $name = "Linda";
            $test_stylist = new Stylist($name);
            $test_stylist->save();

            // Act
            $test_stylist->deleteStylist();

            // Assert
            $this->assertEquals([], Stylist::getAll());
        }

        function test_getClients()
        {
            //Arrange
            $name = "Linda";
            $test_stylist = new Stylist($name);
            $test_stylist->save();

            $stylist_id = $test_stylist->getId();

            $client_name = "Janice";
            $phone = "9075558989";
            $test_client = new Client($client_name, $phone, $stylist_id);
            $test_client->save();

            $client_name2 = "Reynard";
            $phone2 = "5035551212";
            $test_client2 = new Client($client_name2, $phone2, $stylist_id);
            $test_client2->save();

            //Act
            $result = $test_stylist->getClients();

            //Assert
            $this->assertEquals([$test_client, $test_client2], $result);
        }



    }
 ?>
