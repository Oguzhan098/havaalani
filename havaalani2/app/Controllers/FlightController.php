<?php
// app/Controllers/FlightController.php
require_once __DIR__ . "/../Models/FlightModel.php";
require_once __DIR__ . "/../Entities/Flight.php";

class   FlightController {
    private $model;

    public function __construct() {
        $this->model = new FlightModel();
    }

    public function index() {
        $flights = $this->model->getAllFlights();
        require __DIR__ . "/../Views/flights.php";
    }

    public function store($data) {
        $flight = new Flight(
            $data['nereden'],
            $data['nereye'],
            $data['yolcu_sayisi'],
            $data['baslangic_zamani'],
            $data['bitis_zamani'],
            $data['ucak_id'],
            $data['havaalani_id']
        );
        $this->model->createFlight($flight);
        header("Location: /"); // anasayfaya yönlendir
    }
}
