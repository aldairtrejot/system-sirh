<?php
    include("../../php/DependientesEconomicosC/Listar.php");
    $id_tbl_empleados = base64_decode($_GET['D-F']); 
    $id_tbl_dependientes_economicos = base64_decode($_GET['D-F2']); 
    $rowe = listadoDependientesEconomicosPk($id_tbl_dependientes_economicos); 

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="icon" type="image/png" href="assets/images/favicon.png">
    <?php  include("libHeader.php"); ?>
</head>

<body>
    <?php include('../nav-menu.php') ?>

    <div id="main-wrapper">

        <div class="page-wrapper" >

            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h2 class="page-title">Modificar Dependiente Economico</h2>
                        <div class="d-flex align-items-center">
                            <br>
                        </div>
                    </div>


                    <div class="col-7 align-self-center">
                        <div class="d-flex no-block justify-content-end align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                    <a href="#" style="color:#cb9f52;">Dependientes Economicos</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Modificar</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="card">
                <h5 class="card-header">Ingresa los siguientes campos</h5>
                    <div class="card-body">
                        <form method="POST" action="../../php/DependientesEconomicosC/Editar.php">

                            <input type="hidden" name="id_tbl_empleados" value="<?php echo $id_tbl_empleados?>">
                            <input type="hidden" name="id_tbl_dependientes_economicos" value="<?php echo $id_tbl_dependientes_economicos?>">

                            <div class="form-row">
                            <div class="form-group col-md-6">
                                    <label >CURP</label><label style="color:red">*</label>
                                    <input type="text" class="form-control"
                                        name="curp" value="<?php echo $rowe['curp']?>" required maxlength="18">
                                </div>

                                <div class="form-group col-md-6">
                                    <label >Nombre</label><label style="color:red">*</label>
                                    <input type="text" class="form-control"
                                        name="nombre" value="<?php echo $rowe['nombre']?>">
                                </div>

                                <div class="form-group col-md-6">
                                    <label >Apellido Paterno</label><label style="color:red">*</label>
                                    <input type="text" class="form-control"
                                        name="apellido_paterno" value="<?php echo $rowe['apellido_paterno']?>">
                                </div>

                                <div class="form-group col-md-6">
                                    <label >Apellido Materno</label><label style="color:red">*</label>
                                    <input type="text" class="form-control"
                                        name="apellido_materno" value="<?php echo $rowe['apellido_materno']?>">
                                </div>

                            <div class="form-group col-md-6">
                                    <label for="inputCity">Dependiente Economico</label><label style="color:red">*</label><br>
                                    <select class="form-select" aria-label="Default select example" 
                                        name="id_cat_dependientes_economicos">
                                        <?php
                                        include ('../../php/CatDependientesEconomicosC/listar.php');
                                        echo '<option value="' . $rowe['id_cat_dependientes_economicos'] . '">' . listadoDEconomicosPK($rowe['id_cat_dependientes_economicos']) . '</option>';
                                        $listado = listadoDEconomicos();
                                        if ($listado) {
                                            if (pg_num_rows($listado) > 0) {
                                                while ($row = pg_fetch_object($listado)) {
                                                    if ($rowe['id_cat_dependientes_economicos'] != $row->id_cat_dependientes_economicos){
                                                    echo '<option value="' . $row->id_cat_dependientes_economicos . '">' . listadoDEconomicosPK($row->id_cat_dependientes_economicos) . '</option>';
                                                    }
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            
                            </div>
                            
                            
                            <a class="btn btn-light" style="background-color: #cb9f52; border:none; outline:none; color: white;"
                                href="<?php echo "Listar.php?D-F=" . base64_encode($id_tbl_empleados) ?>">Cancelar</a>
                            <button type="submit" class="btn btn-light"
                            style="background-color: #cb9f52; border:none; outline:none; color: white;">Guardar</button>

                        </form>
                    </div>
                </div>

            </div>

            <?php include('../../ajuste-menu.php') ?>
            <?php include('../../footer-librerias.php') ?>

</body>
<?php  include("libFooter.php"); ?>
</html>