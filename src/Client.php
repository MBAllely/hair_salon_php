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
        $GLOBALS['DB']->exec("INSERT INTO clients (client_name, phone, stylist_id) VALUES ('{$this->getClientName()}', {$this->getPhone()}, {$this->getStylistId()})");
        $this->id = $GLOBALS['DB']->lastInsertId();
    }

    static function getAll()
    {

    }

}



 ?>
