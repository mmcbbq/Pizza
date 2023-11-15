<?php

class Bestellung extends Dbconn
{
    private int $id;
    private Kunde $kunde;
    private array $bestellitems;
    private Bezahlmethode $bezahlmethode;

    /**
     * @param Kunde $kunde
     */
    public function __construct(int $id,Kunde $kunde)
    {
        $this->id = $id;
        $this->kunde = $kunde;
    }


    public function rechnungHtml():string
    {
        $html = "<div> Name des kundenen {$this->kunde->getName()}</div>";
        foreach ($this->bestellitems as $bestellitem) {
            $html.= $bestellitem->html();
        }
        $html.="Summe: ".$this->rechnungsBetrag()."€";
        return $html;
    }

    public function rechnungsBetrag():float
    {
        $preis = 0;
        foreach ($this->bestellitems as $bestellitem) {
            $preis += $bestellitem->getPreis();
        }
        return $preis;
    }

    public function addBestellitem(Bezahlung $item):void
    {
        $this->bestellitems[]= $item;
    }

    /**
     * @return Bezahlmethode
     */
    public function getBezahlmethode(): Bezahlmethode
    {
        return $this->bezahlmethode;
    }

    /**
     * @param Bezahlmethode $bezahlmethode
     */
    public function setBezahlmethode(Bezahlmethode $bezahlmethode): void
    {
        $this->bezahlmethode = $bezahlmethode;
    }

    public function bezahlen():bool
    {
        return $this->bezahlmethode->bezahlen();

    }


    public static function create(int $kundenid):self
    {
        $conn = self::getConn();
        $sql = 'INSERT INTO bestellung (kundenid) values (:kundenid)';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':kundenid', $kundenid);
        $stmt->execute();
        return self::findbyID($conn->lastInsertId());
    }

    public static function update(int $id, bool $grosse):void
    {
        $conn = self::getConn();
        $sql = 'UPDATE bestellung SET kundenid = :kundenid WHERE id = :id';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':kundenid', $kundenid);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

    }

    public static function findbyID(int $id):static
    {
        $tblname = static::class;
        $conn = self::getConn();
        $sql = "SELECT * FROM $tblname WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(2); // Array des Datensatzes aus der Tbl bestellung
        $kunde = Kunde::findbyID($result['kundenid']); // Erstellen Kunde mit der ID aus dem $result Datensatz
        return new Bestellung($id, $kunde);
    }

    public function bestellinDB()
    {
        $conn = self::getConn();
        foreach ($this->bestellitems as $bestellitem) {
            if (get_class($bestellitem ) == 'Getraenk')
            {
                $gid = $bestellitem->getId();
                $sql = 'INSERT INTO getraenke_lieferung (bestellnummer, getraenkeid) VALUES (:bestellnummer , :getraenkeid)';
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':bestellnummer', $this->id);
                $stmt->bindParam(':getraenkeid', $gid);
                $stmt->execute();
            }
            elseif (get_class($bestellitem )== 'Pizza'){
                $pid = $bestellitem->getId();
                $sql = 'INSERT INTO pizza_lieferung (bestellnummer, pizzaid) VALUES (:bestellnummer , :pizzaid)';
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':bestellnummer', $this->id);
                $stmt->bindParam(':pizzaid', $pid );
                $stmt->execute();
            }
        }

    }

    public function getBestellungDb()
    {
        $sql = "SELECT b.id, b.kundenid, gl.id, pl.id FROM bestellung b 
left join getraenke_lieferung gl on b.id = gl.bestellnummer
left join pizza_lieferung pl on b.id = pl.bestellnummer
where b.id = 50;";



}
}