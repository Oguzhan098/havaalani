<?php
class UcusService {
    public function ucusOlustur(Ucus $ucus, Ucak $ucak, Havaalani $havaalani, array $yolcular) {
        // Kural 1: Yolcu sayısı uçağın kapasitesini aşamaz
        if ($ucus->yolcu_sayisi > $ucak->kapasite) {
            throw new Exception("Yolcu sayısı uçağın kapasitesini aşamaz!");
        }

        // Kural 2: Başlangıç ve bitiş zamanı
        if ($ucus->baslangic_zamani >= $ucus->bitis_zamani) {
            throw new Exception("Başlangıç zamanı bitişten önce olmalı!");
        }

        // Kural 3: Bir uçak aynı zaman diliminde başka uçuşta olamaz
        // (Veritabanı bağlantısı olsa buradan kontrol yapılır)

        // Kural 4: Bir yolcu aynı zaman aralığında birden fazla uçuş yapamaz
        foreach ($yolcular as $yolcu) {
            // DB sorgusu ile kontrol edilmesi gerekir
        }

        return "Uçuş başarıyla oluşturuldu!";
    }
}

