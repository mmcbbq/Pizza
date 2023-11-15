<?php

class Kunde extends Dbconn
{
    private int $id;
    private string $vorname;
    private string $nachname;
    private string $plz;
    private string $ort;
    private string $strasse;

//    protected static string $tblname = 'Kunde';
//
//    /**
//     * @param string $vorname
//     * @param string $nachname
//     * @param string $plz
//     * @param string $ort
//     * @param string $strasse
//     */
//    public function __construct(string $vorname, string $nachname, string $plz, string $ort, string $strasse)
//    {
//        $this->vorname = $vorname;
//        $this->nachname = $nachname;
//        $this->plz = $plz;
//        $this->ort = $ort;
//        $this->strasse = $strasse;
//    }


    public function bestellung(): Bestellung
    {
        return new Bestellung($this);
    }

    public function getName(): string
    {
        return $this->vorname . " " . $this->nachname;
    }

    public static function create(string $vorname, string $nachname, string $plz, string $ort, string $strasse, string $email)
    {
        $conn = self::getConn();

        $sql = 'INSERT INTO kunde (vorname, nachname, plz, ort, strasse, email) VALUES (:vorname, :nachname, :plz, :ort, :strasse, :email)';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':vorname', $vorname);
        $stmt->bindParam(':nachname', $nachname);
        $stmt->bindParam(':plz', $plz);
        $stmt->bindParam(':ort', $ort);
        $stmt->bindParam(':strasse', $strasse);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return self::findbyID($conn->lastInsertId());


    }

    public static function update(int $id, string $vorname, string $nachname, string $plz, string $ort, string $strasse, string $email): void
    {
        $conn = self::getConn();

        $sql = 'UPDATE kunde set vorname = :vorname, nachname = :nachname, plz = :plz, ort = :ort, strasse = :strasse, email = :email WHERE id = :id';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':vorname', $vorname);
        $stmt->bindParam(':nachname', $nachname);
        $stmt->bindParam(':plz', $plz);
        $stmt->bindParam(':ort', $ort);
        $stmt->bindParam(':strasse', $strasse);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }


}