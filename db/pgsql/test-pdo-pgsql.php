<?php
$dsn      = "pgsql:host=127.0.0.1;port=5432;dbname=database1;";
$user     = "postgres";
$password = "password";

try {
    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    echo "Connected successfully!\n";
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage() . "\n");
}
