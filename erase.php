<?php
$id = $_GET['id'];
$connexion = new PDO('mysql:host=localhost; dbname=calendrier;charset=utf8','root','');


if(isset($_GET['id'])){
    $id = $_GET['id'];
    if(is_numeric($id)){
        $delete = "DELETE FROM saisie WHERE idcrea = :id";
        $rq = $connexion->prepare($delete);
        $rq->bindParam(":id", $id, PDO::PARAM_INT);
        $rq->execute();

    }
}
header('location:index.php');
mysql_close();
 ?>
