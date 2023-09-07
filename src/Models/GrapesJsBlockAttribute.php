<?php

namespace Ekremogul\FilamentGrapesjs\Models;

class GrapesJsBlockAttribute
{
    private string $key;
    private mixed $value;

    /**
     * @param string $key Attribute key, eg. `data-attribute`, `class`, `id`, etc.
     * @param mixed $value Attribute value, eg. `my-value`
     */
    public function __construct(string $key, mixed $value)
    {
        $this->key = $key;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @return mixed
     */
    public function getValue(): mixed
    {
        return $this->value;
    }

}
