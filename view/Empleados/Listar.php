<?php
include("../../php/EmpleadosC/Listar.php");
include("../../php/PlazasC/Listar.php");
$id_tbl_control_plazas = base64_decode(($_GET['D-F3']));
$id_tbl_centro_trabajo = ($_GET['RP']);
$rowe = catControlPlazasPk($id_tbl_control_plazas);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="icon" type="image/png" href="../assets/images/favicon.png">
    <style>
        a.dropdown-item:hover {
            background-color: #fbf4e8;
            ;
        }
    </style>
    <?php include("libHeader.php"); ?>

</head>

<body onload="messageInfo();">
    <?php include("../../conexion.php") ?>
    <?php include('../nav-menu.php') ?>
    <?php include("../../php/CatPlazasC/listar.php"); ?>
    <?php include("../../php/CatTipoContratacionC/listar.php"); ?>
    <?php include("../../php/CatSituacionPlazaC/listar.php"); ?>
    <?php include("../../php/CatEstatusC/listar.php"); ?>
    <?php include("../../php/CatMovimientoC/listar.php"); ?>
    <?php include("../../php/CentroTrabajoC/Listar.php"); ?>

    <div id="main-wrapper">

        <div class="page-wrapper">

            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h2 class="page-title">Control de Empleados</h2>
                        <div class="d-flex align-items-center">
                        </div>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex no-block justify-content-end align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="../../index.php" style="color:#cb9f52;">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Empleados</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>



            <div class="container-fluid">
                <p>Informaci&oacuten de la plaza seleccionada.</p>
                <p style="font-size:14px; margin-top:0; margin-bottom:0;">N&uacutemero de plaza:
                    <?php echo $rowe['num_plaza'] ?>
                </p>
                <p style="font-size:14px; margin-top:0; margin-bottom:0;">Tipo de plaza:
                    <?php echo catalogoPlazaPk($rowe['id_cat_plazas']); ?>
                </p>
                <p style="font-size:14px; margin-top:0; margin-bottom:0;">Tipo Contrataci&oacuten:
                    <?php echo catalogoContratacionPk($rowe['id_cat_tipo_contratacion']); ?>
                </p>
                <p style="font-size:14px; margin-top:0; margin-bottom:0;">Centro de Trabajo:
                    <?php echo claveCentro($id_tbl_control_plazas); ?>
                </p>
                <br>

                <div class=" btn-group">
                    <button type="button" class="btn btn-light" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false" style="background-color: white; border:none; outline:none; color: white;">
                        <i class="fa fa-cog" style="font-size: 1.4rem; color:#9f2241;"></i>
                    </button>

                    <?php
                    $listado = listadoEmpleados($id_tbl_control_plazas);
                    if ($listado) {
                        if (pg_num_rows($listado) > 0) {
                            while ($obj = pg_fetch_object($listado)) { ?>

                                <div class="dropdown-menu" style="height: 1200%; overflow: auto;">
                                    <a class="dropdown-item" href="<?php echo '../Plazas/Listar.php?RP='.$id_tbl_centro_trabajo ?>">Regresar</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item"
                                        href="<?php echo "Editar.php?D-F=" . base64_encode($obj->id_tbl_empleados) . '&D-F3=' . base64_encode($id_tbl_control_plazas) .'&RP='.$id_tbl_centro_trabajo?>">Modificar</a>
                                    <a class="dropdown-item"
                                        href="<?php echo "../Telefono/Listar.php?D-F=" . base64_encode($obj->id_tbl_empleados) . '&D-F3=' . base64_encode($id_tbl_control_plazas).'&RP='.$id_tbl_centro_trabajo ?>">N&uacutem.
                                        Telefonico</a>
                                    <a class="dropdown-item"
                                        href="<?php echo "../JefeInmediato/Listar.php?D-F=" . base64_encode($obj->id_tbl_empleados) . '&D-F3=' . base64_encode($id_tbl_control_plazas).'&RP='.$id_tbl_centro_trabajo ?>">Jefe
                                        Inmediato</a>
                                    <a class="dropdown-item"
                                        href="<?php echo "../MediosContacto/Listar.php?D-F=" . base64_encode($obj->id_tbl_empleados) . '&D-F3=' . base64_encode($id_tbl_control_plazas).'&RP='.$id_tbl_centro_trabajo ?>">Medios
                                        de Contacto</a>
                                    <a class="dropdown-item"
                                        href="<?php echo "../CuentaClabe/Listar.php?D-F=" . base64_encode($obj->id_tbl_empleados) . '&D-F3=' . base64_encode($id_tbl_control_plazas).'&RP='.$id_tbl_centro_trabajo?>">Cuenta
                                        Clabe</a>
                                    <a class="dropdown-item"
                                        href="<?php echo "../ContactoEmergencia/Listar.php?D-F=" . base64_encode($obj->id_tbl_empleados) . '&D-F3=' . base64_encode($id_tbl_control_plazas).'&RP='.$id_tbl_centro_trabajo ?>">Contacto
                                        Emergencia</a>
                                    <a class="dropdown-item"
                                        href="<?php echo "../DependientesEconomicos/Listar.php?D-F=" . base64_encode($obj->id_tbl_empleados) . '&D-F3=' . base64_encode($id_tbl_control_plazas).'&RP='.$id_tbl_centro_trabajo ?>">Dependientes
                                        Economicos</a>
                                    <a class="dropdown-item"
                                        href="<?php echo "../Jornada/Listar.php?D-F=" . base64_encode($obj->id_tbl_empleados) . '&D-F3=' . base64_encode($id_tbl_control_plazas).'&RP='.$id_tbl_centro_trabajo ?>">Jornada</a>
                                    <a class="dropdown-item"
                                        href="<?php echo "../Retardo/Listar.php?D-F=" . base64_encode($obj->id_tbl_empleados) . '&D-F3=' . base64_encode($id_tbl_control_plazas).'&RP='.$id_tbl_centro_trabajo ?>">Retardos</a>
                                    <a class="dropdown-item"
                                        href="<?php echo "../DatosEmpleado/Listar.php?D-F=" . base64_encode($obj->id_tbl_empleados) . '&D-F3=' . base64_encode($id_tbl_control_plazas).'&RP='.$id_tbl_centro_trabajo ?>">Mas
                                        Datos</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" data-toggle="modal"
                                        data-target="<?php echo '#modal-' . $obj->id_tbl_empleados ?>">Eliminar</a>
                                </div>
                            </div>

                            <!-- MODAL ELIMINAR -->
                            <div class="modal fade" id="<?php echo 'modal-' . $obj->id_tbl_empleados ?>" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">¿Desea Continuar?</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            La accion de eliminar no se puede rehacer.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            <a class="btn btn-danger"
                                                href="<?php echo "../../php/EmpleadosC/Eliminar.php?CT=" . base64_encode($obj->id_tbl_empleados) . '&D-F3=' . base64_encode($id_tbl_control_plazas).'&RP='.$id_tbl_centro_trabajo ?>">Eliminar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- MODAL ELIMINAR -->


                            <table class="table table-striped" id="t-usuarios">
                                <thead>
                                    <tr style="background-color: #5c5c5c;">
                                        <th style="color: white;">C&oacutedigo</th>
                                        <th style="color: white;">CURP</th>
                                        <th style="color: white;">Nombre</th>
                                        <th style="color: white;">Primer Apellido</th>
                                        <th style="color: white;">Segundo Apellido</th>
                                        <th style="color: white;">RFC</th>
                                        <th style="color: white;">NSS</th>
                                        <th style="color: white;">Fecha Ingreso</th>
                                        <th style="color: white;">Fecha de Baja</th>
                                        <th style="color: white;">Estatus</th>
                                        <th style="color: white;">Movimiento</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <?php echo $obj->codigo_empleado ?>
                                        </td>
                                        <td>
                                            <?php echo $obj->curp ?>
                                        </td>
                                        <td>
                                            <?php echo $obj->nombre ?>
                                        </td>
                                        <td>
                                            <?php echo $obj->primer_apellido ?>
                                        </td>
                                        <td>
                                            <?php echo $obj->segundo_apellido ?>
                                        </td>
                                        <td>
                                            <?php echo $obj->rfc ?>
                                        </td>
                                        <td>
                                            <?php echo $obj->nss ?>
                                        </td>
                                        <td>
                                            <?php echo $obj->fecha_ingreso ?>
                                        </td>
                                        <td>
                                            <?php echo $obj->fecha_baja ?>
                                        </td>
                                        <td>
                                            <?php echo catEstatus($obj->id_cat_estatus) ?>
                                        </td>
                                        <td>
                                            <?php echo catMovimientoPk($obj->id_tbl_movimientos) ?>
                                        </td>
                                    </tr>
                                    <?php
                            }
                        } else { ?>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item"
                                        href="<?php echo 'Agregar.php?D-F3=' . base64_encode($id_tbl_control_plazas).'&RP='.$id_tbl_centro_trabajo ?>">Agregar</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?php echo '../Plazas/Listar.php?RP='.$id_tbl_centro_trabajo ?>">Regresar</a>
                                </div>
                            <?php
                        }
                    }
                    ?>


                        <?php include('../../ajuste-menu.php') ?>
                        <?php include('../../footer-librerias.php') ?>

            </div>
        </div>
        <input type="hidden" id="messageInfo" value="<?php echo base64_decode($_GET['MS3']); ?>">
</body>

<script>
    function messageInfo() {
        let messageInfo = document.getElementById("messageInfo").value;
        if (messageInfo == 1) {
            messajeError('No es posible eliminar un empleado que cuente num. Telefonico, Jefe inmediato, Medios de contacto ...');
        }
    }
</script>

<script>
    $(document).ready(function () {
        $('#t-usuarios').DataTable({
            scrollX: true,
            language: {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            responsive: "true",
            dom: 'Bfrtilp',
            buttons: [

            ],
        }

        );
    });


</script>
<?php include("libFooter.php"); ?>

</html>