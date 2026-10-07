<?php /* Max Adams
Course CS312
October 9, 2025
events page for ISAO */ ?>
<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>

<main class="content">
    <h2>Upcoming Events</h2>
        <ul>
        <?php
        $db = new SQLite3('event.db');
        if (!$db) {
        echo '<li><p>Error: Could not connect to the events database.</p></li>';
        }
        else {
            $command = "SELECT title, sponsor, descr, eventtime FROM event ORDER BY eventtime ASC";
            $result = $db->query($command);
            $events_found = false;
        if ($result) {
            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $events_found = true;
            $timestamp = strtotime($row['eventtime']);
            $display_date = date('F j, Y', $timestamp);
            $display_time = date('g:i A', $timestamp);
                        echo '<li>';
                        echo '<strong>' . htmlspecialchars($display_date) . ' ' . htmlspecialchars($display_time) . '</strong> – ' 
                         . htmlspecialchars($row['title']) . ' (Sponsored by ' . htmlspecialchars($row['sponsor']) .')';
                        echo '<br><strong>Description:</strong> <br>' . htmlspecialchars($row['descr']);
                        echo '</li>';
                    }
                }
                
                if (!$events_found) {
                    echo '<li>No events currently scheduled.</li>';
                }

                $db->close();
            }
        ?>
        </ul>
    <h3>New Event? Click Below!</h3>
    <button onclick="window.location.href='new_event.php';">Create New Event</button>
</main>

<?php include 'footer.php'; ?>