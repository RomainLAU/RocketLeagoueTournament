<?php

namespace Mvc\Controller;
use Config\Controller;
use Mvc\Model\TournamentModel;
use Mvc\Model\UserModel;
use Twig\Environment;


class TournamentController extends Controller
{
    private TournamentModel $tournamentModel;
    private UserModel $userModel;

    public function __construct() {

        parent::__construct();
        $this->tournamentModel = new TournamentModel();
        $this->userModel = new UserModel();
    }

    public function createTournament() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name']) && isset($_POST['admissionPrice']) && $_SESSION["user"]['token'] >= 100) {

            $_SESSION["user"]["token"] =  $_SESSION["user"]["token"] - 100; 
            $this->tournamentModel->createTournament($_POST['name'], $_POST['admissionPrice'], $_SESSION['user']['pseudo']);
            $this->userModel->spendToken($_SESSION["user"]["token"], $_SESSION["user"]["firstnames"]);
            header('location: /');
            exit();
        }

        echo $this->twig->render('tournament/createTournament.html.twig');
    }


    public function listTournament() {
        $tournaments = $this->tournamentModel->findAllTournaments();

        echo $this->twig->render('tournament/listTournament.html.twig', [
            'tournaments' => $tournaments,
        ]);
    }

    public function showDetails(int $id) {
        $tournament = $this->tournamentModel->findOneTournament($id);

        $tournamentParticipants = [];

        foreach($tournament as $detail => $values) {
            foreach($values as $key => $value) {
                if ($key == 'pseudo') {
                    $tournamentParticipants[] = $value;
                }
            }
        };

        if (count($tournamentParticipants) > 0) {
            $tournamentDetails = ['name' => $tournament[0]['name'],
                'host' => $tournament[0]['host'],
                'admissionPrice' => $tournament[0]['admissionPrice'],
                'tournamentParticipants' => $tournamentParticipants
            ];
        } else {
            $tournamentDetails = ['name' => $tournament[0]['name'],
                'host' => $tournament[0]['host'],
                'admissionPrice' => $tournament[0]['admissionPrice']
            ];
        }

        echo $this->twig->render('tournament/showDetails.html.twig', [
            'tournamentDetails' => $tournamentDetails,
        ]);
    }


    public function deleteTournament(){
        if(isset($_POST)){
            $this->tournamentModel->deleteTournament(key($_POST));     
        }
        header('location: /listTournament');
        exit();
    }

    public function joinTournament(){
        if(isset($_POST)){
            $this->tournamentModel->addUserInTournament(key($_POST));
            
        }
        header('location: /listTournament');
        exit();
    }

    public function addPlayerTournament(){  
        $users = $this->tournamentModel->findAllUsers();
        if(isset($_POST)){
            foreach($users as $key => $user){
                if($_POST['playerPseudo'] === $user['pseudo']){
                    $this->tournamentModel->addPlayerTournament(key($_POST), $user['id']); 
                }
            }    
        }

        header('location: /listTournament');
        exit();
    }
}