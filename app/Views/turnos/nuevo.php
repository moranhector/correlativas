
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4"><i class="fas fa-clock"> </i><?php echo ' ' . $titulo; ?></h1>
                        <hr>
                                               
                        <form method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>/turnos/insertar" autocomplete="off">

                        <div clases="form-group">
                            <div class="row">
                                <div class="col-12 col-sm-3">
                                    <label>Descripción</label>
                                    <input class="form-control" id="descripcion" name="descripcion" type="text" autofocus required/>
                                </div>
                                <div class="col-12 col-sm-2">
                                    <label>Estado</label>
                                    <select class="form-control" id="estado" name="estado">
                                        <option value="ACTIVO">ACTIVO</option>
                                        <option value="INACTIVO">INACTIVO</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <label>Observaciones</label>
                                    <input class="form-control" id="observaciones" name="observaciones" type="text" />
                                </div>
                            </div>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Guardar</button>
                        <a href="<?php echo base_url(); ?>/turnos" class="btn btn-primary"><i class="fa fa-undo-alt"></i> Volver</a>
                        <hr>
                    
                    </form>

                    </div>
                </main>