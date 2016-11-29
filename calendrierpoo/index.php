<?php
include_once "connexion.php";
/**
 *
 */
class Evenement
{
  public $idcrea;
  public $titre;
  public $debut;
  public $fin;
  public $mail;

//les paramètres sont obligatoires on les définit null par défaut pour éviter le retour d'erreur, valeurs par défaut tjrs à la fin
  function __construct($idcrea = null,$titre = null, $debut = null , $fin = null, $mail = null)
  {
    if($idcrea)// pour éviter les objet null après un fetch
      $this->idcrea = $idcrea;

    if($titre)
      $this->titre = $titre;

    if($debut)
      $this->debut = $debut;

    if($fin)
      $this->fin = $fin;

    if($mail)
      $this->mail = $mail;
  }
}

/**
 *
 */
class GestionnaireEvenement
{
  private $pdo;

  public function __construct()
  {
    $this->pdo = new PDO('mysql:host=localhost:3306;dbname=' . DB_NAME . ';charset=utf8',
        DB_USER, DB_PASS);
    }

  //ajout d'une Class ChargeFichier() sur fichier externe pour charger à l'intérieur de chargeEvenements

  public function importEvenment($url){
    //j'utilise ma class ChargeurJsonApi
    $chargeur = new ChargeurJsonApi();
    //je récupère dans une variable en ajoutant un url
    $data = $chargeur->charge($url);
    //j'affiche
    print_r($data);
  }

  public function chargeEvenements(){
    //
    $evenements = $this->pdo->query('SELECT * FROM saisie')->fetchAll(PDO::FETCH_CLASS, 'Evenement');
    return $evenements;
  }

  //ajoute un evnt a bdd
  public function ajouteEvenement(Evenement $e){

    }
  //supprime
  public function supprimeEvenement(Evenement $e){
  }
  //modifie
  public function modifieEvenement(Evenement $e){
  }
}

$gestionnaire = new GestionnaireEvenement();

$evenements = $gestionnaire->chargeEvenements();//recupère les evnmts dans une variable $evenements
// $evenements = $gestionnaire->chargeFichier();
print_r($evenements);//l'ensemble de l'objet

$vueEvenements = array_map(function(Evenement $ev){//pour chaque titre je crée un <p>
    return "<p>Titre : ".$ev->titre."</p>";
}, $evenements);

$vueHTML = join('', $vueEvenements);
echo $vueHTML;
 ?>
