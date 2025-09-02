<?php
// app/Entities/Flight.php

class Flight {
    public $id;
    public $nereden;
    public $nereye;
    public $yolcu_sayisi;
    public $baslangic_zamani;
    public $bitis_zamani;
    public $ucak_id;
    public $havaalani_id;

    public function __construct($nereden, $nereye, $yolcu_sayisi, $baslangic_zamani, $bitis_zamani, $ucak_id, $havaalani_id) {
        $this->nereden = $nereden;
        $this->nereye = $nereye;
        $this->yolcu_sayisi = $yolcu_sayisi;
        $this->baslangic_zamani = $baslangic_zamani;
        $this->bitis_zamani = $bitis_zamani;
        $this->ucak_id = $ucak_id;
        $this->havaalani_id = $havaalani_id;
    }
}
