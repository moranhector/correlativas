
<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                    <h2 class="mt-4"><i class="fas fa-book"></i><?php echo ' '. $vTITULO; ?></h2>
                        <hr>
                            <h5>ID Carrera: <?php echo ' '. $vCARRERA['id']; ?></h5>
                            <h5>Nombre: <?php echo ' '. $vCARRERA['nombre']; ?></h5>
                            <h5>Resolución: <?php echo ' '. $vCARRERA['resolucion']; ?></h5>
                        <hr>
                        <div>
                            <p>
                                <a href="<?php echo base_url(); ?>/gestion/carreras_ies" class="btn btn-primary"><i class="fa fa-undo-alt"></i> Volver</a>
                            </p>
                        </div>

                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="thead-dark">
                                            <tr>
                                                <th>Id</th>
                                                <th>Nombre</th>
                                                <th>Año</th>
                                                <th>Regimen</th>
                                                <th>Cuatrimestre</th>
                                                <th>Hs Sem</th>                                                
                                                <th>Hs Anu</th>
                                                <th>Formato</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($vDATOS as $dato) { ?>
                                                <tr>
                                                    <td><?php echo $dato['id'] ?></td>
                                                    <td><?php echo $dato['nombre'] ?></td>
                                                    <td><?php echo $dato['ano'] ?></td>
                                                    <td><?php echo $dato['regimen'] ?></td>
                                                    <td><?php echo $dato['cuatrimestre'] ?></td>
                                                    <td><?php echo $dato['horas'] ?></td>
                                                    <td><?php echo $dato['horasanuales'] ?></td>
                                                    <td><?php echo $dato['formato'] ?></td>
                                                    
                                                    <td>
                                                    <a href="<?php echo base_url(). '/carreras/editar_materia/'. $dato['id']; ?>" class="btn btn-success btn-sm"  title="Editar"><i class="fas fa-pencil-alt"></i></a>
                                                    <a href="<?php echo base_url(). '/carreras/alumnos_materia/'. $dato['id']; ?>" class="btn btn-secondary btn-sm"  title="Alumnos"><i class="fas fa-users"></i></a>
                                                    <!-- //HAM -->
                                                    <a href="<?php echo base_url(). '/carreras/correlativas_materia/'. $dato['id']; ?>" class="btn btn-info btn-sm" title="Correlativas"><i class="fas fa-link"></i></a>                                                    
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
