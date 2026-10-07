<?php /* Max Adams
Course CS312
Dec 6, 2025
login page for ISAO */
 session_start(); ?>
<?php
session_start();

if (!empty($_SESSION['logged_in'])) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Logout</title>
        <link rel="stylesheet" href="std.css">
    </head>
    <?php include 'header.php'; ?>
    <?php include 'menu.php'; ?>

    <h2>Logout</h2>
    <p>You are logged in as <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong></p>

    <form action="logout_action.php" method="post">
        <button type="submit">Logout</button>
    </form>

    <?php include 'footer.php'; ?>
    </body>
    </html>
    <?php
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login</title>
<link rel="stylesheet" href="std.css">
</head>
<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>

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
<h2>Member Login</h2>
<form action="login_action.php" method="post">
<label for="username">Username: </label>
<input type="text" id="username" name="username" required pattern="[A-Za-z0-9_]{4,20}" title="4-20 letters, numbers, or underscores"><br><br>
<label for="password">Password: </label>
<input type="password" id="password" name="password" required minlength="8"><br><br>
<button type="submit">Login</button>
<?php include 'footer.php'; ?>
</body>
</html>