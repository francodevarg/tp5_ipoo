<?php
require_once __DIR__ . '/Ropa.php';

$memoria = new Ropa(
    id: 89,
    descripcion: "Pantalon Chino CREW",
    detalle: "Moda europea de pantalon",
    stock: 20,
    precio: 74000,
    talla: '25'
);
$memoria->guardar();
$memoria->modificar([
    'stock' => 25,
]);

// $lista_productos = $memoria->listar();
$uno = $memoria->listar();
print_r($uno);

// $memoria->eliminar();