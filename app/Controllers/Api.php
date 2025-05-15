<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Gestion_MateriasModel;
use App\Models\GestionCorrelativasModel;

//HAM
class Api extends Controller
{
    // public function buscar_materias()
    // {
    //     $term = $this->request->getGet('term');
    //     $materias = (new Gestion_MateriasModel())
    //         ->like('nombre', $term)
    //         ->select('id, nombre')
    //         ->findAll(10);

    //     return $this->response->setJSON($materias);
    // }

    public function buscar_materias()
    {
        $term = $this->request->getGet('term');
        $carrera = $this->request->getGet('carrera');
    
        $materias = (new Gestion_MateriasModel())
            ->like('nombre', $term)
            ->where('carrera', $carrera)
            ->select('id, nombre')
            ->findAll(10);
    
        return $this->response->setJSON($materias);
    }
    


    public function agregar_correlativa()
    {
        $data = $this->request->getJSON(true);

        $registro = [
            'materia_id'      => $data['materia_id'],
            'correlativa_id'  => $data['correlativa_id'],
            'cursar_rendir'   => 'R',
            'user_name'       => 'InterfazWeb'
        ];

        $model = new GestionCorrelativasModel();
        $model->insert($registro);

        return $this->response->setJSON(['message' => 'Correlativa agregada correctamente.']);
    }
}
