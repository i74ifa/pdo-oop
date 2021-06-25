<?php


namespace i74ifaDb\Statements;
use i74ifaDb\Statements\Update;

class Insert
{
    public function Get($val = null)
    {
        if ($val)
            return  new Update($val);
        return "Good";
    }
}