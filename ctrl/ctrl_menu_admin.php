<?php
session_start();
require('vues/blocs/header.php');

if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
    header('Location: index.php?route=login');
    exit;
}

require('vues/vues_admin/menu_admin.php');

require('vues/blocs/footer.php');