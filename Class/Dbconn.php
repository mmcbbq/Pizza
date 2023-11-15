<?php

abstract class Dbconn
{
//    protected static string $tblname = '';
    protected static function getConn():PDO
    {
        $servername = "localhost";
        $username = "root";
        $pass = "";
        $dbname = "Pizza";
        return  new PDO("mysql:host=$servername;dbname=$dbname", $username, $pass);
    }

    public static function findbyID(int $id):static
    {
        $tblname = static::class;
        $conn = self::getConn();
        $sql = "SELECT * FROM $tblname WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchObject($tblname);
    }



    public static function delete(int $id):void
    {
        $tbl = static::class;
        $conn = self::getConn();
        $sql = "DELETE FROM $tbl WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}