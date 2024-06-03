<?php
session_start();

function login() {
    require('vues/login_admin_user.php');
}

function login_admin() {
    require('vues/vues_admin/auth_admin.php');
}