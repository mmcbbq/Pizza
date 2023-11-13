<?php

class Topping implements Bezahlung
{
    private int $id;
    private string $name;
    private float $preis;

    /**
     * @param int $id
     * @param string $name
     * @param float $preis
     */
    public function __construct(int $id, string $name, float $preis)
    {
        $this->id = $id;
        $this->name = $name;
        $this->preis = $preis;
    }




    public function getPreis():float
    {
        return $this->preis;
    }

    public function html(): string
    {
        return "<li>{$this->name}</li>";
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    public static function findbyID(int $id):self
    {
        $servername = "localhost";
        $username = "root";
        $pass = "";
        $dbname = "Pizza";
        $conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$pass);
        $sql = "Select * From topping where id = :platzhalter";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['platzhalter' => $id]);
        $result = $stmt->fetch(2);
        return new Topping($result['id'],$result['name'],$result['preis']);
    }

    public static function findAll():array
    {
        return [];
    }








}