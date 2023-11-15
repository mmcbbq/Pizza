<?php

class Bestellung extends Dbconn
{
    private int $id;
    private Kunde $kunde;
    private array $bestellitems;
    private Bezahlmethode $bezahlmethode;

//    /**
//     * @param Kunde $kunde
//     */
////    public function __construct(Kunde $kunde)
////    {
////        $this->kunde = $kunde;
////    }


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
        $sql = 'INSERT INTO lieferung (kundenid) values (:kundenid)';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':kundenid', $kundenid);
        $stmt->execute();
        return self::findbyID($conn->lastInsertId());
    }

    public static function update(int $id, bool $grosse):void
    {
        $conn = self::getConn();
        $sql = 'UPDATE lieferung SET kundenid = :kundenid WHERE bestellnummer = :id';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':kundenid', $kundenid);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

    }


}