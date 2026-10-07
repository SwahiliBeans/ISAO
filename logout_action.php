<?php /* Max Adams
Course CS312
Dec 6, 2025
log out action page for ISAO */
session_start();
$_SESSION = array();

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
session_destroy();

$_SESSION['messages'][] = "You have been successfully logged out.";
header("Location: login.php");
exit;