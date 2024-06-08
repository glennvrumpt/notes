<?php

function dd(mixed $value): void
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';

    die();
}

function urlIs(string $value): bool
{
    return $_SERVER['REQUEST_URI'] === $value;
}


function base_path(string $path): string
{
    return BASE_PATH . $path;
}

function view(string $path, array $attributes = []): string
{
    extract($attributes);

    return base_path('views/' . $path);
}
