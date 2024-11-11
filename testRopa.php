<?php
require_once __DIR__ . '/Ropa.php';

$pantalon = new Ropa(
    id: 9999,
    descripcion: "Pantalon Chino CREW",
    detalle: "Moda europea de pantalon",
    stock: 20,
    precio: 74000,
    talla: 'S'
);
$pantalon->eliminar();
$pantalon->guardar();
$pantalon->modificar([
    'stock' => 55,
    'talla' => 'M'
]);

// $lista_productos = $pantalon->listar();
$uno = $pantalon->seleccionarUno();
print_r($uno);
