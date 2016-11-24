<?php
header('Location: index.php');
$titre = $_POST['titre'];
$debut = $_POST['debut'];
$fin = $_POST['fin'];
$mail = $_POST['mail'];
$connexion = new PDO('mysql:host=localhost; dbname=calendrier;charset=utf8','root','');
//
if (isset($_POST['titre']) || isset($_POST['debut']) || isset($_POST['fin']) || isset($_POST['mail']))
{
  //requète
$update = "UPDATE saisie SET titre=:titre, debut=:debut, fin=:fin, mail=:mail) WHERE idcrea =:id";
$rq = $connexion->prepare($insertion);// insertion

$rq->bindParam(":titre",$titre, PDO::PARAM_STR);
$rq->bindParam(":debut",$debut, PDO::PARAM_STR);
$rq->bindParam(":fin",$fin, PDO::PARAM_STR);
$rq->bindParam(":mail",$mail, PDO::PARAM_STR);
$rq->execute();
}

?>
