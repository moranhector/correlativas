<?php

namespace App\Models;

use CodeIgniter\Model;

class Gestion_CondicionModel extends Model
{
    protected $table      = 'gestion_condicion';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_persona', 'id_instituto', 'id_carrera', 'id_materia', 'estado', 'aplazos', 'equivalencia', 'nota',
    'fecha_aprobado', 'libro', 'folio', 'observaciones', 'division'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}