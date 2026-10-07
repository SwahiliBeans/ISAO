<?php /* Max Adams
Course CS312
Dec 6, 2025
login action for ISAO */
session_start();

$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');

if ($username === '' || $password === '') {
    $_SESSION['messages'][] = "Username and password are required!!";
    header("Location: login.php");
    exit;
}

$db = new SQLite3('user.db');

$stmt = $db->prepare("SELECT pass_hash FROM user WHERE username = :username");
$stmt->bindValue(':username', $username, SQLITE3_TEXT);
$result = $stmt->execute();

$row = $result->fetchArray(SQLITE3_ASSOC);

if (!$row) {
    $_SESSION['messages'][] = "Invalid username or password";
    header("Location: login.php");
    exit;
}

$storedHash = $row['pass_hash'];

if (!password_verify($password, $storedHash)) {
    $_SESSION['messages'][] = "Invalid username or password";
    header("Location: login.php");
    exit;
}

$_SESSION['logged_in'] = true;
$_SESSION['username'] = $username;

$_SESSION['messages'][] = "Welcome, $username!";
    header("Location: index.php");
    $db->close();
    exit;