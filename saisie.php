<?php
header('Location: index.php');
$titre = $_POST['titre'];
$debut = $_POST['debut'];
$fin = $_POST['fin'];
$mail = $_POST['mail'];
$connexion = new PDO('mysql:host=; dbname=;charset=utf8','','');
//
if ((isset($_POST['titre']) && $_POST['titre']!="") && (isset($_POST['debut']) && $_POST['debut']!="") && (isset($_POST['fin']) && $_POST['fin']!="") && (isset($_POST['mail']) && $_POST['mail']!=""))
{
  //requète
$insertion = "INSERT INTO saisie (titre, debut, fin, mail) VALUES ( :titre, :debut, :fin, :mail)";
$rq = $connexion->prepare($insertion);// insertion

$rq->bindParam(":titre",$titre, PDO::PARAM_STR);
$rq->bindParam(":debut",$debut, PDO::PARAM_STR);
$rq->bindParam(":fin",$fin, PDO::PARAM_STR);
$rq->bindParam(":mail",$mail, PDO::PARAM_STR);
$rq->execute();
}

?>
