<?php

class Client
{
    private $client_name;
    private $phone;
    private $stylist_id;
    private $id;

    function __construct($client_name, $phone, $stylist_id, $id = null)
    {
        $this->client_name = $client_name;
        $this->phone = $phone;
        $this->stylist_id = $stylist_id;
        $this->id = $id;
    }

    function setClientName($new_client_name)
    {
        $this->client_name = (string) $new_client_name;
    }

    function setPhone($new_phone)
    {
        $this->phone = $new_phone;
    }

    function getClientName()
    {
        return $this->client_name;
    }

    function getPhone()
    {
        return $this->phone;
    }

    function getStylistId()
    {
        return $this->stylist_id;
    }

    function getId()
    {
        return $this->id;
    }

    function save()
   {
       $GLOBALS['DB']->exec("INSERT INTO clients (client_name, phone, stylist_id) VALUES ('{$this->getClientName()}', '{$this->getPhone()}', {$this->getStylistId()})");
       $this->id = $GLOBALS['DB']->lastInsertId();
   }


    static function getAll()
    {
        $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients;");
        $clients = [];

        foreach($returned_clients as $client)
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

    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM clients;");
    }

}



 ?>
