<?php

class Pasta implements Bezahlung
{

    private string $name;
    private string $bezeichnung;
    private float $preis;

    /**
     * @param string $name
     * @param string $bezeichnung
     * @param float $preis
     */
    public function __construct(string $name, string $bezeichnung, float $preis)
    {
        $this->name = $name;
        $this->bezeichnung = $bezeichnung;
        $this->preis = $preis;
    }


    public function getPreis(): float
    {
        return $this->preis;
    }

    public function html(): string
    {
        return  $html = "<div>{$this->name}   {$this->getPreis()} </div>";
    }
}