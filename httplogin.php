<?php
function showLogin() {
    header('WWW-Authenticate: Basic realm="Demo System"');
    header('HTTP/1.0 401 Unauthorized');
    echo "Usted no tiene permisos para ingresar.\n";
    exit;
}
$username = $_SERVER['PHP_AUTH_USER'];
$userpass = $_SERVER['PHP_AUTH_PW'];
if (!isset($username)) {
    showLogin();
} else {
    if ($username != "SoCcErMaSh" || $userpass != "50CP455T35T") {
        showLogin();
    }
}