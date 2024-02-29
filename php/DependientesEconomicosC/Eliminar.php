<?php
include('../../validar_sesion.php'); //Se incluye validar_sesion
include('../../conexion.php'); // Se incluye la conexion a la db

$id_tbl_empleados = base64_decode($_GET['D-F']);
$id_tbl_control_plazas = $_GET['D-F3'];
$id_tbl_dependientes_economicos = base64_decode($_GET['D-F2']); 
$crypt = base64_encode ($id_tbl_empleados);

try {
$pgs_QRY = pg_delete(
    $connectionDBsPro,
    'tbl_dependientes_economicos',
    array(
        'id_tbl_dependientes_economicos' => $id_tbl_dependientes_economicos
    )
);
if ($pgs_QRY ) {
    header("Location: ../../view/DependientesEconomicos/Listar.php?D-F=".$crypt.'&D-F3='.$id_tbl_control_plazas); //Regreso a la tabla
} 
} catch (\Throwable $th) {
    header("Location: error.php".$th); //Muestra error
}

