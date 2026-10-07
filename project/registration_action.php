<?php /* Max Adams
Course cs312
November 13, 2025
register action for ISAO */

session_start();
$_SESSION['messages'] = [];

$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');
$confirm = trim($_POST['confirm'] ?? '');
$name = trim($_POST['fullname'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$city = trim($_POST['city'] ?? '');
$state = trim($_POST['state'] ?? '');

$usernamePattern = '/^[A-Za-z0-9_]{4,20}$/';
$passwordPattern = '/^.{8,}$/';
$namePattern = '/^[A-Za-z ]{2,50}$/';
$emailPattern = '/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,6}$/';
$phonePattern = '/^[0-9]{10}$/';
$cityPattern = '/^[A-Za-z .-]{2,50}$/';
$statePattern = '/^[A-Za-z ]{2,20}$/';

$errors = [];

if ($username === '' || !preg_match($usernamePattern, $username)) {
    $errors[] = "Username is required and must be 4-20 characters using only letters, numbers or underscores";
}

if ($password === '' || !preg_match($passwordPattern, $password)) {
    $errors[] = "Password is required and must be at least 8 characters";
}

if ($confirm === '' || $confirm !== $password) {
    $errors[] = "Passwords do not match";
}

if ($name === '' || !preg_match($namePattern, $name)) {
    $errors[] = "Name is required and must contain only letters and spaces";
}

if ($email === '' || !preg_match($emailPattern, $email)) {
    $errors[] = "A valid email address is required";
}

if ($phone !== '' && !preg_match($phonePattern, $phone)) {
    $errors[] = "Phone number must be 10 digits";
}

if ($city !== '' && !preg_match($cityPattern, $city)) {
    $errors[] = "City must contain only letters and spaces";
}

if ($state !== '' && !preg_match($statePattern, $state)) {
    $errors[] = "State must contain only letters and spaces";
}


if (!empty($errors)) {
        $_SESSION['messages'] = array_merge($_SESSION['messages'], $errors);
        header("Location: registration.php");
        exit;
}

$db = new SQLite3('user.db');
$susername = $db->escapeString($username);
$semail = $db->escapeString($email);

$hashpassword = password_hash($password, PASSWORD_DEFAULT); 

$shashpassword = $db->escapeString($hashpassword);

$sname = $db->escapeString($name);
$sphone = $db->escapeString($phone);
$scity = $db->escapeString($city);
$sstate = $db->escapeString($state);

$command_check = "SELECT id FROM user WHERE username = '$susername' OR email = '$semail'";
$result_check = $db->query($command_check);

if ($result_check->fetchArray()) {
    $_SESSION['messages'][] = "The Username or Email used is already linked to an account. Please either log in or use different credentials";
    $db->close();
    header("Location: registration.php");
    exit;
}

$command = "INSERT INTO user (username, pass_hash, flname, email, phone, ucity, ustate)
VALUES ('$susername', '$shashpassword', '$sname', '$semail', '$sphone', '$scity', '$sstate')";
$result = $db->exec($command);
if ($result){
    $_SESSION['messages'][] = "Thank you for joining the ISAO community! We hope you find our community warm and inviting!";
    header("Location: index.php");
    $db->close();
    exit;
}
else{
    $error_message = $db->lastErrorMsg();
    $_SESSION['messages'][] = "Database Error" . $error_message;
    header("Location: registration.php");
    $db->close();
    exit;
}
