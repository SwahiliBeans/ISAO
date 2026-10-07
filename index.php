<?php /* Max Adams
Course cs312
October 9, 2025
homepage for ISAO */ ?>
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

<main class="home-content">
    <section class="welcome-section">
        <h2>Welcome to the ISAO Home Page!</h2>
        <p>
            The Invasive Species Awareness Organization (ISAO) is dedicated to protecting our ecosystems
            by spreading awareness, providing education, and promoting community involvement.
            On this site you can find more information about invasive species in your area and how to help.
            We strive to inform and inspire positive action in protecting our local environments.
        </p>
    </section>

    <section class="member-apreciation">
        <h3>Thank YOU to our members!</h3>
        <p>
            Our mission is supported by our wonderful and generous members.
            They are the ones keeping this project running and spreading awareness of the effects/dangers of invasive species.
            Thank you so much for your continued support!
        </p>
        <p>
            Join us in identifying, reporting, and taking appropriate action to protect
            the environment from invasive species and destructive human behavior.
        </p>
    </section>
</main>

<?php include 'footer.php'; ?>