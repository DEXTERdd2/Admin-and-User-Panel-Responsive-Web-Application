<?php require_once 'connection.php'; ?>

<?php
session_start();
unset($_SESSION['id']);
header('location: ./login_users.php');
