<script>
    function validarFormulario(event) {
        var valor = document.getElementById("id_presidente").value;

        if (valor === "0" || valor.trim() === "") {
            alert("Debe seleccionar un docente como presidente de la mesa.");
            event.preventDefault(); // Evita que el formulario se envíe
            return false;
        }
        return true; // Permite el envío si la validación es correcta
    }
</script>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
        <h2 class="mt-4"><i class="fas fa-plus"></i><?php echo ' '. $vTITULO; ?></h2>
            
            <hr>
                <h5>ID Carrera: <?php echo ' '. $vCARRERA['id']; ?></h5>
                <h5>Nombre: <?php echo ' '. $vCARRERA['nombre']; ?></h5>
                <h5>Resolución: <?php echo ' '. $vCARRERA['resolucion']; ?></h5>
            <hr>

            <form onsubmit="return validarFormulario(event)" method="POST" action="<?php echo base_url(); ?>/carreras/insertar_mesa" autocomplete="off">
            <input id="id_carrera" name="id_carrera" value="<?php echo $vCARRERA['id']; ?>" hidden/>

            <div clases="form-group">
                <fieldset class="form-group border p-3" style="background-color: #f2f2f2">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label>Materia</label>
                            <select class="form-control" id="id_materia" name="id_materia">
                                <?php foreach($vMATERIAS as $materia){ ?>
                                    <option value="<?php echo $materia['id']; ?>"><?php echo $materia['nombre'] . ' - ' . $materia['ano'] . 'º Año'; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-12 col-sm-2">
                            <label>Fecha</label>
                            <input class="form-control" id="fecha" name="fecha" type="date" required />
                        </div>
                        <div class="col-12 col-sm-2">
                            <label>Libro</label>
                            <input class="form-control" id="libro" name="libro" type="number" />
                        </div>
                        <div class="col-12 col-sm-2">
                            <label>Folio</label>
                            <input class="form-control" id="folio" name="folio" type="number" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-1 mt-2">
                            <label>ID</label>
                            <input class="form-control" id="id_presidente" name="id_presidente" value="0" readonly/>
                        </div>
                        <div class="col-12 col-sm-3 mt-2">
                            <label>Presidente</label>       
                            <input class="form-control" id="presidente" name="presidente" placeholder="Escribe parte del nombre" autocomplete="off" required/>
                        </div>
                        <div class="col-12 col-sm-1 mt-2">
                            <label>ID</label>
                            <input class="form-control" id="id_vocal1" name="id_vocal1" value="0" readonly/>
                        </div>                        
                        <div class="col-12 col-sm-3 mt-2">
                            <label>Vocal 1</label>       
                            <input class="form-control" id="vocal1" name="vocal1" placeholder="Escribe parte del nombre" autocomplete="off"/>                            
                        </div>
                        <div class="col-12 col-sm-1 mt-2">
                            <label>ID</label>
                            <input class="form-control" id="id_vocal2" name="id_vocal2" value="0" readonly/>
                        </div>                        
                        <div class="col-12 col-sm-3 mt-2">
                            <label>Vocal 2</label>       
                            <input class="form-control" id="vocal2" name="vocal2" placeholder="Escribe parte del nombre" autocomplete="off"/>                                                        
                        </div>
                    </div>
                </fieldset>

                <fieldset class="form-group border p-3" style="background-color: #f2f2f2">                
                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Guardar</button>
                    <a href="<?php echo base_url(). '/carreras/mesas_carrera/'. $vCARRERA['id']; ?>" class="btn btn-primary"><i class="fa fa-undo-alt"></i> Volver</a>
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