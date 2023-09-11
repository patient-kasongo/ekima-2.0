<?php

namespace App;

class Authentification
{
    private $pdo;
    
    private $username;
    
    private $passsword;

    public function __construct($pdo){
        $this->pdo=$pdo;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    /**
     * @param mixed $passsword
     */
    public function setPasssword($passsword): void
    {
        $this->passsword = $passsword;
    }

    /**
     * @return mixed
     */
    public function getUsername():string
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getPasssword():string
    {
        return $this->passsword;
    }
    public function isConnect():?User
    {
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
        $id=$_SESSION['auth'] ?? null;
        if($id == null){
            return null;
        }
        $query=$this->pdo->prepare('SELECT * from user where idUser=?');
        $query->execute([$id]);
        $user = $query->fetchObject(User::class);
        return $user ?? null;
    }
    public function login(): ?User
    {
        $query = $this->pdo->prepare("SELECT * FROM user WHERE username = :username");
        $query->execute(['username' => $this->username]);
        $user=$query->fetchObject(User::class);
        if( $user === false ){
            return null;
        }
        // on vérifie le mot de passe
        if(password_verify($this->passsword, $user->getPassword())){
            if(session_status() === PHP_SESSION_NONE){
                session_start();
            }
            $_SESSION['auth']=$user->getIdUser();
            return $user;
        }
        return null;
    }
    public function logout():void
    {
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
        unset($_SESSION['auth']);
    }
    public static function accessBlocker():void
    {
        if(session_status()== PHP_SESSION_NONE){
            session_start();
        }
        if(!isset($_SESSION['auth'])){
            header('location:/public/login');
            exit();
        }
    }

}