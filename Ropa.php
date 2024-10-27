<?php
require_once __DIR__.'/Producto.php';
require_once __DIR__.'/Gestionable.php';

class Ropa extends Producto{
    private string $talle;
    private const DESCUENTO_REBAJAS = 0.90;

    public function __construct(int $id, string $nombre, float $precio, string $talle) {
        parent::__construct($id, $nombre, $precio); 
        $this->talle = $talle;
    }

    public function calcularDescuento(): float {
        // Aplicar el descuento si es temporada de rebajas
        return $this->precio * self::DESCUENTO_REBAJAS;
    }

    // // Implementación de los métodos de la interfaz Gestionable
    public function guardar():void {
        echo "Guardando la ropa: $this->nombre\n";
    }

    public function modificar($valores):void {
        echo "Modificando la ropa: $this->nombre";
        if (isset($valores['talle'])) {
            echo "| Talle $this->talle -> ".$valores['talle'];
            $this->talle = $valores['talle'];
        }
        if (isset($valores['precio'])) {
            echo "| Precio {$this->getPrecio()} -> ".$valores['precio'];
            $this->setPrecio($valores['precio']);
        }
        echo "\n";
    }

    public function eliminar() {
        echo "Eliminando la ropa: $this->nombre\n";
    }
}
