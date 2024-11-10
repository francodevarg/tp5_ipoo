<?php

declare(strict_types=1);

class DB
{
    private static ?PDO $connection = null;

    public static function connect(): ?PDO
    {
        // Solo crea una conexión si aún no existe
        if (self::$connection === null) {
            try {
                $config = require __DIR__ . "/config.php";

                self::$connection = new PDO(
                    dsn: "mysql:host=" . $config['host'] . ";dbname=" . $config['dbname'],
                    username: $config['username'],
                    password: $config['password'],
                    options: [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
                );
            } catch (PDOException $exception) {
                echo "Connection error: " . $exception->getMessage() . "\n";
                return null;
            }
        }
        return self::$connection;
    }

    public static function disconnect(): void
    {
        self::$connection = null;
    }
}

