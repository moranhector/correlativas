<?php

namespace App\Models;

use CodeIgniter\Model;

class Gestion_Inscripciones_LectivoModel extends Model
{
    protected $table      = 'gestion_inscripciones_lectivo';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_persona', 'id_instituto', 'id_carrera', 'anolectivo', 'estado'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}