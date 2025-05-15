<script>
function validarCantidad(input) {
    if (input.value > 10) {
        input.value = 10;
    }
    if (input.value < 0) {
        input.value = 0;
    }    
}
</script>

<div id="layoutSidenav_content">

    <main>
        <div class="container-fluid">

            <h2 class="mt-4"><i class="fas fa-list"></i><?php echo ' '. $vTITULO; ?></h1>
            <hr>
                <h5>Carrera: <?php echo '<span style="color:blue">'. $vCARRERA['nombre'] . ' - Res. ' . $vCARRERA['resolucion'] . '</span>'; ?></h5>
                <h5>Nombre: <?php echo " ". $vPERSONA['user_apellido'] . ' ' . $vPERSONA['user_nombres']; ?></h5>
                <h5>DNI: <?php echo " ". $vPERSONA['user_dni']; ?></h5>
            <hr>
            <form method="POST" action="<?php echo base_url(); ?>/alumnos/actualizar_condiciones_masiva" autocomplete="off">
            <div>
                <p>
                <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Guardar</button>                    
                <a href="<?php echo base_url(); ?>/alumnos/index" class="btn btn-danger"><i class="fa fa-times"></i> Cancelar</a>
                </p>
            </div>

            <div class="card mb-4">
                <div class="card-body">

                    <fieldset class="form-group border p-3" style="background-color: #f2f2f2">
                        <div class="row">
                            <div class="col-12 col-sm-5">
                                <label>Espacio Curricular</label>
                            </div>
                            <div class="col-12 col-sm-1">
                                <label>Nota</label>
                            </div>
                            <div class="col-12 col-sm-2">
                                <label>Fecha Aprobado</label>
                            </div>
                            <div class="col-12 col-sm-2">
                                <label>Estado</label>
                            </div>
                            <div class="col-12 col-sm-1">
                                <label>Libro</label>
                            </div>
                            <div class="col-12 col-sm-1">
                                <label>Folio</label>
                            </div>                                                        
                        </div>

                        <?php for($i = 0; $i < count($vDATOS); $i++){ ?>
                            <div class="row mt-2">
                                <input class="form-control" name="espacios_id_condicion[]" type="hidden" value="<?php echo esc($vDATOS[$i]['id']); ?>" readonly/>
                                <div class="col-12 col-sm-5">
                                    <input class="form-control" name="espacios_nombre[]" type="text" value="<?php echo $vDATOS[$i]['nombre']; ?>" readonly/>
                                </div>
                                <div class="col-12 col-sm-1">
                                    <input class="form-control text-center" id="espacios_nota[]" name="espacios_nota[]" type="number" min="0" max="10" oninput="validarCantidad(this)" value="<?= ($vDATOS[$i]['nota'] == 0) ? '' : esc($vDATOS[$i]['nota']) ?>" />
                                </div>
                                <div class="col-12 col-sm-2">
                                    <input class="form-control" name="espacios_fecha_aprobado[]" type="date" value="<?php echo $vDATOS[$i]['fecha_aprobado']; ?>" />
                                </div>                                            
                                <div class="col-12 col-sm-2">
                                    <select class="form-control" name="espacios_estado[]">
                                        <?php foreach($vESTADO as $dato){ ?>
                                        <option value="<?php echo $dato['id']; ?>" <?php if($vDATOS[$i]['estado']==$dato['id']){echo 'selected'; } ?>><?php echo $dato['nombre']; ?></option><?php } ?>
                                    </select>                        
                                </div>                                            
                                <div class="col-12 col-sm-1">
                                    <input class="form-control text-center" id="espacios_libro[]" name="espacios_libro[]" value="<?php echo $vDATOS[$i]['libro']; ?>" />
                                </div>
                                <div class="col-12 col-sm-1">
                                    <input class="form-control text-center" id="espacios_folio[]" name="espacios_folio[]" value="<?php echo $vDATOS[$i]['folio']; ?>" />
                                </div>
                            </div>
                        <?php } ?>
                    </fieldset>

                </div>
            </div>
            </form>

        </div>
    </main>
