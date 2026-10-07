<?php /* Max Adams
Course cs312
November 13, 2025
new event for ISAO */ 
session_start();
if (empty($_SESSION['logged_in'])) {
    $_SESSION['messages'][] = "You must be logged in to create a new event";
    $_SESSION['messages'][] = "If you are not a registered user please click the link above to become one!";
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>New Event</title>
<link rel="stylesheet" href="std.css">
</head>
<body>
<?php include 'header.php';?>
<?php include 'menu.php'; ?>

<?php session_start(); ?>
<?php
if (!empty($_SESSION['messages'])) {
echo '<div class="messages" style="border:2px solid yellow; background-color:#ffe6e6;">';
foreach ($_SESSION['messages'] as $msg) {
echo '<p>' . htmlspecialchars($msg) . '</p>';
}
echo '</div>';
unset($_SESSION['messages']);
}
?>

<h2>Enter New Event Info</h2>

<form action="new_event_action.php" method="post" id="form">

<label for="event_title">Event Title:* at least 3 characters</label>
<input type="text" id="event_title" name="event_title" required><br><br>

<label for="sponsor">Sponsored by:* at least 2 characters</label>
<input type="text" id="sponsor" name="sponsor" required><br><br>

<label for="description">Description of Event:* at least 5 characters</label><br>
<textarea id="description" name="description" rows="5" cols="40" required></textarea><br><br>

<label for="date">Date to Occur:* Cannot be day of or earlier</label>
<input type="date" id="date" name="date" required><br><br>

<label for="time">Time to Occur:*</label>
<input type="time" id="time" name="time" required><br><br>

<button type="submit">Create New Event</button>
</form>

<script>
const dateInput = document.getElementById('date');
const form = document.getElementById('form');
let today = new Date().toISOString().split('T')[0];
dateInput.setAttribute('min', today);
form.addEventListener('submit', function(e) {
    const selected = new Date(dateInput.value);
    const now = new Date();

    if (selected < now) {
        alert("The received event date has passed, please enter a future event");
        e.preventDefault();
    }
});
</script>
<h3>* means field is required!</h3>
<?php include 'footer.php'; ?>
</body>
</html>