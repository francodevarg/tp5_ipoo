<?php

require_once __DIR__.'/Ropa.php';
require_once __DIR__.'/Tecnologia.php';
require_once __DIR__.'/Carrito.php';
require_once __DIR__.'/Mueble.php';

// Creamos algunos productos
$camisa = new Ropa(1, "Camisa", 50.00, "M");
$pantalon = new Ropa(2, "Pantalón", 70.00, "L");
$silla = new Mueble(8, "Silla Pino", 100.00, "Pino");
$telefono = new Tecnologia(3, "Samsung S3", 700.00, false);
$pc = new Tecnologia(4, "Notebook Asus", 1550.00, true);

$carrito = new Carrito();

$carrito->agregarProducto($camisa);
$carrito->agregarProducto($pantalon);
$carrito->agregarProducto($telefono);
$carrito->agregarProducto($pc);
$carrito->agregarProducto($silla);
$carrito->modificarProducto($pantalon->getId(), ['talle' => 'L', 'precio' => 950.0]);
$carrito->eliminarProducto($camisa->getId());
echo "===============================". "\n";;
echo "Mostrando Productos del Carrito: ". "\n";;
foreach ($carrito->obtenerProductos() as $producto) {
    echo $producto->obtenerInformacion() . "\n";
    echo "Precio con descuento: " . $producto->calcularDescuento() . "\n\n";
}