<?php

// registering a new user:

// 1. check if a user with the same email address exists
// 2. if not, create a user
// 3. hash the password
// 4. send the email to confirm activation (we will just display it)
// 5. save the user

// Tip: discuss - email or saving? Chicken-egg problem


include('../bootstrap.php');

use Authentication\Entity\CSVDataSource;
use Authentication\Entity\User;
use Authentication\Repository\UsersRepo;
// 1. fetch user by email
// 2. compare user password hash against given password
// 3. is the user banned? (optional)
// 4. log login (optional)
// 5. store user identifier into the session

// discuss: should the fetching by password happen at database level?
//          Should it happen inside the entity?
//          Or in a service?

$isOk= 0;
if (!empty($_POST)) {
    $dataSource= new CSVDataSource();
    $repo= new UsersRepo($dataSource);
    
    $user= new User($_POST['emailAddress'], $_POST['password']);
    
    $repo->put($user);
 
    print 'Registered- please login<br/>';
    
    include('login.php');
    
} else {

 include ('register-form.php');
}

