<?php
define("VENDOR", dirname(__DIR__).DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php');
define("VIEWS_PATH",dirname(__DIR__).DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR);

require VENDOR;

$router = new AltoRouter();
$router->map('GET|POST', '/public/','home','home');
$router->map('GET|POST', '/public/login','login','login');
$router->map('GET|POST', '/public/logout','logout','logout');
$router->map('GET|POST', '/public/addScolarYear','addScolarYear','addScolarYear');
$router->map('GET|POST', '/public/modifie-annee-[i:idAnnee]','modifieAnnee','modifieAnnee');
$router->map('GET|POST', '/public/annee-[i:idAnnee]-classes','viewClasses','viewClasses');
$router->map('GET|POST', '/public/gestion-payement','gestion_payement','gestion_payement');
$match = $router->match();

if(isset($match['target'])){
    ob_start();
    require VIEWS_PATH.$match['target'].'.php';
    $contents = ob_get_clean();
    require VIEWS_PATH."page.php";
}else{
    require VIEWS_PATH."404.php";
}