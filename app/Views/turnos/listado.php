<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
        <h2 class="mt-4"><i class="fas fa-chalkboard"></i><?php echo ' '. $vTITULO; ?></h2>
            <hr>
            <div>
                <p>
                    <a href="<?php echo base_url(). '/gestion/index/'. base64_encode(openssl_encrypt($_SESSION['user_ies'],'AES-128-ECB',$_SESSION['user_id']));; ?>" class="btn btn-primary"><i class="fas fa-university"></i> Tablero IES</a>
                </p>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table table-bordered" id="dataTable_mensajes" width="100%" cellspacing="0" data-order='[[0,"desc"]]'>
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Descripción</th>
                                    <th>Estado</th>
                                    <th>Observaciones</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($vDATOS as $dato) { ?>
                                    <tr>
                                        <td ><?php echo $dato['id'] ?></td>
                                        <td><?php echo $dato['descripcion'] ?></td>
                                        <td> <?php
                                            if($dato['estado'] == "ACTIVO") {
                                            echo '<span style="color:green">' . $dato['estado'] . '</span>';
                                            } elseif ($dato['estado'] == "INACTIVO"){
                                            echo '<span style="color:red">' . $dato['estado'] . '</span>';
                                            }
                                        ?></td>
                                        <td><?php echo $dato['observaciones'] ?></td>
                                        
                                        <td>
                                        <a href="<?php echo base_url(). '/turnos/inscriptos/'. $dato['id']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-users"></i></a>
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