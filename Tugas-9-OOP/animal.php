<?php
class Animal
{
    public $name;
    public $legs = 4;
    public $cold_bloaded = 'no';
    public function __construct($str)
    {
        $this->name = $str;
    }
}
