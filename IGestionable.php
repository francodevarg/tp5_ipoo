<?php
interface IGestionable {
    public function guardar();
    public function modificar(array $valores);
    public function eliminar();
    public function listar(): ?array;
    public function seleccionarUno():?array;
}