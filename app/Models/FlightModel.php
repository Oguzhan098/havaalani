<?php
declare(strict_types=1);

class FlightModel
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAll(): array
    {
        $sql = "SELECT f.id,
                       dep.name AS dep_airport, arr.name AS arr_airport,
                       f.departure_ts, f.arrival_ts,
                       p.model AS plane_model,
                       (SELECT COALESCE(json_agg(json_build_object('first_name', pe.first_name, 'last_name', pe.last_name)), '[]'::json)
                        FROM flight_person fp 
                        JOIN person pe ON pe.id = fp.person_id
                        WHERE fp.flight_id = f.id) AS passengers
                FROM flights f
                JOIN airport dep ON dep.id = f.departure_airport_id
                JOIN airport arr ON arr.id = f.arrival_airport_id
                JOIN plane   p   ON p.id   = f.plane_id
                ORDER BY f.departure_ts DESC";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(array $data): void
    {
        try {
            $this->pdo->beginTransaction();

            $stmt = $this->pdo->prepare(
                "INSERT INTO flights 
                 (departure_airport_id, arrival_airport_id, plane_id, departure_ts, arrival_ts)
                 VALUES (:dep,:arr,:plane,:dts,:ats) RETURNING id"
            );
            $stmt->execute([
                ':dep'   => (int)$data['departure_airport_id'],
                ':arr'   => (int)$data['arrival_airport_id'],
                ':plane' => (int)$data['plane_id'],
                ':dts'   => (string)$data['departure_ts'],
                ':ats'   => (string)$data['arrival_ts'],
            ]);

            $flightId = (int)$stmt->fetchColumn();

            if (!empty($data['passenger_ids']) && is_array($data['passenger_ids'])) {
                $ins = $this->pdo->prepare(
                    "INSERT INTO flight_person (flight_id, person_id) VALUES (:f,:p)"
                );
                foreach ($data['passenger_ids'] as $pid) {
                    $ins->execute([':f' => $flightId, ':p' => (int)$pid]);
                }
            }

            $this->pdo->commit();
        } catch (Throwable $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }

    public function delete(int $flightId): void
    {
        $this->pdo->prepare("DELETE FROM flight_person WHERE flight_id = :id")->execute([':id' => $flightId]);
        $this->pdo->prepare("DELETE FROM flights WHERE id = :id")->execute([':id' => $flightId]);
    }

    // ─── Yolcu ekle/çıkar ───────────────────────────────
    public function addPassenger(int $flightId, int $personId): void
    {
        $stmt = $this->pdo->prepare("INSERT INTO flight_person (flight_id, person_id) VALUES (:f,:p)");
        $stmt->execute([':f' => $flightId, ':p' => $personId]);
    }

    public function removePassenger(int $flightId, int $personId): void
    {
        $stmt = $this->pdo->prepare("DELETE FROM flight_person WHERE flight_id=:f AND person_id=:p");
        $stmt->execute([':f' => $flightId, ':p' => $personId]);
    }

    public function getFlightById(int $flightId): array|false
    {
        $stmt = $this->pdo->prepare(
            "SELECT f.id, dep.name dep_airport, arr.name arr_airport, f.departure_ts, f.arrival_ts, p.model plane_model
             FROM flights f
             JOIN airport dep ON dep.id=f.departure_airport_id
             JOIN airport arr ON arr.id=f.arrival_airport_id
             JOIN plane p ON p.id=f.plane_id
             WHERE f.id=:id"
        );
        $stmt->execute([':id' => $flightId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getPassengers(int $flightId): array
    {
        $stmt = $this->pdo->prepare(
            "SELECT pe.id, pe.first_name, pe.last_name
             FROM flight_person fp
             JOIN person pe ON pe.id=fp.person_id
             WHERE fp.flight_id=:id
             ORDER BY pe.id"
        );
        $stmt->execute([':id' => $flightId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllPeople(): array
    {
        return $this->pdo->query("SELECT id, first_name, last_name FROM person ORDER BY id")->fetchAll(PDO::FETCH_ASSOC);
    }
}
