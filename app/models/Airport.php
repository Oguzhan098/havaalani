<?php

declare(strict_types=1);

class Airport
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAll(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM airport ORDER BY id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
