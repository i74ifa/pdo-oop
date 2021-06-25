<?php


namespace i74ifaDb\Helpers;


trait Methods
{
    protected string $startColName = 'col';
    protected int $countColName = 0;
    protected array $columnsRand;
    public function thisToArray(object $object): array
    {
        $props = [];
        foreach ($this as $key => $row){
            $props[$key] = $row;
        }
        return $props;
    }

    protected function randomColumn(mixed $value): string
    {
        $int = $this->countColName +=1;
        $str = ':' . $this->startColName;
        $this->columnsRand[$str . $int] = $value;
        return $str . $int;
    }
}