<?php

class Pizza implements Bezahlung
{
    private bool $groesse; // true = preis 8 false = 5
//    private float $basispreis;
    private array $toppings;// [Salami, Pilze, .... ] -> Topping Objekte

    /**
     * @param bool $groesse
     * @param float $basispreis
     * @param array $toppings
     */
    public function __construct(bool $groesse)
    {
        $this->groesse = $groesse;


    }


    public function getPreis(): float
    {
        if ($this->groesse){
            $preis = 8;
        }else{
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
        $html.= "</ul>";
        return $html;
    }
}