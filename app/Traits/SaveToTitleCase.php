<?php
namespace App\Traits;

trait SaveToTitleCase
{
    public function setAttribute($key, $value)
    {
        parent::setAttribute($key, $value);
        if (is_string($value)){
            $string = trim(strtolower($value));
            if ($value !== "email_address") {
                $string = ucwords($string);
            }
            $this->attributes[$key] = $string;
        }
    }


    public function __get($key)
    {
        if (is_string($this->getAttribute($key))) {
            if ($key == "email_address") {
                return strtolower($this->getAttribute($key));
            }
                return ucwords($this->getAttribute($key));
            
        } else {
            return $this->getAttribute($key);
        }
    }
}
