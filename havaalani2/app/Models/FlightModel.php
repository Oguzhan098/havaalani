<?php
// app/Models/FlightModel.php
require_once __DIR__ . "/../../config/database.php";

class FlightModel {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getAllFlights() {
        $stmt = $this->db->query("SELECT * FROM ucus");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createFlight($flight) {
        $stmt = $this->db->prepare("
            INSERT INTO ucus (nereden, nereye, yolcu_sayisi, baslangic_zamani, bitis_zamani, ucak_id, havaalani_id)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
        return $stmt->execute([
            $flight->nereden,
            $flight->nereye,
            $flight->yolcu_sayisi,
            $flight->baslangic_zamani,
            $flight->bitis_zamani,
            $flight->ucak_id,
            $flight->havaalani_id
        ]);
    }
}
