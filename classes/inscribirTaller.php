<?php

session_start();
include 'consultas.php';

$consultar = new consultas();
$datos = explode("|", $_POST['hidden']);

if (!empty($_POST)) {
    extract($_POST);
    if (!isset($hidden)) {
        $_SESSION['toastr'] = "toastr.error('', 'No se han recibido parametros');";
    } elseif (!isset($datos[0])) {
        $_SESSION['toastr'] = "toastr.error('', 'No se han recibido parametros');";
    } elseif (!isset($datos[1])) {
        $_SESSION['toastr'] = "toastr.error('', 'No se han recibido parametros');";
    } elseif (!isset($_SESSION['id'])) {
        $_SESSION['toastr'] = "toastr.error('', 'No se han recibido parametros');";
    } elseif ($consultar->validaInscripcion($_SESSION['id'], base64_decode($datos[0]), 'Taller') == 'true') {
        $_SESSION['toastr'] = 'toastr.warning("", "Ya te encontrabas inscrito en el taller <i>' . $datos[1] . '</i>");';
    } elseif ($consultar->inscribirTaller($_SESSION['id'], base64_decode($datos[0])) == 'false') {
        $_SESSION['toastr'] = 'toastr.error("", "El registro no pudo ser completado, intente nuevamente");';
    } else {
        $_SESSION['toastr'] = 'toastr.success("", "Se ha inscrito al taller <i>' . $datos[1] . '</i>");';
    }
} else {
    $_SESSION['toastr'] = 'toastr.error("", "El registro no pudo ser completado, intente nuevamente");';
}
header('Location: ../users/talleres.php');
?>

