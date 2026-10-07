<?php /* Max Adams
Course cs312
November 13, 2025
new event action for ISAO */

session_start();
$_SESSION['messages'] = [];

$title = trim($_POST['event_title'] ?? '');
$sponsor = trim($_POST['sponsor'] ?? '');
$description = trim($_POST['description'] ?? '');
$date = trim($_POST['date'] ?? '');
$time = trim($_POST['time'] ?? '');

$titlePattern = '/^[A-Za-z0-9 .,&\'():\/-]{3,50}$/';
$sponsorPattern = '/^[A-Za-z0-9 .,&\'():\/-]{2,50}$/';
$descPattern = '/^.{5,350}$/s';

$errors = [];

if ($title === '' || !preg_match($titlePattern, $title)) {
    $errors[] = "Event title is required and must be 3-50 characters";
}

if ($sponsor === '' || !preg_match($sponsorPattern, $sponsor)) {
$errors[] = "Sponsor is required and must be 2-50 characters";
}

if ($description === '' || !preg_match($descPattern, $description)) {
    $errors[] = "Description is required and must be 5-350 characters";
}

if ($date === '') {
    $errors[] = "Event date is required";
}

if ($time === '') {
    $errors[] = "Event time is required";
}

if (!empty($errors)) {
    $_SESSION['messages'] = array_merge($_SESSION['messages'], $errors);
    header("Location: new_event.php");
    exit;
}

$db = new SQLite3('event.db');

$eventtime = date('Y-m-d H:i:s', strtotime("$date $time"));

$stitle = $db->escapeString($title);
$ssponsor = $db->escapeString($sponsor);
$sdescription = $db->escapeString($description);
$seventtime = $db->escapeString($eventtime);

$command_check = "SELECT id FROM event WHERE title = '$stitle'";
$result_check = $db->query($command_check);

if ($result_check->fetchArray()) {
    $_SESSION['messages'][] = "The Title must be unique; This title has been used for a previous event";
    $db->close();
    header("Location: new_event.php");
    exit;
}

$command = "INSERT INTO event (title, sponsor, descr, eventtime)
    VALUES ('$stitle', '$ssponsor', '$sdescription', '$seventtime')";
$result = $db->exec($command);

if ($result) {
$_SESSION['messages'][] = "New event has been added to the upcoming events list! Take a look at the list to make sure everything looks right and if not, contact us via the information at the bottom of the page";
header("Location: index.php");
$db->close();
exit;
}

else {
    $error_message = $db->lastErrorMsg();
    $_SESSION['messages'][] = "Database Error" . $error_message;
    $db->close();
    header("Location: new_event.php");
    exit;
}
