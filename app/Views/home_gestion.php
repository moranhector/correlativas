<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">

            <div class="jumbotron mt-3 p-4">
                <h2>SISTEMA DE GESTIÓN INSTITUCIONAL</h2>
                <h4><?php echo $vDATOS['numero'] . ' - ' . $vDATOS['nombre']; ?></h4>
                <hr style="height:1px;border-width:0;color:#dbdbdb;background-color:#dbdbdb">
<!--                 <h5 style="color:#008575"><?php echo 'Rol ' . $_SESSION['user_rol']; ?></h5> -->
            </div>
            
            <div class="row">
                <div class="col-12 col-lg-3 mb-4">
                    <div class="card text-white bg-success">
                        <div class="card-body">
                            <h4><i class="fas fa-user-graduate"></i></h4>
                        </div>
                        <a class="card-footer text-white" href="<?php echo base_url(); ?>/alumnos/index">Lista General de Alumnos</a>
                    </div>
                </div>
                <div class="col-12 col-lg-3 mb-4">
                    <div class="card text-white bg-info">
                        <div class="card-body">
                            <h4><i class="fas fa-list"></i></h4>
                        </div>
                        <a class="card-footer text-white" href="<?php echo base_url(); ?>/gestion/carreras_ies">Lista de Carreras</a>
                    </div>
                </div>
                <div class="col-12 col-lg-3 mb-4">
                    <div class="card text-white bg-secondary">
                        <div class="card-body">
                            <h4><i class="fas fa-chalkboard"></i></h4>
                        </div>
                        <a class="card-footer text-white" href="<?php echo base_url(); ?>/turnos">Turnos de Mesas</a>
                    </div>
                </div>                
            </div>

            <div class="row">
                <div class="col-12 col-lg-3 mb-4">
                    <div class="card text-white bg-secondary">
                        <div class="card-body">
                            <h4><i class="fas fa-user"></i></h4>
                        </div>
                        <a class="card-footer text-white" href="<?php echo base_url(); ?>/alumnos/inscripciones_pendientes">Inscripciones Pendientes</a>
                    </div>
                </div>
                <div class="col-12 col-lg-3 mb-4">
                    <div class="card text-white bg-danger">
                        <div class="card-body">
                            <h4><i class="fas fa-times"></i></h4>
                        </div>
                        <a class="card-footer text-white" href="<?php echo base_url(); ?>/alumnos/inscripciones_rechazadas">Inscripciones Rechazadas</a>
                    </div>
                </div>              
            </div>

        </div>

    </main>

