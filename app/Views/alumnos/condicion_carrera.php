<div id="layoutSidenav_content">

    <main>
        <div class="container-fluid">

            <h2 class="mt-4"><i class="fas fa-list"></i><?php echo ' '. $vTITULO; ?></h1>
            <hr>
                <h5>Carrera: <?php echo '<span style="color:blue">'. $vCARRERA['nombre'] . ' - Res. ' . $vCARRERA['resolucion'] . '</span>'; ?></h5>
                <h5>Nombre: <?php echo " ". $vPERSONA['user_apellido'] . ' ' . $vPERSONA['user_nombres']; ?></h5>
                <h5>DNI: <?php echo " ". $vPERSONA['user_dni']; ?></h5>
            <hr>
            <div>
                <p>
                    <a href="<?php echo base_url(); ?>/alumnos/index" class="btn btn-secondary"><i class="fa fa-undo-alt"></i> Volver</a>
                    <a href="<?php echo base_url(). '/alumnos/condicion_carrera_masivo/'. $vCARRERA['id'] . '/' . $vPERSONA['id']; ?>" class="btn btn-warning"><i class="fa fa-pencil-alt"></i> Carga Masiva de Notas</a>
                </p>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table table-bordered" id="dataTable_simple" width="100%" cellspacing="0" data-order='[[2,"asc"], [1, "asc"]]'>
                            <thead class="thead-dark">
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Año</th>
                                    <th>Aplazos</th>
                                    <th>Nota</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($vDATOS as $dato) { ?>
                                    <tr>
                                        <td><?php echo $dato['id'] ?></td>
                                        <td><?php echo $dato['nombre'] ?></td>
                                        <td><?php echo $dato['ano'] ?></td>
                                        <td><?php echo $dato['aplazos'] ?></td>
                                        <td><?php echo $dato['nota'] ?></td>
                                        <td> <?php
                                            if($dato['vESTADO'] == "APROBADO") {
                                            echo '<span style="color:green">' . $dato['vESTADO'] . '</span>';
                                            } elseif ($dato['vESTADO'] == "BAJA"){
                                            echo '<span style="color:red">' . $dato['vESTADO'] . '</span>';
                                            } else {
                                            echo '<span style="color:blue">' . $dato['vESTADO'] . '</span>';
                                            }
                                        ?></td>                                        
                                        
                                        <td>
                                            <a href="<?php echo base_url(). '/alumnos/editar_condicion/'. $dato['id']; ?>" class="btn btn-success btn-sm"><i class="fas fa-pencil-alt"></i></a>
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
