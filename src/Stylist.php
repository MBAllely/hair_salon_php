<?php

class Stylist
{
    private $name;
    private $phone;
    private $id;

    function __construct($name, $phone, $id)
    {
        $this->name = $name;
        $this->phone = $phone;
        $this->id = $id;
    }

    function setName($new_name)
    {
        $this->name = (string) $new_name;
    }

    function setPhone($new_phone)
    {
        $this->phone = (int) $new_phone;
    }

    function getName()
    {
        return $this->name;
    }

    function getPhone()
    {
        return $this->phone;
    }

    function getId()
    {
        return $this->id;
    }

}



?>
