<?php
require_once __DIR__ . '/Tecnologia.php';

$memoria = new Tecnologia(
    id: 89,
    descripcion: "Kingston Enterprise ",
    detalle: "tarjeta de memoria power",
    stock: 20,
    precio: 74000,
    garantia: 1
);
$memoria->eliminar();
$memoria->guardar();
$memoria->modificar([
    'detalle' => "tarteja de memoria SD",
]);

// $lista_productos = $memoria->listar();
$uno = $memoria->seleccionarUno();
print_r($uno);
// print_r($lista_productos);
