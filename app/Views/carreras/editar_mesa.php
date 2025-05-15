<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
        <h2 class="mt-4"><i class="fas fa-edit"></i><?php echo ' '. $vTITULO; ?></h2>
            <hr>
                <h5>ID Carrera: <?php echo ' '. $vDATOS['id_carrera']; ?></h5>
                <h5>Nombre: <?php echo ' '. $vDATOS['vCARRERA']; ?></h5>
                <h5>Resolución: <?php echo ' '. $vDATOS['resolucion']; ?></h5>
            <hr>

            <form method="POST" action="<?php echo base_url(); ?>/carreras/actualizar_mesa" autocomplete="off">
            <input type="hidden" id="id" name="id" value="<?php echo $vDATOS['id']; ?>" />

            <div clases="form-group">
                <fieldset class="form-group border p-3" style="background-color: #f2f2f2">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label>Materia</label>
                            <select class="form-control" id="id_materia" name="id_materia">
                                <?php foreach($vMATERIAS as $row){ ?>
                                        <option value="<?php echo $row['id']; ?>" <?php if($vDATOS['id_materia']==$row['id']){echo 'selected'; } ?>> <?php echo $row['id'] . ' - ' .$row['nombre']; ?> </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-12 col-sm-2">
                            <label>Fecha</label>       
                            <input class="form-control" id="fecha" name="fecha" type="date" value="<?php echo $vDATOS['fecha']; ?>" required />
                        </div>
                        <div class="col-12 col-sm-2">
                            <label>Libro</label>       
                            <input class="form-control" id="libro" name="libro" type="number" value="<?php echo $vDATOS['libro']; ?>" />
                        </div>
                        <div class="col-12 col-sm-2">
                            <label>Folio</label>       
                            <input class="form-control" id="folio" name="folio" type="number" value="<?php echo $vDATOS['folio']; ?>" />
                        </div>                        
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-1 mt-2">
                            <label>ID</label>
                            <input class="form-control" id="id_presidente" name="id_presidente" value="<?php echo $vDATOS['presidente']; ?>" readonly/>
                        </div>
                        <div class="col-12 col-sm-3 mt-2">
                            <label>Presidente</label>       
                            <input class="form-control" id="presidente" name="presidente" placeholder="Escribe parte del nombre" autocomplete="off"/>
                        </div>
                        <div class="col-12 col-sm-1 mt-2">
                            <label>ID</label>
                            <input class="form-control" id="id_vocal1" name="id_vocal1" value="<?php echo $vDATOS['vocal1']; ?>" readonly/>
                        </div>                        
                        <div class="col-12 col-sm-3 mt-2">
                            <label>Vocal 1</label>       
                            <input class="form-control" id="vocal1" name="vocal1" placeholder="Escribe parte del nombre" autocomplete="off"/>                            
                        </div>
                        <div class="col-12 col-sm-1 mt-2">
                            <label>ID</label>
                            <input class="form-control" id="id_vocal2" name="id_vocal2" value="<?php echo $vDATOS['vocal2']; ?>" readonly/>
                        </div>
                        <div class="col-12 col-sm-3 mt-2">
                            <label>Vocal 2</label>       
                            <input class="form-control" id="vocal2" name="vocal2" placeholder="Escribe parte del nombre" autocomplete="off"/>                                                        
                        </div>
                    </div>
                </fieldset>

                <fieldset class="form-group border p-3" style="background-color: #e9ecef">
                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Guardar</button>
                    <a href="<?php echo base_url(). '/carreras/mesas_carrera/'. $vDATOS['id_carrera']; ?>" class="btn btn-primary"><i class="fa fa-undo-alt"></i> Volver</a>
                </fieldset>

            </div>        
            </form>

        </div>
    </main>


<script>    
    //Funcion de busqueda de persona por APELLIDO en PRESIDENTE Y VOCALES
    $(function(){
        $("#presidente").autocomplete({
            source: "<?php echo base_url(); ?>/carreras/autocompleteData",
            minLength: 3,
            select: function(event, ui){
                event.preventDefault();
                $("#id_presidente").val(ui.item.id);
                $("#presidente").val(ui.item.value);
            }
        });
    });
    $(function(){
        $("#vocal1").autocomplete({
            source: "<?php echo base_url(); ?>/carreras/autocompleteData",
            minLength: 3,
            select: function(event, ui){
                event.preventDefault();
                $("#id_vocal1").val(ui.item.id);
                $("#vocal1").val(ui.item.value);
            }
        });
    });
    $(function(){
        $("#vocal2").autocomplete({
            source: "<?php echo base_url(); ?>/carreras/autocompleteData",
            minLength: 3,
            select: function(event, ui){
                event.preventDefault();
                $("#id_vocal2").val(ui.item.id);
                $("#vocal2").val(ui.item.value);
            }
        });
    });        
</script>