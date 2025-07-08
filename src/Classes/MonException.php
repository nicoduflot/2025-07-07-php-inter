<?php
namespace App;

class MonException extends \Exception{
    private $toto;
    public function __construct($message, $code = 0){
        parent::__construct($message, $code);
        $this->toto = $code;
    }

    public function __toString(): string
    {
        return $this->getMessage();
    }

    /**
     * Get the value of toto
     */ 
    public function getToto()
    {
        return $this->toto;
    }
}