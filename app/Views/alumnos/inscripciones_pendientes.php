<script>
    $(document).ready(function () {
        $('#AceptarSeleccionados').click(function () {
            let seleccionados = [];

            // Recorremos cada checkbox seleccionado y obtenemos su valor (ID)
            $('.fila-check:checked').each(function () {
                seleccionados.push($(this).val());
            });

            if (seleccionados.length === 0) {
                alert("No has seleccionado ningún registro.");
                return;
            }

            // Enviar datos al backend usando AJAX
            $.ajax({
                url: '<?php echo base_url(); ?>/alumnos/procesarSeleccion_Aceptar', // Ruta en CodeIgniter
                type: "POST",
                dataType: "json",
                data: { 
                    seleccionados: seleccionados 
                },

                success: function (respuesta) {
                    alert(respuesta.mensaje);
                    location.reload(); // Recargar la pagina                    
                },
                error: function () {
                    alert("Error al enviar los datos.");
                }
            });
        });
    });

    $(document).ready(function () {
    $('#RechazarSeleccionados').click(function () {
        let seleccionados = [];

        // Recorremos cada checkbox seleccionado y obtenemos su valor (ID)
        $('.fila-check:checked').each(function () {
            seleccionados.push($(this).val());
        });

        if (seleccionados.length === 0) {
            alert("No has seleccionado ningún registro.");
            return;
        }

        // Enviar datos al backend usando AJAX
        $.ajax({
            url: '<?php echo base_url(); ?>/alumnos/procesarSeleccion_Rechazar', // Ruta en CodeIgniter
            type: 'POST',
            dataType: 'json',
            data: { seleccionados: seleccionados },

            success: function (respuesta) {
                alert(respuesta.mensaje);
                location.reload(); // Recargar la pagina
            },
            error: function () {
                alert("Error al enviar los datos.");
            }

        });
    });
});    
</script>

<div id="layoutSidenav_content">

    <div class="alert alert-warning d-flex align-items-center" role="alert">
        <div>
        <i class="fas fa-exclamation-triangle"></i> Se limitaron los resultados a 15000 registros para dar rapidez a la carga.
        </div>
    </div>

    <main>
        <div class="container-fluid">
            <h2 class="mt-2"><i class="fas fa-graduation-cap"></i><?php echo ' '. $vTITULO; ?></h2>
            <hr>
            <div>
                <p>
                    <button onclick="history.back()" class="btn btn-primary"><i class="fa fa-undo-alt"></i> Volver</button>
                    <button id="AceptarSeleccionados" class="btn btn-success"><i class="fa fa-check"></i> Aceptar Seleccionados</button>
                    <button id="RechazarSeleccionados" class="btn btn-danger"><i class="fa fa-times"></i> Rechazar Seleccionados</button>
                </p>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table table-bordered" id="dataTable" width="100%" cellspacing="0" data-order='[[2,"asc"]]'>
                            <thead class="thead-dark">
                                <tr>
                                    <th></th>
                                    <th>Id</th>
                                    <th>Apellido y Nombre</th>
                                    <th>DNI</th>
                                    <th>Nombre de Carrera</th>
                                    <th>Resolución</th>
                                    <th>Espacio Curricular</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($vDATOS as $dato) { ?>
                                    <tr>
                                        <td><input type="checkbox" class="fila-check" value="<?php echo $dato['id'] ?>"></td>
                                        <td><?php echo $dato['id'] ?></td>
                                        <td><?php echo $dato['user_apellido'] . ' ' . $dato['user_nombres']?></td>
                                        <td><?php echo $dato['user_dni'] ?></td>
                                        <td><?php echo $dato['nombre'] ?></td>
                                        <td><?php echo $dato['resolucion'] ?></td>
                                        <td><?php echo $dato['vMATERIA'] ?></td>
                                        <td> <?php
                                            if($dato['estado'] == "PENDIENTE") {
                                            echo '<span style="color:blue">' . $dato['estado'] . '</span>';
                                            } elseif ($dato['estado'] == "RECHAZADO"){
                                            echo '<span style="color:red">' . $dato['estado'] . '</span>';
                                            }
                                        ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
