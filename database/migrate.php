<?php

declare(strict_types=1);
ini_set('display_errors', '1');
error_reporting(E_ALL);

$pdo = require __DIR__ . '/../app/config/database.php';

$queries = [

    // airport tablosu
    "CREATE TABLE IF NOT EXISTS airport (
        id SERIAL PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        pist_sayisi INTEGER NOT NULL,
        ucak_kapasitesi INTEGER NOT NULL
    )",

    // plane tablosu
    "CREATE TABLE IF NOT EXISTS plane (
        id SERIAL PRIMARY KEY,
        brand VARCHAR(255),
        model VARCHAR(255) NOT NULL,
        capacity INTEGER NOT NULL,
        year INTEGER
    )",

    // person tablosu
    "CREATE TABLE IF NOT EXISTS person (
        id SERIAL PRIMARY KEY,
        first_name VARCHAR(255) NOT NULL,
        last_name VARCHAR(255) NOT NULL,
        gender VARCHAR(50),
        age INTEGER
    )",

    // flights tablosu
    "CREATE TABLE IF NOT EXISTS flights (
        id SERIAL PRIMARY KEY,
        departure_airport_id INTEGER NOT NULL REFERENCES airport(id) ON DELETE CASCADE,
        arrival_airport_id INTEGER NOT NULL REFERENCES airport(id) ON DELETE CASCADE,
        plane_id INTEGER NOT NULL REFERENCES plane(id) ON DELETE CASCADE,
        departure_ts TIMESTAMP NOT NULL,
        arrival_ts TIMESTAMP NOT NULL
    )",

    // flight_person tablosu
    "CREATE TABLE IF NOT EXISTS flight_person (
        flight_id INTEGER NOT NULL REFERENCES flights(id) ON DELETE CASCADE,
        person_id INTEGER NOT NULL REFERENCES person(id) ON DELETE CASCADE,
        PRIMARY KEY(flight_id, person_id)
    )"
];

foreach ($queries as $q) {
    $pdo->exec($q);
}

echo "Tüm tablolar oluşturuldu veya mevcut tablolar kullanıldı.\n";
