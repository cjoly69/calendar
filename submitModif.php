<?php
$id = $_POST['id'];
$titre = $_POST['titre'];
$debut = $_POST['debut'];
$fin = $_POST['fin'];
$mail = $_POST['mail'];

$connexion = new PDO('mysql:host=localhost; dbname=calendrier;charset=utf8','root','');
//
if (isset($_POST['titre']) !='' || $_POST['titre']
  && isset($_POST['debut']) !='' || $_POST['debut']
  && isset($_POST['fin']) != ''|| $_POST['fin']
  && isset($_POST['mail']) !='' || $_POST['mail']
  && isset($_POST['id']))
{
  print_r ($_POST);
  //requète
$update = "UPDATE `saisie` SET `titre`=:titre,`debut`=:debut,`fin`=:fin,`mail`= :mail WHERE idcrea =:id";
$rq = $connexion->prepare($update);// update bdd

$rq->bindParam(":id",$id, PDO::PARAM_INT);
$rq->bindParam(":titre",$titre, PDO::PARAM_STR);
$rq->bindParam(":debut",$debut, PDO::PARAM_STR);
$rq->bindParam(":fin",$fin, PDO::PARAM_STR);
$rq->bindParam(":mail",$mail, PDO::PARAM_STR);
$rq->execute();
header('Location:index.php');
}



?>
