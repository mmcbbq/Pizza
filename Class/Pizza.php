<?php

class Pizza extends Dbconn implements Bezahlung
{
    private int $id;
    private bool $groesse; // true = preis 8 false = 5
//    private float $basispreis;
    private array $toppings;// [Salami, Pilze, .... ] -> Topping Objekte


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
    public function getPreis(): float
    {
        if ($this->groesse) {
            $preis = 8;
        } else {
            $preis = 5;
        }

        foreach ($this->toppings as $topping) { //Salami 1,20 -> getPreis()

            $preis += $topping->getPreis();

        }
        return $preis;

    }

    public function addTopping(Topping ...$topping): void
    {
        foreach ($topping as $item) {
            $this->toppings[] = $item;
        }


    }

    public function html(): string
    {
        if ($this->groesse) {
            $gr = 'gross';
        } else {
            $gr = 'klein';
        }

        $liste = "<ul>";
        foreach ($this->toppings as $topping) {
            $liste .= $topping->html();
        }

        $html = "<div>Pizza {$gr} {$liste} {$this->getPreis()} </div>";
        $html .= "</ul>";
        return $html;
    }


    public static function create(bool $groesse): Pizza
    {
        $conn = self::getConn();
        $sql = 'INSERT INTO pizza (groesse) values (:groesse)';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':groesse', $groesse);
        $stmt->execute();
        return self::findbyID($conn->lastInsertId());
    }

    public static function update(int $id, bool $groesse): void
    {
        $conn = self::getConn();
        $sql = 'UPDATE pizza SET groesse = :groesse WHERE id= :id';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':groesse', $groesse);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function getTopDb(): void
    {
        $conn = self::getConn(); // erstellen eines PDO Objektes

        //SQL um die Daten aus der Topping tbl und der pizza_topping tbl auszulesen
        $sql = 'SELECT t.* FROM pizza_topping
                LEFT JOIN topping t on t.id = pizza_topping.toppingid                                               
                where pizzaid = :id';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $this->id );
        $stmt->execute();
        $this->toppings = $stmt->fetchAll(PDO::FETCH_CLASS, 'Topping');//Alle Datensätze werden in einem Topping Objekt umgewandelt und ein das array toppings eingefügt
    }

    /**
     * @return void
     */

    public function topInDb():void
    {
        $conn = self::getConn(); // erstellen eines PDO Objektes

        /**
         * @var Topping $topping
         */

        foreach ($this->toppings as $topping) {

                $tid = $topping->getId();
                $sql = 'INSERT INTO pizza_topping (pizzaid, toppingid) VALUES (:pizzaid, :toppingid)';
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':pizzaid', $this->id);
                $stmt->bindParam(':toppingid', $tid);
                $stmt->execute();

        }

    }

    public function deleteTop(Topping $toppingremove):void
    {
        foreach ($this->toppings as $index=>$topping) {
            if ($topping == $toppingremove)
            {
                unset($this->toppings[$index]);
                break;
            }
        }

    }
    public function changeTopDB():void
    {
        $conn = self::getConn(); // erstellen eines PDO Objektes
        $sql = 'DELETE FROM pizza_topping WHERE pizzaid = :pizzaid';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':pizzaid', $this->id);
        $stmt->execute();
        $this->topinDb();
    }




}