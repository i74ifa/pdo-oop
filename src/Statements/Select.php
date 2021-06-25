<?php


namespace i74ifaDb\Statements;


use i74ifaDb\Helpers\CodeSql;
use i74ifaDb\Helpers\Methods;
use PDO;

class Select
{
    use Methods;
    protected array $columns;

    protected PDO $db;

    protected array $joins;
    protected array $wheres;
    protected array $orWhere;
    protected $nameTable;

    /**
     * Select constructor.
     * @param PDO $db
     * @param array $columns
     */
    public function __construct(PDO $db, array $columns, string $nameTable)
    {
        $this->db = $db;
        $this->columns = $columns;
        $this->nameTable =$nameTable;
    }

    public function where(array $q): static
    {
        $this->wheres[] = $q;

        return $this;
    }

    public function orWhere(mixed $q): static
    {
        return $this;
    }

    public function whereLike(mixed $q): static
    {
        return $this;
    }

    public function join(string $table, string $on): static
    {
        $this->joins[] = ['table' => $table, 'on' => $on];
        return $this;
    }

    public function execute(): CodeSql
    {
        $props = $this->thisToArray(object: $this);
        return new CodeSql($this->db, (array) array_merge($props, ['table' => $this->nameTable]));
    }
}