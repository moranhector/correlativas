<script>
    function validarFormulario(event) {
        var valor = document.getElementById("id_persona").value;

        if (valor === "0" || valor.trim() === "") {
            alert("Debe seleccionar una persona para el exámen.");
            event.preventDefault(); // Evita que el formulario se envíe
            return false;
        }
        return true; // Permite el envío si la validación es correcta
    }
</script>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
        <h2 class="mt-4"><i class="far fa-clipboard"></i><?php echo ' '. $vTITULO; ?></h2>
            <hr>
                <h5>Carrera: <?php echo ' '. $vCARRERA['nombre']; ?></h5>
                <h5>Espacio Curricular: <?php echo ' '. $vMATERIA['nombre']; ?></h5>
                <h5>Fecha: <?php echo ' '. $vMESA['fecha']; ?></h5>
                <h5>Libro: <?php echo ' '. $vMESA['libro'] . ' Folio: '. $vMESA['folio']; ?></h5>
            <hr>
            <div>
                <p>
                    <a href="<?php echo base_url(). '/carreras/mesas/'. $vMESA['id_carrera']; ?>" class="btn btn-primary"><i class="fa fa-undo-alt"></i> Volver</a>
                </p>
            </div>

            <div clases="form-group">
                <fieldset class="form-group border p-3" style="background-color: #f2f2f2">

                <form onsubmit="return validarFormulario(event)" method="POST" action="<?php echo base_url(); ?>/carreras/insertar_examen" autocomplete="off">

                    <input id="id_mesa" name="id_mesa" value="<?php echo $vMESA['id']; ?>" hidden/>
                    
                    <div clases="form-group">
                        <div class="row">
                            <div class="col-12 col-sm-1">
                                <label>ID</label>
                                <input class="form-control" id="id_persona" name="id_persona" value="0" readonly/>
                            </div>
                            <div class="col-12 col-sm-6">
                                <label>Seleccione Persona para agregar</label>
                                <input class="form-control" id="persona" name="persona" type="text" placeholder="Escribe parte del nombre" required />
                            </div>
                            <div class="col-12 col-sm-2">
                                <label>Nota</label>
                                <input class="form-control" id="nota" name="nota" type="number" value="" />
                            </div>
                            <div class="col-12 col-sm-3">
                                <label>Estado</label>       
                                <select class="form-control" id="estado" name="estado">
                                    <option value="APROBADO">APROBADO</option>
                                    <option value="DESAPROBADO">DESAPROBADO</option>
                                    <option value="AUSENTE">AUSENTE</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Agregar Exámen</button>
                
                </form>

                </fieldset>

            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table table-bordered" id="dataTable_simple" width="100%" cellspacing="0" data-order='[[ 1, "asc" ]]'>
                        <thead class="thead-dark">
                                <tr>
                                    <th>Id Exámen</th>
                                    <th>Alumno</th>
                                    <th>DNI</th>
                                    <th>Estado</th>
                                    <th>Nota</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($vDATOS as $dato) { ?>
                                    <tr>
                                        <td><?php echo $dato['id'] ?></td>
                                        <td><?php echo $dato['user_apellido'] . ' ' . $dato['user_nombres']?></td>
                                        <td><?php echo $dato['user_dni'] ?></td>
                                        <td><?php echo $dato['estado'] ?></td>
                                        <td><?php echo $dato['nota'] ?></td>
                                        
                                        <td>
                                        <a href="<?php echo base_url(). '/carreras/editar_examen/'. $dato['id']; ?>" class="btn btn-success btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="#" data-href="<?php echo base_url(). '/carreras/eliminar_examen/'. $dato['id']; ?>" data-toggle="modal" data-target="#modal-confirma" data-placement="top" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal -->
    <div class="modal fade" id="modal-confirma" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="examplemodal">Eliminar Exámen</h5>
                </div>
                <div class="modal-body">
                    El siguiente proceso eliminará el Exámen de la Mesa!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-danger btn-ok">Aceptar</a>
                </div>
            </div>
        </div>
    </div>


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