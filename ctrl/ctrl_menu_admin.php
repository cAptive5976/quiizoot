<?php
session_start();

if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
    header('Location: index.php?route=login');
    exit;
}

require('vues/menu_admin.php');