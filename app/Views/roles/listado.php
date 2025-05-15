<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
        <h2 class="mt-4"><i class="fas fa-users-cog"></i><?php echo ' '. $vTITULO; ?></h2>
            <hr>
            <div>
                <p>

                </p>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table table-bordered" id="dataTable" width="100%" cellspacing="0" data-order='[[ 1, "DESC" ]]'>
                        <thead class="thead-dark">
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($vDATOS as $dato) { ?>
                                    <tr>
                                        <td><?php echo $dato['id'] ?></td>
                                        <td><?php echo $dato['nombre'] ?></td>
                                        <td><?php echo $dato['descripcion'] ?></td>
                                        
                                        <td>
                                        <a href="<?php echo base_url(). '/roles/detalle/'. $dato['id']; ?>" class="btn btn-success btn-sm"><i class="fas fa-pencil-alt"></i></a>
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