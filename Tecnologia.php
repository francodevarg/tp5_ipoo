<?php
require_once __DIR__.'/Producto.php';
require_once __DIR__.'/Query.php';

class Tecnologia extends Producto{
    private int $garantia;
    private Query $query;
    private const TABLE = 'tecnologia';

    private const DESCUENTO_ULTIMO_DOMINGO = 0.85; //%15

    public function __construct(int $id, string $descripcion,string $detalle, float $precio, int $stock, int $garantia) {
        parent::__construct($id,$descripcion,$detalle,$precio,$stock); 
        $this->garantia = $garantia;
        $this->query = new Query(self::TABLE);
    }

    public function calcularDescuento():float {
        $esDomingo = date('w') == 0;
        $esUltimaSemanaDelMes = date('j') >= 25; //del 25 hasta 30/31 hay 6/7 dias
        $esUltimoDomingo = $esDomingo && $esUltimaSemanaDelMes;
        // $esUltimoDomingo = true;
        return $esUltimoDomingo ? $this->precio * self::DESCUENTO_ULTIMO_DOMINGO : $this->precio;
    }

    public function guardar():void {
        $this->query->insert($this->serializar());
    }

    public function modificar(array $valores): void {
        echo "Modificando la tecnologia: $this->detalle\n";

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

        // Validar 'garantia' (int mayor o igual a 0)
        if (isset($valores['garantia']) && (!is_int($valores['garantia']) || $valores['garantia'] < 0)) {
            return false;
        }

        return true;
    }

    public function eliminar():void {
        echo "Eliminando la tecnologia: $this->detalle\n";
        $this->query->delete('id' ,$this->id);
    }


    public function listar(): ?array
    {
        echo "Listar" .PHP_EOL;
        $productos =  $this->query->selectAll();
        return $productos;
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
            "garantia" => $this->garantia
        ];
    }

    // convertir un array en un objeto de la propia clase
    static public function deserializar(array $params): Self
    {
        return new Tecnologia(
            id: $params["id"],
            descripcion: $params["descripcion"],
            detalle: $params["detalle"],
            precio: $params["precio"],
            stock: $params["stock"],
            garantia: $params["garantia"]
        );
    }
    public function seleccionarUno(): ?array
    {
        return $this->query->selectOne('id',$this->id);
    }
}
