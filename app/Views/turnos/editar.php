
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4"><i class="fas fa-cog"> </i><?php echo ' ' . $titulo; ?></h1>
                        <hr>
                                               
                        <form method="POST" action="<?php echo base_url(); ?>/turnos/actualizar" autocomplete="off">
                        <input type="hidden" id="id" name="id" value="<?php echo $datos['id']; ?>" />

                        <div clases="form-group">
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <label>Descripción</label>
                                    <input class="form-control" id="descripcion" name="descripcion" type="text" value="<?php echo $datos['descripcion']; ?>" autofocus required/>
                                </div>
                                <div class="col-12 col-sm-3">
                                    <label>Estado</label>
                                    <select class="form-control" id="estado" name="estado">
                                        <option value="<?php echo $datos['estado']?>" selected><?php echo $datos['estado']?></option>
                                        <option value="ACTIVO">ACTIVO</option>
                                        <option value="INACTIVO">INACTIVO</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-3">
                                    <label>Observaciones</label>
                                    <input class="form-control" id="observaciones" name="observaciones" type="text" value="<?php echo $datos['observaciones']; ?>" />
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