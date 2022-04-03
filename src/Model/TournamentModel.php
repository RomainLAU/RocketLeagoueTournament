<?php
namespace Mvc\Model;

use Config\Model;

use PDO;



class TournamentModel extends Model
{

    public function createTournament(string $name, string $admissionPrice, string $host) 
    {
        $statement = $this->pdo->prepare('INSERT INTO `tournament` (`name`, `admissionPrice`, `host`) VALUES (:name, :admissionPrice, :host)');

        $statement->execute([
            'name' => $name,
            'admissionPrice' => $admissionPrice,
            'host' => $host,
        ]);
    }


    public function findAllTournaments()
    {
        $statement = $this->pdo->prepare('SELECT * FROM tournament');
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findOneTournament(int $id)
    {
        $statement = $this->pdo->prepare('SELECT * FROM tournament WHERE :id = id');
        $statement->execute([
            'id' => $id,
        ]);

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function spentToken(int $token, String $firstname, int $spend ) {
        $statement = $this->pdo->prepare('UPDATE `user` SET `token` = :token - :spend WHERE `firstname` = :firstname ');

        $statement->execute([
            'token' => $token,
            'firstname' => $firstname,
            'spend' => $spend,
        ]);
        $_SESSION["user"]["token"] = $_SESSION["user"]["token"] - $spend; 
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}



