<?php
include('../../validar_sesion.php');    //Se incluye validar_sesion
include('../../conexion.php'); //Se incluye la conexion

     //La variable contiene el listado
    $listado = pg_query($connectionDBsPro, "SELECT * FROM tbl_zonas_pago ORDER BY id_tbl_zonas_pago DESC"); 
  

    function listadoFk($id){
     $catSQL = pg_query("SELECT * FROM tbl_zonas_pago WHERE id_cat_centro_trabajo = '$id' ");
     return $catSQL;
}
     //La funcion retorna los atributos dependiendo del id que se ingrese como parametro
     function listadoPk($id){
          $catSQL = pg_query("SELECT * FROM tbl_zonas_pago WHERE id_tbl_zonas_pago = '$id' ");
          $row = pg_fetch_array($catSQL);
          return $row;
     }
