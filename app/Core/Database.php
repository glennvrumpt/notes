<?php

namespace App\Core;

use PDO;
use PDOStatement;

class Database
{
    protected PDO $connection;
    protected PDOStatement $statement;

    public function __construct(array $config, string $username = 'root', string $password = '')
    {
        $dsn = 'mysql:' . http_build_query($config, '', ';');

        $this->connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    public function execute(string $query, array $params = []): void
    {
        $this->statement = $this->connection->prepare($query);

        $this->statement->execute($params);

        $this;
    }

    public function get(): array
    {
        return $this->statement->fetchAll();
    }

    public function find(): mixed
    {
        return $this->statement->fetch();
    }
}
