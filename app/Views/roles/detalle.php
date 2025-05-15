<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
        <h2 class="mt-4"><i class="fas fa-users-cog"></i><?php echo ' '. $vTITULO; ?></h2>
            <hr>
            <div>
                <p>

                </p>
            </div>

            <form method="POST" action="<?php echo base_url() . '/roles/guardar_permisos'; ?>">
                <input type="hidden" name="id_rol" value="<?php echo $vID_ROL; ?>" />

                <div class="card mb-4">
                    <div class="card-body">

                        <?php foreach($vDATOS as $dato) { ?>
                            <input type="checkbox" value="<?php echo $dato['id'];?>" name="permisos[]" <?php 
                            if(isset($vPERMISOS_ROL[$dato['id']])) { echo 'checked'; } ?> /> <label><?php echo $dato['descripcion']; ?> </label>
                            <br/>
                        <?php } ?>

                    </div>
                </div>

                <fieldset class="form-group border p-3" style="background-color: #e9ecef">
                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Guardar</button>
                </fieldset>

            </form>
        </div>
    </main>