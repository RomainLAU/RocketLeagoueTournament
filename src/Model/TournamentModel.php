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
}



