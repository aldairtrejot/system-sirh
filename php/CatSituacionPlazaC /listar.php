<?php
include('../../validar_sesion.php');    //Se incluye validar_sesion
include('../../conexion.php'); //Se incluye la conexion

function listadoSituacionPlaza()
{
    include('../../conexion.php'); //Se incluye la conexion
    $listado = pg_query($connectionDBsPro, "SELECT * FROM cat_situacion_plaza ORDER BY situacion_plaza ASC");
    return $listado;
}

//La funcion retorna solo el estatus
function listadoSituacionPlazaPk($id)
{
    if ($id != null){
    $catSQL = pg_query("SELECT * FROM cat_situacion_plaza WHERE id_situacion_plazas = '$id' ");
    $row = pg_fetch_array($catSQL);
    $res = $row['situacion_plaza'];
    return $res;
    } else {
        return '';
    }
}
