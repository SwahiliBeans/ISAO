<?php /* Max Adams
Course cs312
November 13, 2025
register for ISAO */ ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Registration</title>
<link rel="stylesheet" href="std.css">
</head>
<body>
<?php include 'header.php'; ?>
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

<h2>Member Registration</h2>

<form action="registration_action.php" method="post">
<label for="username">Username:* at least 4 characters</label>
<input type="text" id="username" name="username" required pattern="[A-Za-z0-9_]{4,20}" title="4-20 letters, numbers, or underscores"><br><br>
<label for="password">Password:* at least 8 characters</label>
<input type="password" id="password" name="password" required minlength="8"><br><br>
<label for="confirm">Confirm Password:*</label>
<input type="password" id="confirm" name="confirm" required minlength="8"><br><br>

<script>
const pass = document.getElementById('password');
const confirm = document.getElementById('confirm');

confirm.addEventListener('input', () => {
    if (confirm.value !== pass.value) {
        confirm.setCustomValidity("Passwords do not match!");
    } else {
        confirm.setCustomValidity("");
    }
});
</script>

<label for="fullname">Name (First and Last):* at least 2 characters</label>
<input type="text" id="fullname" name="fullname" required><br><br>
<label for="email">Email:*</label>
<input type="email" id="email" name="email" required><br><br>
<label for="phone">Phone Number: 10 digits</label>
<input type="tel" id="phone" name="phone" pattern="[0-9]{10}" title="10 digit number"><br><br>
<label for="city">City: at least 2 characters</label>
<input type="text" id="city" name="city" ><br><br>
<label for="state">State: at least 2 characters</label>
<input type="text" id="state" name="state"><br><br>
<button type="submit">Register</button>
</form>
<h3>* means field is required!</h3>
<?php include 'footer.php'; ?>
</body>
</html>