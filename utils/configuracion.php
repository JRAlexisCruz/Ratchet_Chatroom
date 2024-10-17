<?php
header('Content-Type: text/html; charset=utf-8');
header("Cache-Control: no-cache, must-revalidate");

$PROYECTO = "Ratchet_Project/Ratchet_Chatroom";

// Variable que almacena el directorio del proyecto
$ROOT = $_SERVER['DOCUMENT_ROOT'] . "/$PROYECTO/";

// Almacenar la raíz del proyecto en la sesión
$GLOBALS['ROOT'] = $ROOT;

// Incluir funciones desde la carpeta util
include_once($ROOT . 'utils/functions.php');