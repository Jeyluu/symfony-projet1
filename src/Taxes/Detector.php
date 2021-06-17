<?php

namespace App\Taxes;

class Detector
{
    protected $seuil;
    public function __construct($seuil)
    {
        $this->seuil = $seuil;
    }

    public function detect(float $montant): bool
    {
        if ($montant > $this->seuil) {
            return $montant = true;
        } else {
            return $montant = false;
        }
    }
}
