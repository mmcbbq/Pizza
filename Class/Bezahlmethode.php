<?php

abstract class Bezahlmethode
{
    protected int $betrag;
    protected int $gebuehr;
    abstract public function bezahlen():bool;


}