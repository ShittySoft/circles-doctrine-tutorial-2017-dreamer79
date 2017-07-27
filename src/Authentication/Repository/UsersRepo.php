<?php

namespace Authentication\Repository;

use Authentication\Entity\User;
use Authentication\Repository\Users;

class UsersRepo implements Users {
    protected $dataSource;
    
    public function __construct($dataSource) {
        $this->dataSource= $dataSource;
    }
    
    public function get(string $emailAddress)  {
       return $this->dataSource->getByEmail($emailAddress);
    }
    
    public function put(User $user) {
        return $this->dataSource->saveUser($user);
    }
}

