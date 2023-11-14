<?php

class Topping extends Dbconn implements Bezahlung
{
    private int $id;
    private string $name;
    private float $preis;
    protected static string $tblname = 'topping';

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



    public static function create(string $name,float $preis):Topping
    {
        $conn = self::getConn();
        $sql = "INSERT INTO topping (name, preis) VALUES (:name, :preis)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':preis', $preis);
        $stmt->execute();
        return self::findbyID($conn->lastInsertId());

    }






    public static function update(int $id, string $name ,string $preis): void
    {
        $conn = self::getConn();
        $sql = 'UPDATE topping SET name = :name , preis = :preis WHERE id = :id';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name' ,$name);
        $stmt->bindParam(':preis' ,$preis);
        $stmt->bindParam(':id' ,$id);
        $stmt->execute();

    }




    public static function findAll(): array
    {
        return [];
    }


}
