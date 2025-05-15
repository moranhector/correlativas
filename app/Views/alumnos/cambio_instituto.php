
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">

        <h2 class="mt-4"><i class="fas fa-users"></i> <?php echo $vTITULO; ?></h2>
        <hr>
            <h5>Carrera: <?php echo '<span style="color:blue">'. $vCARRERA['nombre'] . ' - Res. ' . $vCARRERA['resolucion'] . '</span>'; ?></h5>
            <h5>Instituto Actual: <?php echo " ". $vINSTITUTO['numero'] . ' - ' . $vPERSONA['nombre']; ?></h5>
            <h5>Nombre: <?php echo " ". $vPERSONA['user_apellido'] . ', ' . $vPERSONA['user_nombres']; ?></h5>
            <h5>DNI: <?php echo " ". $vPERSONA['user_dni']; ?></h5>
        <hr>

            <form method="POST" action="<?php echo base_url() . '/alumnos/cambiar_de_instituto/'.$vPERSONA['id'].'/'.$vINSTITUTO['id'].'/' . $vCARRERA['id'] ?>" autocomplete="off">
                <div>
                    <p>
                        <!-- <button onclick="history.back()" class="btn btn-primary"><i class="fa fa-undo-alt"></i> Volver</button> -->
                        <a href="<?php echo base_url(). '/alumnos/estado_academico/'. $vPERSONA['id']; ?>" class="btn btn-primary"><i class="fa fa-undo-alt"></i> Volver</a>

                        <button type="submit" id="boton" class="btn btn-success"><i class="fas fa-plus"></i> Cambiar de Instituto</button>
                    </p>
                </div>

                <fieldset class="form-group border p-3" style="background-color: #f2f2f2">
                    <label><b>Instituto Destino</b></label>
                    <select class="col-12 form-control" id="id_instituto" name="id_instituto">
                        <?php foreach($vDATOS as $dato) {
                            echo '<option value="'. $dato['id_instituto'].'">' . $dato['numero'] . ' - ' . $dato['nombre'] . ' - ' . $dato['direccion'] . '</option>'; } 
                        ?>
                    </select>
                </fieldset>

                <input type="hidden" value="<?php echo $vPERSONA['id']; ?>" name="id_persona" id="id_persona"/>
                <input type="hidden" value="<?php echo $vINSTITUTO['id']; ?>" name="id_inst_anterior" id="id_inst_anterior"/>
                <input type="hidden" value="<?php echo $vCARRERA['id']; ?>" name="id_carrera" id="id_carrera"/>
                
            </form>
        </div>
    </main>
