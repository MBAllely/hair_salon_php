<?php

class Stylist
{
    private $name;
    private $id;

    function __construct($name, $id = null)
    {
        $this->name = $name;

        $this->id = $id;
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
        $GLOBALS['DB']->exec("INSERT INTO stylists (name) VALUES ('{$this->getName()}');");
        $this->id = $GLOBALS['DB']->lastInsertId();
    }


    static function getAll()
    {
        $returned_stylists = $GLOBALS['DB']->query("SELECT * FROM stylists;");
        $stylists = array();

        foreach ($returned_stylists as $stylist) {
            $name = $stylist['name'];
            $id = $stylist['id'];
            $new_stylist = new Stylist($name, $id);
            array_push($stylists, $new_stylist);
        }
        return $stylists;
    }

    static function find($search_id)
    {
        $found_stylist = null;
        $stylists = Stylist::getAll();

        foreach($stylists as $stylist)
        {
            if ($stylist->getId() == $search_id)
            $found_stylist = $stylist;
        }
        return $found_stylist;
    }

    function getClients()
    {
        $clients = [];
        $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients WHERE stylist_id = '{$this->getId()}'");

        foreach ($returned_clients as $client)
        {
            $client_name = $client['client_name'];
            $phone = $client['phone'];
            $stylist_id = $client['stylist_id'];
            $id = $client['id'];
            $new_client = new Client($client_name, $phone, $stylist_id, $id);
            array_push($clients, $new_client);
        }
        return $clients;
    }

    function updateStylist($new_name)
    {
        $GLOBALS['DB']->exec("UPDATE stylists SET name = '{$new_name}' WHERE id = {$this->getId()};");
        $this->setName($new_name);
    }

    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM stylists;");
    }

    function deleteStylist()
    {
        $GLOBALS['DB']->exec("DELETE FROM stylists WHERE id = {$this->getId()}");
    }

}



?>
