<?php

namespace i74ifaDb;

use i74ifaDb\Statements\Select;

class DB
{
    public object $connect;

    public function __construct(string $type,$host, $dbName, string $username, string $password,$attrs = '')
    {
        $this->connect = (new Connect($type, $host, $dbName, $username, $password, $attrs))->connect;
    }

    public function table($name): Statement
    {
        return new Statement($this->connect, $name);
    }
}