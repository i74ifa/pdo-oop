<?php


namespace i74ifaDb;

use PDO;
use i74ifaDb\Statements\Select;

class Statement
{
    protected PDO $connect;
    protected string $nameTable;


    public function __construct(PDO $connect, string $nameTable)
    {
        $this->connect = $connect;
        $this->nameTable = $nameTable;
    }

    public function Select(array $code): Select
    {
        return new Select(db: $this->connect, columns: $code, nameTable: $this->nameTable);
    }
}