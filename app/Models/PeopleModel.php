<?php
declare(strict_types=1);

class PeopleModel
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Tüm kişileri getir
    public function all(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM person ORDER BY id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Yeni kişi ekle
    public function create(array $data): void
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO person (first_name,last_name,gender,age) 
             VALUES (:f,:l,:g,:a)"
        );
        $stmt->execute([
            ':f' => trim((string)$data['first_name']),
            ':l' => trim((string)$data['last_name']),
            ':g' => trim((string)$data['gender']),
            ':a' => (int)$data['age'],
        ]);
    }
}
