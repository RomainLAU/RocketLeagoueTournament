<?php

namespace Mvc\Controller;
use Config\Controller;
use Mvc\Model\TournamentModel;
use Twig\Environment;


class TournamentController extends Controller
{
    private TournamentModel $tournamentModel;

    public function __construct() {

        parent::__construct();
        $this->tournamentModel = new TournamentModel();
    }

    public function createTournament() {
        var_dump($_SESSION);
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name']) && isset($_POST['admissionPrice']) && $_SESSION["user"]['token'] >= 100) {

            $_SESSION["user"]["token"] =  $_SESSION["user"]["token"] - 100; 
            $this->tournamentModel->createTournament($_POST['name'], $_POST['admissionPrice'], $_SESSION['user']['lastname']);
        }

        echo $this->twig->render('tournament/createTournament.html.twig');
    }


    public function listTournament() {
        $tournaments = $this->tournamentModel->findAllTournaments();

        echo $this->twig->render('tournament/listTournament.html.twig', [
            'tournaments' => $tournaments
        ]);
    }

    public function showDetails(int $id) {

        $tournament = $this->tournamentModel->findOneTournament($id);

        echo $this->twig->render('tournament/showDetails.html.twig', [
            'tournament' => $tournament
        ]);
    }
}