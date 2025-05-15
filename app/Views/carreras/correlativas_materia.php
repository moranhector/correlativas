<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h2 class="mt-4"><i class="fas fa-users"></i> <?= esc($vTITULO); ?></h2>
            <hr>
            <h5>ID Materia: <?= esc($vMATERIA['id']); ?></h5>
            <h5>Nombre: <?= esc($vMATERIA['nombre']); ?></h5>
            <hr>
            <div>
                <p>
                    <a href="<?= base_url(); ?>/carreras/materias/<?= esc($vMATERIA['carrera']); ?>" class="btn btn-primary">
                        <i class="fa fa-undo-alt"></i> Volver
                    </a>
                </p>
            </div>

            <div class="card mb-3">
                <div class="card-body">
                    <form id="form-agregar-correlativa" class="form-inline">
                        <input type="hidden" name="materia_id" id="materia_id" value="<?= esc($vMATERIA['id']) ?>">
                       
                        <!-- PASO MATERIA OCULTO PARA EL SCRIPT DE BUSQUEDA -->
                       
                        <input type="hidden" id="carrera_id" value="<?= esc($vMATERIA['carrera']) ?>">


                        <label for="buscar_correlativa" class="mr-2">Buscar Materia:</label>
                        <input type="text" class="form-control mr-2" id="buscar_correlativa" placeholder="Nombre de materia..." autocomplete="off" style="min-width:300px;">

                        <input type="hidden" id="correlativa_id" name="correlativa_id">

                        <button type="submit" class="btn btn-success">Agregar Correlativa</button>
                    </form>

                    <div id="sugerencias" class="mt-2"></div>
                </div>
            </div>









            <div class="card mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Materia ID</th>
                                    <th>Materia</th>
                                    <th>Correlativa ID</th>
                                    <th>Correlativa</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($vDATOS as $dato) : ?>
                                    <tr>
                                        <td><?= esc($dato['id']) ?></td>
                                        <td><?= esc($dato['materia_id']) ?></td>
                                        <td><?= esc($dato['materia_nombre']) ?></td>
                                        <td><?= esc($dato['correlativa_id']) ?></td>
                                        <td><?= esc($dato['correlativa_nombre']) ?></td>
                                        <td>
                                            <a href="<?= base_url() . '/carreras/editar_correlativa/' . $dato['id']; ?>" class="btn btn-success btn-sm" title="Editar">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>



<script>
document.addEventListener('DOMContentLoaded', function () {
    console.log('entra');
    const inputBuscar = document.getElementById('buscar_correlativa');
    const sugerencias = document.getElementById('sugerencias');
    const correlativaId = document.getElementById('correlativa_id');
    const carreraId = document.getElementById('carrera_id').value;    

    inputBuscar.addEventListener('input', function () {
        console.log('entra 1');
        const query = this.value.trim();
        if (query.length < 3) {
            sugerencias.innerHTML = '';
            return;
        }



        fetch(`<?= base_url(); ?>/api/materias/buscar?term=${encodeURIComponent(query)}&carrera=${encodeURIComponent(carreraId)}`)      
        // fetch(`<?= base_url(); ?>/api/materias/buscar?term=${encodeURIComponent(query)}`)
            .then(res => res.json())
            .then(data => {
                sugerencias.innerHTML = '';
                if (data.length === 0) {
                    sugerencias.innerHTML = '<small class="text-muted">Sin resultados</small>';
                } else {
                    const lista = document.createElement('ul');
                    lista.classList.add('list-group');
                    data.forEach(m => {
                        const item = document.createElement('li');
                        item.className = 'list-group-item list-group-item-action';
                        item.textContent = `${m.id} - ${m.nombre}`;
                        item.style.cursor = 'pointer';
                        item.onclick = function () {
                            inputBuscar.value = m.nombre;
                            correlativaId.value = m.id;
                            sugerencias.innerHTML = '';
                        };
                        lista.appendChild(item);
                    });
                    sugerencias.appendChild(lista);
                }
            });
    });

    document.getElementById('form-agregar-correlativa').addEventListener('submit', function (e) {
        console.log('entra 3');
        e.preventDefault();

        const materiaId = document.getElementById('materia_id').value;
        const correlativa = correlativaId.value;

        if (!correlativa) {
            alert('Seleccioná una correlativa válida.');
            return;
        }

        fetch("<?= base_url(); ?>/api/correlativas/agregar", {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({
                materia_id: materiaId,
                correlativa_id: correlativa
            })
        })
        .then(res => res.json())
        .then(data => {
            alert(data.message || 'Correlativa agregada');
            window.location.reload();
        });
    });
});
</script>
