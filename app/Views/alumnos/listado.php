
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h2 class="mt-4"><i class="fas fa-users"></i><?php echo ' '. $vTITULO . ' | <span style="color:blue">'. 'IES ' . $vIES['numero'] . '</span>'; ?></h2>
                        <hr>
                        <div>
                            <p>
                                <a href="<?php echo base_url(). '/gestion/index/'. base64_encode(openssl_encrypt($vIES['id'],'AES-128-ECB',$_SESSION['user_id']));; ?>" class="btn btn-primary"><i class="fas fa-university"></i> Tablero IES</a>
                            </p>
                        </div>

                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table table-bordered" id="dataTable" width="100%" cellspacing="0" data-order='[[1,"asc"]]'>
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Id</th>
                                                <th>Apellido y Nombre</th>
                                                <th>DNI</th>
                                                <th>E-Mail</th>
                                                <th>Teléfono</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($vDATOS as $dato) { ?>
                                                <tr>
                                                    <td><?php echo $dato['id_persona'] ?></td>
                                                    <td><?php echo $dato['user_apellido'] . ' ' . $dato['user_nombres'] ?></td>
                                                    <td><?php echo $dato['user_dni'] ?></td>
                                                    <td><?php echo $dato['user_email'] ?></td>
                                                    <td><?php echo $dato['user_telefono'] ?></td>
                                                    
                                                    <td>
                                                    <a href="<?php echo base_url(). '/alumnos/ver/'. base64_encode(openssl_encrypt($dato['id_persona'],'AES-128-ECB',$_SESSION['user_id'])); ?>" class="btn btn-info btn-sm"><i class="fas fa-search"></i></a>
                                                    <a href="<?php echo base_url(). '/alumnos/estado_academico/'. $dato['id_persona']; ?>" class="btn btn-secondary btn-sm"><i class="fas fa-graduation-cap"></i></a>
                                                    <a href="<?php echo base_url(). '/alumnos/examenes/'. $dato['id_persona']; ?>" class="btn btn-warning btn-sm"><i class="fas fa-list"></i></a>
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