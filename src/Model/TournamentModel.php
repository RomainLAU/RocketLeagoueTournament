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
                                        FROM tournament
                                        LEFT JOIN participant ON participant.tournament_id = tournament.id
                                        LEFT JOIN user ON participant.user_id = user.id
                                        WHERE tournament.id = :id;');
        $statement->execute([
            'id' => $id,
        ]);

        $tournamentInformations = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $tournamentInformations;
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

    public function getParticipants($tournamentId) {

        $statement = $this->pdo->prepare('SELECT * FROM `participant` WHERE tournament_id = :tournament_id');
        $statement->execute([
            'tournament_id' => $tournamentId,
        ]);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createMatch($player1, $goal_player1, $player2, $goal_player2, $tournamentId, $isFinished) {

        $statement = $this->pdo->prepare('INSERT INTO `matches` (`player1`, `goal_player1`, `player2`, `goal_player2`, `tournament_id`, `isFinished`) VALUES (:player1, :goal_player1, :player2, :goal_player2, :tournament_id, :isFinished)');
        $statement->execute([
            'player1' => $player1,
            'goal_player1' => $goal_player1,
            'player2' => $player2,
            'goal_player2' => $goal_player2,
            'tournament_id' => $tournamentId,
            'isFinished' => $isFinished,
        ]);
    }

    public function updateMatch($matchId, $goal_player1, $goal_player2, $isFinished) {

        $statement = $this->pdo->prepare('UPDATE `matches` SET `goal_player1` = :goal_player1, `goal_player2` = :goal_player2, `isFinished` = :isFinished WHERE `id` = :matchId');
        $statement->execute([
            'matchId' => $matchId,
            'goal_player1' => $goal_player1,
            'goal_player2' => $goal_player2,
            'isFinished' => $isFinished,
        ]);
    }

    public function getMatches(int $tournamentId) {

        $statement = $this->pdo->prepare('SELECT * FROM `matches` WHERE tournament_id = :tournament_id');
        $statement->execute([
            'tournament_id' => $tournamentId,
        ]);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMatchById(int $matchId) {

        $statement = $this->pdo->prepare('SELECT * FROM `matches` WHERE id = :id');
        $statement->execute([
            'id' => $matchId,
        ]);

        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}