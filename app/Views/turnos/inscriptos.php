<div id="layoutSidenav_content">

    <main>
        <div class="container-fluid">
            <h2 class="mt-4"><i class="fas fa-users"></i><?php echo ' '. $vTITULO . ' | ' . '<font color="blue">' . $vTURNO['descripcion'] . '</font>'; ?></h2>
            <hr>
            <div>
                <p>
                    <a href="<?php echo base_url(); ?>/turnos" class="btn btn-primary"><i class="fa fa-undo-alt"></i> Volver</a>
                </p>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table table-bordered" id="dataTable" width="100%" cellspacing="0" data-order='[[0,"asc"]]'>
                            <thead class="thead-dark">
                                <tr>
                                    <th>Apellido y Nombre</th>
                                    <th>DNI</th>
                                    <th>Materia</th>
                                    <th>Carrera</th>
                                    <th>Resolución</th>
                                    <th>Inscripción</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($vDATOS as $dato) { ?>
                                    <tr>
                                        <td><?php echo $dato['user_apellido'] . ' ' . $dato['user_nombres'] ?></td>
                                        <td><?php echo $dato['user_dni'] ?></td>
                                        <td><?php echo $dato['nombre'] ?></td>
                                        <td><?php echo $dato['vCARRERA'] ?></td>
                                        <td><?php echo $dato['resolucion'] ?></td>
                                        <td ><?php echo $dato['created_at'] ?></td>
                                        <td>
                                        <?php
                                        if($rol == "1") { ?>
                                        <a href="<?php echo base_url(). '/turnos/inscriptos_eliminar/'. $dato['id']; ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                        <?php } ?>
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