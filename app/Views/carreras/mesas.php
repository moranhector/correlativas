<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
        <h2 class="mt-4"><i class="fas fa-chalkboard"></i><?php echo ' '. $vTITULO; ?></h2>
            <hr>
            <div>
                <p>
                    <a href="<?php echo base_url(). '/gestion/index/'. base64_encode(openssl_encrypt($_SESSION['user_ies'],'AES-128-ECB',$_SESSION['user_id']));; ?>" class="btn btn-primary"><i class="fas fa-university"></i> Tablero IES</a>
                    <a href="<?php echo base_url(); ?>/carreras/nueva_mesa" class="btn btn-info"><i class="fa fa-plus"></i> Nueva Mesa</a>
                </p>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table table-bordered" id="dataTable" width="100%" cellspacing="0" data-order='[[ 1, "DESC" ]]'>
                        <thead class="thead-dark">
                                <tr>
                                    <th>Id</th>
                                    <th>Fecha</th>
                                    <th>Carrera</th>
                                    <th>Materia</th>                                                
                                    <th>Libro</th>
                                    <th>Folio</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($vDATOS as $dato) { ?>
                                    <tr>
                                        <td><?php echo $dato['id'] ?></td>
                                        <td><?php echo $dato['fecha'] ?></td>
                                        <td><?php echo $dato['nombre'] ?></td>
                                        <td><?php echo $dato['vMATERIA'] ?></td>
                                        <td><?php echo $dato['libro'] ?></td>
                                        <td><?php echo $dato['folio'] ?></td>
                                        
                                        <td>
                                        <a href="<?php echo base_url(). '/carreras/editar_mesa/'. $dato['id']; ?>" class="btn btn-success btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="<?php echo base_url(). '/carreras/examenes_mesa/'. $dato['id']; ?>" class="btn btn-warning btn-sm"><i class="fas fa-list"></i></a>
                                        <a href="#" data-href="<?php echo base_url(). '/carreras/eliminar_mesa/'. $dato['id']; ?>" data-toggle="modal" data-target="#modal-confirma" data-placement="top" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
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
                    <h5 class="modal-title" id="eliminarlabel">Eliminar Mesa</h5>
                </div>
                <div class="modal-body">
                    El siguiente proceso eliminará la Mesa!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-danger btn-ok">Aceptar</a>
                </div>
            </div>
        </div>
    </div>