<?php

declare(strict_types=1);
require_once __DIR__.'/DB.php';

class Query
{
    private ?PDO $connection;
    
    private string $table;

    public function __construct(string $table)
    {
        // Usa la conexión compartida de DB
        $this->connection = DB::connect();
        $this->table = $table;
    }

    public function __destruct()
    {
        DB::disconnect();
    }
    /**
     * Método para insertar datos en una tabla
     */
    public function insert(array $data): bool
    {
        $columns = implode(", ", array_keys($data));
        $placeholders = implode(", ", array_map(fn($key) => ":$key", array_keys($data)));
        $sql = "INSERT INTO $this->table ($columns) VALUES ($placeholders)";

        $stmt = $this->connection->prepare($sql);
        return $stmt->execute($data);
    }

    /**
     * Método para actualizar datos en una tabla
     */
    public function update( array $data, string $whereColumn, $whereValue): bool
    {
        $setClause = implode(", ", array_map(fn($key) => "$key = :$key", array_keys($data)));
        $sql = "UPDATE $this->table SET $setClause WHERE $whereColumn = :whereValue";

        $data['whereValue'] = $whereValue;

        $stmt = $this->connection->prepare($sql);
        return $stmt->execute($data);
    }

    /**
     * Método para eliminar datos de una tabla
     */
    public function delete(string $whereColumn, $whereValue): bool
    {
        $sql = "DELETE FROM $this->table WHERE $whereColumn = :whereValue";
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute(['whereValue' => $whereValue]);
    }

    /**
     * Método para obtener múltiples registros de una tabla
     */
    public function selectAll(): ?array
    {
        $sql = "SELECT * FROM $this->table";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Método para obtener un solo registro de una tabla
     */
    public function selectOne(string $whereColumn, $whereValue): ?array
    {
        $sql = "SELECT * FROM $this->table WHERE $whereColumn = :whereValue LIMIT 1";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(['whereValue' => $whereValue]);
        echo $sql;
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }
}
