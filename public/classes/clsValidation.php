<?php
class Validation
{
    public function clsRequired($Value):bool
    {
        return trim($Value)==!'';
    }
   

  public function clsLength($Value,$Length):bool
    {

    return mb_strlen($Value)>=$Length;

    }

    public function clsInputMatching ($Value):bool
    {
        return preg_match('/^[0-9]+$/',$Value)===1;
    }
     public function clsInputCheckDeciml ($Value):bool
    {
        return is_numeric($Value);
    }


      public function clsRequiredId($Value):bool
    {
        return !empty(trim($Value));
    }

    public function IsClean($value)
{
    return preg_match('/^[\p{L}\p{N}]+$/u', $value);
}
}