<?php
declare(strict_types=1);
require_once __DIR__.'/IGestionable.php';
require_once __DIR__.'/ISerializable.php';

abstract class Producto implements IGestionable, ISerializable {
    protected int $id;
    protected string $descripcion;
    protected string $detalle;
    protected float $precio;
    protected int $stock;

    public function __construct(int $id, string $descripcion,string $detalle,float $precio,int $stock) {
        $this->id = $id;
        $this->descripcion = $descripcion;
        $this->detalle = $detalle;
        $this->precio = $precio;
        $this->stock = $stock;
    }

    abstract public function calcularDescuento(): float;
    public function setPrecio(float $precio): void {
        $this->precio = $precio;
    }
    public function getPrecio(): float {
        return $this->precio;
    }

    public function getStock(): int {
        return $this->stock;
    }
    public function getId(): int 
    {
        return $this->id;
    }
    public function getDetalle(): string {
        return $this->detalle;
    }
    public function getDescripcion(): string 
    {
        return $this->descripcion;
    }
    public function obtenerInformacion():string {
        return "ID: {$this->id}, Detalle: {$this->detalle}, Precio: {$this->precio}";
    }
}
