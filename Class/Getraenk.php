<?php

class Getraenk extends Dbconn implements Bezahlung
{


    private string $name;
    private float $preis;
    protected static string $tblname = 'getraenk';

    /**
     * @param string $name
     * @param float $preis
     */
//    public function __construct(string $name, float $preis)
//    {
//        $this->name = $name;
//        $this->preis = $preis;
//    }


    public function getPreis():float
    {
        return $this->preis;
    }

    public function html(): string
    {
        return "<div>{$this->name} {$this->getPreis()}</div>";
    }




    public static function create(string $name,float $preis):Getraenk
    {
        $conn = self::getConn();
        $sql = "INSERT INTO getraenk (name, preis) VALUES (:name, :preis)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':preis', $preis);
        $stmt->execute();
        return self::findbyID($conn->lastInsertId());

    }






    public static function update(int $id, string $name ,string $preis): void
    {
        $conn = self::getConn();
        $sql = 'UPDATE getraenk SET name = :name , preis = :preis WHERE id = :id';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name' ,$name);
        $stmt->bindParam(':preis' ,$preis);
        $stmt->bindParam(':id' ,$id);
        $stmt->execute();

    }



}