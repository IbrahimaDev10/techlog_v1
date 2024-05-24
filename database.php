<?php 
session_start();
/*$server='localhost';
$name='id20916785_ibrahima';
$user='id20916785_root';
$mot_passe='MyDbForSim-2320';*/
/*$server='localhost';
$name='u494288814_ibraDBSIM';
$user='u494288814_root';
$mot_passe='MyDbForSim-2320';*/

$server='localhost';
$name='test_vrac5';
$user='root';
$mot_passe='';

try {
    $bdd = new PDO("mysql:host=$server;dbname=$name", $user, $mot_passe);
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}?>