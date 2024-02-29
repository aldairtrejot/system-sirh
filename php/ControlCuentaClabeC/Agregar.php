<?php

include('../../validar_sesion.php');
include ("../../conexion.php");//Se incluye el metodo de conexion para las consultas

$id_tbl_empleados = $_POST['id_tbl_empleados']; 
$id_tbl_control_plazas = $_POST['id_tbl_control_plazas']; 
$clabe = $_POST['clabe']; 
$id_cat_estatus = $_POST['id_cat_estatus']; 
$id_cat_banco = $_POST['id_cat_banco']; 
$id_cat_formato_pago = $_POST['id_cat_formato_pago']; 
$crypt = base64_encode ($id_tbl_empleados);

try {
//Se ejecuta la funcion insert SQL, para guardar cambios
$pgs_QRY = pg_insert($connectionDBsPro, 'ctrl_cuenta_clabe', array(
    'clabe' => $clabe,
    'id_cat_estatus' => $id_cat_estatus,  
    'id_cat_banco' => $id_cat_banco,  
    'id_cat_formato_pago' => $id_cat_formato_pago,
    'id_tbl_empleados' => $id_tbl_empleados
));

if ($pgs_QRY ) {
    header("Location: ../../view/CuentaClabe/Listar.php?D-F=".$crypt.'&D-F3='.$id_tbl_control_plazas); //Regreso a la tabla
} 
} catch (\Throwable $th) {
    header("Location: error.php".$th); //Muestra error
}