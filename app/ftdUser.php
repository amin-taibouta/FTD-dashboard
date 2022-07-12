<?php

namespace App;
use Illuminate\Support\Facades\Hash;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class ftdUser implements AuthenticatableContract
{
    private $_data;

    public function __construct(Array $properties=[]){
      $this->_data = $properties;
    }

    public function __set($property, $value){
      return $this->_data[$property] = $value;
    }

    public function __get($property){
      return array_key_exists($property, $this->_data)
        ? $this->_data[$property]
        : null
      ;
    }

    public function getAuthIdentifierName(){
        return "id";
    }

    public function getAuthIdentifier(){
        return $this->id;
    }

    public function getAuthPassword(){
        return Hash::make($this->password);
    }

    public function getRememberToken(){
        return null;
    }

    public function setRememberToken($value){
        return null;
    }

    public function getRememberTokenName(){
        return null;
    }
}
