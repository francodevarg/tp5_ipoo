<?php
interface Gestionable {
    public function guardar();
    public function modificar($valores);
    public function eliminar();
}