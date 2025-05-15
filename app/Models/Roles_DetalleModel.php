<?php

namespace App\Models;

use CodeIgniter\Model;

class Roles_DetalleModel extends Model
{
    protected $table      = 'roles_detalle';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_rol', 'id_permiso'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function verificaPermisos($id_rol, $permiso) {
        $acceso = false;
        $this->select('*');
        $this->join('roles_permisos', 'roles_permisos.id = roles_detalle.id_permiso');
        $existe = $this->where(['id_rol' => $id_rol, 'roles_permisos.nombre' => $permiso])->first();

        if($existe != null){
            $acceso = true;
        }
        return $acceso;
    }

}