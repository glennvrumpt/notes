<?php

namespace App\Core;

class Container
{
    protected array $bindings = [];

    public function bind(string $key, callable $resolver): void
    {
        $this->bindings[$key] = $resolver;
    }

    public function resolve(string $key): mixed
    {
        if (!array_key_exists($key, $this->bindings)) {
            throw new \Exception('No matching binding found for ' . $key);
        }

        $resolver = $this->bindings[$key];

        return call_user_func($resolver);
    }
}
