///modificar en caso de cambie id
///VARIABLES DE CATALOGO TBL MOVIMIENTOS
var movimientoBaja = 3;
var movimientoAlta = 1;
var movimientoMov = 2;

function validarMovimiento(){
    let movimiento_general = document.getElementById('movimiento_general').value;
    let id_tbl_movimientos = document.getElementById('id_tbl_movimientos').value;
    let fecha_movimiento = document.getElementById('fecha_movimiento').value;
    let id_tbl_control_plazas_hraes = document.getElementById('id_tbl_control_plazas_hraes').value;
    let fecha_inicio = document.getElementById('fecha_inicio').value;
    let id_cat_caracter_nom_hraes = document.getElementById('id_cat_caracter_nom_hraes').value;
    let id_object = document.getElementById('id_object').value;

    if (validarData(movimiento_general,'Movimiento general')){///CONDICION DE INICIAL PARA MOVIMIENTO GENERAL
        if(movimiento_general != movimientoBaja){ ///EL MOVIMIENTO ES UNA ALTA O MOVIMIENTO
            if(validarData(id_tbl_movimientos,'Movimiento especifico') && ///VALIDACION DE CAMPOS REQUERIDOS PARA ALTA O MOVIMIENTO
                validarData(fecha_movimiento,'Fecha de movimiento') &&
                validarData(id_tbl_control_plazas_hraes,'Núm. Plaza') &&
                validarData(fecha_inicio,'Fecha de inicio') &&
                validarData(id_cat_caracter_nom_hraes,'Caracter nombramiento')){ 
                    validarUltimoMovimiento(movimiento_general,id_object,fecha_movimiento);///FUNCION PARA VALIDAR EL ULTIMO MOVIMIENTO
            }
        } else { ///EL MOVIMIENTO ES UN BAJA
            if(validarData(id_tbl_movimientos,'Movimiento especifico') && ///VALIDACION DE CAMPOS REQUERIDOS PARA BAJA
               validarData(fecha_movimiento,'Fecha de movimiento')){ 
                validarUltimoMovimiento(movimiento_general,id_object,fecha_movimiento);///FUNCION PARA VALIDAR EL ULTIMO MOVIMIENTO
            }
        }
    }
}

///LA FUNCION VALIDA EL ULTIMO MOVIMIENTO, FECHAS Y CAMPOS PARA ASIGNAR EL MOVIMIENTO
function validarUltimoMovimiento(movimiento_general,id_object,fecha_movimiento){
    $.post("../../../../App/Controllers/Hrae/MovimientosC/UltimoMovimientoC.php", {
        movimiento_general:movimiento_general,
        fecha_movimiento:fecha_movimiento,
        movimientoBaja:movimientoBaja,
        id_object:id_object,
        id_tbl_empleados_hraes:id_tbl_empleados_hraes,
        movimientoAlta:movimientoAlta,
        movimientoMov:movimientoMov,
    },
        function (data) {
            let jsonData = JSON.parse(data);
            let bool = jsonData.bool;
            let mensaje = jsonData.mensaje;

            if(bool){
                guardarMovimiento();///ACCCION DE GUARDAR INFO
            } else {
                messageLarge(mensaje);
            }
        }
    );
}

///LA FUNCION OBTIENE EL TIPO DE CONTRATACION  Y CENTRO DE TRABAJO CUANDO SE CAMBIA EL EVENTO DE  NUM_PLAZA
document.getElementById("id_tbl_control_plazas_hraes").addEventListener("change", function() {
    let id_tbl_control_plazas_hraes = this.value;
    $.post("../../../../App/Controllers/Hrae/MovimientosC/NumPlazaC.php", {
        id_tbl_control_plazas_hraes: id_tbl_control_plazas_hraes,
    },
        function (data) {
            let jsonData = JSON.parse(data);
            let contratacion = jsonData.contratacion;
            let centroTrabajo = jsonData.centroTrabajo;

            $('#tipo_contratacion_mx').val(contratacion); 
            $('#centro_trabajo_mx').val(centroTrabajo);
        }
    );
  });


///LA FUNCION PERMITE OCULTAR O MOSTRAR EL CONTENIDO DE UNA ETIQUETA DIV
///ASI COMO OBTIENE EL SEGUNDO CATALOGO DE MOVIMIENTO ESPECIFICO
document.getElementById("movimiento_general").addEventListener("change", function() {
    let movimiento_general = this.value;
    if (movimiento_general == movimientoBaja){
        ocultarContenido();
    } else {
        mostrarContenido();
    }
    $.post("../../../../App/Controllers/Hrae/MovimientosC/MEspecificoC.php", {
        movimiento_general: movimiento_general,
    },
        function (data) {
            var jsonData = JSON.parse(data);
            var especifico = jsonData.especifico; 

            $('#id_tbl_movimientos').empty();
            $('#id_tbl_movimientos').html(especifico);   
        }
    );
  });

function ocultarContenido() {
    let x = document.getElementById("ocultar_model");
    x.style.display = "none";
    
}

function mostrarContenido() {
    let x = document.getElementById("ocultar_model");
    x.style.display = "block";
}

///FUNCION DE MENSAJE EXTENDIDO
function messageLarge(text){
    Swal.fire({
        icon: "error",
        title: "Oops...",
        text: text,
      });
}
/*
var id_tbl_empleados_hraes = document.getElementById('id_tbl_empleados_hraes').value;
var id_baja = 3; ///CATALOGO
var id_movimiento = 2;///CATALOGO
var id_alta = 1;///CATALOGO
var id_movimiento_vacante = 5;///CATALOGO

function validarPw(){
    let id_object = document.getElementById('id_object').value;
    if (id_object){
        if (validarAccion()){
            validarMovimiento();
        }
    } else {
        validarMovimiento();
    }
}


function validarMovimiento(){
    let num_plaza_m = document.getElementById('num_plaza_m').value;
    let movimiento_general = document.getElementById('movimiento_general').value;
    let id_tbl_movimientos = document.getElementById('id_tbl_movimientos').value;
    let fecha_inicio = document.getElementById('fecha_inicio').value;
    let fecha_termino = document.getElementById('fecha_termino').value;
    let fecha_movimiento = document.getElementById('fecha_movimiento').value;

    let id_tipo_plaza = document.getElementById('id_tipo_plaza').value;

    let num_plaza_validate = document.getElementById('num_plaza_validate').value;
    let id_tbl_movimientos_validate = document.getElementById('id_tbl_movimientos_validate').value;

    if (validarData(movimiento_general,'Movimiento general') &&
    validarData(id_tbl_movimientos,'Movimiento especifico') &&
    validarData(fecha_movimiento,'Fecha de movimiento')   
    ){
        if (movimiento_general != id_baja){
            if (validarData(num_plaza_m,'Núm. de plaza') &&
            validarData(fecha_inicio,'Fecha inicio')
        ){
            if (num_plaza_validate == num_plaza_m && id_tbl_movimientos_validate == id_tbl_movimientos){
                guardarMovimiento(null);
            } else {
                validarUltimoMovimiento(movimiento_general,id_tipo_plaza,movimiento_general);
            }
        }
        } else {
            if (num_plaza_validate == num_plaza_m && id_tbl_movimientos_validate == id_tbl_movimientos){
                guardarMovimiento(null);

            } else {
                validarUltimoMovimiento(movimiento_general,id_tipo_plaza,movimiento_general);
            }
            
        }
    }
}

document.getElementById("movimiento_general").addEventListener("change", function() {
    let movimiento_general = this.value;
    if (movimiento_general == id_baja){
        ocultarContenido();
    } else {
        mostrarContenido();
    }
    $.post("../../../../App/Controllers/Hrae/MovimientosC/MEspecificoC.php", {
        movimiento_general: movimiento_general,
    },
        function (data) {
            var jsonData = JSON.parse(data);
            var especifico = jsonData.especifico; 

            $('#id_tbl_movimientos').empty();
            $('#id_tbl_movimientos').html(especifico);   
        }
    );
  });

function validarNumPlaza(){
    let num_plaza_m = document.getElementById('num_plaza_m').value.trim();

    $.ajax({
        type: 'POST',
        url: "../../../../App/Controllers/Hrae/MovimientosC/NumPlazaC.php",
        data: {num_plaza_m:num_plaza_m },
        success: function (data) {
            jsonData = JSON.parse(data);
            let tipo_plaza = jsonData.tipo_plaza;
            let unidad_responsable = jsonData.unidad_responsable;
            let id_tipo_plaza = jsonData.id_tipo_plaza;
            let id_plaza = jsonData.id_plaza;

            $("#id_tipo_plaza").val(id_tipo_plaza);
            $("#id_plaza").val(id_plaza);
            $("#tipo_plaza_m").val(tipo_plaza);
            $("#unidad_responsable_m").val(unidad_responsable);
        }
    });
}

///LA FUNCION PERMITE CONSULTAR EL ULTIMO MOVIMIENTO DEL EMPLEADO
function validarUltimoMovimiento(id_movimiento,id_tipo_plaza,movimiento_general){
    $.ajax({
        type: 'POST',
        url: "../../../../App/Controllers/Hrae/MovimientosC/UltimoMovimientoC.php",
        data: {id_tbl_empleados_hraes:id_tbl_empleados_hraes,
            id_movimiento:id_movimiento
         },
        success: function (data) {
            jsonData = JSON.parse(data);
            let bool = jsonData.bool;
            let mensaje = jsonData.mensaje;
            let id_plaza_x = jsonData.id_plaza_x;

            if (bool){
                if (movimiento_general != id_baja){
                if (id_tipo_plaza == id_movimiento_vacante){
                    ///Guardar
                    guardarMovimiento(null);
                } else {
                    mensajeError('La plaza no se encuentra vacante');
                }
            } else {
                guardarMovimiento(id_plaza_x);
            }
            } else {   
                mensajeError(mensaje);
            }
        }
    });
}





function ocultarContenido() {
    let x = document.getElementById("ocultar_model");
    x.style.display = "none";
    
}

function mostrarContenido() {
    let x = document.getElementById("ocultar_model");
    x.style.display = "block";
}
    */