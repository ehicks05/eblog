<?php

class User {
  public $userid;
  public $name;
  public $password;
  public $email;
  public $public;
  
  function __construct() {
  
  }
  
  function __get($name) {
    return this->$name;
  }
  function __set($name, $value) {
    this->$name = $value;
  }
}

?>