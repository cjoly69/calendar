<?php
$id = $_GET['id'];
$connexion = new PDO('mysql:host=localhost; dbname=calendrier;charset=utf8','root','');


if(isset($_GET['id'])){
    $id = $_GET['id'];
    echo $id;
    if(is_numeric($id)){
        $select = "SELECT titre, debut, fin, mail FROM saisie WHERE idcrea = :id";
        $rq = $connexion->prepare($select);
        $rq->bindParam(":id", $id, PDO::PARAM_INT);
        $rq->execute();

    }
}
header('location:form_modif.php');
 ?>
