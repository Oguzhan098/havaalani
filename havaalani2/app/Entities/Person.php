<?php
// app/Entities/Person.php

class Person {
    public $id;
    public $ad;
    public $soyad;
    public $cinsiyet;
    public $yas;

    public function __construct($ad, $soyad, $cinsiyet, $yas) {
        $this->ad = $ad;
        $this->soyad = $soyad;
        $this->cinsiyet = $cinsiyet;
        $this->yas = $yas;
    }
}
