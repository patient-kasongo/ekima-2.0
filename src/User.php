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
    public function changePassword($newPassword){
        $pdo=Database::getPdo();
        try{
            $hash=password_hash($newPassword, PASSWORD_DEFAULT);
            $query="UPDATE user SET password=:password WHERE username=:username";
            $stmt=$pdo->prepare($query);
            $stmt->execute(['password'=>$hash,
                'username'=>$this->username]);
            return true;
        } catch (\PDOException){
            return false;
        }
    }
    public static function resetPasswordCaisse(){
        $pdo=Database::getPdo();
        try{
            $pass="1234";
            $hash=password_hash($pass, PASSWORD_DEFAULT);
            $query="UPDATE user SET password=:password WHERE username=:username";
            $stmt=$pdo->prepare($query);
            $stmt->execute(['password'=>$hash,
                'username'=>"caisse"]);
            return true;
        } catch (\PDOException){
            return false;
        }
    }
}