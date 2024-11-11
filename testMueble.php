<?php
require_once __DIR__ . '/Mueble.php';

$sillaPino = new Mueble(
    id: 2323,
    descripcion: "Silla de Campo",
    detalle: "Sillon cama reclinable de madera",
    stock: 20,
    precio: 74000,
    material: 'Pino'
);
$sillaPino->eliminar();
$sillaPino->guardar();
$sillaPino->modificar([
    'stock' => 25,
]);

// $lista_productos = $sillaPino->listar();
$uno = $sillaPino->seleccionarUno();
print_r($uno);
