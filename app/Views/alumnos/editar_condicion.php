<div id="layoutSidenav_content">

    <main>
        <div class="container-fluid">
        <h2 class="mt-4"><i class="fas fa-edit"></i><?php echo ' '. $vTITULO; ?></h2>
            <hr>

            <form method="POST" action="<?php echo base_url(); ?>/alumnos/actualizar_condicion" autocomplete="off">
            <input type="hidden" id="id" name="id" value="<?php echo $vDATOS['id']; ?>" />

            <div clases="form-group">
                <fieldset class="form-group border p-3" style="background-color: #f2f2f2">
                    <div class="row">
                        <div class="col-12 col-sm-1">
                            <label>Id</label>       
                            <input class="form-control" id="id_persona" name="id_persona" value="<?php echo $vDATOS['id_persona']; ?>" readonly />
                        </div>
                        <div class="col-12 col-sm-6">
                            <label>Apellido y Nombre</label>
                            <input class="form-control" id="nombre" name="nombre" value="<?php echo $vDATOS['user_apellido'] . ', ' . $vDATOS['user_nombres']; ?>" readonly />
                        </div>
                        <div class="col-12 col-sm-2">
                            <label>DNI</label>
                            <input class="form-control" id="dni" name="dni" value="<?php echo $vDATOS['user_dni']; ?>" readonly />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-1 mt-2">
                            <label>Id</label>       
                            <input class="form-control" id="id_carrera" name="id_carrera" value="<?php echo $vDATOS['id_carrera']; ?>" readonly />
                        </div>
                        <div class="col-12 col-sm-6 mt-2">
                            <label>Carrera</label>       
                            <input class="form-control" id="carrera" name="carrera" value="<?php echo $vDATOS['nombre']; ?>" readonly />
                        </div>
                        <div class="col-12 col-sm-2 mt-2">
                            <label>Resolución</label>
                            <input class="form-control" id="resolucion" name="resolucion" value="<?php echo $vDATOS['resolucion']; ?>" readonly />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-1 mt-2">
                            <label>Id</label>       
                            <input class="form-control" id="id_materia" name="id_materia" value="<?php echo $vDATOS['id_materia']; ?>" readonly />
                        </div>
                        <div class="col-12 col-sm-6 mt-2">
                            <label>Materia</label>       
                            <input class="form-control" id="materia" name="materia" value="<?php echo $vDATOS['vMATERIA']; ?>" readonly />
                        </div>
                        <div class="col-12 col-sm-1 mt-2">
                            <label>Nota</label>       
                            <input class="form-control" id="nota" name="nota" value="<?php echo $vDATOS['nota']; ?>" />
                        </div>
                        <div class="col-12 col-sm-2 mt-2">
                            <label>Estado</label>
                            <select class="form-control" id="estado" name="estado">
                                <?php foreach($vESTADO as $dato){ ?>
                                <option value="<?php echo $dato['id']; ?>" <?php if($vDATOS['estado']==$dato['id']){echo 'selected'; } ?>><?php echo $dato['nombre']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-12 col-sm-2 mt-2">
                            <label>Fecha Aprobado</label>       
                            <input class="form-control" id="fecha" name="fecha" type="date" value="<?php echo $vDATOS['fecha_aprobado']; ?>" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-8 mt-2">
                            <label>Instituto Previo - Equivalencias / Pase</label>       
                            <select class="form-control" name="equivalencia">
                                <option value="0">Seleccione un Instituto...</option>
                                <?php foreach($vINSTITUTOS as $dato){ ?>
                                    <option value="<?php echo $dato['id']; ?>" <?php if($vDATOS['equivalencia']==$dato['id']){echo 'selected'; } ?>><?php echo $dato['numero'] .' - '. $dato['nombre']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-12 col-sm-2 mt-2">
                            <label>Libro</label>       
                            <input class="form-control" name="libro" value="<?php echo $vDATOS['libro']; ?>" />
                        </div>
                        <div class="col-12 col-sm-2 mt-2">
                            <label>Folio</label>       
                            <input class="form-control" name="folio" value="<?php echo $vDATOS['folio']; ?>" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-12 mt-2">
                            <label>Observaciones</label>       
                            <input class="form-control" name="observaciones" value="<?php echo $vDATOS['observaciones']; ?>" />
                        </div>
                    </div>
                </fieldset>

                <fieldset class="form-group border p-3" style="background-color: #e9ecef">
                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Guardar</button>
                    <a href="<?php echo base_url(). '/alumnos/condicion_carrera/'. $vDATOS['id_carrera'] . '/' . $vDATOS['id_persona']; ?>" class="btn btn-primary"><i class="fas fa-undo"></i> Volver</a>
                </fieldset>
            </div>
        
        </form>

        </div>
    </main>