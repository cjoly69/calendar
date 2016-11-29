<?php
include_once "connexion.php";
$feedback = '';
if (isset($_POST['title']) && isset($_POST['start']) && isset($_POST['start_time']) && isset($_POST['end']) && isset($_POST['end_time']) && isset($_POST['contact'])) {
    $start = dateFromTimestamp($_POST['start'], $_POST['start_time']);
    $end = dateFromTimestamp($_POST['end'], $_POST['end_time']);
    $res = addEvent($_POST['title'], $start, $end, $_POST['contact']);
    $addResult = $res ? 1 : 0;
    $feedback = $addResult ? 'Ajout effectué' : 'Erreur d\'ajout';
}
function addEvent($title, $start, $end, $contact)
{
    $q = "insert into events (`title`, `start`, `end`, `contact`) VALUES (:title, :start, :fin, :contact)";
    $req = getDB()->prepare($q);
    $req->bindParam(":title", $title, PDO::PARAM_STR);
    $req->bindParam(":contact", $contact, PDO::PARAM_STR);
    $req->bindParam(":start", $start, PDO::PARAM_STR);
    $req->bindParam(":fin", $end, PDO::PARAM_STR);
    return $req->execute();
}
function dateFromTimestamp($date, $time)
{
    $d = new DateTime();
    $date = preg_split('/-/', $date);
    $time = preg_split('/:/', $_POST['start_time']);
    $d->setDate($date[0], $date[1], $date[2]);
    $d->setTime($time[0], $time[1]);
    return date('Y-m-d H:i:s', $d->getTimestamp());
}
function getDB()
{
    if (!isset($db)) {
        $db = new PDO('mysql:host=localhost:3306;dbname=' . DB_NAME . ';charset=utf8',
            DB_USER, DB_PASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    return $db;
}
function getLocalEventsView()
{
    $q = "SELECT * FROM events";
    $res = getDB()->query($q);
    $events = $res->fetchAll();
    return join('', array_map(function ($e) {
        return "<p>" . $e['title'] . " - " . $e['start'] . " - " . $e['end'] . " - " . $e['contact'] . "</p>";
    }, $events));
}
function loadCalendar()
{
    $ch = curl_init();
// Configuration de l'URL et d'autres options
    curl_setopt($ch, CURLOPT_URL, "https://www.googleapis.com/calendar/v3/calendars/simplon.co_7sc0sp073u3svukpopmhob9fmg%40group.calendar.google.com/events?key=AIzaSyADm7UvQFnHmkfo_sei1oZoLvx_X-_mhFI");
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
// Récupération de l'URL et affichage sur le naviguateur
    $calData = curl_exec($ch);
// Fermeture de la session cURL
    curl_close($ch);
    // 2nd paramètre de json_decode
    //stdClass par défault monObjet->maPropriete
    //assoc = true par défault monObjet['maPropriete']
    return json_decode($calData, true);
}
function getGoogleEvents()
{
    $gCalendar = loadCalendar();
    $events = $gCalendar['items'];
    echo '<p>' . count($events) . " events" . '</p>';
    echo join('', array_map(function ($ev) {
        $title = isset($ev['summary']) ? $ev['summary'] : 'Indéfini';
        return "<p>" . $title . "</p>";
    }, $events));
}
function parseEventDate($event, $name)
{
    if (isset($event[$name]) && isset($event[$name]['dateTime'])) {
        $date = preg_split('/\+/', $event[$name]['dateTime'])[0];
        return preg_replace('/T/', ' ', $date);
    }
}
function importEvents($events)
{
    for ($i = 0; $i < count($events); $i++) {
        $event = $events[$i];
        $formattedStart = parseEventDate($event, 'start');
        $formattedEnd = parseEventDate($event, 'end');
        if (isset($formattedStart) && isset($formattedEnd)) {
            $res = addEvent(
                isset($event['summary']) ? $event['summary'] : 'inconnu',
                $formattedStart,
                $formattedEnd,
                isset($event['creator']) ? $event['creator']['email'] : 'inconnu'
            );
        }
    }
}
if (isset($_GET['import_calendar']) && $_GET['import_calendar'] == 1) {
    $gCalendar = loadCalendar();
    importEvents($gCalendar['items']);
}
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Evenements</title>
    <script type="text/javascript" src="calendar.js"></script>
</head>
<body>

<?php echo $feedback; ?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

    <input type="text" name="title" required/>

    <input type="date" name="start" required/>
    <input type="time" name="start_time" required/>

    <input type="date" name="end" required/>
    <input type="time" name="end_time" required/>

    <input type="text" name="contact" required/>

    <button>Enregistrer</button>

</form>

<div>
    <?php echo getLocalEventsView(); ?>

    <hr>

    <a href="<?php echo $_SERVER['PHP_SELF'] . "?import_calendar=1" ?>">Importer</a>

    <?php echo getGoogleEvents(); ?>

</div>

</body>
</html>
