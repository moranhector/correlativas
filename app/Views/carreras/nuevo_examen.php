<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
        <h1 class="mt-4"><i class="fas fa-plus"></i><?php echo ' '. $vTITULO; ?></h1>
            <hr>
                <h4>Fecha: <?php echo ' '. $vMESA['fecha']; ?></h4>
                <h4>Libro: <?php echo ' '. $vMESA['libro']; ?></h4>
                <h4>Folio: <?php echo ' '. $vMESA['folio']; ?></h4>
            <hr>
            <form method="POST" action="<?php echo base_url(); ?>/carreras/insertar_examen" autocomplete="off">
            <input id="mesa" name="mesa" value="<?php echo $vMESA['id']; ?>" hidden/>
            
            <div clases="form-group">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <label>Alumno</label>       
                        <select class="form-control" id="alumno" name="alumno">
                            <?php foreach($cursantes as $cursante){ ?>
                            <option value="<?php echo $cursante['alumno_id']; ?>"><?php echo $cursante['A'] . ' | DNI: ' . $cursante['B']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-12 col-sm-3">
                        <label>Nota</label>
                        <input class="form-control" id="nota" name="nota" type="number" value="" />
                    </div>
                    <div class="col-12 col-sm-3">
                        <label>Estado</label>       
                        <select class="form-control" id="estado" name="estado">
                            <option value="APROBADO">APROBADO</option>
                            <option value="DESAPROBADO">DESAPROBADO</option>
                            <option value="AUSENTE">AUSENTE</option>
                        </select>
                    </div>
                    <div class="col-12 col-sm-12">
                        <label>Observaciones</label>       
                        <input class="form-control" id="observaciones" name="observaciones" value="" />
                    </div>
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="<?php echo base_url(). '/carreras/examenes_mesa/'. $vMESA['id']; ?>" class="btn btn-primary"><i class="fa fa-undo-alt"></i> Volver</a>
        
        </form>

        </div>
    </main>