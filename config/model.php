<?php 
namespace Config;



use PDO;
class Model
{
    protected PDO $pdo;
    public function __construct()
    {
        $this->pdo = new PDO('mysql:host=localhost;dbname=tournoi;charset=UTF8',"root","",[
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_FOUND_ROWS => true
            ]
        );
    }
}
