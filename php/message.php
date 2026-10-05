<?php
// Helper functions to manage session messages
function set_message($message, $type = 'success') {
    $_SESSION['message'] = $message;
    $_SESSION['message_type'] = $type;
}

function display_message() {
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
        $type = $_SESSION['message_type'] ?? 'success';
        echo "<div class='alert alert-$type'>$message</div>";
        // Clear the message after displaying it
        unset($_SESSION['message']);
        unset($_SESSION['message_type']);
    }
}
?>
