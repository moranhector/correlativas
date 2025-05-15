<script>    
    //Funcion de busqueda de persona
    $(function(){
        $("#persona").autocomplete({
            source: "<?php echo base_url(); ?>/gestion/buscar_persona_json",
            minLength: 3,
            select: function(event, ui){
                event.preventDefault();
                $("#id_persona").val(ui.item.id);
                $("#persona").val(ui.item.value);
            }
        });
    });    
</script>

<div id="layoutSidenav_content">

    <main>
        <div class="container-fluid">
            <h2 class="mt-4"><i class="fas fa-users"></i> <?php echo $vTITULO; ?></h2>
            <hr>
            <form method="POST" action="<?php echo base_url(); ?>/carreras/guardar_materia" autocomplete="off">

            <fieldset class="form-group border p-3" style="background-color: #f2f2f2">
                <div class="row">
                    <div class="col-sm-1" >
                        <input class="form-control" id="id_persona" name="id_persona" readonly/>
                    </div>
                    <div class="col-sm-6">
                        <input class="form-control" id="persona" name="persona" placeholder="Escribe parte del nombre, DNI o E-mail" autocomplete="off" />
                    </div>
                    <div class="col-sm-1">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </fieldset>

            </form>

        </div>
    </main>