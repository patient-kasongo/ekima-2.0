<?php

namespace App;

class User
{
    private $pseudo;
    private $password;

    private $idUser;
    private $role;

    /**
     * @param mixed $idUser
     */
    public function setIdUser($idUser): void
    {
        $this->idUser = $idUser;
    }

    /**
     * @param mixed $pseudo
     */
    public function setPseudo($pseudo): void
    {
        $this->pseudo = $pseudo;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role): void
    {
        $this->role = $role;
    }
    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->idUser;
    }
    /**
     * @return mixed
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }
    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }
    public function redirectUser($role){
        if($role == 'DIRECTION DES OPERATIONS'){
            header("Location:/public/cours/management");
        }elseif( $role == 'DIRECTION DES FINANCES' || $role== 'SECRETARIAT'){
            header('Location:/public/client/management');
        }else{
            header("Location:/public");
        }
    }
}