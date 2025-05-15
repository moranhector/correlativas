
<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h2 class="mt-4"><i class="fas fa-graduation-cap"></i><?php echo ' '. $vTITULO; ?></h2>
                        <hr>
                            <h5>Nombre: <?php echo " ". $vPERSONA['user_apellido'] . ' ' . $vPERSONA['user_nombres']; ?></h5>
                            <h5>DNI: <?php echo " ". $vPERSONA['user_dni']; ?></h5>
                        <hr>  
                        <div>
                            <p>
                                <button onclick="history.back()" class="btn btn-primary"><i class="fa fa-undo-alt"></i> Volver</button>
                            </p>
                        </div>

                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table table-bordered" width="100%" cellspacing="0">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>ID</th>
                                                <th>Carrera</th>
                                                <th>Resolución</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($vDATOS as $dato) { ?>
                                                <tr>
                                                    <td><?php echo $dato['id_carrera'] ?></td>
                                                    <td><?php echo $dato['nombre'] ?></td>
                                                    <td><?php echo $dato['resolucion'] ?></td>
                                                    
                                                    <td>
                                                    <a href="<?php echo base_url(). '/alumnos/condicion_carrera/'. $dato['id_carrera'] . '/' . $dato['id_persona']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-list"></i></a>
                                                    <a href="<?php echo base_url(). '/alumnos/analiticoPDF/'. $dato['id_carrera'] . '/' . $dato['id_persona']; ?>" target="_blank" class="btn btn-secondary btn-sm"><i class="fas fa-file"></i></a>
                                                    <a href="<?php echo base_url(). '/alumnos/cambio_instituto/'. $dato['id_carrera'] . '/' . $dato['id_persona'] . '/' . $dato['id_instituto']; ?>" title="Cambio de Instituto" class="btn btn-success btn-sm"><i class="fas fa-arrow-right"></i></a>
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
