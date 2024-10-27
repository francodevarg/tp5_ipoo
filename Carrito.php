<?php

class Carrito {
    private $productos = [];

    public function agregarProducto(Producto $producto) {
        $producto->guardar();
        $this->productos[$producto->getId()] = $producto;
    }

    public function modificarProducto(int $id, array $valores): void {
        // Validar si el producto existe en el carrito
        if (!isset($this->productos[$id])) {
            echo "No se puede modificar: Producto con ID {$id} no se encuentra en el carrito.\n";
            return;
        }
        
        // Modificar el producto
        $this->productos[$id]->modificar($valores);
    }


    public function eliminarProducto(int $id): void {
        // Validar si el producto existe en el carrito
        if (!isset($this->productos[$id])) {
            echo "No se puede Eliminar: Producto con ID {$id} no se encuentra en el carrito.\n";
            return;
        }
        
        // Eliminar el producto
        $this->productos[$id]->eliminar();
        unset($this->productos[$id]);
    }
    public function obtenerProductos():array {
        return $this->productos;
    }
}
