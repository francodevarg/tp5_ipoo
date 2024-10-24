<?php
declare(strict_types=1);

abstract class Producto {
    protected int $id;
    protected string $nombre;
    protected float $precio;

    public function __construct(int $id, string $nombre, float $precio) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->precio = $precio;
    }

    abstract public function calcularDescuento(): float;

    public function getId(): int {
        return $this->id;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function getPrecio(): float {
        return $this->precio;
    }

    public function setPrecio(float $precio): void {
        $this->precio = $precio;
    }
}
