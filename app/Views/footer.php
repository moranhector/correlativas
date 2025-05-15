                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; <a href="https://superior-infd.mendoza.edu.ar/sitio/" target="_blank">Dirección de Educación Superior</a> | 2025</div>
                        </div>
                    </div>
                </footer>

            </div>
        </div>
        
        <!-- JS -->
        <script src="https://dti.mendoza.edu.ar/superior/sitio/assets/js/scripts.js"></script>

        <!-- Modal Elimina -->
        <div class="modal fade" id="modal-eliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="examplemodal">Eliminar Registro</h5>
                    </div>
                    <div class="modal-body">
                        El siguiente proceso eliminará el Registro!
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <a class="btn btn-danger btn-ok">Aceptar</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Confirma Elimina en Modal -->
        <script>
            $('#modal-eliminar').on('show.bs.modal', function(e){
                $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            });
        </script>

        <!-- Modal Aceptar Pendiente -->
        <div class="modal fade" id="aceptar_pendiente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="examplemodal">Aceptar Inscripción</h5>
                    </div>
                    <div class="modal-body">
                        El siguiente proceso Aceptará el Registro de Inscripción!
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <a class="btn btn-danger btn-ok">Aceptar</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Confirma Elimina en Modal -->
        <script>
            $('#aceptar_pendiente').on('show.bs.modal', function(e){
                $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            });
        </script>

        <!-- Modal Rechazar Pendiente -->
        <div class="modal fade" id="rechazar_pendiente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="examplemodal">Rechazar Inscripción</h5>
                    </div>
                    <div class="modal-body">
                        El siguiente proceso Rechazará el Registro de Inscripción!
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <a class="btn btn-danger btn-ok">Aceptar</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Confirma Elimina en Modal -->
        <script>
            $('#rechazar_pendiente').on('show.bs.modal', function(e){
                $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            });
        </script>        

        <!-- Mensaje en MENSAJEMODAL -->
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                let mensaje = "<?= session()->getFlashdata('success') ?: session()->getFlashdata('error') ?>";
                if (mensaje) {
                    document.getElementById("mensajeTexto").innerText = mensaje;
                    let modal = new bootstrap.Modal(document.getElementById("mensajeModal"));
                    modal.show();
                }
            });
        </script>   
        <!-- Modal de Bootstrap - MENSAJEMODAL -->
        <div class="modal fade" id="mensajeModal" tabindex="-1" aria-labelledby="mensajeModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mensajeModalLabel">Mensaje</h5>
                    </div>
                    <div class="modal-body">
                        <p id="mensajeTexto"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Datatable General -->
        <script>
            $('#dataTable').DataTable({
                //Traducciones
                language: {
                    "sProcessing":    "Procesando...",
                    "sLengthMenu":    "Mostrar _MENU_ registros",
                    "sZeroRecords":   "No se encontraron resultados",
                    "sEmptyTable":    "Ningún dato disponible en esta tabla",
                    "sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":   "",
                    "sSearch":        "Buscar:",
                    "sUrl":           "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":    "Último",
                        "sNext":    "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                },
                dom: 'Bfrtipl',
                //Botones
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel"></i> Excel',
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i> PDF',
                    }
                ]
            });
        </script>

        <!-- Datatable Sin Botones -->
        <script>
            $('#dataTable_simple').DataTable({
                //Traducciones
                language: {
                    "sProcessing":    "Procesando...",
                    "sLengthMenu":    "Mostrar _MENU_ registros",
                    "sZeroRecords":   "No se encontraron resultados",
                    "sEmptyTable":    "Ningún dato disponible en esta tabla",
                    "sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":   "",
                    "sSearch":        "Buscar:",
                    "sUrl":           "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":    "Último",
                        "sNext":    "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                },
                dom: 'lrtip',
                //Botones
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel"></i> Excel',
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i> PDF',
                    }
                ]
            });
        </script>

    </body>
</html>
