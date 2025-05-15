<?php

namespace App\Models;

use CodeIgniter\Model;

//HAM
class GestionCorrelativasModel extends Model
{
    protected $table      = 'gestion_correlativas';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'materia_id',
        'correlativa_id',
        'cursar_rendir',
        'user_name',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = false; // no uses Timestamps automáticos, se controlan manualmente

    protected $returnType    = 'array';
}
