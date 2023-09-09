<?php
    \App\Authentification::accessBlocker();
    $auth=new \App\Authentification(\App\Database::getPdo());
    $user=$auth->isConnect();
    if (isset($match['params']['idAnnee'])){
        $annee=new \App\Annee();
        $annee->idAnnee=$match['params']['idAnnee'];
        $annee->setAnneeInSession();
        $route=isset($router) ? $router->generate('viewClasses', ['idAnnee' => $match['params']['idAnnee']]) : '/public/login';
        $user->redirectUser($route);
    }else{
        $route=isset($router) ? $router->generate('home') : '/public/login';
    }
