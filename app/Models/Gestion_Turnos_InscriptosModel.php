<?php

namespace App\Models;

use CodeIgniter\Model;

class Gestion_Turnos_InscriptosModel extends Model
{
    protected $table      = 'gestion_turnos_inscriptos';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_persona', 'id_carrera', 'id_materia', 'id_turno', 'correlativas'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}