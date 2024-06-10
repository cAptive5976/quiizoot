<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: index.php?route=login_admin');
    exit();
}
function active_quiz() {
    require('crud/connection.php');
    $c = connection();
    require('crud/crud_functions.php');
    $isactive = get_isactive($c);

    if ($isactive == 0) {
        set_active($c);
        $_SESSION['green_alert'] = "Le quiz est maintenant actif.";
    } else {
        $_SESSION['red_alert'] = "Le quiz est déjà actif.";
    }
    header('Location: index.php?route=menu_admin');
}

function end_quiz() {
    require('crud/connection.php');
    $c = connection();
    require('crud/crud_functions.php');
    $isactive = get_isactive($c);

    if ($isactive == 1) {
        set_inactive($c);
        $_SESSION['green_alert'] = "Le quiz est maintenant inactif.";
    } else {
        $_SESSION['red_alert'] = "Le quiz est déjà inactif.";
    }
    header('Location: index.php?route=menu_admin');
}
