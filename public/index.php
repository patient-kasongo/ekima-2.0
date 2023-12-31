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
$router->map('GET|POST', '/public/modify-option-[i:idOption]','modifieOption','modifieOption');
$router->map('GET|POST', '/public/modify-classe-[i:idClasse]','modifieClasse','modifieClasse');
$router->map('GET|POST', '/public/annee-[i:idAnnee]-classes','viewClasses','viewClasses');
$router->map('GET|POST', '/public/annee-[i:idAnnee]-classes-[i:idClasse]','viewPupilsInClass','viewPupilsInClass');
$router->map('GET|POST', '/public/annee-[i:idAnnee]-add-pupil','addPupil','addPupil');
$router->map('GET|POST', '/public/annee-[i:idAnnee]-classe-[i:idClasse]-pupil-[a:matricule]','viewPupilDetail','viewPupilDetail');
$router->map('GET|POST', '/public/annee-[i:idAnnee]-classe-[i:idClasse]-pupil-[a:matricule]-modify','modifyPupil','modifyPupil');
$router->map('GET|POST', '/public/annee-[i:idAnnee]-pupil-[a:matricule]-payement','gestion_payement','gestion_payement');
$router->map('GET|POST', '/public/gestion-classe','gestion_classe','gestion_classe');
$router->map('GET|POST', '/public/gestion-classe-add-classe','addClasse','addClasse');
$router->map('GET|POST', '/public/gestion-classe-add-option','addOption','addOption');
$router->map('GET|POST', '/public/gestion-eleve','gestionEleve','gestionEleve');
$router->map('GET|POST', '/public/recu-[i:idRecu]-detail','viewRecuDetail','viewRecuDetail');
$router->map('GET|POST', '/public/gestion-password','gestionMotDePasse','gestionMotDePasse');
$router->map('GET|POST', '/public/change-password','changePassword','changePassword');
$router->map('GET|POST', '/public/reset-caisse-password','resetPassword','resetPassword');
$router->map('GET|POST', '/public/set-annee-[i:idAnnee]','setAnnee','setAnnee');
$router->map('GET|POST', '/public/bilan-annee-[i:idAnnee]','bilanAnnuel','bilanAnnuel');
$router->map('GET|POST', '/public/search','search','search');
$router->map('GET|POST', '/public/close-scolare-year-[i:idAnnee]','viewClasses','closeScolareYear');
$router->map('GET|POST', '/public/close-scolare-year-[i:idAnnee]-classe-[i:idClasse]','closeYear','closeYear');

$match = $router->match();

if(isset($match['target'])){
    ob_start();
    require VIEWS_PATH.$match['target'].'.php';
    $contents = ob_get_clean();
    require VIEWS_PATH."page.php";
}else{
    require VIEWS_PATH."404.php";
}