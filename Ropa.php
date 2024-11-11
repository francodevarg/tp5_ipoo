<?php
require_once __DIR__.'/Producto.php';
require_once __DIR__.'/Query.php';

class Ropa extends Producto{
    private string $talla;
    private const DESCUENTO_REBAJAS = 0.90;

    private Query $query;
    private const TABLE = 'ropa';

    public function __construct(int $id, string $descripcion,string $detalle, float $precio, int $stock, string $talla) {
        parent::__construct($id,$descripcion,$detalle,$precio,$stock); 
        $this->talla = $talla;
        $this->query = new Query(self::TABLE);
    }

    public function calcularDescuento(): float {
        // Aplicar el descuento si es temporada de rebajas
        return $this->precio * self::DESCUENTO_REBAJAS;
    }

    // // Implementación de los métodos de la interfaz Gestionable
    public function guardar():void {
        echo "Guardando la ropa: $this->descripcion\n";
        $this->query->insert($this->serializar());
    }

    public function modificar($valores):void {
        echo "Modificando la ropa: $this->descripcion";
        if (isset($valores['talla'])) {
            echo "| talla $this->talla -> ".$valores['talla'];
            $this->talla = $valores['talla'];
        }
        if (isset($valores['precio'])) {
            echo "| Precio {$this->getPrecio()} -> ".$valores['precio'];
            $this->setPrecio($valores['precio']);
        }
        echo "\n";
    }

    public function eliminar() {
        echo "Eliminando la ropa: $this->descripcion\n";
    }

    public function listar(): ?array
    {
        echo "Listar" .PHP_EOL;
        $ropas =  $this->query->selectAll(self::TABLE);
        return $ropas;
    }

    // convertir un objeto en un array
    public function serializar(): array
    {
        return [
            "id" => $this->getId(),
            "descripcion" => $this->getDescripcion(),
            "detalle" => $this->getDetalle(),
            "precio" => $this->getPrecio(),
            "stock" => $this->getStock(),
            "talla" => $this->talla
        ];
    }

    // convertir un array en un objeto de la propia clase
    static public function deserializar(array $params): Self
    {
        return new Ropa(
            id: $params["id"],
            descripcion: $params["descripcion"],
            detalle: $params["detalle"],
            precio: $params["precio"],
            stock: $params["stock"],
            talla: $params["talla"]
        );
    }

    public function seleccionarUno(): ?array
    {
        return $this->query->selectOne('id',$this->id);
    }
}
