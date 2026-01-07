<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/core/Auth.php';

if (Auth::check()) {
    header('Location: public/dashboard.php');
    exit;
} else {
    header('Location: public/login.php');
    exit;
}