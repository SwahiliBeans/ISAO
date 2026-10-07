<?php /* Max Adams
Course CS312
October 9, 2025
members page for ISAO */ ?>
<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>
<main class="content">
    <h2>Thank You to Our Members</h2>
    <p>We would like to thank the following members for their contributions and support:</p>
    <ul>
        <?php
        $db = new SQLite3('user.db');
        $command = "SELECT flname FROM user ORDER BY flname ASC";
        $result = $db->query($command);  
        $members_found = false;
        if ($result) {
            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                $members_found = true;
                    echo '<li>' . htmlspecialchars($row['flname']) . '</li>';
                }
            }
            $db->close();
        ?>
    </ul>
</main>
<?php include 'footer.php'; ?>