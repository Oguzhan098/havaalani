<?php
class UcusController {
    private $service;

    public function __construct() {
        $this->service = new UcusService();
    }

    public function ucusEkle() {
        $ucak = new Ucak("Boeing", "737", 180, 2015, 1);
        $havaalani = new Havaalani("İstanbul Havalimanı", 3, 50);
        $ucus = new Ucus("İstanbul", "Ankara", 150, strtotime("2025-09-02 10:00"), strtotime("2025-09-02 12:00"), 1, 1);

        $yolcular = [
            new Yolcu("Ahmet", "Yılmaz", "Erkek", 30),
            new Yolcu("Ayşe", "Demir", "Kadın", 25),
        ];

        try {
            echo $this->service->ucusOlustur($ucus, $ucak, $havaalani, $yolcular);
        } catch (Exception $e) {
            echo "Hata: " . $e->getMessage();
        }
    }
}