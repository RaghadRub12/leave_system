<?php
include __DIR__ . '/includes/db.php';
include __DIR__ . '/includes/functions.php';

if (is_authenticated()) {
    $_SESSION['logged_in'] = false;
    unset($_SESSION['user']);

    session_regenerate_id();

    setcookie('remember_token', '', time() - 60 * 60, '/');
}

redirect('login.php');