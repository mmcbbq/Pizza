<?php

class Paypal extends Bezahlmethode
{
    private string $email;

    public function bezahlen(): bool
    {

        return true;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }


}