<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">

            <div class="jumbotron mt-3 p-4">
                <h2>BIENVENIDOS</h2>
                <h4>Sistema de Gestión - Dirección de Educación Superior</h4>
                <hr style="height:1px;border-width:0;color:#dbdbdb;background-color:#dbdbdb">
                <h5 style="color:#008575"><?php echo $vDATOS['user_apellido'] . ' ' . $vDATOS['user_nombres']; ?></h5>
<!--                 <h5 style="color:#008575"><?php echo 'Sesión ' . $_SESSION['user_ies'] . ' - Rol ' . $_SESSION['user_rol']; ?></h5> -->
            </div>
            
            <!-- OPCIONES EN COMÚN PARA TODOS LOS USUARIOS -->
            <div class="row">
                <div class="col-12 col-lg-3 mb-4">
                    <div class="card text-white bg-primary">
                        <div class="card-body">
                            <h4><i class="fas fa-user"></i></h4>
                        </div>
                        <a class="card-footer text-white" href="<?php echo base_url(); ?>/personas/perfil">Datos Personales</a>
                    </div>
                </div>
                <div class="col-12 col-lg-3 mb-4">
                    <div class="card text-white bg-danger">
                        <div class="card-body">
                            <h4><i class="fas fa-key"></i></h4>
                        </div>
                        <a class="card-footer text-white" href="<?php echo base_url(); ?>/personas/password">Cambiar Contraseña</a>
                    </div>
                </div>
            </div>

            <!-- BEDEL INSTITUTOS -->
            <?php if($vIES<>NULL) { ?>
                <h5 style="color:#008575"><?php echo 'MENU BEDEL';?></h5>
                <hr>
                <div class="row">
                    <?php foreach($vIES as $dato) { ?>
                        <div class="col-12 col-lg-3 mb-4">
                            <div class="card text-white bg-info">
                                <div class="card-body">
                                    <h4><i class="fas fa-university"></i></h4>
                                </div>
                                <a class="card-footer text-white" href="<?php echo base_url(). '/gestion/index/'. base64_encode(openssl_encrypt($dato['id'],'AES-128-ECB',$vDATOS['id'])); ?>">Gestión IES <?php echo $dato['numero']; ?></a>
                            </div>
                        </div>
                    <?php } ?>                        
                </div>
            <?php } ?>

        </div>

    </main>

