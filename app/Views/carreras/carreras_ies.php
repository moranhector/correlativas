
<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                    <h2 class="mt-4"><i class="fas fa-list"></i> <?php echo $vTITULO . ' | <span style="color:blue">'. 'IES ' . $vIES['numero'] .' - '. $vIES['nombre'] . '</span>'; ?></h2>
                        <hr>
                        <div>
                            <p>
                            <a href="<?php echo base_url(). '/gestion/index/'. base64_encode(openssl_encrypt($vIES['id'],'AES-128-ECB',$_SESSION['user_id']));; ?>" class="btn btn-primary"><i class="fas fa-university"></i> Tablero IES</a>
                            </p>
                        </div>

                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table table-bordered" id="dataTable_simple" width="100%" cellspacing="0" data-order='[[4,"asc"], [1, "asc"]]'>
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Id</th>
                                                <th>Nombre</th>
                                                <th>Resolución</th>
                                                <th>Nueva Cohorte</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($vDATOS as $dato) { ?>
                                                <tr>
                                                    <td><?php echo $dato['id'] ?></td>
                                                    <td><?php echo $dato['nombre'] ?></td>
                                                    <td><a href="<?php echo $dato['archivo']; ?>" target="_blank"><?php echo $dato['resolucion'] ?></a></td>
                                                    <td> <?php
                                                        if($dato['nueva_cohorte'] == "SI") {
                                                        echo '<span style="color:green">' . $dato['nueva_cohorte'] . '</span>';
                                                        } elseif ($dato['nueva_cohorte'] == "NO"){
                                                        echo '<span style="color:red">' . $dato['nueva_cohorte'] . '</span>';
                                                        }
                                                    ?></td>
                                                    <td> <?php
                                                        if($dato['estado'] == "ACTIVO") {
                                                        echo '<span style="color:green">' . $dato['estado'] . '</span>';
                                                        } elseif ($dato['estado'] == "INACTIVO"){
                                                        echo '<span style="color:red">' . $dato['estado'] . '</span>';
                                                        }
                                                    ?></td>
                                                    
                                                    <td>
                                                    <a href="<?php echo base_url(). '/carreras/materias/'. $dato['id']; ?>" class="btn btn-warning btn-sm"><i class="fas fa-book"></i></a>
                                                    <a href="<?php echo base_url(). '/carreras/mesas_carrera/'. $dato['id']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-list"></i></a>
                                                    <a href="<?php echo base_url(). '/carreras/alumnos_carrera/'. $dato['id']; ?>" class="btn btn-secondary btn-sm"><i class="fas fa-users"></i></a>
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
