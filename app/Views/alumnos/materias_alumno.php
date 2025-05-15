<div id="layoutSidenav_content">

    <main>
        <div class="container-fluid">
            <h2 class="mt-4"><?php echo $vTITULO; ?></h2>
            <hr>
                <h5>Nombre: <?php echo ' ' . $vALUMNO['user_apellido'] . ' ' . $vALUMNO['user_nombres']; ?></h5>
                <h5>ID Inscripción: <?php echo $vINSCRIPCION;?></h5>
            <hr>
            <div>
                <p>
                    <a href="<?php echo base_url(). '/alumnos/lectivo/' . $vALUMNO['id'];?>" class="btn btn-primary"><i class="fa fa-undo-alt"></i> Volver</a>
                </p>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Id Materia</th>
                                    <th>Nombre de Materia</th>
                                    <th>Estado</th>
                                    <th>Año</th>
                                    <th>Aplazos</th>
                                    <th>Fecha</th>
                                    <th>Institución</th>
                                    <th>Nota Final</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($vDATOS as $dato) { ?>
                                    <tr>
                                        <td><?php echo $dato['materia'] ?></td>
                                        <td><?php echo $dato['A'] ?></td>
                                        <td> <?php
                                            if($dato['estado'] == "REGULAR") {
                                            echo '<span style="color:green">' . $dato['estado'] . '</span>';
                                            } elseif ($dato['estado'] == "NOREGULAR"){
                                            echo '<span style="color:red">' . $dato['estado'] . '</span>';
                                            } else {
                                            echo '<span style="color:blue">' . $dato['estado'] . '</span>';
                                            }
                                        ?></td>
                                        <td><?php echo $dato['B'] ?></td>
                                        <td><?php echo $dato['aplazos'] ?></td>
                                        <td><?php echo $dato['fecha'] ?></td>
                                        <td><?php echo $dato['institucion'] ?></td>
                                        <td><?php echo $dato['nota'] ?></td>
                                        
                                        <td>
                                        <a href="<?php echo base_url(). '/alumnos/editar_materia/'. $vDATOS['id']; ?>" class="btn btn-success btn-sm"><i class="fas fa-pencil-alt"></i></a>
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
