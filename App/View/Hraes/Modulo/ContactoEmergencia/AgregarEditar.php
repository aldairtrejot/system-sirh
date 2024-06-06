<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true" id="agregar_editar_contacto_emergencia">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header background-modal">
                <h5 class="modal-title text-modal-tittle"><label id="titulo_emergencia"
                        class="text-modal-tittle"></label> contacto de emergencia.</h5>
            </div>

            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-6">
                            <label class="text-input-form text-input-rem">Nombre (s)</label><label class="text-required">*</label>
                            <input type="text" class="form-control" onkeyup="convertirAMayusculas(event,'nombre')" id="nombre" placeholder="Nombre" maxlength="20">
                        </div>
                        <div class="col-6">
                            <label class="text-input-form text-input-rem">Parentesco</label><label class="text-required">*</label>
                            <input type="text" class="form-control" onkeyup="convertirAMayusculas(event,'parentesco')" id="parentesco" placeholder="Parentesco"
                                maxlength="20">
                        </div>
                    </div>

                    <div class="div-spacing"></div>
                    <div class="row">
                        <div class="col-6">
                            <label class="text-input-form text-input-rem">Apellido paterno</label><label class="text-required">*</label>
                            <input type="text" class="form-control" onkeyup="convertirAMayusculas(event,'primer_apellido')" id="primer_apellido" placeholder="Apellido paterno"
                                maxlength="20">
                        </div>
                        <div class="col-6">
                            <label class="text-input-form text-input-rem">N&uacutem. Telef&oacutenico</label><label class="text-required">*</label>
                            <input type="number" class="form-control" id="movil_emergencia"
                                placeholder="Número telefónico" maxlength="10">
                        </div>
                    </div>

                    <div class="div-spacing"></div>
                    <div class="row">
                        <div class="col-6">
                            <label class="text-input-form text-input-rem">Apellido materno</label><label class="text-required"></label>
                            <input type="text" class="form-control" onkeyup="convertirAMayusculas(event,'segundo_apellido')" id="segundo_apellido" placeholder="Apellido materno"
                                maxlength="20">
                        </div>
                    </div>
                </div>
            </div>

            <div class="div-spacing"></div>
            <div class="modal-footer">
                <button onclick="salirAgregarEditarEmergencia();" type="button" class="btn btn-secondary"
                    data-dismiss="modal"><i class="fas fa-times"></i> Cancelar</button>
                <button type="button" class="btn btn-success save-botton-modal" onclick="return validarEmergencia();"><i
                        class="fas fa-save"></i> Guardar</button>
                <input type="hidden" id="id_object">
            </div>

        </div>
    </div>
</div>