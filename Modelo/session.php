<?php
require_once __DIR__ . '../../vendor/autoload.php';
session_start();
function verificarSesion()
{
    if (!isset($_SESSION['facil_app_user'])) {
        echo "
            <script>window.location='login.php';</script>
        ";
        exit();
    }
}

function usuarioActivo()
{
    $resultado = false;
    if (isset($_SESSION['facil_app_user'])) {
        $resultado = $_SESSION['facil_app_user'];
    }
    return $resultado;
}
function verificarUsuario($datos)
{   
    
    $colection = new MongoDB\Client();
    $usuarios = $colection->selectCollection('gestionautos','usuarios');

    $usrs = $usuarios->findOne($datos);
    //$usr = $usrs->getNext();
    if ($usrs) { 
        $_SESSION['facil_app_user'] = $usrs;
        return true;
    }
    return false;
    
}
