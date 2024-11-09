<?php
interface IGestionable {
    public function guardar();
    public function modificar($valores);
    public function eliminar();
}