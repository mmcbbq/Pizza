<?php

class Topping implements Bezahlung
{
    private int $id;
    private string $name;
    private float $preis;

//    public function __construct(int $id, string $name, float $preis)
//    {
//        $this->id = $id;
//        $this->name = $name;
//        $this->preis = $preis;
//    }


    public function getPreis(): float
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

    public static function findbyID(int $id): self
    {
        $servername = "localhost";
        $username = "root";
        $pass = "";
        $dbname = "Pizza";
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $pass);
        $sql = "Select * From topping where id = :platzhalter";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['platzhalter' => $id]);
        $result = $stmt->fetchObject('Topping');
        return $result;
    }


    public static function createTopping(): self
    {

        return

    }


    public function updateTopping(): void
    {

    }


    public function deleteTopping():void
    {

    }

    public static function findAll(): array
    {
        return [];
    }


}