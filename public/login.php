<?php

include('../bootstrap.php');

error_reporting(30719);
ini_set('display_errors', true);

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
    
    $user= $repo->get($_POST['emailAddress']);
    $isOk = (!empty($user) && $user->checkPassword($_POST['password']));
    
    if (!$isOk) {
        print 'BAD LOGIN<br/>';
        
        include ('login-form.php');
    } else {
        print 'welcome :)';
    }
} else {
 include ('login-form.php');

}
