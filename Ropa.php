<?php
require_once __DIR__.'/Producto.php';
require_once __DIR__.'/Query.php';

class Ropa extends Producto{
    private string $talla;
    private const DESCUENTO_REBAJAS = 0.90;
    private Query $query;

    public function __construct(int $id, string $descripcion,string $detalle, float $precio, int $stock, string $talla) {
        parent::__construct($id,$descripcion,$detalle,$precio,$stock); 
        $this->talla = $talla;
        $this->query = new Query(strtolower($this::class));
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

    public function modificar(array $valores): void {
        echo "Modificando la ropa: $this->detalle\n";

        // Validar los campos antes de modificar
        if (!$this->sonCamposValidos($valores)) {
            throw new Exception("Los valores proporcionados no son válidos.");
        }

        // Actualizar los valores de la instancia con los nuevos valores
        foreach ($valores as $campo => $valor) {
            if (property_exists($this, $campo)) {
                $this->$campo = $valor;
            }
        }

        // Ejecutar la query de actualización
        $this->query->update($valores, 'id' ,$this->id);
    }


    private function sonCamposValidos(array $valores): bool {
        // Validar 'descripcion' (string no vacío)
        if (isset($valores['descripcion']) && !is_string($valores['descripcion'])) {
            return false;
        }

        // Validar 'detalle' (string no vacío)
        if (isset($valores['detalle']) && !is_string($valores['detalle'])) {
            return false;
        }

        // Validar 'precio' (float mayor a 0)
        if (isset($valores['precio']) && (!is_float($valores['precio']) || $valores['precio'] <= 0)) {
            return false;
        }

        // Validar 'stock' (int mayor o igual a 0)
        if (isset($valores['stock']) && (!is_int($valores['stock']) || $valores['stock'] < 0)) {
            return false;
        }

        if (isset($valores['talla']) && (!is_string($valores['talla']))) {
            return false;
        }

        return true;
    }

    public function eliminar() {
        echo "Eliminando la ropa: $this->descripcion\n";
        $this->query->delete('id' ,$this->id);
    }

    public function listar(): ?array
    {
        echo "Listar" .PHP_EOL;
        $ropas =  $this->query->selectAll();
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
