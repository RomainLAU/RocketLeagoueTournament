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

    public function findAllUsers()
    {
        $statement = $this->pdo->prepare('SELECT * FROM user');
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function findOneTournament(int $id)
    {
        $statement = $this->pdo->prepare('SELECT tournament.name, tournament.host, tournament.admissionPrice, user.pseudo 
                                        FROM participant
                                        INNER JOIN tournament ON participant.tournament_id = tournament.id
                                        INNER JOIN user ON participant.user_id = user.id
                                        WHERE tournament.id = :id');
        $statement->execute([
            'id' => $id,
        ]);

        

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findParticipants(int $tournamentId)
    {
        $statement = $this->pdo->prepare('SELECT * FROM participant WHERE tournament_id = :tournament_id');
        $statement->execute([
            'tournament_id' => $tournamentId,
        ]);

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteTournament($id)
    {
        $statement = $this->pdo->prepare('DELETE FROM `tournament` WHERE `id` = :id');
        $statement->execute([
            'id' => $id,
        ]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function addUserInTournament($id)
    {
        $statement = $this->pdo->prepare('INSERT INTO `participant` (`tournament_id`, `user_id`) VALUES (:tournament_id, :user_id)');
        $statement->execute([
            'tournament_id' => $id,
            'user_id' => $_SESSION['user']['id'],
        ]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function addPlayerTournament($id,$idUser){
        $statement = $this->pdo->prepare('INSERT INTO `participant` (`tournament_id`, `user_id`) VALUES (:tournament_id, :user_id)');
        $statement->execute([
            'tournament_id' => $id,
            'user_id' => $idUser,
        ]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}



