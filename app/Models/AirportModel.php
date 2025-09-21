<?php
declare(strict_types=1);

class AirportModel
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Tüm havalimanlarını getir
     */
    public function getAll(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM airport ORDER BY id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Yeni havalimanı ekle
     */
    public function create(array $data): void
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO airport (name, pist_sayisi, ucak_kapasitesi) 
             VALUES (:name, :pist_sayisi, :ucak_kapasitesi)"
        );
        $stmt->execute([
            ':name' => trim((string)$data['name']),
            ':pist_sayisi' => (int)$data['pist_sayisi'],
            ':ucak_kapasitesi' => (int)$data['ucak_kapasitesi'],
        ]);
    }

    /**
     * İsteğe bağlı: Havalimanını ID ile getir
     */
    public function getById(int $id): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM airport WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }
}
