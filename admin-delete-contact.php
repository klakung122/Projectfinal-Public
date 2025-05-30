<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    $_SESSION['message'] = 'Please log in first!';
    header('Location: login');
    exit();
}

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = '{$user_id}'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

if ($user['type_id'] != 3) {
    $_SESSION['message'] = 'Access denied! You are not an admin.';
    header('Location: login');
    exit();
}

if (isset($_GET['id'])) {
    $contact_id = $_GET['id'];

    $query = "DELETE FROM contacts WHERE id = '{$contact_id}'";
    if (mysqli_query($conn, $query)) {
        $_SESSION['message'] = 'Message deleted successfully.';
    } else {
        $_SESSION['message'] = 'Failed to delete the message.';
    }
} else {
    $_SESSION['message'] = 'No message ID provided.';
}

header('Location: admin');
exit();
mysqli_close($conn);
