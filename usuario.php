<?php include("validar_rol.php"); ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="icon" type="image/png" href="assets/images/favicon.png">
</head>

<body onload="messajeInfo()">
    <?php include("conexion.php") ?>
    <?php include('nav-menu.php') ?>
    <?php include("php/usuario/listarUsuario.php") ?>


    <div id="main-wrapper">

        <div class="page-wrapper" style="background-color: #f6f6f6;">

            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h2 class="page-title">Control de Usuarios</h2>
                        <div class="d-flex align-items-center">
                            <?php
                            $ma = $_GET["ma"];
                            $me = $_GET["me"];
                            $ms = $_GET["ms"];
                            ?>
                            <input type="hidden" id="ma" value="<?php echo $ma ?>">
                            <input type="hidden" id="me" value="<?php echo $me ?>">
                            <input type="hidden" id="ms" value="<?php echo $ms ?>">

                        </div>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex no-block justify-content-end align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="index.php">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Control Usuarios</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <a class="btn my-3 btn-info" href="<?php echo "usuarioAgregar.php" ?>">Agregar Usuario</a>
                <table class="table table-striped" id="t-usuarios">
                    <thead>
                        <tr style="background-color: #5c5c5c;">
                            <th style="color: white;">Nick</th>
                            <th style="color: white;">Nombre</th>
                            <th style="color: white;">Status</th>
                            <th style="color: white;">Rol</th>
                            <th style="color: white;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        if ($usEx) {
                            if (pg_num_rows($usEx) > 0) {
                                while ($obj = pg_fetch_object($usEx)) { ?>
                                    <tr>
                                        <td>
                                            <?php echo $obj->nick ?>
                                        </td>
                                        <td>
                                            <?php echo $obj->nombre ?>
                                        </td>
                                        <td>
                                            <?php echo statusFunction($obj->status) ?>
                                        </td>
                                        <td>
                                            <?php echo rolFunction($obj->id_rol) ?>
                                        </td>
                                        <td>
                                            <a class="btn" style="background-color: #5c5c5c; color: white;"
                                                href="<?php echo "usuarioEditar.php?id_user=" . $obj->id_user ?>">Modificar</a>
                                            <a class="btn btn-danger" 
                                                href="<?php echo "php/usuario/eliminarUsuario.php?id_user=" . $obj->id_user ?>">Eliminar</a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else
                                echo "<p>Sin Resultados</p>";
                        }
                        ?>

                        <?php include('ajuste-menu.php') ?>
                        <?php include('footer-librerias.php') ?>

</body>

<script>

    

    //Mensaje

    function messajeInfo() {
        let ma = document.getElementById("ma").value; //Variable de agregar
        let me = document.getElementById("me").value; //Variable de eliminar
        let ms = document.getElementById("ms").value; //Variable de modificar
        console.log(ma);
        if (ma) {
            message("Usuario Agregado");
        } else if (me) {
            message("Usuario Eliminado");
        } else if (ms) {
            message("Usuario Modificado");
        }
    }

    function message(text) {
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "success",
            title: text
        });
    }


</script>

<script>

    $(document).ready(function () {
        $('#t-usuarios').DataTable({
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
            buttons: [{
                extend: 'excelHtml5',
                text: '<i class="fas fa-file-excel"></i> ',
                titleAttr: 'Exportar a Excel',
                className: 'btn btn-success',
                exportOptions: {
                    columns: ':not(.evita)',
                },
                filename: 'Usuarios'
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="fas fa-file-pdf"></i> ',
                titleAttr: 'Exportar a PDF',
                className: 'btn btn-danger',
                orientation: 'landscape',
                exportOptions: {
                    columns: ':not(.evita)',
                },
                filename: 'Requisiciones_ 2023:12:18:12:05'
            },
            {
                extend: 'print',
                text: '<i class="fa fa-print"></i> ',
                titleAttr: 'Imprimir',
                className: 'btn btn-info',
                title: 'Control de Usuarios',
                exportOptions: {
                    columns: [0,1,2, 3],
                },
                filename: 'Requisiciones_ 2023:12:18:12:05'
            },
            ]
        }

        );
    });
</script>


</html>