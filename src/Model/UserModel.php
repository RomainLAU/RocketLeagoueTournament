<?php

namespace Mvc\Model;

use Config\Model;

use PDO;

class UserModel extends Model
{

    public function createUser(string $lastname, string $firstname, string $mail, string $password) 
    {

        $statement = $this->pdo->prepare('INSERT INTO `user` (`lastname`, `firstname`, `mail`, `password`) VALUES (:lastname, :firstname, :mail, :password)');

        $statement->execute([
            'lastname' => $lastname,
            'firstname' => $firstname,
            'mail' => $mail,
            'password' => $password,
        ]);
    }

    public function loginIn(string $mail) {

        $statement = $this->pdo->prepare('SELECT * FROM `user` WHERE `mail` = :mail');

        $statement->execute([
            'mail' => $mail,
        ]);

        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}