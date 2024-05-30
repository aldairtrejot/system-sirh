<?php
include '../../../../conexion.php';
include '../../../Model/Hraes/PlazasM/PlazasM.php';

$listado = new modelPlazasHraes();

$id_tbl_plazas_empleados_hraes = $_POST['id_tbl_control_plazas_hraes'];
$query = $listado->listarHistoria($id_tbl_plazas_empleados_hraes); //INICIO DE LA TABLA CON LA INFORMACION

$data =
    '<table class="table table-bordered" id="tabla_historia_plaza_empleado_ix" style="width:100%">
    <thead>
        <tr>
            <th>Rfc de empleado</th>
            <th>Movimiento</th>
            <th>Fecha movimiento</th>
        </tr>
    </thead>';

if (!$result = pg_query($connectionDBsPro, $query)) {
    exit(pg_result_error($connectionDBsPro));
}
if (pg_num_rows($result) > 0) {
    while ($row = pg_fetch_row($result)) {
        $data .=
            '<tbody>
                        <tr>
                            <td style="font-size: 14px">
                                ' . $row[0] . '
                            </td>
                            <td style="font-size: 14px">
                                ' . $row[1] . '
                            </td>
                            <td style="font-size: 14px">
                                ' . $row[4] . '
                            </td>
                        </tr>
                    </tbody>
                </table>';
    }
} else {
    $data .= '<h6>Sin resultados</h6>';
}

echo $data;


