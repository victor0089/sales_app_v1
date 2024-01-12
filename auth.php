<?php
session_start();

function isUserLoggedIn() {
    return isset($_SESSION['user_id']);
}

function isAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] == 'admin';
}

function requireLogin() {
    if (!isUserLoggedIn()) {
        header("Location: login.php");
        exit();
    }
}

function requireAdmin() {
    if (!isAdmin()) {
        header("Location: index.php");
        exit();
    }
}

function logout() {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}
?>
