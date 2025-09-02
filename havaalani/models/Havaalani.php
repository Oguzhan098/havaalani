<?php
class Havaalani {
    public $ad;
    public $pist_sayisi;
    public $ucak_kapasitesi;

    public function __construct($ad, $pist_sayisi, $ucak_kapasitesi) {
        $this->ad = $ad;
        $this->pist_sayisi = $pist_sayisi;
        $this->ucak_kapasitesi = $ucak_kapasitesi;
    }
}
