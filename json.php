<?php
// chemin du fichier JSON et PARSE
//depuis le fichier json
// $parsed_json = json_decode(file_get_contents("events.json"));
$parsed_json = json_decode(file_get_contents("https://www.googleapis.com/calendar/v3/calendars/simplon.co_7sc0sp073u3svukpopmhob9fmg%40group.calendar.google.com/events?key=AIzaSyADm7UvQFnHmkfo_sei1oZoLvx_X-_mhFI"));

//affichage en objet
// print_r($parsed_json->items[0]->creator);

$titre = $parsed_json->items[0]->summary;
$date_debut = $parsed_json->items[0]->start->dateTime;
$date_fin = $parsed_json->items[0]->end->dateTime;
$mail = $parsed_json->items[0]->creator->email;

//affichage du premier objet
echo "<div>Titre : " . $titre . "</div>";
echo "<div> Du " . $date_debut . " au " . $date_fin . " .</div>";
echo "<div>Mail de l'auteur : " . $mail . "</div>";
echo "</br>";
?>
