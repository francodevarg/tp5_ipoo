<?php

declare(strict_types=1);
interface ISerializable
{
    static public function deserializar(array $params): ISerializable;
    public function serializar(): array;
}
