<?php


namespace i74ifaDb;


use PDO;

class Connect
{
    protected string $type;
    protected string $dbName;
    protected string $server;
    protected string $dsn;
    protected string $host;
    protected string $attrs;
    public object $connect;

    public function __construct(string $type,$host, $dbName, string $username, string $password,$attrs = '')
    {

        $this->type = $type;
        $this->host = $host;
        $this->dbName = $dbName;
        $this->attrs = $attrs;
        $this->dsn = $this->getDsn();
        $this->connect = new \PDO($this->dsn, $username, $password);

    }

    protected function getHost(): string
    {
        $word = match ($this->type) {
            "mysql", "pgsql" => "host=",
            "sqlsrv" => "server=",
            default => '',
        };

        return $word . $this->host;

    }

    protected function getDb(): string
    {
        $word = match ($this->type) {
            "mysql", "pgsql" => "dbname=",
            "sqlsrv" => "Database=",
            default => ''
        };

        return $word . $this->dbName;
    }
    protected function getDsn(): string
    {
        return $this->type . ':' . $this->getHost() . ';' . $this->getDb() . ';' . $this->attrs;
    }

}