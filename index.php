<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>calendrier</title>
    <link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
  </head>
  <body>
<h1>Nouveau rendez-vous :</h1>
    <!-- formulaire de saisie de données -->
        <form class="" action="saisie.php" method="post">
          <input type="texte" id="titre" name="titre" placeholder="titre">
          <input type="date" id="debut" name="debut" placeholder="debut">
          <input type="date" id="fin" name="fin" placeholder="fin">
          <input type="mail" id="mail" name="mail" placeholder="votre email">
          <input type="submit"id="btn"  name="btn" value="ajouter">
        </form>

    <?php
    $connexion = new PDO('mysql:host=localhost;dbname=calendrier;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    ?>

<div >


<div class="liste">
  <h2>Calendrier :</h2>

<?php
//requete pour la table saisie
    $requete = "SELECT * FROM saisie order by debut desc";
	  $resultats = $connexion->query($requete);

	while( $calendar = $resultats->fetch() ){
		echo "<div>Titre : " . $calendar["titre"] . "</div>";
    echo "<div> Du " . $calendar["debut"] . " au " . $calendar["fin"] . " .</div>";
    echo "<div>Mail de l'auteur : " . $calendar["mail"] . "</div>";
    echo "</br>";
    }
	 $resultats->closeCursor();
  ?>

</div>

</div>
</br>
  </body>
</html>
