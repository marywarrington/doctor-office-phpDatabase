<?php
class Specialty
{
    private $name;
    private $id;


    function __construct($specialty_name, $specialty_id = null)
    {
        $this->name = $specialty_name;
        $this->id = $specialty_id;
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
        $GLOBALS['DB']->exec("INSERT INTO specialties (name) VALUES ('{$this->getName()}')");
        $this->id= $GLOBALS['DB']->lastInsertId();
    }

    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM specialties;");
    }
}

?>
