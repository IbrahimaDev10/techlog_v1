<?php 
session_start();
/*$server='localhost';
$name='id20164679_mon_demo';
$user='id20164679_root';
$mot_passe='Webhost@2022';*/
$server='localhost';
$name='ibrahima';
$user='root';
$mot_passe='';












try {
	 
//$bdd=new PDO('mysql:host=localhost;dbname=publicite;charset=utf8;', 'root', '');
	$bdd=new PDO("mysql:host=$server;dbname=$name;charset=utf8;", $user, $mot_passe);


} catch (Exception $e) {

	die('erreur detecté:' .$e->getMessage());
	
}

 ?>
