<?php


namespace i74ifaDb\Statements;


class Update
{
    private $val;

    public function __construct($val)
    {
        $this->val = $val;
    }
    public function Update(): string
    {
        return "Welcome " . $this->val;
    }
}