<?php require_once './connection.php'; ?>

<?php

if (isset ($_GET['id']) && !empty ($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
} else {
    header('Location: ./submit.php');
}

$sql = "DELETE FROM `books` WHERE `book_id` = $id";

if ($conn->query($sql)) {
    header('Location: ./submit.php');
} else {
    echo 'Student has failed to delete';
}