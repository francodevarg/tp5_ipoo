<?php
require_once __DIR__.'/Producto.php';
require_once __DIR__.'/Gestionable.php';

class Tecnologia extends Producto{
    protected bool $garantia;
    private const DESCUENTO_ULTIMO_DOMINGO = 0.85; //%15

    public function __construct(int $id, string $nombre, float $precio, bool $garantia) {
        parent::__construct($id, $nombre, $precio); 
        $this->garantia = $garantia;
    }

    public function calcularDescuento():float {
        $esDomingo = date('w') == 0;
        $esUltimaSemanaDelMes = date('j') >= 25; //del 25 hasta 30/31 hay 6/7 dias
        $esUltimoDomingo = $esDomingo && $esUltimaSemanaDelMes;
        // $esUltimoDomingo = true;
        return $esUltimoDomingo ? $this->precio * self::DESCUENTO_ULTIMO_DOMINGO : $this->precio;
    }

    public function guardar():void {
        echo "Guardando la tecnologia: $this->nombre\n";
    }

    public function modificar($valores):void {
        echo "Modificando la tecnologia: $this->nombre\n";
        if (isset($valores['garantia'])) {
            $this->garantia = $valores['garantia'];
        }
        if (isset($valores['precio'])) {
            $this->setPrecio($valores['precio']);
        }
    }

    public function eliminar():void {
        echo "Eliminando la tecnologia: $this->nombre\n";
    }
}
