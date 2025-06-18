<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

// Escapa / Sanitizar el HTML
// Función que revisa que el usuario este autenticado
// function isAuth() : void {
//     if(!isset($_SESSION['login'])) {
//         header('Location: /');
//     }
// }

function isAuth() : bool {
    if(!isset($_SESSION)) {
        session_start();
    }
    return isset($_SESSION['nombre']) && !empty($_SESSION);
}

function isAdmin() : bool {
    if(!isset($_SESSION)) {
        session_start();
    }
    return isset($_SESSION['admin']) && !empty($_SESSION['admin']);
}

// function isSession() : void {
//     if(!isset($_SESSION)) {
//         session_start();
//     }
// }

function pagina_actual($path) : bool {
    return str_contains($_SERVER['PATH_INFO'] ?? '/', $path) ? true : false;
}