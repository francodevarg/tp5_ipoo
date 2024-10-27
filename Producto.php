<?php
declare(strict_types=1);
require_once __DIR__.'/Gestionable.php';

abstract class Producto implements Gestionable {
    protected int $id;
    protected string $nombre;
    protected float $precio;

    public function __construct(int $id, string $nombre, float $precio) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->precio = $precio;
    }

    abstract public function calcularDescuento(): float;
    public function setPrecio(float $precio): void {
        $this->precio = $precio;
    }
    public function getPrecio(): float {
        return $this->precio;
    }
    public function getId(): int 
    {
        return $this->id;
    }
    public function obtenerInformacion():string {
        return "ID: {$this->id}, Nombre: {$this->nombre}, Precio: {$this->precio}";
    }
}
