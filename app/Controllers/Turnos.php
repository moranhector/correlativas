<?php namespace App\Controllers;

use App\Controllers\BaseController;
Use App\Models\Roles_DetalleModel;
use App\Models\PersonasModel;
use App\Models\InstitutosModel;
use App\Models\CarrerasModel;
use App\Models\Gestion_MateriasModel;
use App\Models\Gestion_ProfesoresModel;
use App\Models\Gestion_TurnosModel;
use App\Models\Gestion_Turnos_InscriptosModel;
use App\Models\Gestion_MesasModel;
use App\Models\Gestion_ExamenesModel;

class turnos extends BaseController
{
    protected $session, $detalle,
    $carreras, $institutos, $personas, $departamentos,
    $gestion_materias, $gestion_mesas, $gestion_examenes, $gestion_turnos, $gestion_turnos_inscriptos, $profesores;

    public function __construct()
    {
        $this->session=session();
        $this->detalle = new Roles_DetalleModel();
        $this->personas= new PersonasModel();
        $this->institutos= new InstitutosModel();
        $this->carreras= new CarrerasModel();

        $this->gestion_materias= new Gestion_MateriasModel();
        $this->gestion_mesas= new Gestion_MesasModel();
        $this->gestion_turnos= new Gestion_TurnosModel();
        $this->gestion_turnos_inscriptos= new Gestion_Turnos_InscriptosModel();
        $this->gestion_examenes= new Gestion_ExamenesModel();        
        $this->profesores= new Gestion_ProfesoresModel();
    }

    // Listado de Turnos
    public function index()
    {
        if(!isset($this->session->user_id)) {return redirect()->to(base_url());}
        if(($this->session->user_ies == 0)) {echo view('header');echo view('/acceso');echo view('footer');}

        $acceso = $this->detalle->verificaPermisos($this->session->user_rol, 'GestionIES_ListaTurnos');
        if(!$acceso){
            echo view('header');
            echo view('acceso');
            echo view('footer');
            exit;
        }

        $datos=$this->gestion_turnos->findAll();
        $data=['vTITULO' => 'Lista de Turnos de Mesa', 'vDATOS' => $datos];

        echo view('header');
        echo view('turnos/listado',$data);
        echo view('footer');
    }

    // Listado de Inscriptos en Turno
    public function inscriptos($id_turno)
    {
        if(!isset($this->session->user_id)) {return redirect()->to(base_url());}
        if(($this->session->user_ies == 0)) {echo view('header');echo view('/acceso');echo view('footer');}

        $acceso = $this->detalle->verificaPermisos($this->session->user_rol, 'GestionIES_ListaInscriptosTurno');
        if(!$acceso){
            echo view('header');
            echo view('acceso');
            echo view('footer');
            exit;
        }

        $inscriptos=$this->gestion_turnos_inscriptos->
        select('gestion_turnos_inscriptos.*, gestion_materias.nombre, personas.user_apellido, personas.user_nombres, personas.user_dni, carreras.nombre AS vCARRERA, carreras.resolucion')
        ->where('gestion_turnos_inscriptos.id_turno',$id_turno)
        ->join('gestion_materias', 'gestion_materias.id = gestion_turnos_inscriptos.id')
        ->join('personas', 'personas.id = gestion_turnos_inscriptos.id_persona')
        ->join('carreras', 'carreras.id = gestion_turnos_inscriptos.id_carrera')
        ->findAll();
        
        $turno=$this->gestion_turnos->where('id',$id_turno)->first();
        $data=['vTITULO' => 'Inscriptos en Turno', 'vDATOS' => $inscriptos, 'vTURNO'=>$turno];

        echo view('header');
        echo view('turnos/inscriptos',$data);
        echo view('footer');
    } 
 
}