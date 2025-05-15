<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4"><i class="fas fa-user-plus"></i> <?php echo ' ' . $vTITULO . $vIES['numero'];; ?></h1>
            <hr>

            <form method="POST" id="form_nuevo" action="<?php echo base_url(); ?>/alumnos/guardar_nuevo" autocomplete="off" enctype="multipart/form-data">
            <input type="hidden" id="id_persona" name="id_persona" required/>
            <input type="hidden" id="id_ies" name="id_ies" readonly/>

            <div class="form-group">

                <fieldset class="form-group border p-3" style="background-color: #f2f2f2">
                    <div class="row">
                        <div class="col-12 col-sm-6" style="margin-bottom: 15px">
                            <label>Seleccione Persona para agregar</label>
                            <input class="form-control py-4" id="persona" name="persona" type="text" placeholder="Buscar por Apellido o DNI" required />
                        </div>
                    </div>
                </fieldset>

                <fieldset class="form-group border p-3" style="background-color: #e9ecef">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Agregar</button>
                    <a href="<?php echo base_url(); ?>/alumnos" class="btn btn-secondary"><i class="fa fa-undo-alt"></i> Cancelar</a>
                </fieldset>

            </div>
        
        </form>

        </div>
    </main>

<script>    
    // Busqueda de persona por APELLIDO
    $(function() {
        $("#persona").autocomplete({
            source: "<?php echo base_url(); ?>/alumnos/autocompleteData",
            minLength: 3,
            select: function(event, ui){
                event.preventDefault();
                $("#id_persona").val(ui.item.id);
                $("#persona").val(ui.item.value);
            }
        });
    });
</script>

<script>
    // Seleccionamos el formulario
    const formulario = document.getElementById('form_nuevo');
    formulario.addEventListener('submit', function(event) {
        // Obtenemos el valor del campo
        const campo = document.getElementById('id_persona').value.trim();
        // Verificamos si el campo está vacío
        if (campo === '') {
            // Evita el envío del formulario
            event.preventDefault();
            // Muestra un mensaje de advertencia
            alert('Seleccione una Persona válida');
        }
    });
</script>