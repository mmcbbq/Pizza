<?php

class Barzahlung extends Bezahlmethode
{
    private float $cash;
    public function wechselGeld():float
    {
        return 8.12;
    }

    public function bezahlen(): bool
    {
        if ($this->cash >= $this->betrag){
            return true;
        } else{
            return false;
        }
    }

    /**
     * @return float
     */
    public function getCash(): float
    {
        return $this->cash;
    }

    /**
     * @param float $cash
     */
    public function setCash(float $cash): void
    {
        $this->cash = $cash;
    }

}