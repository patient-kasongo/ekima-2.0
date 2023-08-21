<?php
require VENDOR;
\App\Authentification::accessBlocker();
$pdo=\App\Database::getPdo();
$auth=new \App\Authentification($pdo);
if($auth->isConnect() != null){
    $auth->logout();
    header("Location:/public");
}
