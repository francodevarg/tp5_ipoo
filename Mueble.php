<?php
require_once __DIR__.'/Producto.php';
require_once __DIR__.'/Gestionable.php';

class Mueble extends Producto{
    private string $material;
    private const DESCUENTO_MATERIAL_PINO = 0.93; //%7

    public function __construct(int $id, string $nombre, float $precio, string $material) {
        parent::__construct($id, $nombre, $precio); 
        $this->material = $material;
    }

    public function calcularDescuento():float {
        $esPino = strtolower($this->material) === 'pino';
        return $esPino ? $this->precio * self::DESCUENTO_MATERIAL_PINO : $this->precio;
    }

    public function guardar():void {
        echo "Guardando la mueble: $this->nombre\n";
    }

    public function modificar($valores):void {
        echo "Modificando la mueble: $this->nombre\n";
        if (isset($valores['material'])) {
            $this->material = $valores['material'];
        }
        if (isset($valores['precio'])) {
            $this->setPrecio($valores['precio']);
        }
    }

    public function eliminar():void {
        echo "Eliminando la mueble: $this->nombre\n";
    }
}
