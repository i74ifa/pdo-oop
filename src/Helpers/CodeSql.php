<?php


namespace i74ifaDb\Helpers;


use PDO;

class CodeSql
{
    use Methods;

    protected array $props;
    protected string $columns;
    protected string $joins;
    protected string $wheres;
    public string $sqlCode;
    protected object $prepareCode;
    private PDO $db;

    public function __construct($db, array $props)
    {
        $this->db = $db;
        $this->props = $props;
        if (is_array($props['columns'])){
            $this->columns = $this->arrayToString($props['columns']);
        }
        $this->joins = $this->strJoins();
        $this->wheres = $this->strWhere();
        $this->sqlCode = $this->selectCode($props['table']);
    }

    protected function strJoins(): string
    {
        $joins = '';
        if ($this->props['joins']??''){
            foreach ($this->props['joins'] as $join) {
                $joins .= " JOIN " . $join['table'] . ' ON ' . $join['on'];
            }
            return $joins;
        }

        return '';
    }

    protected function strWhere(): string
    {
        if($this->props['wheres']??''){
            $wheres = '';
            foreach ($this->props['wheres'] as $where) {
                foreach ($where as $col => $word) {
                    $wheres .= ' WHERE ' . $col . ' = ' . $this->randomColumn($word);
                }
            }
            return $wheres;
        }
        return  '';

    }

    protected function selectCode($table): string
    {
        return 'SELECT ' . $this->columns . ' FROM ' . $table . $this->joins . $this->wheres;
    }
    protected function prepare(): bool|\PDOStatement
    {
        $pre = $this->db->prepare($this->sqlCode);
        $pre->execute($this->columnsRand);
        return $pre;
    }
    protected function arrayToString(array $array): string
    {
        $array = preg_replace("/[,\\s]/", '', $array);
        return implode(', ', $array);
    }
    public function get($props = PDO::FETCH_ASSOC): array
    {
        return $this->prepare()->fetchAll($props);
    }
}

