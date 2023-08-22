<?php

namespace App;

class User
{
    private $idUser;
    private $username;

    private $password;
    private $role;

    /**
     * @param mixed $idUser
     */
    public function setIdUsers(int $idUser): void
    {
        $this->idUser = $idUser;
    }

    /**
     * @param mixed $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @param mixed $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @param mixed $role
     */
    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    /**
     * @return mixed
     */
    public function getIdUser():int
    {
        return (int)$this->idUser;
    }

    /**
     * @return mixed
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getRole():string
    {
        return $this->role;
    }
    public function redirectUser($url):void{
        header("Location:$url");

    }
}