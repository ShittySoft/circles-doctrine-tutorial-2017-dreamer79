<?php

namespace Authentication\Entity;

class User
{
    public $email;
    public $password;
    
    public function __construct($email, $password) {
        $this->email = $email;
        $this->password= md5($password);
    }
    
    public function checkPassword($password) {
        return (md5($password) == $this->password);
    }
}
