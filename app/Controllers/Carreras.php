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
use App\Models\Gestion_CondicionModel;
use App\Models\GestionCorrelativasModel; //HAM


class carreras extends BaseController
{
    protected $session, $detalle,
    $carreras, $institutos, $personas, $departamentos,
    $gestion_condicion, $gestion_materias, $gestion_mesas, $gestion_examenes, $gestion_turnos, $gestion_turnos_inscriptos, $gestion_profesores,
    $gestion_correlativas;

    public function __construct()
    {
        $this->session=session();
        $this->detalle = new Roles_DetalleModel();
        $this->personas= new PersonasModel();
        $this->institutos= new InstitutosModel();
        $this->carreras= new CarrerasModel();

        $this->gestion_materias= new Gestion_MateriasModel();
        $this->gestion_mesas= new Gestion_MesasModel();
        $this->gestion_condicion= new Gestion_CondicionModel();
        $this->gestion_turnos= new Gestion_TurnosModel();
        $this->gestion_turnos_inscriptos= new Gestion_Turnos_InscriptosModel();
        $this->gestion_examenes= new Gestion_ExamenesModel();        
        $this->gestion_profesores= new Gestion_ProfesoresModel();
        $this->gestion_correlativas = new GestionCorrelativasModel(); //HAM

    }

    public function index()
    {

    }  

    // Materias de la Carrera
    public function materias($id_carrera)
    {
        if(!isset($this->session->user_id)) {return redirect()->to(base_url());}

        $carrera=$this->carreras->where('id',$id_carrera)->first();
        $materias=$this->gestion_materias->where('carrera',$id_carrera)->findAll();
        $data=['vTITULO' => 'Materias de la carrera', 'vDATOS' => $materias, 'vCARRERA' => $carrera];

        echo view('header');
        echo view('carreras/materias_carrera',$data);
        echo view('footer');
    }

 
    //HAM
    public function correlativas_materia($id_materia)
    {
        if (!isset($this->session->user_id)) {
            return redirect()->to(base_url());
        }
    
        $materia = $this->gestion_materias->find($id_materia);
    
        if (!$materia) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Materia no encontrada");
        }
    
        // Instanciar modelos
        $gestionCorrelativas = new GestionCorrelativasModel();
        $gestionMaterias = new Gestion_MateriasModel();
    
        // Traer correlativas
        $correlativas = $gestionCorrelativas->where('materia_id', $id_materia)->findAll();
    
        // Agregar nombres de las materias relacionadas
        foreach ($correlativas as &$c) {
            $c['materia_nombre'] = $gestionMaterias->find($c['materia_id'])['nombre'] ?? '(?)';
            $c['correlativa_nombre'] = $gestionMaterias->find($c['correlativa_id'])['nombre'] ?? '(?)';
        }
    
        $data = [
            'vTITULO' => 'Correlativas de la materia',
            'vMATERIA' => $materia,
            'vDATOS'  => $correlativas,
        ];
    
        echo view('header');
        echo view('carreras/correlativas_materia', $data);
        echo view('footer');
    }
    
    


    // Historial de Mesas del IES
    public function mesas()
    {
        if(!isset($this->session->user_id)) {return redirect()->to(base_url());}

        $datos=$this->gestion_mesas
        ->select('gestion_mesas.*, carreras.nombre, carreras.resolucion, gestion_materias.nombre as vMATERIA')
        ->join('carreras', 'carreras.id = gestion_mesas.id_carrera')
        ->join('gestion_materias', 'gestion_materias.id = gestion_mesas.id_materia')
        ->findAll();
        $data=['vTITULO' => 'Historial de Mesas', 'vDATOS' => $datos];

        if ($this->session->user_rol == '1' || $this->session->user_rol == '2'){
            echo view('header');
            echo view('carreras/mesas',$data);
            echo view('footer');
        } else {
            echo view('header');
            echo view('/acceso');
            echo view('footer');
        }
    }

    // Mesas de la Carrera
    public function mesas_carrera($id_carrera)
    {
        if(!isset($this->session->user_id)) {return redirect()->to(base_url());}
        if(($this->session->user_ies == 0)) {echo view('header');echo view('/acceso');echo view('footer');}

        $acceso = $this->detalle->verificaPermisos($this->session->user_rol, 'GestionIES_MesasCarrera');
        if(!$acceso){
            echo view('header');
            echo view('acceso');
            echo view('footer');
            exit;
        }        

        $carrera=$this->carreras->where('id',$id_carrera)->first();
        $datos=$this->gestion_mesas
        ->select('gestion_mesas.*, gestion_materias.nombre, gestion_materias.ano, personas.user_apellido, personas.user_nombres')
        ->where('gestion_mesas.id_carrera',$id_carrera)
        ->where('gestion_mesas.id_instituto',$this->session->user_ies)
        ->join('gestion_materias', 'gestion_materias.id = gestion_mesas.id_materia')
        ->join('personas', 'personas.id = gestion_mesas.presidente')
        ->findAll();

        $data=['vTITULO' => 'Mesas de Exámenes de la Carrera', 'vDATOS' => $datos, 'vCARRERA' => $carrera];

        echo view('header');
        echo view('carreras/mesas_carrera',$data);
        echo view('footer');
    }

    // Nueva Mesa en Carrera
    public function nueva_mesa($id)
    {
        if(!isset($this->session->user_id)) {return redirect()->to(base_url());}
        if(($this->session->user_ies == 0)) {echo view('header');echo view('/acceso');echo view('footer');}

        $acceso = $this->detalle->verificaPermisos($this->session->user_rol, 'GestionIES_NuevaMesa');
        if(!$acceso){
            echo view('header');
            echo view('acceso');
            echo view('footer');
            exit;
        }        

        $carrera=$this->carreras->where('id',$id)->first();
        $materias=$this->gestion_materias->where('carrera', $id)->findAll();

        $data=['vTITULO' => 'Nueva Mesa de Exámen', 'vCARRERA' => $carrera, 'vMATERIAS' => $materias];

        echo view('header');
        echo view('carreras/nueva_mesa',$data);
        echo view('footer');
    }

    // Autocompletado de Nombre de Persona - Nueva Mesa
    public function autocompleteData()
    {
        $returnData=array();
        $valor=$this->request->getGet('term');
        $persona=$this->personas->like('user_apellido', $valor)->findAll();
        if(!empty($persona)){
            foreach($persona as $row){
                $data['id'] = $row['id'];
                $data['value'] = $row['user_apellido'] . ' ' . $row['user_nombres'] . ' - ' . $row['user_dni'];
                array_push($returnData, $data);
            }
        }
        echo json_encode($returnData);
    }   

    // Guardar Mesa de Examen
    public function insertar_mesa()
    {
        if(!isset($this->session->user_id)) {return redirect()->to(base_url());}
        if(($this->session->user_ies == 0)) {echo view('header');echo view('/acceso');echo view('footer');}
        
        if ($this->request->getPost('id_presidente') <> 0 ) {
            $this->gestion_mesas->save([
                'id_instituto' => $this->session->user_ies,
                'id_carrera' => $this->request->getPost('id_carrera'),
                'id_materia' => $this->request->getPost('id_materia'),
                'presidente' => $this->request->getPost('id_presidente'),
                'vocal1' => $this->request->getPost('id_vocal1'),
                'vocal2' => $this->request->getPost('id_vocal2'),
                'fecha' => $this->request->getPost('fecha'),
                'libro' => $this->request->getPost('libro'),
                'folio' => $this->request->getPost('folio')
            ]);
        }

        return redirect()->to(base_url().'/carreras/mesas_carrera/' . $this->request->getPost('id_carrera'));
    } 

    // Editar Mesa
    public function editar_mesa($id_mesa)
    {
        if(!isset($this->session->user_id)) {return redirect()->to(base_url());}
        if(($this->session->user_ies == 0)) {echo view('header');echo view('/acceso');echo view('footer');}

        $acceso = $this->detalle->verificaPermisos($this->session->user_rol, 'GestionIES_EditarMesa');
        if(!$acceso){
            echo view('header');
            echo view('acceso');
            echo view('footer');
            exit;
        }       

        $mesa=$this->gestion_mesas
        ->select('gestion_mesas.*, gestion_materias.nombre, carreras.nombre AS vCARRERA, carreras.resolucion, personas.user_apellido, personas.user_nombres')
        ->where('gestion_mesas.id',$id_mesa)
        ->join('personas', 'personas.id = gestion_mesas.presidente')
        ->join('gestion_materias', 'gestion_materias.id = gestion_mesas.id_materia')
        ->join('carreras', 'carreras.id = gestion_mesas.id_carrera')
        ->first();     
        
        $materias=$this->gestion_materias->where('carrera', $mesa['id_carrera'])->orderBy('nombre')->findAll();
        
        $data=['vTITULO' => 'Editar Mesa de Exámen', 'vDATOS' => $mesa, 'vMATERIAS' => $materias];

        echo view('header');
        echo view('carreras/editar_mesa',$data);
        echo view('footer');
    }

    // Actualizar Mesa
    public function actualizar_mesa()
    {
        if(!isset($this->session->user_id)) {return redirect()->to(base_url());}
        if(($this->session->user_ies == 0)) {echo view('header');echo view('/acceso');echo view('footer');}

        $existe=$this->gestion_mesas->find($this->request->getPost('id'));
        if($existe) {

            $this->gestion_mesas->update($this->request->getPost('id'), [
                'id_materia' => $this->request->getPost('id_materia'),
                'presidente' => $this->request->getPost('id_presidente'),
                'vocal1' => $this->request->getPost('id_vocal1'),
                'vocal2' => $this->request->getPost('id_vocal2'),
                'fecha' => $this->request->getPost('fecha'),
                'libro' => $this->request->getPost('libro'),
                'folio' => $this->request->getPost('folio')
            ]);

            return redirect()->to(base_url().'/gestion/carreras_ies');
            }
        
    }   

    // Eliminar Mesa
    public function eliminar_mesa($id_mesa)
    {
        if(!isset($this->session->user_id)) {return redirect()->to(base_url());}
        if(($this->session->user_ies == 0)) {echo view('header');echo view('/acceso');echo view('footer');}        

        $acceso = $this->detalle->verificaPermisos($this->session->user_rol, 'GestionIES_EliminarMesa');
        if(!$acceso){
            echo view('header');
            echo view('acceso');
            echo view('footer');
            exit;
        }   

        $this->gestion_mesas->delete($id_mesa);
        return redirect()->to(base_url().'/carreras');
    } 

    // Exámenes de la Mesa
    public function examenes_mesa($id_mesa)
    {
        if(!isset($this->session->user_id)) {return redirect()->to(base_url());}
        if(($this->session->user_ies == 0)) {echo view('header');echo view('/acceso');echo view('footer');}        

        $acceso = $this->detalle->verificaPermisos($this->session->user_rol, 'GestionIES_ExamenesMesa');
        if(!$acceso){
            echo view('header');
            echo view('acceso');
            echo view('footer');
            exit;
        }   

        $personas=$this->personas->findAll();
        $mesa=$this->gestion_mesas->where('id',$id_mesa)->first();
        $vMATERIA=$this->gestion_materias->find($mesa['id_materia']);
        $carrera=$this->carreras->where('id',$mesa['id_carrera'])->first();
        $examenes=$this->gestion_examenes
        ->select('gestion_examenes.*, personas.user_apellido, personas.user_nombres, personas.user_dni')
        ->where('gestion_examenes.id_mesa',$id_mesa)
        ->join('personas', 'gestion_examenes.id_persona = personas.id')
        ->findAll();

        $data=['vTITULO' => 'Exámenes de la Mesa', 'vDATOS' => $examenes, 'vMESA' => $mesa, 'vCARRERA' => $carrera, 'vALUMNOS' => $personas, 'vMATERIA' => $vMATERIA];

        echo view('header');
        echo view('carreras/examenes_mesa',$data);
        echo view('footer');
    }
    
    // Insertar Examen
    public function insertar_examen()
    {
        if(!isset($this->session->user_id)) {return redirect()->to(base_url());}
        if(($this->session->user_ies == 0)) {echo view('header');echo view('/acceso');echo view('footer');}        

        $acceso = $this->detalle->verificaPermisos($this->session->user_rol, 'GestionIES_InsertarExamen');
        if(!$acceso){
            echo view('header');
            echo view('acceso');
            echo view('footer');
            exit;
        }   

        // Verificamos que el alumno tenga condicion en la carrera
        $mesa=$this->gestion_mesas->where('id', $this->request->getPost('id_mesa'))->first();
        $existe=$this->gestion_condicion
        ->where('id_persona',$this->request->getPost('id_persona'))
        ->where('id_instituto',$this->session->user_ies)
        ->where('id_carrera',$mesa['id_carrera'])
        ->where('id_materia',$mesa['id_materia'])
        ->first();
        
        if ($existe) {
            $this->gestion_examenes->save([
                'id_mesa' => $this->request->getPost('id_mesa'),
                'id_persona' => $this->request->getPost('id_persona'),
                'nota' => $this->request->getPost('nota'),
                'estado' => $this->request->getPost('estado'),
            ]);
            if ($this->request->getPost('nota') > 3) {
                $this->gestion_condicion->update($existe['id'], [
                    'nota' => $this->request->getPost('nota'),
                    'estado' => 5,
                    'fecha_aprobado' => $mesa['fecha']]);
            }
        }

        return redirect()->to(base_url().'/carreras/examenes_mesa/' . $this->request->getPost('id_mesa'));  
    } 

    // Listado de Alumnos de la carrera
    public function alumnos_carrera($id_carrera)
    {
        if(!isset($this->session->user_id)) {return redirect()->to(base_url());}
        if(($this->session->user_ies == 0)) {echo view('header');echo view('/acceso');echo view('footer');}

        $acceso = $this->detalle->verificaPermisos($this->session->user_rol, 'GestionIES_ListaAlumnosCarrera');
        if(!$acceso){
            echo view('header');
            echo view('acceso');
            echo view('footer');
            exit;
        }

        $carrera=$this->carreras->where('id',$id_carrera)->first();
        $alumnos=$this->gestion_condicion
        ->select('gestion_condicion.*, personas.user_apellido, personas.user_nombres, personas.user_dni, personas.user_email, personas.user_telefono')
        ->where('gestion_condicion.id_carrera',$id_carrera)
        ->where('id_instituto', $this->session->user_ies)
        ->join('personas', 'personas.id = gestion_condicion.id_persona')
        ->groupBy('gestion_condicion.id_persona')
        ->findAll();

        $data=['vTITULO' => 'Personas con historial en la carrera', 'vDATOS' => $alumnos, 'vCARRERA' => $carrera];

        echo view('header');
        echo view('carreras/alumnos_carrera',$data);
        echo view('footer');
    }

    // Listado de Alumnos de la carrera Actvos
    public function alumnos_carrera_activos($id_carrera)
    {
        if(!isset($this->session->user_id)) {return redirect()->to(base_url());}
        if(($this->session->user_ies == 0)) {echo view('header');echo view('/acceso');echo view('footer');}

        $acceso = $this->detalle->verificaPermisos($this->session->user_rol, 'GestionIES_ListaAlumnosCarrera');
        if(!$acceso){
            echo view('header');
            echo view('acceso');
            echo view('footer');
            exit;
        }

        $carrera=$this->carreras->where('id',$id_carrera)->first();
        $alumnos=$this->gestion_condicion
        ->select('gestion_condicion.*, personas.user_apellido, personas.user_nombres, personas.user_dni, personas.user_email, personas.user_telefono')
        ->where('gestion_condicion.id_carrera',$id_carrera)
        ->where('id_instituto', $this->session->user_ies)
        ->where('gestion_condicion.estado <>', 5)
        ->where('gestion_condicion.estado <>', 7)
        ->join('personas', 'personas.id = gestion_condicion.id_persona')
        ->groupBy('gestion_condicion.id_persona')
        ->findAll();

        $data=['vTITULO' => 'Alumnos Activos en la carrera', 'vDATOS' => $alumnos, 'vCARRERA' => $carrera];

        echo view('header');
        echo view('carreras/alumnos_carrera_activos',$data);
        echo view('footer');
    }

    // Alumnos de Materia
    public function alumnos_materia($id_materia)
    {
        if(!isset($this->session->user_id)) {return redirect()->to(base_url());}
        if(($this->session->user_ies == 0)) {echo view('header');echo view('/acceso');echo view('footer');}   

        // $acceso = $this->detalle->verificaPermisos($this->session->user_rol, 'GestionIES_AlumnosMateria');
        // if(!$acceso){
        //     echo view('header');
        //     echo view('acceso');
        //     echo view('footer');
        //     exit;
        // }   

        $materia=$this->gestion_materias->where('id',$id_materia)->first();
        $alumnos=$this->gestion_condicion
        ->select('gestion_condicion.*, personas.user_nombres, personas.user_apellido, personas.user_dni, personas.user_email, gestion_condicion_estados.nombre')
        ->where('id_materia', $id_materia)
        ->where('id_instituto', $this->session->user_ies)
        ->where('estado <>', 5)
        ->where('estado <>', 7)
        ->join('personas', 'personas.id = gestion_condicion.id_persona')
        ->join('gestion_condicion_estados', 'gestion_condicion_estados.id = gestion_condicion.estado')
        ->findAll();

        $data=['vTITULO' => 'Alumnos de Materia', 'vDATOS' => $alumnos, 'vMATERIA' => $materia];

        echo view('header');
        echo view('carreras/alumnos_materia',$data);
        echo view('footer');
    }

    // Editar Materia
    public function editar_materia($id)
    {
        if(!isset($this->session->user_id)) {return redirect()->to(base_url());}
        //if(($this->session->user_ies == 0)) {echo view('header');echo view('/acceso');echo view('footer');}

        // $acceso = $this->detalle->verificaPermisos($this->session->user_rol, 'GestionIES_EditarMateria');
        // if(!$acceso){
        //     echo view('header');
        //     echo view('acceso');
        //     echo view('footer');
        //     exit;
        // }       

        $existe=$this->gestion_profesores
        ->where('gestion_profesores.id_materia',$id)
        ->where('gestion_profesores.id_instituto',$this->session->user_ies)
        ->join('carreras', 'carreras.id = gestion_profesores.id_carrera')
        ->join('gestion_materias', 'gestion_materias.id = gestion_profesores.id_materia')
        ->first();     
        
        $data=['vTITULO' => 'Editar Espacio Curricular', 'vDATOS' => $existe];

        echo view('header');
        echo view('carreras/editar_materia',$data);
        echo view('footer');
    }

/// --------------------------
/// --------------------------
/// --------------------------




    public function editar_examen($id_examen)
    {
        if(!isset($this->session->id_usuario)) {return redirect()->to(base_url());}

        $examen=$this->gestion_examenes-> select('examenes.*, alumnos.nombre AS A, mesas.carrera AS B')->where('examenes.id',$id_examen)->join('alumnos', 'examenes.alumno = alumnos.id')->join('mesas', 'examenes.mesa = mesas.id')->first();
        $data=['titulo' => 'Editar datos del Exámen', 'datos' => $examen];

        if ($this->session->rol == '1' || $this->session->rol == '2'){
            echo view('header');
            echo view('carreras/editar_examen',$data);
            echo view('footer');
        } else {
            echo view('header');
            echo view('/acceso');
            echo view('footer');
        }
    }

    public function actualizar_examen()
    {
        if(!isset($this->session->id_usuario)) {return redirect()->to(base_url());}

        if ($this->session->rol == '1' || $this->session->rol == '2'){
            $this->gestion_examenes->update($this->request->getPost('id'), [
            'nota' => $this->request->getPost('nota'),
            'estado' => $this->request->getPost('estado'),
            'observaciones' => $this->request->getPost('observaciones')]);
            return redirect()->to(base_url().'/carreras');
        } else {
            echo view('header');
            echo view('/acceso');
            echo view('footer');
        }        
    }

    public function eliminar_examen($id_examen)
    {
        if(!isset($this->session->id_usuario)) {return redirect()->to(base_url());}

        if ($this->session->rol == '1' || $this->session->rol == '2'){
            $this->gestion_examenes->delete($id_examen);
            return redirect()->to(base_url().'/carreras');
        } else {
            echo view('header');
            echo view('/acceso');
            echo view('footer');
        }            
    }     

}