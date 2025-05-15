<?php

namespace App\Models;

use CodeIgniter\Model;

class Gestion_InscripcionesModel extends Model
{
    protected $table      = 'gestion_inscripciones';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_persona', 'id_instituto', 'id_carrera', 'id_materia', 'anolectivo', 'estado'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}